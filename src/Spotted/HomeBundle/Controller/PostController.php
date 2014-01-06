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
use Doctrine\Common\Collections;

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

        // Wenn user auf paginator eine neue seite aufruft werden aktuelle filter parameter über GET mitgeteilt
        // falls der user aber einen neuen filter setzt über filter form wernden filter parameter über POST mitgeteilt

        if ($request->query->get('filter1') != null) {
            //Filter 1 ist das Geschlecht, eigentlich kein Tag
            $filter1=$request->query->get('filter1');
        } else {
            //Filter 1 ist das Geschlecht, eigentlich kein Tag
            $filter1=$request->request->get('filter1');
        }

        if ($request->query->get('filter2') != null) {
            $filter2=$request->query->get('filter2');
        } else {
            $filter2=$request->request->get('filter2');
        }

        if ($request->query->get('locationfilter') != null) {
            $locationfilter=$request->query->get('locationfilter');
        } else {
            $locationfilter=$request->request->get('locationfilter');
        }

        // Wenn der User sich auf der Watchlist-Seite befindet müssen in allen Abfragen nur seine Watchlist Posts angezeigt werden
        if ($request->query->get('watchlist') != null) {
            $isWatchlist=$request->query->get('watchlist');
        } else {
            $isWatchlist=$request->request->get('watchlist');
        }

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        $qb->select(array('p','u'))
            ->from('SpottedHomeBundle:Post','p')
            ->join('p.user','u')
            ->orderBy('p.date', 'DESC');

        if ($isWatchlist == 'true') {
            $qb->where('p.id in (:watch)')
                ->setParameter('watch',$user->getWatchlist());
        }

        if ($filter2 != 'all') {
            if ($locationfilter != '') {
                $qb->andWhere('p.location = :location')
                    ->setParameter('location',$locationfilter);
            }
            if ($filter1 != '') {
                $qb->andWhere('u.gender = :gender')
                    ->setParameter('gender',$filter1);
            }

            if ($filter2 != '') {
                $qb->andWhere('p.tags = :tag')
                    ->setParameter('tag',$filter2);
            }
        }


        $paginator  = $this->get('knp_paginator');
        $posts = $paginator->paginate(
            $qb->getQuery(),
            $this->get('request')->query->get('page', 1)/*page number*/,
            2/*limit per page*/
        );
        $posts->setParam('filter1',$filter1);
        $posts->setParam('filter2',$filter2);
        $posts->setParam('locationfilter',$locationfilter);
        $posts->setParam('watchlist',$isWatchlist);

 //       $posts = $qb->getQuery()->getResult();

		// $response = new Response(json_encode($posts));
		// $response->headers->set('Content-Type', 'application/json');

		return $this->render('SpottedHomeBundle:Post:index.html.twig',
            array('entities' => $posts,
                'userWatchlist'=> $user->getWatchlist(),
                'user' => $user
            )
        );
	}

    /**
     * Show single post action
     *
     * @Method("GET")
     * @Template()
     */
    public function showAction($postid) {

        // Get current user object
        $user = $this->container->get('security.context')->getToken()->getUser();

		$em = $this->getDoctrine()->getManager();

        // Get all tags => to display them in new post form
		$tags = $em->getRepository('SpottedHomeBundle:Tags')->findAll();

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



        // Get selected post
        $query = $em->createQuery(
            'SELECT p
            FROM SpottedHomeBundle:Post p
            WHERE p.id=:id'
        )->setParameter('id',$postid);

        $post=$query->getResult();



        // Get all unread comments of current user => to display them in notification popover
		$query2 = $em->createquery(
             'select c from SpottedHomeBundle:Comments c JOIN c.post p WHERE p.user=:userid AND c.rd= 0'
          )->setParameter('userid', $user->getId());

		$notreadcomments=$query2->getResult();

        // Count all unread comments for notification counter
		$notifications = count($notreadcomments);

        return $this->render(
            'SpottedHomeBundle:Default:index.html.twig',
            array(
            'entities' => $post,
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