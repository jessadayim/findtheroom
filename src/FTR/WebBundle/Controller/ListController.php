<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ListController extends Controller
{
    
    public function indexAction()
    {
		$name = "a";
		return $this->render('FTRWebBundle:Default:index.html.twig', array('name' => $name));
    }
}
