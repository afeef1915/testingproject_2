<?php

namespace ESERV\MAIN\CpdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ESERVMAINCpdBundle:Default:index.html.twig', array('name' => $name));
    }
}
