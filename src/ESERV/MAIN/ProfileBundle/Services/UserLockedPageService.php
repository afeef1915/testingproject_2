<?php

namespace ESERV\MAIN\ProfileBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class UserLockedPageService extends Controller
{

    private $em;
    private $c;

    public function __construct(EntityManager $em, Container $c)
    {
        $this->em = $em;
        $this->c = $c;
    }

    public function getPageLockedStatus($pageCode, $pageId)
    {
        $locked = 'N/A';
        $sameUser = 'N/A';
        $sameLocation = 'N/A';

        try {
            $page_code = $this->c->get('core_function_services')->eservEncode($pageCode);
            $page_id = $this->c->get('core_function_services')->eservEncode($pageId);

            $this->deleteExpiredUserLockedPage();

            //page is unlocked
            if (!$this->isPageLocked($page_code, $page_id)) {
                $this->createUserLockedPage($page_code, $page_id);
                $locked = 'N';
            }
            //page is locked
            else {
                //page is locked by the same user
                if ($this->loggedInUserHasLockedPage($page_code, $page_id)) {
                    //page is locked in the same location
                    if ($this->isPageLockedWithSameSessionId($page_code, $page_id)) {
                        $this->updateUserLockedPage($page_code, $page_id);
                        $locked = 'Y';
                        $sameUser = 'Y';
                        $sameLocation = 'Y';
                    }
                    //page is locked in different location
                    else {
//                        $this->deleteUserLockedPage($page_code, $page_id, false);
//                        $this->createUserLockedPage($page_code, $page_id);
                        $locked = 'Y';
                        $sameUser = 'Y';
                        $sameLocation = 'N';
                    }
                }
                //page is locked by a different user
                else {
                    $locked = 'Y';
                    $sameUser = 'N';
                }
            }

            return array(
                'locked' => $locked,
                'sameUser' => $sameUser,
                'sameLocation' => $sameLocation,
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function loggedInUserHasLockedPage($page_code, $page_id)
    {

        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('ulp')
                ->from('ESERVMAINProfileBundle:UserLockedPage', 'ulp')
                ->where('ulp.pageCode = :pgcd')
                ->setParameter('pgcd', $page_code)
                ->andWhere('ulp.pageId = :pgid')
                ->setParameter('pgid', $page_id)
                ->andWhere('ulp.createdBy = :userId')
                ->setParameter('userId', $this->c->get('security.context')->getToken()->getUser()->getId())
                ->getQuery()
        ;

        $ulp = $this->c->get('core_function_services')->GetOutputFormat($result, 'array');

        if (count($ulp) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isPageLocked($page_code, $page_id)
    {   
        $current_time = date('Y-m-d H:i:s', time());
        $config_time_mins = $this->c->getParameter('locked_page_config')['total_time_minutes'];
        $datetime_from = date("Y-m-d H:i:s", strtotime("-$config_time_mins minutes", strtotime($current_time)));

        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('ulp')
                ->from('ESERVMAINProfileBundle:UserLockedPage', 'ulp')
                ->where('ulp.pageCode = :pgcd')
                ->andWhere('ulp.pageId = :pgid')
                ->andWhere('ulp.updatedAt >= :eservUpdatedAt')
                ->setParameter('pgcd', $page_code)
                ->setParameter('pgid', $page_id)
                ->setParameter('eservUpdatedAt', $datetime_from)
                ->getQuery()
        ;

        $ulp = $this->c->get('core_function_services')->GetOutputFormat($result, 'array');

        if (count($ulp) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Page is locked in a same browser / machine
    public function isPageLockedWithSameSessionId($page_code, $page_id)
    {
        $session_id = $this->c->get('session')->getId();
        $user_id = $this->c->get('security.context')->getToken()->getUser()->getId();

        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('ulp')
                ->from('ESERVMAINProfileBundle:UserLockedPage', 'ulp')
                ->where('ulp.pageCode = :pgcd')
                ->andWhere('ulp.pageId = :pgid')
                ->andWhere('ulp.createdBy = :userId')
                ->andWhere('ulp.phpSesId = :eservPhpSesId')
                ->setParameter('pgcd', $page_code)
                ->setParameter('pgid', $page_id)
                ->setParameter('userId', $user_id)
                ->setParameter('eservPhpSesId', $session_id)
                ->getQuery()
        ;

        $ulp = $this->c->get('core_function_services')->GetOutputFormat($result, 'array');

        if (count($ulp) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createUserLockedPage($page_code, $page_id)
    {
        $ulp = new \ESERV\MAIN\ProfileBundle\Entity\UserLockedPage();
        try {
            $this->em->getConnection()->beginTransaction();
            $ulp->setPageCode($page_code);
            $ulp->setPageId($page_id);
            $ulp->setPhpSesId($this->c->get('session')->getId());
            $ulp->setUpdatedAt(new \DateTime('now'));
            $this->em->persist($ulp);
            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch (\Exception $e) {
            $this->em->getConnection()->rollback();
            $message = $this->c->get('eserv_translation_services')->eservCustomTranslator('Error occurred:') . " " . $e->getMessage();
            throw new \Exception($message, 500);
        }
    }

    public function updateUserLockedPage($page_code, $page_id)
    {
        try {
            $ulp = $this->em->getRepository('ESERVMAINProfileBundle:UserLockedPage')->findOneBy(array(
                'pageCode' => $page_code,
                'pageId' => $page_id,
                'phpSesId' => $this->c->get('session')->getId(),
                'createdBy' => $this->c->get('security.context')->getToken()->getUser()->getId()
            ));
            if ($ulp) {
                $this->em->getConnection()->beginTransaction();
                $ulp->setUpdatedAt(new \DateTime('now'));
                $this->em->persist($ulp);
                $this->em->flush();
                $this->em->commit();
            }
        } catch (\Exception $e) {
            $this->em->getConnection()->rollback();
            $message = $this->c->get('eserv_translation_services')->eservCustomTranslator('Error occurred:') . " " . $e->getMessage();
            throw new \Exception($message, 500);
        }
    }

    public function deleteUserLockedPage($pageCode, $pageId, $same_location)
    {
        $status = false;
        $this->em->getConnection()->beginTransaction();
        try {
            $page_code = $pageCode;
            $page_id = $pageId;

            $session_id = $this->c->get('session')->getId();
            $user_id = $this->c->get('security.context')->getToken()->getUser()->getId();
            $qb = $this->em->createQueryBuilder();

            $query = $qb->select('ulp.id')
                    ->from('ESERVMAINProfileBundle:UserLockedPage', 'ulp')
                    ->where('ulp.pageCode = :pgcd')
                    ->andWhere('ulp.pageId = :pgid')
                    ->andWhere('ulp.createdBy = :userId')
            ;

            if (true === $same_location) {
                $query = $qb->andWhere('ulp.phpSesId = :eservPhpSesId');
            } else {
                $query = $qb->andWhere('ulp.phpSesId != :eservPhpSesId');
            }

            $query = $qb->setParameter('pgcd', $page_code)
                    ->setParameter('pgid', $page_id)
                    ->setParameter('userId', $user_id)
                    ->setParameter('eservPhpSesId', $session_id)
                    ->getQuery()
            ;

            $ids = $this->c->get('core_function_services')->GetOutputFormat($query, 'array');

            if (count($ids) > 1) {
                foreach ($ids as $k => $i) {
                    $ulp = $this->em->getRepository('ESERVMAINProfileBundle:UserLockedPage')->find($query[$k]['id']);
                    $this->em->remove($ulp);
                    $this->em->flush();
                    $this->em->commit();
                }
                $status = true;
            } else if(count($ids) != 0){
                $ulp = $this->em->getRepository('ESERVMAINProfileBundle:UserLockedPage')->find($ids[0]['id']);
                $this->em->remove($ulp);
                $this->em->flush();
                $this->em->commit();
                $status = true;
            }else{
                $status = true;
            }
        } catch (\Exception $e) {

            $this->em->getConnection()->rollback();
            $status = false;
        }

        return $status;
    }

    public function deleteExpiredUserLockedPage()
    {
        try {
            $this->em->getConnection()->beginTransaction();
            $qry = $this->em->createQueryBuilder()
                    ->delete('ESERVMAINProfileBundle:UserLockedPage', 'ulp')
                    ->where('ulp.updatedAt <= :expDate')
                    ->setParameter('expDate', $this->getLockedPageExpiredDateTime())
                    ->getQuery();

            $qry->execute();
            $this->em->getConnection()->commit();
        } catch (\Exception $e) {
            $this->em->getConnection()->rollback();
            $message = $this->c->get('eserv_translation_services')->eservCustomTranslator('Error occurred:') . " " . $e->getMessage();
            throw new \Exception($message, 500);
        }
    }

    public function getLockedPageExpiredDateTime()
    {
        $currentDate = new \DateTime('now');
        return $currentDate->modify("-" . $this->c->getParameter('locked_page_config')['total_time_minutes'] . " minutes");
    }

    public function getPageLockExistsOrExpired($pageCode, $pageId, $timeStamp, $delete_record = false)
    {
        $time = date('Y-m-d H:i:s', $this->c->get('core_function_services')->eservDecode($timeStamp));
        $config_time_mins = $this->c->getParameter('locked_page_config')['total_time_minutes'];
        $datetime_from = date("Y-m-d H:i:s", strtotime("-$config_time_mins minutes", strtotime($time)));

        $page_code = $this->c->get('core_function_services')->eservEncode($pageCode);
        $page_id = $this->c->get('core_function_services')->eservEncode($pageId);

        $session_id = $this->c->get('session')->getId();
        $user_id = $this->c->get('security.context')->getToken()->getUser()->getId();

        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('ulp')
                ->from('ESERVMAINProfileBundle:UserLockedPage', 'ulp')
                ->where('ulp.pageCode = :pgcd')
                ->andWhere('ulp.pageId = :pgid')
                ->andWhere('ulp.createdBy = :userId')
                ->andWhere('ulp.phpSesId = :eservPhpSesId')
                ->andWhere('ulp.updatedAt >= :eservUpdatedAt')
                ->setParameter('pgcd', $page_code)
                ->setParameter('pgid', $page_id)
                ->setParameter('userId', $user_id)
                ->setParameter('eservPhpSesId', $session_id)
                ->setParameter('eservUpdatedAt', $datetime_from)
                ->getQuery()
        ;

        $ulp = $this->c->get('core_function_services')->GetOutputFormat($result, 'array');
        
        if(true === $delete_record){
            $this->deleteUserLockedPage($page_code, $page_id, true);
        }
        
        if (count($ulp) > 0) {
            return true;
        } else {        
            return false;
        }
    }
    
    public function deleteUserLockedPageByUserId($user_id)
    {
        $em = $this->em;
        $ulp = $em->getRepository('ESERVMAINProfileBundle:UserLockedPage')->findBy(array('createdBy' => $user_id));
        foreach($ulp as $u){
            $em->remove($u);            
        }
        $em->flush();
    }
  
}
