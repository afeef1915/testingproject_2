<?php

namespace ESERV\MAIN\WizardBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class WizardService extends Controller {

    private $em;
    private $c;
    private $qrylimit = 10;
    private $sessionName;

    public function __construct(EntityManager $em, Container $c, $session_name) 
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
        $this->sessionName = $session_name;
    }

    public function createNewWizard($type_code, $restart = false, $app_id = false) 
    {   
        $status = false;
        $msg = '';
        $application_id = null;
        $em = $this->em;
        $em->getConnection()->beginTransaction();
        
        try {
            if ($restart == 'Y') {
                $restart = true;
            }
            $application_id = ($app_id === false) ?$this->c->get('core_function_services')->getNewApplicationId($this->sessionName, $restart) : $app_id;
            $check = $em->getRepository('ESERVMAINWizardBundle:WzControl')->findOneBy(array('applicationId' => $application_id));
            $wz_type = $em->getRepository('ESERVMAINWizardBundle:WzType')
                    ->findOneBy(array('code' => $type_code));
            if (!$check) {
                $application = new \ESERV\MAIN\WizardBundle\Entity\WzControl();

                $wz_control_recs = $em->getRepository('ESERVMAINWizardBundle:WzControl')
                        ->findAll();
                $application->setId(count($wz_control_recs) + 1);
                

                $application->setApplicationId($application_id);
                $application->setWzType($wz_type);
                $application->setPassword('password');
                $application->setStarted('N');
                $application->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));

                $em->persist($application);
                $em->flush();

                if ($application) {
                    $num_of_pages = $wz_type->getNumOfPages();
                    for ($i = 1; $i <= $num_of_pages; $i++) {

                        $page = new \ESERV\MAIN\WizardBundle\Entity\WzPage();
                        $wz_pages_recs = $em->getRepository('ESERVMAINWizardBundle:WzPage')
                                ->findAll();
                        $page->setId(count($wz_pages_recs) + 1);

                        $page->setWzControl($application);
                        $page->setPageNo($i);

                        $em->persist($page);
                        $em->flush();
                    }
                }

                $em->getConnection()->commit();

                $msg = 'created';
                $status = true;
            } else {
                $msg = 'exists';
            }
        } catch (\Exception $e) {
            $em->getConnection()->rollBack();
            $msg = $e->getMessage();
            die('$msg - '.$msg);
        }

        return array(
            'status' => $status,
            'msg' => $msg,
            'application_id' => $application_id
        );
    }

    public function deleteWizard($app_id = false) 
    {
        $status = false;
        $msg = '';

        try {
            $em = $this->em;
            $application_id = $app_id ? $app_id : $this->c->get('core_function_services')->getCurrentApplicationId($this->sessionName);
            
//            $em->createQuery('DELETE FROM ESERV\MAIN\WizardBundle\Entity\WzPage wp WHERE wp.applicationId = :app_id')
//                    ->setParameter(':app_id', $application_id)
//                    ->execute();
//
//            $em->createQuery('DELETE FROM ESERV\MAIN\WizardBundle\Entity\WzControl wc WHERE wc.applicationId = :app_id')
//                    ->setParameter(':app_id', $application_id)
//                    ->execute();
            
            $wzControl = $em->getRepository('ESERVMAINWizardBundle:WzControl')->findOneBy(array('applicationId' => $application_id));
            if($wzControl){
                $wzPages = $em->getRepository('ESERVMAINWizardBundle:WzPage')->findBy(array('wzControl' => $wzControl));
                foreach($wzPages as $k => $v){
                    $em->remove($v);
                }                
                $em->remove($wzControl);                        
            }
            

            $msg = 'Deleted Successfully!';
            $status = true;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        return array(
            'status' => $status,
            'msg' => $msg,
        );
    }
    
    public function toggleStarted($started, $app_id = false)
    {
        $return = false;

        try {
            $em = $this->em;
            $application_id = $app_id ? $app_id : $this->c->get('core_function_services')->getCurrentApplicationId($this->sessionName);

            $wzControl = $em->getRepository('ESERVMAINWizardBundle:WzControl')->findOneBy(array(
                'applicationId' => $application_id
            ));
                    
            if($wzControl){
                $wzControl->setStarted($started);
                $em->flush();
            }
            
            $return = true;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }

        return $return; 
    }
    
    public function saveWzPage($data_array, $app_id = false)
    {
        $return = false;
        
        try { 
            $em = $this->em;
            $application_id = $app_id ? $app_id : $this->c->get('core_function_services')->getCurrentApplicationId($this->sessionName);
            
            $wzControl = $em->getRepository('ESERVMAINWizardBundle:WzControl')->findOneBy(array(
                'applicationId' => $application_id,
            ));
            
            $wzPage = $em->getRepository('ESERVMAINWizardBundle:WzPage')->findOneBy(array(
                'wzControl' => $wzControl,
                'pageNo' => $data_array['pageNo'],
            ));
            
            if(array_key_exists('completed', $data_array)){
                $wzPage->setCompleted($data_array['completed']);
            }            
            if(array_key_exists('fieldOne', $data_array['data'])){
                $wzPage->setFieldOne($data_array['data']['fieldOne']);
            }
            if(array_key_exists('fieldTwo', $data_array['data'])){
                $wzPage->setFieldTwo($data_array['data']['fieldTwo']);
            }
            if(array_key_exists('fieldThree', $data_array['data'])){
                $wzPage->setFieldThree($data_array['data']['fieldThree']);
            }
            
            //long text fields
            if(array_key_exists('fieldLongtextOne', $data_array['data'])){
                $wzPage->setFieldLongtextOne($data_array['data']['fieldLongtextOne']);
            }
            if(array_key_exists('fieldLongtextTwo', $data_array['data'])){
                $wzPage->setFieldLongtextTwo($data_array['data']['fieldLongtextTwo']);
            }
            
            //boolean fields
            if(array_key_exists('fieldBooleanOne', $data_array['data'])){
                $wzPage->setFieldBooleanOne($data_array['data']['fieldBooleanOne']);
            }
            
            $em->flush();
            
            $return = true;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
        
        return $return; 
    }
    
    
    public function getWzPage($page_no, $app_id = false)
    {
        $em = $this->em;
        $application_id = $app_id ? $app_id : $this->c->get('core_function_services')->getCurrentApplicationId($this->sessionName);
        $return = false;

        $wzControl = $em->getRepository('ESERVMAINWizardBundle:WzControl')->findOneBy(array(
            'applicationId' => $application_id,
        ));

        $wzPage = $em->getRepository('ESERVMAINWizardBundle:WzPage')->findOneBy(array(
            'wzControl' => $wzControl,
            'pageNo' => $page_no,
            'completed' => 'Y'
        ));

        if($wzPage){
            $return = $wzPage;   
        }
        
        return $return;
    }
    

}

