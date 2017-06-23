<?php

namespace WEBLOGS\MAIN\MTL\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('WEBLOGSMAINMTLDashboardBundle:Default:index.html.twig', array('name' => $name));
    }
}
