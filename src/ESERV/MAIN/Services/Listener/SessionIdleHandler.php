<?php

namespace ESERV\MAIN\Services\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\DependencyInjection\Container;

class SessionIdleHandler {

    protected $session;
    protected $securityContext;
    protected $router;
    protected $maxIdleTime;
    protected $container;

    public function __construct(SessionInterface $session, SecurityContextInterface $securityContext, RouterInterface $router, Container $container, $maxIdleTime = 0) {
        $this->session = $session;
        $this->securityContext = $securityContext;
        $this->router = $router;
        $this->maxIdleTime = $maxIdleTime;
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event) {
        if (HttpKernelInterface::MASTER_REQUEST != $event->getRequestType()) {

            return;
        }

        if ($this->maxIdleTime > 0) {

            $fallback_url = $this->session->get('site_home_url');

            $this->session->start();
            $lapse = time() - $this->session->getMetadataBag()->getLastUsed();

            if ($lapse > $this->maxIdleTime) {

                $this->securityContext->setToken(null);
                $this->session->getFlashBag()->set('info', 'You have been logged out due to inactivity.');

                $currentRoute = $this->container->get('request')->get('_route');
                $currentUrl = $this->router->generate($currentRoute);

                // Change the route if you are not using FOSUserBundle.
                $event->setResponse(new RedirectResponse(is_null($fallback_url) ? $currentUrl : $fallback_url));
            }
        }
    }

}
