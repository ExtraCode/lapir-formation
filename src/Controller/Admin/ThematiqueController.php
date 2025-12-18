<?php

namespace App\Controller\Admin;

use App\Entity\DomaineFormation;
use App\Entity\ThematiqueFormation;
use App\Form\DomaineFormationType;
use App\Form\ThematiqueFormationType;
use App\Repository\DomaineFormationRepository;
use App\Repository\FormationRepository;
use App\Repository\ThematiqueFormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/thematique', name: 'app_admin_thematique')]
class ThematiqueController extends AbstractController
{
    #[Route('', name: '')]
    public function index(ThematiqueFormationRepository $thematiqueFormationRepository): Response
    {

        return $this->render('admin/thematique/index.html.twig', [
            'thematiques' => $thematiqueFormationRepository->findBy([], ['nom' => 'ASC']),
        ]);

    }

    #[Route('/ajouter', name: '_ajouter')]
    public function ajouter(Request                $request,
                            EntityManagerInterface $entityManager): Response
    {
        $thematique = new ThematiqueFormation();
        $form = $this->createForm(ThematiqueFormationType::class, $thematique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($thematique);
            $entityManager->flush();

            $this->addFlash('success', "La thématique de formation a bien été ajoutée.");

            return $this->redirectToRoute('app_admin_thematique', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/thematique/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/modifier/{id}', name: '_modifier')]
    public function edit(Request                $request,
                         ThematiqueFormation    $thematique,
                         EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ThematiqueFormationType::class, $thematique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', "La thématique a bien été modifiée.");
            return $this->redirectToRoute('app_admin_thematique', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/thematique/modifier.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('supprimer/{id}', name: '_supprimer')]
    public function delete(ThematiqueFormation $thematique, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($thematique);
        $entityManager->flush();

        $this->addFlash('success', "Le thématique de formation a bien été supprimé.");

        return $this->redirectToRoute('app_admin_thematique', [], Response::HTTP_SEE_OTHER);
    }

}
