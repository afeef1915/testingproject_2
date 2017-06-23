<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ESERVUploadHandler
 *
 * @author Samir
 */

namespace ESERV\MAIN\MediaBundle\Services;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

class ESERVUploadHandler extends UploadHandler {

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

                $user = 2;
                $token = isset($this->options['tmp_upload_token']) ? $this->options['tmp_upload_token'] : NULL;
                $upload_type = isset($this->options['upload_type']) ? $this->options['upload_type'] : NULL;

                $extension = pathinfo($name, PATHINFO_EXTENSION);
                                                
                $entity_name = $this->options['entity_name'] ? $this->options['entity_name'] : '.';
                $entity_id = $this->options['entity_id'] ? $this->options['entity_id'] : 0;

                $content = file_get_contents($uploaded_file);

                $media_type = $this->em->getRepository('ESERVMAINMediaBundle:MediaType')->findOneBy(array(
                    'mimeType' => $file->type
                ));
                
                if(!$media_type){
                    $media_type = new \ESERV\MAIN\MediaBundle\Entity\MediaType();
                    $media_type->setMimeType($file->type);
                    $media_type->setName(strtoupper(explode('.', $file->name)[1]));                    
                    $this->em->persist($media_type);
                    $this->em->flush();                    
                }
                
                $media_store = new \ESERV\MAIN\MediaBundle\Entity\MediaStore();
                $media_store->setFileName($file->name);
                $media_store->setFileSize($file->size);
                $media_store->setFileExtension($extension);
                $media_store->setMediaType($media_type);
                $media_store->setEntityId($entity_id);
                $media_store->setEntityName($entity_name);
                $media_store->setContent($content);
                
                $this->em->persist($media_store);
                $this->em->flush();

                $file_id = $media_store->getId();
                $file->id = $file_id;
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
        $file->deleteUrl = $this->container->get('router')->generate('eserv_main_media_files_remove_files', array(
            'id' => $file_id
        ));

        return $file;
    }

    protected function get_eserv_download_url($file_id = null) {

        if (!is_null($file_id)) {

            return $this->container->get('router')->generate('eserv_main_media_files_download_files', array(
                        'id' => $file_id
            ));
        } else {
            return null;
        }
    }

}
