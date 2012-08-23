<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class UserbuildingController extends Controller
{
    
    public function indexAction($errormsg=NULL)
    {
        $session = $this->get('session');
		$session->get('user');
		
		if(empty($errormsg))
		{//Default error messeges
			$errormsg = array('email'=>NULL,'password'=>NULL,'tel'=>NULL,'confirmpass'=>'ต้องใส่ยืนยันรหัสก่อนบันทึก');
		}
		$em = $this->getDoctrine()->getEntityManager();
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				$sql1 ="SELECT * FROM user_owner WHERE username = '".$session->get('user')."'";
				$objSQL1 = $conn->fetchAll($sql1);
				$objSQL1[0]['username'];
				
				$sql2 = "SELECT * FROM building_site WHERE user_owner_id = '".$objSQL1[0]['id']."'";
				$objSQL2 = $conn->fetchAll($sql2);
				$arrdata = NULL;
				foreach ($objSQL2 as $key => $value) {
					if($value['publish']==1)
					{
						$publish = "แสดงแล้ว";
					}
					else {
						$publish = "รอการยืนยัน";
					}
					$arrdata[] = array(
						'id'				=> $value['id'],
						'building_name'		=> $value['building_name'],
						'publish'			=> $publish,
					);
				}
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
        return $this->render('FTRWebBundle:Userbuilding:listap.html.twig', array(
        	'firstname'		=> $objSQL1[0]['firstname'],
        	'lastname'		=> $objSQL1[0]['lastname'],
        	'username'		=> $objSQL1[0]['username'],
        	'email'			=> $objSQL1[0]['email'],
        	'password'		=> $objSQL1[0]['password'],
        	'phone_number'	=> $objSQL1[0]['phone_number'],
        	'errormsg'		=> $errormsg,
        	'build_data'	=> $arrdata,
		));
    }
	
	public function addDataAction($id=null)
	{
		$fac_inroomlist = NULL;
		$fac_outroomlist = NULL;
        $conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				
				/**
				 * query for facility list inroom type
				 */
				$sql ="select * from facilitylist where facility_type = 'inroom' and display = 1";
				$faclist_inroom = $conn->fetchAll($sql);
				$countall_inroom = count($faclist_inroom);
				foreach ($faclist_inroom as $key => $value) {
					$count = $key+1;
					$list[] = array(
						'id'				=> $value['id'],
						'facility_name'		=> $value['facility_name'],
						'facility_type'		=> $value['facility_type'],
					);
					if($count%4==0){
						$fac_inroomlist[] = array('loop'=>$list);
						$list = NULL;
					}elseif($count==$countall_inroom){
						$fac_inroomlist[] = array('loop'=>$list);
						$list = NULL;
					}
				}
				
				/**
				 * query for facility list outroom type
				 */
				$sql ="select * from facilitylist where facility_type = 'outroom' and display = 1";
				$faclist_outroom = $conn->fetchAll($sql);
				$countall_outroom = count($faclist_outroom);
				foreach ($faclist_outroom as $key => $value) {
					$count = $key+1;
					$list[] = array(
						'id'				=> $value['id'],
						'facility_name'		=> $value['facility_name'],
						'facility_type'		=> $value['facility_type'],
					);
					if($count%4==0){
						$num = 4;
						if($count==$countall_outroom)
						{
							$fac_outroomlist[] = array('loop'=>$list,'stat'=>'end','count'=>$num);
						}else{
							$fac_outroomlist[] = array('loop'=>$list,'stat'=>'not','count'=>$num);
						}
						$list = NULL;
					}elseif($count==$countall_outroom){
						$countlist = count($list);
						$num = 4-$countlist;
						$fac_outroomlist[] = array('loop'=>$list,'stat'=>'end','count'=>$num);
						$list = NULL;
					}
				}
				/*echo "<pre>";
				var_dump($fac_outroomlist);
				echo "</pre>";
				exit();*/
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
				
		return $this->render('FTRWebBundle:Userbuilding:add.html.twig', array(
			'build_id'		=> $id,
			'fac_inroom'	=> $fac_inroomlist,
			'fac_outroom'	=> $fac_outroomlist,
		));
	}
	
	public function saveDataAction($id=null)
	{
		if($_POST)
		{
			var_dump($_POST);
		}
		exit();
	}
	
	public function sendemailAction()
	{
		$name = "extest";
		$message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('jessaday@sourcecode.co.th')
        ->setTo('exodist@gmail.com')
        ->setBody($this->renderView('FTRWebBundle:Userbuilding:email.html.twig', array('name' => $name)),'text/html');
    	
    	$this->get('mailer')->send($message);

    	return $this->render('FTRWebBundle:Userbuilding:email.html.twig', array('name' => $name));
	}
	
	public function updateUserProfileAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		if($_POST)
		{
			$firstname	= $_POST['fname'];
			$lastname	= $_POST['lname'];
			$username	= $_POST['username'];
			$email		= $_POST['email'];
			$password	= $_POST['password'];
			$confirmpass= $_POST['cpassword'];
			$tel_number = $_POST['tel'];
		}
		$errmsg = NULL;$errmsg['tel'] = NULL;$errmsg['password'] = NULL;$errmsg['email'] = NULL;$errmsg['confirmpass'] = NULL;
		if(!empty($confirmpass)){
			if(strlen($password)<8||strlen($confirmpass)<8||strlen($password)>12||strlen($confirmpass)>12)
			{
				$errpass = 'รหัสผ่านต้องมี 8 อักษร และไม่เกิน 12 อักษร';
			}
			if(!preg_match("#[a-z]+#", $password)||!preg_match("#[a-z]+#", $confirmpass))
			{
				$errpass = 'รหัสผ่านต้องมีอักษรอย่างน้อย 1 ตัว';
			}
			if($password!=$confirmpass)
			{
				$errpass = 'รหัสผ่านยืนยันไม่ตรงกัน';
			}
			if(!empty($errpass))
			{
				$errmsg['password'] = 'ผิดพลาด!:'.$errpass;
			}
			
			$toemail = trim($email);
			$fixmail = str_replace(' ', '', $toemail);
			if(!filter_var($fixmail,FILTER_VALIDATE_EMAIL))
			{
				$errmsg['email'] = 'ผิดพลาด!:email ไม่ถูกต้อง';
			}
			
			if(strlen($tel_number)<9)
			{
				$errmsg['tel'] = 'ผิดพลาด!:หมายเลขโทรศัพท์ไม่ถูกต้อง';
			}
			
			if(!empty($errmsg['password'])||!empty($errmsg['email'])||!empty($errmsg['tel']))
			{
				return $this->indexAction($errmsg);
			}
			else
			{
				$session = $this->get('session');
				$user = $session->get('user');
				$userowner = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username'=>$user));
				$userowner->setUsername($username);
				$userowner->setPassword($password);
				$userowner->setFirstname($firstname);
				$userowner->setLastname($lastname);
				$userowner->setEmail($email);
				$userowner->setPhoneNumber($tel_number);
	    		$em->flush();
				
				$session->set('user', $username);
				return $this->redirect($this->generateUrl('userbuilding'));
			}
		}
		else
		{
			$errmsg['confirmpass'] = 'ไม่ได้กรอกยืนยันรหัสผ่าน';
			return $this->indexAction($errmsg);
		}
		
	}
}
