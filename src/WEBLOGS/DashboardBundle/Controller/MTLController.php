<?php

namespace WEBLOGS\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MTLController extends Controller
{
    public function indexAction()
    {
        return $this->render('WEBLOGSDashboardBundle:MTL:index.html.twig', array());
    }
}
