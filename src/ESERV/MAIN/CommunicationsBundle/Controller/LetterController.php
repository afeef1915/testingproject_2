<?php

namespace ESERV\MAIN\CommunicationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\ActivityBundle\Services\ESERVMAINActivityServices;

class LetterController extends Controller {

    public function newLetterAction(Request $request) {
        $em = $this->getDoctrine()->getManager(); 

        $category_code = $request->query->get('category_code');
        $extra_data_arr = array();
        $extra_data_arr['entity_id'] = $request->query->get('entity_id');
        $extra_data_arr['entity_name'] = $request->query->get('entity_name');
        $extra_data_arr['csl_code'] = $request->query->get('csl_code');
        $extra_data_arr['comm_type'] = \ESERV\MAIN\Services\AppConstants::COMM_LETTER;        
        $comms_q = $request->get('comms_q', '0');
        
//Emulate an action where a query is passed - hence there is no entity_id and entity_name
//$extra_data_arr['entity_id'] = $extra_data_arr['entity_name'] = NULL;        
//$extra_data_arr['query'] = "SELECT contact_id FROM eserv_v_teacher WHERE date_of_birth >= '1965-01-01' AND date_of_birth <= '1974-04-04'";
//Emulate end
        $action_url = $this->generateUrl('eserv_main_letter_create');
        $activityCategory = $this->getDoctrine()->getManager()
                ->getRepository('ESERVMAINActivityBundle:ActivityCategory')
                ->findOneBy(array('code' => $category_code));

        $letter = new \ESERV\MAIN\ActivityBundle\Entity\Activity();
        $letter->setEntityName($extra_data_arr['entity_name']);
        $letter->setEntityId($extra_data_arr['entity_id']);
        $letter->setActivityCategory($activityCategory);        
        $act_out_status = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE, \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_STATUS_OUTSTANDING_CODE, array('id'));
        $extra_data_arr['status_id'] = $act_out_status['id'];
        $tc_arr = array();
        
        if ($comms_q != '0') {
            $extra_data_arr['target_contact'] = $tc_arr;
        } else {
            $extra_data_arr['target_contact'] = array($extra_data_arr['entity_id']);
        }
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'em' => $this->getDoctrine()->getManager(),
            'commsSql' => $comms_q,
            'extra_data' => $extra_data_arr
        );
//var_dump($extra_data_arr); die;
        $form = $this->createForm(new \ESERV\MAIN\CommunicationsBundle\Form\LetterType(), $letter, $form_options_array);

        return $this->render('ESERVMAINCommunicationsBundle:Letter:add.html.twig', array(
                    'form' => $form->createView(),
//                    'templates' => json_encode($templateVersion)
        ));
    }

    public function createLetterAction(Request $request) {
//        $log = $this->get('logger'); $log->info('createLetterAction start');
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';
        #$act_out_status = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE, \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_STATUS_OUTSTANDING_CODE);
        
//        $user_contact_id = $request->get('contact_id');
        $letter = new \ESERV\MAIN\ActivityBundle\Entity\Activity();
        $letter->setCreatedBy($this->getUser()->getId());
        
        $form_data = $request->get('eserv_main_communicationsbundle_letter');
        $extra_data_arr = array();
        $extra_data_arr['entity_id'] = $form_data['entityId'];
        $extra_data_arr['entity_name'] = $form_data['entityName'];
        $extra_data_arr['status_id'] = $form_data['status_id'];
        $extra_data_arr['commsQ'] = $form_data['commsQ'];
        $extra_data_arr['csl_code'] = (array_key_exists('csl_code', $form_data) ? $form_data['csl_code'] : '');
        $extra_data_arr['comm_type'] = (array_key_exists('comm_type', $form_data) ? $form_data['comm_type'] : \ESERV\MAIN\Services\AppConstants::COMM_LETTER);        
        $extra_data_arr['target_contact'] = $extra_data_arr['commsQ'] == '0' ? $form_data['targets'] : array();

        $form = $this->createForm(
                    new \ESERV\MAIN\CommunicationsBundle\Form\LetterType()
                   ,$letter
                   ,array('em' => $this->getDoctrine()->getManager()
                         ,'extra_data' => $extra_data_arr
                         )
                );
        $form->handleRequest($request);
        
        $url = '';

        if ($form->isValid()) {
            try {
                $request_data = $request->request->all();                
                
                if($extra_data_arr['commsQ'] !== '0'){
                    $c_ids = $this->get('db_core_function_services')->runRawSqlMultiCondition($extra_data_arr['commsQ']);                     
                    $request_data['eserv_main_communicationsbundle_letter']['targets'] = $c_ids;
                }
                $ActivityServices = new ESERVMAINActivityServices($this->getDoctrine()->getManager(), $this->container);
                $activity_created = $ActivityServices->CreateActivityLetter($this->getUser(), $request_data['eserv_main_communicationsbundle_letter']);
                $status = $activity_created['status'];
                $message = $activity_created['message'];
                $url = $activity_created['url'];
                $errors_array = (!$status ? array('exception' => $activity_created['message']) : array());                
            } catch (\Exception $e) {
                $message = 'Error occurred : ' . $e->getMessage();
            }
        } else {
            if (!$request->isXmlHttpRequest()) {
                $message = $this->render('ESERVMAINCommunicationsBundle:Letter:add.html.twig', array('form' => $form->createView()));
            } else {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            }
        }
        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
            'url' => $url
        );
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

}
