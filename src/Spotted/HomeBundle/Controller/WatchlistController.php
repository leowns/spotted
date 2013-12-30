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
	
	public function indexAction() 
	{
		$em = $this->getDoctrine()->getManager();
		$userid = $this->getUser()->getId();
		$user= $this->getUser();
		$query = $em->createQuery(
				'SELECT w
				FROM SpottedHomeBundle:Watchlist w
				WHERE w.user=:userid'
			)->setParameter('userid', $userid);
			
			$posts=$query->getResult();
			
			return $this->render('SpottedHomeBundle:Watchlist:index.html.twig', array('entities' => $posts));

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

	
}
