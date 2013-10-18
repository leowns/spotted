<?php

namespace Spotted\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SpottedHomeBundle:Default:index.html.twig', array('name' => $name));
    }
}
