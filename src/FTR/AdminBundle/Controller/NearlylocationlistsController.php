<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class NearlylocationlistsController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('FTRAdminBundle:Ftr_panel:nearlylocationlists.html.twig', array('session' => 1));
    }
	
}
