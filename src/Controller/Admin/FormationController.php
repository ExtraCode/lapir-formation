<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/formation', name: 'app_admin_formation')]
class FormationController extends AbstractController
{
    #[Route('', name: '')]
    public function index(FormationRepository $formationRepository): Response
    {

        return $this->render('admin/formation/index.html.twig', [
            'formations' => $formationRepository->findBy([], ['nom' => 'ASC']),
        ]);

    }

    #[Route('/ajouter', name: '_ajouter')]
    public function ajouter(Request                $request,
                            EntityManagerInterface $entityManager): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($formation);
            $entityManager->flush();

            $this->addFlash('success', "La formation a bien été ajoutée.");

            return $this->redirectToRoute('app_admin_formation', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/formation/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/modifier/{id}', name: '_modifier')]
    public function edit(Request                $request,
                         Formation              $formation,
                         EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', "La formation a bien été modifiée.");
            return $this->redirectToRoute('app_admin_formation', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/formation/modifier.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function delete(Formation $formation, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($formation);
        $entityManager->flush();

        $this->addFlash('success', "Le formation a bien été supprimée.");

        return $this->redirectToRoute('app_admin_formation', [], Response::HTTP_SEE_OTHER);
    }

}
