<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MainController extends Controller
{
    public function testAction()
	{
		echo "test";
		exit();
	}
	
    public function indexAction()
    {
        return $this->render('FTRWebBundle:Main:index.html.twig', array());
    }
}
