<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RoomtypeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('room_typename')
            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_roomtypetype';
    }
}
