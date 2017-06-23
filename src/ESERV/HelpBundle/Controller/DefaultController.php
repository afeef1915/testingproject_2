<?php

namespace ESERV\HelpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('ESERVHelpBundle:Default:index.html.twig', array('name' => $name));
    }

}
