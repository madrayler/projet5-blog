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
    	$articles = $repo->findBy(['category' => ['1', '4', '5', '6', '7']],
                                    ['createdAt' => 'desc'],
                                    10,
                                    0);

        return $this->render('admin/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
    * @Route("/admin/ligue1", name="admin_ligue_1")
    */
    public function categoryLigue1()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '1'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/ligue1.html.twig', [
            'articles' => $articles]);
    }

    /**
    * @Route("/admin/actualite", name="admin_actualite")
    */
    public function categoryActualite()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '2'],
                                     ['createdAt' => 'desc'],
                                     50,
                                     0
        );
        return $this->render('admin/actualite.html.twig', [
            'articles' => $articles]);
    }

    /**
    * @Route("/admin/blog", name="admin_blog")
    */
    public function categoryBlog()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '3'],
                                     ['createdAt' => 'desc'],
                                     10,
                                     0
        );
        return $this->render('admin/blog.html.twig', [
            'articles' => $articles]);
    }

    /**
    * @Route("/admin/etranger", name="admin_etranger")
    */
    public function categoryEtranger()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '4'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/etranger.html.twig', [
            'articles' => $articles]);
    }

    /**
    * @Route("/admin/coupedeurope", name="admin_coupe_europe")
    */
    public function categoryCoupedeurope()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '5'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/coupedeurope.html.twig', [
            'articles' => $articles]);
    }

    /**
    * @Route("/admin/bleuinternational", name="admin_bleu_international")
    */
    public function categoryBleuinternational()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '6'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/bleuinternational.html.twig', [
            'articles' => $articles]);
    }

    /**
    * @Route("/admin/mercato", name="admin_mercato")
    */
    public function categoryMercato()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '7'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/mercato.html.twig', [
            'articles' => $articles]);
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
