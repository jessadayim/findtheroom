<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class PanelController extends Controller {
	public function signinAction() {
		//$username = $_POST['username'];!empty($_POST['username']) && !empty($_POST['password'])
		$request = $this -> get('request');
		$em = $this -> getDoctrine() -> getEntityManager();
		$conn = $this -> get('database_connection');

		if (!$conn) { die("MySQL Connection error");
		}
		if ($request -> getMethod() == 'POST') {
			$username = $request -> get('username');
			$password = $request -> get('password');
			
			if ($username == '' || $password == '') {
				return $this -> render('FTRAdminBundle:Ftr_panel:signin.html.twig', array('txterror' => 'กรุณากรอกข้อมูลให้ครบ'));
			} else {
				try {
					$sql1 = "SELECT id,username FROM user_admin WHERE username = '$username' and password = '$password'";
					$objSQL1 = $conn -> fetchAll($sql1);
					if (!empty($objSQL1)) {
						$session = $this -> get('session');
						$session -> set('username', $objSQL1[0]['username']);
						// echo "true";
						// exit();
						return $this -> redirect($this -> generateUrl('FTRAdminBundle_Dashboard'));
					} else {
						return $this -> render('FTRAdminBundle:Ftr_panel:signin.html.twig', array('txterror' => 'กรุณาตรวจสอบชื่อ และรหัสผ่าน'));
					}

				} catch (Exception $e) {
					echo 'Caught exception: ', $e -> getMessage(), "\n";
				}
			}
		}
	}

	public function logoutAction() {
		// var_dump($_SESSION);
		// echo "working";
		// exit();
		$session = $this -> get('session');
		$session -> set('username', '');
		return $this -> redirect($this -> generateUrl('FTRAdminBundle_panel'));
	}

	public function indexAction() {
		$session = $this -> get('session');
		$session = $session -> get('username');
		if (!empty($session)) {
			return $this -> redirect($this -> generateUrl('FTRAdminBundle_Dashboard'));
		} else {
			return $this -> render('FTRAdminBundle:Ftr_panel:signin.html.twig', array('txterror' => ''));
		}
	}

}
