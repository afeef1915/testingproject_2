<?php

namespace Security\UserBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use MERLINORA\CORE\Services\MERLINORAConstants;

class UserBundleRegistrationService extends Controller
{

    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c = NULL)
    {
        $this->em = $em;
        $this->c = $c;
        if (!is_null($c)) {
            $this->coreF = $c->get('core_function_services');
            $this->dbCore = $c->get('db_core_function_services');
        } else {
            $this->coreF = NULL;
            $this->dbCore = NULL;
        }
    }
    
    public function registerWeblogsUser($user_data, $send_email = true, $success_url = null, $extra_options = array())
    {
        $status = false;
        $em = $this->em;
        $c = $this->c;
        $message = '';
        $fos_user_id=$user_data['fos_user_id'];
        $person_id = $user_data['person_id'];
        $username =  $user_data['username'];
        $email =  $user_data['email'];
        $password = $user_data['password'];
        $fos_group_id = $user_data['fos_group'];
        $create_conf_token = $user_data['create_conf_token'];
        $is_locked = $user_data['is_locked'];
        $is_expired = $user_data['is_expired'];
        $person_name = $user_data['person_name'];
        $is_enabled = $user_data['is_enabled'];

        $fos_group = $em->getRepository('ESERVMAINSecurityBundle:Group')->find($fos_group_id);

        if (!$fos_group) {
            throw new \Exception('Security group not defined! Please contact IT support');
        }
        
        
        
        $DataArray = array(
            'fos_user_id'=>$fos_user_id,
            'password' => $password,
            'username' => $username,
            'fos_group' => $fos_group_id,
            'email' => $email,
            'is_enabled' => 1,
            'is_locked' => $is_locked,
            'is_expired' => $is_expired,
            'is_enabled' => $is_enabled,
        );
        
        $fos_user_id = $this->createFosUser($DataArray, $create_conf_token);
        
        if ($fos_user_id != false) {
            $ESERVUser = array(
                'theme' => 'mtl',
                'language' => 'en',
                'menu_state' => 'grid_menu',
                'auto_save' => 10,
                'fos_user_id' => $fos_user_id,
                'person_id' => $person_id,
            );
            $mm_user_setting_id = $this->createMmUserSettingRecord($ESERVUser);
           
            if ($send_email) {                
                $conf_token = $this->c->get('security_services')->getConfirmationToken($fos_user_id);
                $url = isset($extra_options['activate_base_url']) ? $extra_options['activate_base_url'] . '/user/r/a/' . $this->c->get('core_function_services')->eservEncode($conf_token) . '/' . $this->c->get('core_function_services')->eservEncode($success_url) : $this->c->get('core_function_services')->getFullHost() . $this->c->get('router')->getContext()->getBaseUrl() . '/user/r/a/' . $this->c->get('core_function_services')->eservEncode($conf_token) . '/' . $this->c->get('core_function_services')->eservEncode($success_url);
                $data = array(
                    'fromEmail' => array(
                        $this->c->getParameter('merlin_emailing_from_email') => 'Merlin Web Access'
                    ),
                    'toEmail' => $email,
                    'subject' => 'Your Merlin Web Access Account has been created',
                    'body' => $this->c->get('templating')->render('ESERVMAINCommunicationsBundle:ESERVEmailTemplate:layout.html.twig', array(
                        'header_text' => 'Account creation acknowledgement',
                        'show_footer' => true, //optional, default is true
                        'show_header' => true, //optional, default is true
                        'show_disclaimer' => true, //optional, default is true
                        'show_contact_details' => true, //optional, default is true
                        'show_social_media' => true, //optional, default is true
                        'body_twig' => $this->c->get('templating')->render('SecurityUserBundle:Registration:user_reg_email.html.twig', array(
                            'diplayName' => $person_name,
                            'username' => $user_data['username'],
                            'password' => $user_data['password'],
                            'activation_link' => $url
                        ))
                    ))
                );

                if ($send_email) {
                    $send_user_email = $this->c->get('eserv_email_services')->sendEmail($data);
                    if ($send_user_email) {
                        $message = 'Email successfully sent to '.$email;
                    } else {
                        $message = 'Failed to send the email to '.$email. '. Please retry!';
                    }
                } else {
                    $message = 'Account successfully created';
                }
            }
        } else {
            $fos_user = $em->getRepository('ESERVMAINSecurityBundle:User')->findOneBy(array(
                'username' => $user_data['username']
            ));

            $fos_user_groups = $fos_user->getGroupNames();

            if (!in_array($fos_group_name, $fos_user_groups)) {
                try {
                    $fos_user->addGroup($fos_group);
                    $em->persist($fos_user);
                    $em->flush();

                    $status = true;
                    $message = $this->c->get('eserv_translation_services')->eservCustomTranslator('REG_ACC_CREATED_SUCCESS_MSG2');
                } catch (\Exception $ex) {
                    $status = false;
                    $message = $ex->getMessage();
                }
            } else {
                $status = false;
                $message = 'Duplicate Record!';
            }
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'fos_user_id' => $fos_user_id
        );

        return $result;
    }
    
    public function createFosUser($DataArray, $CreateConfToken = true) 
    {
        
        
        
      // print_r($DataArray['fos_user_id']);die;
        $em = $this->em;
        $fos_user_id = false;

        try {
            $user = new \Security\UserBundle\Entity\FosUser();
            $user_org = new \Security\UserBundle\Entity\User();

            $encoder = $this->c->get('security.password_encoder');
            $password = $encoder->encodePassword($user_org, $DataArray['password']);
            $salt = $user_org->getSalt();

            if ($CreateConfToken) {
                /* User registration activation token */
                $conf_token = $this->c->get('security_services')->generateConfirmationToken($DataArray['username'], $password, $salt);
                $user->setConfirmationToken($conf_token);
            }
          //  print_r(DataArray);die;
            $user->setId($DataArray['fos_user_id']);
            $user->setUsername($DataArray['username']);
            $user->setUsernameCanonical($DataArray['username']);
            $user->setEmail($DataArray['email']);
            $user->setEmailCanonical($DataArray['email']);
            $user->setPassword($password);
            $user->setRoles($user_org->getRoles());
            $user->setEnabled(isset($DataArray['is_enabled']) ? $DataArray['is_enabled'] : '0');
            $user->setLocked(isset($DataArray['is_locked']) ? $DataArray['is_locked'] : '0');
            $user->setExpired(isset($DataArray['is_expired']) ? $DataArray['is_expired'] : '0');
            $user->setSalt($salt);
            $user->setCredentialsExpired('0');

            $group_entity = $this->em->getRepository('SecurityUserBundle:Group')->find($DataArray['fos_group']);
            if ($group_entity) {
                $user->addGroup($group_entity);
            } else {
                throw new \Exception('User group does not exist.');
            }

            $em->persist($user);
            $em->flush();
            $fos_user_id = $user->getId();
        } catch (Exception $e) {
            $fos_user_id = false;
            throw new \Exception('FOS User cannot be created. Error: ' . $e->getMessage());
        }

        return $fos_user_id;
    }
    
    public function createMmUserSettingRecord($ESERVUser) 
    {
        $mm_user_setting_id = false;
        $em = $this->em;
        try {

            $mm_user_profile = $em->getRepository('SecurityUserBundle:MmUserProfile')->findOneBy(array(
                'code' => \Security\Services\SecurityConstants::MM_USER_PROF_ALLUSERS
            ));

            $mm_user_setting = new \Security\UserBundle\Entity\MmUserSetting();
            $mm_user_setting->setMmUserProfile($mm_user_profile);
            $mm_user_setting->setTheme($ESERVUser['theme']);
            $mm_user_setting->setLanguage($ESERVUser['language']);
            $mm_user_setting->setMenuState($ESERVUser['menu_state']);
            $mm_user_setting->setAutoSave($ESERVUser['auto_save']);
            
            $fos_user = $em->getReference('Security\UserBundle\Entity\User', $ESERVUser['fos_user_id']);

            $mm_user_setting->setFosUser($fos_user);
            $mm_user_setting->setPersonId($ESERVUser['person_id']);
            $mm_user_setting->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
            $mm_user_setting->setLastViewedNews(new \DateTime(date('Y-m-d H:i:s')));
            $mm_user_setting->setLayoutState('Test Layout State');
            $mm_user_setting->setStatusDate(new \DateTime(date('Y-m-d H:i:s')));
            $mm_user_setting->setThemeFontSize('12');
            $mm_user_setting->setThemeWidth('720');
            
            $this->em->persist($mm_user_setting);
            $this->em->flush();
            $mm_user_setting_id = $mm_user_setting->getId();
        } catch (Exception $e) {
            $mm_user_setting_id = false;
            throw new \Exception('Mm User Settings record cannot be created (fos_user_id: ' . $ESERVUser['fos_user_id'] . '). Error: ' . $e->getMessage());
        }

        return $mm_user_setting_id;
    }
    
    
    public function getUserEligible($person_id, $username, $fos_group_role = false)
    {   
        $status = false;
        $msg = '';
        
        $usernameExists = $this->checkUsernameExists($username);
        if($usernameExists['success']){
            $selectQuery = "SELECT email_address EMAIL FROM email "
                    . "WHERE person_id = '$person_id' "
                    ;

            $result = $this->dbCore->runRawSql($selectQuery); 
            if(empty($result)){
                $msg = 'User does not have any preferred email address';
            }
            else if(count($result) > 1){
                $msg = 'User has more than one preferred email address with end date is null';
            }else{
                $status = true;
                $msg = $result[0]['EMAIL'];
            }
        }else{
           $msg =  $usernameExists['msg'];
        }
        
        return array(
            'success' => $status,
            'msg' => $msg
        );
    }

    public function checkUsernameExists($username, $fos_role = false)
    {   
        $status = true;
        $msg = '';

        $selectQuery = "SELECT COUNT(*) C FROM fos_user "
                . "WHERE username = '$username' ";
        
        $result = $this->dbCore->runRawSql($selectQuery); 
        
        if($result[0]['C'] != 0){ 
            $status = false;
            $msg = 'Username ('.$username.') already exists, please pick another username';
        }
        
        return array(
            'success' => $status,
            'msg' => $msg
        );
    }
    
}
