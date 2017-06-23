<?php

namespace ESERV\MAIN\MediaBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use ESERV\MAIN\Services\AppConstants;

class HelperServices extends Controller {

    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c = null) {
        $this->em = $em;
        $this->c = $c;
        if (!is_null($c)) {
            $this->coreF = $this->c->get('core_function_services');
            $this->dbCore = $this->c->get('db_core_function_services');
        } else {
            $this->coreF = null;
            $this->dbCore = null;
        }
    }

    public function convert($convert_to, $data_array = array(), $col_names = array()) {
        switch ($convert_to) {
            case 'csv' : return $this->array_2_csv($data_array, $col_names);
            case 'pdf' : break;
            default : break;
        }
    }

    function array_2_csv($data_array, $col_names = array()) {
        $csv = array();

        foreach ($data_array as $item) {
            if (is_array($item)) {
                $csv[] = "\r" . $this->array_2_csv($item);
            } else {
                if (!is_object($item)) {
                    $csv[] = '"' . $item . '"';
                } else {
                    if ($item instanceof \DateTime) {
                        $csv[] = '"' . $item->format('d/m/Y') . '"';
                    }
                }
            }
        }
        if(count($col_names) > 0){
            $new_arr = array_merge($col_names, $csv);
        }else {
            $new_arr = $csv;
        }

        return implode(',', $new_arr);
    }

    function convertArrayOrObject2Csv($objectOrArray = array()) {
        $dataRows = Array();
        if (is_object($objectOrArray)) {
            $array = $objectOrArray->toArray(); //TO DO: convert entity/array of entities/object/ to array
        } else if (is_array($objectOrArray)) {
            $array = $objectOrArray;
        }
        $colNames = array_keys($array[0]);
        foreach ($array as $key => $val) {
            $dataRows[] = array_values($val);
        }
        return $this->array_2_csv($dataRows, $colNames);
    }

    function convertArrayToCsvContent($array = array(), $columnHeader = true) {
        $dataRows = Array();
        $colNames = $columnHeader ? array_keys($array[0]) : array();
        foreach ($array as $key => $val) {
            $dataRows[] = array_values($val);
        }
        return $this->array_2_csv($dataRows, $colNames);
    }

    function exportArrayToCSV($array, $qdb_array, $qdb_process_vars, $extra_params = array()) {
        $status = false;
        $message = '';
        $url = null;

        try {
            $download_record_limit = $this->c->getParameter('eserv_config')['export_download_record_count_limit'];
            $em = $this->em;
            $process_vars = array();

            if (count($array) > $download_record_limit) {
                $system_code_type = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCodeType')->findOneBy(
                        array('code' => AppConstants::SCT_NOTIFICATION_PRIORITY)
                );

                $code = ($qdb_array['notification_priority'] ? $qdb_array['notification_priority'] : AppConstants::SC_NOTIFICATION_PRIORITY_MEDIUM );
                $notif_pri = $em->getRepository('ESERV\MAIN\SystemConfigBundle\Entity\SystemCode')->findOneBy(
                        array('systemCodeType' => $system_code_type,
                            'code' => $code)
                );
                if ($notif_pri) {
                    $qdb_data = array(
                        'name' => $qdb_array['qdb_name'],
                        'description' => $qdb_array['qdb_description'],
                        'notif_priority' => $notif_pri,
                        'type' => $qdb_array['qdb_type']
                    );

                    if (is_array($qdb_process_vars)) {
                        foreach ($qdb_process_vars as $k => $v) {
                            $process_vars[$k] = array(
                                'value' => $v['value'],
                                'param_ext' => $v['param_ext'] ? $v['param_ext'] : 'PDO::PARAM_STR, -1',
                                'param_type' => $v['param_type'] ? $v['param_type'] : 1,
                                'param_size' => $v['param_size'] ? $v['param_size'] : -1
                            );
                        }
                    }

                    $ext_bun_serv = new \ESERV\MAIN\ExternalBundle\Services\ExternalBundleQueuedDbProcessService($em, $this->c);
                    $queued_db_process_id = $ext_bun_serv->createQueuedDbRecord($qdb_data, $process_vars);
                    if (!is_null($queued_db_process_id)) {
                        $em->getConnection()->commit();
                        $status = true;
                    }
                    $message = 'Extraction has been queued. You will receive a notification when the process is done';
                } else {
                    $message = 'Error occurred.';
                }
            } else if (count($array) > 0) {
                $col_names = array_keys($array[0]);
                $content = $this->convert('csv', $array, $col_names);

                $res = $this->coreF->createFile($content, array(
                    'file_name' => key_exists('file_name', $extra_params) ? $extra_params['file_name'] : rand(999, 999999),
                    'extension' => 'csv',
                    'folder_name' => key_exists('folder_name', $extra_params) ? $extra_params['folder_name'] : '_TEMP_'
                ));

                if (true === $res['success']) {
                    $status = true;
                    $url = $res['url'];
                    $message = 'File is downloading, please wait.';
                }
            }
        } catch (Exception $exc) {
            $status = false;
            $message = $exc->getMessage();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'url' => $url
        );

        return $result;
    }

    public function exportToPDF($content, $file_name) {
        return new \Symfony\Component\HttpFoundation\Response(
                $this->c->get('knp_snappy.pdf')->getOutputFromHtml($content), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $file_name . '.pdf"'
                )
        );
    }
    
    function exportRawSqlToCSV($rawSql, $extraParams = array()) {
        $status = false;
        $message = '';
        $url = null;

        try {
            $conn = $this->c->get('database_connection');
            $array = $conn->fetchAll($rawSql);
            $download_record_limit = $this->c->getParameter('eserv_config')['export_download_record_count_limit'];
            $em = $this->em;

            if (count($array) > $download_record_limit) {
                $system_code_type = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCodeType')->findOneBy(
                        array('code' => AppConstants::SCT_NOTIFICATION_PRIORITY)
                );

                $code = array_key_exists('notification_priority', $extraParams) ? $extraParams['notification_priority'] : AppConstants::SC_NOTIFICATION_PRIORITY_MEDIUM;
                $notif_pri = $em->getRepository('ESERV\MAIN\SystemConfigBundle\Entity\SystemCode')->findOneBy(array(
                    'systemCodeType' => $system_code_type,
                    'code' => $code)
                );
                if ($notif_pri) {
                    $qdb_data = array(
                        'name' => array_key_exists('qdb_name', $extraParams) ? $extraParams['qdb_name'] : 'File to download',
                        'description' => array_key_exists('qdb_description', $extraParams) ? $extraParams['qdb_description'] : 'This is a file to download',
                        'notif_priority' => $notif_pri,
                        'type' => \EServices\Services\EservicesConstants::ESERVICES_QUEUED_DB_PROCESS_TYPE_EXPORT_RAW_SQL,
                    );
                    
                    $userData = array(
                        'raw_sql' => $rawSql,
                        'file_name' => key_exists('file_name', $extraParams) ? utf8_encode($extraParams['file_name']) : rand(999, 999999)
                    );
                    
                    $qdb_process_vars = array(
                        'raw_sql_and_file_info' => array(
                            'value' => json_encode($userData),
                            'param_ext' => 'PDO::PARAM_STR, -1',
                            'param_type' => 1,
                            'param_size' => -1
                        )                        
                    );                    

                    $ext_bun_serv = new \ESERV\MAIN\ExternalBundle\Services\ExternalBundleQueuedDbProcessService($em, $this->c);
                    $queued_db_process_id = $ext_bun_serv->createQueuedDbRecord($qdb_data, $qdb_process_vars);
                    if (!is_null($queued_db_process_id)) {
                        $em->getConnection()->commit();
                        $status = true;
                    }
                    $message = 'Extraction has been queued. You will receive a notification when the process is done';
                } else {
                    $message = 'Error occurred: Notification priority is not set.';
                }
            } else if (count($array) > 0) {
                $col_names = array_keys($array[0]);
                $content = $this->convert('csv', $array, $col_names);

                $res = $this->coreF->createFile($content, array(
                    'file_name' => key_exists('file_name', $extraParams) ? $extraParams['file_name'] : rand(999, 999999),
                    'extension' => 'csv',
                    'folder_name' => key_exists('folder_name', $extraParams) ? $extraParams['folder_name'] : '_TEMP_',
                    'full_host' => key_exists('full_host', $extraParams) ? $extraParams['full_host'] == true ? true : false : false,
                ));

                if (true === $res['success']) {
                    $status = true;
                    $url = $res['url'];
                    $message = 'File is downloading, please wait.';
                }
            } else if (count($array) < 1) {
                $status = false;
                $message = 'No Record Found.';
            }
        } catch (Exception $exc) {
            $status = false;
            $message = $exc->getMessage();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'url' => $url
        );

        return $result;
    }

}
