<?php

namespace ESERV\MAIN\ErrorHandlingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction(FlattenException $exception, DebugLoggerInterface $logger = null, $format = 'html', $embedded = false, Request $request) {

        $app_logging_enabled = $this->container->getParameter('app_logging_enabled');

        if ($app_logging_enabled === true) {


            //Working piece is below this line

            $ip = $_SERVER['REMOTE_ADDR'];

            $StatusCode = $exception->getStatusCode();
//            $fileName = $exception->getFile();
            $requestStack = $this->container->get('request_stack');
            $ErrorLocation = $requestStack->getMasterRequest()->attributes->get('_controller') . ' in line ' . $exception->getLine();
            $ErrorMessage = $exception->getMessage();

            $FolderName = 'logs'; //under 'web/tmp' path
            $FileName = 'CustomError.log';

            $TmpCode = strtoupper(md5(date('Y-m-d') . $ip . $StatusCode . $ErrorMessage));

            $CoreFunctions = $this->get('core_function_services');

            $Message = $CoreFunctions->GetLogMessage($TmpCode, $ErrorMessage, $ErrorLocation, $ip, $StatusCode);
            $CoreFunctions->CustomErrorLogger($FolderName, $FileName, $Message, $TmpCode);
            
            $TitleMessage = '';
            switch ($StatusCode) {
                //Bad request
                case 400:
                    $TitleMessage = 'Bad Request';
                    break;
                //Unauthroized
                case 401:
                    $TitleMessage = 'Unauthroized';
                    break;
                //Forbidden
                case 403:
                    $TitleMessage = 'Forbidden';
                    break;
                //Not found    
                case 404:
                    $TitleMessage = 'Page Not Found';
                    break;
                //Internal server error    
                case 500:
                    $TitleMessage = 'Internal Server Error';
                    break;
                //Service unavailable   
                case 503:
                    $TitleMessage = 'Service Unavailable';
                    break;
                //Permission denied   
                case 550:
                    $TitleMessage = 'Access Denied';
                    break;
                default: $TitleMessage = 'An error has occurred!';
            }

            $params = array(
                'ErrorCode' => $StatusCode,
                'TitleMessage' => $TitleMessage,
                'Message' => $exception->getMessage(),
                'Code' => $TmpCode,
                'isAJAX' => $request->isXmlHttpRequest() ? true : false
            );
            
            $error_handling_twig = $this->container->hasParameter('error_handling_twig') ? $this->container->getParameter('error_handling_twig') : 'ESERVMAINErrorHandlingBundle:Default:index.html.twig';

                return $this->render($error_handling_twig, $params);

//        switch ($exception->getStatusCode()) {
//            //Bad request
//            case 400: return $this->render('ESERVMAINErrorHandlingBundle:Default:index.html.twig', $params);
//                break;
//            //Unauthroized
//            case 401: return $this->render('ESERVMAINErrorHandlingBundle:Default:index.html.twig', $params);
//                break;
//            //Forbidden
//            case 403: return $this->render('ESERVMAINErrorHandlingBundle:Default:index.html.twig', $params);
//                break;
//            //Not found    
//            case 404: return $this->render('ESERVMAINErrorHandlingBundle:Default:index.html.twig', $params);
//                break;
//            //Internal server error    
//            case 500: return $this->render('ESERVMAINErrorHandlingBundle:Default:index.html.twig', $params);
//                break;
//            //Service unavailable   
//            case 503: return $this->render('ESERVMAINErrorHandlingBundle:Default:index.html.twig', $params);
//                break;
//            //Permission denied   
//            case 550: return $this->render('ESERVMAINErrorHandlingBundle:Default:index.html.twig', $params);
//                break;
//            default: return $this->render('ESERVMAINErrorHandlingBundle:Default:index.html.twig', $params);
//        }
        }
    }

}
