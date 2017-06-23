<?php

namespace ESERV\MAIN\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\DbCoreFunctions;

class DefaultController extends Controller {

    public function indexAction() 
    {
        $all_application_codes = $this->get('db_core_function_services')->count('ESERVMAINApplicationCodeBundle:ApplicationCode', array());
        $all_qualifications = $this->get('db_core_function_services')->count('ESERVMAINQualificationBundle:Qualification', array());
        $all_subjects = $this->get('db_core_function_services')->count('ESERVMAINQualificationBundle:Subject', array());

        return $this->render('ESERVMAINAdministrationBundle:Default:index.html.twig', array(
            'application_code_count' => $all_application_codes,
            'qualification_count' => $all_qualifications,
            'subject_count' => $all_subjects,
        ));
    }

    public function homeAction() 
    {
        return $this->render('ESERVMAINAdministrationBundle:Default:home.html.twig', array());
    }

}
