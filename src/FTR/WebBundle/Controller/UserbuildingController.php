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
		$arrroom = NULL;$arrgallery = NULL;$countroom = 0;$countgallery = 0;
        $conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				
				$fac_inroomlist 	= $this->getFacility('inroom');
				$fac_outroomlist 	= $this->getFacility('outroom');
				$arrroom 			= $this->getImageDatas($id,NULL,'room');
				$arrgallery 		= $this->getImageDatas($id,NULL,'gallery');
				$imagehead 			= $this->getImageDatas($id,NULL,'head');
				$imagemap			= $this->getImageDatas($id,NULL,'map');
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
			'rooms'			=> $arrroom,
			'roomlines'		=> $countroom,
			'galleries'		=> $arrgallery,
			'gellerylines'	=> $countgallery,
		));
	}

	public function getImageDatas($buildid=null,$roomtype2siteid=null,$type)
	{
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				$sql ="select * from image 
								where building_site_id = '$buildid' 
									or roomtype2site_id = '$roomtype2siteid' 
									and photo_type = '$type' 
									and deleted = 0";
				$imagedata = $conn->fetchAll($sql);
					
			} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
				
		return $imagedata;
	}
	
	public function getFacility($type)
	{
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				if($type=='inroom')
				{
					/**
					 * query for facility list inroom type
					 */
					$sql ="select * from facilitylist where facility_type = '$type' and display = 1";
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
					$fac_listreturn = $fac_inroomlist;
				}
				elseif($type == 'outroom') {
					/**
					 * query for facility list outroom type
					 */
					$sql ="select * from facilitylist where facility_type = '$type' and display = 1";
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
					$fac_listreturn = $fac_outroomlist;
				}
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
				
		return $fac_listreturn;
	}
	
	public function saveDataAction($id=null)
	{
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
		$check = NULL;
		
		$session = $this->get('session');
		$user = $session->get('user');
		
		$today = date("Y-m-d H:i:s");
		if($_POST)
		{
			echo "<pre>";var_dump($_POST);echo "</pre>";exit();
			try{
				if($id){
					$sql ="select * from building_site where id = $id";
					$check = $conn->fetchAll($sql);
				}
				//เช็คข้อมูลก่อน เพื่อทราบว่าจะ Insert หรือ Update
				if(!empty($check))
				{//ส่วนนี้ พบข้อมูล ทำการอัพเดต
				
					
				}
				else {//ส่วนนี้ ไม่พบข้อมูล ทำการ insert
				
					$sqlinsert ="INSERT INTO `building_site` (
									`building_name`,`building_address`,`start_price`,`end_price`,`phone_number`,
									`datetimestamp`,`lastupdate`,`userupdate`,`latitude`,`longitude`,
									`building_type_id`,`pay_type_id`,`user_owner_id`,`detail`,`contact_name`,
									`contact_email`,`website`,`month_stay`,`water_unit`,`electricity_unit`,
									`internet_price`) 
								VALUE('ทดสอบ','7/513 หมู่7','1500','4500','0863494353',
									'$today','$today','$user','1','1',
									'1','1','1','ทดสอบดีเทลล์','เจษฎา ยิ้มวิลัย',
									'exodist@gmail.com','','6','4','8',
									'799')";
					//echo "<pre>";var_dump($sqlinsert);echo "</pre>";exit();
					$conn->query($sqlinsert);
					
				}
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
		}
		exit();
		return $this->redirect($this->generateUrl('userbuilding'));
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

	public function chooseFileAction($id)
	{
		if($_POST)var_dump($_POST);
		$dir = 'images/building/'.$id;
		$files = glob($dir.'/*');
    	foreach ($files as $file) {
    		$spl = explode('/', $file);
			$count = count($spl);
			$filename = $spl[$count-1];
        	//echo  ' '.$file . "<br>";
			$picvalue[] = array(
				'name'	=> $filename,
				'link'	=> $file,
			);
    	}
		return $this->render('FTRWebBundle:Userbuilding:choosefile.html.twig',array('picvalues'=>$picvalue));
	}

	public function uploadFileAction()
	{
		return $this->render('FTRWebBundle:Userbuilding:uploadfile.html.twig');
	}

	public function getPathUpload()
	{
		
	}
}
