<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BannerController extends Controller
{
    public function BannerAction()
    {
        return $this->render('FTRWebBundle:Banner:banner.html.twig', array());
    }
}