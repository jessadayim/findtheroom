<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Site_detailType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('keyword')
            ->add('tag_line')
            ->add('base_url')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_site_detailtype';
    }
}
