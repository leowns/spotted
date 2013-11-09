<?php

namespace Spotted\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SpottedHomeBundle:Default:index.html.twig');
    }

    public function commentAction($id)
    {
        return $this->render('SpottedHomeBundle:Default:comment.html.twig', array('id' => $id));
    }
}
