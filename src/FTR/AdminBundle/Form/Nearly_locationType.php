<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Nearly_locationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nearly_type_id')
            ->add('name')
            ->add('address')
            ->add('latitude')
            ->add('longitude')
            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_nearly_locationtype';
    }
}
