<?php

namespace App\Controller;

use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(JobOfferRepository $jobOfferRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'user'=>$this->getUser(),
            'job_offers' => $jobOfferRepository->findAll(),
        ]);
    }
    /**
     * @Route("/contact", name="contact_index")
     */
    public function contact_index():Response
    {
        return $this->render('home/contact.html.twig');
    }
     /**
     * @Route("/compagny", name="compagny_index")
     */
    public function compagny_index():Response
    {
        return $this->render('home/compagny.html.twig');
    }
    /**
     * @Route("/acces-denied", name="acces-denied")
     */
    public function acces_denied():Response
    {
        $this->addFlash('success', "Vous n'êtes pas autorisé à accéder à cette page");
        return $this->redirectToRoute('home');
    }

}
