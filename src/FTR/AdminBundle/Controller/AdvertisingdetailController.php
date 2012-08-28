<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdvertisingdetailController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('FTRAdminBundle:Ftr_panel:advertisingdetail.html.twig', array('session' => 1));
    }
	
}
