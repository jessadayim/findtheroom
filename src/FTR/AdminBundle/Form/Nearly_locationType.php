<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Nearly_locationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $nearlyType[''] = '';
        foreach ($options['data']->nearlyType as $key => $value){
            $nearlyType[$value['id']] = $value['type_name'];
        }
        $builder
            ->add('nearly_type_id', 'choice', array(
                'choices'   => $nearlyType,
                'label'     => 'Type:'
            ))
            ->add('name', 'text', array('label' => 'Name:', "max_length" => 100))
            ->add('address', 'textarea', array('label' => 'Address:', "max_length" => 100, 'required'  => false))
            ->add('latitude', 'text', array('label' => 'Latitude:', 'max_length' => 25, 'required'  => false))
            ->add('longitude', 'text', array('label' => 'Longitude:', 'max_length' => 25, 'required'  => false))
//            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_nearly_locationtype';
    }
}
