<?php

namespace ESERV\MAIN\CommunicationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\CoreFunctions;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $entity_id = $request->get('entity_id');
        $entity_name = $request->get('entity_name');
        $category_id = $request->get('category_id');
        $contact_id = $request->get('contact_id');
        $comms_q = $request->get('CommsQ', '0');
//        $type = $request->get('Type','0');
        $csl_code = $request->get('csl_code', '');

        return $this->render('ESERVMAINCommunicationsBundle:Default:index.html.twig', array(
                    'entity_id' => $entity_id,
                    'entity_name' => $entity_name,
                    'category_id' => $category_id,
                    'contact_id' => $contact_id,
                    'comms_q' => $comms_q,
//                    'type' => $type
                    'csl_code' => $csl_code
                        )
        );
    }

    public function getMailMergeFieldsAction(Request $request)
    {

        $mailmerge_type = $request->get('mailmerge_type');

        $fields = array();

        $qb = $this->getDoctrine()->getManager()->createQueryBuilder();

        $result = $qb->select('m.name')
                ->from('ESERVMAINTemplateBundle:MailMergeField', 'm')
                ->where('m.mailMergeFieldType = :mailmerge_type')
                ->setParameter('mailmerge_type', $mailmerge_type)
                ->orderBy('m.name')
        ;
//                ->leftJoin('ESERV\MAIN\TemplateBundle\Entity\MailMergeTypeField', 'mmtf')
//                ->leftJoin('ESERV\MAIN\TemplateBundle\Entity\MailMergeType', 'mmt');
//                ->leftJoin('m.mail_merge_field_type', 'mm')
//                ->leftJoin('mm.mail_merge_type', 'mt')
//                ->where('mmt.value = :mailmerge_type')
//                ->setParameter('mailmerge_type', $mailmerge_type);

        if ($result) {
            $fields = $this->container->get('core_function_services')->GetOutputFormat($result->getQuery(), 'array');
        }

        $final_fields = array();

        foreach ($fields as $key => $value) {
            $final_fields[] = str_replace(array('{', '}'), '', $value['name']);
        }

        $mail_merge_fields = array(
            'fields' => $final_fields
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($mail_merge_fields);
        } else {
            return null;
        }
    }

    public function viewMultipleRecipientsAction(Request $request)
    {
        $commsQ = $request->get('CommsQ', '0');
        $comm_type = $request->get('comm_type', \ESERV\MAIN\Services\AppConstants::COMM_LETTER);
        $csl_code = $request->get('csl_code', '');
        $no_email = $request->get('no_email', 'N');
        $em = $this->getDoctrine()->getManager();
        $result = null;
        $th_arr = array();
        $twig = 'ESERVMAINCommunicationsBundle:Default:view_multiple_recipients.html.twig';

        if ($commsQ !== '0') {
            switch ($csl_code) {
                case \ESERV\MAIN\Services\AppConstants::CSL_TEACHER_CODE:
                    switch ($comm_type) {
                        case \ESERV\MAIN\Services\AppConstants::COMM_EMAIL:
//                            $cols = array('Reference No', 'First Name', 'Last Name', 'Email Address');
                            $twig = 'ESERVMAINCommunicationsBundle:Default:view_multiple_recipients_teach_email.html.twig';
                            break;
                        case \ESERV\MAIN\Services\AppConstants::COMM_LETTER:
//                            $cols = array('Reference No', 'Initials', 'First Name', 'Last Name', 'Date of Birth', 'Gender');
                            $twig = 'ESERVMAINCommunicationsBundle:Default:view_multiple_recipients_teach_letter.html.twig';
                            break;
                        default:
                            $tmp1 = $this->get('db_core_function_services')->runRawSqlMultiCondition($commsQ);
                            $c_ids = array();
                            foreach ($tmp1 as $c => $v) {
                                $c_ids[] = $v['id'];
                            }
                            $arr_999_chunks = array_chunk($c_ids, 999);
                            foreach ($arr_999_chunks as $ak => $av) {
                                $a = $em->getRepository('ESERVMAINContactBundle:Person')->getPersonInfoByContactIds($av);
                                foreach ($a as $k => $v) {
                                    $result[$k]['referenceNo'] = $v->getReferenceNo();
                                    $result[$k]['initials'] = $v->getInitials();
                                    $result[$k]['firstName'] = $v->getFirstName();
                                    $result[$k]['lastName'] = $v->getLastName();
                                    $result[$k]['dateOfBirth'] = $v->getDateOfBirth();
                                    $result[$k]['gender'] = $v->getGender();
                                }
                            }
                    } #switch ($comm_type) end
                    break;
                default:
                    $tmp1 = $this->get('db_core_function_services')->runRawSqlMultiCondition($commsQ);
                    $c_ids = array();
                    foreach ($tmp1 as $c => $v) {
                        $c_ids[] = $v['id'];
                    }
                    $arr_999_chunks = array_chunk($c_ids, 999);
                    foreach ($arr_999_chunks as $ak => $av) {
                        $a = $em->getRepository('ESERVMAINContactBundle:Person')->getPersonInfoByContactIds($av);
                        foreach ($a as $k => $v) {
                            $result[$k]['referenceNo'] = $v->getReferenceNo();
                            $result[$k]['initials'] = $v->getInitials();
                            $result[$k]['firstName'] = $v->getFirstName();
                            $result[$k]['lastName'] = $v->getLastName();
                            $result[$k]['dateOfBirth'] = $v->getDateOfBirth();
                            $result[$k]['gender'] = $v->getGender();
                        }
                    }
            }
        }
        return $this->render($twig, array(
                    'result' => $result,
                    'th_arr' => $th_arr,
                    'commsQ' => $commsQ,
                    'no_email' => $no_email
                )
        );
    }

    public function letterListRecipientsDtAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $commsQ = $request->get('commsQ');
        $sortCol = $request->get('iSortCol_0');
        $sortDir = $request->get('sSortDir_0');
        $sub_query = $this->get('db_core_function_services')->createDqlwithParameters($commsQ);


        $disp_columns = array(
            'e.referenceNo',
            'e.initials',
            'e.firstName',
            'e.lastName',
            'e.dateOfBirth',
            'e.gender'
        );

        $data_arr = $em->getRepository('ESERVMAINContactBundle:EservVContactPerson')->getDataBySubQuery($sub_query, $disp_columns, array(
            'term' => $request->get('sSearch'),
            'sortCol' => $sortCol,
            'sortDir' => $sortDir,
            'offset' => $request->get('iDisplayStart'),
            'limit' => $request->get('iDisplayLength'),
        ));

        $count = $em->getRepository('ESERVMAINContactBundle:EservVContactPerson')->getDataBySubQuery($sub_query, $disp_columns, array(
            'term' => $request->get('sSearch'),
                ), true);
        $new_arr = array();

        //accessing only visible columns
        foreach ($data_arr as $k => $v) {
            $arr = array(
                $v['referenceNo'],
                $v['initials'],
                $v['firstName'],
                $v['lastName'],
                ($v['dateOfBirth'] instanceof \DateTime ? $v['dateOfBirth']->format('d-M-Y') : $v['dateOfBirth']),
                $v['gender']
            );
            $new_arr[$k] = $arr;
        }

        $array = $new_arr;
        $total = intval($count);

        //preparing the final output
        $final_array = $array;

        $response = array(
            "sEcho" => intval($request->get('sEcho')),
            "iTotalRecords" => $total,
            "iTotalDisplayRecords" => $total,
            "iDisplayStart" => intval($request->get('iDisplayStart')),
            "iDisplayLength" => $request->get('iDisplayLength'),
            "aaData" => $final_array,
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }

    public function emailListRecipientsDtAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $commsQ = $request->get('commsQ');
        $no_email = $request->get('noEmail');
        $sortCol = $request->get('iSortCol_0');
        $sortDir = $request->get('sSortDir_0');
        $sub_query = $this->get('db_core_function_services')->createDqlwithParameters($commsQ);

        $disp_columns = array(
            'e.referenceNo',
            'e.firstName',
            'e.lastName',
            'e.emailAddress',
        );

        $data_arr = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVContactEmail')->getNoEmailAddressForList($sub_query, $no_email, $disp_columns, array(
            'term' => $request->get('sSearch'),
            'sortCol' => $sortCol,
            'sortDir' => $sortDir,
            'offset' => $request->get('iDisplayStart'),
            'limit' => $request->get('iDisplayLength'),
        ));
        $count = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVContactEmail')->getNoEmailAddressForList($sub_query, $no_email, $disp_columns, array(
            'term' => $request->get('sSearch'),
                ), true);

        $new_arr = array();

        //accessing only visible columns
        foreach ($data_arr as $k => $v) {
            $arr = array(
                $v['referenceNo'],
                $v['firstName'],
                $v['lastName'],
                $v['emailAddress']
            );
            $new_arr[$k] = $arr;
        }

        $array = $new_arr;
        $total = intval($count);

        //preparing the final output
        $final_array = $array;

        $response = array(
            "sEcho" => intval($request->get('sEcho')),
            "iTotalRecords" => $total,
            "iTotalDisplayRecords" => $total,
            "iDisplayStart" => intval($request->get('iDisplayStart')),
            "iDisplayLength" => $request->get('iDisplayLength'),
            "aaData" => $final_array,
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }

    function validateDate($date, $format = 'd-M-Y')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

}
