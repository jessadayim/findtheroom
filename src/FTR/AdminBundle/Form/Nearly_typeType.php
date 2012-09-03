<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Nearly_typeType extends AbstractType
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
        return 'ftr_adminbundle_nearly_typetype';
    }
}
