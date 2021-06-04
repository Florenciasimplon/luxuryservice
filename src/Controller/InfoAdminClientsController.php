<?php

namespace App\Controller;

use App\Entity\InfoAdminClients;
use App\Form\InfoAdminClientsType;
use App\Repository\InfoAdminClientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/info/admin/clients")
 */
class InfoAdminClientsController extends AbstractController
{
    /**
     * @Route("/", name="info_admin_clients_index", methods={"GET"})
     */
    public function index(InfoAdminClientsRepository $infoAdminClientsRepository): Response
    {
        return $this->render('info_admin_clients/index.html.twig', [
            'info_admin_clients' => $infoAdminClientsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="info_admin_clients_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infoAdminClient = new InfoAdminClients();
        $form = $this->createForm(InfoAdminClientsType::class, $infoAdminClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infoAdminClient);
            $entityManager->flush();

            return $this->redirectToRoute('info_admin_clients_index');
        }

        return $this->render('info_admin_clients/new.html.twig', [
            'info_admin_client' => $infoAdminClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_admin_clients_show", methods={"GET"})
     */
    public function show(InfoAdminClients $infoAdminClient): Response
    {
        return $this->render('info_admin_clients/show.html.twig', [
            'info_admin_client' => $infoAdminClient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="info_admin_clients_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfoAdminClients $infoAdminClient): Response
    {
        $form = $this->createForm(InfoAdminClientsType::class, $infoAdminClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_admin_clients_index');
        }

        return $this->render('info_admin_clients/edit.html.twig', [
            'info_admin_client' => $infoAdminClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_admin_clients_delete", methods={"POST"})
     */
    public function delete(Request $request, InfoAdminClients $infoAdminClient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infoAdminClient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infoAdminClient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('info_admin_clients_index');
    }
}
