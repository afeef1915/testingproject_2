<?php

namespace ESERV\MAIN\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class DbCoreFunctions extends Controller {

    protected $em;
    protected $c;
    private $coreFunctions;
    private $securityFunctions;
    private $log;

    /*     * *************************************************************************
     * Name: __construct
     *
     * Purpose: Intitialize the Doctrine Entity Manager and CoreFunctions.
     *
     * @param type = Doctrine Entity manager. Possibly  '$this->getDoctrine()->getManager()'
     *
     * @return n/a *
     *
     * Log |    Date    | Developer | Comments
     * -------------------------------------------------------------------------
     * 100 | 14/03/2014 |  A Silva  | -
     * 101 | 27/03/2014 |  A Silva  | Constructor is now being injected by entity manager and container
     * *********************************************************************** */

    public function __construct(EntityManager $Em, Container $C) {
        $this->em = $Em;
        $this->c = $C;
        $this->coreFunctions = $this->c->get('core_function_services');
        $this->securityFunctions = $this->c->has('security_services') ? $this->c->get('security_services') : null;
        $this->log = $this->c->get('logger');
    }

    /*     * ***************************************************************************
     * Name: count
     *
     * Purpose: Returns the row count as an int.
     *
     * @param Entity = Class Name in this format 'ESERVMAINMediaBundle:MediaStore'
     * @param Where = Where array such as, 'array(
     *            array('column' => 'id','operator' => '=', 'value' => 554)
     *            )'
     *
     * @return [int] *
     *
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 14/03/2014 |  A Silva  | -
     * 101 | 25/03/2014 |  A Silva  | Introduced where condition
     * 102 | 28/03/2014 |  A Silva  | count changed to count(m) from count(m.id)
     * ************************************************************************** */

    public function count($Entity, $Where = null) {
        $qb = $this->em->createQueryBuilder()
                ->select('count(m)')
                ->from($Entity, 'm');

        if ($Where != null) {
            $condition = '';
            foreach ($Where as $cond) {
                $column = $cond['column'];
                $operator = $cond['operator'];
                $value = $cond['value'];
                $qb->andWhere('m.' . $column . ' ' . $operator . ' :' . $column)->setParameter($column, $value);
            }
        }
        $count = $qb->setMaxResults(1)->getQuery()->getSingleResult();
        return (int) $count[1];
    }

    /*     * ***************************************************************************
     * Name: customQuery
     *
     * Purpose: Execute a custom query inside MyMerlin.
     *          Returns the results of the executed query
     *         (default is an array)
     *
     * @param Sql = Native SQL such as 'SELECT cr FROM ESERVMAINContactBundle:ContactRole cr'
     * @param Type = (optional) Format needs to be returned
     *
     * @return [array=default|doctrin|xml|json] *
     *
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 14/03/2014 |  A Silva  | -
     * ************************************************************************** */

    public function customQuery($Sql, $Type = 'array') {
        $query = $this->em->createQuery($Sql);
        $FormattedQuery = $this->coreFunctions->GetOutputFormat($query, $Type);
        return $FormattedQuery;
    }

    /*     * ***************************************************************************
     * Name: customOptions
     *
     * Purpose: Customise Doctrine array
     *         (default is an array)
     *
     * @param Result = ''
     * @param Options =  ''
     * @param RootAlias =  ''
     * @param GetSQL =  ''
     *
     * @return  *
     *
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 20/03/2014 |  A Silva  | -
     * 101 | 31/03/2014 |  A Silva  | Improved the orderBy condition and added groupBy condition
     * 102 | 01/04/2014 |  -  | Improved the limit to accept offset value and limit
     * ************************************************************************** */

    public function customOptions($Result, $Options, $RootAlias, $GetSQL = false, $count_col = false) {
        if ($count_col != false) {
            $Result->select('count(' . $RootAlias . '.' . $count_col . ')');
        }
        if (count($Options) > 0) {
            if (array_key_exists('ids', $Options)) {
                $indexKey = $Options['ids'];
                $Result->andWhere('' . $RootAlias . '.' . key($indexKey) . ' IN (:ids)')->setParameter('ids', $Options['ids'][key($indexKey)]);
            }
            if (array_key_exists('where', $Options)) {
                foreach ($Options['where'] as $cond) {
                    $col = explode('.', $cond['column']);
                    if (count($col) == 1) {
                        $col[0] = $RootAlias;
                        $col[1] = $cond['column'];
                    }
                    $Result->andWhere('' . $col[0] . '.' . $col[1] . ' ' . $cond['operator'] . ' :' . $col[1])->setParameter($col[1], $cond['value']);
                }
            }
            if (array_key_exists('limit', $Options)) {
                if (is_array($Options['limit'])) {
                    $Result
                            ->setMaxResults($Options['limit']['limit'])
                            ->setFirstResult($Options['limit']['offset']);
                } else {
                    $Result->setMaxResults($Options['limit']);
                }
            }

            if (array_key_exists('groupBy', $Options)) {
                $groupBy = array();
                foreach ($Options['groupBy'] as $cond) {
                    $groupBy[] = $RootAlias . '.' . $cond['column'];
                }
                $Result->add('groupBy', implode($groupBy, ','));
            }

            if (array_key_exists('orderBy', $Options)) {
                $orderBy = array();
                foreach ($Options['orderBy'] as $cond) {
                    $orderBy[] = $RootAlias . '.' . $cond['column'] . ' ' . $cond['direction'];
                }
                $Result->add('orderBy', implode($orderBy, ','));
            }
        }

        if ($GetSQL === true) {
            if ($count_col != false) {
                echo $Result->getQuery()->getSingleScalarResult();
                die;
            } else {
                return $this->getSQL($Result->getQuery(), $Options);
            }
        }

        if ($count_col != false) {
            return $Result->getQuery()->getSingleScalarResult();
        } else {
            return $Result->getQuery();
        }
    }

    /*     * ***************************************************************************
     * Name: executeOracleProcedure
     *
     * Purpose: Returns the Contact Role ID B based on Contact ID B.
     *
     * @param
     *
     * @return   *
     *
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | --/--/2014 |  S Ibrahim  | -
     * ************************************************************************** */

    public function executeOracleProcedure() {
        $this->em = $this->getDoctrine()->getManager();
        $qb = $this->em->createNativeQuery(
                'CALL USR_P_UserRegistration (' .
                ':iduser, :name, :surname, :birthday, :idlang, :idregistry' .
                ')', new \Doctrine\ORM\Query\ResultSetMapping()
        );
        $qb->setParameters(
                array(
                    'iduser' => $c->getIduser(),
                    'name' => $c->getName(),
                    'surname' => $c->getSurname(),
                    'birthday' => $c->getBirthday(),
                    'idlang' => $c->getIdlang(),
                    'idregistry' => $c->getIdregistry()
        ));
        $qb->execute();
        $this->em->flush();
    }

    /*     * ***************************************************************************
     * Name: getUserProfileId
     *
     * Purpose: Returns the logged in person's profile ID.
     *
     * @param -
     *
     * @return  An int containing the user profile id *
     *
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 26/03/2014 |  A Silva  | -
     * ************************************************************************** */

    public function getUserProfileId() {

        $fos_user_id = $this->securityFunctions->getFosUserId();

        $mm = $this->em
                ->getRepository('ESERVMAINProfileBundle:MmUserSetting')
                ->findOneBy(array('fosUserId' => $fos_user_id));
        $mm->getEservRole()->getContactId();

        return (int) $mm->getMmUserProfile()->getId();
    }

    /*     * ***************************************************************************
     * Name: getSQL
     *
     * Purpose: Returns the SQL format of the Doctrine object.
     *
     * @param $DoctrineQuery = Doctrine query '(Example :- $Result->getQuery())'
     * @param $options = array of options
     *
     * @return  A string containing SQL *
     *
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 31/03/2014 |  A Silva  | -
     * ---------------------------------------------------------------------------
     * 100 | 22/05/2015 |  S Ibrahim  |  Added options array
     * ************************************************************************** */

    public function getSQL($DoctrineQuery, $options = array()) {
        if (array_key_exists('sql_with_params', $options) && $options['sql_with_params'] === true) {
            return array(
                'dql' => $DoctrineQuery->getDQL(),
                'sql' => $DoctrineQuery->getSQL(),
                'params' => $DoctrineQuery->getParameters()
            );
        } else {
            return $DoctrineQuery->getSQL();
        }
    }

    /*     * ***************************************************************************
     * Name: geContactDisplayName
     *
     * Purpose: Returns contact display name based on trainer / centre
     *
     * @param $mm_user_setting_array = mm_user_setting record for the logged in user.
     *
     * @return  Contact display name *
     *
     * Log |    Date    | Developer | Comments
     * ---------------------------------------------------------------------------
     * 100 | 16/04/2014 |  A Silva  | -
     * ************************************************************************** */

    public function geContactDisplayName($mm_user_setting_array) {

        $mm = $this->em
                ->getRepository('ESERVMAINProfileBundle:MmUserSetting')
                ->findOneBy(array('id' => $mm_user_setting_array[0]['id']));


        $qb = $this->em->createQueryBuilder();
        $display_name = $qb->select('p.displayName')
                ->from('ESERVMAINContactBundle:Contact', 'p')
                ->where('p.id = :id')
                ->setParameter('id', $mm->getEservRole()->getContactId())
                ->getQuery();
        $FormattedQuery = $this->coreFunctions->GetOutputFormat($display_name, 'array');

        return $FormattedQuery[0]['displayName'];
    }

    public function checkUserExistsBySalt($salt) {
        $user = $this->em
                ->getRepository('ESERVMAINSecurityBundle:User')
                ->findOneBy(array('salt' => $salt));
        return $user;
    }

    public function getUserIdBySalt($salt) {
        $user = $this->em
                ->getRepository('ESERVMAINSecurityBundle:User')
                ->findOneBy(array('salt' => $salt));
        return $user->getId();
    }

    public function checkRelationshipExistsByContactIdA($contact_id_a) {

        $relationship = $this->em
                ->getRepository('ESERVMAINContactBundle:Relationship')
                ->findOneBy(array('contact_id_a' => $contact_id_a));

        return $relationship;
    }

    public function createNewTable($table_name, $driver) {
        switch ($driver) {
            case 'sqlsrv':
                return "CREATE TABLE " . $table_name . " (ID int IDENTITY(1,1) PRIMARY KEY )";
                break;
            case 'pdo_mysql':
                return "CREATE TABLE IF NOT EXISTS " . $table_name . " (
                        id INT(11) NOT NULL AUTO_INCREMENT,
                        entity_id INT(11),
                        PRIMARY KEY (id)); ";
                break;
            case 'oci8':
                return "CREATE TABLE " . $table_name . " (id NUMBER(11,0) GENERATED ALWAYS AS IDENTITY, entity_id NUMBER(11, 0), CONSTRAINT " . $table_name . "_pk PRIMARY KEY( id ))";
                break;
            default: return "CREATE TABLE IF NOT EXISTS " . $table_name . " (
                        id INT(11) NOT NULL AUTO_INCREMENT,
                        PRIMARY KEY (id)); ";
        }
    }

    public function alterExistingTable($data_array = array(), $driver) {
        switch ($driver) {
            case 'sqlsrv':
                return "";
                break;
            case 'pdo_mysql':
                return "ALTER TABLE " . $data_array['table_name'] . " ADD " .
                        $data_array['col_name'] . " " . $data_array['col_type'] . ""
                        . "(" . $data_array['col_size'] . ") "
                        . $data_array['col_null'] . "";
                break;
            case 'pdo_mysql':
                return "ALTER TABLE " . $data_array['table_name'] . " ADD " .
                        $data_array['col_name'] . " " . $data_array['col_type'] . ""
                        . "(" . $data_array['col_size'] . ") "
                        . $data_array['col_null'] . "";
                break;
            default: return "ALTER TABLE " . $data_array['table_name'] . " ADD " .
                        $data_array['col_name'] . " " . $data_array['col_type'] . ""
                        . "(" . $data_array['col_size'] . ") "
                        . $data_array['col_null'] . "";
        }
    }

    /**
     * Returns an array containing client fields and client field options using function getFieldNameAndType ()
     *
     * @param Array $client_table_ids (Mandatory)     
     *
     * @return Array
     * @throw n/a
     *
     */
    public function getFieldNamesAndTypes($client_table_ids = array()) {
        $fields_data_arr = array();
        if (count($client_table_ids) > 0) {

            foreach ($client_table_ids as $id) {
                $fields_data_arr[$id] = $this->getFieldNameAndType($id);
            }
        }

        return $fields_data_arr;
    }

    /**
     * Returns an array containing client fields and client field options ()
     *
     * @param Integer $client_table_id (Mandatory)     
     *
     * @return Array
     * @throw n/a
     *
     */
    public function getFieldNameAndType($client_table_id) {
        $qb1 = $this->em->createQueryBuilder();
        $result1 = $qb1->select('p.id', 'p.fieldName', 'p.symfonyFormType', 'p.title', 'c.id AS client_table_id')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientField', 'p')
                ->leftJoin('p.clientTable', 'c')
                ->where('p.clientTable = :ct_id')
                ->setParameter('ct_id', $client_table_id)
                ->getQuery();
        $FormattedQuery1 = $this->coreFunctions->GetOutputFormat($result1, 'array');

        $cf_table_id_array = array();

        foreach ($FormattedQuery1 as $fq) {
            $cf_table_id_array[] = $fq['id'];
        }


        $qb2 = $this->em->createQueryBuilder();
        $result2 = $qb2->select('p.id', 'c.label', 'c.value')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientFieldSelectOption', 'c')
                ->leftJoin('c.clientField', 'p')
                ->where('c.clientField IN (:cf_id)')
                ->setParameter('cf_id', $cf_table_id_array)
                ->getQuery();
        $FormattedQuery2 = $this->coreFunctions->GetOutputFormat($result2, 'array');
        $newArray = array();

        for ($a = 0; $a < count($FormattedQuery1); $a++) {
            $options_array = null;
            for ($b = 0; $b < count($FormattedQuery2); $b++) {
                if ($FormattedQuery1[$a]['id'] === $FormattedQuery2[$b]['id']) {
                    $options_array[$FormattedQuery2[$b]['value']] = $FormattedQuery2[$b]['label'];
                }
            }

            $newArray[$FormattedQuery1[$a]['fieldName']] = array('id' => $FormattedQuery1[$a]['id'],
                'client_table_id' => $FormattedQuery1[$a]['client_table_id'],
                'title' => $FormattedQuery1[$a]['title'],
                'symfony_form_type' => $FormattedQuery1[$a]['symfonyFormType'],
                'options' => $options_array);
        }

        return $newArray;
    }

    /**
     * Returns an array containing client table ids for a given entity name. ()
     *
     * @param Array $entity_name (Mandatory)     
     *
     * @return Array
     * @throw n/a
     *
     */
    function getTableIdsByEntityName($entity_name) {
        $entity_id = array();
        $qb1 = $this->em->createQueryBuilder();
        $result1 = $qb1->select('p.id')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientEntity', 'p')
                ->where('p.entityName = :name')
                ->setParameter('name', $entity_name)
                ->getQuery();
        $entity_id = $this->coreFunctions->GetOutputFormat($result1, 'array');


        $qb2 = $this->em->createQueryBuilder();
        $result2 = $qb2->select('c.id')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTableMap', 'p')
                ->leftJoin('p.clientTable', 'c')
                ->where('p.clientEntity IN (:en_id)')
                ->setParameter('en_id', $entity_id)
                ->getQuery();
        $FormattedQuery2 = $this->coreFunctions->GetOutputFormat($result2, 'array');

        return $FormattedQuery2;
    }

    /**
     * Returns an array containing client table names for a given table id. ()
     *
     * @param Array $table_id (Mandatory)     
     *
     * @return Array
     * @throw n/a
     *
     */
    function getClientTableNamesById($table_id) {
        $qb1 = $this->em->createQueryBuilder();
        $result1 = $qb1->select('p.id', 'p.name', 'p.title')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable', 'p')
                ->where('p.id IN (:ids)')
                ->setParameter('ids', $table_id)
                ->getQuery();
        $FormattedQuery1 = $this->coreFunctions->GetOutputFormat($result1, 'array');

        $newArray = array();
        foreach ($FormattedQuery1 as $fq) {
            $string = 'eserv_client_' . strtolower($fq['name']);
            $newArray[$fq['id']] = array('name' => $string,
                'title' => $fq['title']);
        }

        return $newArray;
    }

    function getClientTableNameById($table_id) {
        $qb1 = $this->em->createQueryBuilder();
        $result1 = $qb1->select('p.id', 'p.name', 'p.title')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable', 'p')
                ->where('p.id  = :id')
                ->setParameter('id', $table_id)
                ->getQuery();
        $FormattedQuery1 = $this->coreFunctions->GetOutputFormat($result1, 'array');

        $newArray = array();
        foreach ($FormattedQuery1 as $fq) {
            $string = 'eserv_client_' . strtolower($fq['name']);
            $newArray[$fq['id']] = array('name' => $string,
                'title' => $fq['title']);
        }

        return $newArray;
    }

    function getOnlyClientTableNameById($table_id) {

        $result = $this->em->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable')
                ->findOneBy(array('id' => $table_id));
        if ($result) {
            return $result->getName();
        } else {
            return null;
        }
    }

    public function getClientEntityIdByEntityName($entity_name, $sub_entity_name = null) {
        $new_array = array();

        //Get the id from client entity table for given $entity_name
        $qb1 = $this->em->createQueryBuilder();
        $result1 = $qb1->select('p.id')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientEntity', 'p')
                ->where('p.entityName = :name')
                ->setParameter('name', $entity_name)
                ->andWhere('p.subEntityName IS NULL')
                ->getQuery();
        $entity_id1 = $this->coreFunctions->GetOutputFormat($result1, 'array');

        //Get the id from client entity table for given $entity_name and $sub_entity_name
        $qb2 = $this->em->createQueryBuilder();
        $result2 = $qb2->select('p.id')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientEntity', 'p')
                ->where('p.entityName = :name')
                ->setParameter('name', $entity_name)
                ->andWhere('p.subEntityName = :subName')
                ->setParameter('subName', $sub_entity_name)
                ->getQuery();

        $entity_id2 = $this->coreFunctions->GetOutputFormat($result2, 'array');
        $merged_array = array_merge($entity_id1, $entity_id2);

        foreach ($merged_array as $k => $v) {
            $new_array[] = $v['id'];
        }

        return $new_array;
    }

    public function getClientTableArray($cent_id, $show_on_add_only = false) {
        $table_id_array = array();
        $table_name_array = array();
        $table_id_array_tmp = array();

        $em = $this->em;

        //Getting the client table id for given client entity id's ($cent_id)
        $result1 = $em->createQueryBuilder()
                ->select('ct.id')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTableMap', 'p')
                ->leftJoin('p.clientTable', 'ct')
                ->where('p.clientEntity IN (:entity)')
                ->setParameter('entity', $cent_id);

        if (true === $show_on_add_only) {
            $result1 = $result1->andWhere('ct.showOnAddNew = :eservShowOnAdd')
                    ->setParameter('eservShowOnAdd', 'Y');
        }

        $entity_id1 = $this->coreFunctions->GetOutputFormat($result1->getQuery(), 'array');

        //Temporarily putting client table id's into an array
        foreach ($entity_id1 as $k => $v) {
            $table_id_array_tmp[] = $v['id'];
        }

        //Iterate through client field table to check whether the given table got any fields
        if ($table_id_array_tmp) {
            foreach ($table_id_array_tmp as $f) {
                $client_table_field = $em->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientField')
                        ->findOneBy(array('clientTable' => $f));
                if (!is_null($client_table_field)) {
                    //Put the client table id in to the array if any client field exist for that client table
                    $table_id_array[] = $f;
                }
            }
        }

        $result = $em->createQueryBuilder();
        $client_table_name_array = $result->select('p.name', 'p.id', 'p.title', 'p.showOnAddNew')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable', 'p')
                ->where('p.id IN (:id)')
                ->setParameter('id', $table_id_array)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $tmp = $client_table_name_array;

        foreach ($tmp as $t) {
            $table_name_array[$t['id']] = array(
                'eserv_name' => 'eserv_client_' . strtolower($t['name']),
                'name' => $t['name'],
                'location' => '\ESERV\ClientBundle\Form\EservClient' . ucfirst($t['name']) . 'Type',
                'title' => $t['title'],
                'show_on_add_new' => $t['showOnAddNew']
            );
        }

        return $table_name_array;
    }

    public function getClientTableNamesOnly($cent_id) {
        $table_id_array = array();
        $table_name_array = array();

        $em = $this->em;
        $client_table_map = $em->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTableMap')
                ->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        if ($client_table_map) {
            foreach ($client_table_map as $f) {
                $ct_id = $f->getClientTable()->getId();
                if ($f->getClientEntity()->getId() === $cent_id) {
                    $client_table_field = $em->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientField')
                            ->findOneBy(array('clientTable' => $ct_id));
                    if (!is_null($client_table_field)) {
                        $table_id_array[] = $ct_id;
                    }
                }
            }
        }



        $result = $em->createQueryBuilder();
        $client_table_name_array = $result->select('p.name')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable', 'p')
                ->where('p.id IN (:id)')
                ->setParameter('id', $table_id_array)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $tmp = $client_table_name_array;

        foreach ($tmp as $t) {
            $table_name_array[] = array('name' => ucfirst($t['name']));
        }

        return $table_name_array;
    }

    public function getAltLanguagesByEntityName($entity_name) {

        $atl_languages_recs = $this->em->getRepository('ESERVMAINHelpersBundle:AltLanguageEntity')
                ->findBy(array('entityName' => $entity_name));
        $atl_languages = array();
        foreach ($atl_languages_recs as $rec) {
            $atl_languages[$rec->getAltLanguage()->getId()] = strtolower($rec->getAltLanguage()->getLanguage()->getName()) . 'Name';
        }

        return $atl_languages;
    }

    public function createAltLanguageEquivlant($alt_language_id, $entity_name, $entity_id, $alt_name) {

        $alt_language = $this->em->getRepository('ESERVMAINHelpersBundle:AltLanguage')
                ->findOneBy(array('id' => $alt_language_id));

        $alt_language_equivlant = new \ESERV\MAIN\HelpersBundle\Entity\AltLanguageEquivalent();
        $alt_language_equivlant->setAltLanguage($alt_language);
        $alt_language_equivlant->setEntityName($entity_name);
        $alt_language_equivlant->setEntityId($entity_id);
        $alt_language_equivlant->setAltName($alt_name);
        $this->em->persist($alt_language_equivlant);
        $this->em->flush();
        // return
        $alt_language_equivlant_id = $alt_language_equivlant->getId();
        if ($alt_language_equivlant_id) {
            return true;  // alt lang equv created
        } else {
            return false; // alt lang equiv not created
        }
    }

    public function getAltLanguagesEquivsByEntityNameAndEntityId($entity_name, $entity_id) {
        $atl_language_equivalents_arr = array();

        $atl_language_equivalents = $this->em->getRepository('ESERVMAINHelpersBundle:AltLanguageEquivalent')
                ->findBy(array('entityName' => $entity_name, 'entityId' => $entity_id));

        foreach ($atl_language_equivalents as $rec) {
            $atl_language_equivalents_arr[$rec->getAltLanguage()->getId()] = $rec->getAltName();
        }

        return $atl_language_equivalents_arr;
    }

    public function removeAltLanguagesEquivsByEntityNameAndEntityId($entity_name, $entity_id) {

        $atl_language_equivalents = $this->em->getRepository('ESERVMAINHelpersBundle:AltLanguageEquivalent')
                ->findBy(array('entityName' => $entity_name, 'entityId' => $entity_id));

        foreach ($atl_language_equivalents as $atl_language_equivalent) {
            $this->em->remove($atl_language_equivalent);
        }
        $this->em->flush();
    }

    public function getFullDisplayNameByContactId($contact_id) {
        $fullName = '';
        $em = $this->em;
        $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($contact_id);
        if ($contact && $contact->getContactType()) {
            if ($contact->getContactType()->getCode() == \ESERV\MAIN\Services\AppConstants::CT_PERSON) {
                $person = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(array('contact' => $contact));
                $lastName = $person->getLastName();
                $firstName = $person->getFirstName();
                $title = $person->getTitle() ? $person->getTitle()->getName() : '';
                $fullName = $title . ' ' . $firstName . ' ' . $lastName;
                # $person_id = $person->getId();
            } elseif ($contact->getContactType()->getCode() == \ESERV\MAIN\Services\AppConstants::CT_ORGANISATION) {
                // get organisation record 
                $organisation = $em->getRepository('ESERVMAINContactBundle:Organisation')->findOneBy(array('contact' => $contact));
                $fullName = $organisation->getName();
                $locale = $this->c->get('request')->getLocale();

                $language = $em->getRepository('ESERVMAINSystemConfigBundle:Language')->findOneBy(array('locale' => $locale));
                $alt_language = $em->getRepository('ESERVMAINHelpersBundle:AltLanguage')->findOneBy(array('language' => $language));
                if ($alt_language) {
                    $workplace = $em->getRepository('ESERVMAINMembershipBundle:Workplace')->findOneBy(array('organisation' => $organisation));
                    if ($workplace) {
                        $alt_language_equivalents = $em->getRepository('ESERVMAINHelpersBundle:AltLanguageEquivalent')
                                ->findOneBy(array(
                            'entityName' => \ESERV\MAIN\Services\AppConstants::WORKPLACE_ENTITY_NAME,
                            'entityId' => $organisation->getId(),
                            'altLanguage' => $alt_language
                        ));
                        $fullName = $alt_language_equivalents ? $alt_language_equivalents->getAltName() : $fullName;
                    } else {
                        $employer = $em->getRepository('ESERVMAINMembershipBundle:Employer')->findOneBy(array('organisation' => $organisation));
                        if ($employer) {
                            $alt_language_equivalents = $em->getRepository('ESERVMAINHelpersBundle:AltLanguageEquivalent')
                                    ->findOneBy(array(
                                'entityName' => \ESERV\MAIN\Services\AppConstants::EMPLOYER_ENTITY_NAME,
                                'entityId' => $organisation->getId(),
                                'altLanguage' => $alt_language
                            ));
                            $fullName = $alt_language_equivalents ? $alt_language_equivalents->getAltName() : $fullName;
                        }
                    }
                }
            }
        } else {
            throw new \Exception('Contact does not exist!', 500);
        }

        return $fullName;
    }

    public function insertMtlError($object_name, $error_message, $save_point = 'MTLERROR') {
        try {
            $em = $this->em;
            $em->getConnection()->beginTransaction($save_point);
            $mtl_error = new \ESERV\MAIN\ErrorHandlingBundle\Entity\MtlError();
            $mtl_error->setObjectName($object_name);
            $mtl_error->setErrorMessage($error_message);
            $em->persist($mtl_error);
            $em->flush();
            $em->getConnection()->Commit($save_point);            
        } catch (\Exception $ex) {
            $em->getConnection()->rollbackSavepoint($save_point);
            $logger = $this->c->get('logger');
            $msg = sprintf(
                    'An exception occurred in insertMtlError(' .
                    'DbCoreFunctions). $object_name: %s, ' .
                    '$error_message: %s. Exception message: %s'
                    , $object_name, $error_message, $ex->getMessage()
            );
            $logger->error($msg);
        }
    }

    /*
     * Name: mtl_word_translate
     * Purpose: This function is a PHP version of the Oracle mtl_word_translate
     *          function. Remove various characters and strings from the $word.
     *          Particularly used to populate person.last_name_search
     * Returns a string
     */

    public function mtl_word_translate($word) {
        $symbols = '?!"?$^&*()+-=`{}[]:@~;#<>?,./\|' . chr(39);
        $return_str = '';

        try {
            $return_str = strtoupper($word);
            $return_str = str_replace($symbols, '', $return_str);
            $return_str = str_replace(' ', '', $return_str);
            $word_length = strlen($return_str);
            if (substr($return_str, -1, 1) == 'S') {
                $return_str = substr($return_str, 0, ($word_length - 1));
            }
            if (substr($return_str, 0, 3) == 'MAC') {
                $return_str = 'MC' . substr($return_str, 3);
            }
//          Please refer to this log, 
//          http://www.mtl.uk.net/pls/logsheets/wwv_web_logsheet.update_logsheet?p_log_id=9046005//    
            if($return_str != 'ING'){
                if (substr($return_str, -3, 3) == 'ING') {
                    $return_str = substr($return_str, 0, (strlen($return_str) - 3));
                }
            }            
        } catch (\Exception $ex) {
            $this->insertMtlError(
                    sprintf(
                            'DbCoreFunctions::mtl_word_translate(%s)'
                            , $word
                    )
                    , $ex->getMessage()
            );
            $return_str = '';
        }
        
        return $return_str;
    }

#mtl_word_translate end

    /*
     * Name: person_initials
     * Purpose: Determine the initials of a person
     * 
     * Returns a string
     */

    public function person_initials($first_name, $middle_name, $last_name) {
        $return_initials = '';

        try {
            $first_name_arr = explode(' ', $first_name);
            $middle_name_arr = explode(' ', $middle_name);
            $last_name_arr = explode(' ', $last_name);
            if (is_array($first_name_arr)) {
                foreach ($first_name_arr as $key => $value) {
                    $return_initials = $return_initials . substr($value, 0, 1);
                }
            }
            if (is_array($middle_name_arr)) {
                foreach ($middle_name_arr as $key => $value) {
                    $return_initials = $return_initials . substr($value, 0, 1);
                }
            }
            if (is_array($last_name_arr)) {
                foreach ($last_name_arr as $key => $value) {
                    $return_initials = $return_initials . substr($value, 0, 1);
                }
            }
        } catch (\Exception $ex) {
            $this->insertMtlError(
                    sprintf(
                            'DbCoreFunctions::person_initials(%s, %s, %s)'
                            , $first_name, $middle_name, $last_name
                    )
                    , $ex->getMessage()
            );
            $return_initials = '';
        }

        return $return_initials;
    }

#person_initials end 
    //$param needs to be an array

    public function runRawSql($sql, $params = null) {
        $conn = $this->em->getConnection();
        $statement = $conn->prepare($sql);
        $params == null ? $statement->execute() : $statement->execute($params);
        $result = $statement->fetchAll();

        return $result;
    }

//    public function runRawSql($sql, $params = array(), $params_types = array(), $alt_conn = false) {
//        $result = array();
//        try {
//            $db_connection = null;
//            if ($alt_conn) {
//                $db_connection = $alt_conn;
//            } else {
//                $db_connection = $this->em->getConnection();
//            }
//            
//            $statement = $db_connection->prepare($sql);
//            $params = $statement->execute($params, $params_types);
//            $result = $statement->fetchAll();
////            print_r($result);
////            die;
//        } catch (\Exception $ex) {
//            throw $ex;
////            $this->insertMtlError(
////                    sprintf(
////                            'SQL: %s', $sql
////                    )
////                    , $ex->getMessage()
////            );
//        }
//
//        return $result;
//    }

    public function runRawSqlMultiCondition($comms_q) {
        $result = array();

        $tmp_arr1 = array();
        $tmp_arr2 = array();

        $comms_q1 = json_decode($this->coreFunctions->eservDecode($comms_q));
        foreach ($comms_q1 as $k1 => $v1) {
            $tmp_arr1[$k1] = $v1;
        }

        foreach ($tmp_arr1['sql_params'] as $k2 => $v2) {
            $tmp_arr2[$k2] = $v2;
        }
        if (!is_null($tmp_arr1['raw_sql']) && !is_null($tmp_arr2)) {
            $conn = $this->em->getConnection();

            $stmt = $conn->executeQuery(
                    $tmp_arr1['raw_sql'], $tmp_arr2['values'], $tmp_arr2['types']
            );
            $tmp = $stmt->fetchAll(\PDO::FETCH_NUM);
            foreach ($tmp as $k => $v) {
                $result[] = array('id' => $v[0]);
            }
        }

        return $result;
    }

    public function createDqlwithParameters($encrypt_comms_arr) {
        $sub_query = '';
        $tmp_arr1 = array();
        $tmp_arr2 = array();
        $param_arr = array();
        $search_position = 0;
        $search_start_position = 0;
        $search_end_position = 0;
        $search_length = 0;
        $count = 0;

        $comms_arr = json_decode($this->coreFunctions->eservDecode($encrypt_comms_arr)); #var_dump($comms_arr); die;
        foreach ($comms_arr as $k1 => $v1) {
            $tmp_arr1[$k1] = $v1;
        }
        foreach ($tmp_arr1['sql_params'] as $k2 => $v2) {
            $tmp_arr2[$k2] = $v2;
        }
        $dql_str = $tmp_arr1['dql'];
        $dql_str_length = strlen($dql_str);
        while ($search_position < $dql_str_length) {
            $search_end_character = ' ';
            $search_start_position = strpos($dql_str, ':', $search_position);
            if ($count > 0) {
                if ($search_start_position === FALSE) {
                    $search_position = $dql_str_length;
                } else {
                    $previous_character = substr($dql_str, ($search_start_position - 1), 1);
                    if ($previous_character == '(') {
                        $search_end_character = ')';
                    }
                    $search_end_position = strpos($dql_str, $search_end_character, $search_start_position);
                    if ($search_end_position === FALSE) {
                        $search_length = $dql_str_length;
                        $search_position = $dql_str_length;
                    } else {
                        $search_end_position = $search_end_position - 1;
                        $search_length = $search_end_position - $search_start_position + 1;
                        $search_position = $search_start_position + 1;
                    }
                    $param_arr[] = substr($dql_str, $search_start_position, $search_length);
                }
            } else {
                $search_position = $search_start_position + 1;
            }
            $count = $count + 1;
        } #while ($search_position < $dql_str_length) end

        $sub_query = $dql_str;
        foreach ($param_arr as $param_key => $param_value) {
            switch ($tmp_arr2['types'][$param_key]) {
                case \Doctrine\DBAL\Connection::PARAM_STR_ARRAY:
                    $positon1 = strpos($sub_query, $param_value);
                    $sub_query = substr_replace($sub_query, "'" . (implode("','", $tmp_arr2['values'][$param_key])) . "'", $positon1, strlen($param_value));
                    break;
                case \PDO::PARAM_STR:
                    $positon2 = strpos($sub_query, $param_value);
                    $sub_query = substr_replace($sub_query, "'" . $tmp_arr2['values'][$param_key] . "'", $positon2, strlen($param_value));
                    break;
                default:
            }
        } #foreach ($param_arr as $param_key => $param_value)
//        var_dump($sub_query); die;

        if (strpos($sub_query, '(')) {
            $sub_query = str_replace('(', ' ', $sub_query);
        }
        return $sub_query;
    }

#createDqlwithParameters end

    public function createSqlwithParameters($encrypt_comms_arr) {
        $sub_query = '';
        $tmp_arr1 = array();
        $tmp_arr2 = array();
        $param_arr = array();

        $comms_arr = json_decode($this->coreFunctions->eservDecode($encrypt_comms_arr)); #var_dump($comms_arr); die;
        foreach ($comms_arr as $k1 => $v1) {
            $tmp_arr1[$k1] = $v1;
        }
        foreach ($tmp_arr1['sql_params'] as $k2 => $v2) {
            $tmp_arr2[$k2] = $v2;
        }
        $sql_str = $tmp_arr1['raw_sql'];

        #Replace ? with unique values so a str_replace can be done later
        $search_character = '?';
        $param_count = substr_count($sql_str, $search_character); #var_dump($counter); die;
        for ($x = 0; $x <= ($param_count - 1); $x++) {
            $sql_str = preg_replace('/\?/', (':param' . $x), $sql_str, 1);
            $param_arr[] = ':param' . $x;
        }
//        var_dump($sql_str); die;
//        var_dump($param_arr); die;

        $sub_query = $sql_str;
        foreach ($param_arr as $param_key => $param_value) {
            if (array_key_exists($param_key, $tmp_arr2['types'])) {
                switch ($tmp_arr2['types'][$param_key]) {
                    case \Doctrine\DBAL\Connection::PARAM_STR_ARRAY:
                        $positon1 = strpos($sub_query, $param_value);
                        $sub_query = substr_replace($sub_query, "'" . (implode("','", $tmp_arr2['values'][$param_key])) . "'", $positon1, strlen($param_value));
                        break;
                    case \PDO::PARAM_STR:
                        $positon2 = strpos($sub_query, $param_value);
                        $sub_query = substr_replace($sub_query, "'" . $tmp_arr2['values'][$param_key] . "'", $positon2, strlen($param_value));
                        break;
                    default:
                        throw new \Exception('Type (' . $tmp_arr2['types'][$param_key] . ') does not exist!', 500);
                }
            } else {
                //throw new \Exception('Parameters does not exist. (function - "createSqlwithParameters" in DbCoreFunctions)', 500);
            }
        }
//        var_dump($sub_query); die;

        return $sub_query;
    }

#createSqlwithParameters end   

    public function isEmployerConsortium($employerId) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('ce')
                ->from('ESERVTestBundle:GtcwVConsortiumEmployer', 'ce')
                ->Where('ce.consortiumEmployerId = :Id')
                ->setParameter('Id', $employerId)
//                ->andWhere('ce.consortiumCode = :cc')
//                ->setParameter('cc', \ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_CONSORTIUM_AREA)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        ;
        if (count($result) > 0) {
            return true;
        }
        return false;
    }

    public function eservTableTrans($fullClassName, $TableName = false) {
        $locale = $this->c->get('request')->getLocale();
        //this place needs more work.
        $tableName = $TableName != false ? $TableName : $this->getTableNameFromClassName($fullClassName);
        $classMetaData = $this->em->getClassMetadata($fullClassName);
        $defaultLocale = $this->c->getParameter('default_locale');

        $tableNameWithLocale = $tableName . '_' . $locale;

        if ($defaultLocale == $locale) {
//            $sm = $this->em->getConnection()->getSchemaManager();
//            if ($sm->tablesExist(array($tableNameWithLocale)) == true) {
//                $classMetaData->setPrimaryTable(array( 'name' => $tableNameWithLocale ));
//            }else{
            $classMetaData->setPrimaryTable(array('name' => $tableName));
//            }
        } else {
            $classMetaData->setPrimaryTable(array('name' => $tableNameWithLocale));
        }
    }

    //className = 'ABCBundle:MyTableName'
    //This function needs to workout - to be contiuned, 
    //the problem is, this returns gtcw_ev_prof_learning if the class name is 'GtcwEVProfLearning' it should return gtcw_e_v_prof_learning
    private function getTableNameFromClassName($className) {
        $explode = explode(':', $className);
        $class = $explode[1];

        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $class, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    public function getPersonByUser($userId) {
        $em = $this->em;
        $userSetting = $em->getRepository('ESERVMAINProfileBundle:MmUserSetting')->findOneBy(array('fosUser' => $userId));
//        print_r($userSetting->getContact()->getId());die;
        if ($userSetting) {
            $person = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(array('contact' => $userSetting->getContact()));
            if ($person) {
                return $person;
            }
        }
        return null;
    }

    public function getAllTableNames() {
        try {
            $databaseUser = ($this->c->hasParameter('doctrine.dbal.user') ? $this->c->getParameter('doctrine.dbal.user') : 'MERLINORA');
            $query = 'SELECT 
                        TABLE_NAME 
                        FROM dba_tables
                        --WHERE OWNER = \'' . $databaseUser . '\'
                        ORDER BY TABLE_NAME 
                    ';
            $conn = $this->c->get('database_connection');
            return array(
                'status' => true,
                'msg' => '',
                'data' => $conn->fetchAll($query)
            );
        } catch (\Exception $e) {
            return array(
                'status' => false,
                'msg' => $e->getMessage(),
                'data' => array()
            );
        }
    }

    public function getColumnsNames($params = array()) {
        $tableName = $params['table_name'];
        try {
            $databaseUser = ($this->c->hasParameter('doctrine.dbal.user') ? $this->c->getParameter('doctrine.dbal.user') : 'MERLINORA');
            $query = 'SELECT 
                        COLUMN_NAME, DATA_TYPE 
                        FROM ALL_TAB_COLS
                        WHERE OWNER = \'' . $databaseUser . '\'
                        AND TABLE_NAME = \'' . $tableName . '\'
                        ORDER BY COLUMN_NAME
                    ';
            $conn = $this->c->get('database_connection');
            return array(
                'status' => true,
                'msg' => '',
                'data' => $conn->fetchAll($query)
            );
        } catch (\Exception $e) {
            return array(
                'status' => false,
                'msg' => $e->getMessage(),
                'data' => array()
            );
        }
    }

    public function setDbToken($paramArray, $options = array()) {
        $dateFormat = 'Y-m-d H:i:s';
        if ($this->c->hasParameter('client_date_format')) {
            $clientDateFormats = $this->c->getParameter('client_date_format');
            if (is_array($clientDateFormats)) {
                $dateFormat = $clientDateFormats['date_time']['php'];
            }
        }
        
        $createdBy = $this->securityFunctions->getFosUserId();
        $paramArray['token_created_by'] = $createdBy;
        
        $jsonParam = json_encode($paramArray);
        $code = md5($jsonParam);
        if (!$this->existDbToken($code)) {
            $conn = $this->c->get('database_connection');
            $sql = "INSERT INTO php_params_web (code, value, created_at, created_by) values ( :c, :v, :created_at, :created_by)";
            $qb = $conn->prepare($sql);
            $createdAt = date($dateFormat);
            
            $qb->bindValue('c', $code, \PDO::PARAM_STR, 32);
            $qb->bindParam('v', $jsonParam, \PDO::PARAM_STR, 32000);
            $qb->bindValue('created_at', $createdAt, \PDO::PARAM_STR, 32);
            $qb->bindValue('created_by', $createdBy, \PDO::PARAM_STR, 32);
            $qb->execute();
        }
        $previousUrl = array_key_exists('previous_url', $options) ? $options['previous_url'] : array();
        if ($previousUrl) {
            $this->c->get('session')->set($code, $previousUrl);
        }
        return $code;
    }

    public function getDbToken($code, $type = 'object', $user = true) {
        $sql = "Select value from php_params_web where code = ? " . ($user ? " AND created_by = ?" : '');
        
        $paramsArray = array(
            $code
        );
        
        $paramsTypesArray = array(
            \PDO::PARAM_STR
        );
        
        if ($user) {
            array_push($paramsArray, $this->securityFunctions->getFosUserId());
            array_push($paramsTypesArray, \PDO::PARAM_INT);
        }
        $conn = $this->c->get('database_connection');
        $params = $conn->fetchAll($sql, $paramsArray, $paramsTypesArray);
        if (count($params) > 0) {
            $jsonStr = '';
            $clob = $params[0]['VALUE'];
//            echo $clob;die;
            if (is_resource($clob)) {
                while (!feof($clob)) {
                    $jsonStr .= fread($clob, 8192);
                }
            } else {
                $jsonStr = $clob;
            }
            if ($type == 'object') {
                $result = json_decode($jsonStr);
            } elseif ($type == 'array') {
                $result = json_decode($jsonStr, true);
            }
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception(json_last_error_msg(), 700);
            }
            return $result;
        } else {
            throw new \Exception('The page has expired|||' . $code, 700);
        }
    }

    public function existDbToken($code) {
        $sql = "Select value from php_params_web where code = ? AND created_by = ? ";
        $createdBy = $this->securityFunctions->getFosUserId();
        $conn = $this->c->get('database_connection');
        $params = $conn->fetchAll($sql, array($code, $createdBy), array(\PDO::PARAM_STR, \PDO::PARAM_INT));
        if (count($params) > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getQualificationMandatroyControls() {

        $qual_mand_control_recs = $this->em->getRepository('ESERVMAINQualificationBundle:QualMandControl')->findAll();
        $qual_mand_controls = array();
        foreach ($qual_mand_control_recs as $rec) {
            #$qual_mand_controls[$rec->getMembershipOrg()->getId()] = $rec->getMembershipOrg()->getOrganisation()->getName();
            $qual_mand_controls[$rec->getId()] = $rec->getMembershipOrg()->getOrganisation()->getName();
        }

        return $qual_mand_controls;
    }
    
    public function createQualMand($qualification, $qual_mand_control_id, $qual_mand_value) {

        $qual_mand_control = $this->em->getRepository('ESERVMAINQualificationBundle:QualMandControl')->findOneBy(array('id' => $qual_mand_control_id));

        $new_qual_mand = new \ESERV\MAIN\QualificationBundle\Entity\QualMand();
        # $new_qual_mand->setQualMandControl($qual_mand_control_id);
        $new_qual_mand->setQualMandControl($qual_mand_control);
        $new_qual_mand->setQualification($qualification);
        $new_qual_mand->setQualMandValue($qual_mand_value);
        $this->em->persist($new_qual_mand);
        $this->em->flush();
        
        $new_qual_mand_id = $new_qual_mand->getId();
        if ($new_qual_mand_id) {
            return true;  // qual mand record created
        } else {
            return false; // qual mand record not created
        }
    }
    
    public function getSelectedQualMand($qualification) {
        $qual_mand_recs = $this->em->getRepository('ESERVMAINQualificationBundle:QualMand')->findBy(array('qualMandValue' => 'Y', 'qualification' => $qualification));
        $selected_qual_mands = array();
        foreach ($qual_mand_recs as $rec) {
            #$qual_mand_controls[$rec->getMembershipOrg()->getId()] = $rec->getMembershipOrg()->getOrganisation()->getName();
            $selected_qual_mands[] = $rec->getQualMandControl()->getId();
        }

        return $selected_qual_mands;
    }

    public function updateQualMand($qualification, $qual_mand_control_id, $qual_mand_value) {

        $qual_mand_control = $this->em->getRepository('ESERVMAINQualificationBundle:QualMandControl')->findOneBy(array('id' => $qual_mand_control_id));
        $qual_mand = $this->em->getRepository('ESERVMAINQualificationBundle:QualMand')->findOneBy(array('qualification' => $qualification, 'qualMandControl' => $qual_mand_control_id));

        if ($qual_mand instanceof \ESERV\MAIN\QualificationBundle\Entity\QualMand) { // update
            $qual_mand->setQualMandValue($qual_mand_value);
        } else { // create
            $qual_mand = new \ESERV\MAIN\QualificationBundle\Entity\QualMand();
            $qual_mand->setQualMandControl($qual_mand_control);
            $qual_mand->setQualification($qualification);
            $qual_mand->setQualMandValue($qual_mand_value);
        }
        $this->em->persist($qual_mand);
        $this->em->flush();

        $qual_mand_id = $qual_mand->getId();
        if ($qual_mand_id) {
            return true;  // qual mand record created
        } else {
            return false; // qual mand record not created
        }
    }

}
