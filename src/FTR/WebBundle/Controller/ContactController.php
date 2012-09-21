<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContactController extends Controller
{
    public function ContactAction()
    {
        return $this->render('FTRWebBundle:Contact:contact.html.twig', array());
    }
	
	public function sendContactAction(){
		
		if(!empty($_POST['mail'])||!empty($_POST['desc'])||!empty($_POST['name'])||!empty($_POST['tel'])||!empty($_POST['title'])){
				$email = $_POST['mail'];
				$desc = $_POST['desc'];
				$name = $_POST['name'];
				$tel = $_POST['tel'];
				$title = $_POST['title'];
				
				$message = \Swift_Message::newInstance()
				        ->setSubject($title)
				        ->setFrom($email)
				        ->setTo('support@findtheroom.com')
				        ->setBody("คุณ $name<br/>$desc",'text/html');
				    	
				    	$this->get('mailer')->send($message);
			}
		return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
	}
}