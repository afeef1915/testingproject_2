<?php

namespace ESERV\MAIN\SoapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function soapAction($service, $file)
    {
        $eserv_soap = $this->get('eserv_soap');
        $server = $eserv_soap->startSoapServer($file, $service);
        return $server;
    }

}
