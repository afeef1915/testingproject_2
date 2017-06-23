<?php

namespace ESERV\MAIN\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityEmailType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */    

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $description = $options['params']['description'];
        $template_name = $options['params']['template_name'];
        $targets = $options['params']['targets_name'];
        $view_document_link = $options['params']['view_link'];

        $builder
                ->add('targets', 'text', array(
                    'label' => 'Recipients',
                    'data' => $targets,
                    'required' => FALSE
                ))
                ->add('shortDescription', 'text', array(
                    'label' => 'Subject',
                    'data' => $description,
                    'required' => FALSE
                ))
                ->add('templateVersion', 'text', array(
                    'label' => 'Template',
                    'data' => $template_name,
                    'required' => FALSE
                ))
                ->add('viewEmail', 'text', array(
                    'label' => 'Email',
                    'data' => $view_document_link,
                    'required' => FALSE
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'params' => array(),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_activity_email';
    }

}
