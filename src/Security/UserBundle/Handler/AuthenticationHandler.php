<?php

namespace Security\UserBundle\Handler;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\Container;
use Security\UserBundle\Services\UserBundleConstants;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface {

    private $router;
    private $session;
    private $container;

    /**
     * @param     RouterInterface $router
     * @param     Session $session
     */
    public function __construct(RouterInterface $router, Session $session, Container $container) {
        $this->router = $router;
        $this->session = $session;
        $this->container = $container;
//        $this->em = $em;
    }

    /**
     * onAuthenticationSuccess
     *
     * @param     Request $request
     * @param     TokenInterface $token
     * @return    Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) 
    {
        $url = false;
        $success = false;
        $msg = '';
        $userMode = false;
        
        try{            
            if ($this->session->get('_security.main.target_path')) { 
            $groupNames = $this->container->get('security.context')->getToken()->getUser()->getGroupNames();    

            if(count($groupNames) == 1){                                        
               if($groupNames[0] == UserBundleConstants::USER_GROUP_MTL){                                               
                        $url = $this->router->generate('eserv_home_homepage');
                        $userMode = UserBundleConstants::USER_GROUP_MTL;
                        $success = true;
                    }else if($groupNames[0] == UserBundleConstants::USER_GROUP_CUSTOMER){             
                        $url = $this->router->generate('weblogs_customer_select_customer_account', array(), \Symfony\Component\Routing\Generator\UrlGeneratorInterface::RELATIVE_PATH);                         
                        $userMode = UserBundleConstants::USER_GROUP_CUSTOMER;
                        $success = true;
                    }else{                        
                        $url = '';
                        $success = true;
                    }                        
                }else{
                    $success = false;
                    $msg = 'Multiple user groups exists for this user. Please contact MillerTech.';                
                }                
            } else { 
                $success = true;
                $url = $this->router->generate('eserv_home_homepage');
            } 
        }catch(\Exception $e){
           $success = false;
           $msg = 'An exception has occurred :- '. $e->getMessage();  
        }                
        
        if ($request->isXmlHttpRequest()) {
            $array = array(
                'success' => $success, 
                'url' => $url, 
                'message' => $msg,
                'userMode' => $userMode
            );
            return new JsonResponse($array);
        } else { 
            return new RedirectResponse($url);
        }
    }

    /**
     * onAuthenticationFailure
     *
     * @param     Request $request
     * @param     AuthenticationException $exception
     * @return    Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {

        if ($request->isXmlHttpRequest()) {
//            if ($authException instanceof AuthenticationException || $authException instanceof AccessDeniedException) {
//                
//            }
            $array = array('success' => false, 'message' => $exception->getMessage()); // data to return via JSON
            return new JsonResponse($array);
        } else {
            $request->getSession()->set(SecurityContextInterface::AUTHENTICATION_ERROR, $exception);
            return new RedirectResponse($this->router->generate('fos_user_security_mtllogin'));
        }
    }

}
