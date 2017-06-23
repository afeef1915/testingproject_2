<?php

namespace ESERV\MAIN\ContactBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\CoreFunctions;

class ContactBundleContactService extends Controller {

    private $em;
    private $c;
    private $coreFunction;

    public function __construct(\Doctrine\ORM\EntityManager $em, \Symfony\Component\DependencyInjection\Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
    } 

}
