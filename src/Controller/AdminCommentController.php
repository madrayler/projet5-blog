<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\BrowserKit\Response;
use App\Repository\CommentRepository;
use App\Entity\Comment;

class AdminCommentController extends AbstractController
{
    /**
     * @Route("/admin/comment", name="admin_comment_index")
     */
    public function index()
    {
    	$repo = $this->getDoctrine()->getRepository(Comment::class);
    	$comments = $repo->findAll();
        return $this->render('admin/admin_comment/index.html.twig', [
            'comments' => '$comments'
        ]);
    }

    /**
	* @Route("/admin/comments/{id}/delete", name="admin_comment_delete", methods="DELETE")
	*/
	public function delete(Comment $comment, Request $request, ObjectManager $manager)
	{
		$comment = new Comment();
		if ($this->isCsrfTokenValid('delete'. $article->getId(), $request->get('_token')))
		{
			$manager->remove($comment);
			$manager->flush();
			$this->addFlash('success', 'Supprimer avec succés');
		}
		return $this->redirectToRoute('admin_comment_index');
	}
}
