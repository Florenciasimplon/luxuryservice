<?php

namespace App\Controller;

use App\Repository\CandidatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JobCategoryRepository;
use App\Repository\JobOfferRepository;

/**
 * @Route("/admin")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/job/offer", name="admin_job_offer_index")
     */
    public function job_offer_index(JobOfferRepository $jobOfferRepository): Response
    {
        
        return $this->render('admin/job_offer_index.html.twig', [
            'controller_name' => 'AdminController',
            'job_offers' => $jobOfferRepository->findAll(),
        ]);
    }
    /**
     * @Route("/candidature/index", priority=1, name="admin_candidature_index")
     */
    public function candidature_index( CandidatureRepository $candidatureRepository ): Response
    {
        $allCandidature = $candidatureRepository->findAllwithJoin();
        return $this->render('admin/candidature_index.html.twig', [
            'candidatures'=>$allCandidature
        ]);
    }
}

