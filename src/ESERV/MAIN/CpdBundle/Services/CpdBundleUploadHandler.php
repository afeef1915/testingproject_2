<?php

namespace ESERV\MAIN\CpdBundle\Services;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

class CpdBundleUploadHandler extends \ESERV\MAIN\Services\Vendor\UploadHandler {

    private $container;
    private $em;
    private $contact_cpd_status_id;

    function __construct($contact_cpd_status_id, $options = null, $initialize = true, $error_messages = null) {
        try {
            $this->contact_cpd_status_id = $contact_cpd_status_id;
        } catch (\Exception $ex) {
            die($ex->getMessage());
        }
        parent::__construct($options, $initialize, $error_messages);
    }

    protected function initialize() {
        $this->container = $this->options['service_container'];
        $this->em = $this->options['doctrine_manager'];

        parent::initialize();
    }

    protected function handle_form_data($file, $index) {
        $file->title = @$_REQUEST['title'][$index];
        $file->description = @$_REQUEST['description'][$index];
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error, $index = null, $content_range = null, $cpd_act_id = null) {
        $file = new \stdClass();
        $file->name = $this->get_file_name($uploaded_file, $name, $size, $type, $error, $index, $content_range);
        $file->size = $this->fix_integer_overflow(intval($size));
        $file->type = $type;
        $contact_cpd_status_id = $this->contact_cpd_status_id;
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
                $content = file_get_contents($uploaded_file);
//                $media_type = $this->em->getReference('ESERV\MAIN\MediaBundle\Entity\MediaType', $type);
                $info = new \SplFileInfo($file->name);
                $extName = $info->getExtension();
                $media_type = $this->em->getRepository('ESERVMAINMediaBundle:MediaType')->findOneBy(array('name' => strtoupper($extName)));                                        
                if(!$media_type){
                     throw new \Exception('Media Type does not exist!', 500);
                }
                
                $uploaded_doc_store = new CpdBundleDcoumentServices($this->em, $this->container);
                $data = array(
                    'contact_cpd_status_id' => $contact_cpd_status_id,
                    'media_type' => $media_type,
                    'name' => $file->name,
                    'file_content' => $content,
                    'file_size' => $file->size
                );

                $created_info = $uploaded_doc_store->createContactCpdDocLibRecord($data);
                if ($created_info['status']) {
                    $file_id = $created_info['id'];
                } else {
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
        $file->deleteUrl = $this->container->get('router')->generate('eservmain_cpd_contact_cpd_doc_lib_remove_files', array(
            'id' => $file_id
        ));

        return $file;
    }

    protected function getDownloadUrl($file_id = null) {

        if (!is_null($file_id)) {

            return $this->container->get('router')->generate('eservmain_cpd_contact_cpd_doc_lib_download_files', array(
                        'id' => $file_id
            ));
        } else {
            return null;
        }
    }

}
