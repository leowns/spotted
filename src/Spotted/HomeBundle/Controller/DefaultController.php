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

class DefaultController extends Controller
{
	
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
		// $query = $em->createQuery(
				// 'SELECT p
				// FROM SpottedHomeBundle:Post p
				// ORDER BY p.date DESC'
			// );
		$query2 = $em->createQuery(
			'SELECT p.geschlecht,p.text,p.date,l.name,t.bezeichnung
			FROM SpottedHomeBundle:Post p
			JOIN p.user u
			JOIN p.location l
			JOIN p.tags t
			WHERE p.user = u.id
			AND l.id = p.location
			AND t.id= p.tags
			ORDER BY p.date DESC'
		);

		$posts= $query2->getResult();

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
		$posttags= new Posttags();
		$location= new Location();
        // $form = $this->createCreateForm($post);
        // $form->handleRequest($request);

      //  if ($form->isValid()) {
               $em = $this->getDoctrine()->getManager();
                // get current User
				$user = $this->getUser();
                // create new Location
                 $location->setName($request->request->get('location'));
                $dt = new \DateTime();
                $post->setText($request->request->get('text'));
                $post->setDate($dt);
                $post->setUser($user);
				//$post->setTag
				$tags = $em->getRepository('SpottedHomeBundle:Tags')->find($request->request->get('tags'));
				$post->setTags($tags);
                $post->setGeschlecht($request->request->get('geschlecht'));
                // setLocation just sets sets the ID of the Location not the name
                $post->setLocation($location);
                // get the PostId to set it for the posttag entity bc its a many to many Relation same with Tags
                



                $em->persist($post);
                $em->persist($location);
				$em->flush();

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
	
	/**
    * Creates a user entity from fos-facebook login
    *
    * @param Post $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createFacebookUser $user)
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
