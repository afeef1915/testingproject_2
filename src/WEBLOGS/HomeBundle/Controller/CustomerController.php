<?php

namespace WEBLOGS\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerController extends Controller 
{

    public function indexAction() 
    {  
        return $this->render('WEBLOGSHomeBundle:Customer:index.html.twig');
    }
    
    public function testCustomerAction() 
    {
        die('Customer');
    }
}
