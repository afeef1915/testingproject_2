<?php

namespace ESERV\MAIN\MembershipBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MemberController extends Controller {

    public function editMemberStatusAction($id) {
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository('ESERVMAINMembershipBundle:Member')->find($id);
        if (!$member) {
            throw $this->createNotFoundException('No Member found for id ' . $id);
        }
        
        $data = array(
            'status' => $member->getMemberStatus(),
            'registration_date' => $member->getRegistrationDate(),
        );

        $form = $this->createForm(new \ESERV\MAIN\MembershipBundle\Form\Member\MemberStatusType(), $data, array(
            'action' => $this->generateUrl('eservmain_membership_member_status_update') . '/' . $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            )
        ));

        return $this->render('ESERVMAINMembershipBundle:Member:edit_member_status.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function updateMemberStatusAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository('ESERVMAINMembershipBundle:Member')->find($id);
        if (!$member) {
            throw $this->createNotFoundException('No Member found for id ' . $id);
        }
        $status = false;
        $errors_array = array();
        $message = '';

        $form = $this->createForm(new \ESERV\MAIN\MembershipBundle\Form\Member\MemberStatusType());
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                    $postData = $form->getData();
                    $member->setMemberStatus($postData['status']);
                    $member->setRegistrationDate($postData['registration_date']);
                    $em->persist($member);
                    $em->flush();
                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Member status successfully updated!';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = 'An error occurred: ' . $e->getMessage();
                }
            } else {
                $message = 'Form is invalid.';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            }
        }
        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

}
