<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContactController extends Controller
{
    
    public function ContactAction()
    {
        return $this->render('FTRWebBundle:Contact:contact.html.twig', array());
    }
}