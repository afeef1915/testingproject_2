<?php

namespace Security\UserBundle\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\HttpUtils;

class AuthenticationEntryPoint implements AuthenticationEntryPointInterface {

    private $router;

    /**
     * @param     RouterInterface $router
     * @param     Session $session
     */
    public function __construct(RouterInterface $router, Session $session) {
        $this->router = $router;
        $this->session = $session;
    }

    /**
     * Starts the authentication scheme.
     *
     * @param Request $request The request that resulted in an AuthenticationException
     * @param AuthenticationException $authException The exception that started the authentication process
     *
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null) {
        if ($request->isXmlHttpRequest()) {            
            if ($authException instanceof AuthenticationException || $authException instanceof AccessDeniedException) {
                $array = array('success' => false, 'status' => 403, 'loggedIn' => false);
                $response = new Response(json_encode($array));
                $response->headers->set( 'X-Status-Code', 403);
                $response->headers->set('Content-Type', 'application/json');
                
                return $response;
            }
        } else {
            $url = $this->router->generate('fos_user_security_mtllogin');
            
            return new RedirectResponse($url);
        }
    }

}
