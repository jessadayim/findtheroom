<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RegisterController extends Controller
{
    
    public function RegisterAction()
    {
        return $this->render('FTRWebBundle:Register:register.html.twig', array('erusername'=>NULL,'eremail'=>NULL,'firstname'=>NULL,'lastname'=>NULL
																									,'username'=>NULL,'email'=>NULL,'tel'=>NULL));
    }
	public function regSuccessAction()
    {
        return $this->render('FTRWebBundle:Register:confirm.html.twig');
    }
    public function termsAction()
    {
        return $this->render('FTRWebBundle:Register:terms.html.twig');
    }
    public function sendemailAction()
    {
        $conn= $this->get('database_connection');
        $session = $this->get('session');
        $id = $session->get('id');
        if(!empty($id)){
            $sqlOwner = "SELECT email,confirm_token,firstname,lastname
                                     FROM user_owner
						             WHERE id = '$id'";
            $objOwner = $conn -> fetchAll($sqlOwner);
            $token = $objOwner[0]['confirm_token'];
            $email = $objOwner[0]['email'];

            $host = "http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
            $url = $this->get('router')->generate('FTRWebBundle_homepage', array());
            $url .= "?token=". $token;

            $link = "ท่านได้ทำการลงทะเบียนกับ FindTheRoom.com เรียบร้อยแล้ว
    กรุณาคลิกลิงค์  "
                .$host.$url."
    เพื่อทำการยืนยันการลงทะเบียน
เมื่อท่านทำการยืนยันการลงทะเบียนเสร็จเรียบร้อยแล้ว ท่านจะสามารถใช้บริการเหล่านี้ได้
-ลงทะเบียนหอพักฟรี
-รับบริการเสริมจาก FindTheRoom.com
ติดต่อสอบถามข้อมูลเพิ่มเติม โทร 02-692-1199";

            $message = \Swift_Message::newInstance()
                ->setSubject('ยินดีต้อนรับสมาชิกใหม่ '.$email.' สู่ FindTheRoom.com')
                ->setFrom('support@findtheroom.com')
                ->setTo($email)
                ->addPart($link)
                ->setBody($this->renderView('FTRWebBundle:Register:email.html.twig', array(
                'host' => $host
            ,'url' => $url
            ,'firstName'=>$objOwner[0]['firstname']
            ,'lastName'=>$objOwner[0]['lastname'])),'text/html');

//            $this->get('mailer')->send($message);
            if($this->get('mailer')->send($message)){
                echo 'success';
                exit();
            }else{
                echo 'fail';
                exit();
            }
//            return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
        }
    }
	public function RegisConfirmAction()
    {
		if($_POST)
		{
						
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$username = $_POST['regusername'];
			$email = $_POST['email'];
			$password = md5($_POST['regpassword']);
			$tel = $_POST['tele'];
			
			$em = $this->getDoctrine()->getEntityManager();
		
			$conn= $this->get('database_connection');
			
			if(!$conn){ die("MySQL Connection error");}
				try{
					$sql1 ="SELECT * FROM user_owner WHERE username = '$username' or email = '$email'";
					$objSQL1 = $conn -> fetchAll($sql1);
					if(count($objSQL1)>0){
						if($username == $objSQL1[0]['username'] && $email == $objSQL1[0]['email']){
							return $this->render('FTRWebBundle:Register:register.html.twig', array('erusername'=>"ชื่อนี้มีการใช้งานแล้ว",'eremail'=>"อีเมลนี้ได้ลงทะเบียนเป็นสมาชิกไว้แล้วค่ะ"
																									,'firstname'=>$firstname,'lastname'=>$lastname
																									,'username'=>$username,'email'=>$email,'tel'=>$tel));
						}else if($username == $objSQL1[0]['username']){
							return $this->render('FTRWebBundle:Register:register.html.twig', array('erusername'=>"ชื่อนี้มีการใช้งานแล้ว",'eremail'=>NULL,'firstname'=>$firstname,'lastname'=>$lastname
																									,'username'=>$username,'email'=>$email,'tel'=>$tel));
						}else if($email == $objSQL1[0]['email']){
							return $this->render('FTRWebBundle:Register:register.html.twig', array('erusername'=>NULL,'eremail'=>"อีเมลนี้ได้ลงทะเบียนเป็นสมาชิกไว้แล้วค่ะ",'firstname'=>$firstname,'lastname'=>$lastname
																									,'username'=>$username,'email'=>$email,'tel'=>$tel));
						}
					}else{
						try{
							$random_token = md5(uniqid(rand(),true));
							$sql1 ="INSERT INTO user_owner(username,password,firstname,lastname,email,phone_number,fax_number,deleted,user_level,confirm_token)
							        VALUES('$username','$password','$firstname','$lastname','$email','$tel','0000000000','0','2','$random_token')";
							$conn->query($sql1);

                            $sqlOwner = "SELECT email,confirm_token,firstname,lastname
                                     FROM user_owner
						             WHERE confirm_token = '$random_token'";
                            $objOwner = $conn -> fetchAll($sqlOwner);
                            $token = $objOwner[0]['confirm_token'];
                            $email = $objOwner[0]['email'];

                            $host = "http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
                            $url = $this->get('router')->generate('FTRWebBundle_homepage', array());
                            $url .= "?token=". $token;

                            $link = "ท่านได้ทำการลงทะเบียนกับ FindTheRoom.com เรียบร้อยแล้ว
    กรุณาคลิกลิงค์  "
        .$host.$url."
    เพื่อทำการยืนยันการลงทะเบียน
เมื่อท่านทำการยืนยันการลงทะเบียนเสร็จเรียบร้อยแล้ว ท่านจะสามารถใช้บริการเหล่านี้ได้
-ลงทะเบียนหอพักฟรี
-รับบริการเสริมจาก FindTheRoom.com
ติดต่อสอบถามข้อมูลเพิ่มเติม โทร 02-692-1199";

							$message = \Swift_Message::newInstance()
					        ->setSubject('ยินดีต้อนรับสมาชิกใหม่ '.$email.' สู่ FindTheRoom.com')
					        ->setFrom('support@findtheroom.com')
					        ->setTo($email)
                            ->addPart($link)
					        ->setBody($this->renderView('FTRWebBundle:Register:email.html.twig', array(
                                            'host' => $host
                                            ,'url' => $url
                                            ,'firstName'=>$objOwner[0]['firstname']
                                            ,'lastName'=>$objOwner[0]['lastname'])),'text/html');
					    	
					    	$this->get('mailer')->send($message);
							
							$sqllogin_ss = "SELECT id,username FROM user_owner WHERE username = '$username'";
							$userdata = $conn->fetchall($sqllogin_ss);
							$session = $this->get('session');
							$user = $userdata[0]['username'];
							$id = $userdata[0]['id'];
							$session->set('user', $user);
							$session->set('id', $id);
													
							$time = date("Y-m-d : H:i:s", time());							
							$sql2 ="UPDATE user_owner SET last_login = '$time' WHERE id= '$id'";
							$conn->query($sql2);
														
							return $this->render('FTRWebBundle:Publish:publish.html.twig', array());
						
						} catch (Exception $e) {
							echo 'Caught exception: ',  $e->getMessage(), "\n";
						}
					}
				} catch (Exception $e) {
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
		}
		
    }
}
