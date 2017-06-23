<?php

namespace WEBLOGS\CORE\Services\Twig;

use ESERV\MAIN\Services\Twig\ESERVExtension;

class WEBLOGSExtension extends ESERVExtension 
{

    public function getFunctions() 
    {
        $this->eservFunctions['getCustomers'] = new \Twig_Function_Method($this, 'getCustomers');        
        return $this->eservFunctions;
    }

    public function getCustomers() 
    {
        $customers = $this->c->get('weblogs_main_services')->getCustomersByLoggedInUser();
        
        if(count($customers) > 1){
            return $customers;
        }else{
            return false;
        }
    }
    
}
