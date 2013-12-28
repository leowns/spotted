<?php

namespace Spotted\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Spotted\HomeBundle\Entity\Post;
use Spotted\HomeBundle\Form\PostType;
use Spotted\HomeBundle\Entity\Posttags;
use Spotted\HomeBundle\Entity\Tags;
use Spotted\HomeBundle\Entity\Location;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;

class PostController extends Controller
{
		/**
     * Shows the Comments
     *
     * @Route("/secured/show_comment", name="show_comment")
     * @Method("POST")
     * @Template("SpottedHomeBundle:Comment:index.html.twig")
     */
	public function commentAction($postid)
    {
		  $em = $this->getDoctrine()->getManager();
		  $query = $em->createQuery(
				'SELECT c
				FROM SpottedHomeBundle:Comment c
				WHERE c.id=:id
				ORDER BY c.date DESC'
			)->setParameter('id', $postid);
			
			$comments=$query->getResult();
	
        return $this->render('SpottedHomeBundle:Comment:index.html.twig', array('comments' => $comments));
		
    }
	/**
     * Creates a new Post entity.
     *
     * @Route("/", name="post_create")
     * @Method("POST")
     * @Template("SpottedHomeBundle:Default:index.html.twig")
     */
    public function createAction(Request $request)
    {
		$comment = new Comment();
		 $em = $this->getDoctrine()->getManager();
				$user = $this->getUser();
            
                $dt = new \DateTime();
                $comment->setText($request->request->get('hint'));
                $comment->setDate($dt);
                $comment->setUser($user);	
				// get the Tag
				$post = $em->getRepository('SpottedHomeBundle:Tags')->find($request->request->get('postid'));
				$comment->setTags($post);
                $post->setGender($request->request->get('geschlecht'));
				// save the post
				$em->persist($comment);
				$em->flush();

                return $this->redirect($this->generateUrl('spotted_secured_show_comment'));
    }
	
	
	
	
	
	

}