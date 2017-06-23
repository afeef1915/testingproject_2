<?php

namespace ESERV\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DeveloperController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('ESERVTestBundle:Developer:index.html.twig', array('name' => $name));
    }
    
    public function createUserAction(Request $request)
    {
        $form = $this->createForm(new \ESERV\TestBundle\Form\EservUser());
        
        $form->handleRequest($request);
        
        if ($request->getMethod() == 'POST' && $form->isValid()) {
            $form_data = $request->request->get('new_eserv_user');
            
            $DataArray = array(
                'user_role' => 'CE',
                'username' => $form_data['username'],
                'email' => $form_data['email'],
                'password' => $form_data['password'],
                'is_enabled' => 1,
                'is_locked' => 0,
                'is_expired' => 0,
            );
//            die(print_r($DataArray));
            $res = $this->container->get('security_services')->createESERVUser($DataArray, $DataArray['password']);
            echo $res;
            die;
        }

        // createESERVUser($DataArray, $password);
        
        return $this->render('ESERVTestBundle:Developer:create_user.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function testShaAction()
    {
        $password = 'guy';
        $salt = md5(time());
        
        $salted = $password.'{'.$salt.'}';
        $digest = hash('sha512', $salted, true);
        
        // "stretch" hash
        for ($i = 1; $i < 5000; $i++) {
            $digest = hash('sha512', $digest.$salted, true);
        }
        
        echo 'salt : '.$salt;
        echo '<br/>password : '. base64_encode($digest);
        
        die;
    }
    
    public function ajTestAction()
    {
//        $em = $this->getDoctrine()->getManager();
//        $user = $em->getRepository('ESERVMAINSecurityBundle:User')->find(9846);
//        $um = $this->container->get('fos_user.user_manager');
//        $aa = $um->findUserByUsername('7960995s');
//        echo 'A-'.$aa->getPlainPassword();
    }

    public function liveEmailTestAction()
    {
        $cf = $this->get('core_function_services'); 
        $f = $cf->createFile('TEST', array(
            'file_name' => "Induction_Results" . "_" . date("d-m-Y_H-i", time()),
            'extension' => 'csv',
            'folder_name' => 'Induction_Results'
        ));
        $sendEmail = $this->container->get('eserv_email_services')->sendEmail(array(
            'fromEmail' => 'anjana2100@live.com',
            'toEmail' => 'anjana@millertech.co.uk',
            'subject' => 'Test subject of electronic mail',
            'body' => 'Test body of an electronic mail',
            'attachmentPath' => $f['url']
        ));
        
        if ($sendEmail) {
           die('Sent true!');
        } else {
           die('Email failed to sent!'); 
        }
    }
    
    public function destroySessionAction(Request $request) {
        $session = $request->getSession();
        $session->start();
        $session->invalidate();
        $session->clear();
        die('Session cleared');
    }
}
