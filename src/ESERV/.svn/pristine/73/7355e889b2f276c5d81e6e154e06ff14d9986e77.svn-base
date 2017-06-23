<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function allAction(Request $request) {
        $contact_id = $request->get('contact_id');
        return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Default:all.html.twig', array('contact_id' => $contact_id));
    }

}
