<?php

namespace ESERV\MAIN\HelpersBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class HelpersBundleAltLangService extends Controller {

    private $em;
    private $c;

    public function __construct(EntityManager $em, Container $c = null) {
        $this->em = $em;
        $this->c = $c;
    }

    public function createAltLang($data = array()) {
        $status = false;
        $msg = '';
        //&& !is_null($data['altName'])
        if (is_array($data) && (!is_null($data['name']) && !is_null($data['altLanguage']) )) {
            try {
                $em = $this->em;
                $code = md5($data['name']);
                $check = $em->getRepository('ESERVMAINHelpersBundle:AppText')->findOneBy(array('code' => $code));
                if (!$check) {
                    $app_text = new \ESERV\MAIN\HelpersBundle\Entity\AppText();
                    $app_text->setCode($code);
                    $app_text->setName($data['name']);
                    $em->persist($app_text);
                    $em->flush();

                    $alt_lang_app_text = new \ESERV\MAIN\HelpersBundle\Entity\AltLanguageAppText();
                    $alt_lang = $em->getReference('ESERV\MAIN\HelpersBundle\Entity\AltLanguage', $data['altLanguage']);

                    $alt_lang_app_text->setAppText($app_text);
                    $alt_lang_app_text->setAltLanguage($alt_lang);
                    $alt_lang_app_text->setAltName($data['altName']);
                    $em->persist($alt_lang_app_text);
                    $em->flush();

                    $msg = 'Alternative text has been created.';
                    $status = true;
                } else {
                    $msg = 'Text already exists. Please type a different text';
                }
            } catch (\Exception $e) {
                $msg = $e->getMessage();
            }
        } else {
            $msg = 'Data needs to be in array format and/or Data is empty.';
        }

        return array(
            'status' => $status,
            'msg' => $msg
        );
    }

    public function updateAltLang($data = array()) {
        $status = false;
        $msg = '';
        //&& !is_null($data['altLanguage'])
        if (is_array($data) && (!is_null($data['alt_lang_app_text_id']) && !is_null($data['altName']) )) {
            try {
                $em = $this->em;
                $alt_lang_app_text = $em->getReference('ESERV\MAIN\HelpersBundle\Entity\AltLanguageAppText', $data['alt_lang_app_text_id']);
//                $alt_lang = $em->getReference('ESERV\MAIN\HelpersBundle\Entity\AltLanguage', $data['altLanguage']);                
                $alt_lang_app_text->setAltName($data['altName']);
//                $alt_lang_app_text->setAltLanguage($alt_lang);

                $em->flush();
                $msg = 'Alternative text has been updated.';
                $status = true;
            } catch (\Exception $e) {
                $msg = $e->getMessage();
            }
        } else {
            $msg = 'Data needs to be in array format and/or Data is empty.';
        }

        return array(
            'status' => $status,
            'msg' => $msg
        );
    }

    public function getAltLanguageAppTexts($except_null = false) {
        $status = false;
        $msg = '';
        try {
            $qb = $this->em->createQueryBuilder();
            $result = $qb
                    ->select('at.name, alat.altName, l.locale', 'at.location')
                    ->from('ESERVMAINHelpersBundle:AltLanguageAppText', 'alat')
                    ->leftJoin('alat.altLanguage', 'al')
                    ->leftJoin('al.language', 'l')
                    ->leftJoin('alat.appText', 'at');
            if ($except_null) {
                $qb->where('at.location IS NOT NULL');
            }
            $qb->orderBy('alat.altLanguage', 'ASC');

            $status = true;
            $msg = $result->getQuery()->getArrayResult();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

//        print_r($msg);
//        die;

        return array(
            'status' => $status,
            'msg' => $msg
        );
    }

    public function getEntryTranslationByLocale($app_text_location, $locale) {
        $status = false;
        $msg = '';
        $translations = array();
        try {
            $qb = $this->em->createQueryBuilder();

            $default_lang = $this->c->getParameter('locale');

            if ($locale != $default_lang) {
                $result = $qb
                        ->select('at.name, alat.altName, l.locale')
                        ->from('ESERVMAINHelpersBundle:AltLanguageAppText', 'alat')
                        ->leftJoin('alat.altLanguage', 'al')
                        ->leftJoin('al.language', 'l')
                        ->leftJoin('alat.appText', 'at')
                        ->where('at.location = :app_text_location')
                        ->setParameter('app_text_location', $app_text_location)
                        ->andWhere('l.locale = :locale')
                        ->setParameter('locale', $locale)
                ;

                $tmp_res = $result->getQuery()->getArrayResult();

                $translations['text'] = '';

                foreach ($tmp_res as $obj) {
                    if ($obj['locale'] == $locale) {
                        $translations['text'] = $obj['altName'];
                    }
                }
                
                $translations['locale'] = $locale;
                
            } else {
                $result = $qb
                        ->select('at.name')
                        ->from('ESERVMAINHelpersBundle:AppText', 'at')
                        ->where('at.location = :app_text_location')
                        ->setParameter('app_text_location', $app_text_location)
                ;

                $res = $result->getQuery()->getArrayResult();
                
                $translations['locale'] = $locale;
                $translations['text'] = count($res) > 0 && isset($res[0]) && isset($res[0]['name']) ? $res[0]['name'] : '';
            }



            $msg = 'Success';
            $status = true;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        return array(
            'status' => $status,
            'msg' => $msg,
            'translations' => $translations
        );
    }

}
