<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoCompleteType
 *
 * @author Samir
 */

namespace ESERV\MAIN\Services\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AutoCompleteType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array()
        ));
    }

    public function getParent()
    {
        return 'hidden';
    }

    public function getName()
    {
        return 'autocomplete';
    }
}