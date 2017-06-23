<?php

namespace ESERV\MAIN\AdministrationBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use ESERV\MAIN\Services\AppConstants;
use ESERV\MAIN\Services\ErrorCodeConstants;

class AdministrationBundleInterfaceService extends Controller
{

    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c)
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $this->c->get('core_function_services');
        $this->dbCore = $this->c->get('db_core_function_services');
    }

    public function executeImport($postData)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $media_store_id = $postData['attachment'];
        $priority_id = $postData['priority'];
        
        $em = $this->em;

        try {
            $em->getConnection()->beginTransaction();
            $notif_pri = $em->getReference('ESERV\MAIN\SystemConfigBundle\Entity\SystemCode',$priority_id);
            
            $ext_bun_serv = new \ESERV\MAIN\ExternalBundle\Services\ExternalBundleQueuedDbProcessService($this->em, $this->c);
            $media_str_serv = new \ESERV\MAIN\MediaBundle\Services\MediaBundleMediaStoreService($this->em, $this->c);
            
            $qdb_data = array(
                'name' => $postData['name'],
                'description' => ($postData['description'] !== '') ? $postData['description'] : 'Test Description', //In response to Log: 9041856
                'notif_priority' => $notif_pri,
                'type' => AppConstants::ESERV_IMPORT_FILES
            );
            
            $process_vars = array(
                'File Id' => array(
                    'param_ext' => 'PDO::PARAM_STR, -1',
                    'param_type' => '1', // SQLT_CHR
                    'param_size' => '-1',
                    'value' => $media_store_id
                ),
                'Category' => array(
                    'param_ext' => 'PDO::PARAM_STR, -1',
                    'param_type' => '1', // SQLT_CHR
                    'param_size' => '-1',
                    'value' => $postData['category']
                )
            );
            
            if($postData['membershipOrg']){
                $process_vars['membershipOrg'] = array(
                    'param_ext' => 'PDO::PARAM_STR, -1',
                    'param_type' => '1', // SQLT_CHR
                    'param_size' => '-1',
                    'value' => $postData['membershipOrg']
                );
            }
            
            $queued_db_process_id = $ext_bun_serv->createQueuedDbRecord($qdb_data,$process_vars);         
            
            
            $media_str_serv->updateEntityNameAndId(
                    $media_store_id, 
                    AppConstants::ENTITY_NAME_QUEUED_DB_PROCCESS, 
                    $queued_db_process_id
            );
           
            
            $em->flush();
            $em->getConnection()->commit();

            $status = true;
            $message = ErrorCodeConstants::IMPORT_SUCCESS;
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
            $em->getConnection()->rollback();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
        $em->close();
        
        return $result;        
    }
    
    
    public function executeExport($postData)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $priority_id = $postData['priority'];
        
        $em = $this->em;

        try {
            $em->getConnection()->beginTransaction();
            $notif_pri = $em->getReference('ESERV\MAIN\SystemConfigBundle\Entity\SystemCode',$priority_id);
            
            $ext_bun_serv = new \ESERV\MAIN\ExternalBundle\Services\ExternalBundleQueuedDbProcessService($this->em, $this->c);
            
            $qdb_data = array(
                'name' => $postData['name'],
                'description' => ($postData['description'] !== '') ? $postData['description'] : 'Test Description', //In response to Log: 9041856
                'notif_priority' => $notif_pri,
                'type' => AppConstants::ESERV_EXPORT_FILES
            );
            
            $process_vars = array(                
                'Category' => array(
                    'param_ext' => 'PDO::PARAM_STR, -1',
                    'param_type' => '1', // SQLT_CHR
                    'param_size' => '-1',
                    'value' => $postData['category']
                )
            );
            
            $queued_db_process_id = $ext_bun_serv->createQueuedDbRecord($qdb_data,$process_vars);         
            
                        
            $em->flush();
            $em->getConnection()->commit();

            $status = true;
            $message = ErrorCodeConstants::EXPORT_SUCCESS;
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
            $em->getConnection()->rollback();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
        $em->close();
        
        return $result;        
    }
    
     public function getMembershipOrgChoice() {
        $membershipOrg = $this->em->createQueryBuilder()
                    ->select('mo.id, o.name, mo.code')
                    ->from('ESERVMAINMembershipBundle:MembershipOrg', 'mo')
                    ->leftJoin('mo.organisation', 'o')
                    ->andWhere('o.dateClosed IS NULL OR o.dateClosed >= :cDate')
                    ->setParameter('cDate', (new \DateTime()))
                    ->getQuery()
                    ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY)
                ;
        
        $result = array();
        foreach ($membershipOrg as $key => $value) {
            $result[$value['id']] = $value['name'];
        }
        return $result;
    }
    

}
