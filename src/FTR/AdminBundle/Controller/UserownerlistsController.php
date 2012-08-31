<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserownerlistsController extends Controller
{
	public function createAction() {
		$request = $this -> get('request');

		$username = $request -> get('OwnerUsername');
		$password = $request -> get('OwnerPassword');
		$fristName = $request -> get('OwnerFristName');
		$lastName = $request -> get('OwnerLastName');
		$phone = $request -> get('OwnerPhoneNumber');
		$fax = $request -> get('OwnerFaxNumber');
		$email = $request -> get('OwnerEmail');
// echo $username."".$password."".$fristName."".$lastName."".$phone."".$fax."".$email;
// exit();
		$em = $this -> getDoctrine() -> getEntityManager();
		$conn = $this -> get('database_connection');
		if (!$conn) {
			die("MySQL Connection error");
			exit();
		}
		if ($request -> getMethod() == 'POST') {
			if ($username != '' && $password != '' && $fristName != '' && $lastName != '' && $phone != '' && $fax != '' && $email != '') {
				try {
					$sql1 = "INSERT INTO user_owner(username,password,firstname,lastname,email,phone_number,fax_number) 
									VALUES('$username','$password','$fristName','$lastName','$email','$phone','$fax')";
					$conn -> query($sql1);
				} catch(exception $e) {
					echo 'Caught exception: ', $e -> getMessage(), "\n";
				}
			}
		}
		return $this -> redirect($this -> generateUrl('FTRAdminBundle_Userownerlists'));
	}
    
    public function indexAction()
    {
    	$em = $this -> getDoctrine() -> getEntityManager();
		$conn = $this -> get('database_connection');
		if (!$conn) {
			die("MySQL Connection error");
			exit();
		}
		try {
			$sql1 = "SELECT * FROM user_owner";
			$objSQL1 = $conn -> fetchAll($sql1);
		} catch(exception $e) {
			echo 'Caught exception: ', $e -> getMessage(), "\n";
		}
        return $this->render('FTRAdminBundle:Ftr_panel:userownerlists.html.twig', array('objSQL1' => $objSQL1));
    }
	
}
