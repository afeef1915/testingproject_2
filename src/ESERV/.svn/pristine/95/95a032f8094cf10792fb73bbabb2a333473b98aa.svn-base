<?php

namespace ESERV\MAIN\AdministrationBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class AdministrationBundleUserService extends Controller {

    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
    }
    
    //list Subjects
    public function ListUsers($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVMAINAdministrationBundle:EservVUser', $alias);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Subject found-- Function "ListUsers"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
     public function ValidLoggedInUserPassword($password) {
        $fos_user_id = $this->c->get('security_services')->getFosUserId();
        $user = $this->em->getRepository('ESERVMAINSecurityBundle:User')->find($fos_user_id);
        $encoder = $this->c->get('security.password_encoder');            
        $encoded_password = $encoder->encodePassword($user, $password);
        if ($encoded_password === $user->getPassword()){
            return true;
        }else{
            return false;
        }
    }
}
