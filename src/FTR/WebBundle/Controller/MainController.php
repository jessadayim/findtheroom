<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\WebBundle\Entity\Building_site;
use Acme\WebBundle\Repository\Building_siteRepository;

class MainController extends Controller
{
    
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$building = $em->getRepository('FTRWebBundle:Building_site')->findall();
		
		var_dump($building);
        return $this->render('FTRWebBundle:Main:index.html.twig', array());
    }
}
