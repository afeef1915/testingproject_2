<?php

namespace EWZ\Bundle\RecaptchaBundle\Form\Type;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * A field for entering a recaptcha text.
 */
class RecaptchaType extends AbstractType {

    /**
     * The reCAPTCHA server URL's
     */
    const RECAPTCHA_API_SERVER = '//www.google.com/recaptcha/api';
    const RECAPTCHA_API_JS_SERVER = '//www.google.com/recaptcha/api/js/recaptcha_ajax.js';

    /**
     * The public key
     *
     * @var string
     */
    protected $publicKey;

    /**
     * Use secure url?
     *
     * @var Boolean
     */
    protected $secure;

    /**
     * Enable recaptcha?
     *
     * @var Boolean
     */
    protected $enabled;

    /**
     * Language
     *
     * @var string
     */
    protected $language;
    protected $ajax;

    /**
     * Construct.
     *
     * @param ContainerInterface $container An ContainerInterface instance
     */
    public function __construct(ContainerInterface $container, $ajax) {
        $this->publicKey = $container->getParameter('ewz_recaptcha.public_key');
        $this->enabled = $container->getParameter('ewz_recaptcha.enabled');
        $this->language = $container->getParameter('ewz_recaptcha.locale_key');
        $this->ajax = $ajax;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options) {
        $view->vars = array_replace($view->vars, array(
            'ewz_recaptcha_enabled' => $this->enabled,
            'ewz_recaptcha_ajax' => $this->ajax,
        ));

        if (!$this->enabled) {
            return;
        }

        if (!isset($options['language'])) {
            $options['language'] = $this->language;
        }

        if (!$this->ajax) {
            $view->vars = array_replace($view->vars, array(
                'url_challenge' => sprintf('%s?hl=%s', self::RECAPTCHA_API_SERVER, $options['language']),
                'public_key' => $this->publicKey,
            ));
        } else {
            $view->vars = array_replace($view->vars, array(
                'url_api' => self::RECAPTCHA_API_JS_SERVER,
                'public_key' => $this->publicKey,
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'compound' => false,
            'public_key' => null,
            'url_challenge' => null,
            'url_noscript' => null,
            'attr' => array(
                'options' => array(
                    'theme' => 'light',
                    'type' => 'image',
                    'size' => 'normal',
                    'expiredCallback' => null,
                )
            ),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent() {
        return 'form';
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'ewz_recaptcha';
    }

    /**
     * Gets the Javascript source URLs.
     *
     * @param string $key The script name
     *
     * @return string The javascript source URL
     */
    public function getScriptURL($key) {
        return isset($this->scripts[$key]) ? $this->scripts[$key] : null;
    }

    /**
     * Gets the public key.
     *
     * @return string The javascript source URL
     */
    public function getPublicKey() {
        return $this->publicKey;
    }

}
