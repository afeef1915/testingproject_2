<?php

namespace ESERV\MAIN\QualificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ESERVMAINQualificationBundle:Default:index.html.twig', array('name' => $name));
    }
}
