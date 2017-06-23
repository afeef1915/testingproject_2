<?php

namespace ESERV\ConsoleCommandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FileOptionsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ESERVConsoleCommandBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function moveFiles()
    {
        $src = $this->get('kernel')->getRootDir();
        echo $src;
        rename('image1.jpg', 'del/image1.jpg');
    }
}
