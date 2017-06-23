<?php

namespace ESERV\MAIN\ContactBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ContactBundleContactRoleLogoService extends Controller {

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