<?php

namespace App\Controller;

use App\Entity\Addons;
use App\Form\AddonsType;
use App\Repository\AddonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/addons')]
final class AddonsController extends AbstractController
{
    #[Route(name: 'app_addons_index', methods: ['GET'])]
    public function index(AddonsRepository $addonsRepository): Response
    {
        return $this->render('addons/index.html.twig', [
            'addons' => $addonsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_addons_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $addon = new Addons();
        $form = $this->createForm(AddonsType::class, $addon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($addon);
            $entityManager->flush();

            return $this->redirectToRoute('app_addons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('addons/new.html.twig', [
            'addon' => $addon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_addons_show', methods: ['GET'])]
    public function show(Addons $addon): Response
    {

        return $this->render('addons/show.html.twig', [
            'addon' => $addon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_addons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Addons $addon, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(AddonsType::class, $addon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_addons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('addons/edit.html.twig', [
            'addon' => $addon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_addons_delete', methods: ['POST'])]
    public function delete(Request $request, Addons $addon, EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid('delete'.$addon->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($addon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_addons_index', [], Response::HTTP_SEE_OTHER);
    }
}
