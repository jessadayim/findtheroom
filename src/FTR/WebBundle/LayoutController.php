<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class LayoutController extends Controller
{
    
    public function LayoutAction()
    {
    	if(empty($_COOKIE['username'])){
				$username ="";
		}else{
				$username = $_COOKIE['username'];
		}if(empty($_COOKIE['password'])){
				$password = "";
		}else{
				$password = $_COOKIE['password'];
		}
		echo $password;
		exit();
    	return $this->render('FTRWebBundle:Layout:Layout.html.twig', array());
    }
}