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
     * Lists all Post entities.
     *
     * @Route("/home", name="index")
     * @Method("GET")
     * @Template()
     */ 
    public function indexAction($confirmed = false)
    {

        $user = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('SpottedHomeBundle:Tags')->findAll();
		
		 $query = $em->createquery(
				 'select p
					from SpottedHomeBundle:Post p
					order by p.date desc'
			  );
		$query2 = $em->createquery(
				 'select c from SpottedHomeBundle:Comments c JOIN c.post p WHERE p.user=:userid AND c.rd= 0'
			  )->setParameter('userid', $user->getId());

	$posts= $query->getResult();
	$notreadcomments=$query2->getResult();
	$notifications = count($notreadcomments);

        //$posts = $em->getRepository('SpottedHomeBundle:Post')->findAll();



		//$user = $this->getUser();

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
                $post->setGender($request->request->get('geschlecht'));
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

	/**
    * Creates a user entity from fos-facebook login
    *
    * @param Post $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createFacebookUser ($user)
    {
//       $em = $this->getDoctrine()->getManager();
//
  //      $tags = $em->getRepository('SpottedHomeBundle:Tags')->findAll();
	//	 $query = $em->createQuery(
		//		 'INSERT INTO User
			//	 (ID, username, email) VALUES
				// (NULL, 'fb11','123@123.com')'
	//		 );
			
	//	$entity= $query->getResult();


	}
}
