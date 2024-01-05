<?php

namespace App\UserInterface\Controller;

use App\Domain\DishType;
use App\Infrastructure\Doctrine\Repository\DishTypeRepository;
use App\UserInterface\Form\DishTypeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dish_type')]
class DishTypeController extends AbstractController
{
    #[Route('/', name: 'app_dish_type_index', methods: ['GET'])]
    public function index(DishTypeRepository $dishTypeRepository): Response
    {
        return $this->render('dish_type/index.html.twig', [
            'dish_types' => $dishTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dish_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dishType = new DishType();
        $form = $this->createForm(DishTypeType::class, $dishType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dishType);
            $entityManager->flush();

            return $this->redirectToRoute('app_dish_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dish_type/new.html.twig', [
            'dish_type' => $dishType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dish_type_show', methods: ['GET'])]
    public function show(DishType $dishType): Response
    {
        return $this->render('dish_type/show.html.twig', [
            'dish_type' => $dishType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dish_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DishType $dishType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DishTypeType::class, $dishType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dish_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dish_type/edit.html.twig', [
            'dish_type' => $dishType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dish_type_delete', methods: ['POST'])]
    public function delete(Request $request, DishType $dishType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dishType->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dishType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dish_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
