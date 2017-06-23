<?php

namespace ESERV\MAIN\ContactBundle\Form\Mentor;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class AddressType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('addressLine1', 'text', array('required' => false))
            ->add('addressLine2', 'text', array('required' => false))
            ->add('addressLine3', 'text', array('required' => false))
            ->add('town', 'text', array('required' => false))
            ->add('county', 'text', array('required' => false))
            //->add('postcode', 'text', array('required' => false)) 
            ->add('postcode', 'text', array(
                    'required' => false,
                    'eserv_extra_validation' => array(
                        'lettercase' => 'upper',
                        'regexp' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP,
                            'error_msg' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP_ERROR,
                        )
                    ),                    
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Regex(array(
                            'pattern' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP,
                            'match' => true,
                            'message' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP_ERROR,
                        ))),
                ))
            ->add('addressType', 'entity', array(
                    'class' => 'ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType',
                    'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('u')                                   
                                    ->leftJoin('u.contactType', 'ct')
                                    ->where('u.code = :utc ')
                                    ->setParameter('utc',  \ESERV\MAIN\Services\AppConstants::AT_HOME)
                                    ->andWhere('ct.code = :ctc')
                                    ->setParameter('ctc',  \ESERV\MAIN\Services\AppConstants::CT_PERSON)
                                    ;
                    },
            ))
            ->add('startDate', 'date', array(
                    'widget'=>'single_text', 
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'data' => new \DateTime()
            ))
            ->add('primaryRecord', 'hidden', array('required' => false, 'data' => 'Y'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_mentor_address';
    }
}
