<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Building_siteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $buildingtype[''] = '';
        foreach ($options['data']->buildingtype as $key => $value){
            $buildingtype[$value['id']] = $value['type_name'];
        }
        
        $zone[''] = '';
        foreach ($options['data']->zone as $key => $value){
            $zone[$value['id']] = $value['zonename'];
        }
        
        $paytype[''] = '';
        foreach ($options['data']->paytype as $key => $value){
            $paytype[$value['id']] = $value['typename'];
        }
        
        $userowner[''] = '';
        foreach ($options['data']->userowner as $key => $value){
            $userowner[$value['id']] = $value['username'];
        }
        
        // echo '<pre>';
        // var_dump(array('1' => 'test', '2' => ''));
        // echo '</pre>';
        $builder            
            ->add('building_name', 'text', array('label' => 'Name:'))
            ->add('building_address', 'textarea', array('label' => 'Address:'))
            ->add('start_price', 'text', array('label' => 'Start Price:'))
            ->add('end_price', 'text', array('label' => 'End Price:'))
            ->add('phone_number', 'text', array('label' => 'Phone Number:'))
            //->add('publish', 'checkbox',array('label' => 'Member use(bool)'))
            // ->add('datetimestamp', 'date')
            // ->add('lastupdate')
            // ->add('userupdate')
            ->add('latitude', 'text', array('label' => 'Latitude:'))
            ->add('longitude', 'text', array('label' => 'Longtitude:'))
            ->add('recommend', 'checkbox', array('label' => 'Recommend:', 'required'  => false))
            ->add('building_type_id', 'choice', array(
                    'choices'   => $buildingtype,
                    'label'     => 'Type:'
            ))
            ->add('zone_id', 'choice', array(
                    'choices'   => $zone,
                    'label'     => 'Zone:'
            ))
            ->add('pay_type_id', 'choice', array(
                    'choices'   => $paytype,
                    'label'     => 'Pay Type:'
            ))
            ->add('user_owner_id', 'choice', array(
                    'choices'   => $userowner,
                    'label'     => 'Owner:'
            ))
            ->add('detail', 'textarea', array('label' => 'Detail:'))
            ->add('contact_name', 'text', array('label' => 'Contact Name:'))
            ->add('contact_email', 'text', array('label' => 'Contact Email:'))
            ->add('website', 'text', array('label' => 'Website:', 'required'  => false))
            ->add('month_stay', 'text', array('label' => 'Month Stay:'))
            ->add('water_unit', 'text', array('label' => 'Water Unit:'))
            ->add('electricity_unit', 'text', array('label' => 'Electricity Unit:'))
            ->add('internet_price', 'text', array('label' => 'Internet Price:'))
            // ->add('googlemap_url')
            // ->add('internet_ready')
            // ->add('addr_number')
            // ->add('addr_prefecture')
            // ->add('addr_province')
            // ->add('addr_zipcode')
            // ->add('deleted', 'text', array('required'  => false, 'data'=> 0))
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_building_sitetype';
    }
}
