<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserbuildingController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('FTRWebBundle:Default:index.html.twig', array('name' => $name));
    }
}
