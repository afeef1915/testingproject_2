<?php

namespace ESERV\MAIN\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;

class UserController extends Controller
{

    public $user_columns;
    public $user_table_id = 'eserv_user_table';
    public $user_table_filters;

    public function __construct()
    {
        $this->user_columns = array(
//            'fosUserId' => array(
//                'fosUserId',
//                'options' => array(
//                    'header' => 'ID',
//                    'width' => '60px',
//                    'css_class' => 'center hide_for_mobile',
//                )
//            ),
            'displayName' => array(
                'displayName',
                'options' => array(
                    'col_name' => 'displayName',
                    'header' => 'Name',
                    'css_class' => 'center',
                )
            ),
            'username' => array(
                'username',
                'options' => array(
                    'col_name' => 'username',
                    'header' => 'Username',
                )
            ),
            'fosUserEmail' => array(
                'fosUserEmail',
                'options' => array(
                    'col_name' => 'fosUserEmail',
                    'header' => 'Email',
                )
            ),
            'fosGroupName' => array(
                'fosGroupName',
                'options' => array(
                    'col_name' => 'fosGroupName',
                    'header' => 'Group Name',
                )
            ),
            'locked' => array(
                'locked',
                'options' => array(
                    'col_name' => 'locked',
                    'header' => 'Locked',
                    'width' => '80px',
                )
            ),
            'lastLogin' => array(
                'lastLogin',
                'col_type' => 'date',
                'options' => array(
                    'col_name' => 'lastLogin',
                    'header' => 'Last Login',
                    'width' => '120px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => '#/admin/users/edit/[[id]]',
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

        $this->user_table_filters = array(
            'type' => 'tabs',
            'pre_load_data' => false,            
            'tabs' => array(
                array(
                    'id' => 'user_details',
                    'header' => 'User Details',
                    'fields' => array(
                        'displayName' => 'Name',
                        'username' => 'Username',
                        'fosUserEmail' => array(
                            'label' => 'Email',
                            'eserv_extra_validation' => array(
                                'lettercase' => 'lower',
                            )
                        ),
                    )
                ),
                array(
                    'id' => 'other_details',
                    'header' => 'More Details',
                    'fields' => array(        
                        'fosGroupName' => array(
                            'label' => 'Group Name',
                            'widget' => array(
                                'type' => 'autocomplete_array',
                                'selected_data' => array(                                    
                                  //  \ESERV\MAIN\Services\AppConstants::FOS_GROUP_ADMINISTRATOR, 
                                ),
                                'choices' => array(                                    
                                    // fill this choice from database in functions dataAction and userListAction
                                )
                            )
                        ),
                        'locked' => array(
                            'label' => 'Locked',
                            'widget' => array(
                                'type' => 'dropdown',
                                'selected_data' => array(
                                    NULL,
                                ),
                                'choices' => array(                                    
                                    NULL => '-- Please Select --',
                                    'Y' => 'Yes',
                                    'N' => 'No',
                                )
                            )
                        ),
                        'lastLogin' => array(
                            'label' => 'Last Login Date',
                            'widget' => array(
                                'type' => 'date_from_to',
                                'range' => true,
                                'date_fields' => array(
                                    'from_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                                            )
                                        )
                                    ),
                                    'to_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
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

    public function userListAction()
    {
        $this->user_table_filters['tabs'][1]['fields']['fosGroupName']['widget']['choices'] = $this->getDoctrine()->getManager()->getRepository('SecurityUserBundle:FosGroup')->getAllFosGroupsAsFilterChoices();
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->user_table_id, array(
            'columns' => $this->user_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_administration_view_users_ajax_list'),
            'filtering' => $this->user_table_filters,
//            'output_options' => array(
//                'export_buttons' => array(
//                    'pdf' => array(
//                        'label' => '<i class="fa fa-file-pdf-o"></i> Export to PDF',
//                        'title' => 'User List',
//                        'content' => '',
//                        'notif_title' => 'User List PDF',
//                        'notif_description' => 'User List PDF has been created and please use the button below to download.',
//                        'file_name' => 'user_list',
//                        'extraClass' => ''
//                    ),
//                    'csv' => array(
//                        'label' => '<i class="fa fa-file-excel-o"></i> Export to CSV',
//                        'title' => 'User List', //title of the pdf as well as the name field of queued db process
//                        'notif_title' => 'User List CSV',
//                        'notif_description' => 'User List CSV has been created and please use the button below to download.',
//                        'file_name' => 'user_list',
//                        'extraClass' => ''
//                    )
//                )
//            ),
        ));

        return $this->render('ESERVMAINAdministrationBundle:User:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->user_table_id,
        ));
    }

    public function dataAction(Request $request)
    {
        $this->user_table_filters['tabs'][1]['fields']['fosGroupName']['widget']['choices'] = $this->getDoctrine()->getManager()->getRepository('SecurityUserBundle:FosGroup')->getAllFosGroupsAsFilterChoices();
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\AdministrationBundle\Services\AdministrationBundleUserService',
                    'function_name' => 'ListUsers',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'mmUserSettingId',
            'columns' => $this->user_columns,
            'filtering' => $this->user_table_filters,
            'table_id'=> $this->user_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function newUserAction(Request $request)
    {
        $action_url = $this->generateUrl('eserv_main_administration_users_create');
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'ac_urls' => array(
                'people' => $this->generateUrl('eserv_main_administration_people_search_ac')
            )
        );

        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\UserForm\AddUserType(), null, $form_options_array);

        return $this->render('ESERVMAINAdministrationBundle:User:add.html.twig', array(
                    'form' => $form->createView(),
                    'extra_data' => array(
                        'la_user_group' => \ESERV\MAIN\Services\AppConstants::FOS_GROUP_LOCAL_AUTHORITY
                    )
        ));
    }

    public function peopleSearchAutoCompAction(Request $request)
    {
        $param = $request->get('param');
        return $this->container->get('auto_complete_function_services')->peopleSearchAutoComplete($param);
    }

    public function createUserAction(Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';
        $form_options_array = array(
            'ac_urls' => array(
                'people' => $this->generateUrl('eserv_main_administration_people_search_ac')
            )
        );
        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\UserForm\AddUserType(), null, $form_options_array);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();
            $form_data = $request->request->get('new_admin_user');
            try {
                $username_exists = $this->container->get('fos_user.user_manager')->findUserByUsername($form_data['username']);
                //checks whether username exists or not (sorry, no username duplications)
                if (!$username_exists) {
                    $email = $em1->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')->findOneBy(
                            array(
                                'contact' => $em1->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $form_data['contact']),
                                'primaryRecord' => \ESERV\MAIN\Services\AppConstants::EMAIL_PRIMARY_REOCORD
                            )
                    );
                    if ($email) {
                        $email_address = $email->getEmailAddress();
                        $DataArray = array(
                            'user_role' => 'CE',
                            'username' => $form_data['username'],
                            'email' => $email_address,
                            'password' => $form_data['password'],
                            'fosGroup' => $form_data['fosGroup'],
                            'contact_id' => $form_data['contact'],
//                            'account_type' => isset($form_data['accountType']) ? $form_data['accountType'] : null,
                            'is_enabled' => 1,
                            'is_locked' => isset($form_data['locked']) ? $form_data['locked'] : 0,
                            'is_expired' => 0,
                        );
                        
                        $activation = false;
                        
                        if ($this->container->hasParameter('send_activation_link_for_new_user') &&
                                true === $this->container->getParameter('send_activation_link_for_new_user')) {
                            $activation = true;
                        }
                        
                        $res = $this->container->get('security_services')->createESERVUser($DataArray, $DataArray['password'], false, $activation);
                        $conf_token = $this->container->get('security_services')->getConfirmationToken($res['fos_user_id']);
                        $coreF = $this->get('core_function_services');
                        $contact = $em1->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $form_data['contact']);
                        $success_url = 'http://www.google.co.uk'; //temp - working on it
                        $url = $this->container->get('core_function_services')->getFullHost() . $this->container->get('router')->getContext()->getBaseUrl() . '/user/r/a/' . $coreF->eservEncode($conf_token) . '/' . $coreF->eservEncode($success_url);

                        $body_twig_data_arr = array(
                            'diplayName' => $contact->getDisplayName(),
                            'username' => $form_data['username'],
                            'password' => $form_data['password'],
                        );

                        if (true === $activation) {
                            $body_twig_data_arr['show_activation'] = true;
                            $body_twig_data_arr['activation_link'] = $url;
                        }

                        $arr = array(
                            'subject' => 'New user account has been created!',
                            'fromEmail' => 'admin@millertech.co.uk',
                            'toEmail' => $email_address,
                            'body' => $this->renderView('ESERVMAINCommunicationsBundle:ESERVEmailTemplate:layout.html.twig', array(
                                'header_text' => 'Account creation acknowledgement',
//                                'logo_path' => 'http://millertech.co.uk/images/template/mt_logo5.gif',
                                'show_footer' => true, //optional, default is true
                                'show_header' => true, //optional, default is true
                                'show_disclaimer' => true, //optional, default is true
                                'show_contact_details' => true, //optional, default is true                                            
                                'show_social_media' => true, //optional, default is true    
                                'body_twig' => $this->renderView('ESERVTestBundle:Default:email_body_test.html.twig', $body_twig_data_arr)
                                    )
                            )
                        );

                        if ($this->container->hasParameter('send_email_for_new_user') &&
                                true === $this->container->getParameter('send_email_for_new_user')) {
                            $email = $this->container->get('eserv_email_services')->sendEmail($arr);
                            $message = $res['msg'];

                            if ($email) {
                                $message = 'Account has been created and system has sent an email to the user!!';
                            } else {
                                $message = 'Account created but email failed to send!';
                            }
                        } else {
                            $message = 'Account has been successfully created';
                        }

                        $status = true;
                        $em1->getConnection()->commit();
                    } else {
                        $message = 'No primary email address available for the selected contact. Please insert a primary email through edit contact first.';
                    }
                } else {
                    $message = 'Username already exists in the system. Please pick a different username.';
                }
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

    public function editUserAction($id, Request $request) {
        if (isset($id) && $id != '') {
            $em = $this->getDoctrine()->getManager();

            $action_url = $this->generateUrl('eserv_main_administration_users_update', array('id' => $id));

            $form_options_array = array(
                'action' => $action_url,
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'),
                'ac_urls' => array(
                    'people' => $this->generateUrl('eserv_main_administration_people_search_ac')
                )
            );


            $mm_user_settings = $em->getReference('ESERV\MAIN\ProfileBundle\Entity\MmUserSetting', $id);
            $fos_id = $mm_user_settings->getFosUser()->getId();
            $fos_user = $em->getReference('ESERV\MAIN\SecurityBundle\Entity\ESERVUser', $fos_id);

            $enabled = $fos_user->getEnabled();
            #Log 9044566 start
            $activation_message = '';
            if ($enabled) {
                $activation_allowed = TRUE;
            } else {
                $rel = $mm_user_settings->getRelationship();
                if ($rel) {                
                    if (is_object($rel->getEndDate())) {
                        $activation_allowed = FALSE;
                        $activation_message = 'The user does not have a current relationship to an Organisation - an activation email cannot be sent.';
                    } else {
                        $activation_allowed = TRUE;
                    }
                } else {
                    $activation_allowed = TRUE;
                }
            }
            #Log 9044566 end
            $_user_groups = $em->createQueryBuilder()
                    ->select('g')
                    ->from('ESERVMAINSecurityBundle:User', 'u')
                    ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
                    ->leftJoin('ESERVMAINSecurityBundle:Group', 'g', 'WITH', 'g.id = ug.group')
                    ->andWhere('u.id = :userId')
                    ->setParameter('userId', $fos_id)
                    ->getQuery()
                    ->getArrayResult()
            ;

            $data = array(
                'contact' => $mm_user_settings->getContact()->getId(),
                'username' => $fos_user->getUserName(),
                'email' => $fos_user->getEmail(),
                'fosGroup' => $_user_groups,
//                'accountType' => $mm_user_settings->getAccountType(),
                'locked' => $fos_user->getLocked(),
                'enabled' => $enabled,
            );

            $ac_values = array(
                'contact_ac' => array(
                    'name' => $mm_user_settings->getContact()->getDisplayName(),
                    'value' => $mm_user_settings->getContact()->getId()
            ));

            $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\UserForm\EditUserType(), $data, $form_options_array);

            return $this->render('ESERVMAINAdministrationBundle:User:edit.html.twig', array(
                        'form' => $form->createView(),
                        'ac_values_arr' => $ac_values,
                        'id' => $fos_id,
                        'mm_user_setting_id' => $mm_user_settings->getId(),
                        'extra_data' => array(
                            'la_user_group' => \ESERV\MAIN\Services\AppConstants::FOS_GROUP_LOCAL_AUTHORITY
                        ),
                        'enabled' => $enabled,
                        #Log 9044566 start
                        'user_groups' => $_user_groups,
                        'activation_allowed' => $activation_allowed,
                        'activation_message' => $activation_message
                        #Log 9044566 end
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
        $form_options_array = array(
            'ac_urls' => array(
                'people' => $this->generateUrl('eserv_main_administration_people_search_ac')
            )
        );
        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\UserForm\EditUserType(), null, $form_options_array);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();
            $form_data = $request->request->get('new_admin_user');
            try {

                $mm_user_settings = $em1->getReference('ESERV\MAIN\ProfileBundle\Entity\MmUserSetting', $id);
                $fos_user = $em1->getReference('ESERV\MAIN\SecurityBundle\Entity\ESERVUser', $mm_user_settings->getFosUser()->getId());

                $fos_user->setLocked(isset($form_data['locked']) ? $form_data['locked'] : 0);
                if(!empty($form_data['email'])){
                     $fos_user->setEmail($form_data['email']);
                     $fos_user->setEmailCanonical($form_data['email']);
                }
               
//                $fos_group = $em1->getReference('ESERV\MAIN\SecurityBundle\Entity\ESERVUserGroup', $mm_user_settings->getFosUser()->getId());
//                $group_entity = $em1->getReference('ESERV\MAIN\SecurityBundle\Entity\Group', $form_data['fosGroup']);
//                if ($group_entity) {
//                    $fos_group->setGroup($group_entity);
//                } else {
//                    $message = 'Selected group is invalid. Please re-select the group.';
//                    $status = false;
//                }
//                if(isset($form_data['accountType']) && $form_data['accountType'] != null){
//                    $app_code = $em1->getReference('ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', $form_data['accountType']);
//                    if($app_code){
//                        $mm_user_settings->setAccountType($app_code);      
//                    } 
//                }else{
//                    $mm_user_settings->setAccountType(null);    
//                }

                $em1->flush();

                $em1->getConnection()->commit();
                $status = true;
                $message = 'User (' . $form_data['username'] . ') has been successfully updated!';
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
            $mm_user_settings = $em1->getReference('ESERV\MAIN\ProfileBundle\Entity\MmUserSetting', $id);
            $mm_user_setting_org = $em1->getRepository('ESERVMAINProfileBundle:MmUserSettingOrg')->findOneBy(array('mmUserSetting' => $mm_user_settings));
            $fos_user = $em1->getReference('ESERV\MAIN\SecurityBundle\Entity\ESERVUser', $mm_user_settings->getFosUser()->getId());
            
            if ($mm_user_setting_org) {
                $em1->remove($mm_user_setting_org);
            }
            
            $em1->remove($mm_user_settings);
            
            $relationship = $em1->getReference('ESERV\MAIN\ProfileBundle\Entity\MmUserSetting', $id)->getRelationship();
            if($relationship){
               $em1->remove($relationship); 
            }
           
            $em1->remove($fos_user);
            $em1->flush();

            $em1->getConnection()->commit();
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
            return $message;
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
