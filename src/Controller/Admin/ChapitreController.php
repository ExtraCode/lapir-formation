<?php

namespace App\Controller\Admin;

use App\Entity\ChapitreModuleFormation;
use App\Form\ChapitreModuleFormationType;
use App\Repository\ChapitreModuleFormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/chapitre', name: 'app_admin_chapitre')]
class ChapitreController extends AbstractController
{
    #[Route('', name: '')]
    public function index(ChapitreModuleFormationRepository $chapitreModuleFormationRepository): Response
    {

        return $this->render('admin/chapitre/index.html.twig', [
            'chapitres' => $chapitreModuleFormationRepository->findAllOrderByFormationAndModuleAndOrdre(),
        ]);

    }

    #[Route('/ajouter', name: '_ajouter')]
    public function ajouter(Request                $request,
                            EntityManagerInterface $entityManager): Response
    {
        $chapitre = new ChapitreModuleFormation();
        $form = $this->createForm(ChapitreModuleFormationType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($chapitre);
            $entityManager->flush();

            $this->addFlash('success', "Le chapitre de formation a bien été ajouté.");

            return $this->redirectToRoute('app_admin_chapitre', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/chapitre/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/modifier/{id}', name: '_modifier')]
    public function edit(Request                 $request,
                         ChapitreModuleFormation $chapitre,
                         EntityManagerInterface  $entityManager): Response
    {
        $form = $this->createForm(ChapitreModuleFormationType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', "Le chapitre de formation a bien été modifié.");
            return $this->redirectToRoute('app_admin_chapitre', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/chapitre/modifier.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function delete(ChapitreModuleFormation $chapitre, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($chapitre);
        $entityManager->flush();

        $this->addFlash('success', "Le chapitre de formation a bien été supprimé.");

        return $this->redirectToRoute('app_admin_chapitre', [], Response::HTTP_SEE_OTHER);
    }

}
