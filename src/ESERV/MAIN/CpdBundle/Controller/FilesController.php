<?php

namespace ESERV\MAIN\CpdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class FilesController extends Controller {

    public function uploadAction(Request $request) 
    {
        $options = array(
            'delete_type' => 'POST',            
            'doctrine_manager' => $this->getDoctrine()->getManager(),
            'service_container' => $this->container
        );
        
        $contact_cpd_status_id = $request->get('contact_cpd_status_id');
        new \ESERV\MAIN\CpdBundle\Services\CpdBundleUploadHandler($contact_cpd_status_id, $options);
        die;
    }

    public function removeAction($id) 
    {   
        $status = false;
        $message = '';

        try {
            $uploaded_doc_store = new \ESERV\MAIN\CpdBundle\Services\CpdBundleDcoumentServices($this->getDoctrine()->getManager(), $this->container);
            $file_info = $uploaded_doc_store->deleteContactCpdDocLib($id);

            if ($file_info) {
                $status = true;
                $message = 'Successfully deleted file id: ' . $id;
            } else {
                $message = 'File id: ' . $id . ' does not exist!';
            }
        } catch (Exception $ex) {
            $message = 'Unable to delete file id: ' . $id . ' - Error: ' . $ex->getMessage();
        }

        $result = array(
            'status' => $status,
            'message' => $message
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }

    public function downloadAction($id) 
    {
        $uploaded_doc_store = new \ESERV\MAIN\CpdBundle\Services\CpdBundleDcoumentServices($this->getDoctrine()->getManager(), $this->container);

        $file_info = $uploaded_doc_store->getContactCpdDocLibById($id);

        if (count($file_info) > 0) {
            $response = new Response();

            $response->headers->set('Cache-Control', 'private');
            $response->headers->set('Content-type', $file_info[0]['mediaType']['mimeType'] . '; charset=utf-8');
            $response->headers->set('Pragma', 'public');
            $response->headers->set('Content-Transfer-Encoding', 'binary');
            $response->headers->set('Content-length', $file_info[0]['fileSize']);

            $response->headers->set('Content-Disposition', 'attachment; filename="' . $file_info[0]['name'] . '"');

            $tmp_contents = stream_get_contents($file_info[0]['fileContent']);

            $response->setContent($tmp_contents);

            return $response;
        } else {
            throw $this->createNotFoundException(
                    'No uploaded document found for id ' . $id
            );
        }
    }

}
