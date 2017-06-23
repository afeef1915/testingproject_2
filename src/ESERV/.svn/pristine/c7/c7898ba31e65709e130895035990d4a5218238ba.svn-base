<?php

namespace ESERV\MAIN\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends Controller {

    public function checkReferenceNoAction($refNo) {
        $message = '';
        $success = false;
        $exists = false;
        $person_name = '';
        
        try {
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(
                    array('referenceNo' => $refNo));
            if ($result) {
                $exists = true;
                $person_name = $result->getFirstName() .' '. $result->getLastName();
            }
            $success = true;
        } catch (\Exception $e) {
            $message = 'Error occurred :- ' . $e->getMessage();
            $success = false;
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'success' => $success,
            'msg' => $message,
            'exists' => $exists,
            'person_name' => $person_name
        ));
    }
    
    public function checkNiNoAction($niNo, $contactId = null) 
    {
        $message = '';
        $success = false;
        $exists = false;
        $person_name = '';
        
        try {
            $em = $this->getDoctrine()->getManager();
            if(null != $contactId){
                $contact = $em->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $contactId);
                $result = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(
                    array('niNumber' => $niNo, 'contact' => $contact));
                //NI number belong to the contact currently in - not a problem
                if ($result) {
                    $success = true;
                 
                }else{
                    $result = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(
                            array('niNumber' => $niNo));
                    //NI number belongs to some other contact - problem
                    if ($result) {
                        $exists = true;
                        $person_name = $result->getFirstName() .' '. $result->getLastName();
                        $message = 'NI Number '.$niNo.' is asigned to '.$person_name;
                    //NI number does not belongs to some other contact, so updaiting the NI - not a problem
                    }else{
                        $success = true;
                    }
                }
            }else{
                $result = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(
                    array('niNumber' => $niNo));
                if ($result) {
                    $exists = true;
                    $person_name = $result->getFirstName() .' '. $result->getLastName();
                }
                $success = true;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $success = false;
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'success' => $success,
            'msg' => $message,
            'exists' => $exists,
            'person_name' => $person_name
        ));
    }
    
    public function checkPDDuplicationAction(Request $request) 
    {
        $surname = $request->get('surname');
        $dob = $request->get('dob');        
        
        $message = '';
        $success = false;
        $exists = false;
        $person_name = '';

        try {
            $em = $this->getDoctrine()->getManager();
            $date_of_birth = new \DateTime($this->container->get('core_function_services')->changeDateFormat($dob));                        
            $result = $em->getRepository('ESERVMAINContactBundle:Person')->findBy(array('lastName' => $surname, 'dateOfBirth' => $date_of_birth));
            $count = count($result);
            //Personal Details Duplicate match
            if ($count > 0) {
                $exists = true;                
                if ($count == 1) {                    
                    $person_name = $result[0]->getFirstName() . ' ' . $result[0]->getLastName();
                    $date_of_birth = $date_of_birth instanceof \DateTime ? $date_of_birth->format('d-m-y') : '';                                  
                    $message = "Registrant ($person_name) is matching the given surname ($surname) and date of birth ($dob).";                
                } else {
                    $message = "There are  $count registrants matching the given surname ($surname) and date of birth ($dob).";
                }

                $success = true;
            } else {
                $success = true; // No match found
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $success = false;
        }       
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'success' => $success,
            'msg' => $message,
            'exists' => $exists,
            'person_name' => $person_name
        ));
    }

}
