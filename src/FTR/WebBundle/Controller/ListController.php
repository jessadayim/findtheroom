<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ListController extends Controller
{
    
    public function indexAction()
    {

		return $this->render('FTRWebBundle:List:index.html.twig', array('name' => $name));
    }

    public function listAction()
    {

    }
}
