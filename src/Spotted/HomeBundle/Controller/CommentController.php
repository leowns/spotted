<?php

namespace Spotted\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Spotted\HomeBundle\Entity\Post;
use Spotted\HomeBundle\Entity\Comments;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;

class CommentController extends Controller
{
		/**
     * Shows the Comments
     *
     * @Route("/secured/show_comment", name="show_comment")
     * @Method("POST")
     * @Template("SpottedHomeBundle:Comment:index.html.twig")
     */
	public function ShowAction($postid)
    {
		
		  $em = $this->getDoctrine()->getManager();
		  $query = $em->createQuery(
				'SELECT c
				FROM SpottedHomeBundle:Comments c
				WHERE c.id=:id
				ORDER BY c.date DESC'
			)->setParameter('id', $postid);
			
			$comments=$query->getResult();
	
        return $this->render('SpottedHomeBundle:Comment:index.html.twig', array('comments' => $comments));
		
    }
	/**
     * Creates a new Comment entity.
     *
     * @Route("/", name="post_create")
     * @Method("POST")
     * @Template("SpottedHomeBundle:Comment:index.html.twig")
     */
    public function createAction($postid)
    {
		
		$request = $this->getRequest();
		$comment = new Comments();
		 $em = $this->getDoctrine()->getManager();
				$user = $this->getUser();
				
            
                $dt = new \DateTime();
                $comment->setText($request->request->get('txthint'));
                $comment->setDate($dt);
				$comment->setRead(0);
                $comment->setUser($user);	
				$post = $em->getRepository('SpottedHomeBundle:Post')->find($postid);
				$comment->setPost($post);
                
				// save the comment
				$em->persist($comment);
				$em->flush();

                return $this->redirect($this->generateUrl('spotted_secured_show_comment', array ('postid'    => $comment->getPost()->getId())));
    }
	
}