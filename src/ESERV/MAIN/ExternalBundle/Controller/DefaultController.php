<?php

namespace ESERV\MAIN\ExternalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('ESERVMAINExternalBundle:Default:index.html.twig', array('name' => $name));
    }

}
