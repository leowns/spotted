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


class DefaultController extends Controller
{

    public function landingAction() {
        return $this->render('SpottedHomeBundle:Default:landing.html.twig');
    }

	/**
     * Show index action
     *
     * @Route("/home", name="index")
     * @Method("GET")
     * @Template()
     */ 
    public function indexAction($confirmed = false)
    {
        // Get current user object
        $user = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        // Get all tags => to display them in new post form
        $tags = $em->getRepository('SpottedHomeBundle:Tags')->findAll();

        // Get all posts order by date to display them on main page
        $query = $em->createquery(
             'select p
                from SpottedHomeBundle:Post p
                order by p.date desc'
        );

        $paginator  = $this->get('knp_paginator');
        $posts = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
           10/*limit per page*/
        );


       // $posts= $query->getResult();

        // Get all unread comments of current user => to display them in notification popover
        $query2 = $em->createquery(
            'select c from SpottedHomeBundle:Comments c JOIN c.post p WHERE p.user=:userid AND c.rd= 0 order by c.date DESC'
        )->setParameter('userid', $user->getId());

        $notreadcomments=$query2->getResult();

        // Count all unread comments for notification counter
        $notifications = count($notreadcomments);


		// $entity = new Post();
        // $form   = $this->createCreateForm($entity);

        return array(
            'entities' => $posts,
            'userWatchlist' => $user->getWatchlist(),
			'tags' => $tags,
            'confirmed' => $confirmed,
            'user' => $user,
			'comments' => $notreadcomments,
            'notifications' => $notifications
        );
		
    }

    public function commentAction($id)
    {
        return $this->render('SpottedHomeBundle:Default:comment.html.twig', array('id' => $id));
		
    }
	
	public function contactAction ($postid) {
		
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
				'SELECT p
				FROM SpottedHomeBundle:Post  p
				WHERE p.id=:id'
				)->setParameter('id', $postid);
				
			$user = $this->getUser();
			$post = $query->getSingleResult();
			$request = $this->getRequest();
			$message=$request->request->get('txtmail');
			$user2=$post->getUser();
			
			$message = \Swift_Message::newInstance()
				->setSubject('Kontaktanfrage Spotted ZHAW')
				->setFrom($user->getEmail())
				->setTo($user2->getEmail())
				->setBody($this->renderView('SpottedHomeBundle:Default:contactEmail.txt.twig', array('user' => $user,'message' => $message)));
			$this->get('mailer')->send($message);
			return $this->redirect($this->generateUrl('spotted_secured_homepage'));

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
		$post = new Post();
		//$location= new Location();
        // $form = $this->createCreateForm($post);
        // $form->handleRequest($request);
		$em = $this->getDoctrine()->getManager();
		$loc=$request->request->get('hidden');
		
		$query = $em->createQuery(
				'SELECT l
				FROM SpottedHomeBundle:Location  l
				WHERE l.id=:id'
				)->setParameter('id', $loc);
				
			$location=$query->getSingleResult();

      //  if ($form->isValid()) {
                // get current User
				$user = $this->getUser();
                // get the Location
             //   $location=$em->getRepository('SpottedHomeBundle:Location')->find($request->request->get('location'));
                $dt = new \DateTime();
                $post->setText($request->request->get('text'));
                $post->setDate($dt);
                $post->setUser($user);
				$post->setLocation($location);
				// get the Tag
				$tags = $em->getRepository('SpottedHomeBundle:Tags')->find($request->request->get('tags'));
				$post->setTags($tags);
				// save the post
				$em->persist($post);
				$em->flush();

                return $this->redirect($this->generateUrl('spotted_secured_homepage'));
    //   }

        // return array(
            // 'entity' => $post,
           // // 'form'   => $form->createView(),
        // );
    }




	/**
    * Creates a form to create a Post entity.
    *
    * @param Post $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Post $post)
    {
        $form = $this->createForm(new PostType(), $post, array(
            'action' => $this->generateUrl('spotted_homeform_submission'),
            'method' => 'POST',
        ));

       // $form->add('submit', 'submit', array('label' => 'Finde deinen Flirt!'));

        return $form;
    }
	


	public function listlocationsAction() {
	
	$em = $this->getDoctrine()->getManager();
	// $location = $em->getRepository('SpottedHomeBundle:Location')->findAll();
	$query = $em->createQuery('SELECT l.id,l.name,l.street,c.name As city,c.zip from SpottedHomeBundle:Location l JOIN l.city c WHERE l.city=c.id');
	$location = $query->getArrayResult(); 
	$response = new Response(json_encode($location));
	$response->headers->set('Content-Type', 'application/json');
	// var_dump($location);

	return $response;
	

	}

}
