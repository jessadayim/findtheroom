<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ListController extends Controller
{
    
    public function indexAction()
    {
          $name = null;
		return $this->render('FTRWebBundle:List:index.html.twig', array('name' => $name));
    }

    public function listAction()
    {

    }
}
