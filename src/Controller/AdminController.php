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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminController extends AbstractController
{
    /**
    * @Route("/admin", name="admin")
    * @IsGranted("ROLE_ADMIN")
    */
    public function index(ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $numbersArticles = $repo->findAll();

    	$repo = $this->getDoctrine()->getRepository(Articles::class);
    	$articles = $repo->findBy(['category' => ['1', '4', '5', '6', '7']],
                                    ['createdAt' => 'desc'],
                                    10,
                                    0);

        return $this->render('admin/admin_pages/index.html.twig', [
            'numbersArticles' => $numbersArticles,
             'articles' => $articles
        ]);
    }

    /**
    * @Route("/admin/ligue1", name="admin_ligue_1")
    * @IsGranted("ROLE_ADMIN")
    */
    public function categoryLigue1(ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $numbersArticles = $repo->findByCategory('1');

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '1'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/admin_pages/ligue1.html.twig', [
            'articles' => $articles,
            'numbersArticles' => $numbersArticles
           
        ]);
    }

    /**
    * @Route("/admin/actualite", name="admin_actualite")
    * @IsGranted("ROLE_ADMIN")
    */
    public function categoryActualite()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $numbersArticles = $repo->findByCategory('2');

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '2'],
                                     ['createdAt' => 'desc'],
                                     50,
                                     0
        );
        return $this->render('admin/admin_pages/actualite.html.twig', [
            'articles' => $articles,
            'numbersArticles' => $numbersArticles]);
    }

    /**
    * @Route("/admin/blog", name="admin_blog")
    * @IsGranted("ROLE_ADMIN")
    */
    public function categoryBlog()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $numbersArticles = $repo->findByCategory('3');

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '3'],
                                     ['createdAt' => 'desc'],
                                     10,
                                     0
        );
        return $this->render('admin/admin_pages/blog.html.twig', [
            'articles' => $articles,
            'numbersArticles' => $numbersArticles]);
    }

    /**
    * @Route("/admin/etranger", name="admin_etranger")
    * @IsGranted("ROLE_ADMIN")
    */
    public function categoryEtranger()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $numbersArticles = $repo->findByCategory('4');

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '4'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/admin_pages/etranger.html.twig', [
            'articles' => $articles,
            'numbersArticles' => $numbersArticles]);
    }

    /**
    * @Route("/admin/coupedeurope", name="admin_coupe_europe")
    * @IsGranted("ROLE_ADMIN")
    */
    public function categoryCoupedeurope()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $numbersArticles = $repo->findByCategory('5');

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '5'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/admin_pages/coupedeurope.html.twig', [
            'articles' => $articles,
            'numbersArticles' => $numbersArticles]);
    }

    /**
    * @Route("/admin/bleuinternational", name="admin_bleu_international")
    * @IsGranted("ROLE_ADMIN")
    */
    public function categoryBleuinternational()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $numbersArticles = $repo->findByCategory('6');

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '6'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/admin_pages/bleuinternational.html.twig', [
            'articles' => $articles,
            'numbersArticles' => $numbersArticles]);
    }

    /**
    * @Route("/admin/mercato", name="admin_mercato")
    * @IsGranted("ROLE_ADMIN")
    */
    public function categoryMercato()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $numbersArticles = $repo->findByCategory('7');

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findBy(['category' => '7'],
                                     ['createdAt' => 'desc'],
                                     30,
                                     0
        );
        return $this->render('admin/admin_pages/mercato.html.twig', [
            'articles' => $articles,
            'numbersArticles' => $numbersArticles]);
    }

    /**
	* @Route("/admin/new", name="admin_create")
    * @IsGranted("ROLE_ADMIN")
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
    	return $this->render('admin/admin_pages/create.html.twig', [
    		'articles' => $articles,
    		'formArticle' => $form->createView()
    	]);
    }

    /**
    * @Route("/admin/{id}/", name="admin_edit", methods="GET|POST")
    * @IsGranted("ROLE_ADMIN")
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
    	return $this->render('admin/admin_pages/edit.html.twig', [
    		'articles' => $articles,
    		'formArticle' => $form->createView()
    	]);
	}

	/**
	* @Route("/admin/{id}/delete", name="admin_delete")
    * @IsGranted("ROLE_ADMIN")
	*/
	public function delete(Articles $articles, Request $request, ObjectManager $manager)
	{	
		$manager->remove($articles);
		$manager->flush();
		$this->addFlash('success', 'Supprimer avec succés');
		
		return $this->redirectToRoute('admin');
	}

}
