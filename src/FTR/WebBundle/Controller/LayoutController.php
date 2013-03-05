<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\Config\Config;



class LayoutController extends Controller
{
    
    public function LayoutAction()
    {
        $siteConfig = new Config();
        $siteConfigDetail = $siteConfig->setSiteGlobal();

        return $this->render('FTRWebBundle:Layout:Layout.html.twig', array(
            'siteTitle'     => $siteConfigDetail["siteTitle"]
        ));
    }
}