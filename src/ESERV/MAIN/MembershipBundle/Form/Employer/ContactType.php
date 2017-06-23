<?php

namespace ESERV\MAIN\MembershipBundle\Form\Employer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

class ContactType extends AbstractType
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
                ->add('displayName')
                ->add('statusDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'data' => new \DateTime('2014-07-22')))
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('createdBy')
//            ->add('updatedBy')
                ->add('contactStatus', 'entity', array(
                    'class' => 'ESERVMAINContactBundle:ContactStatus',
                    'data' => $this->getContactStatus()))
                ->add('contactSubType', new ContactSubtypeType($this->em))
                ->add('save', 'submit')
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
        return 'eserv_main_contactbundle_contact';
    }

    public function getContactStatus()
    {
        $contact_type = $this->em->getRepository('ESERVMAINContactBundle:ContactType')->findOneBy(array('code' => 'O'));
        $contact_status = $this->em->getRepository('ESERVMAINContactBundle:ContactStatus')->findOneBy(array('code' => 'LV',
            'contactType' => $contact_type));
        return $contact_status;
    }

}
