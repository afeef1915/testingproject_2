<?php

namespace ESERV\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

class DefaultController extends Controller {

    public function indexAction() {
        $app_users_in_memory = $this->container->hasParameter('users_in_memory') ? $this->container->getParameter('users_in_memory') : false;

        if ($app_users_in_memory) {
            return $this->render('ESERVHomeBundle:Default:index.html.twig');
        } else {
            $domain_hash = md5($this->container->get('router')->generate('eserv_home_homepage') . $this->getUser()->getId());

            $mm_user_setting = new \ESERV\MAIN\ProfileBundle\Services\ProfileBundleMmUserSettingService($this->getDoctrine()->getManager(), $this->container);
            $user_settings = $mm_user_setting->getOneByFosUserId($this->getUser()->getId());

            $layout = $user_settings ? json_decode($user_settings[0]['layoutState'], true) : '';
            $dashboard_portlets = isset($layout['dashboard_portlets']) ? $layout['dashboard_portlets'] : '';
            $cookies = isset($layout['cookies']) ? $layout['cookies'] : array();

            $response = new Response();

            foreach ($cookies as $cookie) {
                $response->headers->setCookie(new Cookie($cookie['name'], ($cookie['value']), 0, '/', null, false, false));
            }
            
            $eservMainUser = $this->getDoctrine()->getManager()->getReference('ESERV\MAIN\SecurityBundle\Entity\ESERVUser', $this->getUser()->getId());
            $showPasswordResetWarning = 'N';
            $dateDiff = 0;

            if( $this->get('session')->get('showPasswordResetModal') == 'Y' &&
                $this->container->hasParameter('password_warning_show_days') && 
                !is_null($eservMainUser->getExpiresAt()))
              {
                $date1 = new \DateTime("now");
                $date2 = new \DateTime("{$eservMainUser->getExpiresAt()->format('Y-m-d')}");
                
                $diff = $date2->diff($date1)->format("%a");                
                if($diff <= $this->container->getParameter('password_warning_show_days')){
                    $showPasswordResetWarning = 'Y';       
                    $dateDiff = $diff;                    
                }                
            }
            
            return $this->render('ESERVHomeBundle:Default:index.html.twig', array(
                    'domain_hash' => $domain_hash,
                    'selected_dashboard_portlets' => $dashboard_portlets,
                    'UserScreenWidth' => isset($user_settings[0]) ? (isset($user_settings[0]['themeWidth']) ? $user_settings[0]['themeWidth'] : 'normal') : 'normal',
                    'user_settings' => isset($user_settings[0]) ? $user_settings[0] : array(
                        'theme' => $this->container->getParameter('app_default_theme'),
                    ),
                    'showPasswordResetWarning' => $showPasswordResetWarning,
                    'dateDiff' => $dateDiff
                )
                , $response);
        }
    }

    public function homeAction() {
        return $this->render('ESERVHomeBundle:Default:home.html.twig', array());
    }

    public function aboutAction(Request $request) {
        $type = $request->get('type', null);
        switch ($type) {
            case 'general':
                return $this->render('ESERVHomeBundle:About:general.html.twig', array());
                break;
            default :
                return $this->render('ESERVHomeBundle:Default:index.html.twig', array());
                break;
        }
    }

    public function resetSettingsAction() {
        $mtl_eserv_cookie_names = $this->get('core_function_services')->getAllMTLESERVViewCookieNames();

        $response = new Response();

        foreach ($mtl_eserv_cookie_names as $c) {
            $response->headers->clearCookie($c);
        }

        $response->send();

        return $this->render('ESERVHomeBundle:Default:home.html.twig', array());
    }

}
