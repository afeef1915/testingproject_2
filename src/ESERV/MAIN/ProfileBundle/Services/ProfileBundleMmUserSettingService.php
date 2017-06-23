<?php

namespace ESERV\MAIN\ProfileBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ProfileBundleMmUserSettingService extends Controller {

    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $c->get('core_function_services');
        $this->dbCore = $c->get('db_core_function_services');
    }

    public function getOneByFosUserId($fos_user_id, $relationships = true, $type = 'array') {
        /*
         * Samir TODO::To be revised
         * 
          $result = $this->em->createQueryBuilder();

          if ($relationships === true) {
          $result = $result->select('p')
          ->from('ESERVMAINProfileBundle:MmUserSetting', 'p');
          } else {
          $result = $result->select('p')
          ->from('ESERVMAINProfileBundle:MmUserSetting', 'p');
          }
          $result = $result
          ->leftJoin('p.fosUser', 'f')
          ->where('f.id = :fos_user_id')
          ->setParameter('fos_user_id', $fos_user_id)
          ->setMaxResults(1)->getQuery();

          if (!$result) {
          throw $this->createNotFoundException(
          'No User Settings record found for fos_user_id ' . $fos_user_id
          );
          } else {
          return $this->coreF->GetOutputFormat($result, $type);
          }
         */
        $result = $this->em->createQueryBuilder()
                        ->select('p', 'u.id userId, c.id contactId')
                        ->from('ESERVMAINProfileBundle:MmUserSetting', 'p')
                        ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'p.fosUser = u.id')
                        ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'p.contact = c.id')
                        ->where('u.id = :fos_user_id')
                        ->setParameter('fos_user_id', $fos_user_id)
                        ->setMaxResults(1)->getQuery();

        if (!$result) {
            throw $this->createNotFoundException(
                    'No User Settings record found for fos_user_id ' . $fos_user_id
            );
        } else {
            //return $this->coreF->GetOutputFormat($result, $type);
            return $result->getSingleResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
        }

        /*
          $qb = $this->em->createQueryBuilder();
          $qry= $qb->select('u.id userId, c.id contactId')
          ->from('ESERVMAINProfileBundle:MmUserSetting', 'p')
          ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'p.fosUser = u.id')
          ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'p.contact = c.id')
          ->where('u.id = :fos_user_id')
          ->setParameter('fos_user_id', $fos_user_id)
          ->getQuery();
          return $qry->getSingleResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
         */
    }

    public function updateMmUserSetting($fos_user_id, $data) {
        $em = $this->em;

        $mm = $em->getRepository('ESERVMAINProfileBundle:MmUserSetting')
                ->findOneBy(array('fosUser' => $fos_user_id));

        if (!$mm) {
            throw new \Exception('Unable to update the user!', 500);
        } else {
            try {
                if (isset($data['auto_save'])) {
                    $mm->setAutoSave($data['auto_save']);
                }
                if (isset($data['language'])) {
                    $mm->setLanguage($data['language']);
                }
                if (isset($data['last_viewed_news'])) {
                    $mm->setLastViewedNews($data['last_viewed_news']);
                }
                if (isset($data['layout_state'])) {
                    $mm->setLayoutState($data['layout_state']);
                }
                if (isset($data['menu_state'])) {
                    $mm->setMenuState($data['menu_state']);
                }
                if (isset($data['status_date'])) {
                    $mm->setStatusDate($data['status_date']);
                }
                if (isset($data['theme'])) {
                    $mm->setTheme($data['theme']);
                }
                if (isset($data['theme_font_size'])) {
                    $mm->setThemeFontSize($data['theme_font_size']);
                }
                if (isset($data['theme_width'])) {
                    $mm->setThemeWidth($data['theme_width']);
                }
                if (isset($data['external_id'])) {
                    $mm->setExternalId($data['external_id']);
                }
                $this->em->persist($mm);
                $em->flush();

                return true;
            } catch (\Exception $e) {
                throw $e;
            }
        }
    }

    public function deleteMmUserSetting($fos_user_id) {
        $em = $this->em;

        $mm = $em->getRepository('ESERVMAINProfileBundle:MmUserSetting')
                ->findOneBy(array('fos_user_id' => $fos_user_id));


        if (!$mm) {
            throw $this->createNotFoundException(
                    'No record found in mm_user_setting table for fos_user_id - ' . $fos_user_id
            );
        } else {
            $em->remove($mm);
            $em->flush();
        }
    }

    public function checkRecordExistsByContactId($contact_id) {
        $em = $this->em;
        $record_exists = false;

        $mm = $em->getRepository('ESERVMAINProfileBundle:MmUserSetting')
                ->findOneBy(array('contact' => $contact_id));

        if ($mm) {
            $record_exists = true;
        }

        return $record_exists;
    }

}
