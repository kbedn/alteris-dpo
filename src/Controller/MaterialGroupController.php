<?php

namespace App\Controller;

use App\Entity\Material;
use App\Entity\MaterialGroup;
use App\Form\MaterialGroupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/material-group")
 */
class MaterialGroupController extends AbstractController
{
    /**
     * @Route("/", name="material_group_index", methods={"GET"})
     */
    public function index(): Response
    {
        $materialGroupRepository = $this->getDoctrine()->getRepository(MaterialGroup::class);
        return $this->render('material_group/index.html.twig', [
            'material_groups' => $materialGroupRepository->findAll(),
            'htmlTree' => $this->getHtmlTree(),
        ]);
    }

    /**
     * @Route("/new", name="material_group_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $materialGroup = new MaterialGroup();
        $form = $this->createForm(MaterialGroupType::class, $materialGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($materialGroup);
            $entityManager->flush();

            return $this->redirectToRoute('material_group_index');
        }

        return $this->render('material_group/new.html.twig', [
            'material_group' => $materialGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="material_group_show", methods={"GET"})
     * @param MaterialGroup $materialGroup
     * @return Response
     */
    public function show(MaterialGroup $materialGroup): Response
    {

        return $this->render('material_group/show.html.twig', [
            'material_group' => $materialGroup,
            'htmlTree' => $this->getHtmlTree($materialGroup)
        ]);
    }

    /**
     * @Route("/{id}/edit", name="material_group_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaterialGroup $materialGroup
     * @return Response
     */
    public function edit(Request $request, MaterialGroup $materialGroup): Response
    {
        $form = $this->createForm(MaterialGroupType::class, $materialGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('material_group_index');
        }

        return $this->render('material_group/edit.html.twig', [
            'material_group' => $materialGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param MaterialGroup|null $node
     * @return string
     */
    private function getHtmlTree(MaterialGroup $node = null): string
    {
        $materialGroupRepository = $this->getDoctrine()->getRepository(MaterialGroup::class);

        return $materialGroupRepository->childrenHierarchy(
            $node ? $node : null,
            false,
            [
                'decorate' => true,
                'representationField' => 'name',
                'html' => true,
                'nodeDecorator' => static function($node) {
                    return $node['name'].' <a href="/material-group/'.$node['id'].'">show</a> <a href="/material-group/'.$node['id'].'/edit">edit</a>';
                }
            ]
        );
    }
}
