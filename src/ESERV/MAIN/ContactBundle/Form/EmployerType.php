<?php

namespace ESERV\MAIN\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

class EmployerType extends AbstractType
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
                ->add('code', 'text')
                ->add('name', 'text')
                ->add('welshName', 'text')
                ->add('type', 'choice', array(
                    'empty_value' => ' -- Please Select -- ',
                    'choices' => $this->getAppCodes('EMTYPE')))
                ->add('address1', 'text')
                ->add('address2', 'text')
                ->add('address3', 'text')
                ->add('town', 'text')
                ->add('county', 'text')
                ->add('postcode', 'text')
                ->add('phoneType', 'choice', array(
                    'empty_value' => ' -- Please Select -- ',
                    'choices' => $this->getAppCodes('PHONE')))
                ->add('phoneNumber', 'text')
                ->add('webAddress', 'text')
                ->add('dateOpened', 'text', array())
                ->add('save', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'ESERV\MAIN\MembershipBundle\Entity\Employer'
//        ));
//    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_employer';
    }
    
    public function getAppCodes($appCodeType)
    {
        $app_code_type = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')
                ->findOneBy(array('code' => $appCodeType));
        
        $result1 = $this->em->createQueryBuilder();
        $app_code = $result1->select('p.id, p.name')
                ->from('ESERVMAINApplicationCodeBundle:ApplicationCode', 'p')
                ->where('p.applicationCodeType = :act')
                ->setParameter('act', $app_code_type)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        $appCodeArray = array(); 
        foreach ($app_code as $a){
            $appCodeArray[$a['id']] = $a['name'];
        } 
        
        return $appCodeArray;
    }
}
