<?php

namespace Spotted\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Spotted\HomeBundle\Entity\Post;
use Spotted\HomeBundle\Entity\Watchlist;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;


class WatchlistController extends Controller
{
	/**
     * Lists all Watchlist entities.
     *
     * @Route("/secured/watchlist", name="spotted_secured_watchlist")
     * 
     * @Template()
     */ 
	public function indexAction() 
	{
		$em = $this->getDoctrine()->getManager();
		$tags = $em->getRepository('SpottedHomeBundle:Tags')->findAll();
		$userid = $this->getUser()->getId();
		$user= $this->getUser();
		$query = $em->createQuery(
				'SELECT p
				FROM SpottedHomeBundle:Post p
				WHERE p.id in (:userid)
				order by p.date desc'
			)->setParameter('userid',$user->getWatchlist());
		$query2 = $em->createquery(
				 'select c from SpottedHomeBundle:Comments c JOIN c.post p WHERE p.user=:userid AND c.rd= 0'
			  )->setParameter('userid', $userid);
			
        $posts=$query->getResult();
		$notreadcomments=$query2->getResult();
	    $notifications = count($notreadcomments);

        return $this->render(
            'SpottedHomeBundle:Default:index.html.twig',
            array(
            'entities' => $posts,
            'userWatchlist' => $user->getWatchlist(),
			'tags' => $tags,
            'confirmed' => false,
            'user' => $user,
			'comments' => $notreadcomments,
            'notifications' => $notifications
            )
        );
	}

	public function addAction($postid)
		{
			$watchlist = new Watchlist();
			 $em = $this->getDoctrine()->getManager();
			
			
			$query = $em->createQuery(
					'SELECT p
					FROM SpottedHomeBundle:Post  p
					WHERE p.id=:id'
					)->setParameter('id', $postid);
					
				$post=$query->getSingleResult();
					$user = $this->getUser();
					$watchlist->setUser($user);
					$watchlist->setPost($post);
					// save  watchlist
					$em->persist($watchlist);
					$em->flush();

					return $this->redirect($this->generateUrl('spotted_secured_homepage'));
		
		}
		
	public function delAction($postid)
		{
			
             $em = $this->getDoctrine()->getManager();
             $userid = $this->getUser()->getId();
			$query = $em->createQuery(
				'SELECT w
				FROM SpottedHomeBundle:Watchlist w
				WHERE w.user=:userid
				AND w.post=:postid
				'
			)->setParameters(array(
				'userid' => $userid,
				'postid'  => $postid,
			));
			
			$watchlist=$query->getSingleResult();


            // remove  watchlist
            $em->remove($watchlist);
            $em->flush();

            return $this->redirect($this->generateUrl('spotted_secured_watchlist'));
		
		}

	
}
