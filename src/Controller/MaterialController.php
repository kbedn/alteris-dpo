<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/material")
 */
class MaterialController extends AbstractController
{
    /**
     * @Route("/", name="material_index", methods={"GET"})
     */
    public function index(): Response
    {
        $materialRepository = $this->getDoctrine()->getRepository(Material::class);
        return $this->render('material/index.html.twig', [
            'materials' => $materialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="material_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $material = new Material();
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($material);
            $entityManager->flush();

            return $this->redirectToRoute('material_index');
        }

        return $this->render('material/new.html.twig', [
            'material' => $material,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="material_show", methods={"GET"})
     * @param Material $material
     * @return Response
     */
    public function show(Material $material): Response
    {
        return $this->render('material/show.html.twig', [
            'material' => $material,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="material_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Material $material
     * @return Response
     */
    public function edit(Request $request, Material $material): Response
    {
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('material_index');
        }

        return $this->render('material/edit.html.twig', [
            'material' => $material,
            'form' => $form->createView(),
        ]);
    }
}
