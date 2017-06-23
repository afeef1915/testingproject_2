<?php

namespace WEBLOGS\MAIN\Services\Listener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\Container;
use Security\UserBundle\Services\UserBundleConstants;

class KernelEventListener
{

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {

    }

    public function onKernelController(FilterControllerEvent $event)
    {  
        //following URLs are excluded from the check
        if($event->getRequest()->get('_route') == 'weblogs_customer_switch_customer' ||
           $event->getRequest()->get('_route') == 'weblogs_customer_select_customer_account' ||
           $event->getRequest()->get('_route') == 'weblogs_customer_register_selected_customer_account' ||
           $event->getRequest()->get('_route') == 'eserv_user_bundle_user_do_logout'){
            return;
        }
        
        //following block is to redirect to "select customer accounts page" (if the user got more than one customer)
        //as well as if the logged in user group is "Customer" and no customer is set in the session
        $token = $this->container->get('security.context')->getToken();
        if ($token) {
            $user = $this->container->get('security.context')->getToken()->getUser();            
            if (is_object($user)) {
                $groupNames = $user->getGroupNames();
                if (count($groupNames) == 1) { 
                    if ($groupNames[0] == UserBundleConstants::USER_GROUP_CUSTOMER &&
                        empty($this->container->get('session')->get('cc'))) {                         
                        $redirectUrl = $this->container->get('router')->generate('weblogs_customer_select_customer_account', array(), \Symfony\Component\Routing\Generator\UrlGeneratorInterface::NETWORK_PATH);                         
                        $event->setController(function() use ($redirectUrl) {
                            return new \Symfony\Component\HttpFoundation\RedirectResponse($redirectUrl);
                        });
                    } 
                }
            }
        }
        
        //handling the request
        if (!empty($event->getRequest()->request->get('cc'))) {
            if ($this->container->get('session')->get('cc') != $event->getRequest()->request->get('cc')) {
                throw new \Exception('Your page has been expired! Please refresh..', 500);
            }
        }
        //handling the query params
        if (!empty($event->getRequest()->query->get('cc'))) {
            if ($this->container->get('session')->get('cc') != $event->getRequest()->query->get('cc')) {
                throw new \Exception('Your page has been expired! Please refresh..', 500);
            }
        }        
        //handling headers
        if (!empty($event->getRequest()->headers->all()['cc'])) {
            if ($this->container->get('session')->get('cc') != $event->getRequest()->headers->get('cc')) {
                throw new \Exception('Your page has been expired! Please refresh..', 500);
            }
        }
    }

}
