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
	public function changeAction()
    {
		return $this->render('FTRWebBundle:Resetting:changepass.html.twig',array());
    }
	public function passchgAction()
    {
    	$pass = $_POST['newpass'];
		$id = '17';
		$em = $this->getDoctrine()->getEntityManager();
		$user = $em->getRepository('FTRWebBundle:User_owner')->find($id);
		$user->setPassword($pass);
    	$em->flush();
    }
}