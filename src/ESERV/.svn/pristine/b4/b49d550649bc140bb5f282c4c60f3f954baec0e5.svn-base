<?php

namespace ESERV\MAIN\ContactBundle\Form\Individual;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class EmailType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emailAddress', 'text', array(
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Email(),                        
                    ),
                    'eserv_extra_validation' => array(
                        'email' => 'email'
                    ),                
                    'required' => false
            ))
            ->add('emailType', 'entity', array(
                    'class' => 'ESERVMAINApplicationCodeBundle:ApplicationCode',
                    'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                    ->leftJoin('u.applicationCodeType', 'act')
                                    ->where('u.code = :uc ')
                                    ->setParameter('uc', \ESERV\MAIN\Services\AppConstants::AC_PERSONAL_EMAIL)
                                    ->andWhere('act.code = :atc')
                                    ->setParameter('atc', \ESERV\MAIN\Services\AppConstants::ACT_EMAIL_ADDRESS_TYPE)
                                    ;
                    },
            ))
            ->add('primaryRecord','text',array(
                'data' => 'Y'
            ))                
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Email'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_individual_email';
    }
}
