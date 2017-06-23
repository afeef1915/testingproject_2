<?php

namespace ESERV\MAIN\ProfileBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;


class ProfileBundleMmNewsService extends Controller {
    
    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c) 
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $this->get('core_function_services');
        $this->dbCore = $this->get('db_core_function_services');
    }    
    
}
