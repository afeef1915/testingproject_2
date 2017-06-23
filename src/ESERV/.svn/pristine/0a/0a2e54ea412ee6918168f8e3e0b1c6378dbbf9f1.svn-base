<?php

namespace ESERV\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\Services\AppConstants;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('ESERVTestBundle:Default:index.html.twig', array('name' => $name));
    }

    public function autocompleteTestAction(Request $request) {
        $param = $request->get('param');
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder();

        $ac_query = $qb->select('t')
                ->from('ESERVTestBundle:GtcwVEmployer', 't')
                ->where('t.name LIKE :name')
                ->setParameter('name', "%$param%");

        if (!$ac_query) {
            $ac_result = array();
        } else {
            $ac_result = $this->container->get('core_function_services')->GetOutputFormat($ac_query->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['name'] . ' <strong>(' . $obj['code'] . ')</strong><br /><small>Deactivated!</small>',
                'result' => $obj['name'],
                'value' => $obj['organisation_id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }

    public function generatePdfAction() {
        $html = '<div style="color:red">Samir</div>';
        return new Response(
                $this->container->get('knp_snappy.pdf')->getOutputFromHtml($html), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'filename="testme.pdf"'
        ));
    }

    public function testTeacherTransferAction(Request $request) {
        $message = 'Success';

        $result = array(
            'success' => true,
            'msg' => $message,
            'errors' => array(),
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

    public function urlTestAction() {
        return $this->render('ESERVTestBundle:Default:test.html.twig', array());
    }

    public function addAction() {
//        print_r($this->getClientTableArrayAction());die;
        $action_url = $this->generateUrl('gtcw_contact_create_test2');
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\PersonType($this->getDoctrine()->getEntityManager()), null, array(
            'action' => $action_url,
        ));

        return $this->render(
                        'ESERVTestBundle:Default:contact.html.twig', array('form' => $form->createView())
        );
    }

    public function saveAction(Request $request) {

        $person = new \ESERV\MAIN\ContactBundle\Entity\Person();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\PersonType($this->getDoctrine()->getEntityManager()), $person);
        $form->handleRequest($request);
        $em1 = $this->getDoctrine()->getEntityManager();

        $em1->getConnection()->beginTransaction();
        if ($form->isValid()) {

            $person_data = $form->getData();

            try {
                #$person = new \ESERV\MAIN\ContactBundle\Entity\Person();

                $em1->persist($person_data->getContact());

                $person_client_table_array = $this->getClientTableArrayAction();

                foreach ($person_client_table_array as $key => $value) {
                    $tmp = 'eservClient' . ucfirst($value['name']);
                    $em1->persist($person_data->$tmp);
                }


                $em1->persist($person_data);
                $em1->flush();
                $em1->getConnection()->commit();
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred : ' . $e->getMessage()));
            }
        }
        $em1->close();
    }

    public function deleteGroupAction($id) {
        $em1 = $this->getDoctrine()->getEntityManager();
        $ctm_entity = $em1->getRepository('ESERVClientBundle:ClientTableMap')->findOneBy(array(
            'clientTable' => $id));

        $ct_entity = $em1->getRepository('ESERVClientBundle:ClientTable')->findOneBy(array(
            'id' => $id));

        if ($ctm_entity) {
            $file_name = 'EservClient' . ucfirst($ct_entity->getName());
            $table_name = 'eserv_client' . lcfirst($ct_entity->getName());
            $query1 = $em1->createQuery("DELETE ESERVClientBundle:ClientTableMap c WHERE c.clientTable = $id");
            $query1->execute();

            $query2 = $em1->createQuery("DELETE ESERVClientBundle:ClientField c WHERE c.clientTable = $id");
            $query2->execute();

//            $query3 = $em1->createQuery("DROP TABLE $table_name");
//            $query3->execute();

            $em1->remove($ct_entity);
            $em1->flush();


            $entitiy_file = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                    . DIRECTORY_SEPARATOR . 'ClientBundle' . DIRECTORY_SEPARATOR . 'Entity' . DIRECTORY_SEPARATOR . $file_name . '.php';
            $orm_file = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                    . DIRECTORY_SEPARATOR . 'ClientBundle' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR
                    . 'config' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . $file_name . '.orm.yml';
            $form_file = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                    . DIRECTORY_SEPARATOR . 'ClientBundle' . DIRECTORY_SEPARATOR . 'Form' . DIRECTORY_SEPARATOR . $file_name . 'Type.php';

            if (!unlink($entitiy_file)) {
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Problem deleting the entity file'));
            }
            if (!unlink($orm_file)) {
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Problem deleting the orm file'));
            }
            if (!unlink($form_file)) {
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Problem deleting the form file'));
            }

            $this->deleteFromEntityFileAction(ucfirst($ct_entity->getName()));


            return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Client Table has been successfully '
                        . 'deleted.'));
        } else {
            return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Custom table not found'));
        }
    }

    function deleteFromEntityFileAction($table) {
        $client_entity_file = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                . DIRECTORY_SEPARATOR . 'MAIN' . DIRECTORY_SEPARATOR . 'ContactBundle' . DIRECTORY_SEPARATOR .
                'Entity' . DIRECTORY_SEPARATOR . 'MTLEntities' . DIRECTORY_SEPARATOR . 'MyPerson.php';

        $contents = file_get_contents($client_entity_file);

        $new_content = $this->replace_content_inside_delimiters('//start_eservClient' . $table, '//end_eservClient' . $table, '', $contents);

        file_put_contents($client_entity_file, $new_content);
        if (preg_match("/\\/\\/(start_eservClient$table)/", $contents)) {
            $c = str_replace("//start_eservClient$table//end_eservClient$table", '', $new_content);
            file_put_contents($client_entity_file, $c);
        }
    }

    function replace_content_inside_delimiters($start, $end, $new, $source) {
        return preg_replace('#(' . preg_quote($start) . ')(.*)(' . preg_quote($end) . ')#si', '$1' . $new . '$3', $source);
    }

    public function getClientTableArrayAction() {
        $table_id_array = array();


        $em = $this->getDoctrine()->getEntityManager();
        $client_table_map = $em->getRepository('ESERVClientBundle:ClientTableMap')
                ->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        if ($client_table_map) {
            foreach ($client_table_map as $f) {
                if ($f->getClientEntity()->getId() === 1) {
                    $table_id_array[] = $f->getClientTable()->getId();
                }
            }
        }

        $result = $em->createQueryBuilder();
        $client_table_name_array = $result->select('p.name')
                ->from('ESERVClientBundle:ClientTable', 'p')
                ->where('p.id IN (:id)')
                ->setParameter('id', $table_id_array)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $client_table_name_array;
    }

    public function testFieldNameAndFormAction($id) {
        $arr = $this->container->get('db_core_function_services')->getFieldNameAndType($id);
        print_r($arr);
        die;
    }

    /* This has been moved to ESERVMAINCommunicationsProcesses in the CommunicationsBundle (Services)
      public function mergeLetterTestAction(Request $request) {

      $message = '';
      $status = false;
      $res_array = array();

      $function = 'mergeLetterTestAction';
      $function_result = 'Successfully executed';
      $prev_temp_ver_id = FALSE;
      $mm_field_arr = array();
      $mm_field_data_arr = array();
      $header_arr = array();
      $body_arr = array();
      $footer_arr = array();
      $act_id_arr = array();
      $mm_field_data = '';

      $em = $this->getDoctrine()->getManager();

      $result = $em->createQueryBuilder();
      $letter_merge_arr = $result->select('l')
      ->from('ESERVMAINActivityBundle:EservVMergingLetter', 'l')
      ->getQuery()
      ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
      //        print_r($letter_merge_arr); print('<br />');
      try {
      $em->getConnection()->beginTransaction();

      foreach ($letter_merge_arr as $table_arr) {
      $temp_ver_id = $table_arr['templateVersionId'] . $table_arr['shortDescription'];
      if (
      ($prev_temp_ver_id === FALSE) ||
      ($temp_ver_id !== $prev_temp_ver_id)
      ) {
      if ($prev_temp_ver_id === FALSE) {
      $current_date_time = new \DateTime();

      $act_comp_status = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityCompleteStatus();
      if (!$request->isXmlHttpRequest()) {
      print(sprintf('system_code.id: %s, system_code_type.id: %s<br /><br />', $act_comp_status->getId(), $act_comp_status->getSystemCodeType()->getId())); #die;
      }
      } else {
      #Put all of this code into a function as it needs to be done at the end of the
      #create the final PDF from temporary PDFs
      #delete the temporary PDFs
      #
      #update document_job
      $doc_job->setQueuedDate($current_date_time);
      #$doc_job->setUpdatedAt($updatedAt); should be automatically done by Symfony
      #$doc_job->setUpdatedBy($updatedBy); should be automatically done by Symfony
      $em->persist($doc_job);
      $em->flush();

      #Update activity status
      if (count($act_id_arr) > 0) {
      #
      #  UPDATE activity
      #  SET status_id = (SELECT id FROM system_code WHERE system_code_type_id = ($complete_status_id)
      #  ,status_date_time = $current_date_time
      #  ,updated_by = should be automatically done by Symfony
      #  ,updated_at = should be automatically done by Symfony
      #  WHERE id IN ($act_id_arr);
      #
      //Trying to do a update update here, but could not get this to work - try again later
      //                            $q = $em->createQuery('UPDATE ESERVMAINActivityBundle:Activity a SET a.status_id = ' . $complete_status_id[0]['id']);
      //                            $numUpdated = $q->execute();
      //                            $upd_act_qb = $em->createQueryBuilder();
      //                            $update = $upd_act_qb->update('ESERVMAINActivityBundle:Activity', 'a')
      //                                                 ->set('a.status', $qb->expr()->literal($username))
      }

      #Reset working variables
      $act_id_arr = array();
      if (!$request->isXmlHttpRequest()) {
      print(sprintf('<br /><br />', $doc_job->getId()));
      }
      }
      if (!$request->isXmlHttpRequest()) {
      print(sprintf('activity.id: %s, template_version.id: %s<br />', $table_arr['id'], $table_arr['templateVersionId']));
      }

      #create a new document_job record
      $doc_job = new \ESERV\MAIN\CommunicationsBundle\Entity\DocumentJob();
      #$doc_job->setSystemPrinterId($table_arr['system_printer_id']);
      #$item = $em->getReference('MyProject\Model\Item', $itemId); Use a proxy instead of gettng the record, as we know the document_job.system_printer_id already
      $doc_job->setSystemPrinter($em->getRepository('ESERVMAINSystemConfigBundle:SystemPrinter')->find($table_arr['systemPrinterId']));
      $em->persist($doc_job);
      $em->flush();

      #get the template_version template_id, header, body and footer. Store these as variables
      preg_match_all('/{[a-z-0-9_]*}/i', $table_arr['contentHeader'], $header_arr); #print_r($header_arr); print('<br />');
      preg_match_all('/{[a-z-0-9_]*}/i', $table_arr['contentBody'], $body_arr);  #print_r($body_arr); print('<br />');
      preg_match_all('/{[a-z-0-9_]*}/i', $table_arr['contentFooter'], $footer_arr);  #print_r($footer_arr); print('<br />');
      $mm_field_arr = array_merge($header_arr[0], $body_arr[0], $footer_arr[0]); #print_r($mm_field_arr); print('<br />');
      $mm_field_arr = array_unique($mm_field_arr);

      if (!$request->isXmlHttpRequest()) {
      print('Mail merge fields for template_version.id: ' . $table_arr['templateVersionId'] . ' - ');
      print_r($mm_field_arr);
      print('<br />');
      print(sprintf('New document_job.id: %s<br />', $doc_job->getId()));
      }

      $prev_temp_ver_id = $temp_ver_id;
      }

      #create an activity_job record
      $act_job = new \ESERV\MAIN\ActivityBundle\Entity\ActivityJob();
      $act_job->setDocumentJob($doc_job);
      #$act_job->setActivityId($table_arr['id']);
      $act = $em->getRepository('ESERVMAINActivityBundle:Activity')->find($table_arr['id']);
      #$act_job->setActivity($act);
      #$act_job->setActivity($em->getRepository('ESERVMAINActivityBundle:Activity')->find($table_arr['id']));
      $act_job->setActivity($act);
      $em->persist($act_job);
      $em->flush();

      if (!$request->isXmlHttpRequest()) {
      print(sprintf('New activity_job.id: %s<br />', $act_job->getId()));
      }

      #get the activity_target records for the letter
      $act_target_arr = $em->getRepository('ESERVMAINActivityBundle:ActivityTarget')
      ->findByActivity($table_arr['id']);
      #print_r($act_target_arr); print('<br />');
      foreach ($act_target_arr as $target_arr) {
      //                    print(sprintf('activity_target.id: %s<br />', $target_arr->getId()));
      $contact = $target_arr->getContact();
      $target_id = $target_arr->getId();

      if (count($mm_field_arr) > 0) {
      $mm_arr = self::getMailMergeFieldData(
      $mm_field_arr
      , $table_arr['entityId']
      , $table_arr['entityName']
      , $contact);
      if (array_key_exists('error', $mm_arr)) {
      $msg = sprintf(
      'activity.id: %s, ' .
      'activity_target.id: %s, ' .
      '$mm_field_arr: (%s), ' .
      'Exception in getMailMergeFieldData: %s'
      , $act->getId()
      , $target_id
      , implode(',', $mm_field_arr)
      , $mm_arr['error']
      );
      if (!$request->isXmlHttpRequest()) {
      print(sprintf('Error sending letter for activity_target.id: %s<br /><br />', $target_id));
      }
      throw new \Exception($msg);
      }
      if (!$request->isXmlHttpRequest()) {
      print('Mail merge fields data for template_version.id: ' . $table_arr['templateVersionId'] . ' - ');
      print_r($mm_arr['data_arr']);
      print('<br />');
      }
      }

      #create an activity_merge_data record
      $act_mer_data = new \ESERV\MAIN\ActivityBundle\Entity\ActivityMergeData();
      $act_mer_data->setActivityTarget($target_arr);
      $act_mer_data->setMergeFields(implode(',', $mm_field_arr));
      #$act_mer_data->setMergeData(ltrim($mm_field_data, ','));
      $act_mer_data->setMergeData($mm_arr['data_str']);
      $em->persist($act_mer_data);
      $em->flush();

      #insert code to create the temporary PDF
      $pdf_data = array(
      #'merged_data' => $mm_field_data_arr,
      'merged_data' => $mm_arr['data_arr'],
      'template_parts' => array(
      'headerHTML' => $table_arr['contentHeader'],
      'contentHTML' => $table_arr['contentBody'],
      'footerHTML' => $table_arr['contentFooter'],
      ),
      );

      //                    echo '<hr />Begin $pdf_data : <br />';
      //                    print_r($pdf_data);
      //                    echo '<hr />';
      #$this->generatePdf($pdf_data, $table_arr['id'] . '_' . $target_id);
      $this->generatePdf($pdf_data, $table_arr['id']);

      //                    generatePDF($pdf_data);

      $mm_field_data = '';

      if (!$request->isXmlHttpRequest()) {
      print(sprintf('New activity_merge_data.id: %s<br />', $act_mer_data->getId()));
      }
      } #foreach ($act_target_arr as $target_arr)
      #Change this to a bulk update later on but for now update each activity when going through the loop
      $act_id_arr[] = $table_arr['id'];
      $act->setStatusDateTime($current_date_time);
      $act->setStatus($act_comp_status);
      $em->persist($act);
      $em->flush($act);
      } #foreach ($letter_merge_arr as $table_arr)

      if (count($act_id_arr) > 0) {
      #Put all of this code into a function as it is done in the loop above when the template_version.id changes
      #create the final PDF from temporary PDFs
      #delete the temporary PDFs
      #
      #update document_job
      $doc_job->setQueuedDate($current_date_time);
      #$doc_job->setUpdatedAt($updatedAt); should be automatically done by Symfony
      #$doc_job->setUpdatedBy($updatedBy); should be automatically done by Symfony
      $em->persist($doc_job);
      $em->flush();

      #
      #  UPDATE activity
      #  SET status_id = (SELECT id FROM system_code WHERE system_code_type_id = (SELECT id FROM system_code WHERE code = 'ACTSTAT') AND code = 'C' AND name = 'Complete')
      #  ,status_date_time = $current_date_time
      #  ,updated_by = should be automatically done by Symfony
      #  ,updated_at = should be automatically done by Symfony
      #  WHERE id IN ($act_id_arr);
      #
      //Trying to do a update update here, but could not get this to work - try again later
      //                Update using RAW SQL - not ideal but it works
      //                $conn = $em->getConnection();
      //                $sql = "UPDATE activity " .
      //                          "SET status_date_time = '" . date('Y-m-d H:i:s') . "'" .
      //                             ",status_id = " . $act_comp_status->getId() .
      //                      " WHERE id IN ('" . implode($act_id_arr, "','") .  "')";
      //                $num_rows_effected = $conn->exec($sql);
      //
      //                print(sprintf('$act_id_arr: (%s)', implode(',', $act_id_arr)));
      //                $qb = $em->createQueryBuilder();
      //                $upd = $qb->update('ESERVMAINActivityBundle:Activity', 'a')
      //                          #->set('a.status', $act_comp_status)
      //                          ->set('a.statusDateTime', $current_date_time)
      //                          #->set('a.status = :status')
      //                          #->setParameter('status', $act_comp_status)
      //                          ->where('a.id IN (:id)')
      //                          ->setParameter('id', $act_id_arr)
      //                          ->getQuery();
      //                $result = $upd->execute();
      }

      $message = 'Completed Successfully';
      $status = true;

      $em->getConnection()->commit();
      } catch (\Exception $ex) {

      $message = $ex->getMessage();
      $em->getConnection()->rollback();

      $this->container
      ->get('db_core_function_services')
      ->insertMtlError($function, $message);

      if (!(is_array($function_result))) {
      $function_result = array();
      }
      $function_result['error'] = 'Error processing letter - ' . $message;
      }

      $res_array = array(
      'success' => $status,
      'msg' => $message
      );

      if ($request->isXmlHttpRequest()) {
      return new \Symfony\Component\HttpFoundation\JsonResponse($res_array);
      } else {
      print(sprintf('<br />mergeLetterTest completed'));
      die;

      return $function_result;
      }
      } #mergeLetterTestAction end
     */

    /* This has been moved to ESERVMAINCommunicationsProcesses in the CommunicationsBundle (Services)
      public function generatePdfHTML($data_array, $id = '') {
      $html = '';

      foreach ($data_array['template_parts'] as $key => $value) {
      $html .= $value;
      }

      $html = str_replace(array_keys($data_array['merged_data']), array_values($data_array['merged_data']), $html);

      $this->get('knp_snappy.pdf')->generateFromHtml(
      $html, "file_$id.pdf"
      );
      }
     */
    /* This has been moved to ESERVMAINCommunicationsProcesses in the CommunicationsBundle (Services)
      public function generatePdf($data_array, $id = '') {
      #$html = '<div style="color:red">Samir</div>';
      //        return new Response(
      //                $this->container->get('knp_snappy.pdf')->getOutputFromHtml($html), 200, array(
      //            'Content-Type' => 'application/pdf',
      //            'Content-Disposition' => 'filename="testme.pdf"'
      //        ));
      //        $pdf_data = array(
      //                        'merged_data' => $mm_field_data_arr,
      //                        'template_parts' => array(
      //                            'headerHTML' => $table_arr['contentHeader'],
      //                            'contentHTML' => $table_arr['contentBody'],
      //                            'footerHTML' => $table_arr['contentFooter'],
      //                        ),
      //                    );

      $html = '';

      foreach ($data_array['template_parts'] as $key => $value) {
      $html .= $value;
      }

      $web_folder = $this->get('kernel')->getRootDir() . '/../web/';
      $css_file = $web_folder . 'common/assets/libs/merlin/css/mtl_ckeditor.css';

      $css_contents = '<style type="text/css">' . file_get_contents($css_file) . '</style>';

      $html = '<html>'
      . '<head>' . $css_contents . '</head>'
      . '<body>' . str_replace(array_keys($data_array['merged_data']), array_values($data_array['merged_data']), $html) . '</body>'
      . '</html>';

      $folder = $web_folder . 'tmp/print_queue/Complete/';

      if (!file_exists($folder . "file_$id.pdf")) {
      $this->get('knp_snappy.pdf')->generateFromHtml(
      $html, $folder . "file_$id.pdf"
      );
      }
      }
     */

    public function sendEmailTestAction() {

        // SAMIR EDIT
        // The lines below are for testing only and will be removed next release 1.0.2
        $res_array = array(
            'success' => $status,
            'msg' => $message
        );
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($res_array);
        } else {
            print(sprintf('<br />mergeLetterTest completed'));
            die;

            return $function_result;
        }
        die;
        // End SAMIR EDIT

        $function_result = 'Successfully executed';
        $function = 'sendEmailTestAction';

        try {
            $prev_temp_ver_id = FALSE;
            $header_arr = array();
            $body_arr = array();
            $footer_arr = array();
            $mm_field_arr = array();
            $act_id_arr = array();
            $success = TRUE;

            $em = $this->getDoctrine()->getManager();

            $result = $em->createQueryBuilder();
            $email_arr = $result->select('l')
                    ->from('ESERVMAINActivityBundle:EservVOutstandingEmail', 'l')
                    ->getQuery()
                    ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
//        print_r($email_arr); print('<br />');

            foreach ($email_arr as $email) {
                print(sprintf('activity.id: %s, template_version.id: %s, activity.short_description: %s<br />', $email['id'], $email['templateVersionId'], $email['shortDescription']));
                $temp_ver_id = $email['templateVersionId'] . $email['shortDescription'];

                $act = $em->getRepository('ESERVMAINActivityBundle:Activity')->find($email['id']);

                if (
                        ($prev_temp_ver_id === FALSE) ||
                        ($temp_ver_id !== $prev_temp_ver_id)
                ) {
                    if ($prev_temp_ver_id === FALSE) {
                        $current_date_time = new \DateTime();

                        $act_comp_status = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityCompleteStatus();
                        $email_queued = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityQueuedSendingStatus();
                        $email_sending = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityEmailSendingStatus();
                        $email_sent = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityEmailSentStatus();
                        print(sprintf('Statuses (system_code.id)<br />Activity complete: %s, Email sending: %s, Email sent: %s<br /><br />', $act_comp_status->getId(), $email_sending->getId(), $email_sent->getId())); #die;
                    }

                    #get the mail merge fields for the header, body and footer
                    preg_match_all('/{[a-z-0-9_]*}/i', $email['contentHeader'], $header_arr); #print_r($header_arr); print('<br />');
                    preg_match_all('/{[a-z-0-9_]*}/i', $email['contentBody'], $body_arr);  #print_r($body_arr); print('<br />');
                    preg_match_all('/{[a-z-0-9_]*}/i', $email['contentFooter'], $footer_arr);  #print_r($footer_arr); print('<br />');
                    $mm_field_arr = array_merge($header_arr[0], $body_arr[0], $footer_arr[0]); #print_r($mm_field_arr); print('<br />');
                    $mm_field_arr = array_unique($mm_field_arr);
                    print('Mail merge fields for template_version.id: ' . $email['templateVersionId'] . ' - ');
                    print_r($mm_field_arr);
                    print('<br /><br />');

                    $prev_temp_ver_id = $temp_ver_id;
                }
                $attachs = $em->getRepository('ESERVMAINMediaBundle:MediaStore')
                        ->getByEntityNameAndEntityId(
                        'Activity', $email['id']);

                #get the activity_target records for the emails
                $act_target_arr = $em->getRepository('ESERVMAINActivityBundle:ActivityTarget')
                        ->findByActivity($email['id']);
//            #print_r($act_target_arr); print('<br />');
                foreach ($act_target_arr as $act_target) {
                    try {
                        $act_email = $em->getRepository('ESERVMAINActivityBundle:ActivityEmail')
                                ->findOneByActivityTarget($act_target);
                        if (
                                ($act_email instanceof \ESERV\MAIN\ActivityBundle\Entity\ActivityEmail) &&
                                ($act_email->getEmailStatusSystemCode()->getId() == $email_queued->getId())
                        ) {
                            print(sprintf('Start sending the email for activity_email. activity_email.id: %s, activity_email.activity_target_id: %s, activity_email.to_email_address: %s<br />', $act_email->getId(), $act_target->getId(), $act_email->getToEmailAddress()));

                            $em->getConnection()->beginTransaction(); #this is not working
                            $act_email->setEmailStatusSystemCode($email_sending);
                            $act_email->setStatusDate($current_date_time);
                            $em->persist($act_email);
                            $em->flush();
                            $em->getConnection()->commit();

                            $contact = $act_target->getContact();
                            if (count($mm_field_arr) > 0) {
                                $mm_arr = self::getMailMergeFieldData($mm_field_arr, $email['entityId'], $email['entityName'], $contact);
                                if (array_key_exists('error', $mm_arr)) {
                                    $msg = sprintf(
                                            'activity.id: %s, ' .
                                            'activity_target.id: %s, ' .
                                            '$mm_field_arr: (%s), ' .
                                            'Exception in getMailMergeFieldData: %s'
                                            , $act->getId()
                                            , $act_target->getId()
                                            , implode(',', $mm_field_arr)
                                            , $mm_arr['error']
                                    );
                                    print(sprintf('Error sending the email for activity_email. activity_email.id: %s, activity_email.activity_target_id: %s, activity_email.to_email_address: %s<br /><br />', $act_email->getId(), $act_target->getId(), $act_email->getToEmailAddress()));
                                    throw new \Exception($msg);
                                }
                            }

                            #print_r($mm_arr); print('<br />'); 
                            #create an activity_merge_data record
                            $act_mer_data = new \ESERV\MAIN\ActivityBundle\Entity\ActivityMergeData();
                            $act_mer_data->setActivityTarget($act_target);
                            $act_mer_data->setMergeFields(implode(',', $mm_field_arr));
                            $act_mer_data->setMergeData($mm_arr['data_str']);
                            $em->persist($act_mer_data);
                            $em->flush();

                            #insert code to send the email
                            #after sending the email do some error checking to see if the email was sent successfully
                            #if the email was not sent successfully sent the activity_email.email_status_system_code_id back to queued
//                      $act_email->setEmailStatusSystemCode($email_queued);
//                      $em->persist($act_email);
//                      $em->flush();
                            #else set the status of the email to sent
                            $act_email->setEmailStatusSystemCode($email_sent);
                            $act_email->setStatusDate($current_date_time);
                            $em->persist($act_email);
                            $em->flush();
                            /* CIEH code in batchEmailProcess.php
                              if ($success) {
                              $send_Email = $this->sendEmail();
                              if ($send_Email['success']) {
                              $this->builder->changeActivityStatus($activityTarget->getActivityId(), $act_complete_status_id);
                              $this->builder->changeActivityEmailStatus($activityEmail->getId(), $act_email_sent_status_id);
                              } else {
                              // Reset activity_email status to its previous value because the email could not be sent due to a "connection" problem.
                              if (
                              (
                              (stripos($send_Email['exc_msg'], "connection") !== false) ||
                              (stripos($send_Email['exc_msg'], "Could not open socket") !== false) ||
                              (stripos($send_Email['exc_msg'], "Could not read from") !== false)
                              ) &&
                              (is_object($activityEmail))
                              ) {
                              if (is_null($previous_status)) {
                              $previous_status = $act_email_queued_status_id;
                              }
                              $this->builder->changeActivityEmailStatus($activityEmail->getId(), $previous_status);
                              MerlinUtil::logit('Reset activity_email status to queued where activity_email.id = '.$activityEmail->getId().
                              ', as sending email failed with the follwoing error = '.$send_Email['exc_msg']);
                              }
                              }
                              } else {
                              #Reset activity_email to its previous value because the
                              #email could not be sent - if it is a batch results email
                              #the verfication report attachment does not exist
                              if (is_object($activityEmail)) {
                              #Not sure why this check needs to be done as it should
                              #be populated (above)
                              if (is_null($previous_status)) {
                              $previous_status = $act_email_queued_status_id;
                              }
                              $activityEmail->set('email_status_system_code_id', $previous_status);
                              $activityEmail->save();
                              }
                              }
                             */


                            print(sprintf('Finished sending the email for activity_email. activity_email.id: %s, activity_email.activity_target_id: %s, activity_email.to_email_address: %s<br /><br />', $act_email->getId(), $act_target->getId(), $act_email->getToEmailAddress()));
                        }
                    } catch (\Exception $ex) {
                        $error_msg = sprintf(
                                'activity.id: %s, ' .
                                'activity_target.id: %s, ' .
                                'Exception: %s'
                                , $act->getId()
                                , $act_target->getId()
                                , $ex->getMessage()
                        );
                        $this->container
                                ->get('db_core_function_services')
                                ->insertMtlError($function, $error_msg);
                        if (!(is_array($function_result))) {
                            $function_result = array();
                        }
                        $function_result['error'][] = 'Error processing email (activity.id: ' . $email['id'] . ')';
                        $success = FALSE;
                    }
                } #foreach ($act_target_arr as $target_arr)

                if ($success === TRUE) {
                    #Change this to a bulk update later on but for now update each activity when going through the loop
                    #Move the update to the repository later
                    $act->setStatusDateTime($current_date_time);
                    $act->setStatus($act_comp_status);
                    $em->persist($act);
                    $em->flush($act);
                    #$act_id_arr[] = $email['id'];
                }
                $success = TRUE;
            } #foreach ($email_arr as $email)

            if (
                    (count($act_id_arr) > 0)
            ) {
                #Do a bulk update of all activity records setting the activity status to complete
//            /*
//            UPDATE activity 
//            SET status_id = (SELECT id FROM system_code WHERE system_code_type_id = (SELECT id FROM system_code WHERE code = 'ACTSTAT') AND code = 'C' AND name = 'Complete')
//               ,status_date_time = $current_date_time
//               ,updated_by = should be automatically done by Symfony
//               ,updated_at = should be automatically done by Symfony
//            WHERE id IN ($act_id_arr);
//            */
//Trying to do a update update here, but could not get this to work - try again later
//                Update using RAW SQL - not ideal but it works
//                $conn = $em->getConnection();
//                $sql = "UPDATE activity " . 
//                          "SET status_date_time = '" . date('Y-m-d H:i:s') . "'" . 
//                             ",status_id = " . $act_comp_status->getId() .
//                      " WHERE id IN ('" . implode($act_id_arr, "','") .  "')";                
//                $num_rows_effected = $conn->exec($sql);
//                
//                
//                print(sprintf('$act_id_arr: (%s)', implode(',', $act_id_arr)));
//                $qb = $em->createQueryBuilder();
//                $upd = $qb->update('ESERVMAINActivityBundle:Activity', 'a')
//                          #->set('a.status', $act_comp_status)
//                          ->set('a.statusDateTime', $current_date_time)
//                          #->set('a.status = :status')
//                          #->setParameter('status', $act_comp_status)
//                          ->where('a.id IN (:id)')
//                          ->setParameter('id', $act_id_arr)
//                          ->getQuery();
//                $result = $upd->execute();            
            }

            print(sprintf('<br />sendEmailTest completed'));
            die;
        } catch (\Exception $ex) {
            $this->container
                    ->get('db_core_function_services')
                    ->insertMtlError($function, $ex->getMessage());
            if (!(is_array($function_result))) {
                $function_result = array();
            }
            $function_result['error'][] = 'Error processing email (activity.id: ' . $email['id'] . ')';
        }

        return $function_result;
    }

#sendEmailTestAction

    public function getMailMergeFieldData($field_arr, $entity_id, $entity_name, $contact) {
        $return_array = array();
        $field_data_arr = array();
        $field_data_str = '';

        try {
//            throw new \Exception('Force an error in getMailMergeFieldData');

            $em = $this->getDoctrine()->getManager();

            switch ($entity_name) {
                case 'Contact':
                    $address = FALSE;
                    $person = $em->getRepository('ESERVMAINContactBundle:Person')->findOneByContact($contact);
                    $address_arr = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->findByContact($contact);
                    $emp_detail = $em->getRepository('ESERVMAINMembershipBundle:EmploymentDetail')->findOneByContact($contact);
                    $employer = FALSE;
                    $wp_address = FALSE;
                    $country_name = '';
                    $country_code = '';
                    $wp_country_name = '';
                    $wp_country_code = '';
                    if ($emp_detail) {
                        $employer = $emp_detail->getEmployer();
                        $workplace = $emp_detail->getWorkplace();

                        if ($workplace) {
                            $wp_org = $workplace->getOrganisation();
                            if ($wp_org) {
                                $wp_contact = $wp_org->getContact();
                                if ($wp_contact) {
                                    $wp_address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->findOneByContact($wp_contact);
                                }
                                if ($wp_address) {
                                    $add_country = $wp_address->getCountry();
                                    if ($add_country) {
                                        $wp_country_name = $add_country->getDescription();
                                        $wp_country_code = $add_country->getCode();
                                    }
                                }
                            }
                        }
                    }

                    if ($address_arr) {
                        foreach ($address_arr as $addr) {
                            $address_type_code = $addr->getAddressType()->getCode();
                            if ($address === FALSE) {
                                $address = $addr;
                            } else {
                                if ($address_type_code === AppConstants::AT_HOME) {
                                    $address = $addr;
                                }
                            }
                            if ($address_type_code === AppConstants::AT_HOME) {
                                break;
                            }
                        }
                        if ($address) {
                            $add_country = $address->getCountry();
                            if ($add_country) {
                                $country_name = $add_country->getDescription();
                                $country_code = $add_country->getCode();
                            }
                        }
                    }
                    $title_desc = '';
                    $app_code_title = $person->getTitle();
                    if ($app_code_title) {
                        $title_desc = $app_code_title->getName();
                    } else {
                        print(sprintf('getMailMergeFieldData $app_code_title is NOT TRUE<br />'));
                    }
                    foreach ($field_arr as $field) {
                        switch ($field) {
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'RefNo' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $person->getReferenceNo() . '"';
                                $field_data_arr[$field] = $person->getReferenceNo();
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'FirstName' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $person->getFirstName() . '"';
                                $field_data_arr[$field] = $person->getFirstName();
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'LastName' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $person->getLastName() . '"';
                                $field_data_arr[$field] = $person->getLastName();
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'TitleDesc' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $title_desc . '"';
                                $field_data_arr[$field] = $title_desc;
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'Initials' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $person->getInitials() . '"';
                                $field_data_arr[$field] = $person->getInitials();
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'FullName' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $fname = $title_desc . ' ' . $person->getInitials() . ' ' . $person->getLastName();
                                $field_data_str .= ',"' . $fname . '"';
                                $field_data_arr[$field] = $fname;
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'Gender' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $person->getGender() . '"';
                                $field_data_arr[$field] = $person->getGender();
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'DateOfBirth' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $person->getDateOfBirth()->format(AppConstants::MAIL_MERGE_DATE_FORMAT) . '"';
                                $field_data_arr[$field] = $person->getDateOfBirth()->format(AppConstants::MAIL_MERGE_DATE_FORMAT);
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'AddressLine1' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $address ? ',"' . $address->getAddressLine1() . '"' : '';
                                $field_data_arr[$field] = $address ? $address->getAddressLine1() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'AddressLine2' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $address ? ',"' . $address->getAddressLine2() . '"' : '';
                                $field_data_arr[$field] = $address ? $address->getAddressLine2() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'AddressLine3' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $address ? ',"' . $address->getAddressLine3() . '"' : '';
                                $field_data_arr[$field] = $address ? $address->getAddressLine3() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'AddressTown' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $address ? ',"' . $address->getTown() . '"' : '';
                                $field_data_arr[$field] = $address ? $address->getTown() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'AddressCounty' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $address ? ',"' . $address->getCounty() . '"' : '';
                                $field_data_arr[$field] = $address ? $address->getCounty() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'AddressPostcode' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $address ? ',"' . $address->getPostcode() . '"' : '';
                                $field_data_arr[$field] = $address ? $address->getPostcode() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'AddressCountryName' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $country_name . '"';
                                $field_data_arr[$field] = $country_name;
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'AddressCountryCode' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $country_code . '"';
                                $field_data_arr[$field] = $country_code;
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'EmailAddr' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')->findOneByContact($contact);
                                $field_data_str .= $email ? ',"' . $email->getEmailAddress() . '"' : '';
                                $field_data_arr[$field] = $email ? $email->getEmailAddress() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'EmployerCode' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $employer ? ',"' . $employer->getCode() . '"' : '';
                                $field_data_arr[$field] = $employer ? $employer->getCode() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'EmployerName' . AppConstants::MAIL_MERGE_FIELD_CLOSE:

                                $orgName = '';
                                if ($employer) {
                                    $org = $employer->getOrganisation();
                                    if ($org) {
                                        $orgName = $org->getName();
                                    }
                                }

                                $field_data_str .= ',"' . $orgName . '"';
                                $field_data_arr[$field] = $orgName;
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplaceCode' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $workplace ? ',"' . $workplace->getCode() . '"' : '';
                                $field_data_arr[$field] = $workplace ? $workplace->getCode() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplaceName' . AppConstants::MAIL_MERGE_FIELD_CLOSE:

                                $orgName = '';
                                if ($workplace) {
                                    $org = $workplace->getOrganisation();
                                    if ($org) {
                                        $orgName = $org->getName();
                                    }
                                }

                                $field_data_str .= ',"' . $orgName . '"';
                                $field_data_arr[$field] = $orgName;
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplaceAddr1' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $wp_address ? ',"' . $wp_address->getAddressLine1() . '"' : '';
                                $field_data_arr[$field] = $wp_address ? $wp_address->getAddressLine1() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplaceAddr2' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $wp_address ? ',"' . $wp_address->getAddressLine2() . '"' : '';
                                $field_data_arr[$field] = $wp_address ? $wp_address->getAddressLine2() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplaceAddr3' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $wp_address ? ',"' . $wp_address->getAddressLine3() . '"' : '';
                                $field_data_arr[$field] = $wp_address ? $wp_address->getAddressLine3() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplaceTown' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $wp_address ? ',"' . $wp_address->getTown() . '"' : '';
                                $field_data_arr[$field] = $wp_address ? $wp_address->getTown() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplaceCounty' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $wp_address ? ',"' . $wp_address->getCounty() . '"' : '';
                                $field_data_arr[$field] = $wp_address ? $wp_address->getCounty() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplacePostcode' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= $wp_address ? ',"' . $wp_address->getPostcode() . '"' : '';
                                $field_data_arr[$field] = $wp_address ? $wp_address->getPostcode() : '';
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplaceCountryName' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $wp_country_name . '"';
                                $field_data_arr[$field] = $wp_country_name;
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'WorkplaceCountryCode' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . $wp_country_code . '"';
                                $field_data_arr[$field] = $wp_country_code;
                                break;
                            case AppConstants::MAIL_MERGE_FIELD_OPEN . 'Today' . AppConstants::MAIL_MERGE_FIELD_CLOSE:
                                $field_data_str .= ',"' . date(AppConstants::MAIL_MERGE_DATE_FORMAT) . '"';
                                $field_data_arr[$field] = date(AppConstants::MAIL_MERGE_DATE_FORMAT);
                                break;
                        } #switch ($mm_field)
                    }
                    break;
            } #switch ($entity_name)

            $field_data_str = ltrim($field_data_str, ',');
        } catch (\Exception $ex) {
            $return_array = array('error' => $ex->getMessage());

            $field_data_arr = array();
            $field_data_str = '';
        }

        if (count($field_data_arr) > 0) {
            #$return_array = array($field_data_arr, $field_data_str);
            $return_array = array('data_arr' => $field_data_arr, 'data_str' => $field_data_str);
        }

        return $return_array;
    }

#getMailMergeFieldData

    public function testTrAction(Request $request) {
        header("Access-Control-Allow-Origin: *");
        
        $status = false;
        $message = 'No changes have been made!';

        try {
            $em = $this->getDoctrine()->getManager();

            $classTmp = new \ESERV\MAIN\HelpersBundle\Services\HelpersBundleAltLangService($em);
            $array = $classTmp->getAltLanguageAppTexts(true);
            $keys = array(
                'name' => 'name',
                'locale' => 'locale',
                'altName' => 'altName',
                'location' => 'location'
            );

            $data_array = $this->get('eserv_translation_services')->prepareContentsArray($array['msg'], $keys);
            
            $res = $this->get('eserv_translation_services')->writeToTranslations($data_array, true, true);
            $status = $res['status'];
            $message = $res['message'];
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $res_array = array(
            'success' => $status,
            'msg' => $message
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($res_array);
        } else {
            print(sprintf($message));
            print_r($res_array);
            die;
        }
    }

    public function testEmailAction($email) {
//        $em = $this->getDoctrine()->getManager();
//        $conn = $em->getConnection();
//        
//        $sql="SELECT p.first_name, p.last_name FROM person p WHERE p.contact_id IN (SELECT c.id FROM contact c)";   //Your sql Query                
//        $stmt = $conn->prepare($sql);    // Prepare your sql
//        $stmt->bindValue(1, 'large');    // bind your values ,if you have to bind another value, you need to write $stmt->bindValue(2, 'anothervalue'); but your order is important so on..
//        $stmt->execute(); //execute your sql
//        $result=$stmt->fetchAll(\PDO::FETCH_CLASS, 'ESERV\MAIN\ContactBundle\Entity\Person'); // fetch your result
//        
//        print_r($result);
//        die;
        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()
                ->setSubject('Test Email from MERLIN')
                ->setFrom('send@example.com')
                ->setTo($email)
                ->setBody('Body of the Email - Test')
        ;

        if ($mailer->send($message)) {
            die('Email sent!');
        } else {
            die('Email not sent!');
        }

        return $this->render('ESERVMAINCommunicationsBundle:ESERVEmailTemplate:layout.html.twig', array(
                    'header_text' => 'Account creation acknowledgement',
                    #'logo_path' => 'https://pbs.twimg.com/profile_images/1106359303/gtcw_logo_no_textsq-_TIM_normal.JPG',
                    'show_footer' => true, //optional, default is true
                    'show_header' => true, //optional, default is true
                    'show_disclaimer' => true, //optional, default is true
                    'show_contact_details' => true, //optional, default is true
                    'show_social_media' => true, //optional, default is true
                    'body_twig' => $this->renderView('ESERVTestBundle:Default:email_body_test.html.twig', array(
                        'diplayName' => 'Anjana Silva',
                        'username' => 't_smith',
                        'password' => 'awr4%5WADFSA',
                    ))
        ));
//        $arr = array(
//            'subject' => 'New user account has been created!',
//            'fromEmail' => 'admin@millertech.co.uk',
//            'toEmail' => $email,
//            'body' =>  $this->renderView('ESERVMAINCommunicationsBundle:ESERVEmailTemplate:layout.html.twig', array(
//                            'client_name' => 'GTCW',
//                            'header_text' => 'Account creation acknowledgement',
//                            'body_twig' => $this->renderView('ESERVTestBundle:Default:email_body_test.html.twig', array(
//                                'display_name' => 'Anjana Silva'
//                            ))
//                        )
//            )  
//
//        );
//        $send = $this->container->get('eserv_email_services')->sendEmail($arr);
////        $message = $res['msg'];
//
//        if($send){
//            $message = 'Email has been sent successfully!';
//        }else{
//            $message = 'Email failed to send!';
//        }
//        die($message);
    }

    public function shaTestAction() {
//echo sprintf('hashed value(miller): %s', (hash('sha512', 'miller', false))); die;
        $password = 'miller';
//        $password = 'tBsTaPL9£';
//        $salt = md5(time());
        $salt = 'f8zstia9uw0gww4o40owsg8ws0gogok'; #salt for miller user
//$salt = '26717642c6891ff49e45cd7f65186415';
//$salt = '2c4fa61f856ab450eb5d1aa4dd0c5ef4';
//        $salt = md5('millertechnology'); 
//        var_dump($salt); die; 
//        
        $salted = $password . '{' . $salt . '}';
        echo sprintf('$salt: %s, $salted: %s<br />', $salt, $salted); #die;
//$salted = 'f8zstia9uw0gww4o40owsg8ws0gogok';        
        $digest = hash('sha512', $salted, true);
//        $digest = hash('sha512', $salted, false); 
        echo sprintf('$digest: %s<br />', $digest); #die;
        // "stretch" hash
        for ($i = 1; $i < 5000; $i++) {
//        for ($i = 1; $i < 2; $i++) {            
            $digest = hash('sha512', $digest . $salted, true);
//            $digest = hash('sha512', $digest.$salted, false);
            #echo sprintf('$digest: %s<br />', $digest);
//echo sprintf('$digest (%s): %s<br />', $i, $digest); #die;
        }
        echo sprintf('$digest: %s<br />', $digest);

//        echo 'salt : '.$salt;
        echo 'orginal password : ' . $password . '<br/>';
        echo 'encoded password : ' . base64_encode($digest) . '<br/>';

        die;
    }

    public function gtcwIndToPlpAction() {
        echo sprintf('Start: %s<br /><br />', date('d-M-Y H:i:s'));
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', 0);
        #$sql = "SELECT TRUNC(SYSDATE) FROM DUAL";
        $sql = "SELECT s.contact_id " .
                 "FROM gtcw_mem_ind_status s " .
                "WHERE s.ind_status_id = (" . 
                                           "SELECT ac.id " .
                                           "FROM application_code ac, application_code_type act " .
                                           "WHERE act.id = ac.application_code_type_id " .
                                           "AND act.code = 'INDST' " .
                                           "AND ac.code = 'P'" .
                                        ") " .
               "AND EXISTS (" . 
                              "SELECT 'x' " . 
                              "FROM contact_document_subscription cds, document_set ds " .
                              "WHERE ds.id = cds.document_set_id " . 
                              "AND ds.code = 'REGTEA' " .
                              "AND cds.contact_id = s.contact_id" .
                           ") " .
//               "AND EXISTS (" .
//                              "SELECT 'x' " .
//                              "FROM contact_cpd_status ccs " . 
//                              "WHERE ccs.contact_id = s.contact_id" .
//                           ") " .
//               "AND EXISTS (" .
//                              "SELECT 'x' " .
//                              "FROM user_notification n " . 
//                              "INNER JOIN mm_user_setting se on (se.fos_user_id = n.fos_user_id) " .
//                              "WHERE n.type = 'INDPROFPLP' " .
//                              "AND se.contact_id = s.contact_id" .
//                           ")"
               "AND NOT EXISTS (" . 
                                  "SELECT 'x' " . 
                                  "FROM contact_cpd_act a " . 
                                  "WHERE a.contact_id = s.contact_id " . 
                                  "AND a.cpd_act_type_id = (" . 
                                                              "SELECT id " .
                                                              "FROM cpd_act_type " . 
                                                              "WHERE code = 'IND'" . 
                                                           ")" .
                               ") "
//                . "AND (" . 
//                        "(s.contact_id = (SELECT contact_id FROM person WHERE reference_no = '0751156'))" . 
//                        " OR " .
//                        "(s.contact_id = (SELECT contact_id FROM person WHERE reference_no = '1378488'))" . 
//                     ") " .
//                "AND ROWNUM < 11"
//. " AND s.contact_id NOT IN (54578, 5476, 54995, 55697, 55187, 55195, 55217, 55225, 55422, 55484, 54985, 55049, 56280, 56274)"
//. " AND s.contact_id IN (54995)"
//. " AND s.contact_id IN (55484)"
//. " AND s.contact_id NOT IN (54985, 54995)"
               ;        
        
        $data_arr = $this->get('db_core_function_services')->runRawSql($sql); 
        #var_dump($data_arr); die;
        
        $em1 = $this->getDoctrine()->getManager();
        
        $cpdStatus = $em1->getRepository('ESERVMAINCpdBundle:CpdStatus')
                        ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CPD_STATUS_PLP));
        $cpdStatusDetail = $em1->getRepository('ESERVMAINCpdBundle:CpdStatusDetail')
                              ->findBy(array('cpdStatus' => $cpdStatus));
        $documentSet = $em1->getRepository('ESERVMAINSystemConfigBundle:DocumentSet')
                          ->findOneBy(array('code' => \GTCW\Services\GTCWConstants::DOCUMENT_SET_REG_TEA));        

//$log = $this->get('logger');
        foreach ($data_arr as $data) {
//$log->info(sprintf('contact.id: %s start', $data['CONTACT_ID']));
            $em = $this->getDoctrine()->getManager();                    
            $em->getConnection()->beginTransaction();
            
            try {
                echo sprintf('Creating PLP induction document for contact: %s<br />', $data['CONTACT_ID']);
//$log->info(sprintf('contact.id: %s AAA', $data['CONTACT_ID']));
                $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($data['CONTACT_ID']);
                #$gtcw_men_ind_status = $em->getRepository('GTCWGTCWBundle:GtcwMemIndStatus')->findOneBy(array('contact' => $contact));                
//$log->info(sprintf('contact.id: %s BBB', $data['CONTACT_ID']));
                $contactCpdStatus = $em->getRepository('ESERVMAINCpdBundle:ContactCpdStatus')->findOneBy(array('contact' => $contact, 'cpdStatus' => $cpdStatus));
                if ($contactCpdStatus) {
                    #contact_cpd_status already exists there is no need to create it
                } else {
//$log->info(sprintf('contact.id: %s CCC1', $data['CONTACT_ID']));
                    #contact_cpd_status does not exist so do create it and its associated contact_cpd_status_detail records
                    $contactCpdStatus = new \ESERV\MAIN\CpdBundle\Entity\ContactCpdStatus();
                    $contactCpdStatus->setContact($contact);
                    $contactCpdStatus->setCpdStatus($cpdStatus);
                    $em->persist($contactCpdStatus);
                    $em->flush();

                    foreach ($cpdStatusDetail as $k => $v) {
                        $contactCpdStatusDetail = new \ESERV\MAIN\CpdBundle\Entity\ContactCpdStatusDetail();
                        $contactCpdStatusDetail->setConCpdStatusText(null);
                        $contactCpdStatusDetail->setContactCpdStatus($contactCpdStatus);
                        $contactCpdStatusDetail->setCpdStatusDetail($v);
                        $em->persist($contactCpdStatusDetail);
                        $em->flush();
                        $contactCpdStatusDetail = null;
                    }
//$log->info(sprintf('contact.id: %s CCC2', $data['CONTACT_ID']));
                }

                $gtcwPlpServices = new \GTCW\GTCWBundle\Services\GTCWGTCWBundlePLPServices($em, $this->container);
//$log->info(sprintf('contact.id: %s DDD', $data['CONTACT_ID']));
                $res = $gtcwPlpServices->indStatusChangedtoPassedAction($data['CONTACT_ID']);
                if (!$res['success']) {
                    throw new \Exception($res['msg'] . 'indStatusChangedtoPassedAction exception', 500);
                }                
                
                $em->getConnection()->commit();

                echo sprintf('PLP induction document successfully created for contact: %s<br /><br />', $data['CONTACT_ID']);                
            } catch (\Exception $e) {
                echo sprintf('Exception: %s<br /><br />', $e->getMessage());
                $em->getConnection()->rollback(); 
                $em = $this->getDoctrine()->getManager();
            }
            $contact = null;
            $contactCpdStatus = null;
            $gtcwPlpServices = null;
//            $em->close();//            
//$log->info(sprintf('contact.id: %s end', $data['CONTACT_ID']));            
        } //foreach ($data_arr as $data)
        ini_set('memory_limit', '128M');
        echo sprintf('End: %s<br /><br />', date('d-M-Y H:i:s'));
        
        die;        
    } 
    
    public function updateContactDocAccessAction() {
        echo sprintf('Start: %s<br /><br />', date('d-M-Y H:i:s'));
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', 0);
        $sql = "select c.id AS contact_id, r.id AS gtcw_mem_ind_route_id, ac2.code AS route_code
from person p, contact c, gtcw_mem_ind_route r, contact_status s, system_code sys, gtcw_mem_ind_status st, application_code ac, application_code ac2
where p.contact_id = c.id
and r.contact_id = c.id
and c.contact_status_id = s.id
and sys.id = s.status_type_id
and sys.code = 'A'
and st.contact_id = c.id
and ac.id = st.ind_status_id
and ac2.id = r.ind_route_id
and ac.code not in ('P', 'E', 'EWEE', 'EG', 'ESCE', 'EW') " .
//"AND p.reference_no = '1378248'"
//"AND ROWNUM < 5"
//"and substr(p.last_name_search, 1, 1) in ('A', 'B', 'C')"
"and exists (select 'x' from contact_doc_access cda where cda.contact_doc_id in (select cd.id from contact_doc cd where cd.con_doc_sub_id = (select cds.id from contact_document_subscription cds where cds.contact_id = c.id))) "
;
        
//UAT took about 30 minutes to do about 800 records 
//After the process has been run update the sign off date where documents were signed off by users that should have not been allowed to sign them off
//UPDATE contact_doc_access a
//SET    sign_off_date = NULL
//WHERE  a.sign_off_date IS NOT NULL 
//AND    a.sign_off_access = 'N'
//AND    a.contact_doc_id IN (
//  SELECT b.id
//  FROM   contact_doc b, contact_document_subscription c, gtcw_mem_ind_status d, application_code e
//  WHERE  b.id = a.contact_doc_id
//  AND    c.id = b.con_doc_sub_id
//  AND    d.contact_id = c.contact_id
//  and    e.id = d.ind_status_id
//  AND    e.code <> 'P'
//);
        
        $data_arr = $this->get('db_core_function_services')->runRawSql($sql); 
        #var_dump($data_arr); die;
       

//$log = $this->get('logger');
        foreach ($data_arr as $data) {
//$log->info(sprintf('contact.id: %s start', $data['CONTACT_ID']));
            $em = $this->getDoctrine()->getManager();                    
            $em->getConnection()->beginTransaction();
            
            try {
                echo sprintf('Start contact: %s<br />', $data['CONTACT_ID']);
                #$gtcw_mem_ind_route = $em1->getRepository('GTCWGTCWBundle:GtcwMemIndRoute')->find($data['GTCW_MEM_IND_ROUTE_ID']);
                $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($data['CONTACT_ID']);
                $upd_result = $this->get('doc_share_function_services')->updateContactDocAccess($contact, $data['ROUTE_CODE']); 
                echo sprintf('End contact: %s, result: %s, msg: %s<br /><br />', $data['CONTACT_ID'], $upd_result['success'] ? ('Successful (' . $upd_result['msg'] . ')') : 'Failed', $upd_result['msg']);
                
                $em->getConnection()->commit();

//                echo sprintf('PLP induction document successfully created for contact: %s<br /><br />', $data['CONTACT_ID']);                
            } catch (\Exception $e) {
                echo sprintf('Exception: %s<br /><br />', $e->getMessage());
                $em->getConnection()->rollback(); 
                $em = $this->getDoctrine()->getManager();
            }
            $contact = null;
            $contactCpdStatus = null;
            $gtcwPlpServices = null;
//            $em->close();//            
//$log->info(sprintf('contact.id: %s end', $data['CONTACT_ID']));            
        } //foreach ($data_arr as $data)
        ini_set('memory_limit', '128M');
        echo sprintf('End: %s<br /><br />', date('d-M-Y H:i:s'));
        
        die;        
    }     
    
    public function pdfTest2Action()
    {
        $html = '<style>
    body { font-family: "Calibri" }
    table {border: 1px solid transparent; border-collapse: collapse;} 
    table td { padding: 9px; }
    .body_content table {border-color: #ccc;}
</style>

<div class="divider"></div>

    <div class="body_content"><table align="center" border="1" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">External Mentor: Rolf Clarke</span></span></td>
			<td>
			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">AB: Cardiff </span></span></p>

			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Central South Consortium</span></span></p>
			</td>
		</tr>
	</tbody>
</table>

<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">External Mentor Record: Part 3.2 Observation of Teaching</span></span></p>

<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Lesson Observation&nbsp;&nbsp; 1&nbsp;&nbsp;&nbsp;</span></span></p>

<table align="center" border="1" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Teacher</span></span></td>
			<td colspan="3">
			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Junara Begum</span></span></p>

			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Stacey Primary School (on STS)</span></span></p>
			</td>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Key Stage and Subject or Area of Learning</span></span></td>
			<td>
			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Foundation Phase</span></span></p>

			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Maths/ Creative Development- Shapes </span></span></p>
			</td>
		</tr>
		<tr>
			<td style="background-color: rgb(51,153,255)">
			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">External</span></span></p>

			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Mentor</span></span></p>
			</td>
			<td colspan="3"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Rolf Clarke</span></span></td>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Date of observation</span></span></td>
			<td><span style="font-size:12px">12.05.15</span></td>
		</tr>
		<tr>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Year Group</span></span></td>
			<td><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Reception </span></span></td>
			<td style="background-color: rgb(51,153,255)">
			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">No. inclass</span></span></p>
			</td>
			<td><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">30 </span></span></td>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Length of observation</span></span></td>
			<td><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">1 hour</span></span></td>
		</tr>
		<tr>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Learning activity</span></span></td>
			<td colspan="3">
			<p><span style="font-size:12px">Maths</span></p>

			<p><span style="font-size:12px">Maths/ Shapes/ To recognise the names and properties of 2D shapes (triangle, circle, square, rectangle).</span></p>
			</td>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Whole lesson / Part lesson</span></span></td>
			<td><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">enter</span></span></td>
		</tr>
		<tr>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Agreed focus of observation</span></span></td>
			<td colspan="5">
			<p><span style="font-size:12px">Numeracy, behaviour management, classroom organisation, use of Teaching Assistants.</span></p>
			</td>
		</tr>
		<tr>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Comments on Planning</span></span></td>
			<td colspan="4">
			<p>&nbsp;</p>

			<p><span style="font-size:12px">JB used a University lesson planning proforma outlining learning objectives from the Maths curriculum and the LNF. The success criteria and assessment opportunities were clearly stated in the planning. Detailed descriptions of the warm up, introduction, main teaching activities and plenary were clearly organised with associated timings. Resources were listed. The NQT planned for 30 children with two LSAs. The planning was organised to show a range of tasks and to develop mathematical and specific numeracy and literacy skills. The planning included the development of the Welsh language, incidental Welsh and health and safety issues. Activities were organised into differentiated groups.</span></p>
			</td>
			<td>
			<p><span style="font-size:12px">PTS</span></p>

			<p><span style="font-size:12px">16</span></p>

			<p><span style="font-size:12px">27</span></p>

			<p><span style="font-size:12px">29</span></p>

			<p><span style="font-size:12px">30</span></p>

			<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td style="background-color: rgb(51,153,255)">
			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Comments&nbsp;on key teaching strengths</span></span></p>
			</td>
			<td colspan="4">
			<p>&nbsp;</p>

			<p><span style="font-size:12px">JB had an agreement with the school to teach this class as she had taught the class several times before whilst on supply. JB shared the objectives with the children at the start of the lesson. JB began the lesson with a mental maths warm up using a counting stick which engaged all of the children and developed their numeracy skills. JB also enabled children to learn doubles of numbers using a rhyme with actions that she had devised and taught to the children. JB used a range of open and closed questions. Subject specific vocabulary on the names and properties of common 2D shapes was reinforced to the children. JB used incidental Welsh throughout the lesson and encouraged the development of the Welsh language throughout the lesson. JB demonstrated a very good relationship with the children despite having only taught the class whilst on supply. Standards of behaviour were excellent throughout the lesson. This was achieved through JB&rsquo;s effective teaching strategies and use of rewards. JB showed enthusiasm in the use of her voice and her teaching to engage and motivate the children. JB gave clear instructions and organised resources and activities very well. The resources were prepared well, were readily available to the children and stimulated the children&rsquo;s learning. JB made very good use of the school&rsquo;s outdoor environment in her focused activity to engage and motivate the children. JB had three adult helpers to support the children in classroom. Two of these were LSAs and one was the children&rsquo;s regular classroom teacher. JB organised the additional adults effectively prior to the lesson. Each had a clear knowledge of the lesson objectives and activity. This was communicated to them prior to the lesson through discussion and additional adult planners. JB kept to the timings of the lesson and children were allocated enough time to complete the activities. Effective use was made of the plenary.</span></p>
			</td>
			<td>
			<p><span style="font-size:12px">PTS</span></p>

			<p><span style="font-size:12px">3</span></p>

			<p><span style="font-size:12px">21</span></p>

			<p><span style="font-size:12px">23</span></p>

			<p><span style="font-size:12px">40</span></p>

			<p><span style="font-size:12px">48</span></p>

			<p><span style="font-size:12px">49</span></p>
			<span style="font-size:12px">52</span></td>
		</tr>
		<tr>
			<td style="background-color: rgb(51,153,255)"><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Comments on impact on learners &amp; learning</span></span></td>
			<td colspan="4">
			<p>&nbsp;</p>

			<p><span style="font-size:12px">All children exhibited very good behaviour throughout the lesson. All children listened attentively in the introduction and throughout and made appropriate responses during the warm up and introduction. All children responded enthusiastically to the tasks set. Nearly all children responded well to the use of praise, constructive feedback and rewards. Most children were able to answer questions correctly about 2D shape. The children used mathematical language in their answers and explanations. All children remained on task throughout the lesson. The LSAs supported the children well in the indoor activities. A few of the lower ability children could not remember the names and properties of the shapes and required prompting. The children enjoyed the range of practical tasks. The tasks were differentiated well and matched to each group&rsquo;s level. In JB&rsquo;s task, the children worked well individually and in pairs to find shapes outdoors and then read and responded to shape questions on a worksheet. Most children made good progress in the lesson. JB took photos on an ipad of the shapes that the children in her group had found outside and these were shown to all the children in the plenary and discussed. This would have been enhanced if JB had access to Apple tv to project the images onto the whiteboard. In the plenary, children were able to explain to the class what they had learnt in their groups. The children reviewed learning through an engaging Shape Bingo game that JB had created. Children correctly selected and identified shape properties by using the interactive whiteboard. All children self assessed their own learning through the thumbs up/ thumbs down approach.</span></p>

			<p>&nbsp;</p>
			</td>
			<td>
			<p><span style="font-size:12px">PTS</span></p>

			<p><span style="font-size:12px">38</span></p>

			<p><span style="font-size:12px">45</span></p>

			<p><span style="font-size:12px">47</span></p>
			<span style="font-size:12px">55</span></td>
		</tr>
		<tr>
			<td style="background-color: rgb(51,153,255)">
			<p><span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">Agreed&nbsp; targets for further development</span></span></p>
			<span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif">It is anticipated that these targets may be included in the focus of the next observation</span></span></td>
			<td colspan="4">
			<ul>
				<li><span style="font-size:12px">To extend the literacy and numeracy skills of the more able and talented. This can be done by the pupils explaining orally in sentences where they had found the 2D shapes instead of pointing to them and to extend numeracy by adding up the number of sides of more than one shape.</span></li>
			</ul>

			<p>&nbsp;</p>

			<ul>
				<li><span style="font-size:12px">To use no hands up and thinking time approach through the use of lollipop sticks, a Class Dojo randomiser or talking partners.</span></li>
			</ul>

			<p>&nbsp;</p>

			<ul>
				<li><span style="font-size:12px">To scaffold children&rsquo;s reading activity in Maths word problems by introducing the key words such as circle, square, triangle and rectangle on flashcards.</span></li>
			</ul>

			<p>&nbsp;</p>

			<ul>
				<li><span style="font-size:12px">To provide teacher and additional adult assessment grids with the learning objectives and success criteria for formative assessment and to inform future planning.</span></li>
			</ul>
			</td>
			<td>
			<p><span style="font-size:12px">PTS</span></p>

			<p><span style="font-size:12px">17</span></p>

			<p><span style="font-size:12px">27</span></p>
			<span style="font-size:12px">35</span></td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>
</div>

<div class="divider"></div>

';
        $fileWithUrl = $this->container->get('kernel')->getRootDir() . '/../web/tmp/_TEMP_/ind-prof-docs/anjana-test-07-01-2016.pdf';
        $this->container->get('knp_snappy.pdf')->generateFromHtml(utf8_decode($html), $fileWithUrl);
        
    }

}
