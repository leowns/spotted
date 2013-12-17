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
	
	 public function loginAction()
	{
		
		if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
			return $this->redirect($this->generateUrl('spotted_home_homepage'));
		}
	}
	
	/**
     * Lists all Post entities.
     *
     * @Route("/home", name="index")
     * @Method("GET")
     * @Template()
     */ 
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('SpottedHomeBundle:Tags')->findAll();
		// $query = $em->createquery(
				 // 'select p
					// from spottedhomebundle:post p
					// order by p.date desc'
			 // );
//		$query2 = $em->createQuery(
//			'SELECT p.gender,p.text,p.date,l.name as location,t.name as tag
//			FROM SpottedHomeBundle:Post p
//			JOIN p.location l
//			JOIN p.tags t
//			WHERE l.id = p.location
//			AND t.id= p.tags
//			ORDER BY p.date DESC'
//		);
//
//		$posts= $query2->getResult();

        $posts = $em->getRepository('SpottedHomeBundle:Post')->findAll();



		//$user = $this->getUser();

		// $entity = new Post();
        // $form   = $this->createCreateForm($entity);
		

        return array(
            'entities' => $posts,
			'tags' => $tags,
			
        );
		
    }

    public function commentAction($id)
    {
        return $this->render('SpottedHomeBundle:Default:comment.html.twig', array('id' => $id));
		
    }
	
	public function filterAction(Request $request) {
		// Filter 1 ist das Geschlecht, eigentlich kein Tag
			$filter1=$request->request->get('filter1');
			$filter2=$request->request->get('filter2');
		
		if ($filter1 == 8) 
		{		
				$gschlecht='w';
		}
		else 
		{
				$geschlecht='m';
		}
		$em = $this->getDoctrine()->getManager();
		
		if ($filter1!= '' && $filter2 == '') {
			
			$query1 = $em->createQuery(
				'SELECT p.geschlecht,p.text,p.date,l.name,t.bezeichnung
				FROM SpottedHomeBundle:Post p
				JOIN p.location l
				JOIN p.tags t
				WHERE l.id = p.location
				AND t.id= p.tags
				AND p.geschlecht=:geschlecht
				ORDER BY p.date DESC'
			)->setParameter('geschlecht', $geschlecht);
			
			$posts=$query1->getResult();
		
		}
		if ($filter1!='' && $filter2 != '') {
			$query2 = $em->createQuery(
				'SELECT p.geschlecht,p.text,p.date,l.name,t.bezeichnung
				FROM SpottedHomeBundle:Post p
				JOIN p.location l
				JOIN p.tags t
				WHERE l.id = p.location
				AND t.id= p.tags
				AND p.geschlecht=:geschlecht
				AND p.tags=:id
				ORDER BY p.date DESC'
			)->setParameters(array(
				'geschlecht' => $geschlecht,
				'id'  => $filter2,
			));
			
			$posts=$query2->getResult();
		
		}
		if ($filter1 =='' && $filter2 != '') {
			$query3 = $em->createQuery(
				'SELECT p.geschlecht,p.text,p.date,l.name,t.bezeichnung
				FROM SpottedHomeBundle:Post p
				JOIN p.location l
				JOIN p.tags t
				WHERE l.id = p.location
				AND t.id= p.tags
				AND p.tags=:id
				ORDER BY p.date DESC'
			)->setParameter('id', $filter2);
			
			$posts=$query3->getResult();
		
		}
		 $tags = $em->getRepository('SpottedHomeBundle:Tags')->findAll();
		return $this->render('SpottedHomeBundle:Default:index.html.twig', array('entities' => $posts,'tags' => $tags));

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
		$loc=$request->request->get('location');
		
		$query = $em->createQuery(
				'SELECT l
				FROM SpottedHomeBundle:Location  l
				WHERE l.name=:name'
				)->setParameter('name', $loc);
				
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
                $post->setGeschlecht($request->request->get('geschlecht'));
				// save the post
				$em->persist($post);
				$em->flush();

                return $this->redirect($this->generateUrl('spotted_home_homepage'));
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
	$query = $em->createQuery('SELECT l from SpottedHomeBundle:Location l');
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
