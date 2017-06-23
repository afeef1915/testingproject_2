<?php

namespace ESERV\MAIN\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        $entity_id = $request->get('entity_id');
        $entity_name = $request->get('entity_name');
        $contact_id = $request->get('contact_id');
        return $this->render('ESERVMAINActivityBundle:Default:index.html.twig', array(
                    'entity_id' => $entity_id,
                    'entity_name' => $entity_name,
                    'contact_id' => $contact_id
        ));
    }

}
