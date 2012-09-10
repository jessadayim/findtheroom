<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class User_adminType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
    	$userlevel[''] = '';
        foreach ($options['data']->user_level as $key => $value){
            $userlevel[$value['id']] = $value['level_name'];
        }
		//var_dump($userlevel);
		
        $builder
            ->add('username', 'text',array('label' => 'Username:'))
            ->add('password', 'text',array('label' => 'Password:'))
            ->add('firstname', 'text',array('label' => 'First Name:'))
            ->add('lastname', 'text',array('label' => 'Last Name:'))
            ->add('phone_number', 'text',array('label' => 'Phone Number:'))
            ->add('userlevel','choice',array('choices'=>$userlevel,'label' => 'Level:'))
            //->add('deleted',array('label' => 'deleted:'))
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_user_admintype';
    }
}
