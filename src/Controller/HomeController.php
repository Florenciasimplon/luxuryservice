<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        
        

        return $this->render('home/index.html.twig', [
            'user'=>$this->getUser(),
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
}
