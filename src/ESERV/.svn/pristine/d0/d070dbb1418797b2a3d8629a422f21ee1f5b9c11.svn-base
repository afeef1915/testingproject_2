<?php

namespace ESERV\MAIN\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use DateTime;

class DataTables extends Controller {

    protected $em;
    protected $c;
    protected $table_filters = false;
    protected $query_params = array();
    protected $queryParamsIdx = 0;
    public $increment_id = 0;
    public $detailsButtonsArray = array();
    public $coreFunction;
    public $dataTableConfig;

    public function __construct(EntityManager $entity_manager, Container $container = null) {
        $this->em = $entity_manager;
        $this->c = $container;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dataTableConfig = $this->c->hasParameter('data_table_config') ? $this->c->getParameter('data_table_config') : false;
        $this->detailsButtonsArray = array(
            'details_btn',
            'details_btn1',
            'details_btn2',
            'details_btn3',
            'details_btn4',
            'details_btn5',
        );
    }

    /**
     * This method is fetch data from the db and send it back to datatables.
     */
    public function getDataTablesList(Request $request, $data = array(), $params = array(), $extra_options = array()) {

        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array();
        $dataCols = array();
        $headerNames = array();
        $tableId = array_key_exists('table_id', $data) ? $data['table_id'] : false;
        $extra_options['table_id'] = $tableId;

        $sql_error = false;

        $sEcho = $request->get('sEcho');
        $details_links = $this->detailsButtonsArray;

        try {

            foreach ($data['columns'] as $key => $value) {
                if (is_array($value)) {
                    if (!in_array($key, $details_links)) {
                        $aColumns[] = $value[0];
                        $dataCols[] = $value[0];
                    } else {
                        $dataCols[$key] = $value;
                    }
                    $headerNames[] = (isset($value['options']) ? ($value['options']['header'] ? $value['options']['header'] : 'N/A') : 'N/A');
                } else {
                    if (!in_array($key, $details_links) && !in_array($value, $details_links)) {
                        $aColumns[] = $value;
                        $dataCols[] = $value;
                    } else {
                        $dataCols[$key] = $value;
                    }
                    $headerNames[] = $value;
                }
            }

            $alias = 'al';
            $order_arr = array();
            $limit = null;

            /* DB table to use */
            if (isset($data['table'])) {
                $sTable = $data['table'];
                if (!is_array($sTable)) {

                    $Result = $this->em->createQueryBuilder()
                            ->select($alias)
                            ->from($sTable, $alias);
                    $CountTotalResult = $this->em1->createQueryBuilder()
                            ->select($alias)
                            ->from($sTable, $alias);
                    $CountFilteredResults = $this->em1->createQueryBuilder()
                            ->select($alias)
                            ->from($sTable, $alias);
                } else {
                    if (isset($sTable['type'])) {
                        switch ($sTable['type']) {
                            case 'service':
                                if (isset($sTable['details'])) {
                                    if (isset($sTable['details']['name'])) {
                                        $service = $sTable['details']['name'];
                                        $function = $sTable['details']['function_name'];

                                        $function_params = isset($sTable['details']['function_params']) ? $sTable['details']['function_params'] : false;

                                        $b = new $service($this->em, $this->c);

                                        if ($function_params) {
                                            if (!is_array($function_params)) {
                                                $error = 'Function params must be of type array!';
                                                $this->showTableError($sEcho, $error);
                                            } else {
                                                if (count($function_params) === 1) {
                                                    $param_value = array_values($function_params)[0];
                                                    $Result = $b->$function($param_value, 'doctrine', $alias, true);
                                                    $CountTotalResult = $b->$function($param_value, 'doctrine', $alias, true);
                                                    $CountFilteredResults = $b->$function($param_value, 'doctrine', $alias, true);
                                                } else {
                                                    $Result = $b->$function($function_params, 'doctrine', $alias, true);
                                                    $CountTotalResult = $b->$function($function_params, 'doctrine', $alias, true);
                                                    $CountFilteredResults = $b->$function($function_params, 'doctrine', $alias, true);
                                                }
                                            }
                                        } else {
                                            $Result = $b->$function('doctrine', $alias, true);
                                            $CountTotalResult = $b->$function('doctrine', $alias, true);
                                            $CountFilteredResults = $b->$function('doctrine', $alias, true);
                                        }
                                    } else {
                                        $error = 'Service name must be set!';
                                        $this->showTableError($sEcho, $error);
                                    }
                                } else {
                                    $error = 'Service details must be set!';
                                    $this->showTableError($sEcho, $error);
                                }
                                break;
                            default:
                                break;
                        }
                    } else {
                        $error = 'Table type must be set!';
                        $this->showTableError($sEcho, $error);
                    }
                }
                /*
                 * Paging
                 */
                $iDisplayStart = $request->get('iDisplayStart');
                $iDisplayLength = $request->get('iDisplayLength');

                if (isset($iDisplayStart) && $iDisplayLength != '-1') {
                    $limit = array(
                        'limit' => intval($iDisplayLength),
                        'offset' => intval($iDisplayStart)
                    );
                }


                /*
                 * Ordering
                 */
                $iSortCol_0 = $request->get('iSortCol_0');

                if (isset($iSortCol_0)) {
                    $iSortingCols = $request->get('iSortingCols');

                    $iSortCols = array();
                    $bSortables = array();
                    $sSortDirs = array();

                    for ($i = 0; $i < intval($iSortingCols); $i++) {

                        $iSortCols[$i] = intval($request->get('iSortCol_' . $i));
                        $bSortables[$i] = $request->get('bSortable_' . $iSortCols[$i]);
                        $sSortDirs[$i] = strtoupper($request->get('sSortDir_' . $i));

                        if ($bSortables[$i] == "true") {
                            $_item = array(
                                'column' => $aColumns[intval($iSortCols[$i])],
                                'direction' => ($sSortDirs[$i] === 'ASC' ? 'ASC' : 'DESC')
                            );
                            array_push($order_arr, $_item);
                        }
                    }
                }

                $all_cols_case_insensitive = false;
                $filterByNlsDateFormat = false;
                $CaseInsensitive = false;
                $include_sql_for_non_filter = false;
                if (is_array($this->dataTableConfig) && !empty($this->dataTableConfig)) {
                    if (array_key_exists('case_insensitive_search', $this->dataTableConfig)) {
                        $all_cols_case_insensitive = $this->dataTableConfig['case_insensitive_search'];
                    }
                    if (array_key_exists('filter_by_nls_date_format', $this->dataTableConfig)) {
                        $filterByNlsDateFormat = $this->dataTableConfig['filter_by_nls_date_format'] == true ? true : false;
                    }
                    if (array_key_exists('include_sql_for_non_filter', $this->dataTableConfig)) {
                        $include_sql_for_non_filter = $this->dataTableConfig['include_sql_for_non_filter'];
                    }
                }
                $all_cols_case_insensitive = ( isset($data['all_cols_case_insensitive']) ) ? $data['all_cols_case_insensitive'] : $all_cols_case_insensitive;
                if ($all_cols_case_insensitive) {
                    $CaseInsensitive = true;
                }

                /*
                 * Filtering
                 * NOTE this does not match the built-in DataTables filtering which does it
                 * word by word on any field. It's possible to do here, but concerned about efficiency
                 * on very large tables, and MySQL's regex functionality is very limited
                 */
                $sSearch = $request->get('sSearch');

                $cols_size = count($aColumns);

                if (isset($sSearch) && $sSearch != "") {
                    $or = $Result->expr()->orx();
                    $orCount = $CountFilteredResults->expr()->orx();

                    for ($i = 0; $i < $cols_size; $i++) {
                        $col_type = '';
                        if (isset($data['columns'][$dataCols[$i]]['col_type'])) {
                            $col_type = $data['columns'][$dataCols[$i]]['col_type'];
                        }
                        if ($col_type == 'date') {
                            $dateFormat = isset($data['columns'][$dataCols[$i]]['date_create_from_format']) ? $data['columns'][$dataCols[$i]]['date_create_from_format'] : 'd/m/Y';
//                            $dateValue = date('Y-m-d', strtotime($this->c->get('core_function_services')->changeDateFormat($sSearch, null, $dateFormat)));
                            $dateObj = DateTime::createFromFormat($dateFormat, $sSearch);
                            if ($dateObj instanceof \DateTime) {
                                if ($filterByNlsDateFormat) {
                                    $dateValue = $sSearch;
                                } else {
                                    $dateValue = $dateObj->format('Y-m-d');
                                }
                                $or->add($Result->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_"));
                                $Result->setParameter($aColumns[$i] . '_', "{$dateValue}%");

                                $orCount->add($CountFilteredResults->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_"));
                                $CountFilteredResults->setParameter($aColumns[$i] . '_', "{$dateValue}%");
                            } elseif (is_numeric($sSearch)) {
                                $or->add($Result->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_"));
                                $Result->setParameter($aColumns[$i] . '_', "%{$sSearch}%");

                                $orCount->add($CountFilteredResults->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_"));
                                $CountFilteredResults->setParameter($aColumns[$i] . '_', "%{$sSearch}%");
                            }
                            //TODO: search when month name in typed in filter
                        } else {
                            if ($CaseInsensitive) {
                                $insensitiveSearchValue = strtoupper($sSearch);

                                $or->add($Result->expr()->like("UPPER({$alias}.{$aColumns[$i]})", ":{$aColumns[$i]}_"));
                                $Result->setParameter($aColumns[$i] . '_', "%{$insensitiveSearchValue}%");

                                $orCount->add($CountFilteredResults->expr()->like("UPPER({$alias}.{$aColumns[$i]})", ":{$aColumns[$i]}_"));
                                $CountFilteredResults->setParameter($aColumns[$i] . '_', "%{$insensitiveSearchValue}%");
                            } else {
                                $or->add($Result->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_"));
                                $Result->setParameter($aColumns[$i] . '_', "%{$sSearch}%");

                                $orCount->add($CountFilteredResults->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_"));
                                $CountFilteredResults->setParameter($aColumns[$i] . '_', "%{$sSearch}%");
                            }
                        }
                    }
                }

                $col_starts_with = $request->get('col_starts_with', false);

                if ($col_starts_with) {
                    $col_starts_with_details = explode(',', $col_starts_with);

                    if (isset($col_starts_with_details[1]) && $col_starts_with_details[1] != '') {
                        $and = $Result->expr()->andx();
                        $andCount = $CountFilteredResults->expr()->andx();

                        $and->add($Result->expr()->like("{$alias}.{$col_starts_with_details[0]}", ":{$col_starts_with_details[0]}"));
                        $Result->setParameter($col_starts_with_details[0], "{$col_starts_with_details[1]}%");

                        $andCount->add($CountFilteredResults->expr()->like("{$alias}.{$col_starts_with_details[0]}", ":{$col_starts_with_details[0]}"));
                        $CountFilteredResults->setParameter($col_starts_with_details[0], "{$col_starts_with_details[1]}%");
                    }
                }

                $includeHistory = $request->get('includeHistory');
                if (!is_null($includeHistory) && $includeHistory != '') {
                    $historyToggleParams = (isset($data['history_toggle_params']) && is_array($data['history_toggle_params'])) ? $data['history_toggle_params'] : array();
                    $selectedToggleParams = (isset($historyToggleParams[$includeHistory]) && is_array($historyToggleParams[$includeHistory])) ? $historyToggleParams[$includeHistory] : array();
                    $colNameValue = (isset($selectedToggleParams['column_name_value']) && is_array($selectedToggleParams['column_name_value'])) ? $selectedToggleParams['column_name_value'] : array();

                    foreach ($colNameValue as $colName => $colValue) {
                        if (!isset($and)) {
                            $and = $Result->expr()->andx();
                            $andCount = $CountFilteredResults->expr()->andx();
                        }
                        if (strtoupper($colValue) == '!NULL' || strtoupper($colValue) == 'NOT NULL' || strtoupper($colValue) == 'IS NOT NULL') {
                            $and->add("{$alias}.{$colName} IS NOT NULL");
                            $andCount->add("{$alias}.{$colName} IS NOT NULL");
                        } else if (strtoupper($colValue) == 'NULL' || strtoupper($colValue) == 'IS NULL') {
                            $and->add("{$alias}.{$colName} IS NULL");
                            $andCount->add("{$alias}.{$colName} IS NULL");
                        } else {
                            $and->add("{$alias}.{$colName} {$colValue}");
                            $andCount->add("{$alias}.{$colName} {$colValue}");
                        }
                    }
                    $sqlCondition = isset($selectedToggleParams['sql_condition']) ? $selectedToggleParams['sql_condition'] : null;
                    if (!is_null($sqlCondition) && $sqlCondition != '') {
                        if (!isset($and)) {
                            $and = $Result->expr()->andx();
                            $andCount = $CountFilteredResults->expr()->andx();
                        }
                        $sqlCondition = str_replace('{alias}', $alias, $sqlCondition);
                        $and->add("{$sqlCondition}");
                        $andCount->add("{$sqlCondition}");
                    }
                    if (isset($selectedToggleParams['search_fields']) && is_array($selectedToggleParams['search_fields']) && !empty($selectedToggleParams['search_fields'])) {
                        $searchFields = $selectedToggleParams['search_fields'];
                        foreach ($searchFields as $sfVal) {
                            if (isset($sfVal['@attributes']['column']) && trim($sfVal['@attributes']['column']) != '') {
                                $colName = strtolower(trim($sfVal['@attributes']['column']));
                                if (isset($sfVal['Either']) && is_array($sfVal['Either']) && !empty($sfVal['Either'])) {
                                    $either = $sfVal['Either'];
                                    if (isset($either['Searchterm']) && is_array($either['Searchterm']) && !empty($either['Searchterm'])) {
                                        $eitherSearchTerm = array();
                                        if (isset($either['Searchterm']['@attributes'])) {
                                            $eitherSearchTerm[0] = $either['Searchterm'];
                                        } else {
                                            $eitherSearchTerm = $either['Searchterm'];
                                        }
                                        if (count($eitherSearchTerm) === 1) {
                                            if (isset($eitherSearchTerm[0]['@attributes']['operator']) && !empty(trim($eitherSearchTerm[0]['@attributes']['operator']))) {
                                                $operator = strtoupper(trim($eitherSearchTerm[0]['@attributes']['operator']));
                                                $ResultExp = $Result->expr()->andx();
                                                $CountFilteredResultsExp = $CountFilteredResults->expr()->andx();
                                                if (isset($eitherSearchTerm[0]['@attributes']['value'])) {
                                                    $colValue = $eitherSearchTerm[0]['@attributes']['value'];
                                                } else {
                                                    $colValue = false;
                                                }
                                                $addResult = $this->addDoctrineStatement($Result, $CountFilteredResults, $ResultExp, $CountFilteredResultsExp, $alias, $colName, $operator, $colValue);
                                                $Result = $addResult['result'];
                                                $CountFilteredResults = $addResult['filtered_result'];
                                            }
                                        } else {
                                            $ResultExp = $Result->expr()->orX();
                                            $CountFilteredResultsExp = $CountFilteredResults->expr()->orX();
                                            foreach ($eitherSearchTerm as $estKey => $estVal) {
                                                if (isset($estVal['@attributes']['operator']) && !empty(trim($estVal['@attributes']['operator']))) {
                                                    $operator = strtoupper(trim($estVal['@attributes']['operator']));
                                                    if (isset($estVal['@attributes']['value'])) {
                                                        $colValue = $estVal['@attributes']['value'];
                                                    } else {
                                                        $colValue = false;
                                                    }
                                                    $addResult = $this->addDoctrineStatement($Result, $CountFilteredResults, $ResultExp, $CountFilteredResultsExp, $alias, $colName, $operator, $colValue, false);
                                                    $Result = $addResult['result'];
                                                    $CountFilteredResults = $addResult['filtered_result'];
                                                    $ResultExp = $addResult['result_exp'];
                                                    $CountFilteredResultsExp = $addResult['filtered_result_exp'];
                                                }
                                            }
                                            $Result->andWhere($ResultExp);
                                            $CountFilteredResults->andWhere($CountFilteredResultsExp);
                                        }
                                    }
                                }
                                if (isset($sfVal['Searchterm']) && is_array($sfVal['Searchterm']) && !empty($sfVal['Searchterm'])) {
                                    $colSearchTerm = $sfVal['Searchterm'];
                                    if (isset($colSearchTerm['@attributes']['operator']) && !empty(trim($colSearchTerm['@attributes']['operator']))) {
                                        $operator = strtoupper(trim($colSearchTerm['@attributes']['operator']));
                                        $ResultExp = $Result->expr()->andx();
                                        $CountFilteredResultsExp = $CountFilteredResults->expr()->andx();
                                        if (isset($colSearchTerm['@attributes']['value'])) {
                                            $colValue = $colSearchTerm['@attributes']['value'];
                                        } else {
                                            $colValue = false;
                                        }
                                        $addResult = $this->addDoctrineStatement($Result, $CountFilteredResults, $ResultExp, $CountFilteredResultsExp, $alias, $colName, $operator, $colValue);
                                        $Result = $addResult['result'];
                                        $CountFilteredResults = $addResult['filtered_result'];
                                    }
                                }
                                if (isset($sfVal['Both']) && is_array($sfVal['Both']) && !empty($sfVal['Both'])) {
                                    $both = $sfVal['Both'];
                                    if (isset($both['Searchterm']) && is_array($both['Searchterm']) && !empty($both['Searchterm'])) {
                                        $bothSearchTerm = array();
                                        if (isset($both['Searchterm']['@attributes'])) {
                                            $bothSearchTerm[0] = $both['Searchterm'];
                                        } else {
                                            $bothSearchTerm = $both['Searchterm'];
                                        }
                                        foreach ($bothSearchTerm as $estKey => $estVal) {
                                            if (isset($estVal['@attributes']['operator']) && !empty(trim($estVal['@attributes']['operator']))) {
                                                $operator = strtoupper(trim($estVal['@attributes']['operator']));
                                                $ResultExp = $Result->expr()->andx();
                                                $CountFilteredResultsExp = $CountFilteredResults->expr()->andx();
                                                if (isset($colSearchTerm['@attributes']['value'])) {
                                                    $colValue = $colSearchTerm['@attributes']['value'];
                                                } else {
                                                    $colValue = false;
                                                }
                                                $addResult = $this->addDoctrineStatement($Result, $CountFilteredResults, $ResultExp, $CountFilteredResultsExp, $alias, $colName, $operator, $colValue = false);
                                                $Result = $addResult['result'];
                                                $CountFilteredResults = $addResult['filtered_result'];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $col_filters = (isset($data['filtering']) && is_array($data['filtering'])) ? $data['filtering'] : false;
                /* Individual column filtering */
                $bSearchables = array();
                $sSearchs = array();

                $av_filters = $this->getAllAvailableFilters($sEcho, array(
                    'request' => $request,
                    'aColumns' => $aColumns,
                    'col_filters' => $col_filters,
                ));

                $all_filters = $av_filters['all_filters'];

                for ($i = 0; $i < $cols_size; $i++) {
                    $bSearchables[$i] = $request->get('bSearchable_' . $i);
                    $sSearchs[$i] = trim($request->get('sSearch_' . $i));
                    $uppersSearch = strtoupper($sSearchs[$i]);
                    $hasFilterField = false;

                    switch ($uppersSearch) {
                        case 'IS NULL' :
                            if (!isset($and)) {
                                $and = $Result->expr()->andx();
                                $andCount = $CountFilteredResults->expr()->andx();
                            }
                            $and->add($Result->expr()->isNull("{$alias}.{$aColumns[$i]}"));
                            $andCount->add($CountFilteredResults->expr()->isNull("{$alias}.{$aColumns[$i]}"));
                            break;
                        case 'IS NOT NULL' :
                            if (!isset($and)) {
                                $and = $Result->expr()->andx();
                                $andCount = $CountFilteredResults->expr()->andx();
                            }
                            $and->add($Result->expr()->isNotNull("{$alias}.{$aColumns[$i]}"));
                            $andCount->add($CountFilteredResults->expr()->isNotNull("{$alias}.{$aColumns[$i]}"));
                            break;
                        default :
                            if (isset($bSearchables[$i]) && $bSearchables[$i] == "true" && $sSearchs[$i] != '') {
                                if (isset($col_filters['tabs'])) {
                                    foreach ($col_filters['tabs'] as $t_k => $t_v) {
                                        if (isset($t_v['fields'])) {
                                            if (isset($t_v['fields'][$aColumns[$i]])) {
                                                if (is_array($all_filters) && array_key_exists($aColumns[$i], $all_filters)) {
                                                    $hasFilterField = true;

                                                    $thisFilter = $all_filters[$aColumns[$i]];

                                                    $Widget = (is_array($thisFilter) && array_key_exists('widget', $thisFilter)) ? $thisFilter['widget'] : false;
                                                    $ExactMatch = (is_array($thisFilter) && array_key_exists('exact_match', $thisFilter)) ? $thisFilter['exact_match'] : false;
                                                    $mtlWordTranslate = (is_array($thisFilter) && array_key_exists('mtl_word_translate', $thisFilter)) ? $thisFilter['mtl_word_translate'] : false;

                                                    if ($all_cols_case_insensitive) {
                                                        $CaseInsensitive = true;
                                                    } else {
                                                        $CaseInsensitive = (is_array($thisFilter) && array_key_exists('case_insensitive', $thisFilter)) ? $thisFilter['case_insensitive'] : $all_cols_case_insensitive;
                                                    }
                                                    $tableTabId = ($tableId ? md5($tableId) . '_' : '') . $t_v['id'];

                                                    if ($Widget) {
                                                        switch ($Widget['type']) {
                                                            case 'exists' :
                                                                if ($Widget['query'] instanceof \Doctrine\ORM\QueryBuilder) {
                                                                    if (!isset($and)) {
                                                                        $and = $Result->expr()->andx();
                                                                        $andCount = $CountFilteredResults->expr()->andx();
                                                                    }
                                                                    $and->add($Result->expr()->exists("{$Widget['query']}"));
                                                                    $andCount->add($CountFilteredResults->expr()->exists("{$Widget['query']}"));

                                                                    //binding parameters to the main query if there are any parameters
                                                                    if ($Widget['query']->getParameters()) {
                                                                        foreach ($Widget['query']->getParameters() as $index => $param) {
                                                                            $subDqlStrReplace = str_replace('_VAL_', $sSearchs[$i], $param->getValue());
                                                                            $Result->setParameter($param->getName(), $subDqlStrReplace);
                                                                            $CountFilteredResults->setParameter($param->getName(), $subDqlStrReplace);
                                                                        }
                                                                    }
                                                                }
                                                                break;
                                                            case 'autocomplete_array' :
                                                                $explodedValues = explode(',', $sSearchs[$i]);
                                                                $includedStatement = false;
                                                                $includeNullStatement = false;
                                                                foreach ($explodedValues as $evKey => $evValue) {
                                                                    if ('IS NULL' == strtoupper(trim($evValue))) {
                                                                        $includeNullStatement = 'IS NULL';
                                                                        unset($explodedValues[$evKey]);
                                                                    } elseif ('IS NOT NULL' == strtoupper(trim($evValue))) {
                                                                        $includeNullStatement = 'IS NOT NULL';
                                                                        unset($explodedValues[$evKey]);
                                                                    }
                                                                }
                                                                if ($includeNullStatement == 'IS NULL') {
                                                                    $includedStatement = true;
                                                                    if (!empty($explodedValues)) {
                                                                        $Result->andWhere($Result->expr()->orX($Result->expr()->isNull("{$alias}.{$aColumns[$i]}"), $Result->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}")));
                                                                        $Result->setParameter($aColumns[$i], $explodedValues);

                                                                        $CountFilteredResults->andWhere($CountFilteredResults->expr()->orX($CountFilteredResults->expr()->isNull("{$alias}.{$aColumns[$i]}"), $CountFilteredResults->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}")));
                                                                        $CountFilteredResults->setParameter($aColumns[$i], $explodedValues);
                                                                    } else {
                                                                        $Result->orWhere($Result->expr()->isNull("{$alias}.{$aColumns[$i]}"));
                                                                        $CountFilteredResults->orWhere($CountFilteredResults->expr()->isNull("{$alias}.{$aColumns[$i]}"));
                                                                    }
                                                                } else {
                                                                    if ($includeNullStatement == 'IS NOT NULL') {
                                                                        $includedStatement = true;
                                                                        if (!empty($explodedValues)) {
                                                                            $Result->andWhere($Result->expr()->orX($Result->expr()->isNotNull("{$alias}.{$aColumns[$i]}"), $Result->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}")));
                                                                            $Result->setParameter($aColumns[$i], $explodedValues);

                                                                            $CountFilteredResults->andWhere($CountFilteredResults->expr()->orX($CountFilteredResults->expr()->isNotNull("{$alias}.{$aColumns[$i]}"), $CountFilteredResults->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}")));
                                                                            $CountFilteredResults->setParameter($aColumns[$i], $explodedValues);
                                                                        } else {
                                                                            $Result->andWhere($Result->expr()->isNotNull("{$alias}.{$aColumns[$i]}"));
                                                                            $CountFilteredResults->andWhere($CountFilteredResults->expr()->isNotNull("{$alias}.{$aColumns[$i]}"));
                                                                        }
                                                                    }
                                                                }
                                                                if (!empty($explodedValues) && !$includedStatement) {
                                                                    $Result->andWhere($Result->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                    $Result->setParameter($aColumns[$i], $explodedValues);

                                                                    $CountFilteredResults->andWhere($CountFilteredResults->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                    $CountFilteredResults->setParameter($aColumns[$i], $explodedValues);
                                                                }
                                                                break;
                                                            case 'autocomplete_ajax' :
                                                                $explodedValues = explode(',', $sSearchs[$i]);
                                                                $includedStatement = false;
                                                                $includeNullStatement = false;
                                                                foreach ($explodedValues as $evKey => $evValue) {
                                                                    if ('IS NULL' == strtoupper(trim($evValue))) {
                                                                        $includeNullStatement = 'IS NULL';
                                                                        unset($explodedValues[$evKey]);
                                                                    } elseif ('IS NOT NULL' == strtoupper(trim($evValue))) {
                                                                        $includeNullStatement = 'IS NOT NULL';
                                                                        unset($explodedValues[$evKey]);
                                                                    }
                                                                }
                                                                if ($includeNullStatement == 'IS NULL') {
                                                                    $includedStatement = true;
                                                                    if (!empty($explodedValues)) {
                                                                        $Result->andWhere($Result->expr()->orX($Result->expr()->isNull("{$alias}.{$aColumns[$i]}"), $Result->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}")));
                                                                        $Result->setParameter($aColumns[$i], $explodedValues);

                                                                        $CountFilteredResults->andWhere($CountFilteredResults->expr()->orX($CountFilteredResults->expr()->isNull("{$alias}.{$aColumns[$i]}"), $CountFilteredResults->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}")));
                                                                        $CountFilteredResults->setParameter($aColumns[$i], $explodedValues);
                                                                    } else {
                                                                        $Result->orWhere($Result->expr()->isNull("{$alias}.{$aColumns[$i]}"));
                                                                        $CountFilteredResults->orWhere($CountFilteredResults->expr()->isNull("{$alias}.{$aColumns[$i]}"));
                                                                    }
                                                                } else {
                                                                    if ($includeNullStatement == 'IS NOT NULL') {
                                                                        $includedStatement = true;
                                                                        if (!empty($explodedValues)) {
                                                                            $Result->andWhere($Result->expr()->orX($Result->expr()->isNotNull("{$alias}.{$aColumns[$i]}"), $Result->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}")));
                                                                            $Result->setParameter($aColumns[$i], $explodedValues);

                                                                            $CountFilteredResults->andWhere($CountFilteredResults->expr()->orX($CountFilteredResults->expr()->isNotNull("{$alias}.{$aColumns[$i]}"), $CountFilteredResults->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}")));
                                                                            $CountFilteredResults->setParameter($aColumns[$i], $explodedValues);
                                                                        } else {
                                                                            $Result->andWhere($Result->expr()->isNotNull("{$alias}.{$aColumns[$i]}"));
                                                                            $CountFilteredResults->andWhere($CountFilteredResults->expr()->isNotNull("{$alias}.{$aColumns[$i]}"));
                                                                        }
                                                                    }
                                                                }
                                                                if (!empty($explodedValues) && !$includedStatement) {
                                                                    $Result->andWhere($Result->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                    $Result->setParameter($aColumns[$i], $explodedValues);

                                                                    $CountFilteredResults->andWhere($CountFilteredResults->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                    $CountFilteredResults->setParameter($aColumns[$i], $explodedValues);
                                                                }
                                                                break;
                                                            case 'autocomplete_ajax_single' :
                                                                $from_field_value = $request->get($tableTabId . '_' . $aColumns[$i], '');
                                                                #echo $t_v['id'] . '_' . $aColumns[$i]; die;
                                                                if (!isset($and)) {
                                                                    $and = $Result->expr()->andx();
                                                                    $andCount = $CountFilteredResults->expr()->andx();
                                                                }
                                                                $and->add($Result->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                $Result->setParameter($aColumns[$i], $from_field_value);

                                                                $andCount->add($CountFilteredResults->expr()->in("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                $CountFilteredResults->setParameter($aColumns[$i], $from_field_value);
                                                                break;
                                                            case 'dropdown' :
                                                                if (!isset($and)) {
                                                                    $and = $Result->expr()->andx();
                                                                    $andCount = $CountFilteredResults->expr()->andx();
                                                                }
                                                                $and->add($Result->expr()->eq("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                $Result->setParameter($aColumns[$i], explode(',', $sSearchs[$i]));

                                                                $andCount->add($CountFilteredResults->expr()->eq("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                $CountFilteredResults->setParameter($aColumns[$i], explode(',', $sSearchs[$i]));
                                                                break;
                                                            case 'dropdown_for_null' :
                                                                if (!isset($and)) {
                                                                    $and = $Result->expr()->andx();
                                                                    $andCount = $CountFilteredResults->expr()->andx();
                                                                }
                                                                if ($sSearchs[$i] == 'Y') {
                                                                    $and->add('1 = :A');
                                                                    $Result->setParameter('A', '1');

                                                                    $andCount->add('1 = :A');
                                                                    $CountFilteredResults->setParameter('A', '1');
                                                                } else {
                                                                    $and->add($Result->expr()->isNull("{$alias}.{$aColumns[$i]}"));
                                                                    $andCount->add($CountFilteredResults->expr()->isNull("{$alias}.{$aColumns[$i]}"));
                                                                }
                                                                break;
                                                            case 'date_from_to' :
                                                                $from_field_value = $request->get($tableTabId . '_' . $aColumns[$i] . '_from_field', '');
                                                                $to_field_value = $request->get($tableTabId . '_' . $aColumns[$i] . '_to_field', '');
                                                                $range_checkbox = $request->get($tableTabId . '_' . $aColumns[$i] . '_range_chkbox');

                                                                if ($range_checkbox == 'true') {
                                                                    if (!empty($from_field_value) || !empty($to_field_value)) {
                                                                        if (!isset($and)) {
                                                                            $and = $Result->expr()->andx();
                                                                            $andCount = $CountFilteredResults->expr()->andx();
                                                                        }

                                                                        if (!empty($from_field_value)) {
                                                                            $dateFormat = isset($thisFilter['widget']['date_fields']['from_field']['eserv_extra_validation']['date']['date_create_from_format']) ? $thisFilter['widget']['date_fields']['from_field']['eserv_extra_validation']['date']['date_create_from_format'] : 'd/m/Y';
                                                                            $dateObj = DateTime::createFromFormat($dateFormat, $from_field_value);
                                                                            if ($dateObj instanceof \DateTime) {
                                                                                //$from_field_value = date('Y-m-d', strtotime($this->c->get('core_function_services')->changeDateFormat($from_field_value, null, $dateFormat)));
                                                                                if (!$filterByNlsDateFormat) {
                                                                                    $from_field_value = $dateObj->format('Y-m-d');
                                                                                }
                                                                                $and->add($Result->expr()->gte("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_fromVal"));
                                                                                $Result->setParameter("{$aColumns[$i]}_fromVal", $from_field_value);

                                                                                $andCount->add($CountFilteredResults->expr()->gte("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_fromVal"));
                                                                                $CountFilteredResults->setParameter("{$aColumns[$i]}_fromVal", $from_field_value);
                                                                            }
                                                                        }

                                                                        if (!empty($to_field_value)) {
                                                                            $dateFormat = isset($thisFilter['widget']['date_fields']['to_field']['eserv_extra_validation']['date']['date_create_from_format']) ? $thisFilter['widget']['date_fields']['to_field']['eserv_extra_validation']['date']['date_create_from_format'] : 'd/m/Y';
                                                                            $dateObj = DateTime::createFromFormat($dateFormat, $to_field_value);
                                                                            if ($dateObj instanceof \DateTime) {
                                                                                //$to_field_value = date('Y-m-d', strtotime($this->c->get('core_function_services')->changeDateFormat($to_field_value, null, $dateFormat)));
                                                                                if (!$filterByNlsDateFormat) {
                                                                                    $to_field_value = $dateObj->format('Y-m-d');
                                                                                } else {
                                                                                    $to_field_value = $to_field_value . ' 23:59:59';
                                                                                }
                                                                                $and->add($Result->expr()->lte("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_toVal"));
                                                                                $Result->setParameter("{$aColumns[$i]}_toVal", $to_field_value);

                                                                                $andCount->add($CountFilteredResults->expr()->lte("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_toVal"));
                                                                                $CountFilteredResults->setParameter("{$aColumns[$i]}_toVal", $to_field_value);
                                                                            }
                                                                        }
                                                                    }
                                                                } else {
                                                                    if (!empty($from_field_value)) {
                                                                        if (!isset($and)) {
                                                                            $and = $Result->expr()->andx();
                                                                            $andCount = $CountFilteredResults->expr()->andx();
                                                                        }
                                                                        $dateFormat = isset($thisFilter['widget']['date_fields']['from_field']['eserv_extra_validation']['date']['date_create_from_format']) ? $thisFilter['widget']['date_fields']['from_field']['eserv_extra_validation']['date']['date_create_from_format'] : 'd/m/Y';
                                                                        $dateObj = DateTime::createFromFormat($dateFormat, $from_field_value);
                                                                        if ($dateObj instanceof \DateTime) {
                                                                            //$from_field_value = date('Y-m-d', strtotime($this->c->get('core_function_services')->changeDateFormat($from_field_value, null, $dateFormat)));
                                                                            if (!$filterByNlsDateFormat) {
                                                                                $from_field_value = $dateObj->format('Y-m-d');
                                                                            }
                                                                            $and->add($Result->expr()->eq("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_rangeChkboxVal"));
                                                                            $Result->setParameter("{$aColumns[$i]}_rangeChkboxVal", $from_field_value);

                                                                            $andCount->add($CountFilteredResults->expr()->eq("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_rangeChkboxVal"));
                                                                            $CountFilteredResults->setParameter("{$aColumns[$i]}_rangeChkboxVal", $from_field_value);
                                                                        }
                                                                    }
                                                                }
                                                                break;
                                                            case 'range_value' :
                                                                $from_field_value = $request->get($tableTabId . '_' . $aColumns[$i] . '_from_field', '');
                                                                $to_field_value = $request->get($tableTabId . '_' . $aColumns[$i] . '_to_field', '');
                                                                $range_checkbox = $request->get($tableTabId . '_' . $aColumns[$i] . '_range_chkbox');

                                                                if ($range_checkbox == 'true') {
                                                                    if (!empty($from_field_value) || !empty($to_field_value)) {
                                                                        if (!isset($and)) {
                                                                            $and = $Result->expr()->andx();
                                                                            $andCount = $CountFilteredResults->expr()->andx();
                                                                        }

                                                                        if (!empty($from_field_value)) {
                                                                            $and->add($Result->expr()->gte("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_fromVal"));
                                                                            $Result->setParameter("{$aColumns[$i]}_fromVal", $from_field_value);

                                                                            $andCount->add($CountFilteredResults->expr()->gte("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_fromVal"));
                                                                            $CountFilteredResults->setParameter("{$aColumns[$i]}_fromVal", $from_field_value);
                                                                        }

                                                                        if (!empty($to_field_value)) {
                                                                            $and->add($Result->expr()->lte("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_toVal"));
                                                                            $Result->setParameter("{$aColumns[$i]}_toVal", $to_field_value);

                                                                            $andCount->add($CountFilteredResults->expr()->lte("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_toVal"));
                                                                            $CountFilteredResults->setParameter("{$aColumns[$i]}_toVal", $to_field_value);
                                                                        }
                                                                    }
                                                                } else {
                                                                    if (!empty($from_field_value)) {
                                                                        if (!isset($and)) {
                                                                            $and = $Result->expr()->andx();
                                                                            $andCount = $CountFilteredResults->expr()->andx();
                                                                        }
                                                                        $and->add($Result->expr()->eq("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_rangeChkboxVal"));
                                                                        $Result->setParameter("{$aColumns[$i]}_rangeChkboxVal", $from_field_value);

                                                                        $andCount->add($CountFilteredResults->expr()->eq("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}_rangeChkboxVal"));
                                                                        $CountFilteredResults->setParameter("{$aColumns[$i]}_rangeChkboxVal", $from_field_value);
                                                                    }
                                                                }
                                                                break;
                                                            default:
                                                                if (!isset($and)) {
                                                                    $and = $Result->expr()->andx();
                                                                    $andCount = $CountFilteredResults->expr()->andx();
                                                                }
                                                                $and->add($Result->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                $Result->setParameter($aColumns[$i], "%{$sSearchs[$i]}%");

                                                                $andCount->add($CountFilteredResults->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                $CountFilteredResults->setParameter($aColumns[$i], "%{$sSearchs[$i]}%");
                                                                break;
                                                        }
                                                    } else {
                                                        if (!isset($and)) {
                                                            $and = $Result->expr()->andx();
                                                            $andCount = $CountFilteredResults->expr()->andx();
                                                        }

                                                        if ($ExactMatch) {
                                                            $and->add($Result->expr()->eq("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                            $Result->setParameter($aColumns[$i], "{$sSearchs[$i]}");

                                                            $andCount->add($CountFilteredResults->expr()->eq("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                            $CountFilteredResults->setParameter($aColumns[$i], "{$sSearchs[$i]}");
                                                        } else {

                                                            if ($CaseInsensitive) {
                                                                $insensitiveSearchValue = strtoupper($sSearchs[$i]);
                                                                $and->add($Result->expr()->like("UPPER({$alias}.{$aColumns[$i]})", ":{$aColumns[$i]}"));
                                                                $Result->setParameter($aColumns[$i], "%{$insensitiveSearchValue}%");

                                                                $andCount->add($CountFilteredResults->expr()->like("UPPER({$alias}.{$aColumns[$i]})", ":{$aColumns[$i]}"));
                                                                $CountFilteredResults->setParameter($aColumns[$i], "%{$insensitiveSearchValue}%");
                                                            } else {

                                                                $searchValue = $sSearchs[$i];
                                                                if ($mtlWordTranslate) {
                                                                    $searchValue = $this->c->get('db_core_function_services')->mtl_word_translate($sSearchs[$i]);
                                                                }
                                                                $and->add($Result->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                $Result->setParameter($aColumns[$i], "%{$searchValue}%");

                                                                $andCount->add($CountFilteredResults->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                                                $CountFilteredResults->setParameter($aColumns[$i], "%{$searchValue}%");
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($include_sql_for_non_filter && !$hasFilterField) {
                                    if (!isset($and)) {
                                        $and = $Result->expr()->andx();
                                        $andCount = $CountFilteredResults->expr()->andx();
                                    }
                                    $and->add($Result->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                    $Result->setParameter($aColumns[$i], "%{$sSearchs[$i]}%");

                                    $andCount->add($CountFilteredResults->expr()->like("{$alias}.{$aColumns[$i]}", ":{$aColumns[$i]}"));
                                    $CountFilteredResults->setParameter($aColumns[$i], "%{$sSearchs[$i]}%");
                                }
                            }
                    }
                }
                if (isset($or)) {
                    $Result->andWhere($or);
                    $CountFilteredResults->andWhere($orCount);
                }

                if (isset($and)) {
                    $Result->andWhere($and);
                    $CountFilteredResults->andWhere($andCount);
                }

                $Options = array();

                $iTotal = $this->c->get('db_core_function_services')->customOptions($CountTotalResult, $Options, $alias, false, $data['index_col']);
                $iFilteredTotal = $this->c->get('db_core_function_services')->customOptions($CountFilteredResults, $Options, $alias, false, $data['index_col']);

                if (!is_null($limit)) {
                    $Options['limit'] = $limit;
                }

                if (count($order_arr) > 0) {
                    $Options['orderBy'] = $order_arr;
                }

                $Options['sql_with_params'] = true;

                $full_sql = $this->c->get('db_core_function_services')->customOptions($Result, $Options, $alias, true);
                $rResult = $this->HydrateObjectToArray($full_sql['sql'], $full_sql['params'], array(
                    'dql' => $full_sql['dql']
                ));

                /*
                 * Output
                 */

                $output = array(
                    "sEcho" => intval($sEcho),
                    "iTotalRecords" => $iTotal,
                    "iTotalDisplayRecords" => $iFilteredTotal,
                    "aaData" => array()
                );

                // Testing..
                $dev_env = $this->c->get('core_function_services')->isDevEnvironment();
                if ($dev_env) {
                    $output['SQLQuery'] = $full_sql['sql'];
                }

                $sql_query_for_print = $Result
                        ->select($alias . '.' . $data['index_col'])
                        ->setMaxResults(null)
                        ->getQuery()
                        ->getSql();

                $dql_query_for_print = $Result
                        ->select($alias . '.' . $data['index_col'])
                        ->setMaxResults(null)
                        ->getQuery()
                        ->getDql();

                $sql_query_for_sqw = $Result
                        ->select($alias . '.' . $data['index_col'])
                        ->setMaxResults(null)
                        ->getQuery()
                        ->getSql();

                $dql_query_for_sqw = $Result
                        ->select($alias . '.' . $data['index_col'])
                        ->setMaxResults(null)
                        ->getQuery()
                        ->getDql();
                $comms_query = $Result
                        ->select($alias . '.' . $data['index_col'])
                        ->setMaxResults(null)
                        ->resetDQLPart('orderBy')
                        ->getQuery()
                        ->getSql();

                $dql_query = $Result
                        ->select($alias . '.' . $data['index_col'])
                        ->setMaxResults(null)
                        ->resetDQLPart('orderBy')
                        ->getQuery()
                        ->getDql();
                $Result
                        ->select($alias . '.' . $data['index_col'])
                        ->setMaxResults(null)
                        ->resetDQLPart('orderBy')
                        ->getQuery()
                        ->getSQL()
                ;

                $values_arr = array();
                $types_arr = array();

                /*  Start ----
                 *  Commenting the following code block and using the one below as this retruned an incorrectly prepared SQL script.
                 *  I am leaving this code as commented for a while, so we are guaranteed that this change has not cause any issues
                 *  to other applications. Anjana (21-Apr-2017)
                 *

                  foreach ($Result->getParameters() as $index => $param) {
                  $a = $param->getValue();
                  if (is_array($a)) {
                  $tmp_arr = array();
                  foreach ($a as $k => $v) {
                  if (!is_array($v)) {
                  $tmp_arr[] = $v;
                  } else {
                  throw new \Exception('Sorry, nested arrays are not supported.', 500);
                  }
                  }
                  $values_arr[] = $tmp_arr;
                  $types_arr[] = \Doctrine\DBAL\Connection::PARAM_STR_ARRAY;
                  } else {
                  $values_arr[] = $param->getValue();
                  $types_arr[] = \PDO::PARAM_STR;
                  }
                  }
                  $val_arr = array( 'values' => $values_arr, 'types' => $types_arr);

                  /*
                 *  --- End
                 */

                /*
                 * Start ---
                 * The following code block is the fix that we applied to the above block of code
                 */
                if (count($Result->getParameters()) > 0) {
                    foreach ($Result->getParameters() as $_param) {
                        $thisVal = $_param->getValue();
                        $name = $_param->getName();
                        if (!is_array($thisVal)) {
                            $values_arr[$name] = $thisVal;
                            $types_arr[$name] = \PDO::PARAM_STR;
                        } else {
                            $values_arr[$name] = $thisVal;
                            $types_arr[$name] = \Doctrine\DBAL\Connection::PARAM_STR_ARRAY;
                        }
                    }
                }
                $val_arr = $this->getListParamsByDql($dql_query_for_print, $values_arr, $types_arr);

                /*
                 * --- End 
                 */

                $json_arr = json_encode(array(
                    'raw_sql' => $comms_query,
                    'dql' => $dql_query,
                    'sql_params' => $val_arr,
                    'total_records' => $iFilteredTotal
                ));
                $json_arr_for_print = json_encode(array(
                    'raw_sql' => $sql_query_for_print,
                    'dql' => $dql_query_for_print,
                    'sql_params' => $val_arr,
                ));

                $json_arr_for_sqw = json_encode(array(
                    'raw_sql' => $sql_query_for_sqw,
                    'dql' => $dql_query_for_sqw,
                    'sql_params' => $val_arr,
                ));

                $sqwQEncodedJson = $this->c->get('core_function_services')->eservEncode($json_arr_for_sqw);
                $SqwQueryWithVals = $this->c->get('db_core_function_services')->createSqlwithParameters($sqwQEncodedJson);

                $storedQueryInfo = array(
                    'sq_index' => $data['index_col'],
                    'sq_sql' => $SqwQueryWithVals,
                );

                $output['CommsQ'] = $this->c->get('core_function_services')->eservEncode($json_arr);
                $output['PrintQ'] = $this->preparePrintQ($json_arr_for_print, $data['index_col'], $request->get('sColumns'), $headerNames);
                $output['SqwQ'] = $this->c->get('core_function_services')->eservEncode(json_encode($storedQueryInfo));
            } else {
                $error = 'Table must be set!';
                $this->showTableError($sEcho, $error);
            }
        } catch (\Exception $e) {
            $sql_error = $e->getMessage();
        }

        if ($sql_error) {
            $this->showTableError($sEcho, $sql_error);
        }

        // ********TODO: transfer the code to insert row in gtcw_search to its repository
        array_key_exists('log_search', $data) ? ($data['log_search'] ? $logSearch = true : $logSearch = false ) : $logSearch = false;
        if ($logSearch && $col_filters) {
            $sSearchsV = array_filter($sSearchs);
            if (count($sSearchsV) > 0) {
                $sctSearchType = \ESERV\MAIN\Services\AppConstants::SCT_SEARCH_TYPE;
                $scSearchType = \ESERV\MAIN\Services\AppConstants::SC_SEARCH_TYPE_GENERAL;
                if (array_key_exists('gtcw_search_param', $col_filters)) {
                    if (array_key_exists('search_type', $col_filters['gtcw_search_param'])) {
                        if (array_key_exists('system_code_type', $col_filters['gtcw_search_param']['search_type'])) {
                            $sctSearchType = $col_filters['gtcw_search_param']['search_type']['system_code_type'];
                        }
                    }
                }
                if (array_key_exists('gtcw_search_param', $col_filters)) {
                    if (array_key_exists('search_type', $col_filters['gtcw_search_param'])) {
                        if (array_key_exists('system_code', $col_filters['gtcw_search_param']['search_type'])) {
                            $scSearchType = $col_filters['gtcw_search_param']['search_type']['system_code'];
                        }
                    }
                }
                $sctResult = \ESERV\MAIN\Services\AppConstants::SCT_SEARCH_RESULT;
                $referenceNo = null;
                $firstName = null;
                $lastName = null;
                $dateOfBirth = null;
                $initials = null;
                $ipAddress = null;
                $organisation = null;
                foreach ($sSearchs as $k => $v) {
                    $columnKeyArray = array_keys($data['columns']);
                    if ($v) {
                        $gtcwSearchFieldName = null;
                        if (array_key_exists('options', $data['columns'][$columnKeyArray[$k]])) {
                            if (array_key_exists('gtcw_search_field_name', $data['columns'][$columnKeyArray[$k]]['options'])) {
                                $gtcwSearchFieldName = $data['columns'][$columnKeyArray[$k]]['options']['gtcw_search_field_name'];
                            }
                        }
                        if ($gtcwSearchFieldName) {
                            switch ($gtcwSearchFieldName) {
                                case 'first_name':
                                    $firstName = $v;
                                    break;
                                case 'last_name':
                                    $lastName = $v;
                                    break;
                                case 'reference_no':
                                    $referenceNo = $v;
                                    break;
                                case 'date_of_birth':
                                    $dateOfBirth = $v;
                                    break;
                                case 'initials':
                                    $initials = $v;
                                    break;
                            }
                        }
                    }
                }
                if (count($rResult) > 1) {
                    $failure = 'N';
                    $scResult = \ESERV\MAIN\Services\AppConstants::SC_SEARCH_RESULT_MULTIPLE_MATCH;
                } else if (count($rResult) == 1) {
                    $failure = 'N';
                    $scResult = \ESERV\MAIN\Services\AppConstants::SC_SEARCH_RESULT_EXACT_MATCH;
                } else {
                    $failure = 'Y';
                    $scResult = \ESERV\MAIN\Services\AppConstants::SC_SEARCH_RESULT_NO_MATCH;
                }
                $searchType = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getBySystemCodeTypeAndCode($sctSearchType, $scSearchType);
                $result = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getBySystemCodeTypeAndCode($sctResult, $scResult);
                $insertSearch = $this->em->getRepository('GTCWGTCWBundle:GtcwSearch')->insertSearch($this->em, $this->c, $failure, $searchType, $dateOfBirth, $firstName, $initials, $ipAddress, $organisation, $referenceNo, $result, $lastName);
            }
        }
        // ********TODO: transfer the code to insert row in gtcw_search to its repository

        $set_redirect_url = true;

        foreach ($rResult as $aRow) {
            $row = array();
            $CountDataCols = count($dataCols);
            $i = 0;
            foreach ($dataCols as $k => $v) {
                if (!(is_array($v) && in_array($k, $details_links))) {
                    /* General output */
                    $row[] = $this->getRowData($aRow, $data, $dataCols, $i);
                    $i++;
                } else {
                    $view_link_data = array(
                        'id' => $aRow[$data['index_col']],
                        'display' => isset($dataCols[$k]['display']) ? $dataCols[$k]['display'] : null,
                        'portlet_name' => isset($dataCols[$k]['container_id']) ? $dataCols[$k]['container_id'] : '',
                        'page_url' => isset($dataCols[$k]['route']) ? $this->c->get('router')->generate($dataCols[$k]['route'], $this->buildURLParamsArray($aRow, $dataCols[$k]['url_params']), true) : $dataCols[$k]['url'],
                        'page_url_show_when' => isset($dataCols[$k]['url_show_when']) ? $dataCols[$k]['url_show_when'] : null,
                        'page_url_params' => isset($dataCols[$k]['url_params']) ? $dataCols[$k]['url_params'] : array(),
                        'item_title' => isset($dataCols[$k]['title_text']) ? $dataCols[$k]['title_text'] : 'Details',
                        'link_target' => isset($dataCols[$k]['target']) ? $dataCols[$k]['target'] : false,
                        'additional_attr' => isset($dataCols[$k]['additional_attr']) ? $dataCols[$k]['additional_attr'] : array(),
                        'modal_attr' => isset($dataCols[$k]['modal_attr']) ? $dataCols[$k]['modal_attr'] : array(),
                        'type_params' => isset($dataCols[$k]['type_params']) ? $dataCols[$k]['type_params'] : array(),
                        'db_encode' => isset($dataCols[$k]['db_encode']) ? $dataCols[$k]['db_encode'] : false,
                        'encoded_param_name' => isset($dataCols[$k]['encoded_param_name']) ? $dataCols[$k]['encoded_param_name'] : 'token',
                        'static_params' => isset($dataCols[$k]['static_params']) ? $dataCols[$k]['static_params'] : false,
                        'column_params' => isset($dataCols[$k]) ? $dataCols[$k] : false,
                    );
                    $row[] = $this->getDetailsIcon($aRow, $view_link_data, (isset($dataCols[$k]['type']) ? $dataCols[$k]['type'] : 'details'), $extra_options);
                }
            }
            $output['aaData'][] = $row;
            if ($set_redirect_url && array_key_exists('exact_match_redirection', $data) && $data['exact_match_redirection'] && array_key_exists('columns', $data) && array_key_exists('details_btn', $data['columns']) && array_key_exists('url', $data['columns']['details_btn']) && array_key_exists('url_params', $data['columns']['details_btn'])
            ) {
                $arrayKeys = array_keys($this->buildURLParamsArray($aRow, $dataCols[$k]['url_params']));
                $arrayVals = array_values($this->buildURLParamsArray($aRow, $dataCols[$k]['url_params']));
                $exMatchUrl = '';

                if (array_key_exists('exact_match_cols', $data)) {
                    if (is_array($data['exact_match_cols']) && count($data['exact_match_cols']) > 0) {
                        $tmpRedirectStatus = false;
                        for ($a = 0; $a < count($data['exact_match_cols']); $a++) {
                            if ($this->getDataTableRequestParameter($request, $data['exact_match_cols'][$a]) != '') {
                                $tmpRedirectStatus = true;
                                break;
                            }
                        }
                        if ($tmpRedirectStatus) {
                            for ($i = 0; $i < count($arrayKeys); $i++) {
                                $exMatchUrl .= str_replace('[[' . $arrayKeys[$i] . ']]', $arrayVals[$i], $dataCols[$k]['url']);
                            }
                            $output['exact_match_redirect_url'][] = $exMatchUrl;
                            $set_redirect_url = false;
                        }
                    }
                } else {
                    for ($i = 0; $i < count($arrayKeys); $i++) {
                        $exMatchUrl .= str_replace('[[' . $arrayKeys[$i] . ']]', $arrayVals[$i], $dataCols[$k]['url']);
                    }
                    $output['exact_match_redirect_url'][] = $exMatchUrl;
                    $set_redirect_url = false;
                }
            }
        }
//        print_r($output);die;
        return json_encode($output);
    }

    protected function addDoctrineStatement($Result, $CountFilteredResults, $ResultExp, $CountFilteredResultsExp, $alias, $colName, $operator, $colValue = false, $addToSql = true) {
        if ($operator == '!NULL' || $operator == 'NOT NULL' || $operator == 'IS NOT NULL') {
            $ResultExp->add($Result->expr()->isNotNull("$alias.$colName"));
            $CountFilteredResultsExp->add($CountFilteredResults->expr()->isNotNull("$alias.$colName"));
        } else if ($operator == 'NULL' || $operator == 'IS NULL') {
            $ResultExp->add($Result->expr()->isNull("$alias.$colName"));
            $CountFilteredResultsExp->add($CountFilteredResults->expr()->isNull("$alias.$colName"));
        } else {
            if ($colValue != false) {
                $sqlParamName = $colName . '_' . $this->queryParamsIdx++; 
                if ($operator == '>') {
                    $ResultExp->add($Result->expr()->gt("$alias.$colName", ":$sqlParamName"));
                    $Result->setParameter($sqlParamName, $colValue);

                    $CountFilteredResultsExp->add($CountFilteredResults->expr()->gt("$alias.$colName", ":$sqlParamName"));
                    $CountFilteredResults->setParameter($sqlParamName, $colValue);
                } else if ($operator == '<') {
                    $ResultExp->add($Result->expr()->lt("$alias.$colName", ":$sqlParamName"));
                    $Result->setParameter($sqlParamName, $colValue);

                    $CountFilteredResultsExp->add($CountFilteredResults->expr()->lt("$alias.$colName", ":$sqlParamName"));
                    $CountFilteredResults->setParameter($sqlParamName, $colValue);
                } else if ($operator == '=') {
                    $ResultExp->add($Result->expr()->eq("$alias.$colName", ":$sqlParamName"));
                    $Result->setParameter($sqlParamName, $colValue);

                    $CountFilteredResultsExp->add($CountFilteredResults->expr()->eq("$alias.$colName", ":$sqlParamName"));
                    $CountFilteredResults->setParameter($sqlParamName, $colValue);
                }
            }
        }
        if ($addToSql) {
            $Result->andWhere($ResultExp);
            $CountFilteredResults->andWhere($CountFilteredResultsExp);
        }
        return array(
            'result' => $Result,
            'filtered_result' => $CountFilteredResults,
            'result_exp' => $ResultExp,
            'filtered_result_exp' => $CountFilteredResultsExp,
        );
    }

    public function getDetailsIcon($RowData, $params = array(), $type = 'details', $options = array()) {
        $tableId = array_key_exists('table_id', $options) ? $options['table_id'] : '';
        $result = '';
        switch ($type) {
            case 'details':
                $input = '<input type="hidden" id="input_' . $params['id'] . '" value="' . $params['page_url'] . '" />';
                if (isset($options['details_icon_url'])) {
                    $details_icon_url = $options['details_icon_url'];
                } else {
                    $details_icon_url = $this->c->get('templating.helper.assets')->getUrl('clients/' . $this->c->getParameter('app_client') . '/themes/' . $this->c->getParameter('app_theme') . '/images/icons/details_open.png');
                }
                $image = '<img id="' . $params['id'] . '" rel="' . $params['portlet_name'] . '" class="view_details_icon_img quick_view_btn" src="' . $details_icon_url . '" alt="" />';

                $result = $input . $image;
                break;
            case 'download_link':

                $params_url = array();
                $pageURL = $params['page_url'];

                $disable_link = false;
                $disable_link_title = null;

                if (sizeof($params['page_url_params']) > 0) {
                    foreach ($params['page_url_params'] as $key => $value) {
                        $params_url['[[' . $key . ']]'] = $RowData[$value];

                        /* Condition checking whether to show / hide hyperlink */
                        if (!is_null($params['page_url_show_when']) && isset($params['page_url_show_when']['condition']) && sizeof($params['page_url_show_when']['condition']) > 0
                        ) {
                            foreach ($params['page_url_show_when']['condition'] as $kk => $vv) {
                                if ($kk == '[[' . $key . ']]' && $RowData[$value] != $vv) {
                                    $disable_link = true;
                                    $disable_link_title = isset($params['page_url_show_when']['label_to_show']) ? $params['page_url_show_when']['label_to_show'] : null;
                                }
                            }
                        }
                    }
                    $pageURL = str_replace(array_keys($params_url), array_values($params_url), $params['page_url']);
                } else {
                    $pageURL = $params['page_url'];
                }

                $display_link = true;
                $display = '';
                $link = '';

                $url_target = $params['link_target'] ? 'target="' . $params['link_target'] . '"' : 'target= "_blank"';

                if (!is_null($params['display'])) {
                    if (!is_array($params['display'])) {
                        $display = '<img src="" />';
                    } else {
                        switch ($params['display']['type']) {
                            case 'file_icon':
                                if (empty($RowData[$params['display']['file_id_field']])) {
                                    if (empty($RowData['extension'])) {
                                        $display_link = false;
                                    } elseif (isset($params['display']['alt_ext'])) {
                                        $display = '<img src="' . $this->c->get('templating.helper.assets')->getUrl('common/assets/images/icons/file_types/' . strtolower($params['display']['alt_ext']['ext']) . '.png') . '" />';
                                        $pageURL = $this->c->get('router')->generate($params['display']['alt_ext']['route'], $this->buildURLParamsArray($RowData, $params['display']['alt_ext']['route_params']), true);
                                        $link = '<a id="' . $params['id'] . '" href="' . $pageURL . '" rel="' . $params['portlet_name'] . '" ' . $url_target . '>' . $display . '</a>';
                                    } else {
                                        $display = '<img src="' . $this->c->get('templating.helper.assets')->getUrl('common/assets/images/icons/file_types/' . strtolower($RowData['extension']) . '.png') . '" />';
                                        $link = '<a id="' . $params['id'] . '" href="' . $pageURL . '" rel="' . $params['portlet_name'] . '" ' . $url_target . '>' . $display . '</a>';
                                    }
                                } else {
                                    $display = '<img src="' . $this->c->get('templating.helper.assets')->getUrl('common/assets/images/icons/file_types/' . strtolower($RowData['extension']) . '.png') . '" />';
                                    $link = '<a id="' . $params['id'] . '" href="' . $pageURL . '" rel="' . $params['portlet_name'] . '" ' . $url_target . '>' . $display . '</a>';
                                }
                                break;
                        }
                    }
                } else {
                    /* Showing / hiding hyperlink based on the above condtion check */
                    if ($disable_link == true) {
                        $label = $disable_link_title != null ? $disable_link_title : $params['item_title'];
                        $link = '<span>' . $label . '</span>';
                    } else {
                        $link = '<a id="' . $params['id'] . '" href="' . $pageURL . '" rel="' . $params['portlet_name'] . '" ' . $url_target . '>' . $params['item_title'] . '</a>';
                    }
                }

                if (!$display_link) {
                    $result = 'No File';
//                    $result = '<img src="' . $this->c->get('templating.helper.assets')->getUrl('common/assets/images/icons/file_types/no_file_1.png') . '" />';
                } else {
                    $result = $link;
                }

                break;
            case 'details_url':
                $params_url = array();
                if (sizeof($params['page_url_params']) > 0) {
                    foreach ($params['page_url_params'] as $key => $value) {
                        $params_url['[[' . $key . ']]'] = $RowData[$value];
                    }
                    $pageURL = str_replace(array_keys($params_url), array_values($params_url), $params['page_url']);
                } else {
                    $pageURL = $params['page_url'];
                }

                $add_tag_attr = $this->getAdditionalAttr($params, $RowData);

                $url_target = $params['link_target'] ? 'target="' . $params['link_target'] . '"' : 'target="_blank"';

                $link = '<button id="' . $params['id'] . '" href="' . $pageURL . '" rel="' . $params['portlet_name'] . '" ' . $url_target . ' ' . implode(' ', $add_tag_attr) . '>' . $params['item_title'] . '</button>';
                $result = $link;
                break;
            case 'details_href_post':
                $add_tag_attr = $this->getAdditionalAttr($params, $RowData);
                $link = '<a href="javascript:;" ' . implode(' ', $add_tag_attr) . '>' . $params['item_title'] . '</a>';
                $result = $link;
                break;
            case 'details_href':

                $disable_link = false;
                $disable_link_title = null;

                $pageURL = $params['page_url'];

                if ($params['page_url'] == 'no_href') {
                    $complete_url = '';
                    $url_target = '';
                } else {
                    $params_url = array();

                    if (sizeof($params['page_url_params']) > 0) {
                        if ($params['page_url_show_when']['condition'] == 'function') {
                            $showHideRow = $this->populateShowHideDetailsHref($params, $RowData);
                            $pageURL = $showHideRow['pageURL'];
                            $disable_link = $showHideRow['disable_link'];
                            $disable_link_title = $showHideRow['disable_link_title'];
                        } else {
                            foreach ($params['page_url_params'] as $key => $value) {
                                /* Condition checking whether to show / hide hyperlink */
                                if (!is_null($params['page_url_show_when']) && isset($params['page_url_show_when']['condition']) && sizeof($params['page_url_show_when']['condition']) > 0
                                ) {
                                    foreach ($params['page_url_show_when']['condition'] as $kk => $vv) {
                                        if ($kk == '[[' . $key . ']]' && $RowData[$value] != $vv) {
                                            $disable_link = true;
                                            if (isset($params['page_url_show_when']['label_to_show'])) {
                                                if (!is_array($params['page_url_show_when']['label_to_show'])) {
                                                    $disable_link_title = $params['page_url_show_when']['label_to_show'];
                                                } else {
                                                    $disable_link_title = $params['page_url_show_when']['label_to_show'][$kk];
                                                }
                                            }
//                                            $disable_link_title = isset($params['page_url_show_when']['label_to_show']) ? $params['page_url_show_when']['label_to_show'] : null;
                                        }
                                    }
                                }
                                $params_url['[[' . $key . ']]'] = $RowData[$value];
                            }
                            $pageURL = str_replace(array_keys($params_url), array_values($params_url), $params['page_url']);
                        }
                    }
                }

                $add_tag_attr = $this->getAdditionalAttr($params, $RowData);
                /* Showing / hiding hyperlink based on the above condtion check */
                if ($disable_link == true) {
                    $label = $disable_link_title != null ? $disable_link_title : $params['item_title'];
                    $link = '<span>' . $label . '</span>';
                } else {
                    $complete_url = 'href="' . $pageURL . '"';
                    $url_target = $params['link_target'] ? 'target="' . $params['link_target'] . '"' : '';
                    $link = '<a id="' . $params['id'] . '" ' . $complete_url . ' rel="' . $params['portlet_name'] . '" ' . $url_target . ' ' . implode(' ', $add_tag_attr) . '>' . $params['item_title'] . '</a>';
                }

                $result = $link;
                break;
            case 'details_href_modal':

                $modal_title = '';
                if (isset($params['modal_attr'])) {
                    $modal_title = isset($params['modal_attr']['title']) ? ($this->c->get('translator')->trans($params['modal_attr']['title'], array(), $this->c->get('eserv_translation_services')->getFullEservDbTransDomain())) : '';
                }

                if ($params['page_url'] == 'no_href') {
                    $complete_url = '';
                } else {
                    $params_url = array();
                    if (sizeof($params['page_url_params']) > 0) {
                        foreach ($params['page_url_params'] as $key => $value) {
                            $params_url['[[' . $key . ']]'] = $RowData[$value];
                        }
                        $pageURL = str_replace(array_keys($params_url), array_values($params_url), $params['page_url']);
                    } else {
                        $pageURL = $params['page_url'];
                    }
                    $complete_url = 'data-href="' . $pageURL . '"';
                }

                $add_tag_attr = $this->getAdditionalAttr($params, $RowData);

                $link = '<a data-modal-title="' . $modal_title . '" id="modal_id_' . $params['id'] . '" ' . $complete_url . ' rel="' . $params['portlet_name'] . '" target="' . $params['link_target'] . '" ' . implode(' ', $add_tag_attr) . '>' . $params['item_title'] . '</a>';
                $result = $link;
                break;
            case 'details_modal':

                $params_url = array();
                $disable_link = false;
                $disable_link_title = null;

                $modal_title = '';
                if (isset($params['modal_attr'])) {
                    $modal_title = $params['modal_attr']['title'];
                }
                $modalSize = 'lg';
                if (isset($params['modal_attr']['size'])) {
                    $modalSize = $params['modal_attr']['size'];
                }

                if ($params['page_url'] == 'no_href') {
                    $complete_url = '';
                } else {

                    if (sizeof($params['page_url_params']) > 0) {
                        foreach ($params['page_url_params'] as $key => $value) {
                            if ($value == 'row_data' && $params['db_encode']) {
                                $params_url[$key] = $RowData;
                            } else {
                                $params_url['[[' . $key . ']]'] = array_key_exists($value, $RowData) ? $RowData[$value] : '';
                            }

                            /* Condition checking whether to show / hide hyperlink */
                            if (!is_null($params['page_url_show_when']) && isset($params['page_url_show_when']['condition']) && sizeof($params['page_url_show_when']['condition']) > 0
                            ) {
                                foreach ($params['page_url_show_when']['condition'] as $kk => $vv) {
                                    if (array_key_exists($value, $RowData)) {
                                        if ($kk == '[[' . $key . ']]' && $RowData[$value] != $vv) {
                                            $disable_link = true;
                                            $disable_link_title = isset($params['page_url_show_when']['label_to_show']) ? $params['page_url_show_when']['label_to_show'] : null;
                                        }
                                    }
                                }
                            }
                        }
                        if (is_array($params['static_params'])) {
                            foreach ($params['static_params'] as $spk => $spv) {
                                $params_url['[[' . $spk . ']]'] = $spv;
                            }
                        }
                        if ($params['db_encode']) {
                            $paramName = $params['encoded_param_name'];
                            $paramNameValuePair = array();
                            foreach ($params_url as $puk => $puv) {
                                $paramNameValuePair[str_replace(array('[[', ']]'), '', $puk)] = $puv;
                            }
                            $dbTokenOptions = array();
                            if (isset($params['additional_attr']['ui-sref']['encode_ui_sref_params']['options']) && is_array($params['additional_attr']['ui-sref']['encode_ui_sref_params']['options'])) {
                                $dbTokenOptions = $params['additional_attr']['ui-sref']['encode_ui_sref_params']['options'];
                            }
                            $encodedParamNameValuePair = $this->c->get('db_core_function_services')->setDbToken($paramNameValuePair, $dbTokenOptions);
                            $params_url = array('[[' . $paramName . ']]' => $encodedParamNameValuePair);
                        }
                        $pageURL = str_replace(array_keys($params_url), array_values($params_url), $params['page_url']);
                    } else {
                        $pageURL = $params['page_url'];
                    }
                    $complete_url = $this->c->get('router')->generate('eserv_home_homepage') . $pageURL;
                }

                $add_tag_attr = $this->getAdditionalAttr($params, $RowData);

                /* Showing / hiding hyperlink based on the above condtion check */
                if ($disable_link == true) {
                    $label = $disable_link_title != null ? $disable_link_title : $params['item_title'];
                    $link = '<span>' . $label . '</span>';
                } else {
                    $link = '<a ng-controller="EservModalCtrl" ng-click="openEservModal(\'eserv_popup_' . md5($complete_url . time()) . '\', \'' . $modal_title . '\', \' ' . $modalSize . '\', { target_url: \'' . $complete_url . '\', base_table_id: \'' . $tableId . '\'})">' . $params['item_title'] . '</a>';
                }

                $result = $link;
                break;
            case 'popup':
                isset($params['gallery_id']) ? $rel = ' rel="' . $params['gallery_id'] . '"' : $rel = '';
                isset($params['item_title']) ? $item_title = ' title="' . $params['item_title'] . '"' : $item_title = '';
                $result = '<a ' . $rel . $item_title . ' class="view_details_popup_icon_img' . (isset($params['css_class']) ? ' ' . $params['css_class'] : '') . '" id="popup_' . $params['id'] . '" href="' . $params['page_url'] . '">' . (isset($params['label']) ? $params['label'] : 'View') . '</a>';
                break;
            case 'checkbox':

                $name = isset($params['type_params']) ? (isset($params['type_params']['name']) ? $params['type_params']['name'] : null) : null;
                $checkbox_name = !is_null($name) ? $name : 'eserv_dt_checkbox';
                $disable_checkbox = false;
                $checkboxIdColVal = NULL;

                if (sizeof($params['page_url_params']) > 0) {
                    foreach ($params['page_url_params'] as $key => $value) {
                        if (isset($params['type_params']['checkbox_id_col']) && ($key == $params['type_params']['checkbox_id_col'])) {
                            $checkboxIdColVal = $RowData[$value];
                        }
                        $params_url['[[' . $key . ']]'] = $RowData[$value];
                        /* Condition checking whether to show / hide checkbox */
                        if (!is_null($params['page_url_show_when']) && isset($params['page_url_show_when']['condition']) && sizeof($params['page_url_show_when']['condition']) > 0
                        ) {
                            foreach ($params['page_url_show_when']['condition'] as $kk => $vv) {
                                if ($kk == '[[' . $key . ']]' && $RowData[$value] != $vv) {
                                    $disable_checkbox = true;
                                }
                            }
                        }
                    }
                }

                $add_tag_attr = $this->getAdditionalAttr($params, $RowData);

                /* Showing / hiding checkbox based on the above condtion check */
                if ($disable_checkbox == true) {
                    $link = '';
                } else {
                    $link = '<div class="checkbox">';
                    $html_id = (isset($params['type_params']['unique_id']) ? $params['type_params']['unique_id'] : '') . md5($checkbox_name) . '_' . $this->increment_id;
                    $link .= '<input ' . implode(' ', $add_tag_attr) . ' class="checkbox-cell" type="checkbox" value="' . (!is_null($checkboxIdColVal) ? $checkboxIdColVal : $params['id']) . '" id="' . $html_id . '" name="' . $checkbox_name . '" />';
                    $link .= '<label for="' . $html_id . '"></label></div>';
                }

                $result = $link;
                $this->increment_id ++;
                break;

            case 'advanced_search':
                $textInBrackets = '';
                if (array_key_exists('display_text_in_brackets', $params['additional_attr'])) {
                    $colValInBrackets = $params['additional_attr']['display_text_in_brackets'];
                    $textInBrackets = array_key_exists($colValInBrackets, $RowData) ? $RowData[$colValInBrackets] : '';
                }

                $result = '<a onclick="advancedSearchSetValue(\'' . $params['additional_attr']['display_text_field_id'] . '\''
                        . ', \'' . str_replace("'", "\'", $RowData[$params['additional_attr']['display_text']]) . ($textInBrackets ? '(' . str_replace("'", "\'", $textInBrackets) . ')' : '') . '\''
                        . ', \'' . $params['additional_attr']['value_field_id'] . '\''
                        . ', \'' . $RowData[$params['additional_attr']['value']] . '\''
                        . ');">' . $params['item_title'] . '</a>';
                break;
            case 'html':
                $currColumn = $params['column_params'];
                $html_text = $currColumn['html_text'];
                $replaceValues = $currColumn['replace_values'];
                foreach ($replaceValues as $repText => $repVal) {
                    if (is_array($repVal)) {
                        if (isset($repVal['condition']) && is_array($repVal['condition']) && !empty($repVal['condition'])) {
                            $repValCondition = $repVal['condition'];
                            $repValueIsSet = false;
                            $repValue = '';
                            $tcColValue = '';
                            foreach ($repValCondition as $repValCond) {
                                if ($repValueIsSet) {
                                    break;
                                }
                                foreach ($repValCond as $tcColName => $tcColValCon) {
                                    if ($repValueIsSet) {
                                        break;
                                    }
                                    if (isset($RowData[strtolower($tcColName)])) {
                                        $tcColValue = $RowData[strtolower($tcColName)];
                                        foreach ($tcColValCon as $tcColVal => $tcRepStr) {
                                            if ($repValueIsSet) {
                                                break;
                                            }
                                            if (strtoupper($tcColVal) == 'NULL' || strtoupper($tcColVal) == 'IS NULL' || strtoupper($tcColVal) == 'IS_NULL') {
                                                if (is_null($tcColValue) || empty($tcColValue)) {
                                                    $repValue = $tcRepStr;
                                                    $repValueIsSet = true;
                                                }
                                            } elseif (strtoupper($tcColVal) == 'IS NOT NULL' || strtoupper($tcColVal) == 'IS_NOT_NULL' || strtoupper($tcColVal) == 'NOT_NULL' || strtoupper($tcColVal) == 'NOT NULL' || strtoupper($tcColVal) == '!NULL') {
                                                if (!is_null($tcColValue) && !empty($tcColValue)) {
                                                    $repValue = $tcRepStr;
                                                    $repValueIsSet = true;
                                                }
                                            } else {
                                                if (strtoupper($tcColVal) == strtoupper($tcColValue)) {
                                                    $repValue = $tcRepStr;
                                                    $repValueIsSet = true;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            $fromRow = isset($repVal['from_row']) ? $repVal['from_row'] : array();
                            foreach ($fromRow as $frk => $frv) {
                                if (strtolower($frv) === 'row_data') {
                                    $frValue = $RowData;
                                } else {
                                    $frValue = $RowData[$frv];
                                }
                                $paramNameValuePair[$frk] = $frValue;
                            }
                            $staticParam = isset($repVal['static']) ? $repVal['static'] : array();
                            foreach ($staticParam as $spk => $spv) {
                                $paramNameValuePair[$spk] = $spv;
                            }
                            $eservEncode = isset($repVal['eserv_encode']) ? $repVal['eserv_encode'] : false;
                            if ($eservEncode) {
                                $repValue = $this->c->get('core_function_services')->eservEncode($paramNameValuePair);
                            } else {
                                $repValue = $this->c->get('db_core_function_services')->setDbToken($paramNameValuePair);
                            }
                        }
                    } else {
                        $repValue = array_key_exists($repVal, $RowData) ? $RowData[$repVal] : '';
                    }
                    $html_text = str_replace("[[$repText]]", $repValue, $html_text);
                }

                $disable_link = false;
                /* Condition checking whether to show / hide hyperlink */
                if (isset($params['page_url_show_when']) && is_array($params['page_url_show_when'])) {
                    foreach ($params['page_url_show_when'] as $psk => $psv) {
                        if (isset($psv['condition']) && is_array($psv['condition'])) {
                            foreach ($psv['condition'] as $kk => $vv) {
                                if (array_key_exists($kk, $RowData)) {
                                    if ($RowData[$kk] == $vv) {
                                        $disable_link = true;
                                        $disable_link_title = isset($psv['label_to_show']) ? $psv['label_to_show'] : '';
                                    }
                                }
                            }
                        }
                    }
                }
                if ($disable_link) {
                    $result = $disable_link_title;
                } else {
                    $result = $html_text;
                }
                break;
        }

        return $result;
    }

    protected function getRowData($aRow, $data, $dataCols, $count) {

        $rowData = null;
        if (isset($data['columns'][$dataCols[$count]]['col_type'])) {
            $currColumn = $data['columns'][$dataCols[$count]];
            $col_type = $currColumn['col_type'];
            switch ($col_type) {
                case 'date':
                    if (isset($data['columns'][$dataCols[$count]]['date_format'])) {
                        $date_format = $data['columns'][$dataCols[$count]]['date_format'];
                    } else {
                        $date_format = $this->c->hasParameter('app_datatable_date_format') ? $this->c->getParameter('app_datatable_date_format') : 'd M Y';
                    }
                    if ($aRow[$dataCols[$count]] instanceof \DateTime) {
                        $rowData = $aRow[$dataCols[$count]]->format($date_format);
                    } else if (empty($aRow[$dataCols[$count]])) {
                        $rowData = '';
                    } else if (!empty($aRow[$dataCols[$count]])) {
                        $rowData = date($date_format, strtotime($aRow[$dataCols[$count]]));
                    } else {
                        $rowData = 'Error retrieving date!';
                    }
                    break;
                case 'year_only':
                    $date_format = 'Y';
                    if ($aRow[$dataCols[$count]] instanceof \DateTime) {
                        $rowData = $aRow[$dataCols[$count]]->format($date_format);
                    } else if (empty($aRow[$dataCols[$count]])) {
                        $rowData = '';
                    } else if (!empty($aRow[$dataCols[$count]])) {
                        $rowData = date($date_format, strtotime($aRow[$dataCols[$count]]));
                    } else {
                        $rowData = 'Error retrieving date!';
                    }
                    break;
                case 'amount':
                    if (is_numeric($aRow[$dataCols[$count]])) {
                        $rowData = number_format($aRow[$dataCols[$count]], 2);
                    } else if (empty($aRow[$dataCols[$count]])) {
                        $rowData = '0.00';
                    } else {
                        $rowData = 'Error retrieving amount!';
                    }
                    break;
                case 'percentage':
                    $_val = '';
                    if (isset($data['columns'][$dataCols[$count]]['percentage_options'])) {
                        $percentage_options = $data['columns'][$dataCols[$count]]['percentage_options'];
                        $percentage_label = $data['columns'][$dataCols[$count]]['percentage_options']['label'];
                        if (isset($percentage_options['total']['col'])) {
                            $percentage = $aRow[$dataCols[$count]] * 100 / $aRow[$percentage_options['total']['col']];
                            $_val = str_replace(
                                    array(
                                '__VAL__',
                                '__PERCENTAGE__'
                                    ), array(
                                $aRow[$dataCols[$count]],
                                round($percentage, 1)
                                    ), $percentage_label);
                        } elseif (isset($percentage_options['total']['value'])) {
                            $percentage = $aRow[$dataCols[$count]] * 100 / $percentage_options['total']['value'];
                            $_val = str_replace(
                                    array(
                                '__VAL__',
                                '__PERCENTAGE__'
                                    ), array(
                                $aRow[$dataCols[$count]],
                                round($percentage, 1)
                                    ), $percentage_label);
                        } else {
                            $_val = $aRow[$dataCols[$count]];
                        }
                    } else {
                        $_val = $aRow[$dataCols[$count]];
                    }

                    $rowData = $_val;

                    break;
                case 'url':
                    $ThisVal = $aRow[$dataCols[$count]];
                    if (!empty($data['columns'][$dataCols[$count]]['eserv_title_text']) && is_array($data['columns'][$dataCols[$count]]['eserv_title_text'])) {
                        $arr = $data['columns'][$dataCols[$count]]['eserv_title_text'];
                        $titleTextClass = isset($arr['class']) ? $arr['class'] : '';
                        if (isset($arr['url'])) {
                            $params = $arr['params'];
                            $url = $arr['url'];
                            $urlString = '';
                            foreach ($params as $k => $v) {
                                foreach ($dataCols as $a => $b) {
                                    if ($v == $b) {
                                        $urlString = str_replace('[[' . $v . ']]', $aRow[$v], $url);
                                    }
                                }
                            }
                            $rowData = '<a target="_self" class="' . $titleTextClass . '"' . ' href="' . $urlString . '">' . $ThisVal . '</a>';
                        } else {
                            if (isset($arr['ui-sref'])) {
                                $value = $arr['ui-sref'];
//code below is essentially the same as the code from the getAdditionalAttr function (with some changes to variables)
                                if (is_array($value)) {
                                    $params_url = array();
                                    if (
                                            (isset($value['ui_sref_params']) && sizeof($value['ui_sref_params']) > 0) ||
                                            (isset($value['ui_sref_static_params']) && sizeof($value['ui_sref_static_params']) > 0)
                                    ) {
                                        foreach ($value['ui_sref_params'] as $k => $v) {
                                            //$params_url['[[' . $k . ']]'] = $RowData[$v];
                                            if (strtolower($v) === 'row_data') {
                                                if (isset($value['encode_ui_sref_params']['db_encode']) && ($value['encode_ui_sref_params']['db_encode'] == true)) {
                                                    $params_url['[[' . $k . ']]'] = $aRow;
                                                } else {
                                                    $params_url['[[' . $k . ']]'] = 'row_data';
                                                }
                                            } else {
                                                $params_url['[[' . $k . ']]'] = $aRow[$v];
                                            }
                                        }
                                        if (isset($value['ui_sref_static_params']) && sizeof($value['ui_sref_static_params']) > 0) {
                                            foreach ($value['ui_sref_static_params'] as $spk => $spv) {
                                                $params_url['[[' . $spk . ']]'] = $spv;
                                            }
                                        }
                                        if ((isset($value['encode_ui_sref_params']) && isset($value['encode_ui_sref_params']['status']) && ($value['encode_ui_sref_params']['status'] == true)) ||
                                                (isset($value['encode_ui_sref_params']) && isset($value['encode_ui_sref_params']['db_encode']) && ($value['encode_ui_sref_params']['db_encode'] == true))) {
                                            $paramName = isset($value['encode_ui_sref_params']['encoded_param_name']) ? $value['encode_ui_sref_params']['encoded_param_name'] : 'param';
                                            foreach ($params_url as $puk => $puv) {
                                                $paramNameValuePair[str_replace(array('[[', ']]'), '', $puk)] = $puv;
                                            }
                                            if (isset($value['encode_ui_sref_params']['db_encode']) && ($value['encode_ui_sref_params']['db_encode'] == true)) {
                                                $options = array_key_exists('options', $value['encode_ui_sref_params']) ? $value['encode_ui_sref_params']['options'] : array();
                                                $encodedParamNameValuePair = $this->c->get('db_core_function_services')->setDbToken($paramNameValuePair, $options);
                                            } else {
                                                $encodedParamNameValuePair = $this->coreFunction->eservEncode(json_encode($paramNameValuePair));
                                            }
                                            $params_url = array('[[' . $paramName . ']]' => $encodedParamNameValuePair);
                                        }
                                        $pageURL = str_replace(array_keys($params_url), array_values($params_url), $value['url']);
                                    } else {
                                        $pageURL = $value['url'];
                                    }
                                } else {
                                    $pageURL = $value;
                                }
//code above is essentially the same as the code from the getAdditionalAttr function (with some changes to variables)
                                $rowData = '<a class="table_details_btn ' . $titleTextClass . '"' . 'ui-sref="' . $pageURL . '" rel="" >' . $ThisVal . '</a>';
                            } else {
                                $rowData = '';
                            }
                        }
                    }

                    break;
                case 'service':
                    $thisVal = $aRow[$dataCols[$count]];
                    $serviceName = $currColumn['details']['name'];
                    $functionName = $currColumn['details']['function_name'];
                    $funcParams = array();
                    if (isset($currColumn['details']['function_params'])) {
                        $functionParams = $currColumn['details']['function_params'];
                        if (is_array($functionParams)) {
                            if (isset($functionParams['row_data']) && $functionParams['row_data'] == true) {
                                $funcParams = $aRow;
                            }
                            if (isset($functionParams['static_params']) && is_array($functionParams['static_params'])) {
                                foreach ($functionParams['static_params'] as $name => $value) {
                                    $funcParams[$name] = $value;
                                }
                            }
                            if (isset($functionParams['data_params']) && is_array($functionParams['data_params'])) {
                                foreach ($functionParams['data_params'] as $name => $value) {
                                    $funcParams[$name] = array_key_exists($value, $aRow) ? $aRow[$value] : $value;
                                }
                            }
                        }
                    }
                    $serviceClass = new $serviceName($this->em, $this->c);
                    $rowData = $serviceClass->$functionName($thisVal, $funcParams);
                    break;
                case 'external_data':
                    if (isset($data['columns'][$dataCols[$count]]['external_data_attr'])) {
                        $external_data_attr = $data['columns'][$dataCols[$count]]['external_data_attr'];

                        $url = $this->c->get('router')->generate($external_data_attr['route'], $this->buildURLParamsArray($aRow, $external_data_attr['params']), true);
                        if (!empty($aRow[$dataCols[$count]])) {
                            $col_text = isset($external_data_attr['col_text']) ? $external_data_attr['col_text'] : $aRow[$dataCols[$count]];
                            $rowData = '<a class="multi_result_hyperlink mtl_tooltip" data-mtl="' . $url . '" title="' . (isset($external_data_attr['hover_text']) ? $external_data_attr['hover_text'] : 'Details') . '">' . $col_text . '</a>';
                        } else {
                            $no_show_text = isset($external_data_attr['no_show_text']) ? $external_data_attr['no_show_text'] : $aRow[$dataCols[$count]];
                            $rowData = '<div class="disabled">' . $no_show_text . '</div>';
                        }
                    } else {
                        $error = 'External data attributes key must be set!';
                        $this->showTableError($sEcho, $error);
                    }
                    break;
                case 'xml_data':
                    $thisVal = $aRow[$dataCols[$count]];
// //               sample xml format     
//                    $thisVal = '<row> 
//                                    <code> 1 </code><description> Test 1</description>
//                                    <code> 2 </code><description> </description>
//                                    <code> 3 </code><description> </description>
//                                </row>';
                    if (!empty($thisVal)) {
                        libxml_use_internal_errors(true);
                        $xml = simplexml_load_string($thisVal);
                        if ($xml) {
                            $xmlArray = $this->coreFunction->xmlToArray($thisVal);
                            if (isset($xmlArray[0]['code']) && isset($xmlArray[0]['description']) && !empty($xmlArray[0]['code']) && !empty($xmlArray[0]['description'])) {
                                $xmlCodes = $xmlArray[0]['code'];
                                $xmlDescription = $xmlArray[0]['description'];
                                $listHtml = '';
                                for ($i = 0; $i < count($xmlCodes); $i++) {
                                    $liCode = '';
                                    $liDescription = '';
                                    if (!is_array($xmlCodes[$i])) {
                                        $liCode = $xmlCodes[$i];
                                    }
                                    if (!is_array($xmlDescription[$i])) {
                                        $liDescription = $xmlDescription[$i];
                                    }
                                    $listHtml .= '<li data-code="' . trim($liCode) . '">' . trim($liDescription) . '</li>';
                                }
                                $rowData = $listHtml ? '<ul class="datatable-xml-data">' . $listHtml . '</ul>' : '';
                            }
                        } else {
                            foreach (libxml_get_errors() as $error) {
                                $rowData .= $error->message;
                            }
                        }
                    }
                    break;
                case 'hover_state':
                    $max_len = 12;
                    $hover_state_col_len = strlen($aRow[$dataCols[$count]]);
                    if ($hover_state_col_len > $max_len) {
                        $rowData = '<div class="mtl_tooltip" title="' . $aRow[$dataCols[$count]] . '">' . substr($aRow[$dataCols[$count]], 0, $max_len) . '</div>';
                    } else {
                        $rowData = $aRow[$dataCols[$count]];
                    }

                    break;
                case 'sub_string':
                    $max_length = isset($data['columns'][$dataCols[$count]]['max_length']) ? $data['columns'][$dataCols[$count]]['max_length'] : 50;
                    if (strlen($aRow[$dataCols[$count]]) > $max_length) {
                        $rowData = '<span class="mtl_tooltip dt_substr" title="' . $aRow[$dataCols[$count]] . '">' . substr($aRow[$dataCols[$count]], 0, $max_length) . '...' . '</span>';
                    } else {
                        $rowData = $aRow[$dataCols[$count]];
                    }
                    break;
                case 'html':
                    $html_text = false;
                    if (isset($currColumn['html_text'])) {
                        $html_text = $currColumn['html_text'];
                    }
                    if (false != $html_text) {
                        if (isset($currColumn['replace_values'])) {
                            $replaceValues = $currColumn['replace_values'];
                            foreach ($replaceValues as $repText => $repVal) {
                                if (is_array($repVal)) {
                                    $fromRow = isset($repVal['from_row']) ? $repVal['from_row'] : array();
                                    foreach ($fromRow as $frk => $frv) {
                                        if (strtolower($frv) === 'row_data') {
                                            $frValue = $aRow;
                                        } else {
                                            $frValue = $aRow[$frv];
                                        }
                                        $paramNameValuePair[$frk] = $frValue;
                                    }
                                    $staticParam = isset($repVal['static']) ? $repVal['static'] : array();
                                    foreach ($staticParam as $spk => $spv) {
                                        $paramNameValuePair[$spk] = $spv;
                                    }
                                    $eservEncode = isset($repVal['eserv_encode']) ? $repVal['eserv_encode'] : false;
                                    if ($eservEncode) {
                                        $jsonString = json_encode($paramNameValuePair);
                                        $repValue = $this->c->get('core_function_services')->eservEncode($jsonString);
                                    } else if (isset($repVal['json_encode']) && $repVal['json_encode'] == true) {
                                        $jsonString = json_encode($paramNameValuePair);
                                        $repValue = htmlentities($jsonString);
                                    } else {
                                        // db-encode as a token 
                                        $repValue = $this->c->get('db_core_function_services')->setDbToken($paramNameValuePair);
                                    }
                                } else {
                                    $repValue = array_key_exists($repVal, $aRow) ? $aRow[$repVal] : $repVal;
                                }
                                $html_text = str_replace("[[$repText]]", $repValue, $html_text);
                            }
                            $rowData = $html_text;
                        } else {
                            $rowData = str_replace(AppConstants::ESERV_MAIN_DT_HTML_REPLACE_STRING, $aRow[$dataCols[$count]], $html_text);
                        }
                    } else {
                        $rowData = $aRow[$dataCols[$count]];
                    }
                    break;
                default:
                    $rowData = $aRow[$dataCols[$count]];
                    break;
            }
        } else {
            $rowData = $aRow[$dataCols[$count]];
        }

        return $rowData;
    }

    public function getAdditionalAttr($params, $RowData) {
        $add_tag_attr = array();

        if (isset($params['additional_attr'])) {
            foreach ($params['additional_attr'] as $key => $value) {
                switch ($key) {
                    case 'data-post-url-params':
                        if (is_array($value)) {
                            $params_url = array();
                            if ((isset($value['record_params']) && sizeof($value['record_params']) > 0) ||
                                    (isset($value['static_params']) && sizeof($value['static_params']) > 0)) {
                                foreach ($value['record_params'] as $k => $v) {
                                    $params_url[$k] = $RowData[$v];
                                }
                                if (isset($value['static_params']) && sizeof($value['static_params']) > 0) {
                                    foreach ($value['static_params'] as $spk => $spv) {
                                        $params_url[$spk] = $spv;
                                    }
                                }
                            }
                            if (isset($value['eserv_encode']) && $value['eserv_encode']) {
                                $attrVal = $this->coreFunction->eservEncode(json_encode($params_url));
                            }
                        } else {
                            $attrVal = $value;
                        }
                        array_push($add_tag_attr, $key . '="' . $attrVal . '"');
                        break;
                    case 'ui-sref':
                        if (is_array($value)) {
                            $params_url = array();
                            if ((isset($value['ui_sref_params']) && sizeof($value['ui_sref_params']) > 0) ||
                                    (isset($value['ui_sref_static_params']) && sizeof($value['ui_sref_static_params']) > 0)) {

                                foreach ($value['ui_sref_params'] as $k => $v) {
                                    $params_url['[[' . $k . ']]'] = $RowData[$v];
                                }
                                if (isset($value['ui_sref_static_params']) && sizeof($value['ui_sref_static_params']) > 0) {
                                    foreach ($value['ui_sref_static_params'] as $spk => $spv) {
                                        $params_url['[[' . $spk . ']]'] = $spv;
                                    }
                                }
                                if ((isset($value['encode_ui_sref_params']) && isset($value['encode_ui_sref_params']['status']) && ($value['encode_ui_sref_params']['status'] == true)) ||
                                        (isset($value['encode_ui_sref_params']) && isset($value['encode_ui_sref_params']['db_encode']) && ($value['encode_ui_sref_params']['db_encode'] == true))) {
                                    $paramName = isset($value['encode_ui_sref_params']['encoded_param_name']) ? $value['encode_ui_sref_params']['encoded_param_name'] : 'param';
                                    foreach ($params_url as $puk => $puv) {
                                        $paramNameValuePair[str_replace(array('[[', ']]'), '', $puk)] = $puv;
//                                        if(!is_array($puv) && !(is_a($puv, '\stdClass'))){
                                        if (!is_object($puv)) {
                                            $paramsInUrl['[[' . $puk . ']]'] = $puv;
                                        }
                                    }
                                    if (isset($value['encode_ui_sref_params']['db_encode']) && ($value['encode_ui_sref_params']['db_encode'] == true)) {
                                        $options = array_key_exists('options', $value['encode_ui_sref_params']) ? $value['encode_ui_sref_params']['options'] : array();
                                        $encodedParamNameValuePair = $this->c->get('db_core_function_services')->setDbToken($paramNameValuePair, $options);
                                    } else {
                                        $encodedParamNameValuePair = $this->coreFunction->eservEncode(json_encode($paramNameValuePair));
                                    }
                                    $paramsInUrl['[[' . $paramName . ']]'] = $encodedParamNameValuePair;
//                                    preg_match_all("\[\[(.*?)\]\]", $value['url'], $paramsInUrl, PREG_PATTERN_ORDER);
                                    $pageURL = str_replace(array_keys($paramsInUrl), array_values($paramsInUrl), $value['url']);
                                } else {
                                    $pageURL = str_replace(array_keys($params_url), array_values($params_url), $value['url']);
                                }
                            } else {
                                $pageURL = $value['url'];
                            }
                        } else {
                            $pageURL = $value;
                        }

                        array_push($add_tag_attr, $key . '="' . $pageURL . '"');
                        break;
                    default:
                        array_push($add_tag_attr, $key . '="' . $value . '"');
                        break;
                }
            }
        }

        return $add_tag_attr;
    }

    public static function formatDataTablesColumnsArray($cols = array(), $container = false) {
        $json_array = array();

        $i = 0;

        foreach ($cols as $key => $value) {
            if (!is_array($value)) {
                $json_array[$i] = array(
                    'sTitle' => ucfirst($value)
                );
            } else {
                if (isset($value['options'])) {
                    $opt = $value['options'];
                    if ($container) {
                        $json_array[$i] = array(
                            'sTitle' => $container ? ($container->get('translator')->trans($opt['header'], array(), $container->get('eserv_translation_services')->getFullEservDbTransDomain())) : $opt['header']
                        );
                    } else {
                        $json_array[$i] = array(
                            'sTitle' => $opt['header']
                        );
                    }

                    if (isset($opt['width']))
                        $json_array[$i]['sWidth'] = $opt['width'];
                    if (isset($opt['css_class']))
                        $json_array[$i]['sClass'] = $opt['css_class'];
                    if (isset($opt['sortable']))
                        $json_array[$i]['bSortable'] = $opt['sortable'];
                    if (isset($opt['sType']))
                        $json_array[$i]['sType'] = $opt['col_type'];
                    if (isset($opt['visible']))
                        $json_array[$i]['bVisible'] = $opt['visible'];
                    if (isset($opt['col_name'])) {
                        $json_array[$i]['sName'] = $opt['col_name'];
                    } else {
                        $detailsBtnArr = array(
                            'details_btn',
                            'details_btn1',
                            'details_btn2',
                            'details_btn3',
                            'details_btn4',
                            'details_btn5',
                        );
                        if (!in_array($key, $detailsBtnArr)) {
                            $json_array[$i]['sName'] = $key;
                        }
                    }
                } else {
                    $json_array[$i] = array(
                        'sTitle' => ucfirst($key)
                    );
                }
            }

            $i++;
        }

        return json_encode($json_array);
    }

    public function buildURLParamsArray($RowData, $params = array()) {

        $res = array();

        if (is_array($params) && count($params) > 0) {
            foreach ($params as $key => $value) {
                if (!is_array($value)) {
                    if ($key !== 'static') {
                        $res[$key] = $RowData[$value];
                    }
                } else {
                    if ($key === 'static') {
                        foreach ($value as $v_k => $v_v) {
                            $res[$v_k] = $v_v;
                        }
                    }
                }
            }
        }

        if (isset($params['fixed_params'])) {
            foreach ($params['fixed_params'] as $p_k => $p_v) {
                $res[$p_k] = $p_v;
            }
        }

        return $res;
    }

    protected function getAllAvailableFilters($sEcho, $data) {
        $available_filters = array();
        $all_filters = array();
        $missing_filters = array();

        $bSearchables = array();
        $sSearchs = array();

        $aColumns = $data['aColumns'];
        $request = $data['request'];
        $col_filters = $data['col_filters'];

        $cols_size = count($aColumns);

        for ($i = 0; $i < $cols_size; $i++) {
            $bSearchables[$i] = $request->get('bSearchable_' . $i);
            $sSearchs[$i] = $request->get('sSearch_' . $i);
            if (isset($col_filters['tabs'])) {
                foreach ($col_filters['tabs'] as $t_k => $t_v) {
                    if (isset($t_v['fields'])) {
                        if (is_array($t_v['fields'])) {
                            foreach ($t_v['fields'] as $f_k => $f_v) {
                                $f_k = strtolower($f_k);
                                if (!in_array($f_k, $available_filters)) {
                                    $available_filters[$f_k] = is_array($f_v) ? $f_v['label'] : $f_v;
                                }
                            }

                            if (array_key_exists($aColumns[$i], $t_v['fields'])) {
                                if (isset($bSearchables[$i]) && $bSearchables[$i] == "true" && $sSearchs[$i] != '') {
                                    $field_filter = $t_v['fields'][$aColumns[$i]];
                                    $all_filters[$aColumns[$i]] = $field_filter;
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach ($available_filters as $av_k => $av_v) {
            $av_k = strtolower($av_k);
            if (!in_array($av_k, $aColumns)) {
                array_push($missing_filters, $av_v);
            }
        }

        if (count($missing_filters) > 0) {
            if ($this->c->hasParameter('show_dt_missing_filter_cols') && $this->c->getParameter('show_dt_missing_filter_cols')) {
                $this->showTableError($sEcho, 'The following filters have no columns set!<br />' . (implode('<br />', array_values($missing_filters))) . '<br />');
            }
        }

        return array(
            'all_filters' => $all_filters,
            'missing_filters' => $missing_filters
        );
    }

    public function showTableError($sEcho, $error) {
        $output = array(
            "sEcho" => intval($sEcho),
            "TableError" => $error,
            "iTotalRecords" => 0,
            "iTotalDisplayRecords" => 0,
            "aaData" => array()
        );

        echo json_encode($output);
        die();
    }

    public function getDefaultColumns($cols) {
        $detailsBtnArr = $this->detailsButtonsArray;
        $dc = array();
        $jsn_dec = json_decode($cols, true);
        foreach ($jsn_dec as $k => $v) {
            if (is_array($v)) {
                if (array_key_exists('bVisible', $v)) {
                    if (1 == $v['bVisible'] || true == $v['bVisible']) {
                        $dc[] = array_key_exists('sName', $v) ? $v['sName'] : '';
                    }
                } else {
                    $dc[] = array_key_exists('sName', $v) ? $v['sName'] : '';
                }
            }
        }
        return $dc;
    }

    public function DrawTable($id, $data = array()) {

        $Source = $data['source_url'];
        $aoColumns = is_array($data['columns']) ? self::formatDataTablesColumnsArray($data['columns'], $this->c) : $data['columns'];
        $defaultColumnsString = rtrim(implode(',', $this->getDefaultColumns($aoColumns)), ',');

        $filterId = (isset($data['filtering']['tabs'][0]['id']) && $data['filtering']['tabs'][0]['id'] ? $data['filtering']['tabs'][0]['id'] : false);
        $focusColumn = ((false !== $filterId && isset($data['filtering']) && isset($data['filtering']['focus_column'])) ? $filterId . '_' . $data['filtering']['focus_column'] : false);
        $foscusJs = (false !== $focusColumn ? "$('#$focusColumn').focus()" : "$('#table_filtering_$id input:first').focus()");
        $searchBtnClick = "$('.search_table_dataTableVar_" . $id . "_trigger:first').trigger('click')";

        if (!isset($data['filtering']) || !$data['filtering']) {
            if (is_array($this->dataTableConfig) && array_key_exists('pre_load_data', $this->dataTableConfig)) {
                $pre_load_data = $this->dataTableConfig['pre_load_data'] ? 1 : 0;
            } else {
                $pre_load_data = '1';
            }
        } else if (isset($data['filtering']['pre_load_data'])) {
            if (true === $data['filtering']['pre_load_data']) {
                $pre_load_data = '1';
            } else {
                $pre_load_data = '0';
            }
        } else {
            if (is_array($this->dataTableConfig) && array_key_exists('pre_load_data', $this->dataTableConfig)) {
                $pre_load_data = $this->dataTableConfig['pre_load_data'] ? 1 : 0;
            } else {
                $pre_load_data = '0';
            }
        }
        if (isset($data['pre_load_data'])) {
            if ($data['pre_load_data'] == true) {
                $pre_load_data = '1';
            } else {
                $pre_load_data = '0';
            }
        }
        $varSearchAfterInitialising = " var searchAfterInitialising = false; ";
        if (isset($data['search_after_initialising'])) {
            if (true === $data['search_after_initialising']) {
                $varSearchAfterInitialising = " var searchAfterInitialising = true; ";
            }
        }

        $dtButtons = '';
        $dtButtonsArray = array();

        $enableColVisibilityBtn = false;

        if (is_array($this->dataTableConfig) && array_key_exists('enable_col_visibility_btn', $this->dataTableConfig)) {
            $enableColVisibilityBtn = $this->dataTableConfig['enable_col_visibility_btn'];
            if (array_key_exists('use_col_visibility_btn', $data)) {
                $enableColVisibilityBtn = $data['use_col_visibility_btn'];
            }
        } else {
            if (array_key_exists('use_col_visibility_btn', $data)) {
                $enableColVisibilityBtn = $data['use_col_visibility_btn'];
            }
        }

        $clearLocalStorage = false;
        if (is_array($this->dataTableConfig) && array_key_exists('clear_local_storage', $this->dataTableConfig)) {
            $clearLocalStorage = ($this->dataTableConfig['clear_local_storage'] == true) ? true : false;
        }
        $jsClearLocalStorage = $clearLocalStorage ? 'Y' : 'N';

        if ($enableColVisibilityBtn) {
            $tableColumns = is_array($data['columns']) ? $data['columns'] : array();
            $i = 0;
            $columnsWithToggle = array();
            foreach ($tableColumns as $tcVal) {
                if (!(isset($tcVal['options']['toggle_visiblilty']) && $tcVal['options']['toggle_visiblilty'] == false)) {
                    $columnsWithToggle[$i] = $tcVal['options']['header'];
                }
                $i++;
            }
            asort($columnsWithToggle);
            $columnsWithToggleVisiblilty = array();
            foreach ($columnsWithToggle as $colIdx => $colHeader) {
                $columnsWithToggleVisiblilty[] = $colIdx;
            }
            $colvisColumns = ", columns:" . json_encode($columnsWithToggleVisiblilty);
            array_push($dtButtonsArray, "{
                extend: 'colvis',
                text: 'Custom Columns',
                className: 'btn btn-default pull-right extra_btn'
                $colvisColumns
            }");
        }

        $defaultShowFilter = false;
        $showHideFilter = false;
        if (array_key_exists('filtering', $data)) {
            if (is_array($data['filtering']) && !empty($data['filtering'])) {
                if (is_array($this->dataTableConfig) && !empty($this->dataTableConfig)) {
                    if (array_key_exists('enable_show_hide_filter', $this->dataTableConfig)) {
                        $showHideFilter = $this->dataTableConfig['enable_show_hide_filter'];
                        if ($showHideFilter === true) {
                            if (array_key_exists('show_hide_filter', $data['filtering'])) {
                                $showHideFilter = $data['filtering']['show_hide_filter'];
                            }
                        }
                    }
                    if (array_key_exists('default_show_filter', $data['filtering'])) {
                        $defaultShowFilter = $data['filtering']['default_show_filter'];
                    }
                }
            }
        }

        $callFunctionToHideFilter = '';
        $varShowHideFilter = " var showHideFilter_$id = false; ";
        $hasFilters = (isset($data['filtering']['tabs'][0]['fields']) && !empty($data['filtering']['tabs'][0]['fields']) ) ? true : false;
        if ($hasFilters) {
            if ($showHideFilter === true) {
                if ($defaultShowFilter === true || $pre_load_data == 0) {
                    $btnLabel = 'Hide Filters';
                    $callFunctionToHideFilter = " ToggleShowHideFilters('$id', true);";
                } else {
                    $btnLabel = 'Show Filters';
                    //                $callFunctionToHideFilter = " ToggleShowHideFilters('$id', false);";
                }
            }
            if ($showHideFilter === true) {
                $varShowHideFilter = " var showHideFilter_$id = true; ";
                array_push($dtButtonsArray, "{
                    text: 'Show Filters',
                    className: 'btn btn-default pull-right extra_btn table_filtering_$id',
                    action: function ( e, dt, node, config ) {
                        ToggleShowHideFilters('$id');
                    }
                }");
            }
        }

        $backEndSearch = array_key_exists('back_end_search', $data) ? ($data['back_end_search'] == true ? true : false) : false;
        $showBackEndDataTableBlankMessage = '';
        $hideBackEndDataTableBlankMessage = '';

        if ($backEndSearch) {
            array_push($dtButtonsArray, "{
                text: 'Output Options',
                className: 'btn btn-default pull-right extra_btn table_output_options_$id'
            }");
            $showBackEndDataTableBlankMessage = "$('.quickBackendSearchFormID .eserv_container_form_errors').html('<div id=\"quickBackendSearchFormID_{$id}_error\" "
                    . "class=\"app_main_alerts_area eserv_alert alert alert-warning alert-dismissable\" style=\"\"><span class=\"close\" data-dismiss=\"alert\">×</span>"
                    . "<div class=\"icon\"><i class=\"fa fa-exclamation-triangle\"></i></div><strong class=\"\">No results found.</strong><div class=\"clearfix\"></div></div>');"
                    . "$('.quickBackendSearchFormID .eserv_container_form_errors').show();";
            $hideBackEndDataTableBlankMessage = "$('.quickBackendSearchFormID .eserv_container_form_errors').hide()";
        }

        $bVisible_cols = array();
        $dtOutputCols = array();
        $formattedDtOutputCols = array();
        $json_dec = json_decode($aoColumns, true);

        foreach ($json_dec as $k1 => $v1) {
            if (array_key_exists('sName', $v1)) {
                $dtOutputCols[] = $v1['sName'];
            }
            if (!array_key_exists('bVisible', $v1) || (array_key_exists('bVisible', $v1) && $v1['bVisible'] == true)) {
                if (array_key_exists('sName', $v1)) {
                    $bVisible_cols[] = $v1['sName'];
                }
            }
        }


        foreach ($dtOutputCols as $k => $v) {
            if (!ctype_lower($v)) {
                $formattedDtOutputCols[] = $this->c->get('core_function_services')->from_camel_case($v);
            } else {
                $formattedDtOutputCols[] = $v;
            }
        }

        $outputOptions = (key_exists('output_options', $data)) ? $this->prepareOutputOptions($id, $data['output_options'], $dtOutputCols, $aoColumns) : '';
        $is_output_options_defined = (key_exists('output_options', $data)) ? true : false;

        $implode_frmt_cols = implode(',', $dtOutputCols);

        $params = isset($data['extra_params']) ? $data['extra_params'] : array();
        $modal_title = isset($data['modal_title']) ? $data['modal_title'] : '';

        $include_history_toggle = array_key_exists('include_history_toggle', $data) && $data['include_history_toggle'] ? true : false;

        $filtering_data = $this->getTableFiltering($id, $data, $bVisible_cols, $is_output_options_defined, $include_history_toggle);

        $show_hide_checkboxes = $filtering_data['options']['show_hide_checkboxes'];
        if ($show_hide_checkboxes) {
            $varShowHideCheckboxes = " var showHideCheckboxes_$id = true;";
        } else {
            $varShowHideCheckboxes = " var showHideCheckboxes_$id = false;";
        }
        $dataTablesParams = $this->buildDataTableExtraParams($params);

        $aaInitialSorting = '';
        if (isset($data['disable_initial_sorting']) && $data['disable_initial_sorting']) {
            $aaInitialSorting = '"aaSorting": [],';
        } else {
            if (isset($data['initial_sorting_column']) && is_array($data['initial_sorting_column'])) {
                $initialSortingColumn = $data['initial_sorting_column'];
                if (array_key_exists('column', $initialSortingColumn)) {
                    $aaInitialSorting = '"aaSorting": [[ ' . (int) $data['initial_sorting_column']['column'] . ' , "' . $data['initial_sorting_column']['direction'] . '" ]],';
                } else {
                    $aaSortStr = '';
                    foreach ($initialSortingColumn as $key => $colArray) {
                        $aaSortStr .= '[' . (int) $colArray['column'] . ' , "' . $colArray['direction'] . '" ],';
                    }
                    if (!empty($aaSortStr)) {
                        $aaSortStr = rtrim($aaSortStr, ",");
                        $aaInitialSorting = '"aaSorting": [' . $aaSortStr . '],';
                    }
                }
            }
        }

        $enableDtBtns = ($enableColVisibilityBtn || $showHideFilter) ? true : false;

        $enable_paging = isset($data['paging']) ? '"paging": ' . ($data['paging'] ? 'false' : 'false') . ',' : '"paging": true,';
        $iDisplayLength = isset($data['iDisplayLength']) ? $data['iDisplayLength'] : 10;
        $scroll_x = isset($data['scroll_x']) ? '"scrollX": "' . $data['scroll_x'] . '",' : '';
        $scroll_y = isset($data['scroll_y']) ? '"scrollY": "' . $data['scroll_y'] . '",' : '';
        $scrollCollapse = (isset($data['scroll_collapse']) && $data['scroll_collapse']) ? '"scrollCollapse": true,' : '';

        $fnRowCallback = isset($data['row_callback']) ? $data['row_callback'] : '';
        $fnDrawCallback = isset($data['draw_callback']) ? $data['draw_callback'] : '';
        $ajaxCallback = isset($data['ajax_callback']) ? $data['ajax_callback'] : '';
        $bindScript = isset($data['bind_script']) ? $data['bind_script'] : '';
        $table_extra_css_classes = $this->c->hasParameter('dataTable_extra_css_classes') ? $this->c->getParameter('dataTable_extra_css_classes') : 'table-striped table-hover table-bordered';
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $tableAttributes = '';
        foreach ($attributes as $attKey => $attVal) {
            if ($attKey == 'table') {
                foreach ($attVal as $atK => $atV) {
                    $tableAttributes .= $atK . '="' . $atV . '" ';
                }
            }
        }

        $dtButtonsArray = $this->addAppExtraBtns($dtButtonsArray, $data);

        if ($enableDtBtns) {
            $btnsText = implode(',', $dtButtonsArray);
            $dtButtons = "buttons: { buttons: [$btnsText],dom: {
                button: {
                    tag: 'button',
                    className: 'dt-button',
                    active: 'active',
                    disabled: 'disabled'
                },
                buttonLiner: {
                    tag: 'span',
                    className: ''
                }
            }},";
        }

        $bFiltering = $this->table_filters ? '"sDom" : \'<"top"l>' . ($enableDtBtns ? 'B' : '') . 'rt<"bottom"ip><"clear">\',' : '';

        $AutoSave = $this->table_filters ? 'true' : 'false';

        $filter_tabs = $this->table_filters ? '$("#dataTableVar_' . $id . '_filter_tabs").tab();' : '';

        $show_label = 'Show';
        $rows_label = 'Rows';
        $search_label = 'Search';
        $sZeroRecords = 'No data available in table';
        $sInfoEmpty = 'Showing 0 to 0 of 0 entries';
        $sInfo = 'Showing _START_ to _END_ of _TOTAL_ entries';
        $sInfoFiltered = ' (filtered from _MAX_ total entries)';

        $sFirst = 'First';
        $sLast = 'Last';
        $sNext = 'Next';
        $sPrevious = 'Previous';

        $showPageIfExists = false;
        if (is_array($this->dataTableConfig) && !empty($this->dataTableConfig)) {
            if (array_key_exists('auto_show_pagination', $this->dataTableConfig)) {
                $showPageIfExists = $this->dataTableConfig['auto_show_pagination'];
            }
        }
        $showPageIfExistsVar = 'var showPageIfExists=false;';
        if ($showPageIfExists === true) {
            $showPageIfExistsVar = 'var showPageIfExists=true;';
        }

        if ($this->c->hasParameter('app_translation')) {
            $domain = $this->c->get('eserv_translation_services')->getFullEservDbTransDomain();

            $show_label = $this->c->get('translator')->trans("SHOW_WORDING", array(), $domain);
            $rows_label = $this->c->get('translator')->trans("ROWS_WORDING", array(), $domain);
            $search_label = $this->c->get('translator')->trans("SEARCH_WORDING", array(), $domain);

//            $sInfoEmpty = 'Showing 0 to 0 of 0 entries';
            $sZeroRecords = $this->c->get('translator')->trans("NO_DATA_AVAILABLE", array(), $domain);

            $sInfo = $this->c->get('translator')->trans("RECORD_COUNTER", array(), $domain);
//            $sInfoFiltered = ' (filtered from _MAX_ total entries)';

            $sFirst = $this->c->get('translator')->trans("FIRST_BUTTON", array(), $domain);
            $sLast = $this->c->get('translator')->trans("LAST_BUTTON", array(), $domain);
            $sNext = $this->c->get('translator')->trans("NEXT_BUTTON", array(), $domain);
            $sPrevious = $this->c->get('translator')->trans("PREV_BUTTON", array(), $domain);
        }

        if ($this->c->hasParameter('datatable_absolute_url') && true === $this->c->getParameter('datatable_absolute_url')) {
            $Source = $this->c->get('core_function_services')->getFullHost() . $Source;
        }

        $preloaderMsg = '(typeof PreloaderImagePath != \'undefined\' ? \'<img alt="Loading data... Please wait" src="\' + PreloaderImagePath + \'" />\' : \'Processing...\')';
        $fullPreloader = (is_array($this->dataTableConfig) && array_key_exists('full_preloader', $this->dataTableConfig)) ? $this->dataTableConfig['full_preloader'] : false;
        $altLoadingJS = '';
        $showFullPreloader = '';
        $hideFullPreloader = '';
        if ($fullPreloader) {
            $preloaderMsg = "''";
            $altLoadingJS = '$("#dataTables_and_Filters_' . $id . ' .wrap_datatble_overflow")
                    .append("<div class=\"clearfix\"></div>")
                    .prepend("<div class=\"loading_block\"><img alt=\"Loading data... Please wait\" src=\"" + PreloaderImagePath + "\" /><div class=\"cancel-btn\"><a href=\"javascipt:;\" class=\"cancel-dt-request\" data-requestid=\"' . $id . '\">Cancel</a></div></div>");';
            $showFullPreloader = "setTimeout(function(){ $('#dataTables_and_Filters_{$id} .wrap_datatble_overflow .loading_block').show(); }, 0);";
            $hideFullPreloader = "setTimeout(function(){ $('#dataTables_and_Filters_{$id} .wrap_datatble_overflow .loading_block').hide(); }, 0);";
        }

        $disallowNullSearchEnabled = 'No';
        if ($this->c->hasParameter('datatable_disallow_null_search_enabled') && true === $this->c->getParameter('datatable_disallow_null_search_enabled')) {
            $disallowNullSearchEnabled = 'Yes';
        }
        if (array_key_exists('filtering', $data)) {
            if (is_array($data['filtering']) && !empty($data['filtering'])) {
                if (array_key_exists('prevent_null_search', $data['filtering'])) {
                    $disallowNullSearchEnabled = ($data['filtering']['prevent_null_search'] == true) ? 'Yes' : $disallowNullSearchEnabled;
                }
            }
        }

        $table_script = <<<_Q_
          
           <span class="dt_area" id="dataTables_and_Filters_$id">
             {$filtering_data['filtering_html']}
             $outputOptions
             
             <div id="contents_wrapper_$id">
             <input id="dtq_contents_wrapper_$id" type="hidden" value="123" />  
             <input id="print_dtq_contents_wrapper_$id" type="hidden" value="123" /> 
             <input id="default_visible_cols_$id" type="hidden" value="" /> 
             <input id="all_cols_$id" type="hidden" value="$implode_frmt_cols" /> 
             <table id="$id" cellpadding="0" cellspacing="0" border="0" class="datatable table $table_extra_css_classes" $tableAttributes ></table>
             </div>
        </span>
        <div class="clearfix"></div>
        <input type="hidden" id="qbs_$id" value="N" />
        <input type="hidden" id="sqw_$id" value="" />
        <input type="hidden" id="sqw_q_$id" value="" />
        <input type="hidden" id="sqw_srch_$id" value="" />
        <script type="text/javascript">
            //localStorage.setItem( "DataTables_{$id}_clear_" + window.location.pathname, "0" );
            var dataTable_ajax_request_$id;
            var dataTable_ajax_source_$id = "$Source";
            var getTableData_$id = "$pre_load_data";
            var dtClearLocalStorage_$id = "$jsClearLocalStorage";
            var dtSearchXML_$id = null;
            var searchBtnPressed = false;
            $varSearchAfterInitialising
            $varShowHideCheckboxes
            $varShowHideFilter
            var original_cols_$id = $aoColumns;
            var cols_vals_$id = [];
            var filters_data_$id = [];
            var exact_match_red_$id = false;
            var {$id}_filters = [];
            $showPageIfExistsVar
            
            var saveState = $AutoSave;
            $filter_tabs
            var dataTableVar_$id = $('#$id').dataTable({
                "columns": $aoColumns,
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": dataTable_ajax_source_$id,
                "sPaginationType": "full_numbers",
                "asStripeClasses": null,
                "iDisplayLength": $iDisplayLength,
                //"colReorder": true,
                $scroll_x
                $scroll_y
                $scrollCollapse
                $enable_paging
                $aaInitialSorting
                $bFiltering
                $dtButtons
                "oLanguage": {
                    "sProcessing": $preloaderMsg,
                    "sInfoFiltered": "$sInfoFiltered",
                    "oPaginate": {
                        "sFirst": "$sFirst",
                        "sLast": "$sLast",
                        "sNext": "$sNext",
                        "sPrevious": "$sPrevious"
                    },
                    "sZeroRecords": "$sZeroRecords",
                    "sInfoEmpty": "$sInfoEmpty",
                    "sInfo": "$sInfo",
                    "sLengthMenu": '<span class="desktop_inline_text">$show_label</span> _MENU_ <span class="desktop_inline_text">$rows_label</span>'
                },
                "fnServerData": function(sSource, aoData, fnCallback) {
                    
                    var cleared_$id = localStorage.getItem( "DataTables_{$id}_clear_" + window.location.pathname );
                    if(dtClearLocalStorage_$id == 'Y' ){
                        cleared_$id = 1;
                    }
                    if((searchAfterInitialising == true) && (searchBtnPressed == false)){
                        getTableData_$id = "0";
                    }
                    if (getTableData_$id === "1" || cleared_$id === "0") {
                        if (typeof dataTable_ajax_request_$id != "undefined") {
                             dataTable_ajax_request_$id.abort();
                        }
                        $showFullPreloader
                        dataTable_ajax_request_$id = dtAjaxRequests['$id'] = $.ajax({
                            url: dataTable_ajax_source_$id,
                            type: 'POST',
                            dataType: 'json',
                            data: aoData,
                            success: function (json) {
                                $hideFullPreloader
                                if(json.XML != 'undefined'){
                                    dtSearchXML_$id = json.XML;
                                }                                
                                $('#dtq_contents_wrapper_$id').val(json.CommsQ);  
                                $('#print_dtq_contents_wrapper_$id').val(json.PrintQ);   
                                $('#sqw_q_$id').val(json.SqwQ);  
                                if (typeof json.TableError !== 'undefined') {
                                    var error = {
                                        status: 'Error',
                                        statusText: json.TableError,
                                        responseText: 'TableError'
                                    };                                
                                    PageMainUserMessage(true, error, true, {type: 'dataTables', selector: '#$id' + '_processing'});
                                } else {
                                    $('#$id' + '_wrapper').find('.datatables_userMsg').remove();                                
                                }
                            
                                if (typeof json.sqwId !== 'undefined' && json.sqwId != '') {
                                    $('#sqw_$id').val(json.sqwId);
                                }
                                if(searchBtnPressed == false){
                                     if (typeof json.sqwSrchId !== 'undefined' && json.sqwSrchId != '') {
                                        $('#sqw_srch_$id').val(json.sqwSrchId);
                                    }
                                }
                                
                                fnCallback(json);
                                
                                if (typeof jsonCustomCallback == 'function') {                                    
                                    jsonCustomCallback(json);
                                }
                                if(json.iTotalDisplayRecords == 1 && typeof json.exact_match_redirect_url != 'undefined' && exact_match_red_$id == true){
                                    exact_match_red_$id = false;
                                    toggleMainLoader('Redirecting..', true);
                                    window.location = json.exact_match_redirect_url;
                                }else if(json.iTotalDisplayRecords > 0){
                                    $hideBackEndDataTableBlankMessage
                                    $('.de_{$id}_btn').removeAttr('disabled');
                                    $('.toggle_output_opts_btn_$id').removeAttr('disabled');
                                    localStorage.setItem( "DataTables_{$id}_clear_" + window.location.pathname, "0");
                                    if(showPageIfExists === true){
                                        if (json.iTotalDisplayRecords > json.aaData.length) {
                                            $('#$id' + '_paginate').show()
                                        } else {
                                            $('#$id' + '_paginate').hide();
                                        }
                                    }
                                    $('#{$id}_wrapper .show_on_data').show();
                                    $('#{$id}_wrapper button.btn_enable_on_data').removeAttr('disabled');
                                    
                                    if($('#save_search_btn_$id').length){
                                        $('#save_search_btn_$id').prop('disabled', false);
                                        $('#save_search_btn_$id').removeClass('disabled');
                                    }
                                    if(json.iTotalDisplayRecords == 1){
                                        var exactMatchRedirectionCount = $('#$id').find('.exact-match-redirection').length;
                                        if(exactMatchRedirectionCount === 1){
                                            toggleMainLoader('Redirecting..', true);
                                            $('#$id').find('.exact-match-redirection').trigger("click");
                                        }
                                    }
                                }else{ 
                                    $('.de_{$id}_btn').attr('disabled','disabled');
                                    $('.toggle_output_opts_btn_$id').attr('disabled','disabled');
                                    $("#output_opts_container_$id").slideUp(200);
                                    if(showPageIfExists === true){
                                        $('#$id' + '_paginate').hide(); 
                                    }
                                    $('#{$id}_wrapper .show_on_data').hide();
                                    $('#{$id}_wrapper button.btn_enable_on_data').attr('disabled', 'disabled');
                                    $showBackEndDataTableBlankMessage
                                    
                                    if($('#save_search_btn_$id').length){
                                        $('#save_search_btn_$id').prop('disabled', true);
                                        $('#save_search_btn_$id').addClass('disabled');
                                    }
                                }
                           
                                if (typeof PrepareMultiResultCols == 'function'){ PrepareMultiResultCols('#$id'); }
                                $ajaxCallback
                            },
                            error: function(jqXHR, exception) {
                                $hideFullPreloader
                                if (jqXHR.status === 403) {
                                    if (typeof HandleNotAuthenticated == 'function'){ HandleNotAuthenticated(true); }
                                }
                                else if(jqXHR.status != 0){                                    
                                    alert('Error : ' + jqXHR.statusText + ' (Code : ' + jqXHR.status + ')');
                                }
                            }

                        });
                     } else {
                        $hideFullPreloader
                        fnCallback({
                            "iTotalRecords":"0",
                            "iTotalDisplayRecords":"0",
                            "aaData":[],"SQLQuery":"",
                            "CommsQ":"",
                            "PrintQ":""
                        });
                     
                        $('.de_{$id}_btn').attr('disabled','disabled');
                        $('.toggle_output_opts_btn_$id').attr('disabled','disabled');
                        $("#output_opts_container_$id").slideUp(200);
                                
                        $('#{$id}_wrapper .show_on_data').hide();
                        $('#{$id}_wrapper button.btn_enable_on_data').attr('disabled', 'disabled');
                    }
                },
                "fnServerParams": function ( aoData ) {
                    aoData.push(
                        $dataTablesParams
                    );
                    aoData.push({"name": "qbs", "value": $('#qbs_$id').val()});
                    aoData.push({"name": "sqwId", "value": $('#sqw_$id').val()});
                    aoData.push({"name": "sqwSrchId", "value": $('#sqw_srch_$id').val()});
                    aoData.push({"name": "includeHistory", "value": ($('#include_history_$id') && $('#include_history_$id').is(':checked') ? 'Y': 'N' )});
                },
                "bStateSave": $AutoSave,
                "fnStateSave": function (oSettings, oData) {
                    localStorage.setItem( "DataTables_{$id}_" + window.location.pathname, JSON.stringify(oData) );
                },
                "fnStateLoad": function (oSettings) {  
                    var storedData = JSON.parse(localStorage.getItem("DataTables_{$id}_" + window.location.pathname));
                    return  storedData;
                },
//                "colReorder": {
//                    "iFixedColumns": 1,
//                    "fnReorderCallback": function() {
//                        console.log('fnReorderCallback');
//                        if ((typeof AJCompile != 'undefined' && AJCompile) && (typeof RootScope != 'undefined' && RootScope)) {
//                            AJCompile($('#$id'))(RootScope);
//                        }
//                    }
//                },
                "createdRow": function ( row, data, index ) {
                    $fnRowCallback
                    if ((typeof AJCompile != 'undefined' && AJCompile) && (typeof RootScope != 'undefined' && RootScope)) {
                        AJCompile(row)(RootScope);
                    }
                    if (typeof EnableMultipleCheckAll == 'function') {
                        EnableMultipleCheckAll([{type: 'dt', selector: '#dataTables_and_Filters_$id table'}, {type: 'c', selector: '#output_opts_container_$id'}]);
                    }
                     
                    if (typeof fnDrawCallbackExtraFunctions == 'function') {
                        fnDrawCallbackExtraFunctions('#$id');
                    }
                    if (typeof fnPreCheckFunctions == 'function') {
                        fnPreCheckFunctions('#$id');
                    }                     
                    if (typeof fnDrawCallbackCustomFunction == 'function') {
                        //Do not define this function in app.js or eserv_functions.js define only in twig files where it is necessary
                        fnDrawCallbackCustomFunction('$id', row, data, index); 
                    }
                },
                "fnDrawCallback": function (oSettings) {
                    if (typeof prepareDTAppModal == 'function') {
                        prepareDTAppModal('dataTables_and_Filters_$id');
                    }
                    if (typeof EnableMultipleCheckAll == 'function') {
                        EnableMultipleCheckAll([{type: 'dt', selector: '#dataTables_and_Filters_$id table'}, {type: 'c', selector: '#output_opts_container_$id'}]);
                    }
                    if (typeof fnDrawCallbackExtraFunctions == 'function') {
                        fnDrawCallbackExtraFunctions('#$id');
                    }                     
                    if (typeof fnPreCheckFunctions == 'function') {
                        fnPreCheckFunctions('#$id');
                    }                     
                    if (typeof enableDisableDTPrintButton == 'function') {
                        enableDisableDTPrintButton('$id'); //enable print_data_table button if record count is greater than zero else disable it
                    }
                    $('#$id .datatable-tooltip-info').mouseover(function (event) {
                        showDTToolTipInformation(dataTableVar_$id, $(this));
                    });
                    $fnDrawCallback
                    PrepareTooltips('#$id');
                            
                    if($('#save_search_btn_$id').length){
                        $('#save_search_btn_$id').prop('disabled', true);
                        $('#save_search_btn_$id').addClass('disabled');
                    }
                },
                "initComplete": function( settings, json ) {
                    if (typeof $("#dataTables_and_Filters_$id .multiselect").multiselect == 'function') {
                        $("#dataTables_and_Filters_$id .multiselect").multiselect({
                            includeSelectAllOption: true,
                            templates: {
                                li: '<li><a class="eserv_checkbox" href="javascript:void(0);"><label></label></a></li>',
                            }
                        });
                    }
                    if(showHideFilter_$id == false){
                        $('#table_filtering_$id').slideDown(200, function(){
                            var storedData = JSON.parse(localStorage.getItem("DataTables_{$id}_" + window.location.pathname));
                            //console.log('original_cols_$id: ', original_cols_$id);
                        });
                    }
                    if (typeof fnInitCallbackExtraFunctions == 'function') {
                        fnInitCallbackExtraFunctions('#dataTables_and_Filters_$id', '$id');
                    }
                    {$id}_filters = [];
                    {$filtering_data['filtering_js']}
                    $foscusJs;                    
                    
                    $('#table_filtering_$id ul.nav.nav-tabs li').click(function(){
                        var tmpHref = $(this).children('a').attr('href');    
                        setTimeout(function(){
                            $('#table_filtering_$id ' + tmpHref + ' input:first').focus();
                        },200);    
                    })

                    $bindScript

                    $('#table_filtering_$id, select2-search-field > input.select2-input').keydown(function(e) {
                        if (e.altKey) {
                            e.preventDefault();
                            var nextElm = $('#table_filtering_$id ul.nav.nav-tabs li.active').next();
                            if(nextElm.length > 0){
                                nextElm.children('a').trigger('click');
                                var tmp = $('#table_filtering_$id .tab-pane.active input:first');
                                tmp.focus();
                                if(!tmp.hasClass('hasDatepicker')){
                                    $('div#ui-datepicker-div').css('display','none');
                                }
                            }else{
                                $('#table_filtering_$id ul.nav.nav-tabs li:first').children('a').trigger('click');
                                var tmp = $('#table_filtering_$id .tab-pane.active input:first');
                                tmp.focus();
                                if(!tmp.hasClass('hasDatepicker')){
                                    $('div#ui-datepicker-div').css('display','none');
                                }
                            }                            
                        }
                        if(e.keyCode === 13){
                            e.preventDefault();
                            //if($(".select2-container.select2-container--default.select2-container--open").length === 0){ 
                                $searchBtnClick;                                
                            //}
                        } 
                     }); 
                    $('#default_visible_cols_$id').val('$defaultColumnsString');
                    $('.close-modal-on-click').click(function (){
                        $(this).parents('.modal').find('.modal-header').find('.btn-danger, .close').click();
                    });

                }
            });

            $('#$id').each(function() {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', '$search_label');
                search_input.addClass('form-control input-sm selectpicker');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.addClass('form-control input-sm selectpicker selectpicker_length_sel');
                
                datatable.closest('.dataTables_wrapper').find('.dataTable').addClass('table table-hover');
                
                if (typeof selectpicker == 'function'){
                    $('#dataTables_and_Filters_$id .selectpicker').selectpicker();
                }
                
                datatable.wrap('<div class="wrap_datatble_overflow"></div>');
                $altLoadingJS
                        
                if ($('#{$id}_wrapper .cancel-btn .cancel-dt-request').length > 0) {
                    setTimeout(function(){
                        $('#{$id}_wrapper .cancel-btn .cancel-dt-request').click(function(e){
                            e.preventDefault();
                            var dtId = $(this).data('requestid');
                            abortDTAJAXRequestById(dtId);
                        });
                    }, 0);
                }
            });
                            
            $('body').on('DOMNodeInserted', function(e) {
                $('.dt-button-collection .dt-button.buttons-columnVisibility').each(function(k, v){
                    $(this).addClass('mtl_class_' + k);
                });
                if ($('.dt-button-collection .dt-buttons-header').length <= 0) {
                    $('.dt-button-collection').prepend('<div id="close_dt_btns_$id" class="dt-buttons-header"><div class="pull-left"><h4>Select your columns</h4></div><button type="button" class="btn btn-danger pull-right finish">Finish</button><button type="button" class="btn btn-default pull-right all_columns">Toggle All</button><button type="button" class="btn btn-default pull-right col_defaults_btn_$id"><span class="mtl-btn-text">Defaults</span></button><div class="clearfix"></div></div>');
                    $('#close_dt_btns_$id button.finish').click(function(){
                        closeColVisDialog($(e.target));
                    });
                            
                    $('.col_defaults_btn_$id').click(function(){
                        resetExportCols("all_cols_$id","default_visible_cols_$id", "dataTables_and_Filters_$id", $(this).find('.mtl-btn-text'));
                    });
                    $('#close_dt_btns_$id button.all_columns').click(function(){
                        var selectorBtn = $(this);
                            
                        if (selectorBtn.hasClass('all_selected')) {
                            $('.dt-button-collection .dt-button.buttons-columnVisibility').each(function(){
                                if ($(this).hasClass('active')) {
                                    $(this).click();
                                }
                            });
                            selectorBtn.removeClass('all_selected');
                        } else {
                            $('.dt-button-collection .dt-button.buttons-columnVisibility').each(function(){
                                if (!$(this).hasClass('active')) {
                                    $(this).click();
                                    selectorBtn.addClass('all_selected');
                                }
                            });
                            selectorBtn.addClass('all_selected');
                        }
                    });
                }
            });
                            
////// TO DO: apply colReorder when we upgrade the datatables 
//            $('#$id').on('column-visibility.dt', function(e, settings, column, state ){
//                var dTable = $('#$id').dataTable();
//                vCols = new Array();
//                hCols = new Array();           
//                $.each(dTable.fnSettings().aoColumns, function(c){
//                    if(dTable.fnSettings().aoColumns[c].bVisible == true && dTable.fnSettings().aoColumns[c].idx != column){
//                        vCols = vCols.concat(dTable.fnSettings().aoColumns[c].idx);
//                    }else {
//                        hCols = hCols.concat(dTable.fnSettings().aoColumns[c].idx);
//                    }
//                });
//                vCols.splice(vCols.length-1, 0, column);
//                vCols = vCols.concat(hCols);
//                console.log(vCols);
//                var colReorder = new $.fn.dataTable.ColReorder(dTable);     
//                colReorder.fnOrder(vCols);
////                colReorder.fnOrder(
////                    colReorder.fnOrder().reverse()
////                );                            
////                var colReorder = new $.fn.dataTable.ColReorder(dTable, {
////                    "aiOrder": vCols
////                } );
//            });

            if (typeof ToggleShowHideFilters != 'function'){
                function ToggleShowHideFilters(tableId, show, animate) {
                    var targetFilterId = 'table_filtering_' + tableId;
                    var targetFilter = $('#' + targetFilterId);
                    var thisField = $('.' + targetFilterId);
                    var animation = (typeof animate == 'undefined' || (typeof animate != 'undefined' && animate)) ? 200 : 0;
                    if (typeof show == 'undefined') {
                        if(targetFilter.is(':visible')){
                            targetFilter.slideUp(animation);
                            thisField.html('Show Filters');
                            $('#qbs_form_container_' + tableId).slideDown(animation);
                        } else{
                            targetFilter.slideDown(animation);
                            thisField.html('Hide Filters');
                            $('#qbs_form_container_' + tableId).slideUp(animation);
                        }
                    } else {
                        if (show) {
                            targetFilter.slideDown(animation);
                            thisField.html('Hide Filters');
                            $('#qbs_form_container_' + tableId).slideUp(animation);
                        } else {
                            targetFilter.slideUp(animation);
                            thisField.html('Show Filters');
                            $('#qbs_form_container_' + tableId).slideDown(animation);
                        }
                    }
                }
            }

            $callFunctionToHideFilter
 
            if (typeof PageMainUserMessage != 'function'){
                function PageMainUserMessage(show, userMsg, dismissable, details, callback) {
                    var userMsgContainer = '';

                    if (details && typeof details === 'object') {
                        //alert(selector);
                        switch (details.type) {
                            case 'dataTables':
                                var cont = $(details.selector).parents('div').find('.datatables_userMsg');
                                if (cont.length > 0) {
                                    //alert('exists: ' + details.selector);
                                    userMsgContainer = cont;
                                } else {
                                    userMsgContainer = $('<div class="datatables_userMsg">My msg</div>').insertAfter(details.selector);
                                }
                                break;
                            default:
                                userMsgContainer = $('.page_main_userMsg');
                        }
                    } else {
                        userMsgContainer = $('.page_main_userMsg');
                    }

                    userMsgContainer.html('');

                    if (show) {
                        if (userMsg) {
                            var userMsg_status = userMsg.status;
                            var userMsg_msg = userMsg.statusText;
                            var mtl_err_code = userMsg.responseText;
                            var is_dismissable_text = '';
                            var is_dismissable_btn = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                            if (dismissable) {
                                is_dismissable = 'alert-dismissable';
                            }

                            var css_class = 'danger';
                            var css_icon = 'times-circle';

                            switch (userMsg_status) {
                                case 200:
                                    css_class = 'success';
                                    css_icon = 'ok-circle';
                                    break;
                            }
                            userMsgContainer
                                    .append('<div class="alert alert-' + css_class + ' ' + is_dismissable_text + '">' + is_dismissable_btn + '<div class="icon"><i class=" fa fa-' + css_icon + '"></i></div><div class="message">' + (userMsg_status != 200 ? userMsg_status + ': ' : '') + userMsg_msg + (userMsg_status != 200 ? ' - MTL Code: ' + mtl_err_code : '') + '</div><div class="clearfix"></div></div>').show();
                        }
                        toggleMainLoading(false);
                    } else {
                        userMsgContainer.hide();
                    }

                    if (typeof callback === 'function') {
                        callback();
                    }
                }
            }
            
            if (typeof toggleMainLoading != 'function'){
                function toggleMainLoading(show) {
                    if (show) {
                        $('#preloadingPage')
                                .html('')
                                .show();
                        $('#preloadingPageLong img').show();
                    } else {
                        $('#preloadingPage')
                                .html('')
                                .hide();
                        $('#preloadingPageLong img').hide();
                    }
                }
            }
            
            if (typeof clearTableFilter != 'function'){
                function clearTableFilter(dataTableVar, id) {
                            
                    getTableData_$id = "0";
                    localStorage.removeItem( "DataTables_{$id}_" + window.location.pathname );
                    localStorage.setItem( "DataTables_{$id}_clear_" + window.location.pathname, "1" );

                    DTClearFilters(dataTableVar, id);
                                         
                    if (typeof $("#dataTables_and_Filters_" + id + " .multiselect").multiselect == 'function'){
                        $("#dataTables_and_Filters_" + id + " .multiselect").multiselect('destroy');
                                        
                        $("#dataTables_and_Filters_" + id + " .multiselect").multiselect({
                            includeSelectAllOption: true,
                            templates: {
                                li: '<li><a class="eserv_checkbox" href="javascript:void(0);"><label></label></a></li>',
                            }
                        });
                    }
                    
                }
            }

            if (typeof resetFormErrors != 'function'){
                function resetFormErrors(block) {
                    if (typeof $.selectpicker == 'function') {
                        block.find('.selectpicker').selectpicker('refresh');
                    }
                    block.find('.form-group').each(function () {
                        if ($(this).hasClass('history-field')) {
                            $(this).remove();
                        } else {
                            $(this).removeClass('has-error');
                            $(this).find('.help-block').hide();
                            $(this).find('.history-field').remove();
                        }
                    });
                }
            }

            if (typeof dtShowHideCol != 'function'){
                function dtShowHideCol(dt, col_id, show, col_name, send_request) {
                    if(typeof send_request == 'undefined'){
                        dt.DataTable().columns( col_id ).visible( show );
                        //dt.fnSetColumnVis( parseInt(col_id), show );
                        checkUncheckExportCols(col_name, show);
                    }                    
                }
            }
                    
            if (typeof closeColVisDialog != 'function'){
                function closeColVisDialog() {
                    $('div.dt-button-background').click();
                }
            }
                            
            if (typeof disallowNullSearch != 'function'){
                function disallowNullSearch(tableId, disallowNullSearchEnabled) {
                    if (disallowNullSearchEnabled == 'Yes') {
                        var fieldValues = getDTFormValues(tableId);
                        if (fieldValues.length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    } else {
                        return false;
                    }
                }
            }
                            
            function search_$id(options) {
                var disallowSearch = disallowNullSearch('$id', '$disallowNullSearchEnabled');
                $('#qbs_$id').val((typeof options != 'undefined' && typeof options.qbs != 'undefined') ? options.qbs : 'N');
                searchBtnPressed = true;
                dataTableVar_{$id}.fnPageChange("first", false);
                exact_match_red_{$id} = true;
                getTableData_{$id} = "1";
                localStorage.setItem("DataTables_{$id}_clear_" + window.location.pathname, "0");
                if (typeof EservValidateBlock == "function") {
                    var validateErrors = EservValidateBlock($("#table_filtering_{$id}"));
                    if (!validateErrors) {
                        if (disallowSearch) {
                            generateEservAlert('Alert', 'Please enter search term', 'sm');
                        } else {
                            var table_{$id}_filters = [];
                            for (var i in {$id}_filters) {
                                table_{$id}_filters[i] = $("#" + {$id}_filters[i]).val();
                            }
                            dataTableVar_{$id}.fnMultiFilter(table_{$id}_filters);
                        }
                    }
                }
            }
            if(searchAfterInitialising == true){
               search_$id();
            }
        </script>
_Q_;
        return $table_script;
    }

    protected function addAppExtraBtns($dtButtonsArray, $data) {
        if (array_key_exists('extra_btns', $data)) {
            $extraBtnsArray = array();
            foreach ($data['extra_btns'] as $extraBtn) {
                array_push($extraBtnsArray, json_encode($extraBtn));
            }
            $extraBtns = implode(',', $extraBtnsArray);
            array_unshift($dtButtonsArray, $extraBtns);
        }

        return $dtButtonsArray;
    }

    protected function getTableFiltering($id, $data, $enabled_filters = null, $output_options = false, $include_history_toggle = false) {

        $show_hide_checkboxes = false;
        $column_keys = array();
        $config_param = true;

        if (is_array($this->dataTableConfig) && array_key_exists('show_hide_checkboxes', $this->dataTableConfig)) {
            $config_param = $this->dataTableConfig['show_hide_checkboxes'];
        } else {
            if (array_key_exists('filtering', $data) && is_array($data['filtering'])) {
                if (array_key_exists('show_hide_checkboxes', $data['filtering'])) {
                    $config_param = $data['filtering']['show_hide_checkboxes'];
                }
            }
        }

        if ($config_param) {
            if (is_array($data['columns'])) {
                $show_hide_checkboxes = true;
                $column_keys = array_keys($data['columns']);
            } else {
                if (array_key_exists('columns_keys', $data)) {
                    $show_hide_checkboxes = true;
                    $column_keys = $data['columns_keys'];
                }
            }
        }

        $this->table_filters = (isset($data['filtering']) && is_array($data['filtering'])) ? $data['filtering'] : false;

        $backEndSearch = array_key_exists('back_end_search', $data) ? ($data['back_end_search'] == true ? true : false) : false;

        $filtering_html = '';
        $filtering_js = '';

        if (is_array($this->table_filters) && (isset($this->table_filters['type']))) {
            $filtering_type = $this->table_filters['type'];

            $filters_have_date = false;
            $filters_have_lettercase = false;
            $filters_have_remove_spaces = false;
            $eservfieldExtraCss = false;
            $fieldRequired = false;
            $eserv_extra_validation_attributes = '';

            switch ($filtering_type) {
                case 'tabs':
                    $tabs = $this->table_filters['tabs'];
                    if (count($tabs) > 0) {
                        $filtering_html .= '<div class="eserv_form form-horizontal filtering_form" id="table_filtering_' . $id . '" style="display: none;">';

//                        $filtering_js .= 'var ' . $id . '_filters = [];';

                        $col_keys = array();

                        $tabs_headers = '<ul class="nav nav-tabs">';
                        $tabs_contents = '<div id="dataTableVar_' . $id . '_filter_tabs" class="tab-content">';

                        $tabs_counter = 0;

                        foreach ($tabs as $tab) {
                            $key = md5($id) . '_' . $tab['id'];
                            $active = $tabs_counter === 0 ? 'active' : '';
                            $tabHeader = $this->c->get('translator')->trans($tab['header'], array(), $this->c->get('eserv_translation_services')->getFullEservDbTransDomain());
                            $tabs_headers .= '<li class="' . $active . '"><a href=".tab_id_' . $key . '" data-toggle="tab">' . $tabHeader . '</a></li>';
                            $tabs_contents .= '<div id="' . $key . '" class="tab-pane tab_id_' . $key . ' ' . $active . '">'
                                    . '<fieldset>';
                            $trigger_id = $key . '_search_trigger';
                            $multiple = count($tab['fields']) > 1 ? true : false;

                            $tabs_counter++;

                            foreach ($tab['fields'] as $k => $field) {
                                array_push($col_keys, $k);

                                $field_id = $key . '_' . $k;
                                $field_name_only = $k;
                                $eserv_extra_validation = false;

                                $field_is_widget = isset($field['widget']) ? $field['widget'] : false;
                                $extraHtml = isset($field['options']['extra_html']) ? $field['options']['extra_html'] : '';
                                $isVisible = isset($field['options']['visible']) ? (($field['options']['visible'] == false ) ? false : true ) : true;
                                $extraAttribute = isset($field['options']['extra_attribute']) ? $field['options']['extra_attribute'] : array();
                                $extraAttributeHtml = '';
                                foreach ($extraAttribute as $attrKey => $attrVal) {
                                    $extraAttributeHtml .= $attrKey . '="' . str_replace('"', "'", $attrVal) . '" ';
                                }
                                $fieldValue = null;
                                if (!is_array($field)) {
                                    $field_label = $field;
                                } else {
                                    $field_label = $field['label'];
                                    $fieldValue = isset($field['data']) ? $field['data'] : $fieldValue;
                                    $eserv_extra_validation = isset($field['eserv_extra_validation']) ? $field['eserv_extra_validation'] : false;
                                }
                                if ($eserv_extra_validation) {
                                    $eserv_extra_validation_array = $this->buildExtraValidation($eserv_extra_validation, array(
                                        'filters_have_date' => $filters_have_date,
                                        'filters_have_lettercase' => $filters_have_lettercase,
                                    ));
                                    $eserv_extra_validation_attributes = $eserv_extra_validation_array['eserv_extra_validation_attributes'];
                                    $eservfieldExtraCss = $eserv_extra_validation_array['eservfieldExtraCss'];
                                    $fieldRequired = $eserv_extra_validation_array['fieldRequired'];
                                    $filters_have_date = $eserv_extra_validation_array['filters_have_date'];
                                    $filters_have_lettercase = $eserv_extra_validation_array['filters_have_lettercase'];
                                    $filters_have_remove_spaces = $eserv_extra_validation_array['filters_have_remove_spaces'];
                                } else {
                                    $eserv_extra_validation_attributes = '';
                                    $eservfieldExtraCss = false;
                                    $fieldRequired = false;
                                }
                                $inputGroupWidth = $show_hide_checkboxes ? 'col-lg-7 col-md-8 col-sm-12 col-xs-12' : 'col-lg-6 col-md-7 col-sm-8 col-xs-12';

                                $tabFieldHeader = $this->c->get('translator')->trans($field_label, array(), $this->c->get('eserv_translation_services')->getFullEservDbTransDomain());
                                $tabs_contents .= ''
                                        . '    <div class="form-group row" ' . ($isVisible ? '' : ' style="display: none;" ') . '>'
                                        . '      <label for="' . $field_id . '" class="col-sm-4 control-label' . ($fieldRequired ? ' required' : '') . '">' . $tabFieldHeader . '</label>'
                                        . '      <div class="col-sm-8">'
                                        . '        <div class="input-group ' . $inputGroupWidth . '">';

                                if ($field_is_widget) {
                                    switch ($field_is_widget['type']) {
                                        case 'dropdown':
                                            $selected_data = isset($field_is_widget['selected_data']) ? $field_is_widget['selected_data'] : array();
                                            $dataSourceUrl = '';
                                            if (isset($field_is_widget['data_source']['url']) && !empty($field_is_widget['data_source']['url'])) {
                                                $dataSourceUrl = $field_is_widget['data_source']['url'];
                                            }
                                            $based_on_values = array_key_exists('based_on_values', $field_is_widget) && is_array($field_is_widget['based_on_values']) ? true : false;
                                            $tabs_contents .= ''
                                                    . '          <select '
                                                    . '               ' . $eserv_extra_validation_attributes
                                                    . '               class="form-control col-sm-12 ' . $eservfieldExtraCss . ' " '
                                                    . '               data-style="btn-info" '
                                                    . '               name="' . $field_id . '_name"'
                                                    . '               data-dynamicfieldtype="dropdown"'
                                                    . (!empty($dataSourceUrl) ? ' data-source-url="' . $dataSourceUrl . '"' : '')
                                                    . ($based_on_values ? ' data-basedonvalues="' . htmlentities(json_encode($field_is_widget['based_on_values'])) . '" ' : '')
                                                    . '               data-default-value="' . htmlentities(json_encode($selected_data)) . '" '
                                                    . '               id="' . $field_id . '">';

                                            foreach ($field_is_widget['choices'] as $fc_k => $fc_v) {
                                                $tabs_contents .= '<option value="' . $fc_k . '"' . ( in_array($fc_k, $selected_data) ? ' selected="selected"' : '') . '>' . $fc_v . '</option>';
                                            }
                                            $tabs_contents .= ' </select>'
                                                    . '         ';
                                            $changeScript = '';
                                            if ($based_on_values) {
                                                $changeScript = $this->getOnChangeScriptForBasedOnFields($field_id, $field_is_widget['based_on_values']);
                                            }
                                            if (!empty($changeScript)) {
                                                $tabs_contents .= "<script> $changeScript </script> ";
                                            }
                                            break;
                                        case 'dropdown_for_null':
                                            $selected_data = isset($field_is_widget['selected_data']) ? $field_is_widget['selected_data'] : array();
                                            $tabs_contents .= ''
                                                    . '          <select '
                                                    . '               ' . $eserv_extra_validation_attributes
                                                    . '               class="col-sm-4 col-sm-6 form-control' . $eservfieldExtraCss . ' " '
                                                    . '               data-style="btn-info" '
                                                    . '               name="' . $field_id . '_name"'
                                                    . '               id="' . $field_id . '"'
                                                    . '               data-default-value="' . htmlentities(json_encode($selected_data)) . '" '
                                                    . '               style="max-width:150px;">';

                                            foreach ($field_is_widget['choices'] as $fc_k => $fc_v) {
                                                $tabs_contents .= '<option value="' . $fc_k . '"' . ( in_array($fc_k, $selected_data) ? ' selected="selected"' : '') . '>' . $fc_v . '</option>';
                                            }
                                            $tabs_contents .= ' </select>'
                                                    . '         ';
                                            break;
                                        case 'exists':
                                            $tabs_contents .= '        <input type="text" '
                                                    . '               ' . $eserv_extra_validation_attributes . ' ' . $extraAttributeHtml
                                                    . '               class="form-control ' . $eservfieldExtraCss . ' pull-left" '
                                                    . '               id="' . $field_id . '" value />' . $extraHtml;
                                            break;
                                        case 'autocomplete_array':
                                            $selected_data = isset($field_is_widget['selected_data']) ? $field_is_widget['selected_data'] : array();
                                            $dataSourceUrl = '';
                                            if (isset($field_is_widget['data_source']['url']) && !empty($field_is_widget['data_source']['url'])) {
                                                $dataSourceUrl = $field_is_widget['data_source']['url'];
                                            }
                                            $based_on_values = array_key_exists('based_on_values', $field_is_widget) && is_array($field_is_widget['based_on_values']) ? true : false;
                                            $tabs_contents .= ''
                                                    . '          <select '
                                                    . '               ' . $eserv_extra_validation_attributes
                                                    . '               class="col-sm-12 ' . $eservfieldExtraCss . ' " '
                                                    . '               data-style="btn-info" '
                                                    . '               name="' . $field_id . '_name"'
                                                    . '               data-dynamicfieldtype="select2_array"'
                                                    . (!empty($dataSourceUrl) ? ' data-source-url="' . $dataSourceUrl . '"' : '')
                                                    . ($based_on_values ? ' data-basedonvalues="' . htmlentities(json_encode($field_is_widget['based_on_values'])) . '" ' : '')
                                                    . '               data-default-value="' . htmlentities(json_encode($selected_data)) . '" '
                                                    . '               id="' . $field_id . '" multiple>';

                                            foreach ($field_is_widget['choices'] as $fc_k => $fc_v) {
                                                $tabs_contents .= '<option value="' . $fc_k . '"' . ( in_array($fc_k, $selected_data) ? ' selected="selected"' : '') . '>' . $fc_v . '</option>';
                                            }
                                            $w_options = array_key_exists('extra_options', $field_is_widget) && is_array($field_is_widget['extra_options']) ? $field_is_widget['extra_options'] : array();
                                            $maximumSelectionLength = array_key_exists('maximumSelectionLength', $w_options) ? $w_options['maximumSelectionLength'] : 0;
                                            $maximumSelectionLengthScript = '';
                                            if (is_integer($maximumSelectionLength) && $maximumSelectionLength > 0) {
                                                $maximumSelectionLengthScript = " maximumSelectionLength: $maximumSelectionLength, ";
                                            }
                                            $changeScript = '';
                                            if ($based_on_values) {
                                                $changeScript = $this->getOnChangeScriptForBasedOnFields($field_id, $field_is_widget['based_on_values']);
                                            }
                                            $tabs_contents .= ' </select>' . $extraHtml
                                                    . '<script> $("#' . $field_id . '").select2({ 
                                                        ' . $maximumSelectionLengthScript . ' 
                                                        placeholder: "Select" 
                                                        }); '
                                                    . $changeScript . ' </script>  ';
                                            break;
                                        case 'autocomplete_ajax':
                                            if (array_key_exists('data_source', $field_is_widget) && is_array($field_is_widget['data_source'])) {
                                                $advanceSearchHtml = '';
                                                if (array_key_exists('advance_search', $field_is_widget) && !empty($field_is_widget['advance_search'])) {
                                                    $advanceSearch = $field_is_widget['advance_search'];
                                                    if (array_key_exists('target_url', $advanceSearch)) {
                                                        $advanceSearchHtml = '<a class="btn btn-default mtl_advanced_search_text mtl_tooltip ng-scope" ng-controller="EservModalCtrl" '
                                                                . ' ng-click="openEservModal(\'eserv_advanced_search_' . $field_id . '_id\', \'Advanced Search\', \'lg\', '
                                                                . ' { target_url: \'' . $advanceSearch['target_url'] . '?field_prefix_id=' . $key . '\' })" '
                                                                . ' data-hasqtip="60" oldtitle="Advanced Search" title="" aria-describedby="qtip-60">'
                                                                . ' <i class="fa fa-search"></i></a>';
                                                    }
                                                }
                                                $w_options = array_key_exists('extra_options', $field_is_widget) && is_array($field_is_widget['extra_options']) ? $field_is_widget['extra_options'] : array();
                                                $maximumSelectionLength = array_key_exists('maximumSelectionLength', $w_options) ? $w_options['maximumSelectionLength'] : 0;
                                                $maximumSelectionLengthScript = '';
                                                if (is_integer($maximumSelectionLength) && $maximumSelectionLength > 0) {
                                                    $maximumSelectionLengthScript = " maximumSelectionLength: $maximumSelectionLength, ";
                                                }
                                                $based_on_values = array_key_exists('based_on_values', $field_is_widget) && is_array($field_is_widget['based_on_values']) ? true : false;
                                                $this->query_params[$field_id] = '$("#' . $field_id . '").val()';

                                                $extra_json_data = '';
                                                if ($based_on_values) {
                                                    $extra_json_data = base64_encode(json_encode($field_is_widget['based_on_values']));

//                                                    $dateJSONArray = array();
//                                                    foreach ($field_is_widget['based_on_values'] as $b_o_f_key => $b_o_f_value) {
//                                                        array_push($dateJSONArray, "{$b_o_f_value['key']}: $('#" . md5($id) . "_{$b_o_f_value['value']}').val()");
//                                                    }

                                                    $dateJSONArray = $this->getBasedOnJsonParamACAjax($field_is_widget['based_on_values'], md5($id));

                                                    $tabs_contents .= ' '
                                                            . ''
                                                            . '<select multiple="multiple" id="' . $field_id . '" name="' . $field_id . '_name"></select>'
                                                            . '' . $advanceSearchHtml . $extraHtml
                                                            . '<script> '
                                                            . ' var ajaxData = {};'
                                                            . '$("#' . $field_id . '").select2({
                                                                  minimumInputLength: 1, '
                                                            . $maximumSelectionLengthScript .
                                                            '   placeholder: "Select",
//                                                                  closeOnSelect: false,
                                                                  ajax: {
                                                                    url: "' . $field_is_widget['data_source']['url'] . '",
                                                                    cache: false,
//                                                                    type: "POST", Not working for UNISON MCT thru. gateway
                                                                    type: "GET",
                                                                    error: function(e){ 
                                                                        //console.log("error: ", e);
                                                                        if(e.statusText == \'abort\'){
                                                                            setTimeout(function(){$(".select2-results__option").html("Searching...")});
                                                                        }
                                                                    },
                                                                    success: function(res){ 
                                                                        //console.log("success: ", res); 
                                                                    },
                                                                    data: function(params) {
                                                                        var queryParameters = {
                                                                            q: params.term ' . (count($dateJSONArray) > 0 ? (',' . implode(',', $dateJSONArray)) : '') . '
                                                                        }
                                                                        return queryParameters;
                                                                    }
                                                                  }
                                                              }); 
                                                            </script>';
                                                } else {
                                                    $tabs_contents .= ' '
                                                            . ''
                                                            . '<select multiple="multiple" id="' . $field_id . '" name="' . $field_id . '_name" data-ajax--url="' . $field_is_widget['data_source']['url'] . '" data-ajax--cache="true"></select>'
                                                            . '' . $advanceSearchHtml . $extraHtml
                                                            . '<script> $("#' . $field_id . '").select2({
                                                                  minimumInputLength: 1, '
                                                            . $maximumSelectionLengthScript .
                                                            ' placeholder: "Select"
                                                              }); 
                                                              </script>';
                                                }
                                            } else {
                                                throw new \Exception('Please set the "data_source" for autocomplete_ajax to work.', 500);
                                            }
                                            break;
                                        case 'autocomplete_ajax_single':
                                            if (array_key_exists('data_source', $field_is_widget) && is_array($field_is_widget['data_source'])) {
                                                $tabs_contents .= $this->getAutoCompAjaxSingleHtml($id, $field_is_widget, $field_id, $extraHtml);
                                            } else {
                                                throw new \Exception('Please set the "data_source" for autocomplete_ajax to work.', 500);
                                            }
                                            break;
                                        case 'date_from_to':
                                            $date_fields = $field_is_widget['date_fields'];
                                            $this->query_params[$field_id . '_range_chkbox'] = '$("#' . $field_id . '_range_chkbox").prop("checked")';

                                            foreach ($date_fields as $date_field_k => $date_field_v) {
                                                $fieldValue = isset($date_field_v['data']) ? $date_field_v['data'] : '';
                                                $placeHolder = $date_field_k == 'from_field' ? 'From' : 'To';
//                                                if(isset($date_field_v['eserv_extra_validation']['date']['placeholder'])){
//                                                    $placeHolder = $date_field_v['eserv_extra_validation']['date']['placeholder'];
//                                                }
                                                $col_style = $date_field_k == 'from_field' ? 'padding-right: 2px;padding-left:0;' : 'padding-left: 2px;padding-right:0;';

                                                $this->query_params[$field_id . '_' . $date_field_k] = '$("#' . $field_id . '_' . $date_field_k . '").val()';

                                                $this_eserv_extra_validation_array = $this->buildExtraValidation($date_field_v['eserv_extra_validation'], array(
                                                    'filters_have_date' => true,
                                                    'filters_have_lettercase' => array_key_exists('lettercase', $field_is_widget['date_fields'][$date_field_k]) ? true : false,
                                                ));

                                                $this_eserv_extra_validation_attributes = $this_eserv_extra_validation_array['eserv_extra_validation_attributes'];
                                                $this_eservfieldExtraCss = $this_eserv_extra_validation_array['eservfieldExtraCss'];
                                                $this_fieldRequired = $this_eserv_extra_validation_array['fieldRequired'];
                                                $filters_have_date = $this_eserv_extra_validation_array['filters_have_date'];
                                                $filters_have_lettercase = $this_eserv_extra_validation_array['filters_have_lettercase'];
                                                $tabs_contents .= '<div class="col-xs-6" style="' . $col_style . '">'
                                                        . '          <div class="input-group">'
                                                        . '             <input type="text" placeholder="' . $placeHolder . '" '
                                                        . '               ' . $this_eserv_extra_validation_attributes
                                                        . '               class="form-control ' . $this_eservfieldExtraCss . ' " '
                                                        . '               id="' . $field_id . '_' . $date_field_k . '" value="' . $fieldValue . '" data-default-value="' . $fieldValue . '" />'
                                                        . '          </div>'
                                                        . '        </div>';
                                            }

                                            $tabs_contents .= '        <input class="not-a-filter-field" type="hidden" id="' . $field_id . '" value="date" />';

                                            break;
                                        case 'range_value':
                                            $range_fields = $field_is_widget['range_fields'];
                                            $this->query_params[$field_id . '_range_chkbox'] = '$("#' . $field_id . '_range_chkbox").prop("checked")';

                                            foreach ($range_fields as $range_field_k => $range_field_v) {
                                                $placeHolder = $range_field_k == 'from_field' ? 'From' : 'To';
                                                $col_style = $range_field_k == 'from_field' ? 'padding-right: 2px;padding-left:0;' : 'padding-left: 2px;padding-right:0;';

                                                $this->query_params[$field_id . '_' . $range_field_k] = '$("#' . $field_id . '_' . $range_field_k . '").val()';

                                                $this_eserv_extra_validation_array = $this->buildExtraValidation($range_field_v['eserv_extra_validation'], array(
                                                    'filters_have_date' => false,
                                                    'filters_have_lettercase' => array_key_exists('lettercase', $field_is_widget['range_fields'][$range_field_k]) ? true : false,
                                                ));

                                                $this_eserv_extra_validation_attributes = $this_eserv_extra_validation_array['eserv_extra_validation_attributes'];
                                                $this_eservfieldExtraCss = $this_eserv_extra_validation_array['eservfieldExtraCss'];
                                                $this_fieldRequired = $this_eserv_extra_validation_array['fieldRequired'];
                                                $filters_have_lettercase = $this_eserv_extra_validation_array['filters_have_lettercase'];
                                                $tabs_contents .= '<div class="col-xs-6" style="' . $col_style . '">'
                                                        . '          <div class="input-group">'
                                                        . '             <input type="text" placeholder="' . $placeHolder . '" '
                                                        . '               ' . $this_eserv_extra_validation_attributes
                                                        . '               class="form-control ' . $this_eservfieldExtraCss . ' " '
                                                        . '               id="' . $field_id . '_' . $range_field_k . '" value />'
                                                        . '          </div>'
                                                        . '        </div>';
                                            }

                                            $tabs_contents .= '        <input class="not-a-filter-field" type="hidden" id="' . $field_id . '" value="some_value" />';
                                            break;
                                    }
                                } else {
                                    $tabs_contents .= '        <input type="text" '
                                            . '               ' . $eserv_extra_validation_attributes . ' ' . $extraAttributeHtml
                                            . '               class="form-control ' . $eservfieldExtraCss . ' pull-left" '
                                            . '               id="' . $field_id . '" value="' . $fieldValue . '" data-default-value="' . $fieldValue . '" />' . $extraHtml;
                                }

                                if ($show_hide_checkboxes && array_search($k, $column_keys) !== null) {
                                    $checked = '';
                                    if ($enabled_filters != null && is_array($enabled_filters)) {
                                        if (array_search(trim($field_name_only), $enabled_filters) !== false) {
                                            $checked = 'checked="checked"';
                                        }
                                    }
                                    $tabs_contents .= '<span class="input-group-addon dt_col_show_hide_trigger"><input id="show_hide_' . $field_id . '_trigger" type="checkbox" value="Y" ' . $checked . ' /></span>';
                                }
                                $tabs_contents .= '</div>';

                                if ($field_is_widget && ($field_is_widget['type'] === 'date_from_to' || $field_is_widget['type'] === 'range_value')) {
                                    $tabs_contents .= '<div class="checkbox checkbox-default">';
                                    if (array_key_exists('range', $field_is_widget) && !$field_is_widget['range']) {
                                        $tabs_contents .= '<input class="not-a-filter-field" type="checkbox" id="' . $field_id . '_range_chkbox" class="eserv_field_value" >';
                                        $filtering_js .= '$("#' . $field_id . '_to_field").prop("disabled", true);';
                                        $filtering_js .= ($field_is_widget['type'] === 'date_from_to') ? ' $("#' . $field_id . '_from_field").attr("placeholder", "' . (\ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_INPUT_PLACEHOLDER) . '");' : '';
                                    } else {
                                        $tabs_contents .= '<input class="not-a-filter-field" type="checkbox" id="' . $field_id . '_range_chkbox" class="eserv_field_value" checked>';
                                    }
                                    $tabs_contents .= '<label for="' . $field_id . '_range_chkbox">Range</label>'
                                            . '</div>';
                                    $filtering_js .= '$("#' . $field_id . '_range_chkbox").click(function(){'
                                            . 'if ($(this).is(":checked")) {'
                                            . '     $("#' . $field_id . '_to_field").prop("disabled", false);'
                                            . '     $("#' . $field_id . '_from_field").attr("placeholder", "From");'
                                            . '}else {'
                                            . '     $("#' . $field_id . '_to_field").prop("disabled", true);';
                                    $filtering_js .= ($field_is_widget['type'] === 'date_from_to') ? ' $("#' . $field_id . '_from_field").attr("placeholder", "' . (\ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_INPUT_PLACEHOLDER) . '");' : '';
                                    $filtering_js .= '}'
                                            . '});';
                                }

                                $tabs_contents .= '<span class="help-block"></span>'
                                        . '      </div>'
                                        . '    </div>';
                            }

                            $tabs_contents .= '</fieldset>';

                            $search_label = 'Search';
                            $clear_filter_label = 'Clear Filter';
                            $show_all_label = 'Show All';
                            $reset_columns = 'Reset Columns';
                            $show_text = 'Show';
                            $hide_text = 'Hide';

                            if ($this->c->hasParameter('app_translation')) {
                                $domain = $this->c->get('eserv_translation_services')->getFullEservDbTransDomain();

                                $search_label = $this->c->get('translator')->trans("SEARCH_WORDING", array(), $domain);
                                $clear_filter_label = $this->c->get('translator')->trans("CLEAR_FILTER_TXT", array(), $domain);
                                $show_all_label = $this->c->get('translator')->trans("SHOWALL_TXT", array(), $domain);
                                $reset_columns = $this->c->get('translator')->trans("RESET_COLS_TXT", array(), $domain);
                                $show_text = $this->c->get('translator')->trans("SHOW_WORDING", array(), $domain);
                                $hide_text = $this->c->get('translator')->trans("HIDE_TXT", array(), $domain);
                            }

                            $tabs_contents .= '<div class="filtering_main_buttons">';

                            $tabs_contents .= '<button class="btn btn-client2 pull-right dt_action_btn dt_filter_btn search_table_dataTableVar_' . $id . '_trigger" id="' . $trigger_id . '"><i class="fa fa-search"></i> ' . $search_label . '</button>';
                            $tabs_contents .= '<button type="button" class="btn btn-client1 pull-right dt_action_btn dt_filter_btn clear_table_filter_dataTableVar_' . $id . '"><i class="fa fa-refresh"></i> ' . $clear_filter_label . '</button>';
                            $tabs_contents .= '<button type="button" class="btn btn-client1 pull-right dt_action_btn dt_filter_btn toggle_all_btn_' . $id . '"><i class="fa fa-th-list"></i> <span class="toggle_all_btn_label">' . $show_all_label . '</span></button>';
                            $tabs_contents .= '<button type="button" class="btn btn-client1 pull-right dt_action_btn dt_filter_btn reset_col_btn_' . $id . '"><i class="fa fa-undo"></i> <span class="mtl-btn-text">' . $reset_columns . '</span></button>';
                            if ($output_options) {
                                $tabs_contents .= '<button type="button" class="btn btn-client1 pull-right dt_action_btn dt_filter_btn toggle_output_opts_btn_' . $id . '"><i class="fa fa-file-o"></i> Data Extracts</button>';
                            }
                            $tabs_contents .= '<div class="clearfix"></div>';
                            $tabs_contents .= '</div>';

                            $tabs_contents .= '<div class="clearfix"></div>';


                            foreach ($tab['fields'] as $k => $field) {
                                $field_id = $key . '_' . $k;
                                $filtering_js .= $id . '_filters["' . $k . '"] = "' . $field_id . '";';
                                $dt_output_col_name = $id . '_' . $k;
                                if ($show_hide_checkboxes && array_search($k, $column_keys) !== null) {
                                    $filtering_js .= '$("#show_hide_' . $field_id . '_trigger").bootstrapSwitch({onText: "' . $hide_text . '",offText: "' . $show_text . '"});$("#show_hide_' . $field_id . '_trigger").on("switchChange.bootstrapSwitch", function (event, state) { dtShowHideCol(dataTableVar_' . $id . ', ' . array_search($k, $column_keys) . ', state, "' . $dt_output_col_name . '") });';
                                }
                            }

                            $tabs_contents .= '</div>';
                        }

                        $tabs_headers .= '</ul>';

                        if ($include_history_toggle) {
                            $hisTogResult = $this->getHistoryToggleSwitch($id, $data, $backEndSearch);
                            $tabs_contents .= '<span class="pull-left dt_extra_toggle_btn">' . $hisTogResult['switch_html'] . '</span>';
                            $filtering_js .= $hisTogResult['switch_js'];
                        }

                        $tabs_contents .= '<div class="clearfix"></div>';
                        $tabs_contents .= '</div>';

                        $filtering_html .= $tabs_headers . $tabs_contents;
                        $filtering_html .= '<div class="clearfix"></div></div>';

                        $filtering_js .= ''
                                . '$(".search_table_dataTableVar_' . $id . '_trigger").click(function() {'
                                . 'search_' . $id . '()'
                                . ' });';

                        $filtering_js .= ''
                                . '$("select, input").change(function() {'
                                . '     var element = $(this).closest(".form-group");'
                                . '     RemoveErrors(element);'
                                . ' });';

                        $filtering_js .= '$(".clear_table_filter_dataTableVar_' . $id . '").click(function() {'
                                . 'resetFormErrors($("#table_filtering_' . $id . '"));'
                                . 'clearTableFilter(dataTableVar_' . $id . ', "' . $id . '");'
                                . '});'
                                . '$(".toggle_all_btn_' . $id . '").click(function() {'
                                . 'DTColumnShowHideButton(this, dataTableVar_' . $id . ', "all_cols_' . $id . '", "' . $id . '", "dataTables_and_Filters_' . $id . '");'
                                . '});'
                                . ''
                                . '$(".reset_col_btn_' . $id . '").click(function() {'
                                . ' resetExportCols("all_cols_' . $id . '","default_visible_cols_' . $id . '", "dataTables_and_Filters_' . $id . '", $(this).find(".mtl-btn-text"));'
                                . '});'
                                . '';
                        if ($output_options) {
                            $filtering_js .= '$(".toggle_output_opts_btn_' . $id . '").click(function() {'
                                    . ' showOutputOptions("' . $id . '");'
                                    . '});'
                                    . '';
                        }

                        $filtering_js .= ($filters_have_date ? 'if (typeof initESERVDatePicker == "function"){ initESERVDatePicker("#table_filtering_' . $id . '"); }' : '')
                                . ($filters_have_lettercase ? 'if (typeof initESERVFieldLettercase == "function"){ initESERVFieldLettercase("#table_filtering_' . $id . '"); }' : '');
                        $filtering_js .= $filters_have_remove_spaces ? 'if (typeof initESERVFieldRemoveSpaces == "function"){ initESERVFieldRemoveSpaces("#table_filtering_' . $id . '"); }' : '';
                        $filtering_js .= ''
                                . 'var lStrName = "DataTables_' . $id . '_" + window.location.pathname;
                                   var lStr = JSON.parse(localStorage.getItem(lStrName));
                                   //console.log(lStr);
                                   if(lStr != null && lStr.abVisCols != "undefined"){
                                        bsSwitchStateChange("all_cols_' . $id . '", lStr.columns, "' . $id . '", "dataTables_and_Filters_' . $id . '");                                       
                                    }else{
                                    
                                    }   
                            
                                ';
                    }
                    break;
            }
        } else {
            if ($output_options) {
                $filtering_html .= '<button type="button" class="btn btn-client1 pull-right col-xs-12 col-sm-12 col-md-3 col-lg-3 toggle_output_opts_btn_' . $id . '">Data Extracts</button>';
                $filtering_js .= '$(".toggle_output_opts_btn_' . $id . '").click(function() {'
                        . ' showOutputOptions("' . $id . '");'
                        . '});'
                        . '';
            }
            if ($include_history_toggle) {
                $hisTogResult = $this->getHistoryToggleSwitch($id, $data, $backEndSearch);
                $filtering_html .= '<div class="filtering_main_buttons">' . $hisTogResult['switch_html'] . '</div>';
                $filtering_js .= $hisTogResult['switch_js'];
            }
        }

        return array(
            'filtering_html' => $filtering_html,
            'filtering_js' => $filtering_js,
            'options' => array(
                'show_hide_checkboxes' => $show_hide_checkboxes
            ),
        );
    }

    protected function getHistoryToggleSwitch($id, $data, $backEndSearch) {
        $historyToggleParams = (isset($data['history_toggle_params']) && is_array($data['history_toggle_params'])) ? $data['history_toggle_params'] : array();
        $historyToggleLabel = isset($historyToggleParams['label']) ? $historyToggleParams['label'] . ' ' : '';

        $include_history = isset($historyToggleParams['Y']['text']) ? $historyToggleParams['Y']['text'] : 'Yes';
        $exclude_history = isset($historyToggleParams['N']['text']) ? $historyToggleParams['N']['text'] : 'No';

        if ($this->c->hasParameter('app_translation')) {
            $domain = $this->c->get('eserv_translation_services')->getFullEservDbTransDomain();

            $include_history = $this->c->get('translator')->trans("INCLUDE_HISTORY_ON_WORDING", array(), $domain);
            $exclude_history = $this->c->get('translator')->trans("EXCLUDE_HISTORY_ON_WORDING", array(), $domain);
        }

        $switchHtml = $historyToggleLabel . '<input data-on-color="success" data-off-color="default" id="include_history_' . $id . '" type="checkbox" value="Y" />';
        $switchJs = '$("#include_history_' . $id . '").bootstrapSwitch({'
                . 'onText: "' . $include_history . '",'
                . 'offText: "' . $exclude_history . '"'
                . '});';
        if ($backEndSearch == false) {
            $switchJs .= '$("#include_history_' . $id . '").on("switchChange.bootstrapSwitch", function (event, state) {'
                    . ' search_' . $id . '();'
                    . '});';
        }
        return array(
            'switch_html' => $switchHtml,
            'switch_js' => $switchJs
        );
    }

    protected function getBasedOnJsonParamACAjax($basedOnValues, $tableIdEncoded) {
        $dataJSONArray = array();
        foreach ($basedOnValues as $bovKey => $bovValue) {
            array_push($dataJSONArray, "{$bovValue['key']}: $('#" . $tableIdEncoded . "_{$bovValue['value']}').val()");
        }
        return $dataJSONArray;
    }

    protected function getOnChangeScriptForBasedOnFields($field_id, $based_on_values) {
        return '';
    }

    protected function getAutoCompAjaxSingleHtml($id, $field_is_widget, $field_id, $extraHtml) {
        $based_on_values = array_key_exists('based_on_values', $field_is_widget) && is_array($field_is_widget['based_on_values']) ? true : false;
        $this->query_params[$field_id] = '$("#' . $field_id . '").val()';
        $extra_json_data = '';
        if ($based_on_values) {
            $b_o_f_values = array();
            foreach ($field_is_widget['based_on_values'] as $b_o_f_key => $b_o_f_value) {
                $b_o_f_values[$b_o_f_value['key']] = $b_o_f_value['key'] . '|' . md5($id) . '_' . $b_o_f_value['value'];
            }
            if (count($b_o_f_values) > 0) {
                $extra_json_data = ' data-extraparams="' . implode(',', $b_o_f_values) . '" ';
            }
        }
        $resultHtml = '<input type="hidden" id="' . $field_id . '" name="' . $field_id . '[name]" data-eservfieldtype="hidden" class="form-control eserv_field_value " style="display: inline-block;">';
        $resultHtml .= '<input id="ac_' . $field_id . '" class="form-control eserv_autocomplete ui-autocomplete-input" data-targetelementid="' . $field_id . '" ' . $extra_json_data . ' data-eservsourceurl="' . $field_is_widget['data_source']['url'] . '" placeholder="Start Typing..." autocomplete="off" style="display: inline-block;">';
        $resultHtml .= $extraHtml . '<script>'
                . 'prepareACField($("#ac_' . $field_id . '")); ';
        $resultHtml .= '</script>';
        return $resultHtml;
    }

    protected function buildExtraValidation($eserv_extra_validation, $global_vars = array()) {
        $eserv_extra_validation_attributes = '';
        $eservfieldExtraCss = '';
        $eservfieldtype = 'text';
        $fieldRequired = false;
        $letterCase = false;
        $removeSpaces = false;

        if ($eserv_extra_validation) {
//            $fieldRequired = (false !== array_search('required', $eserv_extra_validation) ? true : false);
            if (array_key_exists('required', $eserv_extra_validation)) {
                $fieldRequired = $eserv_extra_validation['required'];
            } else {
                $fieldRequired = false;
            }
            if (isset($eserv_extra_validation['lettercase'])) {
                $letterCase = $eserv_extra_validation['lettercase'];
                $global_vars['filters_have_lettercase'] = true;
            }
            if (isset($eserv_extra_validation['remove_spaces'])) {
                $removeSpaces = $eserv_extra_validation['remove_spaces'];
                $global_vars['filters_have_remove_spaces'] = $removeSpaces;
            }
            $dataESERVValidation = array();
            foreach ($eserv_extra_validation as $v_k => $v_v) {
                array_push($dataESERVValidation, ($v_k ? $v_k : $v_v));
                switch ($v_k) {
                    case 'date':
                        $global_vars['filters_have_date'] = true;
                        $eservfieldExtraCss = 'eserv_date_picker';
                        if (is_array($v_v)) {
                            $eserv_extra_validation_attributes .= isset($v_v['format']) ? ' data-dateformat="' . $v_v['format'] . '" ' : '';
                            $eserv_extra_validation_attributes .= isset($v_v['yearrange']) ? ' data-yearrange="' . $v_v['yearrange'] . '" ' : '';
                            $eserv_extra_validation_attributes .= isset($v_v['view_mode']) ? ' data-view-mode="' . $v_v['view_mode'] . '" ' : '';
                            $eserv_extra_validation_attributes .= isset($v_v['min_view_mode']) ? ' data-min-view-mode="' . $v_v['min_view_mode'] . '" ' : '';
                            $eserv_extra_validation_attributes .= isset($v_v['start_date']) ? ' data-date-start-date="' . $v_v['start_date'] . '" ' : '';
                            $eserv_extra_validation_attributes .= isset($v_v['end_date']) ? ' data-date-end-date="' . $v_v['end_date'] . '" ' : '';
                        }
                        break;
                    case 'regexp':
                        if (is_array($v_v)) {
                            $eserv_extra_validation_attributes .= isset($v_v['format']) ? ' data-regxformat="' . $v_v['format'] . '" ' : '';
                            $eserv_extra_validation_attributes .= isset($v_v['error_msg']) ? ' data-regxerror="' . $v_v['error_msg'] . '" ' : '';
                        }
                        break;
                }
                $eserv_extra_validation_attributes .= '';
            }

            $eserv_extra_validation_attributes .= ' data-eservfieldtype="' . $eservfieldtype . '" data-eservvalidation="' . implode(',', $dataESERVValidation) . '" ' . ($letterCase ? ' data-lettercase="' . $letterCase . '"' : '');
            $eserv_extra_validation_attributes .= $removeSpaces ? ' data-removeSpaces="Y"' : '';
        }

        return array(
            'eserv_extra_validation_attributes' => $eserv_extra_validation_attributes,
            'eservfieldExtraCss' => $eservfieldExtraCss,
            'fieldRequired' => $fieldRequired,
            'filters_have_date' => $global_vars['filters_have_date'],
            'filters_have_lettercase' => $global_vars['filters_have_lettercase'],
            'filters_have_remove_spaces' => ($removeSpaces ? $global_vars['filters_have_remove_spaces'] : false),
        );
    }

    protected function buildDataTableExtraParams($params) {

        $final_params = array_merge($params, $this->query_params);

        $dataTables_params = array();

        if (is_array($final_params)) {
            foreach ($final_params as $key => $value) {
                $param = '{"name": "' . $key . '", "value": ' . $value . '}';
                array_push($dataTables_params, $param);
            }
        }

        return implode(',', $dataTables_params);
    }

    /**
     * Return the value of a custom column in DataTables based on the parameter. ()
     *
     * @param Request $request (Injected parameter)
     * @param String, Custom column name $param      
     *
     * @return String
     * @throw n/a
     */
    public function getDataTableRequestParameter(Request $request, $param) {
        $sColumns = $request->get('sColumns');
        $col_arr = explode(',', $sColumns);

        return $request->get('sSearch_' . array_search($param, $col_arr));
    }

    protected function preparePrintQ($json_arr_for_print, $data_index_col, $sColumns, $headerNames) {
        $encoded_json = $this->c->get('core_function_services')->eservEncode($json_arr_for_print);
        $sql_with_vals = $this->c->get('db_core_function_services')->createSqlwithParameters($encoded_json);

        //replace id column with the columns sColumns
        $sql_alias = trim(explode('SELECT', explode('.', $sql_with_vals)[0])[1]);
        $index_col_with_alias = $sql_alias . '.' . $this->c->get('core_function_services')->from_camel_case($data_index_col);
        $find_index = strpos($sql_with_vals, $index_col_with_alias);

        $output = array();

        //if index exists
        if ($find_index) {
            $newSColumns = '';
            $exp = explode(',', $sColumns);
            //changing DQL alias column names to real column names
            foreach ($exp as $e) {
                if (!is_null($e) && '' != $e) {
                    $newSColumns .= $this->c->get('core_function_services')->from_camel_case($e) . ',';
                }
            }
            $newSColumns = rtrim($newSColumns, ',');

            //replacing select alias.index_col with real columns without aliases.
            $str_replace_sql = substr_replace($sql_with_vals, $newSColumns, $find_index, strlen($index_col_with_alias));

            $as_to_from_pattern = '/as(?:\s+\w+)\s+from/i';
            $limit_to_end_pattern = '/limit(?:\s+\w+)(.+)/i';
            $str1 = preg_replace($as_to_from_pattern, 'FROM', $str_replace_sql);
            $str2 = preg_replace($limit_to_end_pattern, '', $str1);

            $output = array(
                'printQ' => $str2
            );
        } else {
            $output = array(
                'printQ' => $sql_with_vals
            );
        }

        $output['titles'] = $headerNames;

        return $this->c->get('core_function_services')->eservEncode(serialize($output));
    }

    //c_columns - columns from the controller
    protected function prepareOutputOptions($id, $output_options = array(), $columns = array(), $c_columns = array()) {
        if (key_exists('export_buttons', $output_options) && is_array($output_options['export_buttons'])) {
            $string = '<div class="eserv_output_opts_container" id="output_opts_container_' . $id . '">';
            $string .= '<div class="col-lg-12"><span class="fa fa-info-circle"></span> Maximum of 8 columns allowed for PDF exports.';
            //title and content will be considered just for the PDF or anyother except CSV.
            foreach ($output_options['export_buttons'] as $k => $v) {
                $file_name = key_exists('file_name', $v) ? $v['file_name'] : '';
                $title = key_exists('title', $v) ? $v['title'] : '';
                $content = key_exists('content', $v) ? $v['content'] : '';

                $string .= '
                    <button 
                        class = "btn btn-default eserv_print_data_table pull-right ' . $v['extraClass'] . '"
                        data-print-type = "' . $k . '"
                        data-print-table-id = "print_dtq_contents_wrapper_' . $id . '" 
                        data-print-cols-name = "' . $id . '_export_cols" 
                        data-print-export-title = "' . $id . '_export_title" 
                        data-print-title = "' . $title . '"
                        data-print-content = "' . $content . '"
                        data-print-file-name = "' . $file_name . '" >' . $v['label'] . '
                    </button>                    
                 ';
            }
            $string .= '<div class="col-lg-4 col-sm-4 pull-right">'
                    . '<input class="form-control" type="text" id="' . $id . '_export_title" name="' . $id . '_export_title" value="" placeholder="Export Title"/>'
                    . '<span class="help-block" style="display: none;">This field is required.</span>'
                    . '</div>'
            ;
            $string .= '<div class="clearfix"></div></div>';

            if (isset($columns)) {
                $string .= '<div class="col-lg-12">'
                        . '<div class="checkbox checkbox-info">'
                        . '<input id="' . $id . '_checkall_cols" type="checkbox" class="checkall" />'
                        . '<label for="' . $id . '_checkall_cols">Check/Un-Check All</label>'
                        . '</div>';
                foreach ($columns as $k => $v) {
                    if ($jd = json_decode($c_columns, true)) {
                        $ac = (array_column($jd, 'sName'));
                        foreach ($ac as $kk => $tt) {
                            if ($tt == $v) {
                                $label = isset(array_column($jd, 'sTitle')[$kk]) ? array_column($jd, 'sTitle')[$kk] : $v;
                            }
                        }
                    } else {
                        $label = $v;
                    }
                    $string .= '<div class="col-md-3">'
                            . '<div class="checkbox checkbox-default">'
                            . '<input type="checkbox" id="' . $id . '_' . $v . '" name="' . $id . '_export_cols" value="' . $v . '"/>';
                    $string .= '<label for="' . $id . '_' . $v . '">' . $label . '</label>';
                    $string .= '</div>';
                    $string .= '</div>';
                }
                $string .= '<div class="clearfix"></div></div>';
            }

            $string .= '<div class="clearfix"></div></div>';
        }

        return $string;
    }

    protected function populateShowHideDetailsHref($params, $RowData) {
        $func_name = $params['page_url_show_when']['extra_options']['function_name'];
        $func_params = $params['page_url_show_when']['extra_options']['function_params'];
        $full_class_name = $params['page_url_show_when']['extra_options']['full_class_name'];
        $outcome = $params['page_url_show_when']['extra_options']['outcome'];
        $disable_link_title = null;
        $pageURL = null;

        $clsInst = new $full_class_name($this->em, $this->c);
        $prm_arr = array();
        foreach ($func_params as $k => $v) {
            $prm_arr[$v] = $RowData[$v];
            $params_url['[[' . $v . ']]'] = $RowData[$v];
        }

        if ($clsInst->$func_name($prm_arr) == $outcome) {
            foreach ($params['page_url_params'] as $key => $value) {
                $params_url['[[' . $key . ']]'] = $RowData[$value];
            }
            $pageURL = str_replace(array_keys($params_url), array_values($params_url), $params['page_url']);
            $disable_link = false;
        } else {
            $disable_link = true;
            $disable_link_title = isset($params['page_url_show_when']['label_to_show']) ? $params['page_url_show_when']['label_to_show'] : null;
        }

        return array(
            'pageURL' => $pageURL,
            'disable_link' => $disable_link,
            'disable_link_title' => $disable_link_title
        );
    }

    protected function HydrateObjectToArray($_sql, $_params = array(), $options = array()) {

        $q_params = array();
        $q_param_types = array();

        if (count($_params) > 0) {
            foreach ($_params as $_param) {
                $thisVal = $_param->getValue();
                $name = $_param->getName();
                if (!is_array($thisVal)) {
                    $q_params[$name] = $thisVal;
                    $q_param_types[$name] = \PDO::PARAM_STR;
                } else {
                    $q_params[$name] = $thisVal;
                    $q_param_types[$name] = \Doctrine\DBAL\Connection::PARAM_STR_ARRAY;
                }
            }
        }

        $finalParams = $this->getListParamsByDql($options['dql'], $q_params, $q_param_types);

        $stmt = $this->em
                ->getConnection()
                ->executeQuery($_sql, $finalParams['values'], $finalParams['types']);

        $all_results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $hydrated_array = array();

        foreach ($all_results as $key => $item_array) {
            $t_item = array();
            $indx = 0;
            foreach ($item_array as $k => $v) {
                $final = substr($k, 0, -(strlen($indx)));
                $t_item_key = strtolower($final);
                $t_item[$t_item_key] = $v;
                $t_item[$this->c->get('core_function_services')->underscoreToCamelCase($t_item_key)] = $v;
                $indx++;
            }
            array_push($hydrated_array, $t_item);
        }
        return $hydrated_array;
    }

    public function getListParamsByDql($dql, $q_params, $q_param_types) {
        $parsedDql = preg_split("/:/", $dql);
        $length = count($parsedDql);
        $parmeters = array();
        for ($i = 1; $i < $length; $i++) {
            if (ctype_alpha($parsedDql[$i][0])) {
                $param = (preg_split("/[' ' )]/", $parsedDql[$i]));
                $parmeters[] = $param[0];
            }
        }

        $finalParams = array(
            'values' => array(),
            'types' => array()
        );

        foreach ($parmeters as $_paramKeys) {
            if (array_key_exists($_paramKeys, $q_params)) {
                array_push($finalParams['values'], $q_params[$_paramKeys]);
                array_push($finalParams['types'], $q_param_types[$_paramKeys]);
            }
        }

        return $finalParams;
    }

}
