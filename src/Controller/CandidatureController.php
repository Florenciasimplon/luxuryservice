<?php

namespace App\Controller;

use App\Entity\Candidats;
use App\Entity\Candidature;
use App\Entity\JobOffer;
use App\Entity\User;
use App\Form\CandidatureType;
use App\Repository\CandidatureRepository;
use App\Repository\JobOfferRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/candidature")
 */
class CandidatureController extends AbstractController
{
    /**
     * @Route("/", name="candidature_index", methods={"GET"})
     */
    public function index(CandidatureRepository $candidatureRepository): Response
    {
        return $this->render('candidature/index.html.twig', [
            'candidatures' => $candidatureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="candidature_new", methods={"GET"})
     */
    public function new(
        JobOffer $jobOffer, 
        Security $security
    ): Response
    {
        /** @var User */
        $user = $security->getUser();
        $candidat = $user->getCandidat();

        // Vérifier que le profil est complet avant de continuer
        if(!$candidat->isProfileComplete()) {
            $this->addFlash('Error', "Vous n'êtes pas autorisé à postuler si votre profile n'est pas completé à 100%");

            return $this->redirectToRoute('candidats_edit', [
                'id'=> $candidat->getId(),
            ]); 
        }

        $candidature = new Candidature();
        $candidature->setJobOffer($jobOffer);
        $candidature->setCandidat($candidat);
        $candidature->setCreateDate(new DateTime());
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($candidature);
        $entityManager->flush();

        return $this->redirectToRoute('job_offer_show', [
            'id'=> $jobOffer->getId(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidature_show", methods={"GET"})
     */
    /*public function show(Candidature $candidature): Response
    {
        return $this->render('candidature/show.html.twig', [
            'candidature' => $candidature,
        ]);
    }*/

    /**
     * @Route("/{id}/edit", name="candidature_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Candidature $candidature): Response
    {
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidature_index');
        }

        return $this->render('candidature/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidature_delete", methods={"POST"})
     */
    public function delete(Request $request, Candidature $candidature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidature_index');
    }
    
}
