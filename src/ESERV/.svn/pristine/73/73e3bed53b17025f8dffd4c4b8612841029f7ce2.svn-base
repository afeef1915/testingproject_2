<?php

namespace ESERV\MAIN\CpdBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class CpdBundleDcoumentServices extends Controller 
{
    private $em;
    private $c;
    private $coreF;

    public function __construct(EntityManager $em, Container $c) 
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $this->c->get('core_function_services');
    }
    
    public function createContactCpdActDocRecord($data)
    {
        $em = $this->em;
        try{
            if(!empty($data['contact_cpd_act_id']) &&
                !empty($data['contact_cpd_doc_lib_id']))
            {
                $cont_cad = new \ESERV\MAIN\CpdBundle\Entity\ContactCpdActDoc();

                $conCpdAct = $em->getReference('ESERV\MAIN\CpdBundle\Entity\ContactCpdAct', $data['contact_cpd_act_id']);
                $conCpdDocLib = $em->getReference('ESERV\MAIN\CpdBundle\Entity\ContactCpdDocLib', $data['contact_cpd_doc_lib_id']);
                
                $cont_cad->setContactCpdAct($conCpdAct);
                $cont_cad->setContactCpdDocLib($conCpdDocLib);
                
                if(!empty($data['name'])){
                    $cont_cad->setCpdDocLibTitle($data['name']);
                }
                
                $em->persist($cont_cad);
                $em->flush();
                
                return array('status' => true);
           }
        }catch(\Exception $e){
            throw new \Exception('Exception : - '. $e->getMessage(), 500);
        }
    }
    
    public function createContactCpdDocLibRecord($data)
    {
        $em = $this->em;
        try{
            if(!empty($data['contact_cpd_status_id']) &&
                !empty($data['media_type']) &&
                !empty($data['name'])
            ){
                $cont_cdl = new \ESERV\MAIN\CpdBundle\Entity\ContactCpdDocLib();

                $conCpdAct = $em->getReference('ESERV\MAIN\CpdBundle\Entity\ContactCpdStatus', $data['contact_cpd_status_id']);
                
                $cont_cdl->setContactCpdStatus($conCpdAct);
                $cont_cdl->setMediaType($data['media_type']);
                $cont_cdl->setName($data['name']);
                
                if(!empty($data['file_content'])){
                    $cont_cdl->setFileContent($data['file_content']);
                }
                if(!empty($data['file_size'])){
                    $cont_cdl->setFileSize($data['file_size']);
                }
                
                $em->persist($cont_cdl);
                $em->flush();
                
                return array('id' => $cont_cdl->getId(), 'status' => true);
           }
        }catch(\Exception $e){
            throw new \Exception('Exception : - '. $e->getMessage(), 500);
        }
    }
    
    public function deleteContactCpdDocLib($id) 
    {   
        $result = $this->em->createQueryBuilder()
                        ->delete('ESERVMAINCpdBundle:ContactCpdDocLib', 'cuds')
                        ->where('cuds.id = :id')
                        ->setParameter('id', $id)->getQuery();

        if (!$result) {
            throw $this->createNotFoundException(
                    'No contact uploaded document found for id ' . $id
            );
        } else {
            return $this->coreF->GetOutputFormat($result, 'array');
        }
    }
    
    public function getContactCpdDocLibById($id, $type = 'array') 
    {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select('cuds', 'mt')
                ->from('ESERVMAINCpdBundle:ContactCpdDocLib', 'cuds')
                ->leftJoin('cuds.mediaType', 'mt')
                ->where('cuds.id = :id')
                ->setParameter('id', $id)
                ->getQuery();

        if (!$result) {
            throw $this->createNotFoundException(
                    'No contact uploaded document found for id ' . $id
            );
        } else {
            return $this->coreF->GetOutputFormat($result, $type);
        }
    }
}
    