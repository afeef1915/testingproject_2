<?php

namespace WEBLOGS\CORE\MAIN\MediaBundle\Services;

class WEBLOGSUploadHandler extends \ESERV\MAIN\MediaBundle\Services\UploadHandler {

    private $container;
    private $em;
    private $saveToBlob;

    protected function initialize() {
        $this->container = $this->options['service_container'];
        $this->em = $this->options['doctrine_manager'];
        $this->saveToBlob = $this->options['save_to_blob'];
        $this->saveBasedOnExt = $this->options['save_based_on_ext'];
        
                

        parent::initialize();
    }

    protected function handle_form_data($file, $index) {
        $file->title = @$_REQUEST['title'][$index];
        $file->description = @$_REQUEST['description'][$index];
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error, $index = null, $content_range = null) {
         
        $file = new \stdClass();
        $file->name = $this->get_file_name($uploaded_file, $name, $size, $type, $error, $index, $content_range);
        $file->size = $this->fix_integer_overflow(intval($size));
        $file->type = $type;


        $file_id = null;

        if ($this->validate($uploaded_file, $file, $error, $index)) {

            $this->handle_form_data($file, $index);
            $upload_dir = $this->get_upload_path();
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, $this->options['mkdir_mode'], true);
            }
            $file_path = $uploaded_file;
            $append_file = $content_range && is_file($file_path) &&
                    $file->size > $this->get_file_size($file_path);
            if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                $entity_name = $this->options['entity_name'] ? $this->options['entity_name'] : '.';
                $entity_id = $this->options['entity_id'] ? $this->options['entity_id'] : 0;
                
                $content = file_get_contents($uploaded_file);
                try {
                    $media_type = $this->em->getRepository('ESERVMAINMediaBundle:MediaType')->findOneBy(array(
                        'mimeType' => $file->type
                    ));

                    if (!$media_type) {
                        $media_type = new \ESERV\MAIN\MediaBundle\Entity\MediaType();
                        $media_type->setMimeType($file->type);
                        ///$media_type->setName(strtoupper(explode('.', $file->name)[1]));
                        $this->em->persist($media_type);
                        $this->em->flush();
                    }
                    
                    $createdAt = date('Y-m-d H:i:s');
                    $createdBy = $this->container->get('security_services')->getFosUserId();
                    $token = md5(json_encode(array(
                        $file->name,$file->size,$extension,$content,$createdAt,$createdBy
                    )));
                    $conn = $this->em->getConnection();
                    $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
                    //$this->container->get('merlinora_core_dynamic_services')->registerUser($conn);
                    
                    $sequence = 'SELECT s_media_store.nextval AS S_ID FROM dual';
                    $sStmt = $conn->executeQuery($sequence);
                    $sec = $sStmt->fetchAll(\PDO::FETCH_ASSOC);
                    $sMediaStoreSeq = $sec[0]['S_ID'];
                  //  $sMediaStoreSeq='2';
                    if($this->saveBasedOnExt == true){
                        $clobExtensions= array('txt','csv', 'xml');
                        if(in_array($extension, $clobExtensions)){
                            $isBlobContent = false;
                        } else {
                            $isBlobContent = true;
                        }
                    } else {
                        if($this->saveToBlob !== false){
                            $isBlobContent = true;
                        } else {
                            $isBlobContent = false;
                        }
                    }
                    
                    if($isBlobContent){ 
                        $sql = "INSERT INTO media_store (id, file_name, file_size, file_extension, media_type_id, entity_id, entity_name, content, blob_content, temp_token, created_at, created_by) "
                            . " values (:s_media_store_seq, :p_file_name, :p_file_size, :p_file_extension, :p_media_type, :p_entity_id, :p_entity_name,utl_raw.cast_to_raw(:p_content), empty_blob(), :p_temp_token, sysdate, :p_created_by) returning blob_content into :blob1";
                    }else{
                        $sql = "INSERT INTO media_store (id, file_name, file_size, file_extension, media_type_id, entity_id, entity_name, content, temp_token, created_at, created_by) "
                            . " values (:s_media_store_seq, :p_file_name, :p_file_size, :p_file_extension, :p_media_type, :p_entity_id, :p_entity_name, :p_content, :p_temp_token, sysdate, :p_created_by)";
                    }
                    
                    $this->em->beginTransaction();
                    $qb = $conn->prepare($sql);

                    $qb->bindValue('s_media_store_seq', $sMediaStoreSeq, \PDO::PARAM_STR, 100);                    
                    $qb->bindValue('p_file_name', $file->name, \PDO::PARAM_STR, 100);
                    $qb->bindValue('p_file_size', $file->size, \PDO::PARAM_INT, 15);
                    $qb->bindValue('p_file_extension', $extension, \PDO::PARAM_STR, 10);
                    $qb->bindValue('p_media_type', $media_type->getId(), \PDO::PARAM_INT, 15);
                    $qb->bindValue('p_entity_id', $entity_id, \PDO::PARAM_INT, 15);
                    $qb->bindValue('p_entity_name', $entity_name, \PDO::PARAM_STR, 255);    
                   // $qb->bindValue('p_log_id', $logid, \PDO::PARAM_STR, 15);  
                    if($isBlobContent){
                        $blobConstMsg = \ESERV\MAIN\Services\AppConstants::THIS_IS_A_BLOB_CONTENT_MSG;
                        $qb->bindParam('blob1', $blob1, \PDO::PARAM_LOB);
                        $qb->bindParam('p_content', $blobConstMsg, \PDO::PARAM_STR, strlen($blobConstMsg));                        
                    }else{
                        $qb->bindParam('p_content', $content, \PDO::PARAM_STR, strlen($content));
                    }
                    $qb->bindValue('p_temp_token', $token, \PDO::PARAM_STR, 32);
                    $qb->bindValue('p_created_by', $createdBy, \PDO::PARAM_STR, 32);                  
                    $qb->execute();
                    if($isBlobContent){
                        fwrite($blob1, $content);  
                        fclose($blob1);
                    }
                    $this->em->commit();  
                    
                    $file_id = $sMediaStoreSeq;
                    $file->id = $file_id;
                } catch (\Exception $ex) {
                    throw $ex;
                }
            } else {
                // Non-multipart uploads (PUT method support)
                file_put_contents(
                        $file_path, fopen('php://input', 'r'), $append_file ? FILE_APPEND : 0
                );
            }
            $file_size = $this->get_file_size($file_path, $append_file);
            if ($file_size === $file->size) {
                $file->url = $this->get_download_url($file->name);
                if ($this->is_valid_image_file($file_path)) {
                    $this->handle_image_file($file_path, $file);
                }
            } else {
                $file->size = $file_size;
                if (!$content_range && $this->options['discard_aborted_uploads']) {
                    unlink($file_path);
                    $file->error = $this->get_error_message('abort');
                }
            }
        }

        $file->url = $this->get_eserv_download_url($file_id);
        $file->deleteType = 'DELETE';
        $file->deleteUrl = $this->container->get('router')->generate('weblogs_core_main_media_files_remove_files', array(
            'id' => $file_id
        ));

        return $file;
    }

    protected function get_eserv_download_url($file_id = null) {
        if (!is_null($file_id)) {
            return $this->container->get('router')->generate('weblogs_core_main_media_files_download_files', array(
                        'id' => $file_id
            ));
        } else {
            return null;
        }
    }

}
