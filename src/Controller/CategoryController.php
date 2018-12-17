<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/index", name="category_index", methods="GET")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $category = $repo->findAll();

        return $this->render('admin/category/index.html.twig', [
            'category' => $category
        ]);
    }

    /**
     * @Route("/new", name="category_create", methods="GET|POST")
     */
    public function create(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('admin/category/create.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_edit", methods="GET|POST")
     */
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_index', ['id' => $category->getId()]);
        }

        return $this->render('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_delete", methods="DELETE")
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('admin/delete'.$category->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('category_index');
    }
}
