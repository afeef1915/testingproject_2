<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('WEBLOGSMAINMTLMyLogsBundle:Default:index.html.twig', array('name' => $name));
    }
}
