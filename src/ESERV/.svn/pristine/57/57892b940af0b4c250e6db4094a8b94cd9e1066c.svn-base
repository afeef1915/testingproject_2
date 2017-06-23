<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ESERV\MAIN\Services\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of ESERVRequestListener
 *
 * @author RTripathi
 */

class ESERVRequestListener
{
    protected $container;
    
    public function __construct(ContainerInterface $container) // this is @service_container
    {
        $this->container = $container;
    }
    
    public function onKernelRequest(GetResponseEvent $event)
    {
        $session = $this->container->get('session');
        $userVar = $session->has('user_vars') ? $session->get('user_vars') : array();
        if ($event->isMasterRequest()) {
            if(array_key_exists('person_id', $userVar)){
                $userVar['registered'] = 'N';
                $session->set('user_vars', $userVar); 
            }
            return;
        }

//         $kernel    = $event->getKernel();
//        $request   = $event->getRequest();
//        $container = $this->container;
    }
    
    public function onKernelResponse(FilterResponseEvent $event)
    {
//        echo 'Response!' ; die;
//        $response  = $event->getResponse();
//        $request   = $event->getRequest();
//        $kernel    = $event->getKernel();
//        $container = $this->container;
//
//        switch ($request->query->get('option')) {
//            case 2:
//                $response->setContent('Blah');
//                break;
//
//            case 3:
//                $response->headers->setCookie(new Cookie('test', 1));
//                break;
//        }
    }
}

