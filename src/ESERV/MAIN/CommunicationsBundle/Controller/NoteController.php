<?php

namespace ESERV\MAIN\CommunicationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends Controller {
    ## add the actions to crud notes here

    public function newNoteAction(Request $request) {

        $entityName = $request->get('entity_name');
        $entityId = $request->get('entity_id'); //person_id
        $contactId = $request->get('contact_id'); //contact_id
        $category_code = $request->get('category_code');
        $comms_q = $request->get('comms_q', '0');

        $action_url = $this->generateUrl('eserv_main_note_create', array('contact_id' => $contactId));
        $activityCategory = $this->getDoctrine()->getManager()
                ->getRepository('ESERVMAINActivityBundle:ActivityCategory')
                ->findOneBy(array('code' => $category_code));

        $note = new \ESERV\MAIN\CommunicationsBundle\Entity\Note();
        $note->setEntityName($entityName);
        $note->setActivityCategory($activityCategory);
        $note->setEntityId($entityId);

        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'em' => $this->getDoctrine()->getManager(),
            'commsSql' => $comms_q,
            'attr' => array(
                'class' => 'eserv_form form-horizontal  eserv_form_editable'),
        );
        $form = $this->createForm(new \ESERV\MAIN\CommunicationsBundle\Form\NoteType(), $note, $form_options_array);

        return $this->render('ESERVMAINCommunicationsBundle:Note:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function createNoteAction(Request $request) {
        $status = false;
        $result = array();

        $message = '';

        $note = new \ESERV\MAIN\CommunicationsBundle\Entity\Note();
        $note->setCreatedBy($this->getUser()->getId());
        $form = $this->createForm(new \ESERV\MAIN\CommunicationsBundle\Form\NoteType(), $note, array('em' => $this->getDoctrine()->getManager(),));
        $form->handleRequest($request);
       
        if ($form->isValid()) {
            try {
                $em1 = $this->getDoctrine()->getManager();
                $note_data = $form->getData();
                
                $data = $request->get($form->getName());

//                $result = '';
//                $comms_q = $form->get('commsQ')->getData();                
//                if($comms_q !== '0'){                                            
//                    $p_ids = $this->get('db_core_function_services')->runRawSqlMultiCondition($comms_q);
//                    $result = $this->get('db_core_function_services')->getContactIdsByPersonIds($p_ids);
//                }
//                print_r($result);
//                die;
                
//                $em1->persist($note_data);
                
                
                $activityCategory = $em1->getReference('ESERV\MAIN\ActivityBundle\Entity\ActivityCategory', $data['activityCategory']);
                $act_out_status = $em1->getRepository('ESERVMAINSystemConfigBundle:SystemCode')
                        ->getBySystemCodeTypeAndCode(
                                \ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE, 
                                \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_STATUS_COMPLETE_CODE, 
                                array('id')
                );
                $contact = $em1->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $data['entityId']);
                $sourceContact = $em1->getReference('ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', $data['activitySource']);
                
                $activity = $em1
                    ->getRepository('ESERVMAINActivityBundle:Activity')
                    ->createActivity(
                            $em1, 
                            $activityCategory, 
                            $act_out_status, 
                            NULL, 
                            $data['entityId'], 
                            $data['entityName'], 
                            $data['shortDescription'], 
                            NULL,
                            NULL,
                            NULL,
                            NULL,
                            $data['longDescription'],
                            NULL,
                            0,
                            'N',
                            NULL,
                            NULL,
                            $note_data->getShowAlert() == 'Y' ? 'Y' : 'N',
                            NULL,
                            NULL,
                            NULL,
                            NULL,
                            NULL,
                            NULL,
                            NULL,
                            NULL,
                            NULL,
                            ($sourceContact ? $sourceContact->getId() : NULL)
                );            
                
//                $em1
//                    ->getRepository('ESERVMAINActivityBundle:ActivityTarget')
//                    ->createActivityTarget(
//                          $em1
//                         ,$activity
//                         ,$contact
//                      );

                
                $em1->flush();

                $status = true;
                $message = 'Note created succesfully';
            } catch (\Exception $e) {
                $message = 'Error occurred : ' . $e->getMessage();
            }
        } else {
            if (!$request->isXmlHttpRequest()) {
                $message = $this->render('ESERVMAINCommunicationsBundle:Note:add.html.twig', array('form' => $form->createView()));
            } else {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            }
        }
        
        $activityService = new \ESERV\MAIN\ActivityBundle\Services\ESERVMAINActivityServices($em1, $this->container);
        $teacher_notes = $activityService->getTeacherNotes(array('entity_id' =>  $data['entityId']));
        
        $result = array(
            'success' => $status,
            'msg' => $message,
            'teacher_notes_json' => $teacher_notes
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

    public function getContactNotesAction(Request $request) {
        $message = '';

        $contact_id = $request->get('contact_id');

        $result = array(
            'success' => true,
            'msg' => $message
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

    public function updateNoteAction($note_id, Request $request) {
        $status = false;
        $message = '';

        try {
            $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
            $q = $qb->update('ESERV\MAIN\CommunicationsBundle\Entity\Note', 'n')
                    ->set('n.showAlert', $qb->expr()->literal('N'))
                    ->where('n.id = :note_id')
                    ->setParameter('note_id', $note_id)
                    ->getQuery();
            $p = $q->execute();
            
            $status = true;
            #$message = 'Note updated successfully';
        } catch (Exception $ex) {
            #$message = 'Note has not been updated';
        }
        
        $result = array(
            'success' => $status,
            'msg' => $message
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }
    
    public function viewNotesAction($entity_id)
    {
        $em = $this->getDoctrine()->getManager();
        $activityService = new \ESERV\MAIN\ActivityBundle\Services\ESERVMAINActivityServices($em, $this->container);
        $teacher_notes = $activityService->getTeacherNotes(array('entity_id' => $entity_id));

        return $this->render('ESERVMAINCommunicationsBundle:Note:view_notes.html.twig', array(
                    'teacher_notes' => $teacher_notes,
        ));
    }
    
    public function markNoteAsReadAction($id, Request $request) {
        $status = true;
        $message = 'Note marked as read!';
        try {
            $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
            $q = $qb->update('ESERV\MAIN\CommunicationsBundle\Entity\Note', 'n')
                    ->set('n.showAlert', $qb->expr()->literal('N'))
                    ->where('n.id = :note_id')
                    ->setParameter('note_id', $id)
                    ->getQuery()
                    ->execute();
            
            $status = true;
            $message = 'Note marked as read!';
        } catch (Exception $e) {
            $message = 'Error occurred : ' . $e->getMessage();
        }
        
        $result = array(
            'success' => $status,
            'msg' => $message
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

}
