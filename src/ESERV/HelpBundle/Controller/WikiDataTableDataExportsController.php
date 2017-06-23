<?php

namespace ESERV\HelpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\DataTables;
use Symfony\Component\HttpFoundation\Request;


class WikiDataTableDataExportsController extends Controller
{

    public $my_datatable_columns;
    public $my_datatable_id = 'eserv_my_table';
    public $my_datatable_filters;
    
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
            'firstName' => array(
                'firstName',
                'options' => array(
                    'header' => 'Forename(s)',
                    'sortable' => false
                )
            ),
            'lastName' => array(
                'lastName',
                'options' => array(
                    'header' => 'Surname',                    
                )
            ),
            'dateOfBirth' => array(
                'dateOfBirth',
                'col_type' => 'date',
                'date_format' => 'd-m-Y',
                'options' => array(
                    'header' => 'Date of Birth',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),            
        );
        
        $this->my_datatable_filters = array(
            'type' => 'tabs',
            'tabs' => array(
                array(
                    'id' => 'personal_details',
                    'header' => 'Personal Details',
                    'fields' => array(
                        'firstName' => 'Forename(s)',
                        'lastName' => 'Surname',                        
                        'dateOfBirth' => array(
                            'label' => 'Date of Birth',
                            'widget' => array(
                                'type' => 'date_from_to',
                                'date_fields' => array(
                                    'from_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'yearrange' => '+2:+4',
                                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                                            )
                                        )
                                    ),
                                    'to_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'yearrange' => '-100:-16',
                                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                                            )
                                        )
                                    )
                                ),
                            )
                        ),
                    )
                ),
                
            )
        );
        
    }
    
    
    public function myDataTableDataExportsListAction() 
    {   
        $my_dt_columns = DataTables::formatDataTablesColumnsArray($this->my_datatable_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->my_datatable_id, array(
            'columns' => $my_dt_columns,
            'source_url' => $this->container->get('router')->generate('wiki_my_datatable_filters_data'),
            'filtering' => $this->my_datatable_filters,
            'output_options' => array(
                'export_buttons' => array(
                    'pdf' => array(
                        'label' => '<i class="fa fa-file-pdf-o"></i> Export to PDF',
                        'title' => 'Test Title PDF',
                        'content' => 'Test Content',
                        'file_name' => 'test_file_name_pdf',
                        'extraClass' => ''
                    ),
                    'csv' => array(
                        'label' => '<i class="fa fa-file-excel-o"></i> Export to CSV',
                        'title' => 'Test Title CSV', //title of the pdf as well as the name field of queued db process
                        'file_name' => 'test_file_name_csv',
                        'extraClass' => ''
                    )
                )
            ),
            
        ));
        return $this->render('ESERVHelpBundle:Wiki:datatable.html.twig', array(
                    'dataTable' => $dataTable,
        ));
    }
    
    public function myDataTableDataExportsDataAction(Request $request) 
    {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\HelpBundle\Services\ESERVHelpBundleWikiServices',
                    'function_name' => 'ListPersons',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'id',
            'columns' => $this->my_datatable_columns,
            'filtering' => $this->my_datatable_filters,
            'table_id' => $this->my_datatable_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->my_datatable_id
        ));

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

}
