<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class ForgetController extends Controller
{
    public function forgetAction()
    {    	
	    return $this->render('FTRWebBundle:Security:forget.html.twig');	
    }
	public function sendEmailAction()
    {
    	// $name = 'suriya';
    	// $message = \Swift_Message::newInstance()
        // ->setSubject('Hello Email')
        // ->setFrom('send@example.com')
        // ->setTo('suriyaj@sourcecode.co.th')
        // ->setBody($this->renderView('FTRWebBundle:Security:emailreset.html.twig',array(
        		// 'name' => $name
		// )),'text/html');
// 		
	    // $this->get('mailer')->send($message);
// 		
		// return $this->render('FTRWebBundle:Security:emailreset.html.twig',array(
        		// 'name' => $name
		// ));
		$name = "extest";
		$message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('suriya257_@hotmail.com')
        ->setTo('suriyaj@sourcecode.co.th')
        ->setBody($this->renderView('FTRWebBundle:Security:emailreset.html.twig', array('name' => $name)),'text/html');
    	
    	$this->get('mailer')->send($message);
		exit();
    }
}
