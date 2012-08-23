<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class ForgetController extends Controller
{
    public function forgetAction()
    {    	
	    return $this->render('FTRWebBundle:Security:forget.html.twig');	
    }
	/**
	 * function for sendemail forget password
	 * */
	public function sendEmailAction()
    {
    	$email = $_POST['email'];
		// $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
		$link = "สวัสดี !<br/>
				กรุณาคลิกลิงค์ต่อไปนี้เพื่อตั้งรหัสผ่านของคุณใหม่<br/>
  				<a href=http://localhost:11001".$this->generateUrl('TRWebBundle_change').">http://localhost:11001/findtheroom/web/app_dev.php/reset/change</a><br/>
 				ขอบคุณค่ะ<br/>
				ทีมงาน FindTheRoom<br/><br/>
				© 2012 FindTheRoom.com";
		$em = $this->getDoctrine()->getEntityManager();
		
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				$sql1 ="SELECT email FROM user_owner
						WHERE email = '$email'";
				$objSQL1 = $conn->fetchAll($sql1);
				if(count($objSQL1) == 1){
					$message = \Swift_Message::newInstance()
			        ->setSubject('คุณได้ลืมรหัสผ่าน และขอตั้งรหัสผ่านใหม่ FindTheRoom.com‏')
			        ->setFrom('suriya257_@hotmail.com')
			        ->setTo($email)
			        ->setBody($this->renderView('FTRWebBundle:Security:emailreset.html.twig', array('name' => $link)),'text/html');
			    	
			    	$this->get('mailer')->send($message);
			    	
					echo "1";
				}else{
					echo "0";
				}
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}		
		exit();
    }
}
