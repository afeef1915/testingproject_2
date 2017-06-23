<?php

namespace ESERV\MAIN\MembershipBundle\Form\Employer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

class ContactSubtypeType extends AbstractType
{
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('createdBy')
//            ->add('updatedBy')
//            ->add('contact')
            ->add('contactSubtypeList','entity', array(
                    'class' => 'ESERVMAINContactBundle:ContactSubtypeList',
                    'data' => $this->getContactSubtypeList())
                )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\ContactSubtype'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_contactsubtype';
    }
    
    public function getContactSubtypeList()
    {
        $contact_type = $this->em->getRepository('ESERVMAINContactBundle:ContactType')
                            ->findOneBy(array('code' => 'O'));
        $contact_subtype_list = $this->em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                            ->findOneBy(array('code' => 'EM', 'contactType' => $contact_type));
        return $contact_subtype_list;
    }
}
