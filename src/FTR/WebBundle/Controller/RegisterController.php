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
	public function RegisConfirmAction()
    {
		if($_POST)
		{
						
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$username = $_POST['regusername'];
			$email = $_POST['email'];
			$password = $_POST['regpassword'];
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
							$sql1 ="INSERT INTO user_owner(username,password,firstname,lastname,email,phone_number,fax_number,deleted,confirm_token) VALUES('$username','$password','$firstname','$lastname','$email','$tel','0000000000','0','$random_token')";
							$conn->query($sql1);
                            $url = $_SERVER['SERVER_NAME'];
                            $url .= $this->get('router')->generate('FTRWebBundle_homepage', array());
                           // $url .= $this->get('router')->generate('TRWebBundle_change', array());
							
							$link = "สวัสดีค่ะ คุณ $email ยินตีต้อนรับสู่ FindTheRoom.com!
										ชื่อที่ใช้ในการ login เข้าบัญชีสมาชิกของคุณคือ $username
										<a href = $url?token=" . $random_token . ">
  					                        ".$url."?token=". $random_token . "
  				                        </a><br/>";

							$message = \Swift_Message::newInstance()
					        ->setSubject('findtheroom')
					        ->setFrom('support@findtheroom.com')
					        ->setTo($email)
					        ->setBody($this->renderView('FTRWebBundle:Security:emailreset.html.twig', array('name' => $link)),'text/html');
					    	
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
