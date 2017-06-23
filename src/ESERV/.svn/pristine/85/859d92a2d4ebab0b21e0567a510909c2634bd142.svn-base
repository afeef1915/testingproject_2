<?php

namespace ESERV\MAIN\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;
use ESERV\MAIN\MediaBundle\Services\MediaBundleMediaStoreService;

class PdfController extends Controller {

    public function indexAction() {
        return $this->render('ESERVMAINMediaBundle:Pdf:index.html.twig', array());
    }

    public function generatePdfAction(Request $request) {
        $pdf_contents = '<div style="color: #C40000">Content was not sent!</div>';
        
        $_filename = $request->get('filename');
        $_html_content = $request->get('html_content');
        $_export_type = $request->get('type');

        $file_name = !empty($_filename) ? $_filename : 'test.pdf';
        $html_content = !empty($_html_content) ? $_html_content : $pdf_contents;
        $export_type = !empty($_export_type) ? $_export_type : false;

//        return new Response(
//                $this->container->get('knp_snappy.pdf')->getOutputFromHtml($html_content), 200, array(
//            'Content-Type' => 'application/pdf',
//            'Content-Disposition' => 'filename="' . $file_name . '"'
//        ));
        
        $web_dir = $this->get('kernel')->getRootDir() . '/../web/';
        
        $css_reset_file = $web_dir . 'common/assets/css/global_reset.css';

        $users_folder = $web_dir . 'common/tmp/users';
        $user_contact_id = $this->container->get('core_function_services')->getUserContactId();
        $logged_id_user_folder = $users_folder . '/' . $user_contact_id;
        
        if (!is_dir($users_folder)) {
            mkdir($users_folder);
        }

        if (!is_dir($logged_id_user_folder)) {
            mkdir($logged_id_user_folder);
        }
        $full_file_name = $logged_id_user_folder . '/' . $file_name;
        
        if ($export_type){
            switch ($export_type){
                case 'table':
                    $html_content = '<table cellpadding="0" cellspacing="0" border="0">' . $html_content . '</table>';
                    break;
            }
        }
                
        $reset_html_content = '<html><head><style type="text/css">' . file_get_contents($css_reset_file) . ''
                . '</style></head><body>' . $html_content . '</body></html>';
        
        #throw ;

        try {
            $this->container->get('knp_snappy.pdf')->generateFromHtml($reset_html_content, $full_file_name, array(), true);
            echo $request->getBasePath() . '/common/tmp/users/' . $user_contact_id . '/' . $file_name;
            die;
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

}
