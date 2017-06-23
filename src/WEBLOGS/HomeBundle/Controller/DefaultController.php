<?php

namespace WEBLOGS\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('WEBLOGSHomeBundle:Default:index.html.twig');
    }

}
