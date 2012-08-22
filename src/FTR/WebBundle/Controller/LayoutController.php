<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class LayoutController extends Controller
{
    
    public function LayoutAction()
    {
    	return $this->render('FTRWebBundle:Layout:Layout.html.twig', array());
    }
}