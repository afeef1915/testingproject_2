<?php

namespace ESERV\TestBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVTestBundleQtsRangeServices extends Controller {

    private $em;
    private $c;

    public function __construct(EntityManager $em, Container $c = null) {
        $this->em = $em;
        $this->c = $c;        
    }
    
/**
 * Equivalant of 'GET_REF_NO' procedure in php
 * @param type $p_qts_date
 * @param type $p_route_qts
 * @return array with success flag, error message(if there is one or null otherwise),
 *  and ref_no (if there is one or null otherwise).
 */
    public function get_ref_no($p_qts_date, $p_route_qts) {        
        $v_date = strtotime($p_qts_date);
        $p_qts_year = date('Y', $v_date);
        $p_qts_year_2 = date('y', $v_date);  
        # $result_arr =  array('SUCCESS'=>false, 'ERRO_MSG'=>$error_msg, 'REF_NO'=>$ref_no);

        // 1. C1 from GTCW_QTS_RANGE
        $em = $this->em;
        $qts_ranges = new \GTCW\GTCWBundle\Entity\GtcwQtsRange();
        $gtcw_qts_ranges = $qts_ranges->getRelevantAcademicYearRec($em, $p_qts_year);
        
        #var_dump($gtcw_qts_ranges); die;
        if (!$gtcw_qts_ranges) {
            $error_msg = 'Range is not specified for Year : ' . $p_qts_year;
            return array('SUCCESS'=>FALSE, 'ERRO_MSG'=>$error_msg, 'REF_NO'=>NULL);            
        } else {
            $academic_year = $gtcw_qts_ranges['academicYear']; # date_time object
            $itet_range_from = $gtcw_qts_ranges['itetRangeFrom'];
            $itet_range_to = $gtcw_qts_ranges['itetRangeTo'];
            $other_range_from = $gtcw_qts_ranges['otherRangeFrom'];
            $other_range_to = $gtcw_qts_ranges['otherRangeTo'];
        }
        
        // 2. C2 from GTCW_QTS_MAIN AND Person tables (instead of QTS_PERSONS)        
        $person = new \ESERV\MAIN\ContactBundle\Entity\Person();
        $person_rec = $person->getHighestPersonsRefNo($em, $p_route_qts);
        #var_dump($person_rec); die;
        $max_itet = $person_rec ? $person_rec['referenceNo'] : NULL;

        // work in between
        if ($p_route_qts == '1') {
            if (is_null($itet_range_from) && is_null($itet_range_to)) {
                $error_msg = 'ITET Range is not specified for Year : get year of ' . $p_qts_year;
                return array('SUCCESS'=>FALSE, 'ERRO_MSG'=>$error_msg, 'REF_NO'=>NULL);                
            }
            if ($max_itet) {
                if ($max_itet >= $itet_range_from && $max_itet < $itet_range_to) {
                    $ref_no = is_null($max_itet) ? 1 : $max_itet + 1;
                } elseif ($max_itet < is_null($itet_range_from) ? 1 : $itet_range_from) {
                    $ref_no = $itet_range_from;
                } elseif ($max_itet >= is_null($itet_range_to) ? 1 : $itet_range_to) {
                    $error_msg = 'Ref.No. ' . $max_itet . ' cannot be inserted, Range limit Over';
                    return array('SUCCESS'=>FALSE, 'ERRO_MSG'=>$error_msg, 'REF_NO'=>NULL);
                }
            } else {
                $ref_no = $itet_range_from;
            }
        } elseif ($p_route_qts == '2') {
            if (is_null($other_range_from) && is_null($other_range_to)) {
                $error_msg = 'OTHER Range is not specified for Year : ' . $p_qts_year;
                return array('SUCCESS'=>FALSE, 'ERRO_MSG'=>$error_msg, 'REF_NO'=>NULL);
            }

            if ($max_itet) {
                if ($max_itet >= $other_range_from && $max_itet < $other_range_to) {
                    $ref_no = is_null($max_itet) ? 1 : $max_itet + 1;
                } elseif ($max_itet < is_null($other_range_from) ? 1 : $other_range_from) {
                    $ref_no = $other_range_from;
                } elseif ($max_itet >= is_null($other_range_to) ? 1 : $other_range_to) {
                    $error_msg = 'Ref.No. ' . $max_itet . ' cannot be inserted, Range limit Over';
                    return array('SUCCESS'=>FALSE, 'ERRO_MSG'=>$error_msg, 'REF_NO'=>NULL);
                }
            } else {
                $ref_no = $other_range_from;
            }
        }

        if ($ref_no) {
            $ref_no = $p_qts_year_2 . $ref_no;
            // 3. C3 from persons
            $person_rec = new \ESERV\MAIN\ContactBundle\Entity\Person();
            $person = $person_rec->getPersonByReferenceNo($em, $ref_no);
            $ref_no_1 = $person ? $person['referenceNo'] : NULL;
            #var_dump($ref_no_1); die;

            if ($ref_no_1) {
                $error_msg = 'Ref.No. ' . $ref_no_1 . ' has already assigned. Please check with System Administrator !! ';
                $p_ref_no = null;
                return array('SUCCESS'=>FALSE, 'ERRO_MSG'=>$error_msg, 'REF_NO'=>NULL);
            } else {
                $p_ref_no = $ref_no;
            }
        }

        return array('SUCCESS'=>TRUE, 'ERRO_MSG'=>NULL, 'REF_NO'=>$p_ref_no);

    }

}
