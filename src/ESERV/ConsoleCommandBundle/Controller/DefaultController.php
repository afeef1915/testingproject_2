<?php

namespace ESERV\ConsoleCommandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ESERVConsoleCommandBundle:Default:index.html.twig', array('name' => $name));
    }
}
