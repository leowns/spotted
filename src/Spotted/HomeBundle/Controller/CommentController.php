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
use Doctrine\Common\Collections;

class CommentController extends Controller
{
	/**
     * Shows the Comments
     *
     * @Route("/secured/show_comment", name="show_comment")
     * @Method("POST")
     * @Template("SpottedHomeBundle:Comment:index.html.twig")
     */
	public function showAction($postid)
    {
        // Get current user object
        $user = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        // Check if post is from user and if it has unread comments
        $query = $em->createQuery(
            'SELECT p,c
            FROM SpottedHomeBundle:Post p
            JOIN SpottedHomeBundle:Comments c WITH p.id = c.post
            WHERE p.user=:userid
            AND c.rd = 0
            AND p.id=:id'
        )->setParameters(array(
                'userid' => $user->getId(),
                'id'  => $postid,
            ));

        $post=$query->getResult();

//        var_dump(new Collections\ArrayCollection($post));
//        echo '0';

        // If post is from current user => set all comments to read
        if (count($post)> 0)
        {
            $query = $em->createQuery(
                'UPDATE SpottedHomeBundle:Comments c SET c.rd=1
                WHERE c.post=:postid'
            )->setParameter('postid', $postid);

            $query->execute();
        }

        // Get all comments of current post order by date
        $query2 = $em->createQuery(
            'SELECT c
            FROM SpottedHomeBundle:Comments c
            WHERE c.post=:id
            ORDER BY c.date ASC'
        )->setParameter('id', $postid);

        $comments=$query2->getResult();
	
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
				$comment->setRd(0);
                $comment->setUser($user);	
				$post = $em->getRepository('SpottedHomeBundle:Post')->find($postid);
				$comment->setPost($post);
                
				// save the comment
				$em->persist($comment);
				$em->flush();

                return $this->redirect($this->generateUrl('spotted_secured_show_comment', array ('postid'    => $comment->getPost()->getId())));
    }
	
	
	
}