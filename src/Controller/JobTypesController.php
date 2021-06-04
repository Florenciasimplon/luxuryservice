<?php

namespace App\Controller;

use App\Entity\JobTypes;
use App\Form\JobTypesType;
use App\Repository\JobTypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/job/types")
 */
class JobTypesController extends AbstractController
{
    /**
     * @Route("/", name="job_types_index", methods={"GET"})
     */
    public function index(JobTypesRepository $jobTypesRepository): Response
    {
        return $this->render('job_types/index.html.twig', [
            'job_types' => $jobTypesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="job_types_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jobType = new JobTypes();
        $form = $this->createForm(JobTypesType::class, $jobType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobType);
            $entityManager->flush();

            return $this->redirectToRoute('job_types_index');
        }

        return $this->render('job_types/new.html.twig', [
            'job_type' => $jobType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_types_show", methods={"GET"})
     */
    public function show(JobTypes $jobType): Response
    {
        return $this->render('job_types/show.html.twig', [
            'job_type' => $jobType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_types_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobTypes $jobType): Response
    {
        $form = $this->createForm(JobTypesType::class, $jobType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_types_index');
        }

        return $this->render('job_types/edit.html.twig', [
            'job_type' => $jobType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_types_delete", methods={"POST"})
     */
    public function delete(Request $request, JobTypes $jobType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_types_index');
    }
}
