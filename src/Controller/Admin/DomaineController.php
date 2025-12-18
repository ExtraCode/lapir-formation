<?php

namespace App\Controller\Admin;

use App\Entity\DomaineFormation;
use App\Form\DomaineFormationType;
use App\Repository\DomaineFormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/domaine', name: 'app_admin_domaine')]
class DomaineController extends AbstractController
{
    #[Route('', name: '')]
    public function index(DomaineFormationRepository $domaineFormationRepository): Response
    {

        return $this->render('admin/domaine/index.html.twig', [
            'domaines' => $domaineFormationRepository->findBy([], ['nom' => 'ASC']),
        ]);

    }

    #[Route('/ajouter', name: '_ajouter')]
    public function ajouter(Request                $request,
                            EntityManagerInterface $entityManager): Response
    {
        $domaine = new DomaineFormation();
        $form = $this->createForm(DomaineFormationType::class, $domaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($domaine);
            $entityManager->flush();

            $this->addFlash('success', "Le domaine de formation a bien été ajouté.");

            return $this->redirectToRoute('app_admin_domaine', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/domaine/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/modifier/{id}', name: '_modifier')]
    public function edit(Request                $request,
                         DomaineFormation       $domaine,
                         EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DomaineFormationType::class, $domaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', "Le domaine de formation a bien été modifié.");
            return $this->redirectToRoute('app_admin_domaine', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/domaine/modifier.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('supprimer/{id}', name: '_supprimer')]
    public function delete(DomaineFormation $domaine, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($domaine);
        $entityManager->flush();

        $this->addFlash('success', "Le domaine de formation a bien été supprimé.");

        return $this->redirectToRoute('app_admin_domaine', [], Response::HTTP_SEE_OTHER);
    }

}
