<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Acme\WebBundle\Entity\User_owner;

class ResetController extends Controller
{
    public function resetAction()
    {
		return $this->render('FTRWebBundle:Security:resetpass.html.twig',array('token'=>'1d0f686e6bdbac25af7396c843601b28'));	
    }
	public function changeAction()
    {
    	$token = $_GET['token'];
		$session = $this->get('session');
		$session -> set('token',$token);
		
		return $this->render('FTRWebBundle:Resetting:changepass.html.twig',array());
    }
	public function passchgAction()
    {
    	$session = $this->get('session');
		$token = $session -> get('token');
		
    	$pass = md5($_POST['newpass']);
		
		$em = $this->getDoctrine()->getEntityManager();
		$user = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('confirm_token'=> $token));
		$user->setPassword($pass);
    	$em->flush();
		
		$session ->set('token');
		exit();
    }
}