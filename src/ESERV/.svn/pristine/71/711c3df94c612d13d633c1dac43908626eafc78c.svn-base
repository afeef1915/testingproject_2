<?php

namespace ESERV\MAIN\Services;

use Symfony\Component\DependencyInjection\Container;

class ESERVEmail{
    /*
     *  Following four parameters will be initialized from the constructor call.
     */

    private $Container;

    /**
     * Intitializes  Container and Entity Manager.()
     *
     * @param Container $c (Injected parameter)
     *
     * @return n/a
     * @throw n/a
     */
    public function __construct(Container $c) 
    {
        $this->Container = $c;        
    }

    public function sendEmail($data = array())
    {   
        try{            
            $mailer = $this->Container->get('mailer');
            $message = $mailer->createMessage()
                    ->setSubject($data['subject'])
                    ->setFrom($data['fromEmail'])
                    ->setTo($data['toEmail'])
                    ->setBody($data['body'], 'text/html');        
            if (array_key_exists('attachmentPath', $data) && $data['attachmentPath'] !== null) {
                $message->attach(\Swift_Attachment::fromPath($data['attachmentPath']));
            }
            return $mailer->send($message); //returns true or false upon success 
        }catch(\Exception $e){
            throw new \Exception('Exception occurred :- '.$e->getMessage(), 500);
        }        
    }

}
