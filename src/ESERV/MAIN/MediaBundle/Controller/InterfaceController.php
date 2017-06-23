<?php

namespace ESERV\MAIN\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InterfaceController extends Controller
{

    public function indexAction()
    {
        
    }
    
    public function importFilesAction() {
        return $this->render('ESERVMAINMediaBundle:Interface:import_files.html.twig', array());
    }
    
    public function exportFilesAction() {
        return $this->render('ESERVMAINMediaBundle:Interface:export_files.html.twig', array());
    }

}
