<?php

namespace ESERV\MAIN\Services\Twig;

use Symfony\Component\DependencyInjection\Container;
use \Symfony\Component\Translation\LoggingTranslator;
use \Symfony\Component\HttpKernel\KernelInterface;
use Doctrine\ORM\EntityManager;

class ESERVExtension extends \Twig_Extension {

    public $c;
    public $em;
    public $eservFunctions;
    private $translator;
    private $kernel = null;

    public function __construct(Container $c, \Symfony\Component\Translation\TranslatorInterface $translator = null, KernelInterface $kernel = null, EntityManager $em = null) {
        $this->c = $c;
        $this->translator = $translator;
        if (!is_null($kernel)) {
            $this->kernel = $kernel;
        }

        if (!is_null($em)) {
            $this->em = $em;
        }

        // Functions
        $this->eservFunctions['form_eservRadio'] = new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', array('is_safe' => array('html')));
        $this->eservFunctions['form_eservRow'] = new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', array('is_safe' => array('html')));
        $this->eservFunctions['form_eservSelectRow'] = new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', array('is_safe' => array('html')));
        $this->eservFunctions['form_eservPostCodeLookup'] = new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', array('is_safe' => array('html')));
        $this->eservFunctions['form_eservAddressSelector'] = new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', array('is_safe' => array('html')));
        $this->eservFunctions['form_eservTree'] = new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', array('is_safe' => array('html')));
        $this->eservFunctions['is_dev_env'] = new \Twig_Function_Method($this, 'isDevEnvironment');
        $this->eservFunctions['file_get_contents'] = new \Twig_Function_Method($this, 'fileGetContentsMethod');
        $this->eservFunctions['set_db_token'] = new \Twig_Function_Method($this, 'setDbToken');
        $this->eservFunctions['use_dev_help'] = new \Twig_Function_Method($this, 'useDevHelp');
        $this->eservFunctions['file_exists'] = new \Twig_Function_Method($this, 'fileExists');
        $this->eservFunctions['format_based_on_class'] = new \Twig_Function_Method($this, 'formatValueBasedOnClass');
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
            new \Twig_SimpleFilter('eserv_date', array($this, 'eservDateFilter')),
            new \Twig_SimpleFilter('eserv_website', array($this, 'eservWebsiteFilter')),
            new \Twig_SimpleFilter('eserv_keyformat', array($this, 'eservKeyFormatFilter')),
            new \Twig_SimpleFilter('eserv_remove_hash', array($this, 'eservRemoveHashFilter')),
            new \Twig_SimpleFilter('eserv_get_user_theme', array($this, 'eservGetUserTheme')),
            new \Twig_SimpleFilter('eserv_switch_lang', array($this, 'eservSwitchLang')),
            new \Twig_SimpleFilter('eserv_base64_encode', array($this, 'eservBase64Encode')),
            new \Twig_SimpleFilter('eserv_php_self', array($this, 'eservPhpSelf')),
            new \Twig_SimpleFilter('eserv_format_ni_number', array($this, 'formatNiNumber')),
            new \Twig_SimpleFilter('eserv_trans', array($this, 'eservDomainTranslate')),
            new \Twig_SimpleFilter('eserv_md5', array($this, 'eservMd5')),
            new \Twig_SimpleFilter('eserv_format_bytes', array($this, 'eservFormatBytes')),
            new \Twig_SimpleFilter('check_file_exists', array($this, 'checkFileExists')),
            new \Twig_SimpleFilter('str_replace', array($this, 'strReplaceFilter')),
            new \Twig_SimpleFilter('get_content_by_tag', array($this, 'getContentByTagFilter')),
            new \Twig_SimpleFilter('set_db_token', array($this, 'setDbToken')),
            new \Twig_SimpleFilter('eserv_json_decode', array($this, 'jsonDecode')),
            new \Twig_SimpleFilter('file_get_contents', array($this, 'fileGetContentsFilter')),
            new \Twig_SimpleFilter('eserv_str_replace', array($this, 'eservStrReplace')),
            new \Twig_SimpleFilter('eservices_db_trans', array($this, 'eservicesDbTranslate')),
            new \Twig_SimpleFilter('eservices_get_notifications', array($this, 'eservicesGetNotificationsFilter')),
            new \Twig_SimpleFilter('utf8_filter', array($this, 'utf8Filter')),
            new \Twig_SimpleFilter('eserv_ucfirst', array($this, 'eservUcfirst')),
            new \Twig_SimpleFilter('eserv_htmlentities', array($this, 'eservHtmlEntities')),
            new \Twig_SimpleFilter('eserv_urldecode', array($this, 'eservUrlDecode')),
        );
    }

    public function getFunctions() {
        return $this->eservFunctions;
    }

    public function eservHtmlEntities($str) {
        return htmlentities($str);
    }

    public function eservUrlDecode($str) {
        return urldecode($str);
    }

    public function eservicesDbTranslate($str, $params = array()) {
        $domain = $this->c->get('eserv_translation_services')->getFullEservDbTransDomain();

        return $this->translator->trans($str, $params, $domain);
    }

    public function eservicesGetNotificationsFilter() {
        return $this->c->get('eserve_notification_services')->getNewNotifications();
    }

    public function utf8Filter($str, $type = 'encode') {
        $output = $str;
        switch ($type) {
            case 'encode' :
                $output = utf8_encode($str);
                break;
            case 'decode' :
                $output = utf8_decode($str);
                break;
        }
        return $output;
    }

    public function eservUcfirst($str) {
        return ucwords(strtolower($str));
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',') {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;

        return $price;
    }

    public function jsonDecode($val) {
        return json_decode($val, true);
    }

    public function getName() {
        return 'eserv_extension';
    }

    public function eservDateFilter($date_object, $format = null) {
        $new_format = $format !== null ? $format : $this->c->getParameter('app_date_format');
        if (is_object($date_object)) {
            return $date_object !== null ? $date_object->format($new_format) : '';
        } else if (!is_null($date_object)) {
            $newDate = date($new_format, strtotime($date_object));
            return $newDate;
        }
    }

    public function eservWebsiteFilter($website) {
        $http = substr($website, 0, 4);
        if ($http == 'http') {
            return '<a href="' . $website . '" target="_blank">' . $website . '</a>';
        } else {
            return '<a href="http://' . $website . '" target="_blank">' . $website . '</a>';
        }
    }

    public function eservKeyFormatFilter($key) {
        if (!is_null($key)) {
            $split = preg_split('/(?=[A-Z])/', $key, -1, PREG_SPLIT_NO_EMPTY);
            $string = strtolower(implode('_', $split));
            return $string;
        }
    }

    public function eservRemoveHashFilter($color_code) {
        return str_replace('#', '', $color_code);
    }

    public function eservGetUserTheme($theme, $type = 'main') {
        $theme_array = explode('-', $theme);

        $selected_theme = isset($theme_array[0]) ? ('undefined' != strtolower($theme_array[0]) ? $theme_array[0] : 'default') : 'default';
        $selected_color = isset($theme_array[1]) ? ('undefined' != strtolower($theme_array[1]) ? strtoupper($theme_array[1]) : 'DEFAULT') : 'DEFAULT';

        return $type == 'main' ? $selected_theme : $selected_color;
    }

    public function eservSwitchLang($url, $lang = null) {
        $available_languages = $this->c->getParameter('app_available_languages');
        if (!is_null($lang)) {
            $url = str_replace($available_languages, $lang, $url);
        }

        return $url;
    }

    public function eservBase64Encode($url) {
        return base64_encode($url);
    }

    public function eservPhpSelf($url) {
        return $_SERVER['REQUEST_URI'];
    }

    public function formatNiNumber($niNumber) {
        $pattern = '/-| |_/';
        $niNumber = preg_replace($pattern, '', $niNumber);
        $niNumberArray = str_split($niNumber, 2);

        if (is_array($niNumberArray)) {
            $niNumberFormated = '';
            foreach ($niNumberArray as $k => $str) {
                $niNumberFormated = $niNumberFormated . ' ' . $str;
            }
            $niNumber = trim($niNumberFormated);
        }
        return $niNumber;
    }
    
    public function formatValueBasedOnClass($value, $cssClass) {
        return $this->c->get('core_function_services')->formatValueBasedOnClass($value, $cssClass);
    }

    public function setDbToken($paramsArray = array()) {
        return $this->c->get('db_core_function_services')->setDbToken($paramsArray);
    }

    public function eservDomainTranslate($str, $params = array()) {
        if (!is_null($this->translator)) {
            $domain = $this->c->get('eserv_translation_services')->getFullEservDomainTranslation();

            return $this->translator->trans($str, $params, $domain);
        } else {
            return $str;
        }
    }

    public function eservMd5($str) {
        return md5($str);
    }

    public function isDevEnvironment() {
        return $this->c->get('core_function_services')->isDevEnvironment();
    }

    public function useDevHelp() {
        $status = false;

        $isDev = $this->isDevEnvironment();
        $useDevHelpConfigParam = ($this->c->hasParameter('use_dev_help')) ? $this->c->getParameter('use_dev_help') : false;

        if ($isDev && $useDevHelpConfigParam) {
            $status = true;
        }

        return $status;
    }

    public function eservStrReplace($str, $find, $replace) {
        return str_replace($find, $replace, $str);
    }

    public function eservFormatBytes($size, $precision = 2) {
        $base = log($size, 1024);
        $suffixes = array('Bytes', 'KB', 'M', 'GB', 'T');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    public function checkFileExists($file_path) {
        if (!is_null($this->kernel)) {
            $webRoot = realpath($this->kernel->getRootDir() . '/../web/');
            $toCheck = realpath($webRoot . '/' . $file_path);

            if (!is_file($toCheck)) {
                return false;
            }

            if (strncmp($webRoot, $toCheck, strlen($webRoot)) !== 0) {
                return false;
            }

            return true;
        } else {
            return false;
        }
    }

    public function fileGetContentsMethod($url, $cached = true) {

        $url = $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        if (!$cached) {
            $headers = array(
                "Cache-Control: no-cache",
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        }
        
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function fileGetContentsFilter($url) {
        return file_get_contents($url);
    }

    public function strReplaceFilter($subject, $search, $replace) {
        return str_replace($search, $replace, $subject);
    }

    public function getContentByTagFilter($Entirehtml, $attr, $value) {
        $extract = '';
        if ($Entirehtml) {
            $html = str_replace(array('&amp;', '&copy;'), array('&', 'Â©'), $Entirehtml);
            $extract = $this->get_tag($attr, $value, $html);
        }

        return $extract;
    }

    protected function get_tag($attr, $value, $xml) {

        $attr = preg_quote($attr);
        $value = preg_quote($value);

        $tag_regex = '/<div[^>]*' . $attr . '="' . $value . '">(.*?)<\\/div>/si';

        preg_match($tag_regex, $xml, $matches);

        return isset($matches[1]) ? $matches[1] : '';
    }

    public function fileExists($path) {
        return file_exists($path) ? true : false;
    }

}
