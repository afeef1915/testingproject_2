<?php

namespace ESERV\HelpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\DataTables;
use Symfony\Component\HttpFoundation\Request;


class WikiDataTableController extends Controller
{

    public $my_datatable_columns;
    public $my_datatable_id = 'eserv_my_table';
    
    public function __construct()
    {
        $this->my_datatable_columns = array(
            'id' => array(
                'id',
                'options' => array(
                    'header' => 'ID',
                    'visible' => false
                )
            ),
            'username' => array(
                'username',
                'options' => array(
                    'header' => 'Username',
                    'sortable' => false
                )
            ),
            'email' => array(
                'email',
                'options' => array(
                    'header' => 'Email',                    
                )
            ),
            'lastLogin' => array(
                'lastLogin',
                'col_type' => 'date',
                'date_format' => 'd-m-Y',
                'options' => array(
                    'header' => 'Last Login',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
        );
    }
    
    
    public function myDataTableListAction() 
    {   
        $my_dt_columns = DataTables::formatDataTablesColumnsArray($this->my_datatable_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->my_datatable_id, array(
            'columns' => $my_dt_columns,
            'source_url' => $this->container->get('router')->generate('wiki_my_datatable_data'),
            
        ));
        return $this->render('ESERVHelpBundle:Wiki:datatable.html.twig', array(
                    'dataTable' => $dataTable,
        ));
    }
    
    public function myDataTableDataAction(Request $request) 
    {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\HelpBundle\Services\ESERVHelpBundleWikiServices',
                    'function_name' => 'ListUsers',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'id',
            'columns' => $this->my_datatable_columns,
            'table_id' => $this->my_datatable_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->my_datatable_id
        ));

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

}
