<?php

namespace ESERV\MAIN\CommunicationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\ActivityBundle\Services\ESERVMAINActivityServices;

class EmailController extends Controller {

    public function newEmailAction(Request $request) {
        $extra_data_arr = $no_email_arr = $tc_arr = array();
        $em = $this->getDoctrine()->getManager();
        
        $category_code = $request->get('category_code');
                
        $extra_data_arr['entity_id'] = $request->query->get('entity_id');
        $extra_data_arr['entity_name'] = $request->query->get('entity_name');
        $extra_data_arr['csl_code'] = $request->query->get('csl_code');
        $extra_data_arr['comm_type'] = \ESERV\MAIN\Services\AppConstants::COMM_EMAIL;
        $extra_data_arr['rec_display'] = '';
        $comms_q = $request->get('comms_q', '0');
  
        $action_url = $this->generateUrl('eserv_main_email_create');
        $activityCategory = $this->getDoctrine()->getManager()
                ->getRepository('ESERVMAINActivityBundle:ActivityCategory')
                ->findOneBy(array('code' => $category_code));
        
        $act_out_status = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE, \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_STATUS_OUTSTANDING_CODE, array('id'));
        $email = new \ESERV\MAIN\ActivityBundle\Entity\Activity();
        $email->setEntityName($extra_data_arr['entity_name']);
        $email->setEntityId($extra_data_arr['entity_id']);
        $email->setActivityCategory($activityCategory);                       
        $extra_data_arr['status_id'] = $act_out_status['id'];

        if ($comms_q == '0') {
            #We are dealing with an email to only one contact
            $extra_data_arr['target_contact'] = array($extra_data_arr['entity_id']);
            $contact_email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVContactEmail')->getPrimaryByContactId($extra_data_arr['entity_id'], array('contactDisplayName', 'emailAddress', 'contactId'));
            $extra_data_arr['rec_display'] = $contact_email['contactDisplayName'];
            if (!(strpos($extra_data_arr['rec_display'], 'No email') === FALSE)) {
                $no_email_arr[] = str_replace(' (No email)', '', $extra_data_arr['rec_display']);
            }
            $extra_data_arr['email_address'] = $contact_email['emailAddress'];            
            $extra_data_arr['targets'] = array($contact_email['contactId'] => $contact_email['contactDisplayName']);
        } else {
            #We are dealing with an email to multiple contact records (via SQL)
            $extra_data_arr['target_contact'] = $tc_arr;
            $sub_query = $this->get('db_core_function_services')->createDqlwithParameters($comms_q); #var_dump($sub_query); die; 
            $no_email_address_arr = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVContactEmail')->getNoEmailAddress($sub_query);
            foreach ($no_email_address_arr as $no_email) {
                $no_email_arr[] = str_replace(' (No email)', '', $no_email['contactDisplayName']);
            }
            $extra_data_arr['email_address'] = '';
            $extra_data_arr['targets'] = array();
        }

        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'em' => $this->getDoctrine()->getManager(),
            'commsSql' => $comms_q, 
            'extra_data' => $extra_data_arr
        );
        $form = $this->createForm(new \ESERV\MAIN\CommunicationsBundle\Form\EmailType(), $email, $form_options_array);

        return $this->render('ESERVMAINCommunicationsBundle:Email:add.html.twig', array(
                    'form' => $form->createView(),
                    'no_email_arr' => $no_email_arr,
                    'no_email_arr_count' => count($no_email_arr)
        ));
    }

    public function createEmailAction(Request $request) {
        $message = '';
        $status = $has_act_target = FALSE;
        $result = array();
        $errors_array = array();
        
        $form_data = $request->get('eserv_main_communicationsbundle_email'); #var_dump($form_data); die;

        $targets = array();
        $target_contact = array();
        $target_contact_selected = array();
        if (($form_data['entityId'] <> '0') && ($form_data['commsQ'] == '0')) {
            #email is for a single contact, recipients is a single value
            if ($form_data['email_address'] == '') {
                #the intended recipient does not have an email address
                $has_act_target = FALSE;
            } else {
                $has_act_target = TRUE;
                $target_contact = $target_contact_selected = array($form_data['entityId']);
            }
        } else {
              #email is for multiple contact records (via SQL)
              $has_act_target = TRUE;
        }
        $extra_data_arr = array(
                              'entity_id' => $form_data['entityId']
                             ,'entity_name' => $form_data['entityName']
                             ,'status_id' => $form_data['status_id']
                             ,'target_contact' => $target_contact
                             ,'rec_display' => $form_data['rec_display']
                             ,'target_contact_selected' => $target_contact_selected
                             ,'email_address' => $form_data['email_address']
                             ,'commsQ' => $form_data['commsQ']
                             ,'targets' => $targets
                             ,'csl_code' => (array_key_exists('csl_code', $form_data) ? $form_data['csl_code'] : '')
                             ,'comm_type' => (array_key_exists('comm_type', $form_data) ? $form_data['comm_type'] : \ESERV\MAIN\Services\AppConstants::COMM_EMAIL)
                          );
        $form_options_array = array(
            'em' => $this->getDoctrine()->getManager()
           ,'extra_data' => $extra_data_arr
        );
        $email = new \ESERV\MAIN\ActivityBundle\Entity\Activity();
        $form = $this->createForm(new \ESERV\MAIN\CommunicationsBundle\Form\EmailType(), $email, $form_options_array);
        $form->handleRequest($request);
        if (
            ($form->isValid()) && 
            ($has_act_target)
        ) {            
            try {
                $request_data = $request->request->all();
                $ActivityServices = new ESERVMAINActivityServices($this->getDoctrine()->getManager(), $this->container);
                $activity_created = $ActivityServices->CreateActivityEmail($this->getUser(), $request_data['eserv_main_communicationsbundle_email']);
                $status = $activity_created['status'];
                $message = $activity_created['message'];
                $errors_array = (!$status ? array('exception' => $activity_created['message']) : array());
            } catch (\Exception $e) {
                $message = 'Error occurred : ' . $e->getMessage();
            }
        } else{           
            if ($request->isXmlHttpRequest()) {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            } else {
                $message = $this->render('ESERVMAINCommunicationsBundle:Email:add.html.twig', array('form' => $form->createView()));
            }        
        } # end form valid        
        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }                
    } #createEmailAction end
    
    //Sample Edit Email function
    public function editEmailAction($id, Request $request)  
    {   
      
    }

    public function viewEmailAttachmentAction($id) {
        $success = FALSE;
        $separator = $this->container->getParameter('data_separator');
        $folder = $this->container->getParameter('attachments_base_folder');
        $file_str = '';
        $content = '';
        $eserv_hash_services = new \ESERV\MAIN\SecurityBundle\Services\ESERVHash($this->getDoctrine()->getManager(), $this->container);
        $decrypted_id = $eserv_hash_services->eserv_decrypt($id);
        $decrypted_arr = explode($separator, $decrypted_id);
        if (is_array($decrypted_arr)) {

            $file_name = $decrypted_arr[1];
            $file_str = '\\' . $decrypted_arr[0] . '\\' . $file_name;
            $file = $folder . $file_str;
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $finfo = new \finfo();
                $mime_type = $finfo->file($file, FILEINFO_MIME_TYPE);
                $file_size = filesize($file);
                $validation_file = $decrypted_arr[2];
                if (file_exists($validation_file)) {
                    $success = TRUE;
                }
            }
        }
        if ($success === TRUE) {
            $response = new Response();
            $response->headers->set('Cache-Control', 'private');
            $response->headers->set('Content-Type', $mime_type . '; charset=utf-8');
            $response->headers->set('Pragma', 'public');
            $response->headers->set('Content-Transfer-Encoding', 'binary');            
            $response->headers->set('Content-length', $file_size);
            $response->headers->set('Content-Disposition', 'attachment; filename="' . $file_name . '"');
            $response->setContent($content);

            return $response;            
        } else {
            throw new \Exception('Could not retrieve file!', 500);
        }
    } #viewEmailAttachment end
}
