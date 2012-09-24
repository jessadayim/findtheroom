<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Ads_ControlType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('zone')
            ->add('codes')
            ->add('publish')
            ->add('date_start')
            ->add('date_end')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_ads_controltype';
    }
}
