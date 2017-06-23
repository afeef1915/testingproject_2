<?php

namespace ESERV\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\Services\AppConstants;
use GTCW\GTCWBundle\Services\ClientConstants;
use \DateTime;

class InterfaceController extends Controller
{
    const CURRENT_ACADEMIC_YEAR =  'CURRENT_ACADEMIC_YEAR';
    const LEA_CODE =               'LEA_CODE'; 
    const ITET_ESTB_CODE =         'ITET_ESTB_CODE'; 
    const SURNAME =                'SURNAME'; 
    const FORENAME =               'FORENAME'; 
    const PREVIOUS_SURNAME =       'PREVIOUS_SURNAME'; 
    const DOB =                    'DOB'; 
    const SEX =                    'SEX'; 
    const BIRTH_CERT_SEEN =        'BIRTH_CERT_SEEN'; 
    const ITET_QUAL_TYPE_CODE =    'ITET_QUAL_TYPE_CODE'; 
    const ITET_SUBJECT_CODE1 =     'ITET_SUBJECT_CODE1'; 
    const ITET_SUBJECT_CODE2 =     'ITET_SUBJECT_CODE2'; 
    const AGE_FROM =               'AGE_FROM'; 
    const AGE_TO =                 'AGE_TO'; 
    const SPL_AGE_FROM =           'SPL_AGE_FROM'; 
    const SPL_AGE_TO =             'SPL_AGE_TO'; 
    const COURSE_LENGTH =          'COURSE_LENGTH'; 
    const YEAR_OF_AWARD =          'YEAR_OF_AWARD'; 
    const DEGREE_QUAL_TYPE_CODE =  'DEGREE_QUAL_TYPE_CODE';
    const DEGREE_ESTB_CODE =       'DEGREE_ESTB_CODE'; 
    const DEGREE_CLASS_CODE =      'DEGREE_CLASS_CODE'; 
    const DEGREE_SUBJECT_CODE1 =   'DEGREE_SUBJECT_CODE1'; 
    const DEGREE_SUBJECT_CODE2 =   'DEGREE_SUBJECT_CODE2'; 
    const DEGREE_SUBJECT_CODE3 =   'DEGREE_SUBJECT_CODE3'; 
    const ROUTE_QTS =              'ROUTE_QTS'; 
    const ADDRESS_LINE1 =          'ADDRESS_LINE1'; 
    const ADDRESS_LINE2 =          'ADDRESS_LINE2'; 
    const TOWN =                   'TOWN'; 
    const COUNTY =                 'COUNTY'; 
    const POSTCODE =               'POSTCODE';
    const REF_NO =                 'REF_NO';

    # TTR4 Interface file headers
    const TR4_REF_NO			= 'IDQ_REF_NO';
    const TR4_DOB			= 'IDQ_DOB';
    const TR4_COURSE_OUTCOME		= 'IDQ_COURSE_OUTCOME';
    const TR4_COMPLETION_DATE		= 'IDQ_COMPLETION_DATE';
    const TR4_ITET_CLASS_CODE		= 'IDQ_ITET_CLASS_CODE';
    const TR4_YEAR_OF_AWARD		= 'IDQ_YEAR_OF_AWARD';
    const TR4_DEGREE_CLASS_CODE		= 'IDQ_DEGREE_CLASS_CODE';
    
    # I1 Interface file headers
    const I1_REF_NO			= 'REF_NO';
    const I1_SURNAME			= 'SURNAME';
    const I1_FORENAMES                  = 'FORENAMES';
    const I1_LEA_CODE                   = 'LEA_CODE';
    const I1_SCHOOL_CODE		= 'SCHOOL_CODE';
    const I1_REGISTRATION_DATE          = 'REGISTRATION_DATE';
    const I1_PAYMENT_METHOD             = 'PAYMENT_METHOD';
    
    const QTS_ROUTE_1 =            '1';
    const QTS_ROUTE_2 =            '2';
    
    const QTS_STATUS_CODE =        '67';   # Needs looking at the qts needs a status 
        
    public $data = array();
    public $keys = array();  
    public $error_array = array();
    public $ITET_qual_type;
    public $degree_qual_type;
    private $em;
    public $created_by = 1;
    
    
    
    public function indexAction($name)            
    {
        return $this->render('ESERVTestBundle:Interface:index.html.twig', array('name' => $name));
    }

    private static function IMP1File()
    {
        $file_ln0 = "REF_NO;SURNAME;FORENAMES;DOB;LEA_CODE;SCHOOL_CODE;REGISTRATION_DATE;PAYMENT_METHOD";
        $file_ln1 = "0138703;;;19/05/1967;;;01/04/2007;3";
        $file_ln2 = "7078001;;;12/09/1951;;;01/04/2007;3";
        $file_ln3 = "7155394;;;03/06/1953;;;01/04/2007;3";
        $file_ln4 = "7851593;;;27/02/1957;;;01/04/2007;3";
        $file_ln5 = "8156534;;;21/02/1958;;;01/04/2007;3";
    }
    
    private function RetrieveImportFile($fileId=1) 
    /*****************************************************************************
     * Name: RetrieveImportFile
     * Purpose: Gets a csv type (; separated) file from media store
     * Returns array of the file.
     * @param $fileId #the file to retrieve
     * @return array
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/            
    {
        $data=array();
        $media_store = $this->em->getRepository('ESERVMAINMediaBundle:MediaStore')->findOneBy(array('id' => $fileId));
        
        if ($media_store) {
            $file_data = stream_get_contents($media_store->getContent());
            $file_data = explode(chr(10), $file_data);
            $i = 0;
            foreach ($file_data as $line_data)  {
               $line_data = \trim($line_data);
               $data[]= explode(';', $line_data);
               $i++;
            }
        } else {
            die('File does not seem to exist');
        }

        return $data;
        
    }  
    
    private static function TTR4File() 
    {
        $file_ln0 = "IDQ_REF_NO;IDQ_DOB;IDQ_COURSE_OUTCOME;IDQ_COMPLETION_DATE;IDQ_ITET_CLASS_CODE;IDQ_YEAR_OF_AWARD;IDQ_DEGREE_CLASS_CODE";
        $file_ln1 = "1377000;01/01/1965;1;09/07/2012;02";
        $file_ln2 = "1377001;26/08/1990;2;07/03/2012";
        $file_ln3 = "1377002;02/10/1988;1;09/07/2012;03;2012;03";
        $file_ln4 = "1377003;04-04-1974;2;09/07/2012";
        $data = array(explode(';', $file_ln0), explode(';', $file_ln1), explode(';', $file_ln2), explode(';', $file_ln3), explode(';', $file_ln4));
    
        return $data;
        
    }  

    private function get_interface_keys($in_keys) 
    /*****************************************************************************
     * Name: get_interface_keys
     * Purpose: changes the keys to uppercase
     * @param $in_keys 
     * @return array
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/            
    {
        #$keys = array();
        #$keys = $data[0];
        #$keys = array_flip($key);        
        #$keys = array_change_key_case($key,CASE_UPPER);
        $new_keys = array_change_key_case($in_keys,CASE_UPPER);
        
        return $new_keys;
    }
    
    private function key_value($key, $data) 
    /*****************************************************************************
     * Name: key_value
     * Purpose: checks to make sure the key exists.
     * @param $key  
     * @param $data
     * @return array
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/            
    {
        if (key_exists($key, $this->keys)) {
            return ($data[$this->keys[$key]]);
        } else {
            return null;
        }
    }

    private function valid_date($in_date,&$out_date, $format='d/m/Y') 
    /*****************************************************************************
     * Name: valid_date
     * Purpose: takes a date string + converts to a date object.
     * @param $in_date - string with the date
     * @param $out_date - date object
     * @return true or false
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/            
    {
        $in_date = str_replace('-','/',$in_date);
        $out_date = \DateTime::createFromFormat($format, $in_date);
        if (!$out_date) {
            return false;
        }
        $out_date->setTime('0','0','0');
        $warn_err = $out_date->getLastErrors();
        #if (array_key_exists($warn_err,'warning_count') && array_key_exists($warn_err,'error_count')) {
            if ($warn_err['warning_count'] > 0 || $warn_err['error_count'] > 0) {
                return false;
            } else {
                return true;
            }
        #} else {            
        #    return false;
        #}

        return false;
    }
    
    private function nvl($value, $newvalue) {
    /*****************************************************************************
     * Name: nvl
     * Purpose: if first parameter has no value then return the second parameter otherwise return first parameter.
     * @param $value 
     * @param $newvalue
     * @return one of the above
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/          
        return ($value? $value : $newvalue);
    }
    
    public function runInterfaceAction($name, $fileId)
    /*****************************************************************************
     * Name: runInterfaceAction
     * Purpose: Main calling function
     * @param $name : name of the interface to run
     * @param $fileId : file id of the file in media store
     * @return 
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/          
    {
        $this->em = $this->getDoctrine()->getManager();
        $code_type = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')->findOneBy(array('code' => AppConstants::ACT_QUTYPE));
        $this->degree_qual_type = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(array('applicationCodeType' => $code_type->getId(),'code' => AppConstants::AC_DEGREE_QUALIFICATION));
        $this->ITET_qual_type = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(array('applicationCodeType' => $code_type->getId(),'code' => AppConstants::AC_ITET_QUALIFICATION));
        $this->degreeClass_codeType = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')->findOneBy(array('code' => ClientConstants::ACT_QUALIFICATION_CLASS));
        $this->created_by = 1;
        
        set_time_limit(0);
        
        switch ($name) {
            case 'TTR1' :    
                    $this->data = self::RetrieveImportFile($fileId);
                    self::Ttr1Load();
                    break;
            case 'TTR4' :    
                    $this->data = self::RetrieveImportFile($fileId);
                    self::Ttr4Load();
                    break;
            default :
                    die('no interface to run!');
                    break;
        }
            
    }
    
    
    public function CreatePerson($data) 
    /*****************************************************************************
     * Name: createPerson
     * Purpose: Creates a QTS person based on data from the interface. 
     * @param $data
     * @return true or false
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/          
    {
        try {
//                $this->em->getConnection()->beginTransaction();
                //Contact status has set to QTS Applicant by default. But it will change in the code below accordingly
                $contact_status = $this->em->getRepository('ESERVMAINContactBundle:ContactStatus')->findOneBy(
                        array('code' => \ESERV\MAIN\Services\AppConstants::CS_QTS_APPLICANT));
                $contact_type = $this->em->getRepository('ESERVMAINContactBundle:ContactType')->findOneBy(
                        array('code' => \ESERV\MAIN\Services\AppConstants::CT_PERSON));
                
                $contact = new \ESERV\MAIN\ContactBundle\Entity\Contact();
                $today_date = new \DateTime();

                if (!is_null($contact_status)) {
                    $contact->setContactStatus($contact_status);
                    $contact->setContactType($contact_type);
                    $displayName = \trim($data[self::SURNAME]) . ' ' . \trim($data[self::FORENAME]);
                    $contact->setDisplayName($displayName);
                    $contact->setCreatedAt($today_date);
                    $contact->setCreatedBy($this->created_by);
                    
                    $contact->setStatusDate($today_date);
                    $this->em->persist($contact);
//                    $this->em->flush();

                    $person = new \ESERV\MAIN\ContactBundle\Entity\Person();
                    $person->setContact($contact);

                    $person->setLastName($data[self::SURNAME]);
                    $person->setFirstName($data[self::FORENAME]);
                    
                    $fnames = \explode(' ',$data[self::FORENAME]);
                    $initials = '';
                    foreach ($fnames as $name) {
                       $initials .= \substr($name,0,1); 
                    }
                    $person->setInitials(strtoupper($initials));
                    
                    $person->setGender($data[self::SEX]);

                    $person->setDateOfBirth($data[self::DOB]);

                    $person->setReferenceNo($data[self::REF_NO]);

                    $person->setLastNameSearch(strtoupper($data[self::SURNAME]));
                    $person->setCreatedAt($today_date);
                    $person->setCreatedBy($this->created_by);
                    $this->em->persist($person);
//                    $this->em->flush();
                } else {
                    $tmp = ' Contact status cannot be blank';
                    throw new \Exception($tmp, 500);
                }

                $address_type = $this->em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType')
                        ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::AT_HOME));

                if (!is_null($address_type)) {
                        $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                        $address->setContact($contact);
                        $address->setAddressType($address_type);
                        $address->setAddressLine1($data[self::ADDRESS_LINE1]);
                        $address->setAddressLine2($data[self::ADDRESS_LINE2]);
                        $address->setAddressLine3(null);
                        $address->setTown($data[self::TOWN]);
                        $address->setCounty($data[self::COUNTY]);
                        $address->setPostcode($data[self::POSTCODE]);
                        $address->setPrimaryRecord('Y');
                        $address->setCreatedAt($today_date);
                        $address->setCreatedBy($this->created_by);
                        
                        $newStartDate = $today_date;
                        $address->setStartDate($newStartDate);
                        $this->em->persist($address);
//                        $this->em->flush();
                } else {
                    $tmp = ' Address type cannot be blank';
                    throw new \Exception($tmp, 500);
                }


                /* Saving a record to the cotact_subtype table */
                $contact_subtype = new \ESERV\MAIN\ContactBundle\Entity\ContactSubtype();
                $contact_subtype_list = $this->em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                        ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CSL_TEACHER_CODE,
                    'contactType' => $contact_type));
                $contact_subtype->setContact($contact);
                $contact_subtype->setContactSubtypeList($contact_subtype_list);
                $contact_subtype->setCreatedAt($today_date);
                $contact_subtype->setCreatedBy($this->created_by);        
                $this->em->persist($contact_subtype);
//                $this->em->flush();

                $qts_status = $this->em->getRepository('GTCWGTCWBundle:GtcwQtsStatus')
                        ->findOneBy(array('code' => self::QTS_STATUS_CODE));

                $qts_main = new \GTCW\GTCWBundle\Entity\GtcwQtsMain();
                $q_main = new \GTCW\GTCWBundle\Entity\GtcwMain();

                $qts_main->setContact($contact);
                $qts_main->setRouteToQts($data[self::ROUTE_QTS]);
                $qts_main->setQtsRegpackRequested('N');
                $qts_main->setCreatedAt($today_date);
                $qts_main->setCreatedBy($this->created_by);
                $q_main->setContact($contact);
                $q_main->setQtsStatus($qts_status);
                $q_main->setRetiredIll('N');                
                # This does not get passed in.
                $q_main->setQtsDate(null);
                $q_main->setCreatedAt($today_date);
                $q_main->setCreatedBy($this->created_by);
                $this->em->persist($q_main);
//                $this->em->flush();

                
                $qts_main->setTtr1Received($today_date);
                $qts_main->setQtsFormReceived($today_date);
                $this->em->persist($qts_main);
//                $this->em->flush();
                
                # Qualification Schools

                $qual_type = $this->ITET_qual_type;

                $qts_per_qual = new \ESERV\MAIN\QualificationBundle\Entity\ContactQualification();

                $qts_per_qual->setQualType($qual_type);
                $qts_per_qual->setExitAcademicYear($data[self::CURRENT_ACADEMIC_YEAR]);
                $qts_per_qual->setContact($contact);
                $qts_per_qual->setEndDate($data[self::YEAR_OF_AWARD]);
                
                $qts_per_qual->setCourseOutcome(null);
                
                $qts_per_qual->setQualification($data[self::ITET_QUAL_TYPE_CODE]);
                $qts_per_qual->setEstablishment($data[self::ITET_ESTB_CODE]);
                $qts_per_qual->setCreatedAt($today_date);
                $qts_per_qual->setCreatedBy($this->created_by);

                $from = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->findOneBy(array('code' => $data[self::AGE_FROM]));
                if ($from) {
                        $qts_per_qual->setAgeFrom($from);
                }
                
                $to = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->findOneBy(array('code' => $data[self::AGE_TO]));
                if ($to) {
                    $qts_per_qual->setAgeTo($to);
                }

                $from = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->findOneBy(array('code' => $data[self::SPL_AGE_FROM]));
                if ($from) {
                        $qts_per_qual->setAgeSpecFrom($from);
                }
                
                $to = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->findOneBy(array('code' => $data[self::SPL_AGE_TO]));
                if ($to) {
                    $qts_per_qual->setAgeSpecTo($to);
                }
                
                $qts_per_qual->setCourseLength($data[self::COURSE_LENGTH]);
                $this->em->persist($qts_per_qual);
//                $this->em->flush();

                $qts_subject1 = new \ESERV\MAIN\QualificationBundle\Entity\ContactQualificationSubj();
                $qts_subject1->setSubject($data[self::ITET_SUBJECT_CODE1]);
                $qts_subject1->setContactQualification($qts_per_qual);
                $qts_subject1->setSubjectOrderNo(1);
                $qts_subject1->setCreatedAt($today_date);
                $qts_subject1->setCreatedBy($this->created_by);


                $this->em->persist($qts_subject1);
//                $this->em->flush();

                $subject2 = $this->em->getRepository('ESERVMAINQualificationBundle:Subject')
                        ->findOneBy(array('code' => $data[self::ITET_SUBJECT_CODE2]));
                if ($subject2) {
                    $qts_subject2 = new \ESERV\MAIN\QualificationBundle\Entity\ContactQualificationSubj();
                    $qts_subject2->setSubject($subject2);
                    $qts_subject2->setContactQualification($qts_per_qual);
                    $qts_subject2->setSubjectOrderNo(2);
                    $qts_subject2->setCreatedAt($today_date);
                    $qts_subject2->setCreatedBy($this->created_by);

                    $this->em->persist($qts_subject2);
//                    $this->em->flush();
                }    

//                    } else {
//                        $tmp = ' QTS Status cannot be blank';
//                        throw new \Exception($tmp, 500);
//                    }
//                }
                
                # Degree Qualification

                $qual_type = $this->degree_qual_type;

                $qts_per_qual = new \ESERV\MAIN\QualificationBundle\Entity\ContactQualification();


                $qts_per_qual->setQualType($qual_type);
                $qts_per_qual->setExitAcademicYear($data[self::CURRENT_ACADEMIC_YEAR]);
                $qts_per_qual->setContact($contact);
                $qts_per_qual->setYearOfAward($data[self::YEAR_OF_AWARD]);

                $qts_per_qual->setCourseOutcome(null);
                
                $qts_per_qual->setQualification($data[self::DEGREE_QUAL_TYPE_CODE]);
                $qts_per_qual->setEstablishment($data[self::DEGREE_ESTB_CODE]);

                $qts_per_qual->setClass($data[self::DEGREE_CLASS_CODE]);

                $qts_per_qual->setCourseLength($data[self::COURSE_LENGTH]);
                $qts_per_qual->setEndDate($data[self::YEAR_OF_AWARD]);
                $qts_per_qual->setCreatedAt($today_date);
                $qts_per_qual->setCreatedBy($this->created_by);

                $this->em->persist($qts_per_qual);
//                $this->em->flush();

                $qts_subject1 = new \ESERV\MAIN\QualificationBundle\Entity\ContactQualificationSubj();
                $qts_subject1->setSubject($data[self::DEGREE_SUBJECT_CODE1]);
                $qts_subject1->setContactQualification($qts_per_qual);
                $qts_subject1->setSubjectOrderNo(1);
                $qts_subject1->setCreatedAt($today_date);
                $qts_subject1->setCreatedBy($this->created_by);
                

                $this->em->persist($qts_subject1);
//                $this->em->flush();

                $subject2 = $this->em->getRepository('ESERVMAINQualificationBundle:Subject')
                        ->findOneBy(array('code' => $data[self::DEGREE_SUBJECT_CODE2], 'qualType' => $this->degree_qual_type));
                if ($subject2) {
                    $qts_subject2 = new \ESERV\MAIN\QualificationBundle\Entity\ContactQualificationSubj();
                    $qts_subject2->setSubject($subject2);
                    $qts_subject2->setContactQualification($qts_per_qual);
                    $qts_subject2->setSubjectOrderNo(2);
                    $qts_subject2->setCreatedAt($today_date);
                    $qts_subject2->setCreatedBy($this->created_by);
                    $this->em->persist($qts_subject2);
//                    $this->em->flush();
                }                 
                
                $subject3 = $this->em->getRepository('ESERVMAINQualificationBundle:Subject')
                        ->findOneBy(array('code' => $data[self::DEGREE_SUBJECT_CODE3], 'qualType' => $this->degree_qual_type));
                if ($subject3) {
                    $qts_subject3 = new \ESERV\MAIN\QualificationBundle\Entity\ContactQualificationSubj();
                    $qts_subject3->setSubject($subject2);
                    $qts_subject3->setContactQualification($qts_per_qual);
                    $qts_subject3->setSubjectOrderNo(3);
                    $qts_subject3->setCreatedAt($today_date);
                    $qts_subject3->setCreatedBy($this->created_by);
                    
                    $this->em->persist($qts_subject3);
//                    $this->em->flush();
                }                 

//                $this->em->getConnection()->commit();
                return true;
                $message = 'Teacher successfully added!';
                
            } catch (\Exception $e) {
                $this->em->getConnection()->rollback();
                $this->em->close();
                $message = 'Error occurred while inserting QTS teacher : - ' . $e->getMessage();
                die('OOOPS  ERROR = '.$message);
            }
    }
    
    public function Ttr1Load()
    /*****************************************************************************
     * Name: Ttr1Load
     * Purpose: This is the TTR1 dataload creates an array with all the error messages
     *          calls the createPerson function
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/          
    {
        $strict = true;
        $this->em = $this->getDoctrine()->getManager();
        $this->keys = self::get_interface_keys(array_shift($this->data));
               
        $this->file_errors = array();
        $i = 0;
        $this->em->getConnection()->beginTransaction();
        foreach ($this->data as $record)  {
            if (!array_count_values ($record)) {  # No values!                
                break;
            } 
            
            $rec_error=array();
            $i++;
            $currentrec = array();
            foreach ($record as $field => $value) {
                $currentrec[$this->keys[$field]]=$value;
            }
            
            foreach ($this->keys as $key) {
                if (!array_key_exists($key, $currentrec)) {
                    $currentrec[$key] = null;
                }
            }            
            print_r($this->keys);
            echo '<br> here <br>';
            print_r($currentrec);
            print('here record array fname=:'.$currentrec[self::FORENAME].'<br>');

            if   (!$currentrec[self::LEA_CODE] ||
                 !$currentrec[self::SURNAME] ||
                 !$currentrec[self::FORENAME] ||
                 !$currentrec[self::DOB] ||
                 !$currentrec[self::SEX] ||
                 !$currentrec[self::BIRTH_CERT_SEEN] ||
                 !$currentrec[self::ITET_QUAL_TYPE_CODE] ||
                 !$currentrec[self::ITET_ESTB_CODE] ||
                 !$currentrec[self::ITET_SUBJECT_CODE1] ||
                 !$currentrec[self::COURSE_LENGTH] ||
                 !$currentrec[self::ROUTE_QTS] ||
                 !$currentrec[self::CURRENT_ACADEMIC_YEAR]) {

                $rec_error[8]='Mandatory columns are null';
            }
            
            $date_of_birth = $academic_year = $year_of_award = null;
            
            if (!$rec_error && self::valid_date($currentrec[self::DOB],$date_of_birth)){
                $currentrec[self::DOB]=$date_of_birth;
            } elseif (!$rec_error) {
                $rec_error[46]='Invalid date of birth';                
            } 

            if (!$rec_error && self::valid_date($currentrec[self::CURRENT_ACADEMIC_YEAR],$academic_year)){
                $currentrec[self::CURRENT_ACADEMIC_YEAR] = $academic_year;
            } elseif (!$rec_error) {
                $rec_error[56]='Invalid current academic year';                
            }
            
            if (!$rec_error && $currentrec[self::YEAR_OF_AWARD] && (self::valid_date($currentrec[self::YEAR_OF_AWARD], $year_of_award))){
                $currentrec[self::YEAR_OF_AWARD] = $year_of_award;
            } elseif (!$rec_error) {
                $rec_error[57]='Invalid Year of award';                
            }
            
            if (!$rec_error && $currentrec[self::LEA_CODE]) 
            {
                $this->employer = $this->em->getRepository('ESERVMAINMembershipBundle:Employer')
                                        ->findOneBy(array('code' => $currentrec[self::LEA_CODE]));
                
                if ($this->employer) {
                   $currentrec[self::LEA_CODE] = $this->employer;
                } else {
                   $rec_error[64]='Invalid LEA Code';
                } 
            };            
            
            if (!$rec_error && $currentrec[self::ITET_QUAL_TYPE_CODE])
            {
                $qual = $this->em->getRepository('ESERVMAINQualificationBundle:Qualification')->findOneBy(array('code'=>$currentrec[self::ITET_QUAL_TYPE_CODE],'qualType'=>$this->ITET_qual_type));
                
                if ($qual) {
                    $currentrec[self::ITET_QUAL_TYPE_CODE] = $qual;
                } else {
                    $rec_error[78]='Invalid Qualification Schools code';
                }
                $qual = null;
            }
            
            if (!$rec_error && $currentrec[self::ITET_ESTB_CODE]) 
            {
                $estab = $this->em->getRepository('ESERVMAINQualificationBundle:Establishment')
                                        ->findOneBy(array('code' => $currentrec[self::ITET_ESTB_CODE]));
                # Do we need to check the LEA_CODE (aka employer)??
                
                if ($estab) {
                    $currentrec[self::ITET_ESTB_CODE] = $estab;
                } else {
                    $rec_error[79]='Invalid ITET Establishment code';
                }
            };            
            
            if (!$rec_error && $currentrec[self::ITET_SUBJECT_CODE1]) 
            {
                $subj = $this->em->getRepository('ESERVMAINQualificationBundle:Subject')
                                        ->findOneBy(array('code' => $currentrec[self::ITET_SUBJECT_CODE1], 'qualType' => $this->ITET_qual_type));
                
                if ($subj) {
                   $currentrec[self::ITET_SUBJECT_CODE1] = $subj;
                } else {
                   $rec_error[80]='Invalid ITET Subject code '.$currentrec[self::ITET_SUBJECT_CODE1];
                }
            };            

            if (!$rec_error && $currentrec[self::DEGREE_QUAL_TYPE_CODE]) 
            {
                $qual = $this->em->getRepository('ESERVMAINQualificationBundle:Qualification')
                                        ->findOneBy(array('code' => $currentrec[self::DEGREE_QUAL_TYPE_CODE],'qualType' => $this->degree_qual_type));
                
                if ($qual) {
                    $currentrec[self::DEGREE_QUAL_TYPE_CODE] = $qual;
                } else {
                    $rec_error[84]='Invalid Degree Qualification code - '.$currentrec[self::DEGREE_QUAL_TYPE_CODE];
                }
                $qual = null;
            };            

            if (!$rec_error && $currentrec[self::DEGREE_ESTB_CODE]) 
            {
                $estab = $this->em->getRepository('ESERVMAINQualificationBundle:Establishment')
                                        ->findOneBy(array('code' => $currentrec[self::DEGREE_ESTB_CODE]));
                
                if ($estab) {
                   $currentrec[self::DEGREE_ESTB_CODE] = $estab;
                } else {
                   $rec_error[81]='Invalid DEGREE Establishment code : '.$currentrec[self::DEGREE_ESTB_CODE];
                } 
            };
            
            if (!$rec_error && $currentrec[self::DEGREE_SUBJECT_CODE1]) 
            {
                $subj = $this->em->getRepository('ESERVMAINQualificationBundle:Subject')
                                        ->findOneBy(array('code' => $currentrec[self::DEGREE_SUBJECT_CODE1],'qualType' => $this->degree_qual_type));
                
                if ($subj) {
                   $currentrec[self::DEGREE_SUBJECT_CODE1] = $subj;
                } else {
                   $rec_error[82]='Invalid DEGREE Subject code : '.$currentrec[self::DEGREE_SUBJECT_CODE1];
                } 
            };
            
            if (!$rec_error && $currentrec[self::DEGREE_CLASS_CODE]) 
            {
                $deg_class = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->findOneBy(array('applicationCodeType' => $this->degreeClass_codeType->getId(),'code' => $currentrec[self::DEGREE_CLASS_CODE]));

                if ($deg_class) {
                    $currentrec[self::DEGREE_CLASS_CODE] = $deg_class;
                } else {
                   $rec_error[83]='Invalid Degree Class code : '.$currentrec[self::DEGREE_CLASS_CODE];
                } 
                
            };
            
            if (!$rec_error && in_array($currentrec[self::ITET_QUAL_TYPE_CODE],array('020','050','031','215'),$strict)) 
            {
                if (!$currentrec[self::YEAR_OF_AWARD]) 
                {
                    $rec_error[34]='QTS TTR1 - Degree - Year of Award not entered';
                }
                if (!$currentrec[self::DEGREE_QUAL_TYPE_CODE])
                {
                    $rec_error[35]='QTS TTR1 - Degree - Qualification Type not entered';
                }
                if (!$currentrec[self::DEGREE_ESTB_CODE]) 
                {
                    $rec_error[36]='QTS TTR1 - Degree - Establishment Code not entered';
                }
                if  (!$currentrec[self::DEGREE_CLASS_CODE])
                {
                    $rec_error[37]='QTS TTR1 - Degree - Class Code not entered';
                }
                if  (!$currentrec[self::DEGREE_SUBJECT_CODE1])
                {
                    $rec_error[38]='QTS TTR1 - Degree - Subject Code 1 not entered';
                }
                
            }
            
            if (!$rec_error && !in_array($currentrec[self::ITET_QUAL_TYPE_CODE],array('020','050','031','215'),$strict))
            {
              if  (!$currentrec[self::DEGREE_QUAL_TYPE_CODE])
              {    
                 $rec_error[35]='QTS TTR1 - Degree - Qualification Type not entered';
              }
              if  (!$currentrec[self::DEGREE_ESTB_CODE])
              {
                    $rec_error[36]='QTS TTR1 - Degree - Establishment Code not entered';
              }
              IF  (!$currentrec[self::DEGREE_SUBJECT_CODE1]) 
              {
                    $rec_error[38]='QTS TTR1 - Degree - Subject Code 1 not entered';
              }
            }
            
            if (!$rec_error) {
                
                $person = $this->em->getRepository('ESERVMAINContactBundle:Person')
                                            ->findOneBy(array('firstName' => $currentrec[self::FORENAME]
                                                             ,'lastName' => $currentrec[self::SURNAME]
                                                             ,'dateOfBirth' => $currentrec[self::DOB]
                                                             ));

                if ($person) {

                    $rec_error[33]='QTS TTR1 - Teacher matches in the QTS module with Ref No : '.$person->getReferenceNo();
                }
            }
            $qts_route = null;
            if (in_array($currentrec[SELF::ROUTE_QTS],array('1','2'),$strict )) 
            { 
                $currentrec[SELF::ROUTE_QTS] = \strtr($currentrec[SELF::ROUTE_QTS], self::QTS_ROUTE_1.self::QTS_ROUTE_2, AppConstants::AC_ITET_QUALIFICATION.AppConstants::AC_DEGREE_QUALIFICATION );
                $code_type = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')->findOneBy(array('code' => AppConstants::ACT_QUTYPE));
                $qts_route = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(array('applicationCodeType' => $code_type->getId(),'code' => $currentrec[SELF::ROUTE_QTS]));
            }    
            if (!$rec_error && $qts_route) 
            {
                $currentrec[SELF::ROUTE_QTS] = $qts_route;
            } elseif (!$rec_error) {
                $rec_error[33]='QTS TTR1 - QTS Route is not spcified. It should be 1-ITET and 2-Others';                
            }
            
            if (!$rec_error && $qts_route) {
                $gtcw_qts_range_services = new \GTCW\GTCWBundle\Services\GTCWGTCWBundleQtsRangeServices($this->em, $this->container);
                $generated_ref_num = $gtcw_qts_range_services->generateRefNum($academic_year->format('d-M-Y'), $qts_route);
                
                if (!$generated_ref_num) {
                    $rec_error[77]='TTR1 - Range is not specified';
                   
                } else {
                    $currentrec[self::REF_NO] = $generated_ref_num['REF_NO'];                    
                }
            }
            
            if (!$rec_error) {
                
                self::createPerson($currentrec);
                $currentrec = array();                
            } else {
                $this->error_array[$i] = $rec_error;
            }
            
            if (($i % 100) === 0) {
                $this->em->flush();
                $this->em->getConnection()->commit();          
                $this->em->getConnection()->beginTransaction();
            }
            
            array_shift($this->data);
        }

        foreach($this->error_array as $key=> $errarr) {
            print 'record= '.$key.'<br>' ;
            foreach ($errarr as $errkey => $err) {
                print('errkey : '.$errkey.' = '.$err.'<br>');
            }
        }
        $this->em->flush();
        $this->em->getConnection()->commit();
        
        die('here');        
        
        // createESERVUser($DataArray, $password);
        
        return $this->render('ESERVTestBundle:Developer:create_user.html.twig', array(
            'form' => $form->createView(),
        ));
    }

   public function Ttr4Load()
    /*****************************************************************************
     * Name: Ttr4Load
     * Purpose: This is the TTR4 dataload creates an array with all the error messages
     *          updates the QTS persons with updated QTS details.
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/          
    {
        $qts_status71 = $this->em->getRepository('GTCWGTCWBundle:GtcwQtsStatus')
                                            ->findOneBy(array('code' => '71'));
        $this->keys = self::get_interface_keys(array_shift($this->data));
        $course_outcome_type = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')->findOneBy(array('code' => ClientConstants::ACT_QTS_COURSE_OUTCOME));
        
        $this->file_errors = array();
        $strict = true;
        $i = 0;
        foreach ($this->data as $record)  {
            
            $rec_error=array();
            $i++;
            $currentrec = array();
            foreach ($record as $field => $value) {
                $currentrec[$this->keys[$field]]=$value;
            }
            foreach ($this->keys as $key) {
                if (!array_key_exists($key, $currentrec)) {
                    $currentrec[$key] = null;
                }
            }

            if   (!$currentrec[self::TR4_REF_NO] ||
                 !$currentrec[self::TR4_DOB] ||
                 !$currentrec[self::TR4_COURSE_OUTCOME] ||
                 !$currentrec[self::TR4_COMPLETION_DATE]) {

                $rec_error[8]='Mandatory columns are null';
            } else {
            
                #print($currentrec[self::TR4_DOB].'-'.$currentrec[self::TR4_COMPLETION_DATE].'<br>');
            }    
            
            $verified_date = null;
            if (!$rec_error && self::valid_date($currentrec[self::TR4_DOB], $verified_date)) {
                $currentrec[self::TR4_DOB] = $verified_date;
            } elseif (!$rec_error) {
                $rec_error[46]='Date of Birth - Invalid date format';
            }
            
            if (!$rec_error && self::valid_date($currentrec[self::TR4_COMPLETION_DATE], $verified_date)) {
                $currentrec[self::TR4_COMPLETION_DATE] = $verified_date;
            } elseif (!$rec_error) {
                $rec_error[58]='TTR4 - Invalid Completion date';
            }
            
            if (!$rec_error) {
                $person = $this->em->getRepository('ESERVMAINContactBundle:Person')
                        ->findOneBy(array('referenceNo' => $currentrec[self::TR4_REF_NO], 'dateOfBirth' => $currentrec[self::TR4_DOB]));

                if ($person) {
                    #print($person->getLastName().'<br>');                    
                } else {
                    $rec_error[40]='TTR4 - No matching Teacher record found';
                }        
            }
            
            if (!$rec_error) {
                $per_itet_qual = $this->em->getRepository('ESERVMAINQualificationBundle:ContactQualification')
                        ->findOneBy(array('contact'=>$person->getContact(), 'qualType' => $this->ITET_qual_type));
                
                if ($per_itet_qual) {
                    $qual = $per_itet_qual->getQualification();
                }
                
                if (in_array($qual->getCode(),array('001', '003', '007', '215'),$strict)) {
                    
                } elseif (in_array($qual->getCode(),array('002','004','008','013','014','016'),$strict)) {
                    if (! in_array(self::nvl($currentrec[self::TR4_ITET_CLASS_CODE],'99'), array('01','02','03','05','09'),$strict)) {
                        if (! in_array($currentrec[self::TR4_COURSE_OUTCOME], array('2','3','4'),$strict)) {
                            $rec_error[42]='QTS TTR4 - Class must be in 01,02,03,05,09';
                        }
                    }
                    if (!$currentrec[self::TR4_DEGREE_CLASS_CODE] || !$currentrec[self::TR4_YEAR_OF_AWARD]) {
                        if (!in_array($currentrec[self::TR4_COURSE_OUTCOME],array('2','3','4'),$strict)) {
                            $rec_error[96]='QTS TTR4 - Degree Year of Award or Class  is missing';
                        }
                    }
                } elseif (in_array($qual->getCode(),array('020','050','031'),$strict)) {
                        if (in_array($currentrec[self::TR4_COURSE_OUTCOME],array('2','3','4'),$strict)) {
                            if ($currentrec[self::TR4_DEGREE_CLASS_CODE]) {
                                $rec_error[94]='QTS TTR4 - Invalid Degree Class';
                            }
                         }
                         if ($currentrec[self::TR4_COURSE_OUTCOME] === '1') {
                             if (!$currentrec[self::TR4_ITET_CLASS_CODE]) {
                                 $rec_error[95]='QTS TTR4 - Invalid ITET Degree Class';
                             } 
                              
                         }
                         if ($currentrec[self::TR4_DEGREE_CLASS_CODE] || $currentrec[self::TR4_YEAR_OF_AWARD]) {
                             $rec_error[43]='TTR4 - Degree details for types 020,050 (PGCE) cannot have values for: Year of Award or Degree Class';
                         }                    
                } elseif (! in_array($qual->getCode(),array('020','050','031'),$strict)) {
                    if ($currentrec[self::TR4_COURSE_OUTCOME] === '1') {
                        if (!$currentrec[self::TR4_DEGREE_CLASS_CODE] || !$currentrec[self::TR4_YEAR_OF_AWARD]) {
                             $rec_error[96]='QTS TTR4 - Degree Year of Award or Class is missing';                            
                        }
                    }                    
                }
                
                if (!$rec_error) {
                    if (in_array($currentrec[self::TR4_COURSE_OUTCOME],array('2','3','4'),$strict)) {
                        if ($currentrec[self::TR4_DEGREE_CLASS_CODE] != null ||  $currentrec[self::TR4_YEAR_OF_AWARD] != null || $currentrec[self::TR4_ITET_CLASS_CODE] != null) {

                            $rec_error[97]='TTR4 - Course outcome 2 3,4 cannot have values for: Year of Award, Degree Class or ITET Class Code';
                        }
                    }
                }
            }
            
            if (!$rec_error && $currentrec[self::TR4_YEAR_OF_AWARD]) {
                $currentrec[self::TR4_YEAR_OF_AWARD] = '01/09/'.$currentrec[self::TR4_YEAR_OF_AWARD];
                if (self::valid_date($currentrec[self::TR4_YEAR_OF_AWARD], $verified_date)) {
                    $currentrec[self::TR4_YEAR_OF_AWARD] = $verified_date;
                } else {
                    $rec_error[92]='TTR4 - Invalid Degree Year of Award';
                }
            }

            if (!$rec_error) {
                $deg_class = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->findOneBy(array('applicationCodeType' => $this->degreeClass_codeType->getId(),'code' => $currentrec[self::TR4_DEGREE_CLASS_CODE]));
                if ($deg_class) {
                    $currentrec[self::TR4_DEGREE_CLASS_CODE] = $deg_class;
                }
                
                if (!in_array($currentrec[self::TR4_COURSE_OUTCOME],array('2','3','4'),$strict)) {
                    #print('<br>'.'qual code = '.$qual->getCode(). 'degclass='.$deg_class.'<br>');
#                    if (!in_array($qual->getCode(),array('001','003','007','215'),$strict)) {
                    if (!in_array($qual->getCode(),array('020','050','031', '215'),$strict)) {
                        if (!$deg_class) {
                            $rec_error[93] = 'TTR4 - Invalid Degree Class';
                        }
                    }
                }
            }    
            
            if (!$rec_error) {
                $gtcw_main = $this->em->getRepository('GTCWGTCWBundle:GtcwMain')
                        ->findOneBy(array('contact'=>$person->getContact()));
                $gtcw_qts_main = $this->em->getRepository('GTCWGTCWBundle:GtcwQtsMain')
                        ->findOneBy(array('contact'=>$person->getContact()));
                if (in_array($currentrec[self::TR4_COURSE_OUTCOME],array('2','3','4'),$strict)) {
                    if ($gtcw_main->getQtsStatus() && $gtcw_main->getQtsDate()) {
                        $rec_error[44] = 'QTS TTR4 - QTS Status and QTS Date must be null';
                    }
                }
                
            }
            
            $proceed_ok = true;
            
            if (!$rec_error && $proceed_ok) {
                
                try {                    
                    $this->em->getConnection()->beginTransaction();
                    $null = self::valid_date('01-08-'.date('Y'), $verified_date);
                    if ($currentrec[self::TR4_COURSE_OUTCOME] === '1') {
                        if ($gtcw_qts_main->getRouteToQts()->getCode() === AppConstants::AC_ITET_QUALIFICATION) {
                            $today_date = null;
                            $null = self::valid_date(date('d-m-Y'), $today_date);
                            $gtcw_qts_main->setTtr4Received($today_date);                                 
                        }
                        $gtcw_main->setQtsStatus($qts_status71);
                        $gtcw_main->setQtsDate($verified_date);
                        $gtcw_qts_main->setQtsCertIssued($verified_date);
                        $gtcw_qts_main->setQtsInduction('NWS');

                    } else {
                        $gtcw_qts_main->setTtr4Received($today_date);                                                     
                    }

                    $course_outcome = null;
                    $course_outcome = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(array('applicationCodeType' => $course_outcome_type,'code' => $currentrec[self::TR4_COURSE_OUTCOME]));
                    if ($course_outcome) {
                        $per_itet_qual->setCourseOutcome($course_outcome);
                    }
                    $itet_class = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                ->findOneBy(array('applicationCodeType' => $this->degreeClass_codeType->getId(),'code' => $currentrec[self::TR4_ITET_CLASS_CODE]));
                    if ($itet_class) {
                        $per_itet_qual->setClass($itet_class);
                    }
                    $per_itet_qual->setEndDate($currentrec[self::TR4_COMPLETION_DATE]);
                    $this->em->persist($gtcw_main);
                    $this->em->persist($gtcw_qts_main);
                    $this->em->persist($per_itet_qual);
                    $this->em->flush();
                    
                    if (!in_array($qual->getCode(),array('020','050','031','215'),$strict)) {
                            $per_degree_qual = $this->em->getRepository('ESERVMAINQualificationBundle:ContactQualification')
                                                    ->findOneBy(array('contact'=>$person->getContact(), 'qualType' => $this->degree_qual_type));
                            if ($per_degree_qual  && $currentrec[self::TR4_DEGREE_CLASS_CODE]) {
                                $per_degree_qual->setClass($currentrec[self::TR4_DEGREE_CLASS_CODE]);
                                $per_degree_qual->setYearOfAward($currentrec[self::TR4_YEAR_OF_AWARD]);
                            }
                            $this->em->persist($per_degree_qual);
                            $this->em->flush();
                    }
                    
                    $this->em->getConnection()->commit();
                } catch (\Exception $e) {
                    $this->em->getConnection()->rollback();
                    $this->em->close();
                    $message = 'Error occurred while loading TR4 interface: - ' . $e->getMessage();
                
                    die('OOOPS  ERROR in TR4 interface = '.$message);
                    
                }
                
            }
            if (!$rec_error) {
                print($i.' = ok <br>');
                #self::createPerson($this->em, $currentrec);
            } else {
                $this->error_array[$i] = $rec_error;
            }
            
        }
        
        print('<br>############# Errors #############<br>');
        foreach($this->error_array as $key=> $errarr) {
            print 'record= '.$key.'<br>' ;
            foreach ($errarr as $errkey => $err) {
                print('errkey : '.$errkey.' = '.$err.'<br>');
            }
                print('------------<br>');
        }
        
        die('here');

    }

   public function Imp1Load()
    /*****************************************************************************
     * Name: Imp1Load
     * Purpose: This is the IMP1 dataload creates an array with all the error messages
     *          In progress..
     *
     * Log     Date     Developer     Comments
     * ---------------------------------------------------------------------------
     *         18/12/14 S.Till     Initial version
     ****************************************************************************/          
    {
        $this->keys = self::get_interface_keys(array_shift($this->data));
        $course_outcome_type = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')->findOneBy(array('code' => ClientConstants::ACT_QTS_COURSE_OUTCOME));
        
        $this->file_errors = array();
        $strict = true;
        $i = 0;
        foreach ($this->data as $record)  {
            
            $rec_error=array();
            $i++;
            $currentrec = array();
            foreach ($record as $field => $value) {
                $currentrec[$this->keys[$field]]=$value;
            }
            foreach ($this->keys as $key) {
                if (!array_key_exists($key, $currentrec)) {
                    $currentrec[$key] = null;
                }
            }

            if   (!$currentrec[self::I1_REF_NO] ||
                 !$currentrec[self::I1_DOB] ||
                 !$currentrec[self::I1_REGISTRATION_DATE] ||
                 !$currentrec[self::I1_PAYMENT_METHOD]) {

                $rec_error[8]='Mandatory columns are null';
            } 
            
            if (!$rec_error) {
                $verified_date = null;
                if (!$rec_error && self::valid_date($currentrec[self::I1_DOB], $verified_date)) {
                    $currentrec[self::I1_DOB] = $verified_date;
                } elseif (!$rec_error) {
                    $rec_error[46]='Date of Birth - Invalid date format';
                }                
            }

            if (!$rec_error) {
                $verified_date = null;
                if (!$rec_error && self::valid_date($currentrec[self::I1_REGISTRATION_DATE], $verified_date)) {
                    $currentrec[self::I1_REGISTRATION_DATE] = $verified_date;
                } elseif (!$rec_error) {
                    $rec_error[47]='Fee Payment - Invalid Registration Date';
                }                
            }
            
            if (!$rec_error) {
                $payment_method = $this->em->getRepository('ESERVMAINSystemConfigBundle:PaymentMethod')->findOneBy(array('code' => $currentrec[self::I1_PAYMENT_METHOD]));
                if ($payment_method) {
                    $currentrec[self::I1_PAYMENT_METHOD] = $payment_method;
                } else {
                    $rec_error[7]='Fee Payment - Incorrect method of payment';
                    
                }
            }
            if (!$rec_error && $currentrec[self::LEA_CODE]) 
            {
                $this->employer = $this->em->getRepository('ESERVMAINMembershipBundle:Employer')
                                        ->findOneBy(array('code' => $currentrec[self::I1_LEA_CODE]));
                
                if ($this->employer) {
                   $currentrec[self::I1_LEA_CODE] = $this->employer;
                } else {
                   $rec_error[64]='Fee Payment - school code and lea code link does not exist';
                } 
            }
            
        }
    }
    
}
