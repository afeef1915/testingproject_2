<?php

namespace ESERV\MAIN\DocumentBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ContactUploadedDocStoreService extends Controller {

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

    public function getById($id, $type = 'array') {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select('cuds', 'mt')
                ->from('ESERVMAINDocumentBundle:ContactUploadedDocStore', 'cuds')
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

    public function delete($id) {
        $result = $this->em->createQueryBuilder()
                        ->delete('ESERVMAINDocumentBundle:ContactUploadedDocStore', 'cuds')
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

    public function create($data = array()) {
        $media_type = ($data['media_type'] != null ? $data['media_type'] : null);
        $content = ($data['content'] != null ? $data['content'] : null);
        $file_name = ($data['file_name'] != null ? $data['file_name'] : null);
        
        $status = false;
        $ms_id = null;
        $msg = '';

        if (!is_null($media_type) && !is_null($content) && !is_null($file_name)) {
            try {
                $em = $this->em;
                $file = new \ESERV\MAIN\DocumentBundle\Entity\ContactUploadedDocStore();
                $file->setMediaType($media_type);
                $file->setFileContent($content);
                $file->setName($file_name);
                $file->setFileSize(strlen($content));

                $em->persist($file);
                $em->flush();
                $status = true;
                $msg = 'Contact uploaded document created';
                $cuds_id = $file->getId();
            } catch (\Exception $e) {
                $status = false;
                $msg = 'Exception occurred :- ' . $e->getMessage();
            }
        } else {
            $status = false;
            $msg = 'Mandatory parameters (media_type, contet, file_extension, file_name) are '
                    . 'missing in options. Please re-check.';
        }

        return array(
            'id' => $cuds_id,
            'status' => $status,
            'message' => $msg
        );
    }

}
