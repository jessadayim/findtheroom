<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Ads_ControlType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $adsPosition[''] = '';
        foreach ($options['data']->adsPosition as $key => $value){
            $adsPosition[$value] = $value;
        }
        $builder
            ->add('title', 'text', array('label' => 'Title:', 'max_length' => 100))
            ->add('zone', 'choice', array(
                'choices'   => $adsPosition,
                'label'     => 'Zone:'
            ))
            ->add('codes', 'textarea', array('label' => 'Codes:', 'max_length' => 2000))
            ->add('publish','checkbox', array('label' => 'Publish:', 'required'  => false))
            ->add('date_start', 'datetime', array(
                'empty_value' => array(
                    'year' => 'Year',
                    'month' => 'Month',
                    'day' => 'Day'
                ),
                'label'     => 'Date Start:'))
            ->add('date_end', 'datetime',  array(
                'empty_value' => array(
                    'year' => 'Year',
                    'month' => 'Month',
                    'day' => 'Day'
                ),
                'label'     => 'Date End:'))
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_ads_controltype';
    }
}
