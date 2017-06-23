<?php

namespace ESERV\HelpBundle\Components\KnowledgeBaseBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\AppConstants;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVHelpBundleComponentsKnowledgeBaseBundleServices extends Controller {

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

    //list documents
    public function ListDocuments($search_params, $type = 'doctrine', $alias = 'p', $query_only = false) {

        $session_id = $search_params['session_id'];
        $search_id = $search_params['search_id'];

        if ($session_id == '1') {
            $topic_id = $search_id;
            $res = $this->searchTopic($topic_id);
            if ($res['success']){
                $search_id = empty($res['search_id']) ? 0 : $res['search_id'];
            }
        }

        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVHelpBundleComponentsKnowledgeBaseBundle:VdocumentSearchResults', $alias)
                        ->where($alias . '.search_id = :search_id')->setParameter('search_id', $search_id);
        #->andWhere($alias . '.session_id = :session_id')->setParameter('session_id', $session_id);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No documents found! -- Function "ListDocuments"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function ListRelatedDocs($main_document_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVHelpBundleComponentsKnowledgeBaseBundle:VdocumentRelatedDocs', $alias)
                        ->where($alias . '.main_document_id = :main_document_id')->setParameter('main_document_id', $main_document_id);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No documents found! -- Function "ListRelatedDocs"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function ListDocumentHistory($document_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVHelpBundleComponentsKnowledgeBaseBundle:VdocumentHistories', $alias)
                        ->where($alias . '.document_id = :document_id')->setParameter('document_id', $document_id);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No documents found! -- Function "ListDocumentHistory"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function ListRelatedFAQs($faq_item_seq = null, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                ->from('ESERVHelpBundleComponentsKnowledgeBaseBundle:VfaqsRelatedDocuments', $alias);

        if (!is_null($faq_item_seq)) {
            $result->where($alias . '.faq_item_seq = :faq_item_seq')->setParameter('faq_item_seq', $faq_item_seq);
        }

        if (!$result) {
            throw $this->createNotFoundException(
                    'No documents found! -- Function "ListRelatedFAQs"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function ListDocumentReviews($document_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVHelpBundleComponentsKnowledgeBaseBundle:DocumentReviews', $alias)
                        ->where($alias . '.document_id = :document_id')->setParameter('document_id', $document_id);

        $or = $result->expr()->orx()
                ->add("{$alias}.status_code = :status_code1")
                ->add("{$alias}.status_code IS NULL");
        $result->setParameter('status_code1', "A");

        $result->andWhere($or);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No documents found! -- Function "ListDocumentReviews"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    //show document details
    public function ShowDocument($id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVHelpBundleComponentsKnowledgeBaseBundle:Vdocuments', $alias)
                        ->where($alias . '.document_id = :document_id')->setParameter('document_id', $id);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No document found for id ' . $id . '-- Function "ShowDocument"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function searchTopic($topic_id) {
        $conn = $this->em->getConnection();

        $qb = $conn->prepare('DECLARE '
                . ' p_search number;'
                . ' BEGIN '
                #. ' p_search '
                . ' document_management.search_web (' .
                "p_keywords=>:p_keywords"
                . ',p_theme=>:p_theme'
                . ',p_start_topics=>:p_start_topics'
                . ',p_search_titles=>:p_search_titles'
                . ",p_search_content=>:p_search_content"
                . ',p_search_text=>:p_search_text'
                . ',p_source_id=>:p_source_id'
                . ',p_author_id=>:p_author_id'
                . ',p_enquiry_code=>:p_enquiry_code'
                . ',p_enquiry_category=>:p_enquiry_category'
                . ',p_name=>:p_name'
                . ',p_web=>:p_web'
                . ",p_person_id=>:p_person_id"
                . ',p_non_member=>:p_non_member'
                . ',p_member=>:p_member'
                . ',p_activists=>:p_activists'
                . ',p_staff=>:p_staff'
                . ',p_search_id=>:search_id'
                . ',p_session_id=>:p_session_id'
                . ');'
                . 'END;');

        $search_keywords = '';
        $search_theme = '';
        $search_start_topic_id = is_numeric($topic_id) ? $topic_id : '';

        $search_titles = 'Y';
        $search_content = 'N';
        $search_text = 'Y';

        $search_source = '';
        $search_author = '';
        $search_doc_enquiry_code = '';
        $search_enquiry_category = '';
        $search_name = '';
        $search_web = 'Y';
        $search_person_id = '1234';
        $search_non_member = 'Y';
        $search_member = 'Y';
        $search_activists = 'N';
        $search_staff = '';
        $search_id = '';
        $search_session_id = '';

        $qb->bindParam('p_keywords', $search_keywords, \PDO::PARAM_STR);
        $qb->bindParam('p_theme', $search_theme, \PDO::PARAM_STR);
        $qb->bindParam('p_start_topics', $search_start_topic_id, \PDO::PARAM_STR);
        $qb->bindParam('p_search_titles', $search_titles, \PDO::PARAM_BOOL);
        $qb->bindParam('p_search_content', $search_content, \PDO::PARAM_BOOL);
        $qb->bindParam('p_search_text', $search_text, \PDO::PARAM_BOOL);
        $qb->bindParam('p_source_id', $search_source, \PDO::PARAM_INT);
        $qb->bindParam('p_author_id', $search_author, \PDO::PARAM_INT);
        $qb->bindParam('p_enquiry_code', $search_doc_enquiry_code, \PDO::PARAM_STR);
        $qb->bindParam('p_enquiry_category', $search_enquiry_category, \PDO::PARAM_STR);
        $qb->bindParam('p_name', $search_name, \PDO::PARAM_STR);
        $qb->bindParam('p_web', $search_web, \PDO::PARAM_STR);
        $qb->bindParam('p_person_id', $search_person_id, \PDO::PARAM_STR);
        $qb->bindParam('p_non_member', $search_non_member, \PDO::PARAM_STR);
        $qb->bindParam('p_member', $search_member, \PDO::PARAM_STR);
        $qb->bindParam('p_activists', $search_activists, \PDO::PARAM_STR);
        $qb->bindParam('p_staff', $search_staff, \PDO::PARAM_STR);
        $qb->bindParam('search_id', $search_id, \PDO::PARAM_INPUT_OUTPUT);
        $qb->bindParam('p_session_id', $search_session_id, \PDO::PARAM_STR, 5000);

        $res = $qb->execute();

        $result = array();

        if ($res) {
            try {
                $result = array(
                    'success' => TRUE,
                    'search_id' => $search_id,
                    'session_id' => $search_session_id,
                );
            } catch (Exception $e) {
                $result = array(
                    'success' => FALSE,
                    'msg' => $e->getMessage(),
                    'session_id' => $search_session_id,
                    'original_search_id' => $search_id,
                    'total_results' => 0,
                );
            }
        } else {
            $result = array(
                'success' => FALSE,
                'msg' => 'No results',
                'session_id' => $search_session_id,
                'original_search_id' => $search_id,
                'total_results' => 0,
            );
        }

        return $result;
    }

}
