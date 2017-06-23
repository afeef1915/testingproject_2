<?php

namespace ESERV\MAIN\TableQueryBundle\Form\TableQuery;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Step2Type extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('viewDescription', 'hidden', array())
                ->add('viewName', 'hidden', array())
                ->add('viewId', 'hidden', array())
                ->add('rawSqlQuery', 'hidden', array())
                ->add('jsonSqlData', 'textarea', array())
                ->add('isCountPressed', 'hidden', array(
                    'data' => 'N'
                ))
                ->add('stepNo', 'hidden', array(
                    'data' => '2'
                ))
                ->add('appId', 'hidden', array(
                ))
                ->add('next', 'submit')
                ->setMethod('POST')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'formData' => array()
            //'data_class' => ''
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_table_query_step_2';
    }
    
}
