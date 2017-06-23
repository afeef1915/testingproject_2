<?php

namespace ESERV\MAIN\HistoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('ESERVMAINHistoryBundle:Default:index.html.twig', array('name' => $name));
    }

}
