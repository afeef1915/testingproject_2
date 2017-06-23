<?php

namespace WEBLOGS\MAIN\MTL\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use WEBLOGS\DashboardBundle\Entity\VWwvCustomers;
//use WEBLOGS\DashboardBundle\Entity\UserCustomer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Doctrine\ORM\Mapping\Entity;

class DashboardController extends Controller {
    /* function
     * CustomersAction
     */

    public function CustomersAction() {
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
//
//         print_r($user);die;
//         $email =$user[0]['Email'];
//              "select * from "
        // $user = $this->container->get('security.context')->getToken()->getUser();
        // print_r($userGroup);die;
        if ($userGroup['userGroup'] == 'CUSTOMER') {

            $customer = $this->getDoctrine()
                    ->getRepository('WEBLOGSMAINMTLDashboardBundle:VWwvCustomers')
                    ->findBy(['customer_id' => $userGroup['customerCode']]);
        } else {

            $customer = $this->getDoctrine()
                    ->getRepository('WEBLOGSMAINMTLDashboardBundle:VWwvCustomers')
                    ->findBy([], ['name' => 'ASC']);

//         print_r($product); die("tst");
        }
        if (!$customer) {
            throw $this->createNotFoundException(
                    'No customer found for id ' . $customer
            );
        }
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new
            JsonEncoder()));
        $json = $serializer->serialize($customer, 'json');

        //$response = json_encode($customer,true);
        print_r($json);
        exit;
    }

    /* end of function */

    /* function save new customer selected from drop down in database
     * Customers_saveAction
     */

    public function CustomersSaveAction(Request $request) {
        $customers = $request->request->get('customers');


        $user = $this->container->get('security.context')->getToken()->getUser();

        $product = $this->getDoctrine()
                ->getRepository('WEBLOGSMAINMTLDashboardBundle:UserCustomer')
                ->findByuserId($user->getUsername());



       
        if (empty($product)) {

           // die('if');
            $customer = new \WEBLOGS\MAIN\MTL\DashboardBundle\Entity\UserCustomer();
            $customer->setUserId($user->getUsername());
            //$customer->setCustomerId('');
            $customer->setCustomerId($customers);

            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            echo  "data saved successfully";
        } else {

            $em = $this->getDoctrine()->getManager();
            $customer_update = $em->getRepository('WEBLOGSMAINMTLDashboardBundle:UserCustomer')->find($user->getUsername());
            // print_r($customer_update);
            if (!$customer_update) {
                throw $this->createNotFoundException(
                        'No product found for id ' . $user->getUsername()
                );
            }

            $customer_update->setCustomerId($customers);
            $em->flush();
             echo  "data saved successfully";
        }

        exit;
    }

    /* function
     * showCustomerAction
     */

    public function showCustomerAction() {


        $user = $this->container->get('security.context')->getToken()->getUser();
       // var_dump($user->getId());
       // var_dump($user->getUsername());
        //die;
        $product = $this->getDoctrine()
                ->getRepository('WEBLOGSMAINMTLDashboardBundle:UserCustomer')
                ->find($user->getUsername());
        $customer_name = (!empty($product) ? $product->getCustomerId() : '');
        echo $show_customers = $customer_name;
        exit;
        // return $this->render('WEBLOGSMAINMTLDashboardBundle:Default:dashboard.html.twig',array('last_customer_select'=>$product->getCustomerId()));
    }

    /* function
     * showUseridAction
     */

    public function showUseridAction() {

        $user = $this->container->get('security.context')->getToken()->getUser();
        echo $user_name = $user->getUsername();
        exit;
        //return $this->render('WEBLOGSMAINMTLDashboardBundle:Default:charts.html.twig',array('username'=>$user_name));
    }

    /* function retrives countof dashbaord
     * dashboardCountAction
     */

    public function dashboardCountAction(Request $request) {

        #post values #



        $p_customer_id = $request->query->get("p_customer_id");
        $p_random = $request->query->get("p_random");
        $p_user_id = $request->query->get("p_user_id");
        // $p_staff = $request->query->get("p_staff");
        $em = $this->getDoctrine()->getEntityManager();
        $data = array();

        $group_id;
//        if ($p_staff == 'Y') {
//            $group_id = '4';
//        } else {
//            $group_id = '5';
//        }

        $user = $this->container->get('security.context')->getToken()->getUser();
        $user_id = $user->getId();

//        $group_id ="select group_id from fos_user_group where user_id='$user_id'";
//        $group_id_data = $this->container->get('db_core_function_services')->runRawSql($group_id);
//        $groups=$group_id_data[0]['GROUP_ID'];
        // print_r($groups);
        // die;

        $open_logs = "SELECT COUNT(*) open_logs
  		    FROM v_mtl_logs       ml
  		    WHERE ml.customer = '$p_customer_id'
  		     AND  ml.date_completed IS NULL AND  ATTENTION_OF IS NOT NULL";
               
        $result_logs_data = $this->container->get('db_core_function_services')->runRawSql($open_logs);

        $assigned_to_mtl = " select COUNT(*) assigned_to_mtl  from v_mtl_logs  
          where customer='$p_customer_id'  AND date_completed   IS NULL and attention_of IN ('MTL')";

//          $assigned_to_mtl = "SELECT COUNT(*) assigned_to_mtl
//                FROM	v_mtl_logs       ml ,customer_contacts cc
//                WHERE	ml.customer = '$p_customer_id'
//                AND  ml.date_completed IS NULL
//                and  assigned_to_id = csev_seq_id
//                AND cc.csev_mtlgroup = 'Y'";

        $result_assigned_data = $this->container->get('db_core_function_services')->runRawSql($assigned_to_mtl);

        $assigned_to_customer = " select COUNT(*) assigned_to_customer  from v_mtl_logs  "
                . "where customer='$p_customer_id'  AND date_completed   IS NULL and attention_of NOT IN ('MTL')";

//        $assigned_to_customer = "SELECT	COUNT(*) assigned_to_customer
//                FROM	v_mtl_logs       ml ,customer_contacts cc
//                WHERE	ml.customer = '$p_customer_id'
//                AND  ml.date_completed IS NULL
//                and  assigned_to_id = csev_seq_id
//                AND cc.csev_mtlgroup = 'N'";

        $assigned_to_customer_data = $this->container->get('db_core_function_services')->runRawSql($assigned_to_customer);
        // $result_array = array_merge_recursive($result_logs_data, $result_assigned_data, $assigned_to_customer_data);

        $val = 0;
        $data1 = array();
        //print_r($result_array);die;
        if (isset($result_logs_data)) {
            foreach ($result_logs_data as $key => $value) {

                $data['data'][$key]['open_logs'] = $value['OPEN_LOGS'];
            }
        } else {
            $data['data'][0]['open_logs'] = $val;
        }

        if (isset($result_assigned_data)) {
            foreach ($result_assigned_data as $key => $value) {


                $data['data'][$key]['to_mtl'] = $value['ASSIGNED_TO_MTL'];
            }
        } else {
            $data['data'][0]['to_mtl'] = $val;
        }
        if (isset($assigned_to_customer_data)) {
            foreach ($assigned_to_customer_data as $key => $value) {

                $data['data'][$key]['to_client'] = $value['ASSIGNED_TO_CUSTOMER'];


//
            }
        } else {
            $data['data'][0]['to_client'] = $val;
        }
        //print_r($data);die;
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response($serializer->serialize($data, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

        /*
          $sql = "DECLARE \n"
          . "BEGIN \n"
          . "miller_web_demo.wwv_json_data.dashboard_details(:param1, :param2 , :param3, :param4,:param5); \n"
          . "END;\n";



          //                    $param1 = 'BECTU';
          //
          //                    $param2 = '79';
          //
          //                    $param3 = 'Y';
          //
          //                    $param4 = 121221;

          $data;
          //call stored procedured//
          //                    $qb = $em->getConnection()->prepare($sql);
          //                    $sql1='CALL miller_web_demo.wwv_json_data.dashboard_details(:param1, :param2 , :param3, :param4)';
          $qb = $em->getConnection()->prepare($sql);

          $qb->bindParam('param1', $p_customer_id, \PDO::PARAM_INPUT_OUTPUT, 4000);

          $qb->bindParam('param2', $p_user_id, \PDO::PARAM_INPUT_OUTPUT, 4000);

          $qb->bindParam('param3', $p_staff, \PDO::PARAM_INPUT_OUTPUT, 1);

          $qb->bindParam('param4', $p_random, \PDO::PARAM_INPUT_OUTPUT, 4000);
          $qb->bindParam('param5', $data, \PDO::PARAM_INPUT_OUTPUT, 4000);

          $result = array(
          'status' => FALSE,
          'msg' => 'Any message!!!'
          );

          try {

          $res = $qb->execute();
          //print_r($res);die;
          if ($res) {

          //$result = $this->c->get('merlinora_core_services')->oraProcdeureResult($procedure_status, $procedure_result);
          //                  $result = $res->fetch(PDO::FETCH_ASSOC);
          //header("content-type:application/json");

          echo $data;
          die;
          } else {

          $result = array(
          'status' => FALSE,
          'msg' => 'No results'
          );
          }
          } catch (Exception $e) {

          $result = array(
          'status' => FALSE,
          'msg' => $e->getMessage()
          );
          }

         */
    }

    /* function retrives countof task
     * taskCountAction
     */

    public function taskCountAction(Request $request) {

        #post values #
        $p_customer_id = $request->query->get("p_customer_id");
        $p_random = $request->query->get("p_random");
//      $p_user_id=$request->query->get("p_user_id");
//      $p_staff=$request->query->get("p_staff");
        $data = array();

//        $task_count = "SELECT NVL(ctk_name,'Unknown') task_name, COUNT(*) cnt
//				FROM	v_mtl_logs       ml
//					, (select ctk_name, ctk_code from customer_tasks WHERE ctk_customer_id = '$p_customer_id') ct
//                                WHERE	ml.customer = '$p_customer_id'
//				 AND  ct.ctk_code(+) = ml.task_code
//				 --AND  ml.mtl_action != 'C'
//				 AND  ml.date_completed IS NULL
//  		 GROUP BY NVL(ctk_name,'Unknown')";
        $task_count = "SELECT  ctk_name task_name, COUNT(*) cnt
				FROM	v_mtl_logs       ml
				, (select ctk_name, ctk_code from customer_tasks WHERE ctk_customer_id = '$p_customer_id') ct
                                WHERE	ml.customer = '$p_customer_id'
				AND  ct.ctk_code(+) = ml.task_code
				AND  ml.date_completed IS NULL
                                AND ctk_name IS NOT NULL
                                GROUP BY ctk_name";
        $result = $this->container->get('db_core_function_services')->runRawSql($task_count);
        $val = 0;
        //print_r($result);die;
        if (isset($result)) {
            foreach ($result as $key => $value) {
                //$customerListArray[$v['customer_id']] = $v['name'];
                $data['data'][$key]['label'] = $value['TASK_NAME'];
                $data['data'][$key]['data'] = (int) $value['CNT'];
            }
        } else {
            $data['data'][$val]['label'] = $val;
            $data['data'][$val]['data'] = $val;
        }
        //print_r($data);die;
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response($serializer->serialize($data, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
//        $em = $this->getDoctrine()->getEntityManager();
//         $sql = "DECLARE \n"
//                . "BEGIN \n"
//                . "miller_web_demo.wwv_json_data.task_chart(:param1, :param2 , :param3); \n"
//                . "END;\n";
//
////                      $p_customer_id='ATL';
////                      $p_random='123254335';
//        $data;
//        //die("tgdgf");
//        $qb = $em->getConnection()->prepare($sql);
//
//        $qb->bindParam('param1', $p_customer_id, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//        $qb->bindParam('param2', $p_random, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//        $qb->bindParam('param3', $data, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//
//        $result = array(
//            'status' => FALSE,
//            'msg' => 'Any message!!!'
//        );
//
//        try {
//
//            $res = $qb->execute();
//            //print_r($res);die;
//            if ($res) {
//
//                //$result = $this->c->get('merlinora_core_services')->oraProcdeureResult($procedure_status, $procedure_result);
////                  $result = $res->fetch(PDO::FETCH_ASSOC);
//                //header("content-type:application/json");
//
//                echo $data;
//                die;
//            } else {
//
//                $result = array(
//                    'status' => FALSE,
//                    'msg' => 'No results'
//                );
//            }
//        } catch (Exception $e) {
//
//            $result = array(
//                'status' => FALSE,
//                'msg' => $e->getMessage()
//            );
//        }
    }

    /* function retrives count of category
     * categoryCountAction
     */

    public function categoryCountAction(Request $request) {

        #post values #
        $p_customer_id = $request->query->get("p_customer_id");
        $p_random = $request->query->get("p_random");

        $data = array();
        /*
          $category_count = "SELECT NVL(ml.category,'Unknown') category_name, COUNT(*) cnt
          FROM	v_mtl_logs       ml
          WHERE	ml.customer = '$p_customer_id'
          AND  ml.date_completed IS NULL
          --AND  ml.mtl_action != 'C'
          GROUP BY NVL(ml.category,'Unknown')";
         * */

        $category_count = "SELECT ml.category category_name, COUNT(*) cnt
                            FROM	v_mtl_logs       ml
                            WHERE	ml.customer = '$p_customer_id'
                            AND  ml.date_completed IS NULL
                            AND ml.category IS NOT NULL 
                            GROUP BY ml.category";
        $result = $this->container->get('db_core_function_services')->runRawSql($category_count);
        $val = 0;
        //print_r($result);die;
        if (isset($result)) {
            foreach ($result as $key => $value) {
                //$customerListArray[$v['customer_id']] = $v['name'];
                $data['data'][$key]['category'] = $value['CATEGORY_NAME'];
                $data['data'][$key]['value'] = (int) $value['CNT'];
            }
        } else {
            $data['data'][$val]['category'] = $val;
            $data['data'][$val]['value'] = $val;
        }
        //print_r($data);die;
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response($serializer->serialize($data, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

//        $em = $this->getDoctrine()->getEntityManager();
//        $sql = "DECLARE \n"
//                . "BEGIN \n"
//                . "miller_web_demo.wwv_json_data.category_chart(:param1, :param2 , :param3); \n"
//                . "END;\n";
//
////                      $p_customer_id='ATL';
////                      $p_random='123254335';
//        $data;
//
//        $qb = $em->getConnection()->prepare($sql);
//
//        $qb->bindParam('param1', $p_customer_id, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//        $qb->bindParam('param2', $p_random, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//        $qb->bindParam('param3', $data, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//
//        $result = array(
//            'status' => FALSE,
//            'msg' => 'Any message!!!'
//        );
//
//        try {
//
//            $res = $qb->execute();
//            //print_r($res);die;
//            if ($res) {
//
//                //$result = $this->c->get('merlinora_core_services')->oraProcdeureResult($procedure_status, $procedure_result);
////                  $result = $res->fetch(PDO::FETCH_ASSOC);
//                //header("content-type:application/json");
//
//                echo $data;
//                die;
//            } else {
//
//                $result = array(
//                    'status' => FALSE,
//                    'msg' => 'No results'
//                );
//            }
//        } catch (Exception $e) {
//
//            $result = array(
//                'status' => FALSE,
//                'msg' => $e->getMessage()
//            );
//        }
    }

    /* function retrives count of priority
     * priorityCountAction
     */

    public function priorityCountAction(Request $request) {

        #post values #
        $p_customer_id = $request->query->get("p_customer_id");
        $p_random = $request->query->get("p_random");

        $data = array();


        //        $priority_count = "SELECT NVL(pl.description,'Unknown') priority_desc, COUNT(*) cnt
//  		  FROM	v_mtl_logs     ml,
//  		  	v_wwv_priority_level pl
//  		 WHERE	ml.priority = pl.DESCRIPTION(+)
//  		   AND	ml.customer = '$p_customer_id'
//  		   AND  ml.date_completed IS NULL
//  		   --AND  ml.mtl_action != 'C'
//  		 GROUP BY NVL(pl.description,'Unknown')";
        $priority_count = "SELECT pl.description priority_desc, COUNT(*) cnt
  		  FROM	v_mtl_logs     ml,
  		  	v_wwv_priority_level pl
  		 WHERE	ml.priority = pl.DESCRIPTION(+)
  		   AND	ml.customer = '$p_customer_id'
  		   AND  ml.date_completed IS NULL
  		  AND  pl.description IS NOT NULL
  		 GROUP BY pl.description";
        $result = $this->container->get('db_core_function_services')->runRawSql($priority_count);
        $val = 0;
        if (isset($result)) {
            foreach ($result as $key => $value) {
                //$customerListArray[$v['customer_id']] = $v['name'];
                $data['data'][$key]['priority'] = $value['PRIORITY_DESC'];
                $data['data'][$key]['value'] = (int) $value['CNT'];
            }
        } else {
            $data['data'][$val]['priority'] = $val;
            $data['data'][$val]['value'] = $val;
        }
        //print_r($data);die;
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response($serializer->serialize($data, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;


//        $em = $this->getDoctrine()->getEntityManager();
//        $sql = "DECLARE \n"
//                . "BEGIN \n"
//                . "miller_web_demo.wwv_json_data.priority_chart(:param1, :param2 , :param3); \n"
//                . "END;\n";
//
////                      $p_customer_id='ATL';
////                      $p_random='123254335';
//        $data;
//
//        $qb = $em->getConnection()->prepare($sql);
//
//        $qb->bindParam('param1', $p_customer_id, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//        $qb->bindParam('param2', $p_random, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//        $qb->bindParam('param3', $data, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//        $result = array(
//            'status' => FALSE,
//            'msg' => 'Any message!!!'
//        );
//
//        try {
//
//            $res = $qb->execute();
//            //print_r($res);die;
//
//            if ($res) {
//                $datas=json_decode($data, true);
//                print_r($datas);
//                die;
//                //$result = $this->c->get('merlinora_core_services')->oraProcdeureResult($procedure_status, $procedure_result);
////                  $result = $res->fetch(PDO::FETCH_ASSOC);
//                //header("content-type:application/json");
//
//                echo $data;
//                die;
//            } else {
//
//                $result = array(
//                    'status' => FALSE,
//                    'msg' => 'No results'
//                );
//            }
//        } catch (Exception $e) {
//
//            $result = array(
//                'status' => FALSE,
//                'msg' => $e->getMessage()
//            );
//        }
    }

    /* function show statistics in graphs
     * dashboardHomeAction
     */

    public function dashboardHomeAction(Request $request) {
        $customerProfile = base64_decode($this->get('session')->get('cc'));
        return $this->render('WEBLOGSMAINMTLDashboardBundle:Dashboard:index.html.twig', array(
                    'customerProfile' => $customerProfile
        ));
    }

    public function notificationsCountAction(Request $request) {

        $user_id = $this->get('security.context')->getToken()->getUser()->getId();

        //     $cust_id = $request->request->get('id');

        $selectQuery = "SELECT * FROM LOGSHEET_NOTIFICATIONS WHERE USER_ID='$user_id' AND STATUS='Y' ";
        //          . "WHERE mlb_customer_id = '$cust_id' ";

        $selectQ = "SELECT COUNT(*) FROM LOGSHEET_NOTIFICATIONS WHERE  USER_ID='$user_id' AND  STATUS='Y'  ";
        $result = $this->container->get('db_core_function_services')->runRawSql($selectQuery);
        $res = $this->container->get('db_core_function_services')->runRawSql($selectQ);

        // print_r($result);die;
//   $nullval=     Array
//(
//     Array
//        (
//         //   'CUSTOMER_ID' => '1',
//            'COUNT' => '5',
//           // 'CTK_NAME' => 'All'
//        )
////       Array
////        (
////            'CUSTOMER_ID' => '2',
////            'CTK_CODE' => 'None',
////        //    'CTK_NAME' => 'None'
////        )
//       );
        //print_r($nullval);
        $NULL = $res[0]['COUNT(*)'];

//

        $results_array = array(
            'all_notifications' => $result,
            //    'notifications' => $read === 'Y' ? $read_notifications : $unread_notification,
            'new_notif_count' => $NULL
        );
        //print_r($results_array);die;
        return new \Symfony\Component\HttpFoundation\JsonResponse($results_array);
        //omponent\HttpFoundation\JsonResponse($results_array);
        $result_array = array_merge_recursive($nullval, $result);
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response($serializer->serialize($NULL, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
//
    }

    public function viewNotificationAction(Request $request) {
        $user_id = $this->get('security.context')->getToken()->getUser()->getId();
        $selectQuery = "SELECT * FROM LOGSHEET_NOTIFICATIONS WHERE USER_ID='$user_id'  ";
        //          . "WHERE mlb_customer_id = '$cust_id' ";
        //  $selectQ = "SELECT COUNT(*) FROM LOGSHEET_NOTIFICATIONS " ;
        $result = $this->container->get('db_core_function_services')->runRawSql($selectQuery);
        return $this->render('WEBLOGSMAINMTLDashboardBundle:Dashboard:view.html.twig', array(
                    'notifications' => $result,
        ));
    }

    /* function checks staff is Y or N
     * CheckStaffAction
     */

    public function CheckStaffAction() {

        $staff = 'Y';
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        if ($userGroup['userGroup'] == 'CUSTOMER') {
            $staff = 'N';
        } else {
            $staff = 'Y';
        }
       print_r($staff);
        
        die;
    }

}
