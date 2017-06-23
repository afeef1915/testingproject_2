<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ESERV\MAIN\ActivityBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

/**
 * Description of ActivityMediaService
 *
 * @author RTripathi
 */
class ActivityMediaService extends Controller {
    
    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
    }
    
    public function getFilePathForEmailAttachment($activityMediaId) {
        $activityMedia = $this->em->getRepository('ESERVMAINActivityBundle:ActivityMedia')->find($activityMediaId);
        if($activityMedia) {
            $res = $this->coreFunction->createFile($activityMedia->getContent(), array(
                'file_name' => $activityMedia->getFileName(),
                'extension' => $activityMedia->getFileExtension(),
            ));
            if ($res['success'] === true) {
                return $res['url'];
            }
        }
        return null;
    }
    
}
