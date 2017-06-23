<?php

namespace ESERV\MAIN\HistoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HistoryController extends Controller
{

    public $fieldHistory_columns;
    public $fieldHistory_table_id = 'eserv_field_history_table';
    public $fieldHistory_filters;
    
    public function __construct()
    {
        $this->fieldHistory_columns = array(
            'createdAt' => array(
                'createdAt',
                'col_type' => 'date',
                'options' => array(
                    'col_name' => 'createdAt',
                    'header' => 'Changed Date',
                    'width' => '100px',
                )
            ),
            'oldValue' => array(
                'oldValue',
                'options' => array(
                    'col_name' => 'oldValue',
                    'header' => 'Old Value',
                )
            ),
            'newValue' => array(
                'newValue',
                'options' => array(
                    'col_name' => 'newValue',
                    'header' => 'New Value',
                )
            ),
            'reason' => array(
                'reason',
                'options' => array(
                    'col_name' => 'reason',
                    'header' => 'Reason',
                )
            ),
            'createdByName' => array(
                'createdByName',
                'options' => array(
                    'col_name' => 'createdByName',
                    'header' => 'Changed By',
                )
            ),
            'createdByEmail' => array(
                'createdByEmail',
                'options' => array(
                    'col_name' => 'createdByEmail',
                    'header' => 'Changed By Email',
                )
            ),
        );
    }
    
    public function dataFieldHistoryAction(Request $request) {
        $entityName = $request->get('entity_name');
        $fieldName = $request->get('field_name');
        $entityId = $request->get('entity_id');
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\HistoryBundle\Services\HistoryServices',
                    'function_name' => 'getFieldHistory',
                    'function_params' => array(
                        'entity_id' => $entityId,
                        'entity_name' => $entityName,
                        'field_name' => $fieldName
                    )
                )
            ),
            'index_col' => 'id',
            'columns' => $this->fieldHistory_columns,
            'table_id' => $this->fieldHistory_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }
    
    public function listFieldHistoryAction(Request $request) {
        $entityName = $request->get('entity_name');
        $fieldName = $request->get('field_name');
        $entityId = $request->get('entity_id');
        $dataTableFieldHistory = $this->container->get('datatables_services')->DrawTable($this->fieldHistory_table_id, array(
            'columns' => $this->fieldHistory_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_history_ajax_list', array(                        
                        'entity_name' => $entityName,
                        'field_name' => $fieldName,
                        'entity_id' => $entityId,
                )),
            'initial_sorting_column' => array(
                'column' => 0,
                'direction' => 'desc'
            ),
        ));

        return $this->render('ESERVMAINHistoryBundle:Default:index.html.twig', array(
                    'entity_name' => $entityName,
                    'table_id' => $this->fieldHistory_table_id,
                    'dataTable' => $dataTableFieldHistory,
        ));
    }

}
