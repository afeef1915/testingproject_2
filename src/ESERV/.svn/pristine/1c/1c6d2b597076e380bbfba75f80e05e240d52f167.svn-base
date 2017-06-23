<?php

namespace ESERV\MAIN\HelpersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\Services\AppConstants;

class DTOutputOptionsController extends Controller {

    public function exportDataTableAction(Request $request) {
        $status = false;
        $url = null;
        $message = '';

        $printQ = $request->get('printQ', null);
        $headerText = $request->get('headerText', null);
        $fileName = $request->get('fileName', null);
        $type = $request->get('type', null);
        $content_text = $request->get('contentText', null);
        $sqlCols = $request->get('sqlCols', null);
        $headers = $request->get('headers', null);
        $export_title = $request->get('exportTitle', null);
        $show_all_columns = $request->get('show_all_columns', 1);


        $new_sql_cols = array();
        $sqlCols_jsondec = json_decode($sqlCols);
        foreach ($sqlCols_jsondec as $h) {
            if (!ctype_lower($h)) {
                $new_sql_cols[] = $this->get('core_function_services')->from_camel_case($h);
            } else {
                $new_sql_cols[] = $h;
            }
        }

        if (null == $type) {
            throw new \Exception('Export type cannot be null.', 500);
        }

        $coreFunctions = $this->get('core_function_services');
        $download_record_limit = $coreFunctions->getESERVSystemConfig('ESERV01');
        $decoded_dql = unserialize($coreFunctions->eservDecode($printQ));
 
       
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $stmt = $conn
                ->prepare($decoded_dql['printQ']);
        $stmt->execute();
        $resultArr = $stmt->fetchAll();

        if (count($resultArr) > $download_record_limit) {
            $em->getConnection()->beginTransaction();
            $system_code_type = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCodeType')->findOneBy(
                    array('code' => AppConstants::SCT_NOTIFICATION_PRIORITY)
            );

            $code = AppConstants::SC_NOTIFICATION_PRIORITY_MEDIUM;
            $notif_pri = $em->getRepository('ESERV\MAIN\SystemConfigBundle\Entity\SystemCode')->findOneBy(
                    array('systemCodeType' => $system_code_type,
                        'code' => $code)
            );
            if ($notif_pri) {
                $qdb_data = array(
                    'name' => $headerText,
                    'description' => 'EService Datatable Export',
                    'notif_priority' => $notif_pri,
                    'type' => AppConstants::ESERV_DT_OUTPUT_OPTIONS
                );

                $process_vars = array(
                    'dql_query' => array(
                        'value' => $decoded_dql['printQ'],
                        'param_ext' => 'PDO::PARAM_STR, -1',
                        'param_type' => 1,
                        'param_size' => -1
                    ),
                    'type' => array(
                        'value' => $type,
                        'param_ext' => 'PDO::PARAM_STR, -1',
                        'param_type' => 1,
                        'param_size' => -1
                    ),
                    'sql_cols' => array(
                        'value' => json_encode($new_sql_cols),
                        'param_ext' => 'PDO::PARAM_STR, -1',
                        'param_type' => 1,
                        'param_size' => -1
                    ),
                    'show_all_columns' => array(
                        'value' => $show_all_columns,
                        'param_ext' => 'PDO::PARAM_STR, -1',
                        'param_type' => 1,
                        'param_size' => -1
                    ),
                    'content_text' => array(
                        'value' => $content_text,
                        'param_ext' => 'PDO::PARAM_STR, -1',
                        'param_type' => 1,
                        'param_size' => -1
                    ),
                    'header_text' => array(
                        'value' => $headerText,
                        'param_ext' => 'PDO::PARAM_STR, -1',
                        'param_type' => 1,
                        'param_size' => -1
                    ),
                    'file_name' => array(
                        'value' => ($fileName != null ? $fileName : rand(9999, 9999999)),
                        'param_ext' => 'PDO::PARAM_STR, -1',
                        'param_type' => 1,
                        'param_size' => -1
                    ),
                    'notif_title' => array(
                        'value' => $export_title,
                        'param_ext' => 'PDO::PARAM_STR, -1',
                        'param_type' => 1,
                        'param_size' => -1
                    ),
                );

                if ('pdf' == $type) {
                    $process_vars['headers'] = array(
                        'value' => $headers,
                        'param_ext' => 'PDO::PARAM_STR, -1',
                        'param_type' => 1,
                        'param_size' => -1
                    );
                }
            }

            $ext_bun_serv = new \ESERV\MAIN\ExternalBundle\Services\ExternalBundleQueuedDbProcessService($em, $this->container);
            $queued_db_process_id = $ext_bun_serv->createQueuedDbRecord($qdb_data, $process_vars);
            if (!is_null($queued_db_process_id)) {
                $em->getConnection()->commit();
                $status = true;
            }
            $message = 'Exporting has been queued. You will receive a notification when the process is done.';
        } else if (count($resultArr) > 0) {
            $eserv_temp = new \ESERV\MAIN\SystemConfigBundle\Entity\EservTemp();
            $em = $this->getDoctrine()->getManager();

            $temp = array(
                'printQ' => $printQ,
                'headerText' => $headerText,
                'headers' => $headers,
                'fileName' => $export_title,
                'sqlCols' => $sqlCols,
                'type' => $type
            );            

            $eserv_temp->setTempValue(json_encode($temp));
            $em->persist($eserv_temp);
            $em->flush();

            $status = true;
            $url = $this->generateUrl('eserv_print_data_table_process_q_force_download', array('id' => $eserv_temp->getId()));
            $message = 'Your file is being downloaded. Please wait.';
        } else {
            $status = false;
            $message = 'No results in the DataTable to export!';
        }
        $result = array(
            'msg' => $message,
            'success' => $status,
        );

        if (count($resultArr) > 0) {
            $result['url'] = $url;
        }
            
           
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $result;
        }
    }

    function processExportAction($id) {
        
    
        $em = $this->getDoctrine()->getManager();
        $eserv_temp = $em->getReference('ESERV\MAIN\SystemConfigBundle\Entity\EservTemp', $id);

        if (!$eserv_temp) {
            throw new Exception('Record is missing in the eserv_temp!.', 500);
        }

        $printQ = $eserv_temp->getTempValue();
        $em->remove($eserv_temp);
        $em->flush();

        $temp = json_decode($printQ);

        $temp_arr = array();

        foreach ($temp as $k => $t) {
            $temp_arr[$k] = $t;
        }
        
        $coreFunctions = $this->get('core_function_services');
        $decoded_dql = unserialize($coreFunctions->eservDecode($temp_arr['printQ']));
        $decoded_dql_printQ = $decoded_dql['printQ']; 
        $sqlCols = $temp_arr['sqlCols'];
        $type = $temp_arr['type'];
        $scols = json_decode($sqlCols);

        //start - replacing coloumns in dql with what user selected from the checkboxes
        if ($sqlCols == '' || is_null($sqlCols)) {
            throw new \Exception('SQL columns are missing in the Request (Session).', 500);
        }
        
        $imp = implode(', ', $scols);        
        $replace = preg_replace('/(SELECT(.+)FROM(.))+/', 'SELECT '.$imp.' FROM ', $decoded_dql_printQ);        
        
        $conn = $em->getConnection();
        $stmt = $conn
                ->prepare($replace);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $file_name = (string) ($temp_arr['fileName'] != null ? $temp_arr['fileName'] : rand(999, 99999)) . '.' . $type;
        
        switch ($type) {
            case 'csv':
                $ms = new \ESERV\MAIN\MediaBundle\Services\HelperServices($this->getDoctrine()->getManager(), $this->container);
                $content = $ms->convert($type, $result, $scols);
                $response = new Response(
                        $content, 200, array(
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="' . $file_name . '"'
                        )
                );
                break;
            case 'pdf':
                $content = $this->renderView('ESERVMAINHelpersBundle:Print:data_table_print.html.twig', array(
                    'column_titles' => json_decode($temp_arr['headers']),
                    'data' => $result,
                    'header_text' => $temp_arr['headerText'],
                    'extra_details' => true
                ));

                $response = new Response(
                        $this->get('knp_snappy.pdf')->getOutputFromHtml($content), 200, array(
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="' . $file_name . '"'
                        )
                );
                break;
        }


        return $response;
    }

}
