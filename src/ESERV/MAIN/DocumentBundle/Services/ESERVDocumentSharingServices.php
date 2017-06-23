<?php

namespace ESERV\MAIN\DocumentBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVDocumentSharingServices extends Controller
{

    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    const VIEW_ACCESS = 'V';
    const UPDATE_ACCESS = 'U';
    const SIGN_OFF_ACCESS = 'S';
    const EXCEPTION = 'E';
    const YES = 'Y';
    const NO = 'N';
    
    public function __construct(EntityManager $em, Container $c)
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $this->c->get('core_function_services');
        $this->dbCore = $this->c->get('db_core_function_services');
    }

    public function getContactDocStoreRecordById($id, $type = 'array')
    {
        $qb = $this->em->createQueryBuilder();
        try {
            $result = $qb->select('cuds')
                    ->from('ESERVMAINDocumentBundle:ContactDocStore', 'cuds')
                    ->where('cuds.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery();

            if (!$result) {
                throw $this->createNotFoundException(
                        'No Contact Document Store Record Found for ID ' . $id
                );
            } else {
                return $this->coreF->GetOutputFormat($result, $type)[0];
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function createNewContactDocStoreRecord($prev_con_doc_sto_id, $data)
    {
        if (isset($prev_con_doc_sto_id) && isset($data) && is_array($data)) {
            try {
                $em = $this->em;

                //getting the contact doc id using contact doc store id
                $con_doc_id = $this->getConDocIdByConDocStoId($prev_con_doc_sto_id);
                //creating the history record
                $this->createConDocHistRecord($con_doc_id, $prev_con_doc_sto_id);

                //creating the new contact doc store record
                $cds = new \ESERV\MAIN\DocumentBundle\Entity\ContactDocStore();
                $cds->setContent($data['content']);
                $cds->setName($data['name']);
                $em->persist($cds);
                $em->flush();

                //increasing the document store version by one
                $new_con_sto_id = $cds->getId();
                $this->increaseContactDocVersionByOne($con_doc_id, $new_con_sto_id);


                return $new_con_sto_id;
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage(), 500);
            }
        } else {
            throw new \Exception('Data needs to be in array format. ', 500);
        }
    }

    public function increaseContactDocVersionByOne($con_doc_id, $new_con_sto_id)
    {
        try {
            $em = $this->em;
            $cd = $em->getReference('ESERV\MAIN\DocumentBundle\Entity\ContactDoc', $con_doc_id);
            $cds = $em->getReference('ESERV\MAIN\DocumentBundle\Entity\ContactDocStore', $new_con_sto_id);

            $cur_version = $cd->getVersion();
            $new_version = $cur_version + 1;

            $cd->setVersion($new_version);
            $cd->setContactDocStore($cds);

            $em->flush($cd);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function getConDocIdByConDocStoId($con_doc_sto_id)
    {
        try {
            $em = $this->em;
            $cd = $em->getRepository('ESERVMAINDocumentBundle:ContactDoc')->findOneBy(array('contactDocStore' => $con_doc_sto_id));
            if ($cd) {
                return $cd->getId();
            } else {
                throw new \Exception('No Contact Doc Record Found for contact_document_store_id : ' . $con_doc_sto_id, 500);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
    
    public function getContactIdByConDocStoId($con_doc_sto_id)
    {        
        try {
            $em = $this->em;
            $qb = $em->createQueryBuilder()
                    ->select('c.id')
                    ->from('ESERVMAINDocumentBundle:ContactDoc', 'cd')
                    ->leftJoin('cd.conDocSub', 'cds')
                    ->leftJoin('cds.contact', 'c')
                    ->where('cd.contactDocStore = :eservContDocStoreId')
                    ->setParameter('eservContDocStoreId', $con_doc_sto_id)
                    ->getQuery()
                    ->getArrayResult();
            if(count($qb)==1){
               return $qb[0]['id']; 
            }else {
                throw new \Exception('No contact id found for conDocStoId :-'. $con_doc_sto_id, 500);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
    
    public function getContactIdByConDocId($con_doc_id)
    {        
        try {
            $em = $this->em;
            $qb = $em->createQueryBuilder()
                    ->select('c.id')
                    ->from('ESERVMAINDocumentBundle:ContactDoc', 'cd')
                    ->leftJoin('cd.conDocSub', 'cds')
                    ->leftJoin('cds.contact', 'c')
                    ->where('cd.id = :eservContDocId')
                    ->setParameter('eservContDocId', $con_doc_id)
                    ->getQuery()
                    ->getArrayResult();
            if(count($qb)==1){
               return $qb[0]['id']; 
            }else {
                throw new \Exception('No contact id found for conDocId :-'. $con_doc_id, 500);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function createConDocHistRecord($con_doc_id, $prev_con_doc_sto_id)
    {
        if (isset($con_doc_id) && isset($prev_con_doc_sto_id)) {
            try {
                $em = $this->em;

                $cdh = new \ESERV\MAIN\DocumentBundle\Entity\ContactDocHist();
                $con_doc = $em->getReference('ESERV\MAIN\DocumentBundle\Entity\ContactDoc', $con_doc_id);
                $con_doc_sto = $em->getReference('ESERV\MAIN\DocumentBundle\Entity\ContactDocStore', $prev_con_doc_sto_id);

                $cdh->setContactDoc($con_doc);
                $cdh->setConDocSub($con_doc->getConDocSub());
                $cdh->setContactDocStore($con_doc_sto);
                $cdh->setDocumentMasterVersion($con_doc->getDocumentMasterVersion());
                $cdh->setVersion($con_doc->getVersion());
                $cdh->setOrderBy($con_doc->getOrderBy());

                $em->persist($cdh);
                $em->flush();
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage(), 500);
            }
        } else {
            throw new \Exception('Contact Document ID and Contact Document Store ID must be set.', 500);
        }
    }

    public function getConDocStoIdByConDocHistId($con_doc_his_id)
    {
        try {
            $em = $this->em;
            $cd = $em->getRepository('ESERVMAINDocumentBundle:ContactDocHist')->find($con_doc_his_id);
            if ($cd) {
                return $cd->getContactDocStore()->getId();
            } else {
                throw new \Exception('No Contact Doc History Record Found for Contact Doc Hist ID : ' . $con_doc_his_id, 500);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
    
    public function getConDocStoNameIdByConDocHistId($con_doc_his_id)
    {
        try {
            $em = $this->em;
            $cd = $em->getRepository('ESERVMAINDocumentBundle:ContactDocHist')->find($con_doc_his_id);
            if ($cd) {
                return $cd->getContactDocStore()->getName();
            } else {
                throw new \Exception('No Contact Doc History Record Found for Contact Doc Hist ID : ' . $con_doc_his_id, 500);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }    
 

    public function getConHisRecordById($id, $type = 'array')
    {
        $qb = $this->em->createQueryBuilder();
        try {
            $result = $qb->select('cdh')
                    ->from('ESERVMAINDocumentBundle:ContactDocHist', 'cdh')
                    ->where('cdh.id = :cdh_id')
                    ->setParameter('cdh_id', $id)
                    ->getQuery();

            if (!$result) {
                throw $this->createNotFoundException(
                        'No Contact Document History Record Found for ID ' . $id
                );
            } else {
                return $this->coreF->GetOutputFormat($result, $type)[0];
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
    
    
    public function getAccessFlagsForContDoc($params = array())
    {        
        $qb = $this->em->createQueryBuilder();
        $qry = $qb->select('cda.signOffAccess, cda.viewAccess, cda.updateAccess, cda.signOffDate')
                ->from('ESERVMAINDocumentBundle:ContactDocAccess', 'cda')
                ->where('cda.contactDoc = :eserv_cont_doc_id')
                ->andWhere('cda.fosGroup = :eserv_fos_grp_id')          
                ->setParameter('eserv_fos_grp_id', $this->c->get('security_services')->getLoggedInUserGroup()->getId())
                ->setParameter('eserv_cont_doc_id', $params['contactDocId']);
        
        return $this->coreF->GetOutputFormat($qry->getQuery(), 'array')[0]; 
    }
    
    
    public function isDocumentSignedOff($params = array())
    {        
        $qb = $this->em->createQueryBuilder();
        $qry = $qb->select('cda.signOffDate')
                ->from('ESERVMAINDocumentBundle:ContactDocAccess', 'cda')
                ->where('cda.contactDoc = :eserv_cont_doc_id')
                ->andWhere('cda.signOffDate IS NOT NULL')
                ->setParameter('eserv_cont_doc_id', $params['contactDocId'])
                ->getQuery()->getArrayResult()
                ;
        
        if(count($qry) > 0){
            return true;
        }else{
            return false;
        }
    }

}
