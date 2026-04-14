<?php

namespace App\Controller;

use App\Entity\Share;
use App\Form\ShareType;
use App\Repository\ShareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/share')]
final class ShareController extends AbstractController
{
    #[Route(name: 'app_share_index', methods: ['GET'])]
    public function index(ShareRepository $shareRepository): Response
    {
        return $this->render('share/index.html.twig', [
            'shares' => $shareRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_share_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $share = new Share();
        $form = $this->createForm(ShareType::class, $share);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // à partir de $request, récupérer la saisie d l'input user -> string
            // utiliser un objet de type userRepo pour pouvoir faire un find avec le nom d'utilisateur en paramètre
            // si un utilisateur trouvé, faire un setUser() sur $share en lui passant l'utilisateur récupéré et continuer sur le persist
            // Sinon retourner un message d'erreur
            $entityManager->persist($share);
            $entityManager->flush();

            return $this->redirectToRoute('app_share_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('share/new.html.twig', [
            'share' => $share,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_share_show', methods: ['GET'])]
    public function show(Share $share): Response
    {
        return $this->render('share/show.html.twig', [
            'share' => $share,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_share_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Share $share, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShareType::class, $share);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_share_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('share/edit.html.twig', [
            'share' => $share,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_share_delete', methods: ['POST'])]
    public function delete(Request $request, Share $share, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$share->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($share);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_share_index', [], Response::HTTP_SEE_OTHER);
    }
}
