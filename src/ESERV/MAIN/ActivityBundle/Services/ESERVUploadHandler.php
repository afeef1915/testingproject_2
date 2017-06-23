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

namespace ESERV\MAIN\ActivityBundle\Services;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use ESERV\MAIN\MediaBundle\Services\UploadHandler;

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
                $fileName = pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                $entityName = array_key_exists('entity_name', $this->options) ? $this->options['entity_name'] : '.';
                $entityId = array_key_exists('entity_id', $this->options) ? $this->options['entity_id'] : 0;
                $activityCategoryCode = array_key_exists('activity_category_code', $this->options) ? $this->options['activity_category_code'] : \ESERV\MAIN\Services\AppConstants::ACTCAT_TEACHER_DOCUMENT;

                $content = file_get_contents($uploaded_file);

                $activityType = $this->em->getRepository('ESERVMAINActivityBundle:ActivityType')->findOneBy(array(
                    'code' => \ESERV\MAIN\Services\AppConstants::AT_ATTACHED_DOCUMENT
                ));
                $activityCategory = $this->em->getRepository('ESERVMAINActivityBundle:ActivityCategory')->findOneBy(array(
                    'code' => $activityCategoryCode,
                    'activityType' => $activityType,
                ));
                $systemCodeType = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCodeType')->findOneBy(array(
                    'code' => \ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE
                ));
                $systemCode = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->findOneBy(array(
                    'systemCodeType' => $systemCodeType,
                    'code' => \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_STATUS_OUTSTANDING_CODE
                ));
                try {
                    $this->em->getConnection()->beginTransaction();
                    $activity = new \ESERV\MAIN\ActivityBundle\Entity\Activity();
                    $activity->setActivityCategory($activityCategory);
                    $activity->setStatus($systemCode);
                    $activity->setEntityId($entityId);
                    $activity->setEntityName($entityName);
                    $this->em->persist($activity);

                    $mediaType = $this->em->getRepository('ESERVMAINMediaBundle:MediaType')->findOneBy(array(
                        'mimeType' => $file->type
                    ));

                    if (!$mediaType) {
                        $mediaType = new \ESERV\MAIN\MediaBundle\Entity\MediaType();
                        $mediaType->setMimeType($file->type);
                        $mediaType->setName(strtoupper($extension));
                        $this->em->persist($mediaType);
                    }

                    $activityMedia = new \ESERV\MAIN\ActivityBundle\Entity\ActivityMedia();
                    $activityMedia->setActivity($activity);
                    $activityMedia->setFileName($fileName);
                    $activityMedia->setFileSize($file->size);
                    $activityMedia->setFileExtension($extension);
                    $activityMedia->setMediaType($mediaType);
                    $activityMedia->setContent($content);
                    $this->em->persist($activityMedia);

                    $this->em->flush();
                    $this->em->getConnection()->commit();
                    $file_id = $activityMedia->getId();
                    $file->id = $file_id;
                } catch (Exception $ex) {
                    $this->em->getConnection()->rollback();
                    $message = 'Unable to save file! Error: ' . $ex->getMessage();
                    $file->error = $this->get_error_message($message);
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
        $file->deleteUrl = $this->container->get('router')->generate('eserv_main_activity_media_files_remove_files', array(
            'id' => $file_id
        ));

        return $file;
    }

    protected function get_eserv_download_url($file_id = null) {

        if (!is_null($file_id)) {

            return $this->container->get('router')->generate('eserv_main_activity_media_files_download_files', array(
                        'id' => $file_id
            ));
        } else {
            return null;
        }
    }

}
