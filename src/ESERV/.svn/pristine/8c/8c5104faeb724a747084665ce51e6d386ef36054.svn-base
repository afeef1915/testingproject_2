<?php

namespace ESERV\MAIN\ProfileBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use ESERV\MAIN\ProfileBundle\Entity\MmUserSettings;

class ProfileBundleMmUserSettingsService extends Controller {

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
        $result = $this->em->createQueryBuilder();

        if ($relationships === true) {
            $result = $result->select('p', 'cr', 'sh')
                    ->from('ESERVMAINProfileBundle:MmUserSettings', 'p')
                    ->leftJoin('p.contact_role', 'cr')
                    ->leftJoin('p.relationship', 'sh');
        } else {
            $result = $result->select('p')->from('ESERVMAINProfileBundle:MmUserSettings', 'p');
        }
        $result = $result->where('p.fos_user_id = :fos_user_id')->setParameter('fos_user_id', $fos_user_id)
                        ->setMaxResults(1)->getQuery();

        if (!$result) {
            throw $this->createNotFoundException(
                    'No User Settings record found for fos_user_id ' . $fos_user_id
            );
        } else {
            return $this->coreF->GetOutputFormat($result, $type);
        }
    }

    public function updateMmUserSettings($fos_user_id, $data) {
        $em = $this->em;
        
        $mm = $em->getRepository('ESERVMAINProfileBundle:MmUserSettings')
                 ->findOneBy(array('fos_user_id' => $fos_user_id));
       
        if (!$mm) {
            throw new \Exception('Unable to update the user!', 500);            
        }
        else{
            if(isset($data['auto_save'])){
                $mm->setAutoSave($data['auto_save']);
            }
            if(isset($data['language'])){
                $mm->setLanguage($data['language']);  
            }
            if(isset($data['last_viewed_news'])){
                $mm->setLastViewedNews($data['last_viewed_news']);
            }
            if(isset($data['layout_state'])){
                $mm->setLayoutState($data['layout_state']);
            }
            if(isset($data['menu_state'])){
                $mm->setMenuState($data['menu_state']);
            }
            if(isset($data['status_date'])){
                $mm->setStatusDate($data['status_date']);
            }
            if(isset($data['theme'])){
                $mm->setTheme($data['theme']);
            }
            if(isset($data['theme_font_size'])){
                $mm->setThemeFontSize($data['theme_font_size']);
            }
            if(isset($data['theme_width'])){
                $mm->setThemeWidth($data['theme_width']);
            }
            if(isset($data['external_id'])){
                $mm->setExternalId($data['external_id']);
            }
            if(isset($data['created_at'])){
                $mm->setCreatedAt($data['created_at']);
            }
            if(isset($data['updated_at'])){
                $mm->setUpdatedAt($data['updated_at']);
            }
            if(isset($data['created_by'])){
                $mm->setCreatedBy($data['created_by']);
            }
            if(isset($data['updated_by'])){
                $mm->setUpdatedBy($data['updated_by']);
            }
            $this->em->persist($mm);
            $em->flush();  
            
            return true;
        }       
           
    }
    
    public function deleteMmUserSettings($fos_user_id)
    {
        $em = $this->em;
        
        $mm = $em->getRepository('ESERVMAINProfileBundle:MmUserSettings')
                 ->findOneBy(array('fos_user_id' => $fos_user_id));
        
       
        if (!$mm) {
            throw $this->createNotFoundException(
                    'No record found in mm_user_settings table for fos_user_id - ' . $fos_user_id
            );                       
        }
        else{
           $em->remove($mm);
           $em->flush();
        }
    }

}
