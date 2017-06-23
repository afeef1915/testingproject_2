<?php

namespace ESERV\MAIN\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use ESERV\MAIN\ProfileBundle\Entity\MmUserSetting;
use ESERV\MAIN\ProfileBundle\Services\ProfileBundleMmUserSettingService;

class ESERVSecurity extends Controller {

    private $em;
    private $c;
    private $coreFunctions;
    //current logged in user's username
    private $username;
    private $userId = null;

    /*     * ***************************************************************************
     * Name: __construct
     * 
     * Purpose: Intitialize the File System. 
     *         
     * @param n/a (Parameters are being injected automatically) *
     * 
     * @return n/a *  
     *
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------   * 
     * 100 | 04/04/2014 |  A Silva  | -
     * ************************************************************************** */

    public function __construct(EntityManager $Em, Container $C) {
        $this->em = $Em;
        $this->c = $C;
        $this->coreFunctions = $this->c->get('core_function_services');
//        Samir: The following lines should replace the ones below :-)
//        if (null !== $this->c->get('security.context')->getToken()) {
//            $this->username = trim($this->c
//                        ->get('security.context')
//                        ->getToken()
//                        ->getUserName());
//        }
        $this->username = trim($this->c
                        ->get('security.context')
                        ->getToken()
                        ->getUserName());
        $user = $this->c->get('security.context')->getToken()->getUser();
        if(is_object($user)){
            $this->userId = $user->getId();
        }
    }

    /*     * ***************************************************************************
     * Name: getFosUserId
     * 
     * Purpose: Returns the logged in users 'id' in fos_user table
     *         
     * @return [int] user id 
     * 
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 04/04/2014 |  A Silva  | -  
     * ************************************************************************** */

    public function getFosUserId() {
//        $query = $this->em
//                        ->createQueryBuilder()
//                        ->select('p.id')
//                        ->from('ESERVMAINSecurityBundle:User', 'p')
//                        ->where('p.username = :u')
//                        ->setParameter('u', $this->username)
//                        ->getQuery()->getSingleResult();
//
//        return (int) $query['id'];
        return $this->userId;
    }

    public function getLoggedInUser() {
//        $this->c->get('security.context')->getToken()->getUser();
        return $this->em->getRepository('ESERVMAINSecurityBundle:User')->findOneBy(array('id' => $this->getFosUserId()));
    }

    /*     * ***************************************************************************
     * Name: getFosUserSalt
     * 
     * Purpose: Returns the logged in users 'salt' in fos_user table
     *         
     * @return [int] user id 
     * 
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 22/05/2014 |  A Silva  | -  
     * ************************************************************************** */

    public function getFosUserSalt() {
        $query = $this->em
                        ->createQueryBuilder()
                        ->select('p.salt')
                        ->from('ESERVMAINSecurityBundle:User', 'p')
                        ->where('p.username = :u')
                        ->setParameter('u', $this->username)
                        ->getQuery()->getSingleResult();

        return $query['salt'];
    }

    /*     * ***************************************************************************
     * Name: getFosUserRecord
     * 
     * Purpose: Returns the logged in user's row in fos_user table
     * 
     * @param <type> 
     *         
     * @return Returns an array/doctrine/xml/json, depends on the type.
     * 
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 04/04/2014 |  A Silva  | -  
     * ************************************************************************** */

    public function getFosUserRecord($Type = 'array') {
        $query = $this->em
                ->createQueryBuilder()
                ->select('p')
                ->from('ESERVMAINSecurityBundle:User', 'p')
                ->where('p.username = :u')
                ->setParameter('u', $this->username)
                ->getQuery();

        $FormattedQuery = $this->coreFunctions->GetOutputFormat($query, $Type);
        return $FormattedQuery;
    }

    /**
     * Create a new ESERV user (with group, settings) from a contact
     *
     * @param int $contact_id The contact ID
     * @param string $username The username
     * @param string $password The password
     * @return true on success, an error message on error
     * 
     * Username can be array as follows:
     * NOTE: Array index must be lowercase!
     * $username = array(
     *  'tr_4' => 'samir_trainer'
     *  'r_6' => 'samir_centre'
     *  'r_16' => 'samir_centre1'
     *  'r_62' => 'samir_centre2'
     *  'tr_76' => 'samir_trainer4'
     *  'cm_79' => 'samir_moderator'
     * );
     */
    public function createUserFromContact($contact_id, $username, $password = '') {

        if (isset($contact_id)) {
            $eserv_user_created_result = '';

            if (!is_null($contact_id)) {

                $contact_service = new \ESERV\MAIN\ContactBundle\Services\ContactBundleContactService($this->em, $this->c);
                $ContactRecord = $contact_service->show($contact_id);

                if ($ContactRecord) {
                    $email = $ContactRecord[0]['email'][0]['email_address'];

                    if (!is_null($email)) {

                        $DataArray = array(
                            'password' => $password,
                            'email' => $email,
                            'is_enabled' => 1,
                            'is_locked' => 0,
                            'is_expired' => 0,
                        );

                        $this->em->getConnection()->beginTransaction();
                        try {
                            $contact_role = $this->em
                                    ->createQueryBuilder()
                                    ->select('p.id', 'crt.code')
                                    ->from('ESERVMAINContactBundle:ContactRole', 'p')
                                    ->leftJoin('p.contact_role_type', 'crt')
                                    ->where('p.contact_id = :c')
                                    ->setParameter('c', $contact_id)
                                    ->getQuery();
                            $contact_role_record = $this->coreFunctions->GetOutputFormat($contact_role, 'array');

                            foreach ($contact_role_record as $cri) {
                                $contact_role_id = $cri['id'];
                                $contact_role_type_code = $cri['code'];
                                $DataArray['user_role'] = strtoupper($contact_role_type_code);

                                if (!is_array($username)) {
                                    $DataArray['username'] = $username . '_cr_' . $contact_role_id;
                                    $eserv_user_created_result .= $this->createESERVUser($DataArray, $password, $contact_role_id);
                                } else {
                                    $tmp_array_index = strtolower($contact_role_type_code) . '_' . $contact_role_id;
                                    echo $tmp_array_index . '<br/>';
                                    if (array_key_exists($tmp_array_index, $username)) {
                                        $DataArray['username'] = $username[$tmp_array_index];
                                        $eserv_user_created_result .= $this->createESERVUser($DataArray, $password, $contact_role_id);
                                    }
                                }
                            }

                            $relationships = $this->em
                                    ->createQueryBuilder()
                                    ->select('p.id')
                                    ->from('ESERVMAINContactBundle:Relationship', 'p')
                                    ->leftJoin('p.relationship_type', 'rt')
                                    ->where('p.contact_id_a = :c')
                                    ->setParameter('c', $contact_id)
                                    ->andWhere('rt.description = :d')
                                    ->setParameter('d', 'Centre/Main Contact')
                                    ->andWhere('p.end_date IS NULL '
                                            . ' OR 1 = 1')
                                    ->getQuery();
                            $relationship_record = $this->coreFunctions->GetOutputFormat($relationships, 'array');

                            foreach ($relationship_record as $ri) {
                                $relationship_id = $ri['id'];
                                $DataArray['user_role'] = strtoupper('CE');

                                if (!is_array($username)) {
                                    $DataArray['username'] = $username . '_r_' . $relationship_id;
                                    $eserv_user_created_result .= $this->createESERVUser($DataArray, $password, null, $relationship_id);
                                } else {

                                    $tmp_array_index = 'r_' . $relationship_id;
                                    echo $tmp_array_index . '<br/>';
                                    if (array_key_exists($tmp_array_index, $username)) {
                                        $DataArray['username'] = $username[$tmp_array_index];
                                        $eserv_user_created_result .= $this->createESERVUser($DataArray, $password, null, $relationship_id);
                                    }
                                }
                            }

                            $this->em->getConnection()->commit();
                        } catch (Exception $e) {
                            $this->em->getConnection()->rollback();
                            $eserv_user_created_result .= 'ESERV User cannot be created. Error: ' . $e->getMessage();
                        }
                    } else {
                        $eserv_user_created_result .= 'ESERV User cannot be created. Error: Invalid email';
                    }
                } else {
                    $eserv_user_created_result .= 'ESERV User cannot be created. Error: Contact not found';
                }
            } else {
                $eserv_user_created_result .= 'ESERV User cannot be created. Error: Contact not found';
            }
            return $eserv_user_created_result;
        } else {
            return 'Contact ID could not found.';
        }
    }

    public function createFosUser($DataArray, $CreateConfToken = true) {
        $em = $this->em;
        $fos_user_id = false;

        try {
            $user = new \ESERV\MAIN\SecurityBundle\Entity\ESERVUser();
            $user_org = new \ESERV\MAIN\SecurityBundle\Entity\User();

            $encoder = $this->c->get('security.password_encoder');
            $password = $encoder->encodePassword($user_org, $DataArray['password']);
            $salt = $user_org->getSalt();

            if ($CreateConfToken) {
                /* User registration activation token */
                $conf_token = $this->generateConfirmationToken($DataArray['username'], $password, $salt);
                $user->setConfirmationToken($conf_token);
            }


            $user->setUsername($DataArray['username']);
            $user->setUsernameCanonical($DataArray['username']);
            $user->setEmail($DataArray['email']);
            $user->setEmailCanonical($DataArray['email']);
            $user->setPassword($password);
            $user->setRoles($user_org->getRoles());
            $user->setEnabled(isset($DataArray['is_enabled']) ? $DataArray['is_enabled'] : NULL);
            $user->setLocked(isset($DataArray['is_locked']) ? $DataArray['is_locked'] : NULL);
            $user->setExpired(isset($DataArray['is_expired']) ? $DataArray['is_expired'] : NULL);
            $user->setExpiresAt(isset($DataArray['expires_at']) ? $DataArray['expires_at'] : NULL);
            $user->setSalt($salt);
            $user->setCredentialsExpired(0);


            $group_entity = $this->em->getRepository('ESERVMAINSecurityBundle:Group')->find($DataArray['fosGroup']);
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

    public function createMmUserSettingRecord($ESERVUser) {
        $mm_user_setting_id = false;
        $em = $this->em;
        try {

            $mm_user_profile = $em->getRepository('ESERVMAINProfileBundle:MmUserProfile')->find(1);

            $eserv_role = new \Security\EservRoleBundle\Entity\EservRole();
            $this->em->persist($eserv_role);
            $this->em->flush();

            $mm_user_setting = new MmUserSetting();
            $mm_user_setting->setMmUserProfile($mm_user_profile);
            $mm_user_setting->setTheme($ESERVUser['theme']);
            $mm_user_setting->setLanguage($ESERVUser['language']);
            $mm_user_setting->setMenuState($ESERVUser['menu_state']);
            $mm_user_setting->setAutoSave($ESERVUser['auto_save']);
            
            $fos_user = $em->getReference('ESERV\MAIN\SecurityBundle\Entity\User', $ESERVUser['fos_user_id']);
            $contact = $em->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $ESERVUser['contact_id']);
            


            $mm_user_setting->setFosUser($fos_user);
            $mm_user_setting->setContact($contact);
            $mm_user_setting->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
            $mm_user_setting->setLastViewedNews(new \DateTime(date('Y-m-d H:i:s')));
            $mm_user_setting->setLayoutState('Test Layout State');
            $mm_user_setting->setStatusDate(new \DateTime(date('Y-m-d H:i:s')));
            $mm_user_setting->setThemeFontSize('12');
            $mm_user_setting->setThemeWidth('720');
            $mm_user_setting->setEservRole($eserv_role);
            
            if(!empty($ESERVUser['relationship_id'])){
                $relationship = $em->getReference('ESERV\MAIN\ContactBundle\Entity\Relationship', $ESERVUser['relationship_id']);
                $mm_user_setting->setRelationship($relationship);
            }            
            
            if (!is_null($ESERVUser['account_type_id'])) {
                $app_code = $em->getReference('ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', $ESERVUser['account_type_id']);
                if ($app_code) {
                    $mm_user_setting->setAccountType($app_code);
                }
            }


            $this->em->persist($mm_user_setting);
            $this->em->flush();
            $mm_user_setting_id = $mm_user_setting->getId();
        } catch (Exception $e) {
            $mm_user_setting_id = false;
            throw new \Exception('Mm User Settings record cannot be created (fos_user_id: ' . $ESERVUser['fos_user_id'] . '). Error: ' . $e->getMessage());
        }

        return $mm_user_setting_id;
    }

    public function createESERVUser($DataArray, $password, $with_mm_user_org = false, $with_conf_token = true, $relationship = array()) {
        $res = '';
        $fos_user_id = $this->createFosUser($DataArray, $with_conf_token);
        $status = false;

        if ($fos_user_id !== false) {
            $ESERVUser = array(
                'theme' => 'mtl',
                'language' => 'en',
                'menu_state' => 'grid_menu',
                'auto_save' => 10,
                'fos_user_id' => $fos_user_id,
                'contact_id' => $DataArray['contact_id'],
                'account_type_id' => isset($DataArray['account_type']) ? $DataArray['account_type'] : null,
                'relationship_id' => isset($DataArray['relationship_id']) ? $DataArray['relationship_id'] : null
            );

            $mm_user_setting_id = $this->createMmUserSettingRecord($ESERVUser);
            if ($with_mm_user_org == true) {
                $mm_org_ser = new \ESERV\MAIN\ProfileBundle\Services\ProfileBundleMmUserSettingOrgService($this->em, $this->c);
                $mm_org_ser->createRecord($mm_user_setting_id, $DataArray['org_contact_id']);
            }
            
            if (count($relationship) > 0) {
                $mm_org_ser = new \ESERV\MAIN\ContactBundle\Services\ContactBundleRelationshipService($this->em, $this->c);
                $mm_org_ser->createRecord(array(
                    'contact_a_id' => $relationship['contact_a_id'],
                    'contact_b_id' => $relationship['contact_b_id'],
                ), $relationship['type_id']);
            }

            if ($mm_user_setting_id) {
                $msg = '<br />'
                        . 'Username: ' . $DataArray['username'] . '<br />'
                        . 'Password: ' . $password
                        . '<hr />';
                $fos_id = $fos_user_id;
                $status = true;
            } else {
                $msg .= '<br />Username (' . $DataArray['username'] . ') could not be created!<br />';
                $fos_id = null;
            }
        }

        $result = array(
            'status' => $status,
            'msg' => $msg,
            'fos_user_id' => $fos_id
        );

        return $result;
    }

    public function deleteESERVUser($user_name) {
        $em = $this->em;
        try {
            $mm = $em->getRepository('ESERVMAINSecurityBundle:User')
                    ->findOneBy(array('username' => $user_name));

            if (!$mm) {
                throw $this->createNotFoundException(
                        'No record found in fos_user table for username - ' . $user_name
                );
            } else {
                $fos_user_id = $mm->getId();

                $em->getConnection()->beginTransaction();

                //Deleting from the mm_user_setting
                $mm = new ProfileBundleMmUserSettingService($this->em, $this->c);
                $mm->deleteMmUserSetting($fos_user_id);

                //Deleting from fos_user and fos_user_group
                $userManager = $this->c->get('fos_user.user_manager');
                $user = $userManager->findUserByUsername($user_name);
                $userManager->deleteUser($user);

                $em->getConnection()->commit();
                $em->flush();
            }
        } catch (Exception $e) {
            $em->getConnection()->rollBack();
            throw new \Exception('FOS User Cannot be deleted for username ' . $user_name . '). Error: ' . $e->getMessage());
        }
    }

    public function getUserTempFolder($type = 'relative') {
        $fos_user_id = $this->getFosUserId();

        $path = '';

        $users_path = $this->c->get('kernel')->getRootDir() . '/../web/common/tmp/users';

        if (!is_dir($users_path)) {
            mkdir($users_path);
        }

        $user_path = $this->c->get('kernel')->getRootDir() . '/../web/common/tmp/users/' . $fos_user_id;

        if (!is_dir($user_path)) {
            mkdir($user_path);
        }

        switch ($type) {
            case 'relative':
                $path = $this->c->get('templating.helper.assets')->getUrl('common/tmp/users/' . $fos_user_id . '/');
                break;
            case 'absolute':
                $path = $this->c->get('kernel')->getRootDir() . '/../web/common/tmp/users/' . $fos_user_id . '/';
                break;
            default :
                throw new \Exception('Unknown path type', 500);
        }

        return $path;
    }

    /**
     * Programmatically log in user based on exisitng username.
     *
     * @param String $username (Mandatory)  
     * 
     * @return n/a
     * @throw Exception
     */
    public function logInUserByUsername($username) {
        $em = $this->em;
        $repo = $em->getRepository("ESERVMAINSecurityBundle:User"); //Entity Repository
        $user = $repo->findOneBy(array('username' => $username));
        try {
            if (!$user) {
                throw new \Symfony\Component\Security\Core\Exception\UsernameNotFoundException("User not found");
            } else {
                $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($user, null, "main", $user->getRoles());
                $this->c->get("security.context")->setToken($token); //now the user is logged in
                //now dispatch the login event
                $request = $this->c->get("request");
                $event = new \Symfony\Component\Security\Http\Event\InteractiveLoginEvent($request, $token);
                $this->c->get("event_dispatcher")->dispatch("security.interactive_login", $event);
            }
        } catch (\Exception $e) {
            #return $e->getMessage();
            return false;
        }

        return true;
    }

    public function generateConfirmationToken($username, $password, $salt) {
        $str = $username . $password . $salt . mt_rand() . time();
        $token = md5($str);
        return $token;
    }

    /*     * ***************************************************************************
     * Name: getConfirmationToken
     * 
     * Purpose: Returns the confirmation token of a given user
     *         
     * @return String
     * 
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 23/01/2015 |  A Silva  | -  
     * ************************************************************************** */

    public function getConfirmationToken($fos_user_id) {
        $query = $this->em
                        ->createQueryBuilder()
                        ->select('p.confirmationToken')
                        ->from('ESERVMAINSecurityBundle:User', 'p')
                        ->where('p.id = :id')
                        ->setParameter('id', $fos_user_id)
                        ->getQuery()->getSingleResult();

        return $query['confirmationToken'];
    }

    public function getUserByUsername($username) {
        return $this->em->createQueryBuilder()
                        ->select('mm', 'c', 'p', 'u', 'ug', 'g')
                        ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
                        ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
                        ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH', 'p.contact = c.id')
                        ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
                        ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
                        ->leftJoin('ESERVMAINSecurityBundle:Group', 'g', 'WITH', 'g.id = ug.group')
                        ->where('u.username = :username')
                        ->setParameter('username', $username)
                        ->getQuery()
                        ->setMaxResults(1)
                        ->getArrayResult()
        ;
    }
    
    public function getLoggedInUserName() 
    {
        return $this->username;
    }
    
    public function getFosUserIdByContactId($contact_id)
    {
        return $this->em->createQueryBuilder()
            ->select('u.id')
            ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
            ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
            ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
            ->where('c.id = :eservCId')
            ->setParameter('eservCId', $contact_id)
            ->getQuery()
            ->setMaxResults(1)
            ->getArrayResult()
        ;
    }
    
    public function getFosUsernameByContactId($contact_id)
    {
        return $this->em->createQueryBuilder()
            ->select('u.username AS USERNAME')
            ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
            ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
            ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
            ->where('c.id = :eservCId')
            ->setParameter('eservCId', $contact_id)
            ->getQuery()
            ->setMaxResults(1)
            ->getArrayResult()
        ;
    }

}
