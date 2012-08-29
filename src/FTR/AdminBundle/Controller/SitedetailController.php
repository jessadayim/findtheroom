<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SitedetailController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('FTRAdminBundle:Ftr_panel:sitedetail.html.twig', array('session' => 1));
    }
	
}
