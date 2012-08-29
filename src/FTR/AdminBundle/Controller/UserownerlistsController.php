<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserownerlistsController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('FTRAdminBundle:Ftr_panel:userownerlists.html.twig', array('session' => 1));
    }
	
}
