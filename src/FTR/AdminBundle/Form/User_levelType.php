<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class User_levelType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('level_name')
            ->add('level_type')
            ->add('is_enabled')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_user_leveltype';
    }
}
