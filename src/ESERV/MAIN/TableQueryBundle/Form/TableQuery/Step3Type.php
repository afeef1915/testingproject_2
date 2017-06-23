<?php

namespace ESERV\MAIN\TableQueryBundle\Form\TableQuery;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class Step3Type extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('field', 'entity', array(
                    'class' => 'ESERV\MAIN\TableQueryBundle\Entity\QueryViewField',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) use ($options){
                        return $er->createQueryBuilder('u')
                                ->where('u.queryView = :eservQVId')
                                ->setParameter('eservQVId', $options['params']['query_view_id'])
                                ->andWhere('u.isActive = :eservIsActive')
                                ->setParameter('eservIsActive', 'Y')
                            ;
                    },
                    'label' => 'Field',
                    'empty_value' => ' -- Please Select -- ',
                    'constraints' => array(
                    ),
                    'required' => true,
                ))
                ->add('descending', 'checkbox', array(
                    'required' => false
                ))
                ->add('appId', 'hidden', array(
                ))
                ->add('save', 'submit')
                ->setMethod('POST')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            //'data_class' => '',
            'params' => array()
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_table_query_step_3';
    }
    
}
