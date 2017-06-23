<?php

namespace ESERV\MAIN\CommunicationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;
use ESERV\MAIN\CommunicationsBundle\Services\ESERVMAINCommunicationsProcesses;

class OutputLetterController extends Controller {

    public $output_letter_columns;
    public $output_letter_table_id = 'eserv_v_output_letter_table';

    public function __construct() {
        $this->output_letter_columns = array(
            'ajDocumentJobId' => array(
                'ajDocumentJobId',
                'options' => array(
                    'header' => 'Print Job',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'shortDescription' => array(
                'shortDescription',
                'options' => array(
                    'header' => 'Document',
                )
            ),
            'status' => array(
                'status',
                'options' => array(
                    'header' => 'Status',
                )
            ),
//            'systemPrinter' => array(
//                'systemPrinter',
//                'options' => array(
//                    'header' => 'Printer',
//                    'css_class' => 'center hide_for_mobile',
//                )
//            ),
            'countActivityTarget' => array(
                'countActivityTarget',
                'options' => array(
                    'header' => 'No. of Docs',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'code' => array(
                'code',
                'options' => array(
                    'header' => 'Code',
                    'css_class' => 'center hide_for_mobile',
                    'visible' => false
                )
            ),
        );
    }

    public function outputLettersListAction() {

        $baseurl = $this->container->get('router')->getContext()->getBaseUrl();

        $this->output_letter_columns['details_btn'] = array(
            'type' => 'download_link',
//            'url' => $baseurl . '/../tmp/print_queue/[[status]]/file_[[activityId]].pdf',
            'url' => $baseurl . '/../tmp/print_queue/[[status]]/file_[[ajDocumentJobId]].pdf',
            'title_text' => '<i class="fa fa-file-pdf-o"></i> Preview',
            'container_id' => $this->output_letter_table_id,
            'url_params' => array(
//                'activityId' => 'activityId',
                'ajDocumentJobId' => 'ajDocumentJobId',
                'status' => 'status'
            ),
            'options' => array(
                'header' => 'Preview',
                'width' => '120px',
                'css_class' => 'center',
                'sortable' => false
            )
        );

        $this->output_letter_columns['details_btn1'] = array(
            'type' => 'checkbox',
            'type_params' => array(
                'name' => 'eserv_dt_checkbox'
            ),
            'url_show_when' => array(
                'condition' => array('[[status]]' => 'Complete'),
            ),
            'url_params' => array(
                'status' => 'status'
            ),
            'url' => '',
            'options' => array(
                'header' => '<div class="checkbox checkbox-danger checkbox-inline"><input id="checkbox_all_deleted_jobs" type="checkbox" class="checkall" data-change-callback="ToggleDeleteBtn" /><label for="checkbox_all_deleted_jobs"></label></div>',
                'width' => '50px',
                'css_class' => 'center',
                'sortable' => false
            ),
            'additional_attr' => array(
                'data-change-callback' => 'enableDisableDeleteBtn',
            )
        );

        $output_letter_columns = DataTables::formatDataTablesColumnsArray($this->output_letter_columns);

        $dataTable = $this->container->get('datatables_services')->DrawTable($this->output_letter_table_id, array(
            'columns' => $output_letter_columns,
            'row_callback' => 'formatStatus(row, data, 2);',
            'source_url' => $this->container->get('router')->generate('eserv_main_output_letter_ajax_list'),
        ));

        return $this->render('ESERVMAINCommunicationsBundle:OutputLetter:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => $this->output_letter_table_id,
        ));
    }

    public function dataAction(Request $request) {
        $doc_url = $this->container->getParameter('eserv_config')['merlin_docs']['url'];
        $baseurl = $this->container->get('router')->getContext()->getBaseUrl();

        $this->output_letter_columns['details_btn'] = array(
            'type' => 'download_link',
//            'url' => $baseurl . '/../tmp/print_queue/[[status]]/file_[[activityId]].pdf',
            'url' => $doc_url . '/../tmp/print_queue/[[status]]/documentJob_[[ajDocumentJobId]].pdf',
            'url_show_when' => array(
                'condition' => array('[[status]]' => 'Complete'),
                'label_to_show' => '<i class="fa fa-times"></i> Not available'
            ),
            'title_text' => '<i class="fa fa-file-pdf-o"></i> Preview',
            'container_id' => $this->output_letter_table_id,
            'url_params' => array(
                'ajDocumentJobId' => 'ajDocumentJobId',
                'status' => 'status'
            ),
            'options' => array(
                'header' => 'Preview',
                'width' => '120px',
                'css_class' => 'center',
                'sortable' => false
            )
        );

        $this->output_letter_columns['details_btn1'] = array(
            'type' => 'checkbox',
            'url' => '',
            'type_params' => array(
                'name' => 'eserv_dt_checkbox'
            ),
            'url_show_when' => array(
                'condition' => array('[[status]]' => 'Complete'),
            ),
            'url_params' => array(
                'status' => 'status'
            ),
            'additional_attr' => array(
                'data-change-callback' => 'enableDisableDeleteBtn',
            ),
            'options' => array(
                'header' => '<div class="checkbox checkbox-danger checkbox-inline"><input id="checkbox_all_deleted_jobs" type="checkbox" class="checkall" data-change-callback="ToggleDeleteBtn" /><label for="checkbox_all_deleted_jobs"></label></div>',
                'width' => '50px',
                'css_class' => 'center',
                'sortable' => false
            )
        );
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    #'name' => 'ESERV\MAIN\CommunicationsBundle\Services\ESERVMAINCommunicationsBundleOutputLetterServices',
                    'name' => 'ESERV\MAIN\CommunicationsBundle\Services\ESERVMAINOutputLetterServices',
                    'function_name' => 'ListOutputLetters',
                    'function_params' => array(
                    )
                )
            ),
            'columns' => $this->output_letter_columns,
            'index_col' => 'code',
            'table_id'=> $this->output_letter_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);
        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function deleteDocumentQueueAction(Request $request) {
        $data = $request->get('id');
        if (!is_array($data)) {
            $newData = explode(',', $data);            
        }
        
        $em = $this->getDoctrine()->getManager();
        if(is_array($newData)){
            foreach($newData as $nd){
                $doc_job_id[] = $em->createQueryBuilder()
                        ->select('p.ajDocumentJobId')
                        ->from('ESERVMAINCommunicationsBundle:EservVOutputLetter', 'p')
                        ->where('p.code = :code')
                        ->setParameter('code', $nd)
                        ->getQuery()
                        ->getArrayResult()[0]['ajDocumentJobId'];
            }
        }
        
       
        $CommServices = new ESERVMAINCommunicationsProcesses($this->getDoctrine()->getManager(), $this->container);

        $result_arr = $CommServices->DeleteDocumentQueue($doc_job_id);
        if ($request->isXmlHttpRequest()) {

            return new \Symfony\Component\HttpFoundation\JsonResponse($result_arr);
        } else {
            print(sprintf('<br />deleteDocumentQueue completed'));
        }
    }

    public function deleteCommHistoryAction(Request $request) {
        $doc_job_id_arr = $request->get('id');
        if (!(is_array($doc_job_id_arr))) {
            $doc_job_id_arr = array($request->get('id'));
        }
        $CommServices = new ESERVMAINCommunicationsProcesses($this->getDoctrine()->getManager(), $this->container);
        $result_arr = $CommServices->DeleteCommHistory($doc_job_id_arr);

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result_arr);
        } else {
            print(sprintf('<br />deleteCommHistory completed'));
            die;
        }
    }

    public function mergeLetterAction(Request $request) {
//        $CommServices = new ESERVMAINCommunicationsProcesses($this->getDoctrine()->getManager(), $this->container);
//        $result_arr = $CommServices->MergeLetters($request);
//        
//        if ($request->isXmlHttpRequest()) {
//            return new \Symfony\Component\HttpFoundation\JsonResponse($result_arr);
//        } else {
//            print(sprintf('<br />mergeLetter completed'));
//            die;
//        }
        $CommServices = new ESERVMAINCommunicationsProcesses($this->getDoctrine()->getManager(), $this->container);
        if ($request->query->has('id')) {
            $result_arr = $CommServices->MergeLetters($request->query->get('id'));
        } else {
            $result_arr = $CommServices->MergeLetters();
        }
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result_arr);
        } else {
            print(sprintf('<br />mergeLetter completed'));
            die;
        }
    }

}
