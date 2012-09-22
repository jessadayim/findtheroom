<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Building_siteType extends AbstractType
{
    private function getMaxLength($val){
        return array('max_length' => $val);
    }
    public function buildForm(FormBuilder $builder, array $options)
    {
        $buildingType[''] = '';
        foreach ($options['data']->buildingtype as $key => $value){
            $buildingType[$value['id']] = $value['type_name'];
        }
        
//        $zone[''] = '';
        foreach ($options['data']->zone as $key => $value){
            $zone[$value['id']] = $value['zonename'];
        }

        $payType[''] = '';
        foreach ($options['data']->paytype as $key => $value){
            $payType[$value['id']] = $value['typename'];
        }

        $userOwner[''] = '';
        foreach ($options['data']->userowner as $key => $value){
            $userOwner[$value['id']] = $value['username'];
        }

//        $addressProvince[''] = '';
        foreach ($options['data']->proveince as $key => $value){
            $addressProvince[$value['PROVINCE_ID']] = $value['PROVINCE_NAME'];
        }

        // echo '<pre>';
        // var_dump(array('1' => 'test', '2' => ''));
        // echo '</pre>';
        $builder            
            ->add('building_name', 'text', array('label' => 'Name:', 'max_length' => 100))
            ->add('building_address', 'textarea', array('label' => 'Address:', 'max_length' => 500))
//            ->add('start_price', 'text', array('label' => 'Start Price:', 'required'  => false, 'read_only' => true))
//            ->add('end_price', 'text', array('label' => 'End Price:', 'required'  => false, 'read_only' => true))
            ->add('phone_number', 'text', array('label' => 'Phone Number:', 'max_length' => 25))
            //->add('publish', 'checkbox',array('label' => 'Member use(bool)'))
            // ->add('datetimestamp', 'date')
            // ->add('lastupdate')
            // ->add('userupdate')
            ->add('latitude', 'text', array('label' => 'Latitude:', 'max_length' => 25))
            ->add('longitude', 'text', array('label' => 'Longtitude:', 'max_length' => 25))
            ->add('recommend', 'checkbox', array('label' => 'Recommend:', 'required'  => false))
            ->add('building_type_id', 'choice', array(
                'choices'   => $buildingType,
                'label'     => 'Type:'
            ))
            ->add('zone_id', 'choice', array(
                'choices'   => $zone,
                'label'     => 'Zone:',
                'required'  => false
            ))
            ->add('pay_type_id', 'choice', array(
                'choices'   => $payType,
                'label'     => 'Pay Type:'
            ))
            ->add('user_owner_id', 'choice', array(
                'choices'   => $userOwner,
                'label'     => 'Owner:'
            ))
            ->add('addr_province', 'choice', array(
                'choices'   => $addressProvince,
                'label'     => 'จังหวัด:',
                'required'  => false
            ))
            ->add('detail', 'textarea', array('label' => 'Detail:', 'max_length' => 500))
            ->add('contact_name', 'text', array('label' => 'Contact Name:', 'max_length' => 100))
            ->add('contact_email', 'text', array('label' => 'Contact Email:', 'max_length' => 100))
            ->add('website', 'text', array('label' => 'Website:', 'required' => false, 'max_length' => 500))
            ->add('month_stay', 'text', array('label' => 'Month Stay:', 'max_length' => 25))
            ->add('water_unit', 'text', array('label' => 'Water Unit:', 'max_length' => 25))
            ->add('electricity_unit', 'text', array('label' => 'Electricity Unit:', 'max_length' => 15))
            ->add('internet_price', 'text', array('label' => 'Internet Price:', 'max_length' => 15))
            ->add('nearly_place', 'text', array('label' => 'Nearly Place:', 'required'  => false, 'max_length' => 15))

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
