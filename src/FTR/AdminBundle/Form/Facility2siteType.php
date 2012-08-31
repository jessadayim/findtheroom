<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Facility2siteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('building_site_id')
            ->add('facilitylist_id')
            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_facility2sitetype';
    }
}
