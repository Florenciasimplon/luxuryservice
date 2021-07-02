<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Entity\Candidats;
use App\Form\CandidatsType;
use App\Repository\CandidatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/")
 */
class CandidatsController extends AbstractController
{
    /**
     * @Route("/admin/candidats", name="candidats_index", methods={"GET"})
     */
    public function index(CandidatsRepository $candidatsRepository): Response
    {
        return $this->render('candidats/index.html.twig', [
            'candidats' => $candidatsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/new", name="candidats_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $candidat = new Candidats();
        $form = $this->createForm(CandidatsType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidat);
            $entityManager->flush();

            return $this->redirectToRoute('candidats_index');
        }

        return $this->render('candidats/new.html.twig', [
            'candidat' => $candidat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="candidats_show", methods={"GET"})
     */
    public function show(Candidats $candidat): Response
    {
        return $this->render('candidats/show.html.twig', [
            'candidat' => $candidat,
        ]);
    }

    /**
     * @Route("/candidats/{id}/edit", name="candidats_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Candidats $candidat,SluggerInterface $slugger): Response
    {
        $user=$this->getUser();
        $form = $this->createForm(CandidatsType::class, $candidat);
        $form->handleRequest($request);
        $cv = $form->get('cv')->getData();
        $picture = $form->get('picture')->getData();
        $passport = $form->get('passport')->getData();

        $dataCandidat = $candidat->toArray();
        $dataLength = count($dataCandidat);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($cv !== null) {
                $candidat->setCv($this->upload($cv, 'cv', $slugger));
            }
            if ($picture !== null) {
                $candidat->setPicture($this->upload($picture, 'picture', $slugger));
            }
            if ($passport !== null) {
                $candidat->setPassport($this->upload($passport, 'passport', $slugger));
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidats_edit',[
                'id'=>$candidat->getId(),
            ]);
        }

        return $this->render('candidats/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form->createView(),
            'user'=> $user,
            'dataCandidat' => $dataCandidat,
            'dataLength'=> $dataLength,
            'filleFieldCount'=> $candidat->getProfileCompletionPercent()
        ]);
        
    }

    /**
     * @Route("/admin/{id}", name="candidats_delete", methods={"POST"})
     */
    public function delete(Request $request, Candidats $candidat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidats_index');
    }
    public function upload($file, $target_directory ,$slugger){
        if ($file) {
                    $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $file->move(
                            $this->getParameter($target_directory),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    return $newFilename;
                }

        }

    

        
}
