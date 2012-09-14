<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ForgetController extends Controller {
	public function forgetAction() {
		return $this -> render('FTRWebBundle:Security:forget.html.twig');
	}

	public function confirmAction() {
		return $this -> render('FTRWebBundle:Resetting:confirm.html.twig');
	}

	public function sendEmailAction() {
		$email = $_POST['email'];
		$count = 0;
		//echo $email;
		$em = $this -> getDoctrine() -> getEntityManager();
		$conn = $this -> get('database_connection');

		// $sql1 = "SELECT email,confirm_token FROM user_owner
						// WHERE email = '$email' or username = '$email'";
		// $objSQL1 = $conn -> fetchAll($sql1);
		// echo $objSQL1[0]['confirm_token'];


		if (!$conn) { die("MySQL Connection error");
		}
		try {
			$sql1 = "SELECT id,email,confirm_token,deleted,firstname,lastname FROM user_owner
						WHERE email = '$email' or username = '$email'";
			$objSQL1 = $conn -> fetchAll($sql1);
            if($objSQL1[0]['deleted'] != 1){
                $id = $objSQL1[0]['id'];

                $time = date("Y-m-d : H:i:s", time());
                $sqlLastRequest ="UPDATE user_owner SET password_requested = '$time' WHERE id= '$id'";
                $conn->query($sqlLastRequest);

                $url = $this->get('router')->generate('TRWebBundle_change', array());
                $url .= "?token=".$objSQL1[0]['confirm_token'];

//                $link = "สวัสดี !<br/>
//				กรุณาคลิกลิงค์ต่อไปนี้เพื่อตั้งรหัสผ่านของคุณใหม่<br/>
//  				<a href = $url?token=" . $objSQL1[0]['confirm_token'] . ">
//  					".$url."?token=".$objSQL1[0]['confirm_token'] . "
//  				</a><br/>
// 				ขอบคุณค่ะ<br/>
//				ทีมงาน FindTheRoom<br/><br/>
//				© 2012 FindTheRoom.com";
                if (count($objSQL1) == 1) {
                    $message = \Swift_Message::newInstance()
                        -> setSubject('คุณได้ลืมรหัสผ่าน และขอตั้งรหัสผ่านใหม่ FindTheRoom.com‏')
                        -> setFrom('support@findtheroom.com') -> setTo($objSQL1[0]['email'])
                        -> setBody($this -> renderView('FTRWebBundle:Security:emailreset.html.twig', array(
                                    'url' => $url
                                    ,'firstName'=>$objSQL1[0]['firstname']
                                    ,'lastName'=>$objSQL1[0]['lastname'])), 'text/html');

                    $this -> get('mailer') -> send($message);

                    echo "1";
                } else {
                    echo "0";
                }
            }   else{
                    echo "0";
            }

		} catch (Exception $e) {
			echo "0";
		}
		exit();
	}

}
