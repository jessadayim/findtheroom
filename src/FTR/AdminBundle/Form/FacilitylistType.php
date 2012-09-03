<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FacilitylistType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('facility_name')
            ->add('facility_type')
            ->add('display')
            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_facilitylisttype';
    }
}
