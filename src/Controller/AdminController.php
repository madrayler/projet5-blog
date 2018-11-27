<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;
use App\Entity\Comment;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleRepository;
use Symfony\Component\Form\Createview;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ArticleType;
use App\Form\CommentType;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
    * @Route("/admin", name="admin")
    */
    public function index()
    {
    	$repo = $this->getDoctrine()->getRepository(Articles::class);
    	$articles = $repo->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'articles' => $articles
        ]);
    }

    /**
    * @Route("/connexion", name="admin_login")
    */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error =$authenticationUtils->getLastAuthenticationError();
        $lasUsername = $authenticationUtils->getLastUsername();
        return $this->render('admin/login.html.twig', [
            'last_username' => $lasUsername,
            'error' => $error]);
    }

    /**
    * @Route("/deconnexion", name="admin_logout")
    */
    public function logout()
    {
        return $this->render('admin/logout.html.twig');
    }

    /**
	* @Route("/admin/new", name="admin_create")
	*/
	public function create(Request $request, ObjectManager $manager)
    {
    	$articles = new Articles();
    	$form = $this->createForm(ArticleType::class, $articles);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

        	$articles->setCreatedAt(new \DateTime());
          
            $manager->persist($articles);
            $manager->flush();
            $this->addFlash('success', 'Ajouter avec succés');

            return $this-> redirectToRoute('admin');
        }
    	return $this->render('admin/create.html.twig', [
    		'articles' => $articles,
    		'formArticle' => $form->createView()
    	]);
    }

    /**
    * @Route("/admin/{id}/", name="admin_edit", methods="GET|POST")
    */
    public function edit(Articles $articles, Request $request, ObjectManager $manager)
    {
    	$form = $this->createForm(ArticleType::class, $articles);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($articles);
            $manager->flush();
            $this->addFlash('success', 'Modifier avec succés');

            return $this->redirectToRoute('admin');
        }
    	return $this->render('admin/edit.html.twig', [
    		'articles' => $articles,
    		'formArticle' => $form->createView()
    	]);
	}

	/**
	* @Route("/admin/{id}/", name="admin_delete", methods="DELETE")
	*/
	public function delete(Articles $articles, Request $request, ObjectManager $manager)
	{
		$article = new Articles();
		if ($this->isCsrfTokenValid('delete'. $article->getId(), $request->get('_token')))
		{
			$manager->remove($articles);
			$manager->flush();
			$this->addFlash('success', 'Supprimer avec succés');
		}
		return $this->redirectToRoute('admin');
	}
}
