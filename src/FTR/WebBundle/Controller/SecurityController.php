<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class SecurityController extends Controller
{
    public function loginAction()
    {
    	$username = $_POST['username'];
		$password = $_POST['password'];
		if($username !=NULL&& $password !=NULL){
			$conn= $this->get('database_connection');
			if(!$conn){ die("MySQL Connection error");}
				try{
					$sql1 ="SELECT * FROM user_owner WHERE username = '$username' and password = '$password'";
					$objSQL1 = $conn->fetchAll($sql1);
					
					$session = $this->get('session');
					$user = $objSQL1[0]['username'];
					$session->set('user', $user);
					//var_dump($objSQL1);
			
				} catch (Exception $e) {
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
				//echo "success";
				// exit();
			return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
		}else{
			return $this->render('FTRWebBundle:Security:login.html.twig',array());
		}
		
	}
	public function logPublishAction()
    {    	
		return $this->render('FTRWebBundle:Security:login.html.twig',array());
    }

	public function logoutAction()
	{
		$session = $this->get('session');
		$session->set('user', '');
		return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
	}
}

