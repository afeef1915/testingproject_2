<?php

namespace WEBLOGS\CORE\MAIN\MediaBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class MediaBundleMediaStoreService extends Controller {

    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $this->c->get('core_function_services');
        $this->dbCore = $this->c->get('db_core_function_services');
    }

    public function show($id, $relationships = true, $type = 'array') {
        $result = $this->em->createQueryBuilder();

        if ($relationships === true) {
            $result = $result->select('p', 'mt')
                    ->from('WEBLOGSCOREMAINMediaBundle:MediaStore', 'p')
                    ->leftJoin('p.mediaType', 'mt');
        } else {
            $result = $result->select('p')
                    ->from('WEBLOGSCOREMAINMediaBundle:MediaStore', 'p');
        }
        $result = $result->where('p.id = :id')->setParameter('id', $id)->getQuery();

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Media Store Name found for id ' . $id
            );
        } else {
            return $this->coreF->GetOutputFormat($result, $type);
        }
    }

    public function delete($id) {
        $result = $this->em->createQueryBuilder()
                        ->delete('WEBLOGSCOREMAINMediaBundle:MediaStore', 'p')
                        ->where('p.id = :id')
                        ->setParameter('id', $id)->getQuery();

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Media Store Name found for id ' . $id
            );
        } else {
            return $this->coreF->GetOutputFormat($result, 'array');
        }
    }
    
    public function getMediaStoreIdByEntityNameAndEntityId($entity_name, $entity_id) 
    {
        $em = $this->em;
        $ent = $em->getRepository('WEBLOGSCOREMAINMediaBundle:MediaStore')->findOneBy(
                    array(
                        'entityName' => $entity_name,
                        'entityId' => $entity_id
                    )
                );
        if($ent){
            return $ent->getId();
        }else{
            return false;
        }
    }
    
    public function updateEntityNameAndId($id, $entityName, $entityId)
    {
        if($id && $entityName && $entityId){
            $media_type = $this->em->getRepository('WEBLOGS\CORE\MAIN\MediaBundle\Entity\MediaStore')->find($id);
            $media_type->setEntityName($entityName);
            $media_type->setEntityId($entityId);
            $this->em->persist($media_type);
        }else{
            throw new \Exception('Media Store Id, Entity Name and Entity Id cannot be blank.', 500);
        }
        
    }
    
    public function getMultipleRowsByEntityNameAndEntityId($entity_name, $entity_id) 
    {
        $em = $this->em;
        $media_store = $em->getRepository('WEBLOGSCOREMAINMediaBundle:MediaStore')->findBy(
                    array(
                        'entityName' => $entity_name,
                        'entityId' => $entity_id
                    )
                );
        if($media_store){
            return $media_store;
        }else{
            return false;
        }
    }
    
    public function create($data = array())
    {
        $media_type = ($data['media_type'] != null ? $data['media_type'] : null);
        $content = ($data['content'] != null ? $data['content'] : null);
        $file_extension = ($data['file_extension'] != null ? $data['file_extension'] : null);
        $file_name = ($data['file_name'] != null ? $data['file_name'] : null);
        $entity_id = ($data['entity_id'] != null ? $data['entity_id'] : null);
        $entity_name = ($data['entity_name'] != null ? $data['entity_name'] : null);
        
        $status = false;
        $ms_id = null;
        $msg = '';
        
        if(!is_null($media_type) && !is_null($content)
           &&
           !is_null($file_extension) && !is_null($file_name)
           &&
           !is_null($entity_id) && !is_null($entity_name))
        {
            try {
                $em = $this->em;
                $file = new \WEBLOGS\CORE\MAIN\MediaBundle\Entity\MediaStore();
                $file->setMediaType($media_type);
                $file->setContent($content);
                $file->setFileExtension($file_extension);
                $file->setFileName($file_name);
                $file->setFileSize(strlen($content));

                $file->setEntityId($entity_id);
                $file->setEntityName($entity_name);

                $em->persist($file);
                $em->flush();
                $status = true;
                $msg = 'Media store record created';
                $ms_id = $file->getId();
            } catch (\Exception $e) {
                $status = false;
                $msg = 'Exception occurred :- '. $e->getMessage();
            }
        }else{
           $status = false;
           $msg = 'Mandatory parameters (media_type, contet, file_extension, file_name, entity_id, entity_name) are '
                   . 'missing in options. Please re-check.';     
        }
        
        return array(
            'ms_id' => $ms_id,
            'status' => $status,
            'message' => $msg
        );
    }

}
