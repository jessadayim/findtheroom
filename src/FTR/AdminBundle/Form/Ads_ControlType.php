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
            ->add('publish','checkbox', array('label' => 'Publish:'))
            ->add('date_start', 'date', array(
                'format'    => \IntlDateFormatter::SHORT,
                'input'     => 'datetime',
                'widget'    => 'choice',
                'data'      => new \DateTime("now"),
                'label'     => 'Date Start:'))
            ->add('date_end', 'date',  array(
                'format'    => \IntlDateFormatter::SHORT,
                'input'     => 'datetime',
                'widget'    => 'single_text',
                'data'      => new \DateTime("now"),
                'label'     => 'Date End:'))
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_ads_controltype';
    }
}
