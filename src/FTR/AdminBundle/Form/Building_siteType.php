<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Building_siteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('building_name', 'text')
            ->add('building_address', 'textarea')
            ->add('start_price', 'text')
            ->add('end_price', 'text')
            ->add('phone_number', 'text')
            ->add('publish', 'checkbox')
            // ->add('datetimestamp', 'date')
            // ->add('lastupdate')
            // ->add('userupdate')
            ->add('latitude', 'text')
            ->add('longitude', 'text')
            ->add('recommend')
            // ->add('building_type_id')
            // ->add('zone_id')
            // ->add('pay_type_id')
            // ->add('user_owner_id')
            ->add('detail', 'text')
            ->add('contact_name')
            ->add('contact_email')
            ->add('website')
            ->add('month_stay')
            ->add('water_unit')
            ->add('electricity_unit')
            ->add('internet_price', 'text')
            ->add('googlemap_url')
            ->add('internet_ready')
            ->add('addr_number')
            ->add('addr_prefecture')
            ->add('addr_province')
            ->add('addr_zipcode')
            // ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_building_sitetype';
    }
}
