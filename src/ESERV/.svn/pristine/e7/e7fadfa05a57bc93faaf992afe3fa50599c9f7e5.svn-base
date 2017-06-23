<?php

namespace ESERV\MAIN\ContactBundle\Form\Mentor;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class MobileType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phoneNumber','text',array(
                'label' => 'Mobile Number',
                'required' => false,
                'constraints' => array(
                           new \Symfony\Component\Validator\Constraints\Type(array('type' => 'numeric'))
                    )
            ))            
            ->add('phoneType', 'entity', array(
                    'class' => 'ESERVMAINApplicationCodeBundle:ApplicationCode',
                    'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                    ->leftJoin('u.applicationCodeType', 'act')
                                    ->where('u.code = :uc ')
                                    ->setParameter('uc', \ESERV\MAIN\Services\AppConstants::AC_MOBILE_NUMBER)
                                    ->andWhere('act.code = :atc')
                                    ->setParameter('atc',  \ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE)
                                    ;
                    },
                ))
            ->add('primaryRecord','text',array(
                'data' => 'N'
            ))                  
        ;   
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_mentor_mobile';
    }
}
