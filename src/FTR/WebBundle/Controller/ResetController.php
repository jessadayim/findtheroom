<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class ResetController extends Controller
{
    public function resetAction()
    {
		return $this->render('FTRWebBundle:Security:resetpass.html.twig',array());	
    }
}