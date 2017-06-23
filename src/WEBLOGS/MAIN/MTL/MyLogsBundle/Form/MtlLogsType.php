<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MtlLogsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('LOG_ID')
            ->add('CUSTOMER')
            ->add('DATE_REQUESTED')
            ->add('DATE_REQUIRED')
            ->add('REQUESTED_BY')
            ->add('APPROVED_BY')
            ->add('PRIORITY_LEVEL')
            ->add('CATEGORY')
            ->add('DESCRIPTION')
            ->add('MTL_PERSON_ID')
            ->add('ESTIMATE')
            ->add('DATE_COMPLETED')
            ->add('TIME_TAKEN')
            ->add('COMPLETED_BY')
            ->add('MTL_DESCRIPTION')
            ->add('MTL_CATEGORY')
            ->add('MTL_ACTION')
            ->add('CHARGABLE')
            ->add('INVOICE_NO')
            ->add('DATE_INVOICED')
            ->add('SLO_USER_ID')
            ->add('SLO_DATE_LAST_UPDATED')
            ->add('SLO_DATE_ENTERED')
            ->add('MLO_QUOTE_ID')
            ->add('CUSTOMER_LOG_ID')
            ->add('SHORT_DESCRIPTION')
            ->add('INVOICE_AMOUNT')
            ->add('RELEASE_DATE')
            ->add('SIGN_OFF_DATE')
            ->add('MTL_IMPACT')
            ->add('VERSION_NO')
            ->add('MTL_BUDGET_CODE')
            ->add('MTL_DEV_ID')
            ->add('MTL_DEV_START_DATE')
            ->add('MTL_DEV_END_DATE')
            ->add('DATE_DOWNLOADED')
            ->add('URGENT')
            ->add('DATE_UPDATED')
            ->add('LOG_DUE_DATE')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlLogs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'weblogs_main_mtl_mylogsbundle_mtllogs';
    }
}
