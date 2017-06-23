<?php

namespace ESERV\MAIN\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InterfaceController extends Controller 
{
    public $catThatRequireMemOrg;
    
    public function __construct()
    {
        $this->catThatRequireMemOrg = array('FPL','LSWL');
    }
    
    public function importViewAction()
    {
        $action_url = $this->generateUrl('eserv_main_administration_import_process');
        
        $em = $this->getDoctrine()->getManager();
        $admin_bundle_services = new \ESERV\MAIN\AdministrationBundle\Services\AdministrationBundleInterfaceService($em, $this->container);            
        $membershipOrgChoice = $admin_bundle_services->getMembershipOrgChoice();

        $import_form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\InterfaceForm\ImportType(), null, array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),
            'extra_params' => $this->container->getParameter('interface_import_categories'),
            'membership_org_choice' => $membershipOrgChoice,
        ));

        return $this->render('ESERVMAINAdministrationBundle:Interface:import_view.html.twig', array(
            'import_form' => $import_form->createView(),
            'cat_mem_org' => $this->catThatRequireMemOrg,
        ));        
        
    }
    
    public function processImportAction(Request $request)
    {    
        $result = array();
        $message = '';
        $errors_array = array();
        $status = false;
        try {
            $em = $this->getDoctrine()->getManager();
            $admin_bundle_services = new \ESERV\MAIN\AdministrationBundle\Services\AdministrationBundleInterfaceService($em, $this->container);            
            $membershipOrgChoice = $admin_bundle_services->getMembershipOrgChoice();
            $import_form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\InterfaceForm\ImportType(), null, array(
                'extra_params' => $this->container->getParameter('interface_import_categories'),
                'membership_org_choice' => $membershipOrgChoice,
            ));

            $import_form->handleRequest($request);

            if ($request->isMethod('POST') && $import_form->isValid()) {
                $postData = $request->request->get('eserv_main_administration_import_form');
                if(in_array($postData['category'], $this->catThatRequireMemOrg) ){
                    if(!$postData['membershipOrg']){
                        throw new \Exception('Please select registration category.', 500);
                    }
                }
                $message_tmp = $admin_bundle_services->executeImport($postData); 
                $message = $message_tmp['msg'];
                $status = $message_tmp['success'];
            } else {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($import_form->getErrors(true));
                $status = false;
            }
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
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
    
    public function exportViewAction()
    {
        $action_url = $this->generateUrl('eserv_main_administration_export_process');

        $export_form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\InterfaceForm\ExportType(), null, array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),
            'extra_params' => $this->container->getParameter('interface_export_categories')
        ));

        return $this->render('ESERVMAINAdministrationBundle:Interface:export_view.html.twig', array(
            'export_form' => $export_form->createView()
        ));        
        
    }
    
    public function processExportAction(Request $request)
    {    
        $result = array();
        $message = '';
        $errors_array = array();
        $status = false;
        
        $export_form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\InterfaceForm\ExportType(), null, array(
            'extra_params' => $this->container->getParameter('interface_export_categories')
        ));
                       
        $export_form->handleRequest($request);

        if ($request->isMethod('POST') && $export_form->isValid()) {
            $postData = $request->request->get('eserv_main_administration_export_form');
            $admin_bundle_services = new \ESERV\MAIN\AdministrationBundle\Services\AdministrationBundleInterfaceService($this->getDoctrine()->getManager(), $this->container);            
            $message_tmp = $admin_bundle_services->executeExport($postData); 
            $message = $message_tmp['msg'];
            $status = $message_tmp['success'];
        } else {
            $message = 'Form is invalid';
            $errors_array = $this->container->get('core_function_services')->getEservFormErrors($export_form->getErrors(true));
            $status = false;
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
