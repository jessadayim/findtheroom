<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\Config\Config;

class ContactController extends Controller
{
    public function ContactAction()
    {
// เรียกข้อมูลเบื้องต้นของ website
        $siteConfig = new Config();
        $siteConfigDetail = $siteConfig->setSiteGlobal();

        return $this->render(
            'FTRWebBundle:Contact:contact.html.twig',
            array(
                'siteTitle'=> $siteConfigDetail["pageContactTitle"],
                'siteDesc' => $siteConfigDetail["pageContactDesc"],
                'siteKeyword' => $siteConfigDetail["siteKeyword"],
                'siteAuthor' => $siteConfigDetail["siteAuthor"],
                'siteCopyRight' => $siteConfigDetail["siteCopyright"],
                'siteRobot' => $siteConfigDetail["siteRobot"],
                'siteRevisitAfter' => $siteConfigDetail["siteRevisitAfter"],
                'siteDistribution' => $siteConfigDetail["siteDistribution"],
                'siteImage' => $siteConfigDetail["siteImage"],
                'siteUrl' => $siteConfigDetail["siteUrl"]
            )
        );
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