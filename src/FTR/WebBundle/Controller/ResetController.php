<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class ResetController extends Controller
{
    public function resetAction()
    {
		return $this->render('FTRWebBundle:Security:resetpass.html.twig',array('token'=>'1d0f686e6bdbac25af7396c843601b28'));	
    }
	public function changeAction()
    {
		return $this->render('FTRWebBundle:Resetting:changepass.html.twig',array());
    }
	public function passchgAction()
    {
    	$pass = $_POST['newpass'];
		
		$em = $this->getDoctrine()->getEntityManager();
		$user = $em->getRepository('FTRWebBundle:User_owner')->find('133');
		$user->setPassword($pass);
    	$em->flush();
		exit();
    }
}