<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Building_typeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('type_name')
            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_building_typetype';
    }
}
