<?php

namespace ESERV\MAIN\TableQueryBundle\Form\TableQuery;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
//use ESERV\MAIN\Services\AppConstants;
use Doctrine\ORM\EntityRepository;

class Step1Type extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('view', 'entity', array(
                    'class' => 'ESERV\MAIN\TableQueryBundle\Entity\QueryView',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er){
                        return $er->createQueryBuilder('u')
                                ->where('u.isActive = :queryIsActiveParam')
                                ->setParameter('queryIsActiveParam', 'Y')
                            ;
                    },
                    'label' => 'View',
                    'empty_value' => ' -- Please Select -- ',
                    'constraints' => array(
                    ),
                    'required' => true,
                ))   
                ->add('name', 'text', array(
                    'required' => true
                ))
                ->add('stepNo', 'hidden', array(
                    'data' => '1'
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
            //'data_class' => ''
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_table_query_step_1';
    }
    
}
