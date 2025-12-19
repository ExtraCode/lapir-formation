<?php

namespace App\Controller\Admin;

use App\Entity\DomaineFormation;
use App\Entity\ModuleFormation;
use App\Form\ModuleFormationType;
use App\Repository\ModuleFormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/module', name: 'app_admin_module')]
class ModuleController extends AbstractController
{
    #[Route('', name: '')]
    public function index(ModuleFormationRepository $moduleFormationRepository): Response
    {

        return $this->render('admin/module/index.html.twig', [
            'modules' => $moduleFormationRepository->findAllOrderByFormationAndOrdre(),
        ]);

    }

    #[Route('/ajouter', name: '_ajouter')]
    public function ajouter(Request                $request,
                            EntityManagerInterface $entityManager): Response
    {
        $module = new ModuleFormation();
        $form = $this->createForm(ModuleFormationType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($module);
            $entityManager->flush();

            $this->addFlash('success', "Le module de formation a bien été ajouté.");

            return $this->redirectToRoute('app_admin_module', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/module/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/modifier/{id}', name: '_modifier')]
    public function edit(Request                $request,
                         ModuleFormation        $module,
                         EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModuleFormationType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', "Le module de formation a bien été modifié.");
            return $this->redirectToRoute('app_admin_module', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/module/modifier.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function delete(ModuleFormation $module, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($module);
        $entityManager->flush();

        $this->addFlash('success', "Le module de formation a bien été supprimé.");

        return $this->redirectToRoute('app_admin_module', [], Response::HTTP_SEE_OTHER);
    }

}
