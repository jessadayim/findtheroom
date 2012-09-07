<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class User_ownerType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
    	$userlevel[''] = '';
        foreach ($options['data']->userlevel as $key => $value){
            $userlevel[$value['id']] = $value['level_name'];
        }
		//var_dump($userlevel);
		//->add('user_level','choice',array('choices'=>$userlevel,'label' => 'Level:'))
        $builder
            ->add('username', 'text',array('label' => 'Username:'))
            ->add('password', 'text',array('label' => 'Password:'))
            ->add('firstname', 'text',array('label' => 'First Name:'))
            ->add('lastname', 'text',array('label' => 'Last Name:'))
            ->add('email', 'text',array('label' => 'Phone Number:'))
            ->add('phone_number', 'text',array('label' => 'Fax Number:'))
            ->add('fax_number', 'text',array('label' => 'Email:'))
            ->add('user_level','choice',array('choices'=>$userlevel,'label' => 'Level:'))
            // ->add('last_login')
            // ->add('password_requested')
            // ->add('confirm_token')
            // ->add('enabled')
            // ->add('facebook_id')
            // ->add('deleted')
        ;
    }

    public function getName()
    {
        return 'ftr_adminbundle_user_ownertype';
    }
}
