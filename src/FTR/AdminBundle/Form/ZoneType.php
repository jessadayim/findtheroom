<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ZoneType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('zonename')
            ->add('latitude')
            ->add('longitude')
            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_zonetype';
    }
}
