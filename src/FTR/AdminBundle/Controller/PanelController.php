<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PanelController extends Controller
{
    
    public function indexAction()
    {
    	$request = $this->get('request');
		
		if($request->getMethod()=='POST'){
			$username = $request->get('username');
			$password = $request->get('password');
		}
		
        return $this->render('FTRAdminBundle:Ftr_panel:signin.html.twig', array('session' => 0));
    }
	
}
