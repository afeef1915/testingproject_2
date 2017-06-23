<?php

namespace ESERV\MAIN\WizardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('ESERVMAINWizardBundle:Default:index.html.twig', array('name' => $name));
    }

}
