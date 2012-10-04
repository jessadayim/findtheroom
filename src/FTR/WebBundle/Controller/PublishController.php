<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PublishController extends Controller
{
    
    public function PublishAction()
    {
        return $this->render('FTRWebBundle:Publish:publish.html.twig', array('enable'=>false));
    }
}