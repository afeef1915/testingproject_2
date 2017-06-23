<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Security\UserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Security\UserBundle\Services\UserBundleProfileService;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller {
    
    public function indexAction() {
        return $this->render('SecurityUserBundle:Profile:index.html.twig', array());
    }

    /**
     * Show the user
     */
    public function showAction() {
        #echo 'We are done ;)'; die;

        $logged_in_user = new UserBundleProfileService($this->getDoctrine()->getManager(), $this->container);
        $logged_in_user = $logged_in_user->show(true);
        
        $user = $this->container->get('security.context')->getToken()->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('SecurityUserBundle:Profile:show.html.twig', array(
//                    //From contact table
//                    'contact' => array(
//                        'fullname' => $logged_in_user['contact'][0]['display_name'],                        
//                    ),
                    //From fos_user table
                    'fos_user' => array(
                        'username' => $logged_in_user['fos_user'][0]['username'],
                        'email' => $logged_in_user['fos_user'][0]['email'],
                        'last_login' => $logged_in_user['fos_user'][0]['lastLogin']->format('Y-m-d H:i:s')
                    ),
            
//                     //From mm_user_setting table
//                    'mm_user_setting' => array(
//                        'auto_save' => $logged_in_user['mm_user_setting'][0]['auto_save'],
//                        'language' => $logged_in_user['mm_user_setting'][0]['language'],
//                        'layout_state' => $logged_in_user['mm_user_setting'][0]['layout_state'],
//                        'menu_state' => $logged_in_user['mm_user_setting'][0]['menu_state'],
//                        'theme' => $logged_in_user['mm_user_setting'][0]['theme'],
//                        'theme_font_size' => $logged_in_user['mm_user_setting'][0]['theme_font_size'],
//                        'theme_width' => $logged_in_user['mm_user_setting'][0]['theme_width'],                        
//                    )
                    
        ));
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request) {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->container->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }

//        return $this->container->get('templating')->renderResponse(
//                        'SecurityUserBundle:Profile:edit.html.' . $this->container->getParameter('fos_user.template.engine'), array('form' => $form->createView())
//        );
        
        return $this->render('SecurityUserBundle:Profile:edit.html.twig', array('form' => $form->createView()));
    }

    

}
