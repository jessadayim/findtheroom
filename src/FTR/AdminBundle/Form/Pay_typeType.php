<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Pay_typeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('typename', 'text', array('label' => 'Type Name:', "max_length" => 100))
//            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_pay_typetype';
    }
}
