<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RoomtypelistsController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('FTRAdminBundle:Ftr_panel:roomtypelists.html.twig', array('session' => 1));
    }
	
}
