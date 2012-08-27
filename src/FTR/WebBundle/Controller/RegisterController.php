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