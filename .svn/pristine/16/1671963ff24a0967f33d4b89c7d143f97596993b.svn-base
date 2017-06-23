<?php

namespace Security\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ActivationController extends Controller
{
    public function renderUserActivationAction($conf_token, $success_path)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByConfirmationToken($this->container->get('core_function_services')->eservDecode($conf_token));

        if($user){
            $activation_form = $this->createForm(new \Security\UserBundle\Form\Activation\PassConfActType(), null, array(
                'action' => $this->generateUrl('fos_user_security_process_user_activation', array('conf_token' => $conf_token, 'success_path' => $success_path)),
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'
                ),
            ));

            return $this->render("SecurityUserBundle:Activation:pass_conf_activation.html.twig", array(
                        'form' => $activation_form->createView(),
                        'conf_token' => $conf_token,
                        'success_path' => $this->container->get('core_function_services')->eservDecode($success_path)
            ));
        }else{
            throw new \Exception('Activation link expired', 500);
        }
        
    }

    public function processUserActivationAction($conf_token, $success_path, Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();

        $activation_form = $this->createForm(new \Security\UserBundle\Form\Activation\PassConfActType(), null, array(
            'action' => $this->generateUrl('fos_user_security_process_user_activation', array('conf_token' => $conf_token, 'success_path' => $success_path )),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),
        ));

        if ($request->isMethod('POST')) {
            $activation_form->handleRequest($request);
            if ($activation_form->isValid()) {
                try {
                    $userManager = $this->get('fos_user.user_manager');
                    $user = $userManager->findUserByConfirmationToken($this->container->get('core_function_services')->eservDecode($conf_token));

                    $postData = $request->request->get('security_pass_act_conf');

                    if($user){
                        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                        $password_check = $encoder->isPasswordValid($user->getPassword(),  $postData['password'], $user->getSalt());

                        if($password_check){
                            $user->setEnabled(1);
                            $user->setConfirmationToken(null);
                            $user->setPlainPassword($postData['newPassword']);
                            $em->persist($user);
                            $em->flush();

                            $message = 'Account successfully activated';
                            $status = true;
                        }else{
                            $message = 'Verification code does not match';
                        }
                    }else{
                       $message = 'Verification link expired';
                    }
                } catch (\Exception $e) {
                    $message = 'Error occurred : - ' . $e->getMessage();
                }
            } else {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($activation_form->getErrors(true));
            }
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );
//        print_r($result);die;
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $this->render("SecurityUserBundle:Activation:pass_conf_activation.html.twig", array(
                        'form' => $activation_form->createView(),
                        'error' => $message,
                        'errors_array' => $errors_array,
                        'conf_token' => $conf_token,
                        'success_path' => $this->container->get('core_function_services')->eservDecode($success_path)
            ));
        }
    }

    public function viewResendActivationLinkAction($mmUserSettingId, $fosGroupId)
    {
        $em = $this->getDoctrine()->getManager();

        $activation_form = $this->createForm(new \Security\UserBundle\Form\Activation\ResendActType(), null, array(
            'action' => $this->generateUrl('fos_user_security_proces_activation_resend', array('mmUserSettingId' => $mmUserSettingId, 'fosGroupId' => $fosGroupId)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),
        ));

        $mmUserSetting = $em->getRepository('WEBLOGSCOREMAINProfileBundle:MmUserSetting')->find($mmUserSettingId);
        $person_id = $mmUserSetting->getPersonId();
        $selectQuery = "SELECT concat(forename, concat(' ', surname)) FULL_NAME FROM person "
                . "WHERE id = '$person_id' ";
        $result = $this->container->get('db_core_function_services')->runRawSql($selectQuery);
        $displayName = $result[0]['FULL_NAME'];
        $email = $mmUserSetting->getFosUser()->getEmail();

        $detailsArray = array(
            'displayName' => $displayName,
            'email' => $email
        );

        return $this->render("SecurityUserBundle:Activation:view_resend_act_form.html.twig", array(
                    'form' => $activation_form->createView(),
                    'details_array' => $detailsArray
        ));
    }

    public function processResendActivationLinkAction($mmUserSettingId, $fosGroupId, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        try {
            $em->getConnection()->beginTransaction();
            $form = $this->createForm(new \Security\UserBundle\Form\Activation\ResendActType(), null, array(
                'action' => $this->generateUrl('fos_user_security_proces_activation_resend', array()),
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'
                ),
            ));

            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $postData = $request->request->get('security_activation_resend_form');
    
                    $mmUserSetting = $em->getRepository('WEBLOGSCOREMAINProfileBundle:MmUserSetting')->find($mmUserSettingId);
                    $fosUser = $em->getRepository('SecurityUserBundle:FosUser')->find($mmUserSetting->getFosUser());

                    $userName = $fosUser->getUsername();

                    $user_org = new \ESERV\MAIN\SecurityBundle\Entity\User();

                    $randomPassword = $this->container->get('core_function_services')->randomPassword();
                    $encoder = $this->container->get('security.password_encoder');
                    $encodedPassword = $encoder->encodePassword($user_org, $randomPassword);
                    $salt = $user_org->getSalt();

                    /* User registration activation token */
                    $conf_token = $this->container->get('security_services')->generateConfirmationToken($userName, $encodedPassword, $salt);
                    $fosUser->setConfirmationToken($conf_token);
                    $fosUser->setPassword($encodedPassword);
                    $fosUser->setEnabled(0);
                    $fosUser->setSalt($salt);

                    $activate_base_url = $this->container->get('core_function_services')->getFullHost() . $this->container->get('router')->getContext()->getBaseUrl();
                    
                    $success_url = $this->generateUrl('fos_user_security_mtllogin');
//                    $url = isset($extra_options['activate_base_url']) ? $extra_options['activate_base_url'] . '/user/r/a/' . $this->container->get('core_function_services')->eservEncode($conf_token) . '/' . $this->container->get('core_function_services')->eservEncode($success_url) : $this->container->get('core_function_services')->getFullHost() . $this->container->get('router')->getContext()->getBaseUrl() . '/user/r/a/' . $this->container->get('core_function_services')->eservEncode($conf_token) . '/' . $this->container->get('core_function_services')->eservEncode($success_url);
                    $url = $activate_base_url . '/user/r/a/' . $this->container->get('core_function_services')->eservEncode($conf_token) . '/' . $this->container->get('core_function_services')->eservEncode($success_url);
                    
                    $person_id = $mmUserSetting->getPersonId();
                    $selectQuery = "SELECT concat(forename, concat(' ', surname)) FULL_NAME FROM person "
                            . "WHERE id = '$person_id' ";
                    $result = $this->container->get('db_core_function_services')->runRawSql($selectQuery);
                    $displayName = $result[0]['FULL_NAME'];
                    
                    $data = array(
                        'fromEmail' => $this->container->getParameter('merlin_emailing_from_email'),
                        'toEmail' => $fosUser->getEmail(),
                        'subject' => $this->container->get('eserv_translation_services')->eservCustomTranslator('Your Web Logs Account has been reset.'),
                        'body' => $this->container->get('templating')->render('ESERVMAINCommunicationsBundle:ESERVEmailTemplate:layout.html.twig', array(
                            'header_text' => 'Account reset acknowledgement',
                            'show_footer' => true, //optional, default is true
                            'show_header' => true, //optional, default is true
                            'show_disclaimer' => true, //optional, default is true
                            'show_contact_details' => true, //optional, default is true
                            'show_social_media' => true, //optional, default is true
                            'body_twig' => $this->container->get('templating')->render('SecurityUserBundle:Activation:resend_activation_email.html.twig', array(
                                'diplayName' => $displayName,
                                'username' => $userName,
                                'password' => $randomPassword,
                                'activation_link' => $url
                            ))
                        ))
                    );

                    $send_user_email = $this->container->get('eserv_email_services')->sendEmail($data);
                    if ($send_user_email) {
                        $status = true;
                        $em->flush();
                        $em->getConnection()->commit();
                        $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('Activation link has been emailed to the user.');
                    } else {
                        $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('Email failed to send.');
                        throw new \Exception($message, 500);
                    }
                }else{
                    throw new \Exception('Form is invalid', 500);
                }
            }
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $message = 'Sending activation link has been failed! ' . $e->getMessage();
            $status = false;
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }    
}
