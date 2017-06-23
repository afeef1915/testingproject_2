<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Security\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Security\Services\SecurityConstants;
use WEBLOGS\CORE\Services\WEBLOGSConstants;


//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
//use WEBLOGS\DashboardBundle\Entity\VWwvCustomers;
//use WEBLOGS\DashboardBundle\Entity\UserCustomer;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Doctrine\ORM\Mapping\Entity;


class FosUserController extends Controller {

    public $fos_user_columns;
    public $fos_user_table_id = 'merlin_security_admin_fos_user_cols_web';
    public $fos_user_filter;
    
    public function __construct() 
    {
        $this->fos_user_columns = array(
            'full_name' => array(
                'full_name',
                'options' => array(
                    'col_name' => 'full_name',
                    'header' => 'Full Name',
                    'css_class' => 'center hide_for_mobile'
                )
            ),
            'username' => array(
                'username',
                'options' => array(
                    'col_name' => 'username',
                    'header' => 'Username',
                )
            ),
            'fos_user_email' => array(
                'fos_user_email',
                'options' => array(
                    'col_name' => 'fos_user_email',
                    'header' => 'Email',
                    'css_class' => 'center hide_for_mobile'
                )
            ),
            'fos_group_name' => array(
                'fos_group_name',
                'options' => array(
                    'col_name' => 'fos_group_name',
                    'header' => 'Group Name',
                    'css_class' => 'center hide_for_mobile'
                )
            ),
            'locked' => array(
                'locked',
                'options' => array(
                    'col_name' => 'locked',
                    'header' => 'Locked',
                    'width' => '80px',
                    'css_class' => 'center hide_for_mobile'
                )
            ),
            'last_login' => array(
                'last_login',
                'col_type' => 'date',                                
                'options' => array(
                    'col_name' => 'last_login',
                    'header' => 'Last Login',
                    'width' => '120px',
                    'css_class' => 'center hide_for_mobile',
                    'css_class' => 'center hide_for_mobile'
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => '#/user/edit/[[id]]',
                'url_params' => array(
                    'id' => 'mmUserSettingId'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'target' => '_self',
                'additional_attr' => array(
                    'class' => 'table_details_btn'
                ),
                'options' => array(
                    'header' => 'Edit',
                    'width' => '80px',
                    'css_class' => 'center',
                    'sortable' => false,
                )
            ),
        );        
        
        $this->fos_user_filter = array(
            'type' => 'tabs',
            'pre_load_data' => false,
            'tabs' => array(
                array(
                    'id' => 'system_icon_details',
                    'header' => 'General Details',
                    'fields' => array(                        
                        'full_name' => 'Full Name',
                        'username' => 'Username',
                        'fos_user_email' => 'Email',
                        'last_login' => array(
                            'label' => 'Last Login',
                            'widget' => array(
                                'type' => 'date_from_to',
                                'range' => true,
                                'date_fields' => array(
                                    'from_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'format' => WEBLOGSConstants::DATEPICKER_DATE_FORMAT,
                                                'date_create_from_format' => WEBLOGSConstants::DATE_FORMAT_CREATE_FROM_FORMAT,
                                            )
                                        )
                                    ),
                                    'to_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'format' => WEBLOGSConstants::DATEPICKER_DATE_FORMAT,
                                                'date_create_from_format' => WEBLOGSConstants::DATE_FORMAT_CREATE_FROM_FORMAT,
                                            )
                                        )
                                    )
                                ),
                            )
                        ),
                    )
                ),
            )
        );
    }
    
    public function fosUserListAction(Request $request)  
    {   
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->fos_user_table_id, array(
            'columns' => $this->fos_user_columns,
            'source_url' => $this->container->get('router')->generate('merlin_security_users_data_ajax_list', array('cc' => $request->get('cc'))),
            'disable_initial_sorting' => true,
            'filtering' => $this->fos_user_filter,
        ));

        return $this->render('SecurityUserBundle:FosUser:list.html.twig', array(
                    'dataTable' => $dataTable,
        ));
    }

    public function dataFosUserAction(Request $request) 
    {   
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'Security\UserBundle\Services\UserBundleService',
                    'function_name' => 'ListUsers',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'dtindex',
            'table_id' => $this->fos_user_table_id,
            'columns' => $this->fos_user_columns,
            'filtering' => $this->fos_user_filter,
//            'all_cols_case_insensitive' => true,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }
    
    public function newFosUserAction(Request $request) 
    {
        $register_user_form = $this->createForm(new \Security\UserBundle\Form\FosUser\FosUserType($this->get('security.context')), null, array(
            'csrf_protection' => false,
            'action' => $this->generateUrl('merlin_security_users_create'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            ),
            'ac_urls' => array(
                'persons' => $this->generateUrl('merlin_security_person_search'),               
            )
        ));

        return $this->render("SecurityUserBundle:FosUser:add.html.twig", array(
                    'form' => $register_user_form->createView(),
                    'refresh_table_id' => $this->fos_user_table_id,
        ));
    }
    
    public function personSearchAction(Request $request)
    {
        $searchedTerm = $request->get('param', $request->get('q', null));
        $replacedSelectSql = '';        
        $selectQuery = "SELECT id AS ID, CONCAT(forename, CONCAT(' ', surname)) AS FULL_NAME "
                . "FROM person_web "
                . "WHERE (UPPER(forename) LIKE UPPER('%:(VALUE)%') OR UPPER(surname) LIKE UPPER('%:(VALUE)%'))"
                . "AND ROWNUM < 11";
        if(preg_match_all(SecurityConstants::AC_USER_TYPED_PARAM_REGEX, $selectQuery, $result)){
            $cf = $this->get('core_function_services');
            foreach($result[0] as $kk => $vv){ 
                $replacedSelectSql = str_replace($vv, $cf->replaceBasedOnValues($searchedTerm, 'LIKE'), $selectQuery);                                                                                           
            }                                        
        } 
        $result = $this->get('db_core_function_services')->runRawSql($replacedSelectSql); 
        $items_result = array();
        foreach ($result as $obj) {
                $item = array(
                    'html_result' => $obj['FULL_NAME'] . " (" . $obj['ID'] .") ",
                    'result' => $obj['FULL_NAME'] . " (" . $obj['ID'] .") ",
                    'value' => $obj['ID'],
                );
            array_push($items_result, $item);
        }
        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'results' => $items_result
        )); 
        
    }
    
    public function createUserAction(Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();

        $register_user_form = $this->createForm(new \Security\UserBundle\Form\FosUser\FosUserType($this->get('security.context')), null, array(
            'csrf_protection' => false,
            'action' => $this->generateUrl('merlin_security_users_create'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            ),
            'ac_urls' => array(
                'persons' => $this->generateUrl('merlin_security_person_search'),               
            )
        ));

        if ($request->isMethod('POST')) {
            $register_user_form->handleRequest($request);
            if ($register_user_form->isValid()) {
                try { 
                   $em->getConnection()->beginTransaction();
                    $postData = $request->request->get('merlin_ora_fos_user_registration');
                    $person_id = $postData['person'];
                   $username = $postData['username'];
                    $realex_seq = 0;
        //$dbh = Propel::getConnection('propel');
                       $em = $this->getDoctrine()->getEntityManager();
        $sql = "DECLARE ln_seq  NUMBER; BEGIN SELECT miller_web_demo.FOS_USER_ID_SEQ.NEXTVAL INTO ln_seq FROM DUAL; :P_SEQ := to_char(ln_seq); END;";

//                      $p_customer_id='ATL';
//                      $p_random='123254335';
        $data;

        $qb = $em->getConnection()->prepare($sql);
        
        
        
        
        //$stmt = $dbh->prepare("DECLARE ln_seq  NUMBER; BEGIN SELECT miller_web_demo.FOS_USER_ID_SEQ.NEXTVAL INTO ln_seq FROM DUAL; :P_SEQ := to_char(ln_seq); END;");
        $qb->bindParam(':P_SEQ', $realex_seq, \PDO::PARAM_INPUT_OUTPUT,  4000);
      //    $qb->bindParam('param1', $p_customer_id, \PDO::PARAM_INPUT_OUTPUT, 4000);
        $qb->execute();
        
        //echo  $realex_seq;die;
       
//                    
//                    
       // echo $realex_seq;die;
                   $usbs = new \Security\UserBundle\Services\UserBundleRegistrationService($em, $this->container);
                    //$eligible_user = $usbs->getUserEligible($person_id, $username); 
//                    //checking the eligibility of user as well as the existence of username
                   $eligible_user['success']=true;
                    if($eligible_user['success']){
                        $send_email = isset($postData['send_email']) && $postData['send_email'] == 1 ? true : false;
                        $locked = isset($postData['locked']) && $postData['locked'] == 1 ? 1 : '0';
                        $expired = isset($postData['expired']) && $postData['expired'] == 1 ? 1 : '0';
////                        
                        $selectQuery = "SELECT concat(forename, concat(' ', surname)) full_name FROM person_web "
                                . "WHERE id = '$person_id' ";
////
                       $result = $this->container->get('db_core_function_services')->runRawSql($selectQuery); 
////                    
                     //  print_r($result[0]['FULL_NAME']);die;
                       $email = 'vineet@mantrait.com';
////                        
                        $user_data = array(
                            'fos_user_id'=>$realex_seq,
                            'person_id' => $person_id,
                            'username' => $username,
                            'email' => $email,
                            'person_name' => $result[0]['FULL_NAME'],
                            'password' => $postData['password'],
                            'fos_group' => $postData['fosGroup'],
                            'create_conf_token' => true,
                            'is_locked' => $locked,
                            'is_expired' => $expired,                            
                        );
////                        
                        if($send_email){
                            $user_data['password'] = $this->container->get('core_function_services')->randomPassword();
                            $user_data['is_enabled'] = '0';
                        }else{
                            $user_data['is_enabled'] = '1';
                        }
                        $success_url = $this->generateUrl('fos_user_security_mtllogin');
                        $usbs->registerWeblogsUser($user_data, $send_email, $success_url);
                        if($send_email){                            
                            $message = "User has been successfully created and the activation link has been emailed to $email.";
                        }else{
                            $message = "User has been successfully created!";
                       }
                        $status = true;
                    }else{
                        $message = $eligible_user['msg'];
                    }
                    $em->getConnection()->commit();
                    
                    $message = "User has been successfully created! (Test Message)";
                    $status = true;
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($register_user_form->getErrors(true));
            }
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );


        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
//            return $this->render("SecurityUserBundle:FosUser:add.html.twig", array(
//                        'form' => $register_user_form->createView(),
//                        'refresh_table_id' => $this->fos_user_table_id,
//            ));
            $url = $this->generateUrl("merlin_security_users_list", array());
            return $this->redirect($url);
        }
    }
    
    public function editUserAction($id, Request $request) 
    {
        if (isset($id) && $id != '') {
            $em = $this->getDoctrine()->getManager();

            $action_url = $this->generateUrl('merlin_security_users_update', array('id' => $id));

            $form_options_array = array(
                'action' => $action_url,
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'),
                'ac_urls' => array(
                    'persons' => $this->generateUrl('merlin_security_person_search')
                )
            );

            $mm_user_settings = $em->getReference('WEBLOGS\CORE\MAIN\ProfileBundle\Entity\MmUserSetting', $id);
            $fos_id = $mm_user_settings->getFosUser()->getId();
            $fos_user = $em->getReference('Security\UserBundle\Entity\User', $fos_id);
            $fosUserGroup = $em->getRepository('SecurityUserBundle:FosUserGroup')->findOneBy(array('user' => $fos_id));
            $loggedInUserId = $this->get('security.token_storage')->getToken()->getUser()->getId();
           
            $enabled = $fos_user->isEnabled();
            $activation_message = '';
            if ($loggedInUserId == $fos_id) { 
                $activation_allowed = false;
            } else{ 
                $activation_allowed = true;
            }
            
            $fosGroup = $fosUserGroup ? $fosUserGroup->getGroup() : null;            
            $data = array(
                'person_id' => $mm_user_settings->getPersonId(),
                'username' => $fos_user->getUserName(),
                'email' => $fos_user->getEmail(),
                'fosGroup' => $fosGroup,
//                'accountType' => $mm_user_settings->getAccountType(),
                'locked' => ($fos_user->isLocked() == 1 ? true : false),
                'enabled' => $enabled,
            );
            
            $person_id = $mm_user_settings->getPersonId();
            $selectQuery = "SELECT full_name FROM eserv_v_user "
                    . "WHERE person_id = '$person_id' ";

            $result = $this->container->get('db_core_function_services')->runRawSql($selectQuery);
            
            $ac_values = array(
                'person_ac' => array(
                    'name' => $result[0]['FULL_NAME'],
                    'value' => $mm_user_settings->getPersonId()
            ));

            $form = $this->createForm(new \Security\UserBundle\Form\FosUser\EditFosUserType($this->get('security.context')), $data, $form_options_array);

            return $this->render('SecurityUserBundle:FosUser:edit.html.twig', array(
                        'form' => $form->createView(),
                        'fos_group_id' => ($fosGroup != null ? $fosGroup->getId() : null),
                        'id' => $fos_id,
                        'mm_user_setting_id' => $mm_user_settings->getId(),                       
                        'enabled' => $enabled,
                        'activation_allowed' => $activation_allowed,
                        'activation_message' => $activation_message,
                        'ac_values_arr' => $ac_values
            ));
        } else {
            throw new \Exception('ID cannot be blank', 500);
        }
    }

    public function updateUserAction($id, Request $request) {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';
        
        $action_url = $this->generateUrl('merlin_security_users_update', array('id' => $id));
        $form_options_array = array(
                'action' => $action_url,
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'),
                'ac_urls' => array(
                    'persons' => $this->generateUrl('merlin_security_person_search')
                )
            );
        $form = $this->createForm(new \Security\UserBundle\Form\FosUser\EditFosUserType($this->get('security.context')), null, $form_options_array);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();
            $form_data = $request->request->get('merlin_ora_fos_user_registration_edit');
            try { 
                
//                $mm_user_settings = $em1->getReference('Security\UserBundle\Entity\MmUserSetting', $id);
//                $fos_user = $em1->getReference('Security\UserBundle\Entity\User', $mm_user_settings->getFosUser()->getId());
//                
//                $fos_user_group = $em1->getRepository('SecurityUserBundle:FosUserGroup')->findOneBy(array('user' => $fos_user));
//
//                $fos_user->setLocked(isset($form_data['locked']) ? $form_data['locked'] : '0');
//                if($form_data['fosGroup']){
//                    $fos_group = $em1->getReference('Security\UserBundle\Entity\Group', $form_data['fosGroup']);
//                    $fos_user_group->setGroup($fos_group);
//                }                
////                if(!empty($form_data['email'])){
////                     $fos_user->setEmail($form_data['email']);
////                     $fos_user->setEmailCanonical($form_data['email']);
////                }
//
//                $em1->flush();
//
//                $em1->getConnection()->commit();
//                $status = true;
//                $message = 'User (' . $form_data['username'] . ') has been successfully updated!';
                    $message = "User has been successfully updated! (Test Message)";
                    $status = true;
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $message = 'Error occurred : ' . $e->getMessage();
            }
        } else {
            $message = 'Please correct the errors below';
            $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
//            return $message;
            $url = $this->generateUrl("merlin_security_users_list", array());
            return $this->redirect($url);
        }
    }

    public function resetPasswordAction($id, Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();

        $em1 = $this->getDoctrine()->getManager();
        $em1->getConnection()->beginTransaction();

        try {

            $user = new \ESERV\MAIN\SecurityBundle\Entity\User();
            $encoder = $this->get('security.password_encoder');
            $rand_password = $this->get('core_function_services')->randomPassword();
            $fos_user = $em1->getRepository('ESERVMAINSecurityBundle:ESERVUser')->find($id);
            $password = $encoder->encodePassword($user, $rand_password);

            $fos_user->setPassword($password);
            $fos_user->setSalt($user->getSalt());
            $em1->flush();

            //sendEmail();

            $em1->getConnection()->commit();
            $status = true;
            $message = 'Password (' . $rand_password . ') has been reset and email has been sent to the user.';
        } catch (\Exception $e) {
            $status = false;
            $em1->getConnection()->rollback();
            $message = 'Error occurred : ' . $e->getMessage();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

    public function deleteUserAction($id, Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();

        $em1 = $this->getDoctrine()->getManager();
        $em1->getConnection()->beginTransaction();
         
        try {
//            $mm_user_settings = $em1->getReference('Security\UserBundle\Entity\MmUserSetting', $id);
//            $fos_user = $em1->getReference('ESERV\MAIN\SecurityBundle\Entity\ESERVUser', $mm_user_settings->getFosUser()->getId());
//            
//            $em1->remove($mm_user_settings);
//            
//            $em1->remove($fos_user);
//            $em1->flush();
//
//            $em1->getConnection()->commit();
            $status = true;
            $message = 'User has been successfully removed from the system.';
        } catch (\Exception $e) {
            $status = false;
            $em1->getConnection()->rollback();
            $message = 'Error occurred : ' . $e->getMessage();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );
        
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
//            return $message;
            $url = $this->generateUrl("merlin_security_users_list", array());
            return $this->redirect($url);
        }
    }

    public function newTempPasswordAction($id)
    {
        if (isset($id) && $id != '') {
            $action_url = $this->generateUrl('eserv_main_administration_user_assign_temp_password_create', array('id' => $id));

            $form_options_array = array(
                'action' => $action_url,
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'
                )
            );

            $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\UserForm\TempPasswordType(), null, $form_options_array);


            return $this->render('ESERVMAINAdministrationBundle:User:new_temp_password.html.twig', array(
                        'form' => $form->createView(),
            ));
        } else {
            throw new \Exception('ID cannot be blank', 500);
        }
    }

    public function createTempPasswordAction($id, Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();

        $action_url = $this->generateUrl('eserv_main_administration_user_assign_temp_password_create', array('id' => $id));

        $message = '';
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            )
        );
        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\UserForm\TempPasswordType(), null, $form_options_array);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();
            $form_data = $request->request->get($form->getName());
            try {
                $user = $em1->getReference('\ESERV\MAIN\SecurityBundle\Entity\ESERVUser', $id);
                $user_original = new \ESERV\MAIN\SecurityBundle\Entity\User();

                $encoder = $this->get('security.password_encoder');
                $password = $encoder->encodePassword($user_original, $form_data['password']);
                $salt = $user_original->getSalt();

                $user->setPassword($password);
                $user->setSalt($salt);

                $em1->flush();
                $status = true;
                $message = 'Temporary password has been succesfully assigned to the user.';
                $em1->getConnection()->commit();
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $message = 'Error occurred : ' . $e->getMessage();
            }
        } else {
            $message = 'Please correct the errors below';
            $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }
}
