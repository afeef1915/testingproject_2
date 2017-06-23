<?php

namespace ESERV\MAIN\ApplicationCodeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('ESERVMAINApplicationCodeBundle:Default:index.html.twig', array('name' => $name));
    }

}
