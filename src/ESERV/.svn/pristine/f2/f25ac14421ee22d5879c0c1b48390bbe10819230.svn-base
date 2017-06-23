<?php

namespace ESERV\MAIN\ContactBundle\Form\Individual;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ContactType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('displayName')
            ->add('statusDate', 'date', array(
                    'widget'=>'single_text', 
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,                   
                    'data' => new \DateTime()
            ))
            ->add('contactStatus', 'entity', array(
                    'class' => 'ESERVMAINContactBundle:ContactStatus',
                    'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                    ->leftJoin('u.contactType', 'ct')
                                    ->where('u.code = :uc ')
                                    ->setParameter('uc',  \ESERV\MAIN\Services\AppConstants::CS_PERSON_LIVE)
                                    ->andWhere('ct.code = :ctc')
                                    ->setParameter('ctc', \ESERV\MAIN\Services\AppConstants::CT_PERSON)
                                    ;
                    },  
            ))
            ->add('contactType', 'entity', array(
                    'class' => 'ESERVMAINContactBundle:ContactType',
                    'property' => 'code',
                    'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('u')                                    
                                    ->where('u.code = :uc ')
                                    ->setParameter('uc',  \ESERV\MAIN\Services\AppConstants::CT_PERSON)                                    
                                    ;
                    },  
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_individual_contact';
    }
}
