<?php

namespace Spotted\FBLoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SpottedFBLoginBundle:Default:index.html.twig', array('name' => $name));
    }
}
