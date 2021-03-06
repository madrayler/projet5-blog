<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;
use App\Entity\Comment;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticlesRepository;
use Symfony\Component\Form\Createview;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ArticleType;
use App\Form\CommentType;
use Symfony\Component\BrowserKit\Response;
use Knp\Component\Pager\PaginatorInterface;

class BlogController extends AbstractController 
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $dernierArticle = $repo->findBy(['category' => ['1', '4', '5', '6', '7']],
                                           ['createdAt' => 'desc'],
                                           1,
                                           0
        );

        $listArticles = $repo->findBy(['category' => ['1', '4', '5', '6', '7']],
                                  ['createdAt' => 'desc'],
                                  4,
                                  1
        );

        $restArticles = $repo->findBy(['category' => ['1', '4', '5', '6', '7']],
                                  ['createdAt' => 'desc'],
                                  3,
                                  5
        );

        $ancienArticles = $repo->findBy(['category' => ['1', '4', '5', '6', '7']],
                                  ['createdAt' => 'desc'],
                                  15,
                                  8
        );

        $actualite = $repo->findBy(['category' => '2'],
                                  ['createdAt' => 'desc'],
                                  35
        );
        
        return $this->render('blog/journal/index.html.twig', [
            'dernierArticle' => $dernierArticle,
            'listArticles' => $listArticles,
            'restArticles' => $restArticles,
            'ancienArticles' => $ancienArticles,
            'actualite' => $actualite
        ]);
    }

    /**
     * @Route("/ligue1", name="ligue_un")
     */
    public function ligue1()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $dernierArticle = $repo->findBy(['category' => '1'],
                                  ['createdAt' => 'desc'],
                                  1
        );

        $listArticles = $repo->findBy(['category' => '1'],
                                  ['createdAt' => 'desc'],
                                  4,
                                  1
        );

        $restArticles = $repo->findBy(['category' => '1'],
                                  ['createdAt' => 'desc'],
                                  3,
                                  5
        );

        $ancienArticles = $repo->findBy(['category' => '1'],
                                  ['createdAt' => 'desc'],
                                  15,
                                  8
        );

        $actualite = $repo->findBy(['category' => '2'],
                                  ['createdAt' => 'desc'],
                                  30
        );
        
        return $this->render('blog/journal/index.html.twig', [
            'dernierArticle' => $dernierArticle,
            'listArticles' => $listArticles,
            'restArticles' => $restArticles,
            'ancienArticles' => $ancienArticles,
            'actualite' => $actualite
        ]);
    }

    /**
     * @Route("/etranger", name="etranger")
     */
    public function etranger()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $dernierArticle = $repo->findBy(['category' => '4'],
                                  ['createdAt' => 'desc'],
                                  1
        );

        $listArticles = $repo->findBy(['category' => '4'],
                                  ['createdAt' => 'desc'],
                                  4,
                                  1
        );

        $restArticles = $repo->findBy(['category' => '4'],
                                  ['createdAt' => 'desc'],
                                  3,
                                  5
        );

        $ancienArticles = $repo->findBy(['category' => '1'],
                                  ['createdAt' => 'desc'],
                                  15,
                                  8
        );

        $actualite = $repo->findBy(['category' => '2'],
                                  ['createdAt' => 'desc'],
                                  30
        );
        
        return $this->render('blog/journal/index.html.twig', [
            'dernierArticle' => $dernierArticle,
            'listArticles' => $listArticles,
            'restArticles' => $restArticles,
            'ancienArticles' => $ancienArticles,
            'actualite' => $actualite
        ]);
    }

    /**
     * @Route("/coupedeurope", name="coupe_europe")
     */
    public function coupedeurope()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $dernierArticle = $repo->findBy(['category' => '5'],
                                  ['createdAt' => 'desc'],
                                  1
        );

        $listArticles = $repo->findBy(['category' => '5'],
                                  ['createdAt' => 'desc'],
                                  4,
                                  1
        );

        $restArticles = $repo->findBy(['category' => '5'],
                                  ['createdAt' => 'desc'],
                                  3,
                                  5
        );

        $ancienArticles = $repo->findBy(['category' => '1'],
                                  ['createdAt' => 'desc'],
                                  15,
                                  8
        );

        $actualite = $repo->findBy(['category' => '2'],
                                  ['createdAt' => 'desc'],
                                  30
        );
        
        return $this->render('blog/journal/index.html.twig', [
            'dernierArticle' => $dernierArticle,
            'listArticles' => $listArticles,
            'restArticles' => $restArticles,
            'ancienArticles' => $ancienArticles,
            'actualite' => $actualite
        ]);
    }

    /**
     * @Route("/bleuinternational", name="bleu_international")
     */
    public function bleuinternational()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $dernierArticle = $repo->findBy(['category' => '6'],
                                  ['createdAt' => 'desc'],
                                  1
        );

        $listArticles = $repo->findBy(['category' => '6'],
                                  ['createdAt' => 'desc'],
                                  4,
                                  1
        );

        $restArticles = $repo->findBy(['category' => '6'],
                                  ['createdAt' => 'desc'],
                                  3,
                                  5
        );

        $ancienArticles = $repo->findBy(['category' => '1'],
                                  ['createdAt' => 'desc'],
                                  15,
                                  8
        );

        $actualite = $repo->findBy(['category' => '2'],
                                  ['createdAt' => 'desc'],
                                  30
        );
        
        return $this->render('blog/journal/index.html.twig', [
            'dernierArticle' => $dernierArticle,
            'listArticles' => $listArticles,
            'restArticles' => $restArticles,
            'ancienArticles' => $ancienArticles,
            'actualite' => $actualite
        ]);
    }

    /**
     * @Route("/mercato", name="mercato")
     */
    public function mercato()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $dernierArticle = $repo->findBy(['category' => '7'],
                                  ['createdAt' => 'desc'],
                                  1
        );

        $listArticles = $repo->findBy(['category' => '7'],
                                  ['createdAt' => 'desc'],
                                  4,
                                  1
        );

        $restArticles = $repo->findBy(['category' => '7'],
                                  ['createdAt' => 'desc'],
                                  3,
                                  5
        );

        $ancienArticles = $repo->findBy(['category' => '1'],
                                  ['createdAt' => 'desc'],
                                  15,
                                  8
        );

        $actualite = $repo->findBy(['category' => '2'],
                                  ['createdAt' => 'desc'],
                                  30
        );
        
        return $this->render('blog/journal/mercato.html.twig', [
            'dernierArticle' => $dernierArticle,
            'listArticles' => $listArticles,
            'restArticles' => $restArticles,
            'ancienArticles' => $ancienArticles,
            'actualite' => $actualite
        ]);
    }


    /**
    * @Route("/blog/{id}", name="blog_show")
    */
    public function show(Articles $articles, Request $request, ObjectManager $manager)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($articles)
                    ->setAuthor($this->getUser());       
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $articles->getId()]);
        }

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $actualite = $repo->findBy(['category' => '2'],
                                  ['createdAt' => 'desc'],
                                  35
        );

    	return $this->render('blog/journal/show.html.twig', [
            'articles' => $articles,
            'actualite' => $actualite,
            'commentForm' => $form->createView()
            ]);
    }

    /**
     * @Route("/blogperso", name="blogperso")
     */
    public function blogperso(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articlesBlog = $repo->findBy(['category' => '3'],
                                  ['createdAt' => 'desc'],
                                  40,
                                  0
                            
        );
     
        return $this->render('blog/journal/blogperso.html.twig', [
            'articlesBlog' => $articlesBlog
        ]);
    }

    /**
    * @Route("/blogperso/{id}", name="blog_perso_show")
    */
    public function blog_show(Articles $articles, Request $request, ObjectManager $manager)
    {
      $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($articles)
                    ->setAuthor($this->getUser());
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_perso_show', ['id' => $articles->getId()]);
        }

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articlesBlog = $repo->findBy(['category' => '3'],
                                  ['createdAt' => 'desc'],
                                  40,
                                  0
                            
        );

      return $this->render('blog/journal/blog_perso_show.html.twig', [
            'articles' => $articles,
            'articlesBlog' => $articlesBlog,
            'commentForm' => $form->createView()
            ]);
    }

    /**
    * @Route("/bons_plans", name="bons_plans")
    */
    public function bonsPlans()
    {
      $repo = $this->getDoctrine()->getRepository(Articles::class);
        $actualite = $repo->findBy(['category' => '2'],
                                  ['createdAt' => 'desc'],
                                  35
        );

      return $this->render('blog/journal/bons_plans.html.twig', [
            'actualite' => $actualite
            ]);
    }

}
