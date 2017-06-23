<?php

namespace ESERV\ReleaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ESERVReleaseBundle:Default:index.html.twig', array('name' => $name));
    }
}
