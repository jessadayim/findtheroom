<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Acme\WebBundle\Entity\User_owner;

class ResetController extends Controller
{
    public function resetAction($userId)
    {
		return $this->render('FTRWebBundle:Security:resetpass.html.twig',array('userId'=>$userId));
    }
	public function passchgAction($userId)
    {
    	$pass = md5($_POST['newpass']);
		
		$em = $this->getDoctrine()->getEntityManager();
		$user = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('id'=> $userId));
		$user->setPassword($pass);
    	$em->flush();

        return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
    }
}