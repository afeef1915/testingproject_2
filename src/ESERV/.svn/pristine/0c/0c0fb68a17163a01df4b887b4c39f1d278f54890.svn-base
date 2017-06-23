<?php

namespace ESERV\MAIN\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

class PersonType extends AbstractType
{

    protected $entityManager;

    public function __construct(EntityManager $entity_manager)
    {
        $this->entityManager = $entity_manager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('contact', new ContactType())
                ->add('firstName')
                ->add('middleName')
                ->add('lastName')
                ->add('initials')
                ->add('dateOfBirth', 'date', array(
                    'widget'=>'single_text', 
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(                           
                           new \Symfony\Component\Validator\Constraints\Date()
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                            'yearrange' => '-120:-'.\ESERV\MAIN\Services\AppConstants::ORGANISATION_MIN_AGE,
                        )
                    ),
                    'required' => false
                ))
                ->add('jobTitle')
                ->add('gender')
                ->add('titleAppCode')
                ->add('createdAt', 'datetime', array('date_widget' => 'single_text', 'attr' => array('class' => 'display_non')))
                ->add('updatedAt', 'datetime', array('date_widget' => 'single_text', 'attr' => array('class' => 'display_non')))
                ->add('createdBy', 'hidden', array('data' => '1'))
                ->add('updatedBy', 'hidden', array('data' => '1'))
        ;

        $tables = $this->getClientTableArrayAction();

        foreach ($tables as $key => $value) {
            $builder->add($key, new $value());
        }

        $builder->add('save', 'submit', array(
                    'attr' => array('class' => 'btn btn-primary')
                ))
                ->add('reset', 'reset', array(
                    'attr' => array('class' => 'btn btn-default')
                ))
                ->setMethod('POST');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\Person'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_person';
    }

    public function getClientTableArrayAction()
    {
        $table_id_array = array();
        $table_name_array = array();

        $em = $this->entityManager;
        $client_table_map = $em->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTableMap')
                ->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        if ($client_table_map) {
            foreach ($client_table_map as $f) {
                $ct_id = $f->getClientTable()->getId();
                if ($f->getClientEntity()->getId() === 1) {
                    $client_table_field = $em->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientField')
                            ->findOneBy(array('clientTable' => $ct_id));
                    if (!is_null($client_table_field)) {
                        $table_id_array[] = $ct_id;
                    }
                }
            }
        }



        $result = $em->createQueryBuilder();
        $client_table_name_array = $result->select('p.name')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable', 'p')
                ->where('p.id IN (:id)')
                ->setParameter('id', $table_id_array)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $tmp = $client_table_name_array;

        foreach ($tmp as $t) {
            $table_name_array['eserv_client_' . strtolower($t['name'])] = '\ESERV\ClientBundle\Form\EservClient' . ucfirst($t['name']) . 'Type';
        }

        return $table_name_array;
    }

}
