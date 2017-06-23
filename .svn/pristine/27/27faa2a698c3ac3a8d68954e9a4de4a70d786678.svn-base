<?php

namespace WEBLOGS\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
//use Security\UserBundle\Services\UserBundleConstants;

class CustomerController extends Controller
{
    public function indexAction()
    {
        //redirecting to the home page if the cc is already set        
        if(!empty($this->get('session')->get('cc'))){
            return new RedirectResponse($this->get('session')->get('_security.main.target_path'));
        }      
        $customers = $this->container->get('weblogs_main_services')->getCustomersByLoggedInUser();   
                
        if(count($customers) == 1){            
            $this->get('session')->set('cc', $customers[0]['b64']);  
            return new RedirectResponse($this->get('session')->get('_security.main.target_path'));
        }else if(count($customers) > 1){
            return $this->render('WEBLOGSDashboardBundle:Customer:index.html.twig', array(
                'customers' => $customers
            ));
        }else{
            throw new \Exception('An error occurred while retrieving your Customer Profile. Please contact MillerTech.');
        }
    }

    public function registerSelectedCustomerProfileAction(Request $request)
    {
        $code = $request->get('code');
        $this->get('session')->set('cc', $code);        
        return new RedirectResponse($this->get('session')->get('_security.main.target_path'));        
    }
    
    public function switchCustomerAction(Request $request)
    {
        $fosUser = $this->getUser();
        $customerCode = $request->query->get('cc');
        $em = $this->getDoctrine()->getManager();
        
        if(empty($customerCode)){
            throw new \Exception('An error has occurred while changing the customer ('. $customerCode .')');
        }
        
        $mmu = $em->getRepository('WEBLOGSCOREMAINProfileBundle:MmUserSetting')->findOneBy(array(
                'fosUser' => $fosUser
        ));
        $mmuOrg = $em->getRepository('WEBLOGSCOREMAINProfileBundle:MmUserSettingOrg')->findOneBy(array(
            'mmUserSettingFos' => $mmu,
            'customer_code' => base64_decode($customerCode)
        ));

        if(!$mmuOrg){
            throw new \Exception('Invalid customer ('. $customerCode .')');
        }        
        
        //removing the existing session variable which had the customer code
        $this->get('session')->remove('cc');        
        //recreating the sesstion variable with the new customer code
        $this->get('session')->set('cc', $customerCode);
        
        return new RedirectResponse($this->get('session')->get('_security.main.target_path'));
    }
}
