<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('building_site_id')
            ->add('roomtype2site_id')
            ->add('photo_name')
            ->add('photo_type')
            ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_imagetype';
    }
}
