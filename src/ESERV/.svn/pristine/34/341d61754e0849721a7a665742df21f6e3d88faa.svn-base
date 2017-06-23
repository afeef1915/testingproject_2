<?php

namespace ESERV\MAIN\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use ESERV\MAIN\ProfileBundle\Services\ProfileBundleMmUserSettingService;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('ESERVMAINProfileBundle:Default:index.html.twig', array('name' => $name));
    }

    public function saveSettingsAction(Request $request) {

        $status = false;
        $result = array();
        $message = '';

        try {
            $em = $this->getDoctrine()->getManager();
            $c = $this->container;

            $mm = new ProfileBundleMmUserSettingService($em, $c);

            $home_page = $request->get('home_page', NULL);
            
            $layout_cookie = $request->get('layout');
            
            $dashboard_portlets = $request->get('dashboard_portlets');
                        
            $cookies = is_array($layout_cookie) ? $layout_cookie : explode(',', $layout_cookie);

            $layout = array('home_page' => $home_page, 'dashboard_portlets' => $dashboard_portlets, 'cookies' => array());
            
            if (sizeof($cookies) > 0) {
                foreach ($cookies as $cookie) {
                    if ($request->cookies->has($cookie)) {
                        $curr_cookie_val = $request->cookies->get($cookie);
                        $layout['cookies'][] = array(
                            'name' => $cookie,
                            'value' => $curr_cookie_val
                        );
                    }
                }
            }

            $data = array(
                'auto_save' => $request->get('auto_save', null),
                'language' => $request->get('language'),
                'last_viewed_news' => new \DateTime('08/04/2014'),
                'layout_state' => json_encode($layout),
                'menu_state' => $request->get('menu_state'),
                'status_date' => new \DateTime('now'),
                'theme' => $request->get('theme'),
                'theme_font_size' => $request->get('theme_font_size'),
                'theme_width' => $request->get('theme_width'),
            );
            $logged_id_fos_user_id = $this->getUser()->getId();
            $updated = $mm->updateMmUserSetting($logged_id_fos_user_id, $data);

            if ($updated) {
                $status = true;
                $message = 'Settings Saved Successfully';
            } else {
                $status = false;
                $message = 'Error: Settings was not saved';
            }
        } catch (\Exception $e) {
            $status = false;
            $message = $e->getMessage();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'theme' => $request->request->get('theme'),
            'host' => $request->getHost()
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

    public function updateMmUserSettingAction($salt, $theme, $xml = 0) {

        $eserv_soap = $this->get('eserv_soap');
        $core_function = $this->get('core_function_services');
        $root_node = '<MmUserSetting/>';

        $client = $eserv_soap->soapClient('mm_user_setting.wsdl');
        $response = $eserv_soap->setSoapHeaders();

        try {
            $result = $client->__call('updateMmUserSettingService', array('salt' => $salt,
                'theme' => $theme));
        } catch (\Exception $e) {
            $user = $this->container->get('security.context');

            if (false === $user->getToken()->isAuthenticated()) {
                $result[0] = array(
                    'Error' => 'Not authenticated',
                    'Message' => $e->getMessage(),
                    'Code' => $e->getCode()
                );
            } else {
                $result[0] = array(
                    'Error' => 'Error',
                    'Message' => $e->getMessage(),
                    'Code' => $e->getCode()
                );
            }
        }

        $simple_xml = new \SimpleXMLElement($root_node);
        $xml_doc = $core_function->arrayToXml($result, $simple_xml);

        if ($xml == 1) {
            ob_start();
            print $xml_doc;
            $response->setContent(ob_get_clean());
            return $response;
        } else {
            return $xml_doc;
        }
    }

}
