<?php

namespace ESERV\MAIN\DocumentBundle\Services;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

class ESERVUploadDocStoreHandler extends \ESERV\MAIN\Services\Vendor\UploadHandler {

    private $container;
    private $em;

    protected function initialize() {
        $this->container = $this->options['service_container'];
        $this->em = $this->options['doctrine_manager'];

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
//                $type = 1;
//                $extension = 'csv';

                $content = file_get_contents($uploaded_file);
                $info = new \SplFileInfo($file->name);
                $extName = $info->getExtension();
                $media_type = $this->em->getRepository('ESERVMAINMediaBundle:MediaType')->findOneBy(array('name' => strtoupper($extName)));                                        
                if(!$media_type){
                     throw new \Exception('Media Type does not exist!', 500);
                }
                $uploaded_doc_store = new \ESERV\MAIN\DocumentBundle\Services\ContactUploadedDocStoreService($this->em, $this->container);
                $data= array(
                    'file_name' => $file->name,
                    'media_type'=>$media_type,
                    'content'=>$content,
//                    'file_extension'=>$extension,
                    );
                
                $created_info = $uploaded_doc_store->create($data);
                if($created_info['status']){
                    $file_id = $created_info['id'];
                }else{
                    $file->error = $this->get_error_message($created_info['message']);
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

        $file->url = $this->getDownloadUrl($file_id);
        $file->id = $file_id;
        $file->deleteType = 'DELETE';
        $file->deleteUrl = $this->container->get('router')->generate('eserv_main_document_contact_uploaded_doc_store_remove_files', array(
            'id' => $file_id
        ));

        return $file;
    }

    protected function getDownloadUrl($file_id = null) {

        if (!is_null($file_id)) {

            return $this->container->get('router')->generate('eserv_main_document_contact_uploaded_doc_store_download_files', array(
                        'id' => $file_id
            ));
        } else {
            return null;
        }
    }

}
