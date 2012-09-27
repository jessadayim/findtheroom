<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
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
use FTR\AdminBundle\Helper\LoggerHelper;
use FTR\AdminBundle\Helper\Paginator;

class UserbuildingController extends Controller
{

    public function indexAction($error_msg = NULL)
    {
        $session = $this->get('session');
        $username = $session->get('user');
        $objSQL1 = null;
        if (empty($username)) {
            return $this->redirect($this->generateUrl('FTRWebBundle_regis'));
        }

        if (empty($errormsg)) { //Default error messeges
            $error_msg = array('email' => NULL, 'password' => NULL, 'tel' => NULL, 'confirmpass' => 'ต้องใส่ยืนยันรหัสก่อนบันทึก');
        }
        $conn = $this->get('database_connection');
        $enabled = null;
        $arrdata = NULL;
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql1 = "SELECT * FROM user_owner WHERE username = '" . $username . "'";
            $objSQL1 = $conn->fetchAll($sql1);
            $enabled = $objSQL1[0]['enabled'];
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
            'errormsg' => $error_msg,
        ));
    }

    public function listApartmentAction()
    {
        $session = $this->get('session');
        $username = $session->get('user');
        $itemCount = null;

        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        $enabled = null;
        $arrData = NULL;
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql1 = "SELECT * FROM user_owner WHERE username = '" . $username . "'";
            $objSQL1 = $conn->fetchAll($sql1);
            $enabled = $objSQL1[0]['enabled'];

            $getTextSearch = null;

            if($_GET)
            {
                //get data
                $getSelectPage = @$_GET['numPage'];
                $getRecord = @$_GET['record'];
                $getTextSearch = @$_GET['textSearch'];
                $getOrderBy = @$_GET['orderBy'];
                $getOrderByType = @$_GET['orderByType'];
            }

            $sql2 = "SELECT * FROM building_site b WHERE user_owner_id = '" . $objSQL1[0]['id'] . "'";
            //set paging
            $page = 1;
            if (!empty($getSelectPage)){
                $page = $getSelectPage;
            }
            $limit = 10;
            $midRange = 5;
            if(!empty($getRecord)){
                $limit = $getRecord;
            }else {
                $getRecord = $limit;
            }
            $offset = $limit*$page-$limit;

            if (empty($getOrderBy) && empty($getOrderByType)){
                $getOrderBy = 'id';
                $getOrderByType = 'asc';
            }
            if (!empty($getTextSearch) && $getTextSearch != ''){
                $sql2 = "
                    $sql2
                    AND b.id LIKE '%$getTextSearch%'
                    OR b.building_name LIKE '%$getTextSearch%'
                ";
            }

            $sql2 = "
                $sql2
                GROUP BY b.id
                ORDER BY b.$getOrderBy  $getOrderByType
            ";

            $objSQL2 = $conn->fetchAll($sql2);
            //นับจำนวนที่มีทั้งหมด
            $itemCount = count($objSQL2);

            //จำกัดการแสดงผล
            $sql2 = "
                $sql2
                LIMIT $offset, $limit
            ";
            //echo $sql2;
            //exit();
            $objSQL3 = $conn->fetchAll($sql2);

            foreach ($objSQL3 as $key => $value) {
                if ($value['publish'] == 1) {
                    $publish = "แสดงแล้ว";
                } elseif ($value['publish'] == 0) {
                    $publish = "ฉบับร่าง";
                }
                else {
                    $publish = "รอการยืนยัน";
                }
                $arrData[] = array(
                    'id' => $value['id'],
                    'building_name' => $value['building_name'],
                    'publish' => $publish,
                );
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }


        $paging = new Paginator($itemCount,$offset,$limit,$midRange);
        return $this->render('FTRWebBundle:Userbuilding:list_table.html.twig', array(
            'build_data' => $arrData,
            'paginator' => $paging,
            'countList' => $itemCount,
            'enabled' => $enabled,
            'limit' 	        => $limit,
            'noPage'	        => $page,
            'record'	        => $getRecord,
            'textSearch'        => $getTextSearch,
            'orderBy'           => $getOrderBy,
            'orderByType'       => $getOrderByType
        ));
    }

    public function addDataAction($id = null)
    {
        $fac_inroomlist = NULL;
        $fac_outroomlist = NULL;
        $arrroom = NULL;
        $arrgallery = NULL;
        $countRoom = 0;
        $countGallery = 0;
        $building_data = NULL;
        $arrZone= NULL;
        $session = $this->get('session');
        $user = $session->get('user');

        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $userData = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username' => $user));
            // เช็คถ้าไม่มีให้ redirect
            if (empty($userData)) {
                return $this->redirect($this->generateUrl('FTRWebBundle_publish'));
            }
            if (empty($id)) {
                $building = new Building_site();
                $building->setBuildingName('');
                $building->setBuildingAddress('');
                $building->setPublish(0);
                $building->setStartPrice(0);
                $building->setEndPrice(0);
                $building->setPhoneNumber('');
                $building->setBuildingTypeId(0);
                $building->setPayTypeId(0);
                $building->setUserOwnerId($userData->getId());
                $building->setContactName('');
                $building->setContactEmail('');
                $building->setMonthStay('');
                $building->setWaterUnit(0);
                $building->setElectricityUnit(0);
                $building->setDeleted(0);
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
                    $payType_data = $em->getRepository('FTRWebBundle:Pay_type')->findOneBy(array('id' => $building_data['ipaytypeid']));
                }
                //var_dump($buildtype_data);exit();
            }
            $linkImageHead = NULL;
            $nameImageHead = NULL;
            $linkImageMap = NULL;
            $nameImageMap = NULL;
            $fac_inRoomList = $this->getFacility('inroom');
            $fac_inRoomLoop = $this->getFacility('inroom','loop');
            $fac_outRoomList = $this->getFacility('outroom');
            $fac_outRoomLoop = $this->getFacility('outroom','loop');
            $arrRoom = $this->getImageDatas($building_id, NULL, 'room');
            $arrGallery = $this->getImageDatas($building_id, NULL, 'gallery');
            $imageHead = $this->getImageDatas($building_id, NULL, 'head');
            $imageMap = $this->getImageDatas($building_id, NULL, 'map');
            $sqlFacilityList = "select facilitylist_id from facility2site where building_site_id = $building_id and deleted = 0";
            $facFetch = $conn->fetchAll($sqlFacilityList);
            $facArray = NULL;
            foreach ($facFetch as $key => $value) {
                $facArray[] = $value['facilitylist_id'];
            }

            foreach ($fac_inRoomList as $key => $value) {
                $row = $fac_inRoomList[$key]['loop'];
                foreach ($row as $keyRow => $valueRow) {
                    $fId = $row[$keyRow]['id'];
                    if (is_array($facArray) == true) {
                        if (in_array($fId, $facArray) == true) {
                            $fac_inRoomList[$key]['loop'][$keyRow]['checked'] = "yes";
                        } else {
                            $fac_inRoomList[$key]['loop'][$keyRow]['checked'] = "no";
                        }
                    } else {
                        $fac_inRoomList[$key]['loop'][$keyRow]['checked'] = "no";
                    }
                }
            }

            foreach ($fac_outRoomList as $key => $value) {
                $row = $fac_outRoomList[$key]['loop'];
                foreach ($row as $keyRow => $valueRow) {
                    $fId = $row[$keyRow]['id'];
                    if (is_array($facArray) == true) {
                        if (in_array($fId, $facArray) == true) {
                            $fac_outRoomList[$key]['loop'][$keyRow]['checked'] = "yes";
                        } else {
                            $fac_outRoomList[$key]['loop'][$keyRow]['checked'] = "no";
                        }
                    } else {
                        $fac_outRoomList[$key]['loop'][$keyRow]['checked'] = "no";
                    }
                }
            }

            $arrRoomData = NULL;
            foreach ($arrRoom as $key => $roomPicValue) {
                $roomType2site_id = $roomPicValue['roomtype2site_id'];
                $roomType2siteData = $em->getRepository('FTRWebBundle:Roomtype2site')->findOneBy(array('id' => $roomType2site_id));
                if(!empty($roomPicValue['photo_name']))
                {
                    $linkPhoto = "images/building/$id/" . $roomPicValue['photo_name'];
                    if(!file_exists($linkPhoto)){
                        $linkPhoto = "images/show.png";
                    }
                }else{
                    $linkPhoto = "images/show.png";
                }
                $arrRoomData[] = array(
                    'id' => $roomPicValue['id'],
                    'photo_name' => $roomPicValue['photo_name'],
                    'link_photo' => $linkPhoto,
                    'roomtype_name' => $roomType2siteData->getRoomTypename(),
                    'room_size' => $roomType2siteData->getRoomsize(),
                    'room_price' => $roomType2siteData->getRoomprice(),
                );
            }
            $arrGalleryData = NULL;
            foreach ($arrGallery as $key => $galleryPicValue) {

                if(!empty($galleryPicValue['photo_name']))
                {
                    $linkPhoto = "images/building/$id/" . $galleryPicValue['photo_name'];
                    if(!file_exists($linkPhoto)){
                        $linkPhoto = "images/show.png";
                    }
                }else{
                    $linkPhoto = "images/show.png";
                }
                $arrGalleryData[] = array(
                    'id' => $galleryPicValue['id'],
                    'photo_name' => $galleryPicValue['photo_name'],
                    'link_photo' => $linkPhoto,
                    'description' => $galleryPicValue['description'],
                );
            }
            /*echo "<pre>";
                   var_dump($arrgallerydata);
                   echo "</pre>";
                   exit();*/
            if (!empty($imageHead)) {
                $linkImageHead = "images/building/$id/" . $imageHead[0]['photo_name'];
                $nameImageHead = $imageHead[0]['photo_name'];
            }
            if (!empty($imageMap)) {
                $linkImageMap = "images/building/$id/" . $imageMap[0]['photo_name'];
                $nameImageMap = $imageMap[0]['photo_name'];
            }
            $provinceName = null;
            $provinceId = $building_data['saddrprovince'];
            if(!empty($provinceId))
            {
                $provinceName = $this->getProvinceDataAction($provinceId,'call');
            }


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
            $district = $this->getDistrictAction($provinceId, $building_data['saddrprefecture'], 'call');
            $provinceOther = $this->getProvince($provinceId, 'other');
            $nearBTS = $this->getNearly(2,$building_id);
            $nearMRT = $this->getNearly(3,$building_id);
            $nearUniversity = $this->getNearly(4,$building_id);
            $nearBy = $this->getNearly(5,$building_id);
            $nearInCountry = $this->getNearly(6,$building_id);
            /*echo "<pre>";
                   var_dump($district);
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
            'fac_inroom' => $fac_inRoomList,
            'fac_inroom_loop' => $fac_inRoomLoop,
            'fac_outroom' => $fac_outRoomList,
            'fac_outroom_loop' => $fac_outRoomLoop,
            'rooms' => $arrRoomData,
            'roomlines' => $countRoom,
            'galleries' => $arrGalleryData,
            'gellerylines' => $countGallery,
            'linkimagehead' => $linkImageHead,
            'nameimagehead' => $nameImageHead,
            'linkimagemap' => $linkImageMap,
            'nameimagemap' => $nameImageMap,
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
								where deleted = 0 and building_site_id = '$buildid'
									and photo_type = '$type'
									or roomtype2site_id = '$roomtype2siteid'
									";
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

    public function getFacility($type,$dataType=null)
    {
        $fac_inRoomList = NULL;
        $fac_outRoomList = NULL;
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
                $facList_inRoom = $conn->fetchAll($sql);
                $countAll_inRoom = count($facList_inRoom);
                if($dataType=='loop')
                {
                    foreach ($facList_inRoom as $key => $value) {
                        $fac_ListReturn[] = array(
                            'id' => 'fac'.$value['id'],
                        );
                    }
                }
                else
                {
                    foreach ($facList_inRoom as $key => $value) {
                        $count = $key + 1;
                        $list[] = array(
                            'id' => $value['id'],
                            'facility_name' => $value['facility_name'],
                            'facility_type' => $value['facility_type'],
                            'value' => $value['id'],
                        );
                        if ($count % 4 == 0) {
                            $fac_inRoomList[] = array('loop' => $list);
                            $list = NULL;
                        } elseif ($count == $countAll_inRoom) {
                            $fac_inRoomList[] = array('loop' => $list);
                            $list = NULL;
                        }
                    }
                    $fac_ListReturn = $fac_inRoomList;
                }
            } elseif ($type == 'outroom') {
                /**
                 * query for facility list outroom type
                 */
                $sql = "select * from facilitylist where facility_type = '$type' and display = 1";
                $facList_outRoom = $conn->fetchAll($sql);
                $countAll_outRoom = count($facList_outRoom);
                if($dataType=='loop')
                {
                    foreach ($facList_outRoom as $key => $value) {
                        $fac_ListReturn[] = array(
                            'id' => 'fac'.$value['id'],
                        );
                    }
                }
                else
                {
                    foreach ($facList_outRoom as $key => $value) {
                        $count = $key + 1;
                        $list[] = array(
                            'id' => $value['id'],
                            'facility_name' => $value['facility_name'],
                            'facility_type' => $value['facility_type'],
                            'value' => $value['id'],
                        );
                        if ($count % 4 == 0) {
                            $num = 4;
                            if ($count == $countAll_outRoom) {
                                $fac_outRoomList[] = array('loop' => $list, 'stat' => 'end', 'count' => $num);
                            } else {
                                $fac_outRoomList[] = array('loop' => $list, 'stat' => 'not', 'count' => $num);
                            }
                            $list = NULL;
                        } elseif ($count == $countAll_outRoom) {
                            $countList = count($list);
                            $num = 4 - $countList;
                            $fac_outRoomList[] = array('loop' => $list, 'stat' => 'end', 'count' => $num);
                            $list = NULL;
                        }
                    }
                    $fac_ListReturn = $fac_outRoomList;
                }
                /*echo "<pre>";
                        var_dump($fac_listreturn);
                        echo "</pre>";exit();*/
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $fac_ListReturn;
    }

    public function saveDataAction($id)
    {
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $session = $this->get('session');
        $user = $session->get('user');

        $logger = new LoggerHelper();

        if ($_POST) {
            $post_array = $_POST;
            $buildingData = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id' => $id));
            if(!empty($buildingData))
            {
                $publish = $buildingData->getPublish();
            }
            if($publish!=1)
            {
                $buildingData->setPublish(2);
                $em->flush();
                $logger->addInfo('User '.$user.' update building');
            }
        }
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
            $first_name = $_POST['fname'];
            $last_name = $_POST['lname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            //$password = $_POST['password'];
            $confirmPass = $_POST['cpassword'];
            $tel_number = $_POST['tel'];

            $errMsg = array();
            $errMsg['tel'] = NULL;
            $errMsg['password'] = NULL;
            $errMsg['email'] = NULL;
            $errMsg['confirmpass'] = NULL;
            $errPass = NULL;
            if (!empty($confirmPass)) {
                if (strlen($confirmPass) < 8 || strlen($confirmPass) > 12) {
                    $errPass = 'รหัสผ่านต้องมี 8 อักษร และไม่เกิน 12 อักษร';
                }

                if (!preg_match("#[a-z]+#", $confirmPass)) {
                    $errPass = 'รหัสผ่านต้องมีอักษรอย่างน้อย 1 ตัว';
                }

                if (!empty($errPass)) {
                    $errMsg['password'] = 'ผิดพลาด!:' . $errPass;
                }

                $toEmail = trim($email);
                $fixMail = str_replace(' ', '', $toEmail);
                if (!filter_var($fixMail, FILTER_VALIDATE_EMAIL)) {
                    $errMsg['email'] = 'ผิดพลาด!:email ไม่ถูกต้อง';
                }

                if (strlen($tel_number) < 9) {
                    $errMsg['tel'] = 'ผิดพลาด!:หมายเลขโทรศัพท์ไม่ถูกต้อง';
                }

                if (!empty($errMsg['password']) || !empty($errMsg['email']) || !empty($errMsg['tel'])) {
                    return $this->indexAction($errMsg);
                } else {

                    $session = $this->get('session');
                    $user = $session->get('user');
                    $userOwner = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username' => $user));
                    $confirmPassMD5 = md5($confirmPass);
                    $passwordUser = $userOwner->getPassword();
                    if($confirmPassMD5=$passwordUser)
                    {
                        $userOwner->setUsername($username);
                        $userOwner->setFirstname($first_name);
                        $userOwner->setLastname($last_name);
                        $userOwner->setEmail($toEmail);
                        $userOwner->setPhoneNumber($tel_number);
                        $em->flush();
                    }

                    $session->set('user', $username);
                    return $this->redirect($this->generateUrl('userbuilding'));
                }
            } else {
                $errMsg['confirmpass'] = 'ไม่ได้กรอกยืนยันรหัสผ่าน';
                return $this->indexAction($errMsg);
            }
        }
        $errMsg['confirmpass'] = 'ไม่ได้กรอกยืนยันรหัสผ่าน';
        return $this->indexAction($errMsg);
    }

    public function changePassUserProfileAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $session = $this->get('session');
        $user = $session->get('user');
        if(!empty($user))
        {
            $userOwner = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username' => $user));
            if($_POST){
                $newPassword = @$_POST['newpass'];
                $savePassword = md5($newPassword);
                $userOwner->setPassword($savePassword);
                $em->flush();
            }else{
                return $this->render('FTRWebBundle:Userbuilding:changepass.html.twig', array());
            }
        }
        exit();
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
            $arrImageData = NULL;
            if ($type == 'image') {
                $iCountLineRoom = trim(@$_POST['hdnMaxLine']);
                $iCountLineGallery = trim(@$_POST['hdnMaxLineGal']);
                if (!empty($_POST['hdnfilename'])) {
                    $sHeadImageName = trim(@$_POST['hdnfilename']);
                    $arrImageData[] = array(
                        'photo_name' => $sHeadImageName,
                        'photo_type' => 'head',
                        'sequence' => 0,
                    );
                }

                if (!empty($_POST['hdnfilemap'])) {
                    $sMapImageName = trim(@$_POST['hdnfilemap']);
                    $arrImageData[] = array(
                        'photo_name' => $sMapImageName,
                        'photo_type' => 'map',
                        'sequence' => 0,
                    );
                }

                for ($i = 0; $i < $iCountLineRoom; $i++) {
                    if (!empty($_POST["hdnfilename$i"]) || !empty($_POST["typeap_name$i"]) || !empty($_POST["typeap_size$i"]) || !empty($_POST["typeap_price$i"])) {
                        $arrImageData[] = array(
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

                for ($i = 0; $i < $iCountLineGallery; $i++) {
                    if (!empty($_POST["hdngalleryname$i"]) || !empty($_POST["galtitle$i"])) {
                        $arrImageData[] = array(
                            'imageid' => trim(@$_POST["imageidgal$i"]),
                            'photo_name' => trim(@$_POST["hdngalleryname$i"]),
                            'description' => trim(@$_POST["galtitle$i"]),
                            'photo_type' => 'gallery',
                            'sequence' => $i,
                        );
                    }
                }

                $alert = $this->saveImageData($id, $arrImageData);
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
                );

                $alert = $this->saveBuildingData($id, $arrbuilding_data);
                echo $alert;
            }
            elseif ($type == 'other') {
                if(!empty($_POST['fac'])){
                    $facilityList = @$_POST['fac'];
                    $alert = $this->saveFacilityData($id, $facilityList);
                }
                if(!empty($_POST['bkzone_ot'])){
                    $zoneLocation = @$_POST['bkzone_ot'];
                }else{
                    $zoneLocation = null;
                }
                if(!empty($_POST['near_ot'])){
                    $nearLocation = @$_POST['near_ot'];
                }else{
                    $nearLocation = null;
                }
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
                    $image->setDeleted(0);
                    if ($value['photo_type'] == 'room') {
                        $roomtype2siteid = $this->saveRoomtypeData($id, $data, NULL);
                    }
                    $image->setRoomtype2siteId($roomtype2siteid);
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($image);
                    $em->flush();
                } else {
                    $oldImageName = $imageValue->getPhotoName();
                    if($oldImageName!=''){
                        $pathImage = $this->getPathUpload($id);
                        $path = $pathImage . "/" . $oldImageName;

                        if (file_exists($path)) {
                            if ($photo_name != $oldImageName) {
                                unlink($path);
                            }
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
            if(is_numeric(trim($data['room_size']))){
                $roomtype2site->setRoomsize(trim($data['room_size']));
            }else{
                $roomtype2site->setRoomsize(0);
            }
            if(is_numeric(trim($data['room_price']))){
                $roomtype2site->setRoomprice(trim($data['room_price']));
            }else{
                $roomtype2site->setRoomprice(0);
            }
            $em->persist($roomtype2site);
            $em->flush();

            $roomtype2siteid = $roomtype2site->getId();
        } else {
            $roomtype2sitedata->setRoomTypename(trim($data['typename']));
            $roomSize = trim($data['room_size']);
            if(is_numeric($roomSize)||is_float($roomSize)){
                $roomtype2sitedata->setRoomsize($roomSize);
            }
            $roomPrice = trim($data['room_price']);
            if(is_numeric($roomPrice)||is_float($roomPrice)){
                $roomtype2sitedata->setRoomprice($roomPrice);
            }


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
        //$buildingValue->setPublish(intval($arrData['publish']));
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
        $monthStay = trim($arrData['month_stay']);
        if(is_numeric($monthStay)||is_float($monthStay)){
            $buildingValue->setMonthStay($monthStay);
        }
        $waterPrice = trim($arrData['water_price']);
        if(is_numeric($waterPrice)||is_float($waterPrice)){
            $buildingValue->setWaterUnit($waterPrice);
        }
        $electricPrice = trim($arrData['electric_price']);
        if(is_numeric($electricPrice)||is_float($electricPrice)){
            $buildingValue->setElectricityUnit($electricPrice);
        }
        $internetPrice = trim($arrData['internet_price']);
        if(is_numeric($internetPrice)||is_float($internetPrice)){
            $buildingValue->setInternetPrice($internetPrice);
        }
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
        if(!empty($zone)||!empty($near)){
            if(!empty($zone)){
                $buildingValue->setZoneId($zone);
            }
            if(!empty($near)){
                $buildingValue->setNearlyPlace($near);
            }
            $em->flush();
        }

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
        if(!empty($arrData['bts']))
        {
            $nearlyLocation = new Nearly2site();
            $nearlyLocation->setBuildingSiteId($id);
            $nearlyLocation->setNearlyLocationId($arrData['bts']);
            $nearlyLocation->setDeleted(0);
            $em->persist($nearlyLocation);
        }
        if(!empty($arrData['mrt']))
        {
            $nearlyLocation = new Nearly2site();
            $nearlyLocation->setBuildingSiteId($id);
            $nearlyLocation->setNearlyLocationId($arrData['mrt']);
            $nearlyLocation->setDeleted(0);
            $em->persist($nearlyLocation);
        }
        if(!empty($arrData['university']))
        {
            $nearlyLocation = new Nearly2site();
            $nearlyLocation->setBuildingSiteId($id);
            $nearlyLocation->setNearlyLocationId($arrData['university']);
            $nearlyLocation->setDeleted(0);
            $em->persist($nearlyLocation);
            $em->flush();
        }
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
        $all[] = array('PROVINCE_ID' => '0', 'PROVINCE_NAME' => '- กรุณาระบุ -', 'checked' => 'no');
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
                      PROVINCE_ID AS PROVINCE_ID,
                      PROVINCE_NAME AS PROVINCE_VALUE,
                      PROVINCE_NAME AS PROVINCE_NAME,
                      PROVINCE_NAME AS OrderBy,
                      'yes' AS checked
                    FROM
                      province
                    WHERE PROVINCE_ID LIKE '%$provinceName%'
                          $sqlPlus
                    UNION
                    SELECT
                      PROVINCE_ID AS PROVINCE_ID,
                      PROVINCE_NAME AS PROVINCE_VALUE,
                      PROVINCE_NAME AS PROVINCE_NAME,
                      PROVINCE_NAME AS OrderBy,
                      'no' AS checked
                    FROM
                      province
                    WHERE PROVINCE_ID NOT LIKE '%$provinceName%'
                          $sqlPlus
                    ORDER BY OrderBy ASC
                ";
            } else {
                $sql = "
                    SELECT
                      PROVINCE_ID AS PROVINCE_ID,
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

    public function getProvinceDataAction($province,$type=null)
    {
        $conn = $this->get('database_connection');
        $result_data = array();

            if (!$conn) {
                    die("MySQL Connection error");
                }
            try {

                $sql = "
                    SELECT
                      PROVINCE_NAME
                    FROM
                      province
                    WHERE
                      province_id = $province
                ";
                $result_data = $conn->fetchAll($sql);

            }  catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }
        if($type=='call'){
            return $result_data[0]['PROVINCE_NAME'];
        }else{
            echo $result_data[0]['PROVINCE_NAME'];
        }
        exit();
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
                echo "<option value=\"" . $amphur[$key]['AMPHUR_ID'] . "\">" . $amphur[$key]['AMPHUR_NAME'] . "</option>";
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
        $all[] = array('AMPHUR_ID' => 0, 'AMPHUR_NAME' => ' - กรุณาระบุ - ', 'checked' => 'no');
        $whereQuery = NULL;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sqlPlus = null;
            $sqlPlus2 = null;
            if (!empty($district)) {
                $sqlPlus = "AMPHUR_ID NOT LIKE '%$district%'
                      AND";
                $sqlPlus2 = "AMPHUR_ID LIKE '%$district%'
                      AND";
            }
            if (!empty($province)) {
                if (!empty($district)) {
                    $sql = "
                        (SELECT
                          AMPHUR_ID AS AMPHUR_ID,
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
                          WHERE province_id LIKE '%$province%'))
                        UNION
                        (SELECT
                          AMPHUR_ID AS AMPHUR_ID,
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
                          WHERE province_id LIKE '%$province%'))
                        ORDER BY OrderBy ASC
                    ";
                } else {
                    $sql = "
                        SELECT
                          AMPHUR_ID AS AMPHUR_ID,
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
                          WHERE province_id LIKE '%$province%')
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
            //echo $sql;exit();
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

    public function setDeleteImageAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        if($_GET)
        {
            $getSequence = $_GET['sequence'];
            //$getImageId = $_GET['id'];
            $getType = $_GET['type'];
            $getBuildingId = $_GET['buildingId'];

            $imageData = $em->getRepository('FTRWebBundle:Image')->findOneBy(array('building_site_id'=>$getBuildingId,'photo_type'=>$getType,'sequence'=>$getSequence));
            $photoName = $imageData->getPhotoName();

            $imageArray = $em->getRepository('FTRWebBundle:Image')->findBy(array('building_site_id'=>$getBuildingId,'photo_type'=>$getType));
            $count = 0;
            foreach($imageArray as $key => $value)
            {
                $imageName = $value->getPhotoName();
                if($photoName==$imageName)
                {
                    $pathFolder = $this->getPathUpload($getBuildingId);
                    $path = $pathFolder.'/'.$photoName;

                    $roomType2siteId = $value->getRoomtype2siteId();
                    if(!empty($roomType2siteId)){
                        $roomType2siteData = $em->getRepository('FTRWebBundle:Roomtype2site')->findOneBy(array('id'=>$roomType2siteId));
                        $em->remove($roomType2siteData);
                    }
                    $this->deleteFile($path);
                    $em->remove($value);
                }
                else{
                    $value->setSequence($count);
                    $count++;
                }
                $em->flush();
            }
        }
        exit();
    }
    public function deleteFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}