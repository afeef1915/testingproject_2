<?php

namespace ESERV\MAIN\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityLetterType extends AbstractType {

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
                    'label' => 'Targets',
                    'data' => $targets,
                    'required' => FALSE
                ))
                ->add('shortDescription', 'text', array(
                    'label' => 'Description',
                    'data' => $description,
                    'required' => FALSE
                ))
                ->add('templateVersion', 'text', array(
                    'label' => 'Template',
                    'data' => $template_name,
                    'required' => FALSE
                ))
                ->add('viewLetter', 'text', array(
                    'label' => 'Letter',
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
        return 'eserv_main_activity_letter';
    }

}
