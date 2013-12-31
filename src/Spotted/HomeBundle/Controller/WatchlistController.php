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
				'SELECT w
				FROM SpottedHomeBundle:Watchlist w
				WHERE w.user=:userid'
			)->setParameter('userid', $userid);
			
			$posts=$query->getResult();
			
			return array(
            'entities' => $posts,
			'tags' => $tags,
            'user' => $user
			
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
					$post->setOnwatchlist(1);
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
			 
			$query = $em->createQuery(
					'SELECT p
					FROM SpottedHomeBundle:Post p
					WHERE p.id=:id'
					)->setParameter('id', $postid);
					
				$post=$query->getSingleResult();
				// set onwatchlist to 0->false
					$post->setOnwatchlist(0);
					// remove  watchlist
					$em->remove($watchlist);
					$em->flush();

					return $this->redirect($this->generateUrl('spotted_secured_watchlist'));
		
		}

	
}