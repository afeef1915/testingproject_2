<?php

namespace ESERV\MAIN\Services;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Exception;

class ESERVTranslations {
    /*
     *  Following four parameters will be initialized from the constructor call.
     */

    private $Container;
    private $FileSystem;
    private $TranslationsBasePath;
    private $CoreFunctions;
    private $Translator;

    /*
     *  Translation file name without the extension
     */

    const TFN = 'ESERVTrans';

    /**
     * Intitializes  Container and Entity Manager.()
     *
     * @param Container $c (Injected parameter)
     *
     * @return n/a
     * @throw n/a
     */
    public function __construct(Container $c) {
        $ds = DIRECTORY_SEPARATOR;

        $this->Container = $c;
        $this->CoreFunctions = $this->Container->get('core_function_services');
        $this->Translator = $this->Container->get('translator');
        $this->FileSystem = new Filesystem();
        $this->TranslationsBasePath = __DIR__ . '..' . $ds . '..' . $ds . '..' . $ds . '..' . $ds . '..' . $ds . 'app' . $ds . 'Resources' . $ds . 'translations' . $ds;
    }

    /**
     * Write contents to translation files ()
     *
     * @param Array $data ()
     *
     * @return n/a
     * @throw n/a
     */
    public function writeToTranslations($data = array(), $create_new_files = true, $clear_cache = true) {
        $path = $this->TranslationsBasePath;
        $env = $this->Container->get('kernel')->getEnvironment();

        $status = false;
        $message = '';

        try {
            //Check that path exists
            if ($this->FileSystem->exists($path)) {
                foreach ($data as $k => $v) {
                    $tr_file = $path . self::TFN . '_' . $env . '.' . $k . '.yml';
                    //check if the translation file exists
                    if ($this->FileSystem->exists($tr_file)) {
                        if (is_array($v)) {
                            //create the content for that specific locale / translation
                            $text = $this->prepareContentsToWrite($v);
                            file_put_contents($tr_file, $text);
                            #echo $tr_file.' - all good ;) <br/>' ;
                        }
                    } else if ($create_new_files) {
                        if (touch($tr_file)) {
                            if (is_array($v)) {
                                //create the content for that specific locale / translation
                                $text = $this->prepareContentsToWrite($v);
                                file_put_contents($tr_file, $text);
                                #echo $tr_file.' - all good ;) <br/>' ;
                            }
                        }
                    }
                }
                //Clearning the symfony cache
                if ($clear_cache) {
                    $this->CoreFunctions->clearSymfonyCache($env, 'translations', false);
                }
                $status = true;
                $message = 'Translation entries updated successfully!';
            } else {
                $message = 'Translation directory does not exist! ';
            }
        } catch (IOExceptionInterface $e) {
            $message = "IOException : " . $e->getPath();
        } catch (Exception $e) {
            $message = "Exception : " . $e->getMessage();
        }
        return array(
            'status' => $status,
            'message' => $message
        );
    }

    /**
     * Prepare contents to be written in to the translation file. ()
     *
     * @param Array $data ()
     *
     * @return n/a
     * @throw n/a
     */
    public function prepareContentsToWrite($data = array()) {
        $text = '';

        if (is_array($data)) {
            $eserv_lang_excluded = $this->Container->getParameter('eserv_lang_excluded');
            foreach ($data as $k => $v) {
                $encluded = true;
                $trimmed_key = trim($k);
                if ($eserv_lang_excluded) {
                    foreach ($eserv_lang_excluded as $ex) {
                        if (strpos($trimmed_key, $ex) !== false) {
                            $encluded = false;
                        }
                    }
                }
                if ($encluded) {
                    $trimmed_text = trim($v);
                    $text .= '"' . str_replace('"', '\"', $k) . '": "' . str_replace('"', '\"', $trimmed_text) . '"' . "\r\n";
                }
            }
        }

        return $text;
    }

    /**
     * Prepare contents as an array in following format ()
     * 
     * $arr = array(
     *        'en' => array(
     *           'Bad Credentials' => 'Bad Credentials NEW',
     *           'Bad credentials.' => 'Bad Credentials NEW',               
     *       ),
     *       'cy' => array(
     *           'Bad Credentials' => 'Cymwysterau drwg CY',
     *           'Bad credentials.' => 'Cymwysterau drwg CY',               
     *       ),
     *   );     
     *
     * @param String $class 
     * @param String $function 
     * @param String $param1 
     * @param String $param2 (Optional)
     *
     * @return n/a
     * @throw n/a
     */
    public function prepareContentsArray($initial_array = array(), $keys = array()) {
        $temp_array = array();

        try {
            #print_r($initial_array);die;
            if ((is_array($initial_array) && count($initial_array) > 0) &&
                    (is_array($keys) && isset($keys['locale']) && isset($keys['name']) && isset($keys['altName']) && isset($keys['location']))
            ) {
                //Get all the locales
//                print_r($initial_array);
//                die;
                $_init_array = $initial_array;

                foreach ($_init_array as $_value) {
                    $item = array(
                        'name' => $_value['name'],
                        'altName' => $_value['name'],
                        'locale' => 'en',
                        'location' => $_value['location'],
                    );
                    array_push($initial_array, $item);
                }
                foreach ($initial_array as $k => $v) {
                    if (isset($v[$keys['locale']]) && '' !== $v[$keys['locale']] && null !== $v[$keys['locale']]) {
                        $tmp_locale_array[] = $v[$keys['locale']];
                    } else {
                        throw new Exception('Locale is not set, empty or null.', 500);
                    }
                }

                //Get only the unique locales
                $tmp_locale_array = array_unique($tmp_locale_array);

                //Re-iterate through locales and results
                foreach ($tmp_locale_array as $k1 => $v1) {
                    $t = array();
                    foreach ($initial_array as $k2 => $v2) {
                        if ($v2[$keys['locale']] === $v1) {
                            $t[$v2[$keys['location']]] = $v2[$keys['altName']];
                        }
                    }
                    $temp_array[$v1] = $t;
                }
            } else {
                throw new Exception('All equivalent names are null, so there\'s nothing to write!', 500);
            }
        } catch (Exception $e) {
            throw new Exception('Exception : ' . $e->getMessage(), 500);
        }

        return $temp_array;
    }

    /**
     * Return the eservices translation domain.
     *
     * @param Array $data ()
     *
     * @return n/a
     * @throw n/a
     */
    public function getFullEservDbTransDomain() {
        $full_domain = null;

        if ($this->Container->hasParameter('app_translation')) {
            $env = $this->Container->get('kernel')->getEnvironment();
            $transltion_params = $this->Container->getParameter('app_translation');
            if ($transltion_params['domain_prefix']) {
                $trans_path = $this->Container->get('kernel')->getRootDir() . '/Resources/translations/';

                if (file_exists($trans_path . $transltion_params['domain_prefix'] . '_' . $env . '.en.yml')) {
                    $full_domain = $transltion_params['domain_prefix'] . '_' . $env;
                }
            }
        }

        return $full_domain;
    }

    /**
     * Return the eserv translation domain.
     *
     * @param Array $data ()
     *
     * @return n/a
     * @throw n/a
     */
    public function getFullEservDomainTranslation() {
        $full_domain = null;

        if ($this->Container->hasParameter('app_translation')) {
            $env = $this->Container->get('kernel')->getEnvironment();
            $transltion_params = $this->Container->getParameter('app_translation');
            if ($transltion_params['domain_prefix']) {
                $full_domain = $transltion_params['domain_prefix'] . '_' . $env;
            }
        }

        return $full_domain;
    }

    /**
     * Overrides symfony translation to use domain specific translation.
     *
     * @param String $str 
     * @param String $params_array 
     * @param String $domain (Optional)
     *
     * @return n/a
     * @throw n/a
     */
    public function eservCustomTranslator($str, $params_array = array(), $domain = null) {
        try {
            $str = trim($str);
            switch ($domain) {
                case null :
                    $full_domain = $this->getFullEservDbTransDomain();
                    if (!is_null($full_domain)) {
                        return $this->Translator->trans($str, $params_array, $full_domain);
                    } else {
                        return $this->Translator->trans($str, $params_array);
                    }
                    break;
                case 'DEFAULT' :
                    return $this->Translator->trans($str, $params_array);
                    break;
                default :
                    return $this->Translator->trans($str, $params_array, $domain);
            }
        } catch (Exception $e) {
            return $str;
        }
    }

    public function eservCustomTranslateStringValuesInArray($array, $params_array = array(), $domain = null) {
        $translatedArray = array();
        foreach ($array as $key => $value) {
            $translatedArray[$key] = $this->eservCustomTranslator($value, $params_array, $domain);
        }
        return $translatedArray;
    }

}
