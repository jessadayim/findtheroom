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
					$objSQL1 = $conn -> fetchAll($sql1);
					$rowcount = count($objSQL1);
					if($rowcount == 1){
						$session = $this->get('session');
						$user = $objSQL1[0]['username'];
						$session->set('user', $user);						
						
						if(!empty($_POST['layoutlog']))
						{
							return $this->redirect($this->generateUrl('userbuilding'));
						}
						else {
							echo "1";
							exit();
						}
					}
					else{
						echo "0";
						//return $this->render('FTRWebBundle:Security:login.html.twig',array());
						exit();
					}					
				} catch (Exception $e) {
					//echo 'Caught exception: ',  $e->getMessage(), "\n";
					return $this->render('FTRWebBundle:Security:login.html.twig',array());
				}
		}else{
			echo "2";
			exit();
		}
		
	}
	public function logPublishAction()
    {
		if(!empty($_COOKIE['username'])||!empty($_COOKIE['password']))
		{
			$cookie_user = $_COOKIE['username'];
			$cookie_pass = $_COOKIE['password'];
			$cookie_chbox = $_COOKIE['chbox'];
		}
		else
		{
			$cookie_user = '';
			$cookie_pass = '';
			$cookie_chbox = '';
		}
		return $this->render('FTRWebBundle:Security:login.html.twig',array(
			'username'=>$cookie_user,
			'password'=>$cookie_pass,
			'chbox'=>$cookie_chbox
			));
    }

	public function logoutAction()
	{
		$session = $this->get('session');
		$session->set('user', '');
		return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
	}
}

