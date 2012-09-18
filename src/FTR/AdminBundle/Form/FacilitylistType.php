<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FacilitylistType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('facility_name', 'text', array('label' => 'Facility Name:', "max_length" => 100))
            ->add('facility_type', 'text', array('label' => 'Facility Type:', "max_length" => 100))
            ->add('display', 'checkbox', array('label' => 'Display:'))
//            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_facilitylisttype';
    }
}
