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

		if (!$conn) { die("MySQL Connection error");
		}
		try {
			$sql1 = "SELECT id,email,confirm_token,deleted,firstname,lastname,password_requested
                     FROM user_owner
				     WHERE email = '$email'
				        OR username = '$email'";
			$objSQL1 = $conn -> fetchAll($sql1);

            if($objSQL1[0]['deleted'] != 1){
                $id = $objSQL1[0]['id'];
                $lastForget = $objSQL1[0]['password_requested'];
                $time = date("Y-m-d H:i:s", time());
                if(!empty($lastForget)){
                    $minute = (strtotime($time) - strtotime($lastForget)) / ( 60 );
                    if( $minute < 2){
                        echo '3';
                        exit();
                    }
                }
                $sqlLastRequest ="UPDATE user_owner
                                  SET password_requested = '$time'
                                  WHERE id= '$id'";
                $conn->query($sqlLastRequest);
                $host = "http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
                $url = $this->get('router')->generate('FTRWebBundle_homepage', array());
                $url .= "?resetToken=".$objSQL1[0]['confirm_token'];
                $link = "สวัสดี !
    กรุณาคลิกลิงค์ต่อไปนี้เพื่อตั้งรหัสผ่านของคุณใหม่   "
                    .$host.$url."
    ขอบคุณค่ะ
ทีมงาน FindTheRoom
ติดต่อสอบถามข้อมูลเพิ่มเติม โทร 02-692-1199";

                if (count($objSQL1) == 1) {
                    $message = \Swift_Message::newInstance()
                        -> setSubject('คุณได้ลืมรหัสผ่าน และขอตั้งรหัสผ่านใหม่ FindTheRoom.com‏')
                        -> setFrom('support@findtheroom.com') -> setTo($objSQL1[0]['email'])
                        -> addPart($link)
                        -> setBody($this -> renderView('FTRWebBundle:Security:emailreset.html.twig', array(
                                    'host' => $host,
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
    private function dateDiff($strDateNow,$strLast){
        return (strtotime($strDateNow) - strtotime($strLast)) / ( 60 );
    }

}
