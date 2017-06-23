<?php

namespace ESERV\MAIN\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\ActivityBundle\Services\ESERVUploadHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ActivityMediaController extends Controller {

    public function uploadAction(Request $request) {
        $options = array(
            'delete_type' => 'POST',
            'doctrine_manager' => $this->getDoctrine()->getManager(),
            'service_container' => $this->container
        );

        new ESERVUploadHandler($options);
        die;
    }

    public function removeAction($id) {
        $status = false;
        $message = '';
        $em = $this->getDoctrine()->getManager();
        try {
            $em->getConnection()->beginTransaction();
            $activityMedia = $em->getRepository('ESERVMAINActivityBundle:ActivityMedia')->find($id);
            if($activityMedia) {
                $em->remove($activityMedia);
                $em->flush();
                $em->getConnection()->commit();
                $status = true;
                $message = 'Successfully deleted file id: ' . $id;
            } else {
                $message = 'File id: ' . $id . ' does not exist!';
            }
        } catch (Exception $ex) {
            $em->getConnection()->rollback();
            $message = 'Unable to delete file id: ' . $id . ' - Error: ' . $ex->getMessage();
        }

        $result = array(
            'status' => $status,
            'message' => $message
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }

    public function downloadAction($id) {
        $em = $this->getDoctrine()->getManager();
        $activityMedia = $em->getRepository('ESERVMAINActivityBundle:ActivityMedia')->find($id);
        if($activityMedia) {
            $response = new Response();

            $response->headers->set('Cache-Control', 'private');
            $response->headers->set('Content-type', $activityMedia->getMediaType()->getMimeType() . '; charset=utf-8');
            $response->headers->set('Pragma', 'public');
            $response->headers->set('Content-Transfer-Encoding', 'binary');
            $response->headers->set('Content-length', $activityMedia->getFileSize());

            $response->headers->set('Content-Disposition', 'attachment; filename="' . $activityMedia->getFileName() . '.' . $activityMedia->getFileExtension() . '"');

            $tmpContents = stream_get_contents($activityMedia->getContent());

            $response->setContent($tmpContents);

            return $response;
        } else {
            throw new \Exception('Could not retrieve file!', 500);
        }
    }
    
}
