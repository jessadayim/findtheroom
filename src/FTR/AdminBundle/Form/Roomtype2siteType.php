<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Roomtype2siteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('roomtype_id')
            ->add('building_site_id')
            ->add('room_size')
            ->add('room_price')
            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_roomtype2sitetype';
    }
}
