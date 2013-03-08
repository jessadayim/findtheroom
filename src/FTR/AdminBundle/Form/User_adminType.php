<?php

namespace FTR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class User_adminType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        //var_dump($options['data']->user_level);
        if (empty($options['data']->user_level)) {
            $builder
                ->add('username', 'text', array('label' => 'Username:'))
                ->add('password', 'password', array('label' => 'Password:', 'required'  => true))
                ->add('firstname', 'text', array('label' => 'First Name:'))
                ->add('lastname', 'text', array('label' => 'Last Name:'))
                ->add('phone_number', 'text', array('label' => 'Phone Number:'))
                //->add('userlevel','choice',array('choices'=>$userlevel,'label' => 'Level:'))
                //->add('deleted',array('label' => 'deleted:'))
            ;
        } else {
            $userlevel[''] = '';
            foreach ($options['data']->user_level as $key => $value) {
                $userlevel[$value['id']] = $value['level_name'];
            }
            $builder
                ->add('username', 'text', array('label' => 'Username:'))
                ->add(
                    'password',
                    'password',
                    array('label' => 'Password:','required'  => $options['data']->requiredPassword)
                )
                ->add('firstname', 'text', array('label' => 'First Name:'))
                ->add('lastname', 'text', array('label' => 'Last Name:'))
                ->add('phone_number', 'text', array('label' => 'Phone Number:'))
                ->add('userlevel', 'choice', array('choices' => $userlevel, 'label' => 'Level:'))
                //->add('deleted',array('label' => 'deleted:'))
            ;
        }

    }

    public function getName()
    {
        return 'ftr_adminbundle_user_admintype';
    }
}
