<?php

namespace ESERV\ReleaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\AppConstants;

class PostReleaseController extends Controller {

    public function indexAction($name) {
        return $this->render('ESERVReleaseBundle:Default:index.html.twig', array('name' => $name));
    }

    public function runUpdateTranslationsAction(Request $request) { 
        $em = $this->getDoctrine()->getManager();
        $success_count = 0;
        $status = false;
        $message = '';
        try {
            $em->getConnection()->beginTransaction();
            $te = new \ESERV\ReleaseBundle\Lists\TranslationEntry();
            $trans_arr = $te->getTransEntries();
            
            $qb = $em->createQueryBuilder()
                    ->select('al.id')
                    ->from('ESERVMAINHelpersBundle:AltLanguage', 'al')
                    ->join('al.language','lan')
                    ->where('lan.code = :eservLanCode')
                    ->setParameter('eservLanCode', AppConstants::LAN_WELSH_CODE)
                    ->getQuery()
                    ->getArrayResult();
            
            $helper_services = new \ESERV\MAIN\HelpersBundle\Services\HelpersBundleAltLangService($em);

            foreach ($trans_arr as $v) {
                $arr = array(
                    'name' => trim($v),
                    'altName' => null,
                    'altLanguage' => $qb[0]['id'],
                );
                $res = $helper_services->createAltLang($arr);
                $status = $res['status'];
                if ($status) {
                    $success_count++;
                }
            }

            if ($success_count === 0) {
                $message = 'Sorry, nothing to import as no unique entries found! ';
            } else {
                $message = 'Unique entries has been saved to the database.! ';
            }

            $status = true;
            $message .= ', Additional Info [ Total Entries :- (' . count($trans_arr) . '), Unique Entries :- (' . $success_count . ') ]';
            $em->getConnection()->commit();
        } catch (\Exception $e) {
            $message = 'Exception : ' . $e->getMessage();
            $status = false;
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

    public function importTranslationsWelshAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $success_count = 0;
        $status = false;
        $message = '';
        try {
            $em->getConnection()->beginTransaction();
           
            $language = $em->getRepository('ESERVMAINSystemConfigBundle:Language')->findOneBy(array('code' => AppConstants::LAN_WELSH_CODE));
            $alt_lang = $em->getRepository('ESERVMAINHelpersBundle:AltLanguage')->findOneBy(array('language' => $language));
            
            $qb = $em->createQueryBuilder();
            $qb1 = $em->createQueryBuilder();
            $qry = $qb->select('a.id', 'a.name')
                    ->from('ESERVMAINHelpersBundle:AppText', 'a')
                    ->getQuery()
            ;
            $result = $qry->getArrayResult();
            $app_texts = array();
            if ($result) {
                foreach ($result as $app_text) {
                    $app_texts[$app_text['id']] = $app_text['name'];
                }
            }
            $db_param = array(
                'driver' => 'oci8',
                'host' => 'mtldb5',
                'port' => '1521',
                'dbname' => 'gtcwdev',
                'user' => 'miller',
                'password' => 'mtl',
                'charset' => 'UTF8',
                'connectionString' => '(DESCRIPTION =
                                        (ADDRESS = (PROTOCOL = TCP)
                                                   (HOST = mtldb5)
                                                   (PORT = 1521)
                                        )
                                        (CONNECT_DATA = (SID = gtcwdev)
                                        ) 
                                     )',
            );

            $conn = oci_connect($db_param['user'], $db_param['password'], $db_param['connectionString']);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }

            $stid = oci_parse($conn, 'SELECT * FROM general_notes');
            oci_execute($stid);
            while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $engText = $row['GNO_NOTE'];
                $welshText = $row['GNO_NOTE_LANG1'];
                if (in_array($engText, $app_texts)) {
                    $app_text_id = array_search($engText, $app_texts);
                    if ($app_text_id) {
                        $appText = $this->getDoctrine()->getManager()->getRepository('ESERVMAINHelpersBundle:AppText')->findOneBy(array('id' => $app_text_id));
                        if ($appText) {
                            $qry1 = $this->getDoctrine()->getManager()->createQueryBuilder()->update('ESERVMAINHelpersBundle:AltLanguageAppText', 'a')
                                    ->set('a.altLanguage', ':aLang')
                                    ->set('a.altName', ':aName')
                                    ->where('a.appText = :appTextId')
                                    ->setParameter('aLang', $alt_lang)
                                    ->setParameter('aName', $welshText)
                                    ->setParameter('appTextId', $appText)
                                    ->getQuery()
                            ;
                            $result = $qry1->execute();
                            $success_count++;
                        }
                    }
                }
            }
            if ($success_count === 0) {
                $message = 'No entries have been imported!';
            } else {
                $message = $success_count . ' entries have been imported.!';
            }
            $em->getConnection()->commit();
            $status = true;
        } catch (\Exception $e) {
            $message = 'Exception : ' . $e->getMessage();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

}
