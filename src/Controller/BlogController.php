<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;
use App\Entity\Comment;
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
    * @var ArticlesRepository
    */
    private $repository;
    public function _construct(ArticlesRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/blog", name="blog")
     */
    public function index(PaginatorInterface $paginator, Request $request):Response
    {
        $articles = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
            5
        );
     
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles,
            'pagination' => $pagination
        ]);
    }
/*
    /**
    * @Route("/home", name="home")
    */
   /* public function home()
    {
    	return $this->render('blog/home.html.twig');
    }*/

    /**
    * @Route("/blog/new", name="blog_create")
    * @Route("/blog/{id}/edit", name="blog_edit")
    */
    public function form(Articles $articles = null, Request $request, ObjectManager $manager)
    {
        if(!$articles){
            $articles = new Articles();
        }
        
       $form = $this->createForm(ArticleType::class, $articles);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(!$articles->getId()){
                $articles->setCreatedAt(new \DateTime());
            }

            $manager->persist($articles);
            $manager->flush();

            return $this-> redirectToRoute('blog_show', ['id' => $articles->getId()]);
        }
        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $articles->getId() !== null
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
                    ->setArticle($articles);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $articles->getId()]);
        }

    	return $this->render('blog/show.html.twig', [
            'articles' => $articles,
            'commentForm' => $form->createView()
            ]);
    }

}
