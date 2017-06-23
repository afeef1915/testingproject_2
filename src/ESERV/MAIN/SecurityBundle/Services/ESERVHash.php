<?php

namespace ESERV\MAIN\SecurityBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Response;

class ESERVHash extends Controller
{
    const SECRET_KEY = 'miller1984';
    
    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c)
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $this->c->get('core_function_services');
        $this->dbCore = $this->c->get('db_core_function_services');
    }

    public function eserv_encrypt($str)
    {
//        $encrypted_str = $str;
        $encrypted_str = base64_encode($str);
//        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
//        $encrypted_str = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::SECRET_KEY, $str, MCRYPT_MODE_CBC, $iv);
        
        return $encrypted_str;
    } #eserv_encrypt end

    public function eserv_decrypt($str)
    {
//        $decrypted_str = $str;
        $decrypted_str = base64_decode($str);
//        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
//        $decrypted_str = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, self::SECRET_KEY, $str, MCRYPT_MODE_CBC, $iv);
        
        return $decrypted_str;        
    } #eserv_decrypt end
    
}
