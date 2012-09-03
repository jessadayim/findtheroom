<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use FTR\WebBundle\Entity\User_owner;
use FTR\WebBundle\Entity\Building_site;
use FTR\WebBundle\Entity\Building_type;
use FTR\WebBundle\Entity\Facility2site;
use FTR\WebBundle\Entity\Facilitylist;
use FTR\WebBundle\Entity\Image;
use FTR\WebBundle\Entity\Nearly_location;
use FTR\WebBundle\Entity\Nearly_type;
use FTR\WebBundle\Entity\Nearly2site;
use FTR\WebBundle\Entity\Pay_type;
use FTR\WebBundle\Entity\Roomtype2site;
use FTR\WebBundle\Entity\Roomtype;
use FTR\WebBundle\Entity\Zone;
use FTR\WebBundle\Controller\SearchController;

class UserbuildingController extends Controller
{
    
    public function indexAction($errormsg=NULL)
    {
        $session = $this->get('session');
		$username = $session->get('user');
		if(empty($username))
		{
			return $this->redirect($this->generateUrl('FTRWebBundle_regis'));
		}
		
		if(empty($errormsg))
		{//Default error messeges
			$errormsg = array('email'=>NULL,'password'=>NULL,'tel'=>NULL,'confirmpass'=>'ต้องใส่ยืนยันรหัสก่อนบันทึก');
		}
		$em = $this->getDoctrine()->getEntityManager();
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				$sql1 ="SELECT * FROM user_owner WHERE username = '".$username."'";
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
		
		$session = $this->get('session');
		$user = $session->get('user');
		
		$today = date("Y-m-d H:i:s");
		
		$em = $this->getDoctrine()->getEntityManager();
        $conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				$userdata = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username'=>$user));
				// เดี๋ยวเขียนเช็คถ้าไม่มีให้ redirect
				if(empty($userdata))
				{
					return $this->redirect($this->generateUrl('FTRWebBundle_publish'));
				}
				if(empty($id))
				{
					$building = new Building_site();
					$building->setBuildingName('');
					$building->setBuildingAddress('');
					$building->setStartPrice(0);
					$building->setEndPrice(0);
					$building->setPhoneNumber('');
					$building->setBuildingTypeId(0);
					$building->setPayTypeId(0);
					$building->setUserOwnerId($userdata->getId());
					$building->setContactName('');
					$building->setContactEmail('');
					$building->setMonthStay('');
					$building->setWaterUnit(0);
					$building->setElectricityUnit(0);
					$em->persist($building);
    				$em->flush();
					$building_id = $building->getId();
				}else{
					$building_id = $id;
					$building_data = $this->getBuildingData($building_id);
					//echo "<pre>";var_dump($building_data);echo "</pre>";exit();
					if($building_data['ibuildingtypeid']!=0)
					{
						$buildtype_data = $em->getRepository('FTRWebBundle:Building_type')->findOneBy(array('id'=>$building_data['ibuildingtypeid']));
					}
					if($building_data['izoneid']!=0)
					{
						$zone_data = $em->getRepository('FTRWebBundle:Zone')->findOneBy(array('id'=>$building_data['izoneid']));
					}
					if($building_data['ipaytypeid']!=0)
					{
						$paytype_data = $em->getRepository('FTRWebBundle:Pay_type')->findOneBy(array('id'=>$building_data['ipaytypeid']));
					}
				}
				$linkimagehead = NULL;
				$linkimagemap = NULL;
				$fac_inroomlist 	= $this->getFacility('inroom');
				$fac_outroomlist 	= $this->getFacility('outroom');
				$arrroom 			= $this->getImageDatas($building_id,NULL,'room');
				$arrgallery 		= $this->getImageDatas($building_id,NULL,'gallery');
				$imagehead 			= $this->getImageDatas($building_id,NULL,'head');
				$imagemap			= $this->getImageDatas($building_id,NULL,'map');
				if(!empty($imagehead)){
					$linkimagehead = "image/$id/".$imagehead[0];
				}
				if(!empty($imagemap)){
					$linkimagehead = "image/$id/".$imagemap[0];
				}
				
				$payType        = $this->getPayType();
		        $bkkZone        = $this->getBkkZone();
		        $buildingType   = $this->getBuildingType();
		        $province       = $this->getProvince();
				$nearBTS			= $this->getNeary(2);
				$nearMRT			= $this->getNeary(3);
				$nearUniversity		= $this->getNeary(4);
				$nearBy				= $this->getNeary(5);
				$nearInCountry		= $this->getNeary(6);
				/*echo "<pre>";
				var_dump($province);
				echo "</pre>";
				exit();*/
				$this->getPathUpload($building_id);
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
				
		return $this->render('FTRWebBundle:Userbuilding:add.html.twig', array(
			'payType' 			    => $payType,
            'zonelist' 		        => $bkkZone,
            'buildingType' 		    => $buildingType,
            'province' 		        => $province,
			'nearBTS' 				=> $nearBTS,
			'nearMRT' 				=> $nearMRT,
			'nearUniversity' 		=> $nearUniversity,
			'nearBy' 				=> $nearBy,
			'nearInCountry' 		=> $nearInCountry,
            'username'				=> $user,
			'build_id'				=> $building_id,
			'fac_inroom'			=> $fac_inroomlist,
			'fac_outroom'			=> $fac_outroomlist,
			'rooms'					=> $arrroom,
			'roomlines'				=> $countroom,
			'galleries'				=> $arrgallery,
			'gellerylines'			=> $countgallery,
			'imagehead'				=> $linkimagehead,
			'imagemap'				=> $imagemap,
		));
	}

	public function getBuildingData($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$build_data = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id'=>$id));
		$arrdata = array(
					'sbuildingname'		=> $build_data->getBuildingName(),
					'tbuildingaddress'	=> $build_data->getBuildingAddress(),
					'istartprice'		=> $build_data->getStartPrice(),
					'iendprice'			=> $build_data->getEndPrice(),
					'sphonenumber'		=> $build_data->getPhoneNumber(),
					'slatitude'			=> $build_data->getLatitude(),
					'slongitude'		=> $build_data->getLongitude(),
					'brecommend'		=> $build_data->getRecommend(),
					'ibuildingtypeid'	=> $build_data->getBuildingTypeId(),
					'izoneid'			=> $build_data->getZoneId(),
					'ipaytypeid'		=> $build_data->getPayTypeId(),
					'iuserownerid'		=> $build_data->getUserOwnerId(),
					'tdetail'			=> $build_data->getDetail(),
					'scontactname'		=> $build_data->getContactName(),
					'scontactemail'		=> $build_data->getContactEmail(),
					'swebsite'			=> $build_data->getWebsite(),
					'smonthstay'		=> $build_data->getMonthStay(),
					'fwaterunit'		=> $build_data->getWaterUnit(),
					'felectrictunit'	=> $build_data->getElectricityUnit(),
					'iinternetprice'	=> $build_data->getInternetPrice(),
					'igooglemapurl'		=> $build_data->getGoogleMapUrl(),
					'binternetready'	=> $build_data->getInternetReady(),
			);
		return $arrdata;
	}

	public function getImageDatas($buildid=null,$roomtype2siteid=null,$type)
	{
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				$sql ="select * from image 
								where building_site_id = '$buildid' 
									and photo_type = '$type' 
									or roomtype2site_id = '$roomtype2siteid' 
									and deleted = 0";
				$imagedata = $conn->fetchAll($sql);
				/*echo "<pre>";
				var_dump($imagedata);
				echo "</pre>";
				exit();*/
			} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
				
		return $imagedata;
	}
	
	public function getFacility($type)
	{
		$fac_inroomlist = NULL;
		$fac_outroomlist = NULL;
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
					/*echo "<pre>";
					var_dump($fac_listreturn);
					echo "</pre>";exit();*/
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
			$post_array = $_POST;
			echo "<pre>";var_dump($post_array);echo "</pre>";exit();
			/*
			 * image section
			 */
			$headimage_name = $post_array['hdnfilename'];
			$mapimage_name = $post_array['hdnfilemap'];
			$countimage_room = $post_array['hdnMaxLine'];
			$countimage_gallery = $post_array['hdnMaxLineGal'];
			
			for ($i=0; $i < $countimage_room ; $i++) { 
				$arrayimage_room[] = array(
					'imageid'		=> $post_array['imageid'.$i],
					'imagename'		=> $post_array['hdnfilename'.$i],
					'typename'		=> $post_array['typeap_name'.$i],
					'size'			=> $post_array['typeap_size'.$i],
					'price'			=> $post_array['typeap_price'.$i],
				);
			}
			
			for ($i=0; $i < $countimage_gallery ; $i++) { 
				$arrayimage_room[] = array(
					'imageid'		=> $post_array['imageid'.$i],
					'imagename'		=> $post_array['hdnfilename'.$i],
					'typename'		=> $post_array['typeap_name'.$i],
					'size'			=> $post_array['typeap_size'.$i],
					'price'			=> $post_array['typeap_price'.$i],
				);
			}
			
			echo "<pre>";var_dump($arrayimage_room);echo "</pre>";exit();
			$apartment_name = $post_array['nameap'];
			$apartment_addr = $post_array['placeap'];
			/*$apartment_name = $post_array['nameap'];
			$apartment_name = $post_array['nameap'];
			$apartment_name = $post_array['nameap'];*/
			
			
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

	public function getPathUpload($id)
	{
		$path = "./images/building/".$id;
		if(!file_exists("./images/building")){
			mkdir("./images/building", 0777);
		}
		if(!file_exists($path)){
			mkdir($path, 0777);
		}
		return $path;
	}
	
	public function autoSaveFormAction($id,$type)
	{
		if($_POST)
		{
			$sownername 	= $_POST['hdnownername'];
			$ibuildid		= $id;
			$arrimagedata		= NULL;
			if($type=='image')
			{
				$sheadimagename 	= $_POST['hdnfilename'];
				$smapimagename 		= $_POST['hdnfilemap'];
				$icountlineroom 	= $_POST['hdnMaxLine'];
				$icountlinegallery 	= $_POST['hdnMaxLineGal'];
				
				$arrimagedata[]		= array(
					'photo_name'	=> $sheadimagename,
					'photo_type'	=> 'head',
				);
				$arrimagedata[]		= array(
					'photo_name'	=> $smapimagename,
					'photo_type'	=> 'map',
				);
				
				for ($i=0; $i < $icountlineroom ; $i++) { 
				$arrimagedata[] = array(
						'imageid'		=> $post_array['imageid'.$i],
						'photo_name'	=> $post_array['hdnfilename'.$i],
						'typename'		=> $post_array['typeap_name'.$i],
						'room_size'		=> $post_array['typeap_size'.$i],
						'room_price'	=> $post_array['typeap_price'.$i],
						'photo_type'	=> 'room',
					);
				}
				
				for ($i=0; $i < $icountlinegallery ; $i++) { 
					$arrimagedata[] = array(
						'imageid'		=> $post_array['imageid'.$i],
						'photo_name'	=> $post_array['hdnfilename'.$i],
						'description'	=> $post_array['galtitle'.$i],
						'photo_type'	=> 'gallery',
					);
				}
				
				$alert = $this->saveImageData($id,$arrimagedata);
				echo $alert;
			}
		}
		exit();
	}

	public function saveImageData($id,$imagedata)
	{
		$em = $this->getDoctrine()->getEntityManager();
		//return $imagedata[0]['photo_name'];
		foreach ($imagedata as $key => $value) {
			$roomtype2siteid = NULL;$data = NULL; // set NULL value for new loop
			if(!empty($id)||!empty($value['photo_name'])){
				$imagevalue = $em->getRepository('FTRWebBundle:Image')->findOneBy(array('building_site_id'=>$id,'photo_type'=>$value['photo_type']));
				if(empty($imagevalue))
				{
					$image = new Image();
					$image->setBuildingSiteId($id);
					$image->setPhotoName($value['photo_name']);
					$image->setPhotoType($value['photo_type']);
					if(!empty($value['description']))
					{
						$image->setDescription($value['description']);
					}
					else {
						$image->setDescription('');
					}
					
					if($value['photo_type']=='room')
					{
						$data = array(
							'typename'		=> $value['typename'],
							'room_size'		=> $value['room_size'],
							'room_price'	=> $value['room_price'],
						);
						$roomtype2siteid = $this->saveRoomtypeData($id, $data, NULL);
						$image->setRoomtype2siteId($roomtype2siteid);
					}
					else {
						$image->setRoomtype2siteId(NULL);
					}
					
					$em->persist($image);
					$em->flush();
					return 'complete';
				}
				/*else {
					
				}*/
			}
		}
		return 'complete';
		exit();
	}
	
	public function saveRoomtypeData($buildingid,$data,$roomtype2siteid)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$roomtype2sitedata = $em->getRepository('FTRWebBundle:Roomtype2site')->findOneBy(array('building_site_id'=>$buildingid,'id'=>$roomtype2siteid));
		if(empty($roomtype2sitedata))
		{
			$roomtype = new Roomtype();
			$roomtype->setRoomTypename($data['typename']);
			$em->persist($roomtype);
			$em->flush();
			
			$roomtypeid = $roomtype->getId();
			
			$roomtype2site = new Roomtype2site();
			$roomtype2site->setRoomtypeId($roomtypeid);
			$roomtype2site->setBuildingSiteId($buildingid);
			$roomtype2site->setRoomsize($data['room_size']);
			$roomtype2site->setRoomprice($data['room_price']);
			$em->persist($roomtype2site);
			$em->flush();
			
			$roomtype2siteid = $roomtype2site->getId();
		}
		else {
			$roomtypeid = $roomtype2sitedata->getRoomtypeId();
			$roomtypedata = $em->getRepository('FTRWebBundle:Roomtype')->findOneBy(array('id'=>$roomtypeid));
			$roomtypedata->setRoomTypename($data['typename']);
			
			$roomtype2sitedata->setRoomsize($data['room_size']);
			$roomtype2sitedata->setRoomprice($data['room_price']);
			
			$em->flush();
		}
		return $roomtype2siteid;
	}
	
	function getBkkZone()
    {
        $result_data = array();
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $whereQuery = null;
            $sql = "
				select * from zone
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $all[] = array('id'=>0,'zonename'=>'ทุกเขต');

        $result = array_merge($all,$result_data);
        return $result;
    }

    function getProvince()
    {
        $result_data = array();
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $sql = "
				select PROVINCE_NAME as PROVINCE_VALUE , PROVINCE_NAME
				from province
				where PROVINCE_ID != 1
				order by PROVINCE_NAME asc
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $all[] = array('PROVINCE_VALUE'=>'0','PROVINCE_NAME'=>'ทุกจังหวัด');

        $result = array_merge($all,$result_data);
        return $result;
    }

    function getBuildingType($type=null)
    {
        $result_data = array();
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $whereQuery = null;
            if($type != null){
                $whereQuery = " where id in (select distinct(building_type_id) from building_site where pay_type_id = $type)";
            }
            $sql = "
				select * from building_type $whereQuery
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $all[] = array('id'=>0,'type_name'=>'ทุกประเภท');

        $result = array_merge($all,$result_data);
        return $result;
    }
	
	function getPayType()
    {
		$result_data = array();
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
		try{
			$sql = "
				select  `id`,`typename` from pay_type order by id desc
			";
			$result_data = $conn->fetchAll($sql);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
				
		$result = $result_data;
		return $result;
	}
	
	function getNeary($type=2)
    {
		$result_data = array();
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
		try{
			$sql = "
				select * from nearly_location where nearly_type_id = $type
			";
			$result_data = $conn->fetchAll($sql);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
		switch ($type) {
			case 2:
			case 3:
				$all[] = array('id'=>0,'name'=>'ทุกสถานี');
				break;
			case 4:
			case 5:
            case 6:
				$all[] = array('id'=>0,'name'=>' - กรุณาระบุ - ');
				break;
		}
		
		$result = array_merge($all,$result_data);
		return $result;
	}
}
