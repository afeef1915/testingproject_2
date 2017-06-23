<?php

namespace ESERV\MAIN\ActivityBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ActivityBundleActivityLinkService extends Controller {

    private $em;
    private $c;
    private $coreFunction;

    public function __construct(EntityManager $em, Container $c) 
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
    }   
        
  
}