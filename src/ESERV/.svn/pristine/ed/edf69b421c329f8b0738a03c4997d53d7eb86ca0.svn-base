<?php

namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EservVMergingGroupLetterRepository extends EntityRepository
{
    public function getByDocumentJobId($document_job_id, $col = 'ALL') {
        if ($col === 'ALL') {
            $select_col = 'l';
        } else {
            if (is_array($col)) {
                $col_arr = $col;
            } else {
                $col_arr = array($col);
            }
            $select_col = '';
            foreach($col_arr as $key => $value) {
              $select_col = $select_col . 'l.' . $value . ',';
            }
            $select_col = rtrim($select_col, ',');            
        }
        $result = $this->createQueryBuilder('l')
                       ->select($select_col)
                       ->where('l.documentJobId = :document_job_id_in')
                       ->setParameter('document_job_id_in', $document_job_id)
                       ->getQuery()
                       ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);                    

        return $result;
    } #getByDocumentJobId
}
