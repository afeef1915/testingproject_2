<?php

namespace ESERV\MAIN\ExternalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ProcedureController extends Controller {

    public function callProcedureAction(Request $request) {
        $status = false;
        $message = '';

        try {
            $has_access = false;

            if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
                $has_access = true;
            } else {
                $providerKey = 'main';
                $admin_username = $request->get('username', NULL);
                $admin_password = $request->get('password', NULL);
                if (!is_null($admin_username) && !is_null($admin_password)) {
                    $token = new UsernamePasswordToken($admin_username, $admin_password, $providerKey);
                    $this->container->get('security.context')->setToken($token);
                    if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
                        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
                            $has_access = true;
                        }
                    }
                }
            }

            if ($has_access) {

                $BeginDateAndTime = date("Y/m/d h:i:sa");
                $enable_logging = $this->container->getParameter('enable_logging');
                $notify_email_admins = $this->container->getParameter('notify_email_admins');
                $notify_user = $this->container->getParameter('notify_user');

                $log = "------------------------ START --------------------------- \n";
                $log .= "Begin Date & Time.............." . $BeginDateAndTime . "\n";

                $qdb_service = new \ESERV\MAIN\ExternalBundle\Services\ExternalBundleQueuedDbProcessService($this->getDoctrine()->getManager(), $this->container);
                $extbund_service = new \ESERV\MAIN\ExternalBundle\Services\ExternalBundleService($this->getDoctrine()->getManager(), $this->container);
                $notif_service = new \ESERV\MAIN\ProfileBundle\Services\ProfileBundleUserNotificationsService($this->getDoctrine()->getManager(), $this->container);
                $queued_db_processes = $qdb_service->formatQueuedDbProcessList();


                //Outstanding items array (id's of queued db process)
                $outstanding_items_before = $qdb_service->getUnprocessedItems();
                $outstanding_count_before = count($outstanding_items_before);

                $log .= "Number of outstanding records before the execution :- $outstanding_count_before\n";
                $log .= "----------------------------------------------------- \n";

                //If we got outstanding (unprocessed) items
                if ($outstanding_count_before > 0) {
                    foreach ($outstanding_items_before as $key => $outstanding_item) {
                        $em = $this->getDoctrine()->getManager();
                        $em->getConnection()->beginTransaction();

                        $qdb_process_id = $outstanding_item['id'];
                        $name = $qdb_service->getName($qdb_process_id);
                        //Increasing the attempt by 1
                        $inc_attempts = $qdb_service->increaseAttemptsByOne($qdb_process_id, $em);
                        //If increasing attempt was successful
                        if ($inc_attempts['success'] === true) {
                            $log .= "Attempt record successfully increased in Queued DB Process for ID $qdb_process_id \n";
                            $log .= "Name : $name (Queued DB Process) \n";

                            //Executing the procedure
                            $response = $extbund_service->executeProcedure($queued_db_processes[$qdb_process_id]);
                            $result = json_decode($response->getContent(), true);
                            //If the procedure execution succeeded
                            if ($result['status'] === true) {
                                $log .= "Procedure successfully executed..\n";
                                $set_to_y = $qdb_service->setProcessedToY($qdb_process_id, $em);
                                if ($set_to_y['success'] === true) {
                                    $log .= "Processed successfully set to 'Y' for Queued DB Process ID $qdb_process_id\n";
                                } else {
                                    $log .= "Processed FAILED to set to 'Y' for Queued DB Process ID $qdb_process_id\n";
                                }
                            } else {
                                $log .= "Procedure FAILED to execute. Message :-" . $result['msg'] . "\n";
                            }
                            if ($notify_user === true) {
                                $notif_status = $notif_service->createUserNotification('ALERT', $qdb_service->getName($qdb_process_id), $result['msg'], 'Y', $em);
                                if ($notif_status === true) {
                                    $log .= "Notification successfully created for Queued DB Process ID $qdb_process_id\n";
                                } else {
                                    $log .= "Notification FAILED to create for Queued DB Process ID $qdb_process_id\n";
                                }
                            }

                            if ($notify_email_admins === true) {
                                //Send the email
                            }


                            $em->flush();
                            $em->getConnection()->commit();
                        } else {

                            $log .= "Attempt record FAILED to increase for Queued DB Process for ID $qdb_process_id - Message - " . $inc_attempts['msg'] . "\n";
                            $em->getConnection()->rollBack();
                        }
                        $log .= "****************************************************** \n";
                    }
                }

                $outstanding_items_after = $qdb_service->getUnprocessedItems();
                $outstanding_count_after = count($outstanding_items_after);
                $log .= "Number of outstanding records after the execution :- $outstanding_count_after\n";
                $log .= "----------------------------------------------------- \n";

                if ($enable_logging === true) {
                    $EndDateAndTime = date("Y/m/d h:i:sa");
                    $log .= "End Date & Time.............." . $EndDateAndTime . "\n";
                    $log .= "------------------------ END ---------------------------- \n";
                    $this->container->get('core_function_services')->CustomErrorLogger('bg_process', 'bg_process.log', $log, 'TMPCODE');
                }

                $status = true;
                $message = 'Background process execution successful!';
            } else {
                $status = false;
                $message = 'Access Denied!';
            }
        } catch (\Exception $e) {
            $status = false;
            $message = 'Background process execution failed! - ' . $e->getMessage();
        }

        $res_array = array(
            'success' => $status,
            'msg' => $message
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($res_array);
        } else {
            print(sprintf('<br />Background process completed'));
            print_r($res_array);
            die;
        }
    }

}
