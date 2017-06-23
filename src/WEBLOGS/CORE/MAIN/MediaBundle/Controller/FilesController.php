<?php

namespace WEBLOGS\CORE\MAIN\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WEBLOGS\CORE\MAIN\MediaBundle\Services\WEBLOGSUploadHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class FilesController extends Controller {

    public function uploadAction(Request $request) { 
    //    $log_id = $request->request->get('log_id');
      //  echo $log_id;die;
        $options = array(
            'delete_type' => 'POST',
            'entity_id' => $request->get('entity_id', false),
            'entity_name' => $request->get('entity_name', false),
            'doctrine_manager' => $this->getDoctrine()->getManager(),
            'service_container' => $this->container,
            'save_to_blob' => $request->get('save_to_blob', false),
            'save_based_on_ext' => $request->get('save_based_on_ext', false),
         //   'log_id'=>$log_id,
        );

        new WEBLOGSUploadHandler($options);
        die;
    }

    public function removeAction($id) {

        $status = false;
        $message = '';
        try {
            $media_store_file = new \WEBLOGS\CORE\MAIN\MediaBundle\Services\MediaBundleMediaStoreService($this->getDoctrine()->getManager(), $this->container);
            $file_info = $media_store_file->delete($id);

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

    public function downloadAction($id) {
       
       // var_dump($id);die;
        $media_store_file = new \WEBLOGS\CORE\MAIN\MediaBundle\Services\MediaBundleMediaStoreService($this->getDoctrine()->getManager(), $this->container);

        $file_info = $media_store_file->show($id);
        
        if (count($file_info) > 0) {

            $response = new Response();

            $response->headers->set('Cache-Control', 'private');
            $response->headers->set('Content-type', $file_info[0]['mediaType']['mimeType'] . '; charset=utf-8');
            $response->headers->set('Pragma', 'public');
            $response->headers->set('Content-Transfer-Encoding', 'binary');
//            $response->headers->set('Content-length', $file_info[0]['fileSize']); //Log: 9045325

            $response->headers->set('Content-Disposition', 'attachment; filename="' . $file_info[0]['fileName'] . '"');
            
            $tstreamContents = $file_info[0]['content']; 
            if($tstreamContents == \ESERV\MAIN\Services\AppConstants::THIS_IS_A_BLOB_CONTENT_MSG){
                $tstreamContents = $file_info[0]['blobContent'];
                $streamContents = stream_get_contents($tstreamContents);
            }else{
                $streamContents = $tstreamContents;
            }
            $response->setContent($streamContents);

            return $response;
        } else {
            throw new \Exception('Could not retrieve file!', 500);
        }
    }

}
