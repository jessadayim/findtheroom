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
use FTR\WebBundle\Entity\Zone;
use FTR\WebBundle\Controller\SearchController;

class UserbuildingController extends Controller
{

    public function indexAction($errormsg = NULL)
    {
        $session = $this->get('session');
        $username = $session->get('user');
        if (empty($username)) {
            return $this->redirect($this->generateUrl('FTRWebBundle_regis'));
        }

        if (empty($errormsg)) { //Default error messeges
            $errormsg = array('email' => NULL, 'password' => NULL, 'tel' => NULL, 'confirmpass' => 'ต้องใส่ยืนยันรหัสก่อนบันทึก');
        }
        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql1 = "SELECT * FROM user_owner WHERE username = '" . $username . "'";
            $objSQL1 = $conn->fetchAll($sql1);
            $objSQL1[0]['username'];

            $sql2 = "SELECT * FROM building_site WHERE user_owner_id = '" . $objSQL1[0]['id'] . "'";
            $objSQL2 = $conn->fetchAll($sql2);
            $arrdata = NULL;
            foreach ($objSQL2 as $key => $value) {
                if ($value['publish'] == 1) {
                    $publish = "แสดงแล้ว";
                } elseif ($value['publish'] == 0) {
                    $publish = "ฉบับร่าง";
                }
                else {
                    $publish = "รอการยืนยัน";
                }
                $arrdata[] = array(
                    'id' => $value['id'],
                    'building_name' => $value['building_name'],
                    'publish' => $publish,
                );
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $this->render('FTRWebBundle:Userbuilding:listap.html.twig', array(
            'firstname' => $objSQL1[0]['firstname'],
            'lastname' => $objSQL1[0]['lastname'],
            'username' => $objSQL1[0]['username'],
            'email' => $objSQL1[0]['email'],
            'password' => $objSQL1[0]['password'],
            'phone_number' => $objSQL1[0]['phone_number'],
            'errormsg' => $errormsg,
            'build_data' => $arrdata,
        ));
    }

    public function addDataAction($id = null)
    {
        $fac_inroomlist = NULL;
        $fac_outroomlist = NULL;
        $arrroom = NULL;
        $arrgallery = NULL;
        $countroom = 0;
        $countgallery = 0;
        $building_data = NULL;
        $session = $this->get('session');
        $user = $session->get('user');

        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $userdata = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username' => $user));
            // เช็คถ้าไม่มีให้ redirect
            if (empty($userdata)) {
                return $this->redirect($this->generateUrl('FTRWebBundle_publish'));
            }
            if (empty($id)) {
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
                $building_data = $this->getBuildingData($building_id);
            } else {
                $building_id = $id;
                $building_data = $this->getBuildingData($building_id);
                //echo "<pre>";var_dump($building_data);echo "</pre>";exit();
                if ($building_data['izoneid'] != 0) {
                    $zone_data = $em->getRepository('FTRWebBundle:Zone')->findOneBy(array('id' => $building_data['izoneid']));
                    //var_dump($zone_data);exit();
                    $arrZone[] = array(
                        'id'        => $zone_data->getId(),
                        'zonename'  => $zone_data->getZonename(),
                        'latitude'  => $zone_data->getLatitude(),
                        'longitude' => $zone_data->getLongitude(),
                        'deleted'   => $zone_data->getDeleted(),
                        'checked'   => 'yes',
                    );
                }
                if ($building_data['ipaytypeid'] != 0) {
                    $paytype_data = $em->getRepository('FTRWebBundle:Pay_type')->findOneBy(array('id' => $building_data['ipaytypeid']));
                }
                //var_dump($buildtype_data);exit();
            }
            $linkimagehead = NULL;
            $nameimagehead = NULL;
            $linkimagemap = NULL;
            $nameimagemap = NULL;
            $fac_inroomlist = $this->getFacility('inroom');
            $fac_outroomlist = $this->getFacility('outroom');
            $arrroom = $this->getImageDatas($building_id, NULL, 'room');
            $arrgallery = $this->getImageDatas($building_id, NULL, 'gallery');
            $imagehead = $this->getImageDatas($building_id, NULL, 'head');
            $imagemap = $this->getImageDatas($building_id, NULL, 'map');

            $sqlFacilityList = "select facilitylist_id from facility2site where building_site_id = $id and deleted = 0";
            $facFetch = $conn->fetchAll($sqlFacilityList);
            $facArray = NULL;
            foreach ($facFetch as $key => $value) {
                $facArray[] = $value['facilitylist_id'];
            }

            foreach ($fac_inroomlist as $key => $value) {
                $row = $fac_inroomlist[$key]['loop'];
                foreach ($row as $keyRow => $valueRow) {
                    $fId = $row[$keyRow]['id'];
                    if (is_array($facArray) == true) {
                        if (in_array($fId, $facArray) == true) {
                            $fac_inroomlist[$key]['loop'][$keyRow]['checked'] = "yes";
                        } else {
                            $fac_inroomlist[$key]['loop'][$keyRow]['checked'] = "no";
                        }
                    } else {
                        $fac_inroomlist[$key]['loop'][$keyRow]['checked'] = "no";
                    }
                }
            }

            foreach ($fac_outroomlist as $key => $value) {
                $row = $fac_outroomlist[$key]['loop'];
                foreach ($row as $keyRow => $valueRow) {
                    $fId = $row[$keyRow]['id'];
                    if (is_array($facArray) == true) {
                        if (in_array($fId, $facArray) == true) {
                            $fac_outroomlist[$key]['loop'][$keyRow]['checked'] = "yes";
                        } else {
                            $fac_outroomlist[$key]['loop'][$keyRow]['checked'] = "no";
                        }
                    } else {
                        $fac_outroomlist[$key]['loop'][$keyRow]['checked'] = "no";
                    }
                }
            }

            $arrroomdata = NULL;
            foreach ($arrroom as $key => $roompicvalue) {
                $roomtype2site_id = $roompicvalue['roomtype2site_id'];
                $roomtype2sitedata = $em->getRepository('FTRWebBundle:Roomtype2site')->findOneBy(array('id' => $roomtype2site_id));
                $arrroomdata[] = array(
                    'id' => $roompicvalue['id'],
                    'photo_name' => $roompicvalue['photo_name'],
                    'link_photo' => "images/building/$id/" . $roompicvalue['photo_name'],
                    'roomtype_name' => $roomtype2sitedata->getRoomTypename(),
                    'room_size' => $roomtype2sitedata->getRoomsize(),
                    'room_price' => $roomtype2sitedata->getRoomprice(),
                );
            }
            $arrgallerydata = NULL;
            foreach ($arrgallery as $key => $gallerypicvalue) {
                $arrgallerydata[] = array(
                    'id' => $gallerypicvalue['id'],
                    'photo_name' => $gallerypicvalue['photo_name'],
                    'link_photo' => "images/building/$id/" . $gallerypicvalue['photo_name'],
                    'description' => $gallerypicvalue['description'],
                );
            }
            /*echo "<pre>";
                   var_dump($arrgallerydata);
                   echo "</pre>";
                   exit();*/
            if (!empty($imagehead)) {
                $linkimagehead = "images/building/$id/" . $imagehead[0]['photo_name'];
                $nameimagehead = $imagehead[0]['photo_name'];
            }
            if (!empty($imagemap)) {
                $linkimagemap = "images/building/$id/" . $imagemap[0]['photo_name'];
                $nameimagemap = $imagemap[0]['photo_name'];
            }

            $provinceName = $building_data['saddrprovince'];

            $payType = $this->getPayType($building_data['ipaytypeid']);
            if(!empty($zone_data)){
                $bkkZone = $this->getBkkZone($zone_data->getId());
                $bkkZone = array_merge($arrZone, $bkkZone); // รวม array ของโซนในกรุงเทพ
            }
            else{
                $bkkZone = $this->getBkkZone();
            }

            $buildingType = $this->getBuildingType($building_data['ibuildingtypeid']);
            $province = $this->getProvince($building_data['saddrprovince'], null);
            $district = $this->getDistrictAction($provinceName, $building_data['saddrprefecture'], 'call');
            $provinceOther = $this->getProvince($provinceName, 'other');
            $nearBTS = $this->getNearly(2,$id);
            $nearMRT = $this->getNearly(3,$id);
            $nearUniversity = $this->getNearly(4,$id);
            $nearBy = $this->getNearly(5,$id);
            $nearInCountry = $this->getNearly(6,$id);
            /*echo "<pre>";
                   var_dump($nearBTS);
                   echo "</pre>";
                   exit();*/
            $this->getPathUpload($building_id);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $this->render('FTRWebBundle:Userbuilding:add.html.twig', array(
            'buildingdata' => $building_data,
            'payType' => $payType,
            'zonelist' => $bkkZone,
            'buildingType' => $buildingType,
            'province' => $province,
            'provinceName' => $provinceName,
            'district' => $district,
            'provinceOther' => $provinceOther,
            'nearBTS' => $nearBTS,
            'nearMRT' => $nearMRT,
            'nearUniversity' => $nearUniversity,
            'nearBy' => $nearBy,
            'nearInCountry' => $nearInCountry,
            'username' => $user,
            'build_id' => $building_id,
            'fac_inroom' => $fac_inroomlist,
            'fac_outroom' => $fac_outroomlist,
            'rooms' => $arrroomdata,
            'roomlines' => $countroom,
            'galleries' => $arrgallerydata,
            'gellerylines' => $countgallery,
            'linkimagehead' => $linkimagehead,
            'nameimagehead' => $nameimagehead,
            'linkimagemap' => $linkimagemap,
            'nameimagemap' => $nameimagemap,
        ));
    }

    public function getBuildingData($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $build_data = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id' => $id));
        $arrdata = array(
            'sbuildingname' => $build_data->getBuildingName(),
            'tbuildingaddress' => $build_data->getBuildingAddress(),
            'istartprice' => $build_data->getStartPrice(),
            'iendprice' => $build_data->getEndPrice(),
            'sphonenumber' => $build_data->getPhoneNumber(),
            'slatitude' => $build_data->getLatitude(),
            'slongitude' => $build_data->getLongitude(),
            'brecommend' => $build_data->getRecommend(),
            'ibuildingtypeid' => $build_data->getBuildingTypeId(),
            'izoneid' => $build_data->getZoneId(),
            'ipaytypeid' => $build_data->getPayTypeId(),
            'iuserownerid' => $build_data->getUserOwnerId(),
            'tdetail' => $build_data->getDetail(),
            'scontactname' => $build_data->getContactName(),
            'scontactemail' => $build_data->getContactEmail(),
            'swebsite' => $build_data->getWebsite(),
            'smonthstay' => $build_data->getMonthStay(),
            'fwaterunit' => $build_data->getWaterUnit(),
            'felectrictunit' => $build_data->getElectricityUnit(),
            'iinternetprice' => $build_data->getInternetPrice(),
            'igooglemapurl' => $build_data->getGoogleMapUrl(),
            'snearlyplace' => $build_data->getNearlyPlace(),
            'saddrnumber' => $build_data->getAddrNumber(),
            'saddrprefecture' => $build_data->getAddrPrefecture(),
            'saddrprovince' => $build_data->getAddrProvince(),
            'saddrzipcode' => $build_data->getAddrZipcode(),
        );
        return $arrdata;
    }

    public function getImageDatas($buildid = null, $roomtype2siteid = null, $type)
    {
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "select * from image
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
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $imagedata;
    }

    public function getFacility($type)
    {
        $fac_inroomlist = NULL;
        $fac_outroomlist = NULL;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            if ($type == 'inroom') {
                /**
                 * query for facility list inroom type
                 */
                $sql = "select * from facilitylist where facility_type = '$type' and display = 1";
                $faclist_inroom = $conn->fetchAll($sql);
                $countall_inroom = count($faclist_inroom);
                foreach ($faclist_inroom as $key => $value) {
                    $count = $key + 1;
                    $list[] = array(
                        'id' => $value['id'],
                        'facility_name' => $value['facility_name'],
                        'facility_type' => $value['facility_type'],
                    );
                    if ($count % 4 == 0) {
                        $fac_inroomlist[] = array('loop' => $list);
                        $list = NULL;
                    } elseif ($count == $countall_inroom) {
                        $fac_inroomlist[] = array('loop' => $list);
                        $list = NULL;
                    }
                }
                $fac_listreturn = $fac_inroomlist;
            } elseif ($type == 'outroom') {
                /**
                 * query for facility list outroom type
                 */
                $sql = "select * from facilitylist where facility_type = '$type' and display = 1";
                $faclist_outroom = $conn->fetchAll($sql);
                $countall_outroom = count($faclist_outroom);
                foreach ($faclist_outroom as $key => $value) {
                    $count = $key + 1;
                    $list[] = array(
                        'id' => $value['id'],
                        'facility_name' => $value['facility_name'],
                        'facility_type' => $value['facility_type'],
                    );
                    if ($count % 4 == 0) {
                        $num = 4;
                        if ($count == $countall_outroom) {
                            $fac_outroomlist[] = array('loop' => $list, 'stat' => 'end', 'count' => $num);
                        } else {
                            $fac_outroomlist[] = array('loop' => $list, 'stat' => 'not', 'count' => $num);
                        }
                        $list = NULL;
                    } elseif ($count == $countall_outroom) {
                        $countlist = count($list);
                        $num = 4 - $countlist;
                        $fac_outroomlist[] = array('loop' => $list, 'stat' => 'end', 'count' => $num);
                        $list = NULL;
                    }
                }
                $fac_listreturn = $fac_outroomlist;
                /*echo "<pre>";
                        var_dump($fac_listreturn);
                        echo "</pre>";exit();*/
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $fac_listreturn;
    }

    public function saveDataAction($id = null)
    {
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        $check = NULL;

        $session = $this->get('session');
        $user = $session->get('user');

        $today = date("Y-m-d H:i:s");
        if ($_POST) {
            $post_array = $_POST;
            echo "<pre>";
            var_dump($post_array);
            echo "</pre>";
            exit();
            /*
                * image section
                */
            $headimage_name = $post_array['hdnfilename'];
            $mapimage_name = $post_array['hdnfilemap'];
            $countimage_room = $post_array['hdnMaxLine'];
            $countimage_gallery = $post_array['hdnMaxLineGal'];

            for ($i = 0; $i < $countimage_room; $i++) {
                $arrayimage_room[] = array(
                    'imageid' => $post_array['imageid' . $i],
                    'imagename' => $post_array['hdnfilename' . $i],
                    'typename' => $post_array['typeap_name' . $i],
                    'size' => $post_array['typeap_size' . $i],
                    'price' => $post_array['typeap_price' . $i],
                );
            }

            for ($i = 0; $i < $countimage_gallery; $i++) {
                $arrayimage_room[] = array(
                    'imageid' => $post_array['imageid' . $i],
                    'imagename' => $post_array['hdnfilename' . $i],
                    'typename' => $post_array['typeap_name' . $i],
                    'size' => $post_array['typeap_size' . $i],
                    'price' => $post_array['typeap_price' . $i],
                );
            }

            echo "<pre>";
            var_dump($arrayimage_room);
            echo "</pre>";
            exit();
            $apartment_name = $post_array['nameap'];
            $apartment_addr = $post_array['placeap'];
            /*$apartment_name = $post_array['nameap'];
               $apartment_name = $post_array['nameap'];
               $apartment_name = $post_array['nameap'];*/


            try {
                if ($id) {
                    $sql = "select * from building_site where id = $id";
                    $check = $conn->fetchAll($sql);
                }
                //เช็คข้อมูลก่อน เพื่อทราบว่าจะ Insert หรือ Update
                if (!empty($check)) { //ส่วนนี้ พบข้อมูล ทำการอัพเดต


                } else { //ส่วนนี้ ไม่พบข้อมูล ทำการ insert

                    $sqlinsert = "INSERT INTO `building_site` (
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
                echo 'Caught exception: ', $e->getMessage(), "\n";
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
            ->setBody($this->renderView('FTRWebBundle:Userbuilding:email.html.twig', array('name' => $name)), 'text/html');

        $this->get('mailer')->send($message);

        return $this->render('FTRWebBundle:Userbuilding:email.html.twig', array('name' => $name));
    }

    public function updateUserProfileAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        if ($_POST) {
            $firstname = $_POST['fname'];
            $lastname = $_POST['lname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmpass = $_POST['cpassword'];
            $tel_number = $_POST['tel'];
        }
        $errmsg = NULL;
        $errmsg['tel'] = NULL;
        $errmsg['password'] = NULL;
        $errmsg['email'] = NULL;
        $errmsg['confirmpass'] = NULL;
        if (!empty($confirmpass)) {
            if (strlen($password) < 8 || strlen($confirmpass) < 8 || strlen($password) > 12 || strlen($confirmpass) > 12) {
                $errpass = 'รหัสผ่านต้องมี 8 อักษร และไม่เกิน 12 อักษร';
            }
            if (!preg_match("#[a-z]+#", $password) || !preg_match("#[a-z]+#", $confirmpass)) {
                $errpass = 'รหัสผ่านต้องมีอักษรอย่างน้อย 1 ตัว';
            }
            if ($password != $confirmpass) {
                $errpass = 'รหัสผ่านยืนยันไม่ตรงกัน';
            }
            if (!empty($errpass)) {
                $errmsg['password'] = 'ผิดพลาด!:' . $errpass;
            }

            $toemail = trim($email);
            $fixmail = str_replace(' ', '', $toemail);
            if (!filter_var($fixmail, FILTER_VALIDATE_EMAIL)) {
                $errmsg['email'] = 'ผิดพลาด!:email ไม่ถูกต้อง';
            }

            if (strlen($tel_number) < 9) {
                $errmsg['tel'] = 'ผิดพลาด!:หมายเลขโทรศัพท์ไม่ถูกต้อง';
            }

            if (!empty($errmsg['password']) || !empty($errmsg['email']) || !empty($errmsg['tel'])) {
                return $this->indexAction($errmsg);
            } else {
                $session = $this->get('session');
                $user = $session->get('user');
                $userowner = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username' => $user));
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
        } else {
            $errmsg['confirmpass'] = 'ไม่ได้กรอกยืนยันรหัสผ่าน';
            return $this->indexAction($errmsg);
        }

    }

    public function getPathUpload($id)
    {
        $path = "./images/building/" . $id;
        if (!file_exists("./images/building")) {
            mkdir("./images/building", 0777);
        }
        if (!file_exists($path)) {
            mkdir($path, 0777);
        }
        return $path;
    }

    public function autoSaveFormAction($id, $type)
    {
        if ($_POST) {
            $sownername = $_POST['hdnownername'];
            $ibuildid = $id;
            $arrimagedata = NULL;
            if ($type == 'image') {
                $icountlineroom = trim(@$_POST['hdnMaxLine']);
                $icountlinegallery = trim(@$_POST['hdnMaxLineGal']);
                if (!empty($_POST['hdnfilename'])) {
                    $sheadimagename = trim(@$_POST['hdnfilename']);
                    $arrimagedata[] = array(
                        'photo_name' => $sheadimagename,
                        'photo_type' => 'head',
                        'sequence' => 0,
                    );
                }

                if (!empty($_POST['hdnfilemap'])) {
                    $smapimagename = trim(@$_POST['hdnfilemap']);
                    $arrimagedata[] = array(
                        'photo_name' => $smapimagename,
                        'photo_type' => 'map',
                        'sequence' => 0,
                    );
                }

                for ($i = 0; $i < $icountlineroom; $i++) {
                    if (!empty($_POST["hdnfilename$i"]) || !empty($_POST["typeap_name$i"]) || !empty($_POST["typeap_size$i"]) || !empty($_POST["typeap_price$i"])) {
                        $arrimagedata[] = array(
                            'imageid' => trim(@$_POST["imageid$i"]),
                            'photo_name' => trim(@$_POST["hdnfilename$i"]),
                            'typename' => trim(@$_POST["typeap_name$i"]),
                            'room_size' => trim(@$_POST["typeap_size$i"]),
                            'room_price' => trim(@$_POST["typeap_price$i"]),
                            'photo_type' => 'room',
                            'sequence' => $i,
                        );
                    }
                }

                for ($i = 0; $i < $icountlinegallery; $i++) {
                    if (!empty($_POST["hdngalleryname$i"]) || !empty($_POST["galtitle$i"])) {
                        $arrimagedata[] = array(
                            'imageid' => trim(@$_POST["imageidgal$i"]),
                            'photo_name' => trim(@$_POST["hdngalleryname$i"]),
                            'description' => trim(@$_POST["galtitle$i"]),
                            'photo_type' => 'gallery',
                            'sequence' => $i,
                        );
                    }
                }

                $alert = $this->saveImageData($id, $arrimagedata);
                echo $alert;
            } elseif ($type == 'head') {

                $building_name = trim(@$_POST['nameap']);
                $building_addr = trim(@$_POST['placeap']);
                $province = trim(@$_POST['province']);
                $district = trim(@$_POST['district']);
                $zipCode = trim(@$_POST['zipcode']);
                $detail = trim(@$_POST['placedetail']);
                $longitude = trim(@$_POST['longitude']);
                $latitude = trim(@$_POST['latitude']);
                $building_type = trim(@$_POST['aptype']);
                $pay_type = trim(@$_POST['paytype']);
                $phone_number = trim(@$_POST['telnumber']);
                $month_stay = trim(@$_POST['time']);
                $contact_name = trim(@$_POST['contact_person']);
                $water_price = trim(@$_POST['water_price']);
                $contact_email = trim(@$_POST['contact_email']);
                $electric_price = trim(@$_POST['power_price']);
                $website = trim(@$_POST['website']);
                $internet_price = trim(@$_POST['internet_price']);

                if (empty($internet_price)) {
                    $internet_price = null;
                }

                $arrbuilding_data = array(
                    'building_name' => $building_name,
                    'building_addr' => $building_addr,
                    'province' => $province,
                    'district' => $district,
                    'zipcode' => $zipCode,
                    'detail' => $detail,
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'building_type' => $building_type,
                    'pay_type' => $pay_type,
                    'phone_number' => $phone_number,
                    'month_stay' => $month_stay,
                    'contact_name' => $contact_name,
                    'water_price' => $water_price,
                    'contact_email' => $contact_email,
                    'electric_price' => $electric_price,
                    'website' => $website,
                    'internet_price' => $internet_price,
                    'publish' => '0',
                );

                $alert = $this->saveBuildingData($id, $arrbuilding_data);
                echo $alert;
            }
            elseif ($type == 'other') {
                $facilityList = @$_POST['fac'];
                $alert = $this->saveFacilityData($id, $facilityList);

                $zoneLocation = @$_POST['bkzone_ot'];
                $nearLocation = @$_POST['near_ot'];
                $arrOther = array(
                    'bts'       => @$_POST['bts_ot'],
                    'mrt'       => @$_POST['mrt_ot'],
                    'university'=> @$_POST['univer_ot'],
                );
                $alert = $this->saveOtherData($id, $arrOther, $zoneLocation, $nearLocation);

                echo $alert;
            }
        }
        exit();
    }

    public function saveImageData($id, $imagedata)
    {
        $em = $this->getDoctrine()->getEntityManager();
        //echo $imagedata[0]['photo_name'];exit();
        foreach ($imagedata as $key => $value) {
            $roomtype2siteid = NULL;
            $data = NULL; // set NULL value for new loop

            if (!empty($id) || !empty($value['photo_name'])) {

                $imageValue = $em->getRepository('FTRWebBundle:Image')->findOneBy(array(
                    'building_site_id' => $id,
                    'photo_type' => $value['photo_type'],
                    'sequence' => $value['sequence']));

                $photo_name = $value['photo_name'];
                $photo_type = $value['photo_type'];
                $sequence = $value['sequence'];
                if (!empty($value['description'])) {
                    $description = $value['description'];
                } else {
                    $description = '';
                }

                if ($value['photo_type'] == 'room') {
                    if (!empty($value['typename'])) {
                        $roomtype_name = $value['typename'];
                    } else {
                        $roomtype_name = 'ยังไม่ระบุ';
                    }
                    if (!empty($value['room_size'])) {
                        $room_size = $value['room_size'];
                    } else {
                        $room_size = 0;
                    }
                    if (!empty($value['room_price'])) {
                        $room_price = $value['room_price'];
                    } else {
                        $room_price = 0;
                    }

                    $data = array(
                        'typename' => $roomtype_name,
                        'room_size' => $room_size,
                        'room_price' => $room_price,
                    );
                }

                if (empty($imageValue)) {
                    $image = new Image();
                    $image->setBuildingSiteId($id);
                    $image->setPhotoName($photo_name);
                    $image->setPhotoType($photo_type);
                    $image->setSequence($sequence);
                    $image->setDescription($description);
                    if ($value['photo_type'] == 'room') {
                        $roomtype2siteid = $this->saveRoomtypeData($id, $data, NULL);
                    }
                    $image->setRoomtype2siteId($roomtype2siteid);
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($image);
                    $em->flush();
                } else {
                    $oldImageName = $imageValue->getPhotoName();
                    $pathImage = $this->getPathUpload($id);
                    $path = $pathImage . "/" . $oldImageName;

                    if (file_exists($path)) {
                        if ($photo_name != $oldImageName) {
                            unlink($path);
                        }
                    }

                    $imageValue->setPhotoName($photo_name);
                    $imageValue->setPhotoType($photo_type);
                    $imageValue->setSequence($sequence);
                    $imageValue->setDescription($description);
                    $roomtype2siteid = $imageValue->getRoomtype2siteId();
                    if ($value['photo_type'] == 'room') {
                        $roomtype2siteid = $this->saveRoomtypeData($id, $data, $roomtype2siteid);
                    }
                    $imageValue->setRoomtype2siteId($roomtype2siteid);
                    $em->flush();
                }
            }
        }
        return 'complete';
    }

    public function saveRoomtypeData($buildingid, $data, $roomtype2siteid)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $roomtype2sitedata = $em->getRepository('FTRWebBundle:Roomtype2site')->findOneBy(array('building_site_id' => $buildingid, 'id' => $roomtype2siteid));
        if (empty($roomtype2sitedata)) {
            $roomtype2site = new Roomtype2site();
            $roomtype2site->setRoomTypename($data['typename']);
            $roomtype2site->setBuildingSiteId($buildingid);
            $roomtype2site->setRoomsize(trim($data['room_size']));
            $roomtype2site->setRoomprice(trim($data['room_price']));
            $em->persist($roomtype2site);
            $em->flush();

            $roomtype2siteid = $roomtype2site->getId();
        } else {
            $roomtype2sitedata->setRoomTypename(trim($data['typename']));
            $roomtype2sitedata->setRoomsize(trim($data['room_size']));
            $roomtype2sitedata->setRoomprice(trim($data['room_price']));

            $em->flush();
        }
        $returnValue = $this->saveMinMaxRoomPrice($buildingid);
        $buildingValue = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id' => $buildingid));
        $buildingValue->setStartPrice($returnValue['startPrice']);
        $buildingValue->setEndPrice($returnValue['endPrice']);
        $em->flush();
        return $roomtype2siteid;
    }

    public function saveMinMaxRoomPrice($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $roomTypeData = $em->getRepository('FTRWebBundle:Roomtype2site')->findBy(array('building_site_id' => $id));
        $minPrice = 0;
        $maxPrice = 0;
        if (!empty($roomTypeData)) {
            foreach ($roomTypeData as $key => $data) {
                $roomPrice = $data->getRoomprice();
                if ($roomPrice < $minPrice) {
                    if ($roomPrice != 0) {
                        $minPrice = $roomPrice;
                    }
                } elseif ($minPrice == 0) {
                    $minPrice = $roomPrice;
                }
                if ($roomPrice > $maxPrice) {
                    if ($roomPrice != 0) {
                        $maxPrice = $roomPrice;
                    }
                }
            }
        }
        $arrPrice = array(
            'startPrice' => $minPrice,
            'endPrice' => $maxPrice,
        );
        return $arrPrice;
    }

    public function saveBuildingData($id, $arrData)
    {
        $session = $this->get('session');
        $username = $session->get('user');
        $today = new \DateTime('now');

        //$now = $today->format('Y-m-d H:i:s');
        //echo $now->format('Y-m-d H:i:s');exit();
        $em = $this->getDoctrine()->getEntityManager();
        $buildingValue = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id' => $id));
        $buildingValue->setBuildingName($arrData['building_name']);
        $buildingValue->setBuildingAddress($arrData['building_addr']);

        $returnValue = $this->saveMinMaxRoomPrice($id);
        $buildingValue->setStartPrice($returnValue['startPrice']);
        $buildingValue->setEndPrice($returnValue['endPrice']);
        $buildingValue->setPhoneNumber($arrData['phone_number']);
        $buildingValue->setPublish(intval($arrData['publish']));
        $buildingValue->setLastupdate($today);
        $buildingValue->setUserupdate($username);
        $buildingValue->setLatitude($arrData['latitude']);
        $buildingValue->setLongitude($arrData['longitude']);
        $buildingValue->setBuildingTypeId($arrData['building_type']);
        /*$buildingValue->setZoneId($arrData['']);*/
        $buildingValue->setPayTypeId($arrData['pay_type']);
        $buildingValue->setDetail($arrData['detail']);
        $buildingValue->setContactName($arrData['contact_name']);
        $buildingValue->setContactEmail($arrData['contact_email']);
        $buildingValue->setWebsite($arrData['website']);
        $buildingValue->setMonthStay($arrData['month_stay']);
        $buildingValue->setWaterUnit($arrData['water_price']);
        $buildingValue->setElectricityUnit($arrData['electric_price']);
        $buildingValue->setInternetPrice($arrData['internet_price']);
        $buildingValue->setAddrPrefecture($arrData['district']);
        $buildingValue->setAddrProvince($arrData['province']);
        $buildingValue->setAddrZipcode($arrData['zipcode']);

        $em->flush();
        return "complete";
    }

    public function saveOtherData($id, $arrData, $zone, $near)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $buildingValue = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id' => $id));
        $buildingValue->setZoneId($zone);
        $buildingValue->setNearlyPlace($near);
        $em->flush();

        $nearlyValue = $em->getRepository('FTRWebBundle:Nearly2site')->findBy(array('building_site_id' => $id));

        if(!empty($nearlyValue))
        {
            foreach($nearlyValue as $key => $data)
            {
                $em->remove($data);
            }
            $em->flush();
        }
        //echo "test";exit();
        $nearlyLocation = new Nearly2site();
        $nearlyLocation->setBuildingSiteId($id);
        $nearlyLocation->setNearlyLocationId($arrData['bts']);
        $nearlyLocation->setDeleted(0);
        $em->persist($nearlyLocation);

        $nearlyLocation = new Nearly2site();
        $nearlyLocation->setBuildingSiteId($id);
        $nearlyLocation->setNearlyLocationId($arrData['mrt']);
        $nearlyLocation->setDeleted(0);
        $em->persist($nearlyLocation);

        $nearlyLocation = new Nearly2site();
        $nearlyLocation->setBuildingSiteId($id);
        $nearlyLocation->setNearlyLocationId($arrData['university']);
        $nearlyLocation->setDeleted(0);
        $em->persist($nearlyLocation);
        $em->flush();

        return "complete";
    }


    public function saveFacilityData($buildingSiteId, $arrData)
    {
        //echo "test";exit();
        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
				UPDATE facility2site
				SET deleted=1
				WHERE building_site_id=$buildingSiteId
			";
            $conn->query($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        foreach ($arrData as $key => $value) {
            $facilityValue = $em->getRepository('FTRWebBundle:Facility2site')->findOneBy(array('facilitylist_id' => intval($value), 'building_site_id' => $buildingSiteId));
            //echo "test";exit();
            if (empty($facilityValue)) {
                $facility = new Facility2site();
                $facility->setBuildingSiteId($buildingSiteId);
                $facility->setFacilitylistId($value);
                $facility->setDeleted(0);
                $em->persist($facility);
                $em->flush();
            } else {
                $facilityValue->setDeleted(0);
                $em->flush();
            }
        }

        return "complete";
    }

    function getBkkZone($id=0)
    {
        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $whereQuery = null;
            $sql = "
				SELECT *,'no' as checked FROM zone WHERE id not in ($id)
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        if(empty($id))
        {
            $all[] = array('id' => 0, 'zonename' => '- กรุณาระบุ -', 'checked'=>'no');
            $result = array_merge($all, $result_data);
        }else{
            $result = $result_data;
        }
        return $result;
    }

    function getProvince($provinceName, $type = null)
    {
        $result_data = array();
        $all[] = array('PROVINCE_VALUE' => '0', 'PROVINCE_NAME' => '- กรุณาระบุ -', 'checked' => 'no');
        $sqlPlus = null;
        $sqlPlus2 = null;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            switch ($type) {
                case 'other':

                    $sqlPlus = " AND PROVINCE_NAME NOT LIKE '%กรุงเทพมหานคร%'";
                    $sqlPlus2 = "WHERE PROVINCE_NAME NOT LIKE '%กรุงเทพมหานคร%'";
                    break;
                default:


                    break;

            }
            if (!empty($provinceName)) {
                $sql = "
                    SELECT
                      PROVINCE_NAME AS PROVINCE_VALUE,
                      PROVINCE_NAME AS PROVINCE_NAME,
                      PROVINCE_NAME AS OrderBy,
                      'yes' AS checked
                    FROM
                      province
                    WHERE PROVINCE_NAME LIKE '%$provinceName%'
                          $sqlPlus
                    UNION
                    SELECT
                      PROVINCE_NAME AS PROVINCE_VALUE,
                      PROVINCE_NAME AS PROVINCE_NAME,
                      PROVINCE_NAME AS OrderBy,
                      'no' AS checked
                    FROM
                      province
                    WHERE PROVINCE_NAME NOT LIKE '%$provinceName%'
                          $sqlPlus
                    ORDER BY OrderBy ASC
                ";
            } else {
                $sql = "
                    SELECT
                      PROVINCE_NAME AS PROVINCE_VALUE,
                      PROVINCE_NAME AS PROVINCE_NAME,
                      'no' AS checked
                    FROM
                      province $sqlPlus2
                    ORDER BY PROVINCE_NAME ASC
                ";
            }
            //var_dump($sql);exit();
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        if (empty($provinceName)) {
            $result = array_merge($all, $result_data);
        } else {
            $result = $result_data;
        }
        //var_dump($result);
        return $result;
    }

    public function getDistrictAction($province, $district = null, $call = null)
    {
        //echo $province;exit();
        if ($province != null) {
            $amphur = $this->getAmphur($province, $district);
            //var_dump($district);exit();
            if (!empty($call)) {
                return $amphur;
            }
            echo "
                <div class=\"styled-select\">
                <select id=\"district\" name=\"district\" class=\"select\" onchange=\"postData('head');\">";
            foreach ($amphur as $key => $var) {
                echo "<option value=\"" . $amphur[$key]['AMPHUR_VALUE'] . "\">" . $amphur[$key]['AMPHUR_NAME'] . "</option>";
            }
            echo "
                </div>
                </select>
            ";
        } else {
            if (!empty($call)) {
                return $amphur = $this->getAmphur($province, $district);
            }
            echo "no";
        }
        exit();
    }

    function getAmphur($province = null, $district = null)
    {
        $result_data = array();
        $all[] = array('AMPHUR_VALUE' => 0, 'AMPHUR_NAME' => ' - กรุณาระบุ - ', 'checked' => 'no');
        $whereQuery = NULL;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sqlPlus = null;
            $sqlPlus2 = null;
            if (!empty($district)) {
                $sqlPlus = "AMPHUR_NAME NOT LIKE '%$district%'
                      AND";
                $sqlPlus2 = "AMPHUR_NAME LIKE '%$district%'
                      AND";
            }
            if (!empty($province)) {
                if (!empty($district)) {
                    $sql = "
                        (SELECT
                          AMPHUR_NAME AS AMPHUR_VALUE,
                          AMPHUR_NAME AS AMPHUR_NAME,
                          'no' AS checked,
                          AMPHUR_NAME AS OrderBy
                        FROM
                          amphur
                        WHERE $sqlPlus province_id IN
                          (SELECT
                            province_id
                          FROM
                            province
                          WHERE province_name LIKE '%$province%'))
                        UNION
                        (SELECT
                          AMPHUR_NAME AS AMPHUR_VALUE,
                          AMPHUR_NAME AS AMPHUR_NAME,
                          'yes' AS checked,
                          AMPHUR_NAME AS OrderBy
                        FROM
                          amphur
                        WHERE $sqlPlus2 province_id IN
                          (SELECT
                            province_id
                          FROM
                            province
                          WHERE province_name LIKE '%$province%'))
                        ORDER BY OrderBy ASC
                    ";
                } else {
                    $sql = "
                        SELECT
                          AMPHUR_NAME AS AMPHUR_VALUE,
                          AMPHUR_NAME AS AMPHUR_NAME,
                          'no' AS checked,
                          AMPHUR_NAME AS OrderBy
                        FROM
                          amphur
                        WHERE province_id IN
                          (SELECT
                            province_id
                          FROM
                            province
                          WHERE province_name LIKE '%$province%')
                    ";
                }
                $result_data = $conn->fetchAll($sql);
            }
            $result = array_merge($all, $result_data);
            /*echo "<pre>";
            var_dump($result);
            echo "</pre>";*/
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $result;
    }

    function getBuildingType($buildingTypeId)
    {
        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
				(select
				  t.id,
				  t.type_name,
				  'no' as checked
				from
				  building_type t
				where t.id not in
				  (select
				    building_type_id
				  from
				    building_site
				  where id = $buildingTypeId))
				union
				(select
				  t.id,
				  t.type_name,
				  'yes' as checked
				from
				  building_type t
				where t.id in
				  (select
				    building_type_id
				  from
				    building_site
				  where id = $buildingTypeId))
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        if ($buildingTypeId == 0) {
            $all[] = array('id' => 0, 'type_name' => '- กรุณาระบุ -', 'checked' => 'yes');
        } else {
            $all[] = array('id' => 0, 'type_name' => '- กรุณาระบุ -', 'checked' => 'no');
        }
        $result = array_merge($all, $result_data);
        return $result;
    }

    function getPayType($paytypeid)
    {
        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            if ($paytypeid != 0) {
                $sql = "
					(select 
					  t.id,
					  t.typename,
					  'no' as checked 
					from
					  pay_type t 
					where t.id not in 
					  (select 
					    pay_type_id 
					  from
					    building_site 
					  where id = $paytypeid)) 
					union
					(select 
					  t.id,
					  t.typename,
					  'yes' as checked 
					from
					  pay_type t 
					where t.id in 
					  (select 
					    pay_type_id 
					  from
					    building_site 
					  where id = $paytypeid))
				";
            } else {
                $sql = "
					SELECT t.id,t.typename,'no' as checked FROM pay_type t ORDER BY t.id DESC
				";
            }
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        $result = $result_data;
        return $result;
    }

    function getNearly($type = 2,$buildingId)
    {
        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
				select
                  id,
                  name,
                  'yes' as checked
                from
                  nearly_location
                where nearly_type_id = $type
                  and id in
                  (select
                    nearly_location_id
                  from
                    nearly2site
                  where building_site_id = $buildingId)
                  union
                  select
                    id,
                    name,
                    'no' as checked
                  from
                    nearly_location
                  where nearly_type_id = $type
                    and id not in
                    (select
                      nearly_location_id
                    from
                      nearly2site
                    where building_site_id = $buildingId)
                  order by id
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        switch ($type) {
            case 2:
            case 3:
                $all[] = array('id' => 0, 'name' => ' - กรุณาระบุ - ', 'checked' => 'no');
                break;
            case 4:
            case 5:
            case 6:
                $all[] = array('id' => 0, 'name' => ' - กรุณาระบุ - ', 'checked' => 'no');
                break;
        }

        $result = array_merge($all, $result_data);
        return $result;
    }
}
