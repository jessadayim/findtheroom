<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ZoneType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('zonename', 'text', array('label' => 'Zone Name:', "max_length" => 100))
            ->add('latitude', 'text', array('label' => 'Latitude:', "max_length" => 25))
            ->add('longitude', 'text', array('label' => 'Longitude:', "max_length" => 25))
//            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_zonetype';
    }
}
