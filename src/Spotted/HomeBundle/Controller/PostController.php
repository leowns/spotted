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
     * Filters the Posts
     *
     * @Route("/secured/filters", name="filters")
     * @Method("POST")
     * @Template("SpottedHomeBundle:Post:index.html.twig")
     */
		public function filterAction(Request $request) {
            $user = $this->container->get('security.context')->getToken()->getUser();

		//Filter 1 ist das Geschlecht, eigentlich kein Tag
			$filter1=$request->request->get('filter1');
			$filter2=$request->request->get('filter2');
			
			$em = $this->getDoctrine()->getManager();

		if ($filter1!= '' && $filter2 == '') {
			
			$query1 = $em->createQuery(
				'SELECT p
				FROM SpottedHomeBundle:Post p
				WHERE p.gender=:gender
				ORDER BY p.date DESC'
			)->setParameter('gender', $filter1);
			
			$posts=$query1->getResult();
		
		}
		if ($filter1!='' && $filter2 != '') {
			$query2 = $em->createQuery(
				'SELECT p
				FROM SpottedHomeBundle:Post p
				WHERE p.gender=:gender
				AND p.tags=:id
				ORDER BY p.date DESC'
			)->setParameters(array(
				'gender' => $filter1,
				'id'  => $filter2,
			));
			
			$posts=$query2->getResult();
		
		}
		if ($filter1 =='' && $filter2 != '') {
			$query3 = $em->createQuery(
				'SELECT p
				FROM SpottedHomeBundle:Post p
				WHERE p.tags=:id
				ORDER BY p.date DESC'
			)->setParameter('id', $filter2);
			
			$posts=$query3->getResult();
		}

        if ($filter2 == 'all') {
            $query4 = $em->createQuery(
                'SELECT p
                FROM SpottedHomeBundle:Post p
                ORDER BY p.date DESC');

            $posts=$query4->getResult();
        }
		// $response = new Response(json_encode($posts));
		// $response->headers->set('Content-Type', 'application/json');
		
		return $this->render('SpottedHomeBundle:Post:index.html.twig', array('entities' => $posts, 'userWatchlist'=> $user->getWatchlist()));

	}
	public function ShowAction($postid) {
	
		$em = $this->getDoctrine()->getManager();
		$tags = $em->getRepository('SpottedHomeBundle:Tags')->findAll();
		$userid = $this->getUser()->getId();
		$user= $this->getUser();
		$query = $em->createQuery(
				'SELECT p
				FROM SpottedHomeBundle:Post p
				WHERE p.id=:id'
			)->setParameter('id',$postid);
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
	
	

}