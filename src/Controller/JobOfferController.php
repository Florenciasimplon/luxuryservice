<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Entity\JobTypes;
use App\Entity\User;
use App\Form\JobOfferType;
use App\Repository\CandidatureRepository;
use App\Repository\JobOfferRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/job/offer")
 */
class JobOfferController extends AbstractController
{
    /**
     * @Route("/", name="job_offer_index", methods={"GET"})
     */
    public function index(JobOfferRepository $jobOfferRepository): Response
    {
        return $this->render('job_offer/index.html.twig', [
            'job_offers' => $jobOfferRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="job_offer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jobOffer = new JobOffer();
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobOffer->setCreationDate(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobOffer);
            $entityManager->flush();

            return $this->redirectToRoute('job_offer_index');
        }

        return $this->render('job_offer/new.html.twig', [
            'job_offer' => $jobOffer,
            'form' => $form->createView(),
            
        ]);
    }

    /**
     * @Route("/{id}", name="job_offer_show", methods={"GET"})
     */
    public function show(
        JobOffer $jobOffer, 
        JobOfferRepository $jobOfferRepository, 
        CandidatureRepository $candidatureRepository,
        Security $security
        ): Response
    {
        /** @var User */
        $user = $security->getUser();

        $jobBefore = $jobOfferRepository->getPreviousJob($jobOffer);
        $jobAfter = $jobOfferRepository->getNextJob($jobOffer);
       

        return $this->render('job_offer/show.html.twig', [
            'job_offer' => $jobOffer,
            
            'job_previous'=> $jobBefore,
            'job_next'=> $jobAfter,
            'candidatureExists' => !! $candidatureRepository->findOneBy([
                'job_offer' => $jobOffer->getId(),
                'candidat' => $user->getCandidat()->getId(),
            ])
        ]);
        
    }

    /**
     * @Route("/{id}/edit", name="job_offer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobOffer $jobOffer): Response
    {
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_offer_index');
        }

        return $this->render('job_offer/edit.html.twig', [
            'job_offer' => $jobOffer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_offer_delete", methods={"POST"})
     */
    public function delete(Request $request, JobOffer $jobOffer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobOffer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobOffer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_offer_index');
    }
}
