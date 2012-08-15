<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RegisterController extends Controller
{
    
    public function RegisterAction()
    {
        return $this->render('FTRWebBundle:Register:register.html.twig', array());
    }
	public function RegisConfirmAction()
    {
		if($_POST)
		{
			var_dump($_POST);			
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$tel = $_POST['tel'];
			
			$em = $this->getDoctrine()->getEntityManager();
		
			$conn= $this->get('database_connection');
			if(!$conn){ die("MySQL Connection error");}
				try{
					$sql1 ="INSERT INTO user_owner(username,password,firstname,lastname,email,phone_number,fax_number,deleted) VALUES('$username','$password','$firstname','$lastname','$email','$tel','0000000000','0')";
					$conn->query($sql1);
			
				} catch (Exception $e) {
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
		}
		//return $this->render('FTRWebBundle:Register:register.html.twig', array());
		
        
    }
}