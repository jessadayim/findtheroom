<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserbuildingController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('FTRWebBundle:Userbuilding:listap.html.twig', array());
    }
}
