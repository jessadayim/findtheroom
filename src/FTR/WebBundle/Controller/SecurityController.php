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
						$id = $objSQL1[0]['id'];
						
						$session->set('user', $user);
						$session->set('id', $id);
						
						$time = date("Y-m-d : H:i:s", time());
						
						$sql2 ="UPDATE user_owner SET last_login = '$time' WHERE id= '$id'";
						$conn->query($sql2);
						
						echo "1";
						exit();
					}
					else{
						echo "0";
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
    	// var_dump($_COOKIE);exit();
    		if(empty($_COOKIE['username'])){
				$username ="";
			}else{
				$username = $_COOKIE['username'];
			}if(empty($_COOKIE['password'])){
				$password = "";
			}else{
				$password = $_COOKIE['password'];
			}if(empty($_COOKIE['chbox'])){
				$chbox = "";
			}else{
				$chbox = $_COOKIE['chbox'];
			}
			
			 return $this->render('FTRWebBundle:Security:login.html.twig',array('username'=>$username,'password'=>$password,'chbox'=>$chbox)); 
    }

	public function logoutAction()
	{
		$session = $this->get('session');
		$session->set('user', '');
		return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
	}
}

