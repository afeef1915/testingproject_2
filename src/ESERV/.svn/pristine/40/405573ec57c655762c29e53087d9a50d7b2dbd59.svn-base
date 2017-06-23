<?php

namespace ESERV\MAIN\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\Container;

class ESERVSoap extends Controller {

    private $c;

    public function __construct(Container $c) 
    {
        $this->c = $c;
    }

    public function startSoapServer($file_name, $service_name) 
    {
        try {
            $path = $this->getWsdlPath();
            $server = new \SoapServer($path . $file_name);
            $server->setObject($this->c->get($service_name));

            $response = new Response();
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');

            ob_start();
            $server->handle();
            $response->setContent(ob_get_clean());

            return $response;
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong.' . $e->getMessage(), $e->getCode());
        }
    }

    public function soapClient($file_name) 
    {
        #ini_set("soap.wsdl_cache_enabled", 0);
        try {
            $path = $this->getWsdlPath();
            $client = new \Soapclient($path . $file_name, array('trace' => 1, 'login' => 'ecook_centre', 'password' => 'mymerlin'));            
             #var_dump($client->__getFunctions()); die;
        return $client;
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong.' . $e->getMessage(), $e->getCode());
        }
        
    }

    public function getWsdlPath() 
    {
        return $this->c->getParameter('domain_name') . '/../common/ws/';
    }
    
    public function setSoapHeaders()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        return $response;
    }

}
