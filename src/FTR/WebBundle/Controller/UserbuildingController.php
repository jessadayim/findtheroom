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

    public function indexAction($error_msg = null)
    {
        $session = $this->get('session');
        $username = $session->get('user');
        $objSQL1 = null;
        if (empty($username)) {
            return $this->redirect($this->generateUrl('FTRWebBundle_regis'));
        }

        if (empty($errormsg)) { //Default error messeges
            $error_msg = array('email' => null, 'password' => null, 'tel' => null, 'confirmpass' => 'ต้องใส่ยืนยันรหัสก่อนบันทึก');
        }
        $conn = $this->get('database_connection');
        $enabled = null;
        $arrData = null;
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

        return $this->render('FTRWebBundle:Userbuilding:listap.html.twig', array('firstname' => $objSQL1[0]['firstname'], 'lastname' => $objSQL1[0]['lastname'], 'username' => $objSQL1[0]['username'], 'email' => $objSQL1[0]['email'], 'password' => $objSQL1[0]['password'], 'phone_number' => $objSQL1[0]['phone_number'], 'errormsg' => $error_msg,));
    }

    public function listApartmentAction()
    {
        $session = $this->get('session');
        $username = $session->get('user');
        $itemCount = null;

        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        $enabled = null;
        $arrData = null;
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql1 = "SELECT * FROM user_owner WHERE username = '" . $username . "'";
            $objSQL1 = $conn->fetchAll($sql1);
            $enabled = $objSQL1[0]['enabled'];

            $getTextSearch = null;

            if ($_GET) {
                //get data
                $getSelectPage = @$_GET['numPage'];
                $getRecord = @$_GET['record'];
                $getTextSearch = @$_GET['textSearch'];
                $getOrderBy = @$_GET['orderBy'];
                $getOrderByType = @$_GET['orderByType'];
            }

            $sql2 = "
                select
                 *,
                 trim(p.PROVINCE_NAME) as PROVINCE_NAME,
                 trim(a.AMPHUR_NAME) as AMPHUR_NAME
                from
                 building_site b
                 left join province p on(b.addr_province=p.PROVINCE_ID)
                 left join amphur a on(b.addr_prefecture=a.AMPHUR_ID)
                where b.deleted !=1 AND
                 b.user_owner_id = '" . $objSQL1[0]['id'] . "'
            ";
            //set paging
            $page = 1;
            if (!empty($getSelectPage)) {
                $page = $getSelectPage;
            }
            $limit = 10;
            $midRange = 5;
            if (!empty($getRecord)) {
                $limit = $getRecord;
            } else {
                $getRecord = $limit;
            }
            $offset = $limit * $page - $limit;

            if (empty($getOrderBy) && empty($getOrderByType)) {
                $getOrderBy = 'id';
                $getOrderByType = 'asc';
            }
            if (!empty($getTextSearch) && $getTextSearch != '') {
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
                } else {
                    $publish = "รอการยืนยัน";
                }
                if (empty($value['PROVINCE_NAME'])) {
                    $value['PROVINCE_NAME'] = 'nodata';
                }

                if (empty($value['AMPHUR_NAME'])) {
                    $value['AMPHUR_NAME'] = 'nodata';
                }
                $arrData[] = array('id' => $value['id'], 'building_name' => $value['building_name'], 'slug' => $value['slug'], 'PROVINCE_NAME' => $value['PROVINCE_NAME'], 'AMPHUR_NAME' => $value['AMPHUR_NAME'], 'publish' => $publish,);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        //var_dump($sql2);exit();
        $paging = new Paginator($itemCount, $offset, $limit, $midRange);
        return $this->render('FTRWebBundle:Userbuilding:list_table.html.twig', array('build_data' => $arrData, 'paginator' => $paging, 'countList' => $itemCount, 'enabled' => $enabled, 'limit' => $limit, 'noPage' => $page, 'record' => $getRecord, 'textSearch' => $getTextSearch, 'orderBy' => $getOrderBy, 'orderByType' => $getOrderByType));
    }

    public function addDataAction($id = null)
    {

        // username & password ในการแก้ไขห้องพัก
        $username = @$_POST['bName'];
        $password = @$_POST['bPassword'];

        $fac_inRoomList = null;
        $fac_outRoomList = null;
        $arrRoom = null;
        $arrGallery = null;
        $countRoom = 0;
        $countGallery = 0;
        $building_data = null;
        $arrZone = null;
        $session = $this->get('session');
//        $user = $session->request('user');
        $user = @$_POST["user"];
        $building_id = null;
        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            // $userData = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username' => $user));
            // // เช็คถ้าไม่มีให้ redirect
            // if (empty($userData)) {
                // return $this->redirect($this->generateUrl('FTRWebBundle_publish'));
            // }

            // $enabled = $userData->getEnabled();
            // if (empty($enabled)) {
                // return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
            // }
            $building_data = $this->getBuildingData($id);
            if (!empty($id)) {
                $building_id = $id;
                if ($building_data['izoneid'] != 0) {
                    $zone_data = $em->getRepository('FTRWebBundle:Zone')->findOneBy(array('id' => $building_data['izoneid']));
                    //var_dump($zone_data);exit();
                    $arrZone[] = array('id' => $zone_data->getId(), 'zonename' => $zone_data->getZonename(), 'latitude' => $zone_data->getLatitude(), 'longitude' => $zone_data->getLongitude(), 'deleted' => $zone_data->getDeleted(), 'checked' => 'yes',);
                }
                if ($building_data['ipaytypeid'] != 0) {
                    $payType_data = $em->getRepository('FTRWebBundle:Pay_type')->findOneBy(array('id' => $building_data['ipaytypeid']));
                }

            } else {
                return $this->redirect($this->generateUrl('addNewBuildData'), 301);
            }
            $linkImageHead = null;
            $nameImageHead = null;
            $linkImageMap = null;
            $nameImageMap = null;
            $fac_inRoomList = $this->getFacility('inroom');
            $fac_inRoomLoop = $this->getFacility('inroom', 'loop');
            $fac_outRoomList = $this->getFacility('outroom');
            $fac_outRoomLoop = $this->getFacility('outroom', 'loop');
            $arrRoom = $this->getImageData($building_id, null, 'room');
            $arrGallery = $this->getImageData($building_id, null, 'gallery');
            $imageHead = $this->getImageData($building_id, null, 'head');
            $imageMap = $this->getImageData($building_id, null, 'map');
            $sqlFacilityListP = null;
            if (!empty($building_id)) {
                $sqlFacilityListP = "
                 and building_site_id = $building_id
                ";
            }
            $sqlFacilityList = "select facilitylist_id from facility2site where deleted = 0 $sqlFacilityListP";
            $facFetch = $conn->fetchAll($sqlFacilityList);
            $facArray = null;
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

            $arrRoomData = null;
            foreach ($arrRoom as $key => $roomPicValue) {
                $roomType2site_id = $roomPicValue['roomtype2site_id'];
                $roomType2siteData = $em->getRepository('FTRWebBundle:Roomtype2site')->findOneBy(array('id' => $roomType2site_id));
                if (!empty($roomPicValue['photo_name'])) {
                    $linkPhoto = "images/building/$id/" . $roomPicValue['photo_name'];
                    if (!file_exists($linkPhoto)) {
                        $linkPhoto = "images/show.png";
                    }
                } else {
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
            $arrGalleryData = null;
            foreach ($arrGallery as $key => $galleryPicValue) {

                if (!empty($galleryPicValue['photo_name'])) {
                    $linkPhoto = "images/building/$id/" . $galleryPicValue['photo_name'];
                    if (!file_exists($linkPhoto)) {
                        $linkPhoto = "images/show.png";
                    }
                } else {
                    $linkPhoto = "images/show.png";
                }
                $arrGalleryData[] = array('id' => $galleryPicValue['id'], 'photo_name' => $galleryPicValue['photo_name'], 'link_photo' => $linkPhoto, 'description' => $galleryPicValue['description'],);
            }
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
            if (!empty($provinceId)) {
                $provinceName = $this->getProvinceDataAction($provinceId, 'call');
            }

            $payType = $this->getPayType($building_data['ipaytypeid']);
            if (!empty($zone_data)) {
                $bkkZone = $this->getBkkZone($zone_data->getId());
                $bkkZone = array_merge($arrZone, $bkkZone);
                // รวม array ของโซนในกรุงเทพ
            } else {
                $bkkZone = $this->getBkkZone();
            }

            $buildingType = $this->getBuildingType($building_data['ibuildingtypeid']);
            $province = $this->getProvince($building_data['saddrprovince'], null);
            $district = $this->getDistrictAction($provinceId, $building_data['saddrprefecture'], 'call');
            $provinceOther = $this->getProvince($provinceId, 'other');
            $nearBTS = $this->getNearly(2, $building_id);
            $nearMRT = $this->getNearly(3, $building_id);
            $nearUniversity = $this->getNearly(4, $building_id);
            $nearBy = $this->getNearly(5, $building_id);
            $nearInCountry = $this->getNearly(6, $building_id);
            /*echo "<pre>";
             var_dump($district);
             echo "</pre>";
             exit();*/
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
		
		$countImage = $this->getNumberImage($id);

        //ดึงค่า email จาก building_site มาตรวจสอบกับข้อมูลที่กรอกเข้ามา
        if($building_data['scontactemail'] == $username and $building_data['sPasswordUpdateBuilding'] == $password)
        {
            $editValidate = true;
//                    echo "<H1>".$editValidate."</H1><br/>";
//                    echo "confirm code : ".$building_data['scontactemail'];echo "<br/>";
//                    echo "username : ".$username;echo "<br/>";echo "<br/>";
//                    echo "password code : ".$building_data['sPasswordUpdateBuilding'];echo "<br/>";
//                    echo "password : ".$password;
//                    exit();
        } else {
            $editValidate = false;
//                    echo "<H1>".$editValidate."</H1><br/>";
//                    echo "confirm code : ".$building_data['scontactemail'];echo "<br/>";
//                    echo "username : ".$username;echo "<br/>";echo "<br/>";
//                    echo "password code : ".$building_data['sPasswordUpdateBuilding'];echo "<br/>";
//                    echo "password : ".$password;
//                    exit();
        }

        if($editValidate == true){
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
                'maximagenumber' => $countImage,
            ));
        } else {

            $conn = $this->get('database_connection');
            if (!$conn) {
                die("MySQL Connection error");
            }

            //get province id
            try {
                $sqlGetProvinceId = "SELECT PROVINCE_NAME FROM province WHERE PROVINCE_ID =".$building_data['saddrprovince'];
                $resultGetProvinceId = $conn->fetchAll($sqlGetProvinceId);
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }

            //get amphur id
            try {
                $sqlGetAmphurId = "SELECT AMPHUR_NAME FROM amphur WHERE AMPHUR_ID =".$building_data['saddrprefecture'];
                $resultGetAmphurId = $conn->fetchAll($sqlGetAmphurId);
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }

//            var_dump($resultGetProvinceId);exit();


            return $this->render(
                'FTRWebBundle:Main:result.html.twig',
                array(
                    "id" => $building_id,
                    "province" => $resultGetProvinceId[0]["PROVINCE_NAME"],
                    "district" => $resultGetAmphurId[0]["AMPHUR_NAME"],
                    "slug" => $building_data['sSlug'],
                )
            );
        }

    }

    public function addNewDataAction()
    {
        if ($_POST) {
            $id = $this->addNewBuilding();
            return $this->redirect($this->generateUrl('addData', array('id' => $id)), 301);
        } else {
            return $this->render('FTRWebBundle:Userbuilding:beforeAddData.html.twig');
        }
    }

    public function addNewBuilding()
    {
        $session = $this->get('session');
        $user = $session->get('user');
        $building_id = null;
        $em = $this->getDoctrine()->getEntityManager();
        $userData = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username' => $user));

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
        $building->setSlug('');
		$building->setConfirmAddBuildingToken('');
		$building->setPasswordUpdateBuilding('');
        $em->persist($building);
        $em->flush();
        $building_id = $building->getId();
        $this->getPathUpload($building_id);
        return $building_id;
    }

    public function getBuildingData($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if (!empty($id)) {
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
                'sConfirmAddBuildingToken' => $build_data->getConfirmAddBuildingToken(),
                'sPasswordUpdateBuilding' => $build_data->getPasswordUpdateBuilding(),
                'sSlug' => $build_data->getslug(),
            );
        } else {
            $arrdata = array(
                'sbuildingname' => '',
                'tbuildingaddress' => null,
                'istartprice' => null,
                'iendprice' => null,
                'sphonenumber' => null,
                'slatitude' => null,
                'slongitude' => null,
                'brecommend' => null,
                'ibuildingtypeid' => null,
                'izoneid' => null,
                'ipaytypeid' => null,
                'iuserownerid' => null,
                'tdetail' => null,
                'scontactname' => null,
                'scontactemail' => null,
                'swebsite' => null,
                'smonthstay' => null,
                'fwaterunit' => null,
                'felectrictunit' => null,
                'iinternetprice' => null,
                'igooglemapurl' => null,
                'snearlyplace' => null,
                'saddrnumber' => null,
                'saddrprefecture' => null,
                'saddrprovince' => null,
                'saddrzipcode' => null,
            );
        }
        return $arrdata;
    }

    public function getImageData($buildId = null, $roomType2SiteId = null, $type)
    {
        $imageData = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
			$orQuery = NULL;
            if (!empty($buildId)) {
            	if (!empty($roomType2SiteId)) {
            		$orQuery = "or roomtype2site_id = '$roomType2SiteId'";
            	}
                $sql = "select * from image
								where deleted = 0 and building_site_id = '$buildId'
									and photo_type = '$type'
									$orQuery
									";
                $imageData = $conn->fetchAll($sql);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $imageData;
    }

    public function getFacility($type, $dataType = null)
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
                if ($dataType == 'loop') {
                    foreach ($facList_inRoom as $key => $value) {
                        $fac_ListReturn[] = array('id' => 'fac' . $value['id'],);
                    }
                } else {
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
                if ($dataType == 'loop') {
                    foreach ($facList_outRoom as $key => $value) {
                        $fac_ListReturn[] = array('id' => 'fac' . $value['id'],);
                    }
                } else {
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
            if (!empty($buildingData)) {
                $publish = $buildingData->getPublish();
                $emailBuilding = $buildingData->getContactEmail();
                $buildingName = $buildingData->getBuildingName();

                if ($publish != 1) {
                    $buildingData->setPublish(1);
                    $em->flush();
                    $textHead = 'แจ้งการบันทึกข้อมูลเพื่อยืนยันการแสดงผล';
                    $textToSend = '"' . $textHead . '"
                    ID หอพักในฐานข้อมูล : ' . $id . '
                    หอพัก ชื่อ: ' . $buildingName . '
                    Email ติดต่อ : ' . $emailBuilding . '
                    ทำการบันทึกข้อมูลแล้ว
                    ส่งข้อมูลมาเพื่อรับการยืนยันให้แสดงผลบนเว็บ"findtheroom.com"
                    ';
                    $arrData = array('buildingId' => $id, 'buildingName' => $buildingName, 'emailBuilding' => $emailBuilding,);
                    $this->sendemailAction($emailBuilding, $textHead, $textToSend, $arrData);
                    $logger->addInfo('User ' . $user . ' update building');
                }
            }
        }
        return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
    }

    public function sendemailAction($sendFrom, $textHead, $textToSend, $arrData)
    {
        //$arrEmail = array("jessaday@sourcecode.co.th");
        $arrEmail = array("admin@findtheroom.com", "webmaster@findtheroom.com");
        foreach ($arrEmail as $key => $value) {
            $message = \Swift_Message::newInstance()
            			->setSubject("=?utf-8?B?" . base64_encode($textHead) . "?=")
            			->setFrom($sendFrom)
            			->setTo($value)
            			->addPart($textToSend)
            			->setBody($this->renderView('FTRWebBundle:Userbuilding:email.html.twig', array(
            								'buildingData' => $arrData)), 'text/html');

            $this->get('mailer')->send($message);
        }
        return "success";
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
                    if ($confirmPassMD5 == $passwordUser) {
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
        if (!empty($user)) {
            $userOwner = $em->getRepository('FTRWebBundle:User_owner')->findOneBy(array('username' => $user));
            if ($_POST) {
                $newPassword = @$_POST['newpass'];
                $savePassword = md5($newPassword);
                $userOwner->setPassword($savePassword);
                $em->flush();
            } else {
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

    /**
     * ใช้ auto update ค่าต่าง ๆ ในหน้า edit ของห้องพัก
     * @param $type
     * @param $id
     */
    public function autoSaveFormAction($type, $id)
    {
        /**
         * MICK
         * UPDATE 2013/03/20
         * ตรวจสอบการแก้ไขข้อมูลห้องพัก
         */
//        header('Content-Type: text/html; charset=utf-8');
//        echo "<pre>";
//        echo $type;exit();
//        echo "</pre>";

        $arrImageData = NULL;

        if ($_POST) {

            if ($type == 'image') {
                $iCountLineRoom = trim(@$_POST['hdnMaxLine']);
                $iCountLineGallery = trim(@$_POST['hdnMaxLineGal']);
                if (!empty($_POST['hdnfilename'])) {
                    $sHeadImageName = trim(@$_POST['hdnfilename']);
                    $arrImageData[] = array('photo_name' => $sHeadImageName, 'photo_type' => 'head', 'sequence' => 0,);
                }

                if (!empty($_POST['hdnfilemap'])) {
                    $sMapImageName = trim(@$_POST['hdnfilemap']);
                    $arrImageData[] = array('photo_name' => $sMapImageName, 'photo_type' => 'map', 'sequence' => 0,);
                }

                for ($i = 0; $i < $iCountLineRoom; $i++) {
                    if (!empty($_POST["hdnfilename$i"]) || !empty($_POST["typeap_name$i"]) || !empty($_POST["typeap_size$i"]) || !empty($_POST["typeap_price$i"])) {
                        $arrImageData[] = array(
                        	'imageid' => trim(@$_POST["imageid$i"]), 
                        	'photo_name' => trim(@$_POST["hdnfilename$i"]), 
                        	'typename' => trim(@$_POST["typeap_name$i"]), 
                        	'room_size' => trim(@$_POST["typeap_size$i"]), 
                        	'room_price' => trim(@$_POST["typeap_price$i"]), 
                        	'photo_type' => 'room', 'sequence' => $i,);
                    }
                }

                for ($i = 0; $i < $iCountLineGallery; $i++) {
                    if (!empty($_POST["hdngalleryname$i"]) || !empty($_POST["galtitle$i"])) {
                        $arrImageData[] = array(
                        	'imageid' => trim(@$_POST["imageidgal$i"]), 
                        	'photo_name' => trim(@$_POST["hdngalleryname$i"]), 
                        	'description' => trim(@$_POST["galtitle$i"]), 
                        	'photo_type' => 'gallery', 'sequence' => $i,
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

                $arrData = array(
                    $building_name,         //1
                    $building_addr,         //2
                    $province,              //3
                    $district,              //4
                    $zipCode,               //5
                    $detail,                //6
                    $longitude,             //7
                    $latitude,              //8
                    $building_type,         //9
                    $pay_type,              //10
                    $phone_number,          //11
                    $month_stay,            //12
                    $contact_name,          //13
                    $water_price,           //14
                    $contact_email,         //15
                    $electric_price,        //16
                    $website,               //17
                    $internet_price         //18
                );

                if (empty($internet_price)) {
                    $internet_price = null;
                }

                $arrBuilding_data = array(
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

                $alert = $this->saveBuildingData($id, $arrBuilding_data);
                echo $alert;

            } elseif ($type == 'other') {
                if (!empty($_POST['fac'])) {
                    $facilityList = @$_POST['fac'];
                    $alert = $this->saveFacilityData($id, $facilityList);
                }
                if (!empty($_POST['bkzone_ot'])) {
                    $zoneLocation = @$_POST['bkzone_ot'];
                } else {
                    $zoneLocation = null;
                }
                if (!empty($_POST['near_ot'])) {
                    $nearLocation = @$_POST['near_ot'];
                } else {
                    $nearLocation = null;
                }
                $arrOther = array('bts' => @$_POST['bts_ot'], 'mrt' => @$_POST['mrt_ot'], 'university' => @$_POST['univer_ot'],);
                $alert = $this->saveOtherData($id, $arrOther, $zoneLocation, $nearLocation);

                echo $alert;
            }
        }

        exit();
    }

    public function saveImageData($id, $imageData)
    {

        $em = $this->getDoctrine()->getEntityManager();
        //echo $imageData[0]['photo_name'];exit();
        foreach ($imageData as $key => $value) {
            $roomType2SiteId = NULL;
            $data = NULL;
            // set NULL value for new loop

            if (!empty($id) || !empty($value['photo_name'])) {

                $imageValue = $em->getRepository('FTRWebBundle:Image')
                				->findOneBy(array(
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
                        $roomType_name = $value['typename'];
                    } else {
                        $roomType_name = 'ยังไม่ระบุ';
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

                    $data = array('typename' => $roomType_name, 'room_size' => $room_size, 'room_price' => $room_price,);
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
                        $roomType2SiteId = $this->saveRoomtypeData($id, $data, NULL);
                    }
                    $image->setRoomtype2siteId($roomType2SiteId);
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($image);
                    $em->flush();
                } else {
                    $oldImageName = $imageValue->getPhotoName();
                    if ($oldImageName != '') {
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
                    $imageValue->setDeleted(0);

                    $roomType2SiteId = $imageValue->getRoomtype2siteId();

                    if ($value['photo_type'] == 'room') {
                        $roomType2SiteId = $this->saveRoomtypeData($id, $data, $roomType2SiteId);
                    }
                    $imageValue->setRoomtype2siteId($roomType2SiteId);

                    $em->flush();
                }
            }
        }
        return 'complete';
    }

    public function saveRoomtypeData($buildingid, $data, $roomtype2siteid)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $roomtype2sitedata = $em->getRepository('FTRWebBundle:Roomtype2site')
        						->findOneBy(array('building_site_id' => $buildingid, 'id' => $roomtype2siteid));
        if (empty($roomtype2sitedata)) {
            $roomtype2site = new Roomtype2site();
            $roomtype2site->setRoomTypename($data['typename']);
            $roomtype2site->setBuildingSiteId($buildingid);
            if (is_numeric(trim($data['room_size']))) {
                $roomtype2site->setRoomsize(trim($data['room_size']));
            } else {
                $roomtype2site->setRoomsize(0);
            }
            if (is_numeric(trim($data['room_price']))) {
                $roomtype2site->setRoomprice(trim($data['room_price']));
            } else {
                $roomtype2site->setRoomprice(0);
            }
			$roomtype2site->setDeleted(0);
            $em->persist($roomtype2site);
            $em->flush();

            $roomtype2siteid = $roomtype2site->getId();
        } else {
            $roomtype2sitedata->setRoomTypename(trim($data['typename']));
            $roomSize = trim($data['room_size']);
            if (is_numeric($roomSize) || is_float($roomSize)) {
                $roomtype2sitedata->setRoomsize($roomSize);
            }
            $roomPrice = trim($data['room_price']);
            if (is_numeric($roomPrice) || is_float($roomPrice)) {
                $roomtype2sitedata->setRoomprice($roomPrice);
            }
			$roomtype2sitedata->setDeleted(0);

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
        $arrPrice = array('startPrice' => $minPrice, 'endPrice' => $maxPrice,);
        return $arrPrice;
    }

    public function saveBuildingData($id, $arrData, $stat = null)
    {
        $session = $this->get('session');
        $username = $session->get('user');
        $today = new \DateTime('now');

        //$now = $today->format('Y-m-d H:i:s');
        //echo $now->format('Y-m-d H:i:s');exit();
        $em = $this->getDoctrine()->getEntityManager();
        if (!empty($id) || $id != '') {
            $buildingValue = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id' => $id));
        } else {
            $buildingValue = new Building_site();
            $buildingValue->setUserOwnerId(0);
        }
        if (!empty($id) || $id != '') {
            $buildingValue = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id' => $id));
        } else {
            $buildingValue = new Building_site();
            $buildingValue->setUserOwnerId(0);
        }
        $buildingValue->setBuildingName($arrData['building_name']);
        $dataSlug = str_replace(' ', '-', $arrData['building_name']);
        $buildingValue->setSlug($dataSlug);
        $buildingValue->setBuildingAddress($arrData['building_addr']);

        $returnValue = $this->saveMinMaxRoomPrice($id);
        $buildingValue->setStartPrice($returnValue['startPrice']);
        $buildingValue->setEndPrice($returnValue['endPrice']);
        $buildingValue->setPhoneNumber($arrData['phone_number']);
		if(!empty($arrData['publish'])) {
        	$buildingValue->setPublish($arrData['publish']);
		}
        $buildingValue->setLastupdate($today);
        $buildingValue->setUserupdate($username);
        $buildingValue->setLatitude($arrData['latitude']);
        $buildingValue->setLongitude($arrData['longitude']);
        $buildingValue->setBuildingTypeId($arrData['building_type']);
        /*$buildingValue->setZoneId($arrData['']);*/

        //ตรวจสอบค่า zone id
        $buildingZoneId = $buildingValue->getZoneId($arrData['province'], $arrData['district']);

        $buildingValue->setZoneId($buildingZoneId);
        $buildingValue->setPayTypeId($arrData['pay_type']);
        $buildingValue->setDetail($arrData['detail']);
        $buildingValue->setContactName($arrData['contact_name']);
        $buildingValue->setContactEmail($arrData['contact_email']);
        $buildingValue->setWebsite($arrData['website']);
		$buildingValue->setDeleted(0);
        $monthStay = trim($arrData['month_stay']);
        if (is_numeric($monthStay) || is_float($monthStay)) {
            $buildingValue->setMonthStay($monthStay);
        }
        $waterPrice = trim($arrData['water_price']);
        if (is_numeric($waterPrice) || is_float($waterPrice)) {
            $buildingValue->setWaterUnit($waterPrice);
        }
        $electricPrice = trim($arrData['electric_price']);
        if (is_numeric($electricPrice) || is_float($electricPrice)) {
            $buildingValue->setElectricityUnit($electricPrice);
        }
        $internetPrice = trim($arrData['internet_price']);
        if (is_numeric($internetPrice) || is_float($internetPrice)) {
            $buildingValue->setInternetPrice($internetPrice);
        }
        $buildingValue->setAddrPrefecture($arrData['district']);
        $buildingValue->setAddrProvince($arrData['province']);
        $buildingValue->setAddrZipcode($arrData['zipcode']);

        $arrBuildingData = array(
            "province" => $arrData['province'],
            "district" => $arrData['district'],


        );

        var_dump($arrBuildingData);

		if ($stat == 'add') {
			$buildingValue->setConfirmAddBuildingToken('');
			$buildingValue->setPasswordUpdateBuilding('');
		}
        if (empty($id) || $id == '') {
            $em->persist($buildingValue);
        }
        $em->flush();
        if ($stat == 'add') {
            $building_Id = $buildingValue->getId();
            return $building_Id;
        } else {
            return "complete";
        }
    }

    public function saveOtherData($id, $arrData, $zone, $near)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $buildingValue = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id' => $id));
        if (!empty($zone) || !empty($near)) {
            if (!empty($zone)) {
                $buildingValue->setZoneId($zone);
            }
            if (!empty($near)) {
                $buildingValue->setNearlyPlace($near);
            }
            $em->flush();
        }

        $nearlyValue = $em->getRepository('FTRWebBundle:Nearly2site')->findBy(array('building_site_id' => $id));

        if (!empty($nearlyValue)) {
            foreach ($nearlyValue as $key => $data) {
                $em->remove($data);
            }
            $em->flush();
        }
        //echo "test";exit();
        $checkInput = null;
        if (!empty($arrData['bts'])) {
            $nearlyLocation = new Nearly2site();
            $nearlyLocation->setBuildingSiteId($id);
            $nearlyLocation->setNearlyLocationId($arrData['bts']);
            $nearlyLocation->setDeleted(0);
            $em->persist($nearlyLocation);
            $checkInput = 1;
        }
        if (!empty($arrData['mrt'])) {
            $nearlyLocation = new Nearly2site();
            $nearlyLocation->setBuildingSiteId($id);
            $nearlyLocation->setNearlyLocationId($arrData['mrt']);
            $nearlyLocation->setDeleted(0);
            $em->persist($nearlyLocation);
            $checkInput = 2;
        }
        if (!empty($arrData['university'])) {
            $nearlyLocation = new Nearly2site();
            $nearlyLocation->setBuildingSiteId($id);
            $nearlyLocation->setNearlyLocationId($arrData['university']);
            $nearlyLocation->setDeleted(0);
            $em->persist($nearlyLocation);
            $checkInput = 3;
        }
        if (!empty($checkInput)) {
            // if nearly is not null
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
            $facilityValue = $em->getRepository('FTRWebBundle:Facility2site')->findOneBy(array(
            					'facilitylist_id' => intval($value), 
            					'building_site_id' => $buildingSiteId));
            
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

    function getBkkZone($id = 0)
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
        if (empty($id)) {
            $all[] = array('id' => 0, 'zonename' => '- กรุณาระบุ -', 'checked' => 'no');
            $result = array_merge($all, $result_data);
        } else {
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
                case 'other' :
                    $sqlPlus = " AND PROVINCE_NAME NOT LIKE '%กรุงเทพมหานคร%'";
                    $sqlPlus2 = "WHERE PROVINCE_NAME NOT LIKE '%กรุงเทพมหานคร%'";
                    break;
                default :
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

    public function getProvinceDataAction($province, $type = null)
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

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        if ($type == 'call') {
            return $result_data[0]['PROVINCE_NAME'];
        } else {
            echo $result_data[0]['PROVINCE_NAME'];
        }
        exit();
    }

    public function getDistrictAction($province, $district = null, $call = null)
    {

        header('Content-Type: text/html; charset=utf-8'); // UPDATE 20130315

        //echo $province;exit();
        if ($province != null) {

            $amphur = $this->getAmphur($province, $district);

//            echo "<pre>";
//            var_dump($amphur);exit();
//            echo "</pre>";

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

//        echo $province, $district;exit();

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
                          WHERE province_id = '$province'))
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
                          WHERE province_id = '$province')
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
            if (!empty($buildingTypeId)) {
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
            } else {
                $sql = "
                    select
                      t.id,
                      t.type_name,
                      'no' as checked
                    from
                      building_type t
                ";
            }
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        if ($buildingTypeId == 0 || empty($buildingTypeId)) {
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

    function getNearly($type = 2, $buildingId)
    {
        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sqlP = null;
            $sqlP2 = null;
            if (!empty($buildingId)) {
                $sqlP = "
                 and id in
                  (select
                    nearly_location_id
                  from
                    nearly2site
                  where building_site_id = $buildingId)
                ";
                $sqlP2 = "
                 and id not in
                  (select
                    nearly_location_id
                  from
                    nearly2site
                  where building_site_id = $buildingId)
                ";
            }

            $sql = "
				select
                  id,
                  name,
                  'yes' as checked
                from
                  nearly_location
                where nearly_type_id = $type
                  $sqlP
                  union
                  select
                    id,
                    name,
                    'no' as checked
                  from
                    nearly_location
                  where nearly_type_id = $type
                    $sqlP2
                  order by id
			";
            //echo $sql;exit();
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        switch ($type) {
            case 2 :
            case 3 :
                $all[] = array('id' => 0, 'name' => ' - กรุณาระบุ - ', 'checked' => 'no');
                break;
            case 4 :
            case 5 :
            case 6 :
                $all[] = array('id' => 0, 'name' => ' - กรุณาระบุ - ', 'checked' => 'no');
                break;
        }

        $result = array_merge($all, $result_data);
        return $result;
    }

    public function setDeleteImageAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        if ($_GET) {
            $getSequence = $_GET['sequence'];
            //$getImageId = $_GET['id'];
            $getType = $_GET['type'];
            $getBuildingId = $_GET['buildingId'];

            $imageData = $em->getRepository('FTRWebBundle:Image')
            				->findOneBy(array(
            					'building_site_id' => $getBuildingId, 
            					'photo_type' => $getType, 
            					'sequence' => $getSequence));
            $photoName = $imageData->getPhotoName();

            $imageArray = $em->getRepository('FTRWebBundle:Image')
            				->findBy(array(
            					'building_site_id' => $getBuildingId, 
            					'photo_type' => $getType));
            $count = 0;
            foreach ($imageArray as $key => $value) {
                $imageName = $value->getPhotoName();
                if ($photoName == $imageName) {
                    $pathFolder = $this->getPathUpload($getBuildingId);
                    $path = $pathFolder . '/' . $photoName;

                    $roomType2siteId = $value->getRoomtype2siteId();
                    if (!empty($roomType2siteId)) {
                        $roomType2siteData = $em->getRepository('FTRWebBundle:Roomtype2site')->findOneBy(array('id' => $roomType2siteId));
                        $em->remove($roomType2siteData);
                    }
                    $this->deleteFile($path);
                    $em->remove($value);
                } else {
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

    public function deleteBuildingAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($_GET) {
            $id = $_GET['id'];
            $buildingData = $em->getRepository('FTRWebBundle:Building_site')->findOneBy(array('id' => $id));
            if (!empty($buildingData)) {
                $buildingData->setDeleted(1);
                $em->flush();
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
        exit();
    }

    public function moveFile($filename, $filenameChange, $sourceFile, $destination)
    {
        if (copy($sourceFile . $filename, $destination . $filenameChange)) {
            $delete[] = $sourceFile . $filename;
        } else {
            return false;
        }
        unlink($sourceFile . $filename);
        return true;
    }

    public function addNewAction()
    {
        $newBuildId = null;
        $checkboxStatus = null;
        $checkboxValue = @$_POST["confirmAdd"];
        if(!empty($checkboxValue)){
            $checkboxStatus = @$_POST["confirmAdd"];
        }

        $session = $this->get('session');
		if($session->get('addNewBuildId')) {
        	$newBuildId = $session->get('addNewBuildId');
		}
        $linkImageHead = null;
        $nameImageHead = null;
        $linkImageMap = null;
        $nameImageMap = null;

        $building_data = $this->getBuildingData($newBuildId);
        $provinceId = $building_data['saddrprovince'];
        $buildingType = $this->getBuildingType($building_data['ibuildingtypeid']);
        $payType = $this->getPayType($building_data['ipaytypeid']);
        $province = $this->getProvince($building_data['saddrprovince'], null);
        $provinceOther = $this->getProvince($provinceId, 'other');
        $district = $this->getDistrictAction($provinceId, $building_data['saddrprefecture'], 'call');
        $imageHead = $this->getImageData($newBuildId, null, 'head');
        $imageMap = $this->getImageData($newBuildId, null, 'map');

        if (!empty($imageHead)) {
            $linkImageHead = "images/building/$newBuildId/" . $imageHead[0]['photo_name'];
            $nameImageHead = $imageHead[0]['photo_name'];
        }
        if (!empty($imageMap)) {
            $linkImageMap = "images/building/$newBuildId/" . $imageMap[0]['photo_name'];
            $nameImageMap = $imageMap[0]['photo_name'];
        }

        return $this->render('FTRWebBundle:Userbuilding:addNew.html.twig', array(
        	'buildingdata' => $building_data,
        	'payType' => $payType,
        	'buildingType' => $buildingType, 
        	'province' => $province, 
        	'provinceOther' => $provinceOther, 
        	'district' => $district, 
        	'linkimagehead' => $linkImageHead, 
        	'nameimagehead' => $nameImageHead, 
        	'linkimagemap' => $linkImageMap, 
        	'nameimagemap' => $nameImageMap,
            'checkStatus' => $checkboxStatus
		));
    }

    public function postAddNewAction()
    {
    	$newBuildId = '';
        $session = $this->get('session');
		if($session->get('addNewBuildId')) {
        	$newBuildId = $session->get('addNewBuildId');
		}
        if ($_POST) {
            if (!empty($_POST['hdnfilename'])) {
                $sHeadImageName = trim(@$_POST['hdnfilename']);
                $arrImageData[] = array('photo_name' => $sHeadImageName, 'photo_type' => 'head', 'sequence' => 0,);
            }

            if (!empty($_POST['hdnfilemap'])) {
                $sMapImageName = trim(@$_POST['hdnfilemap']);
                $arrImageData[] = array('photo_name' => $sMapImageName, 'photo_type' => 'map', 'sequence' => 0,);
            }

            $arrData = array(
            	'building_name' => $_POST['nameap'], 
            	'building_addr' => $_POST['placeap'], 
            	'province' => $_POST['province'], 
            	'district' => $_POST['district'], 
            	'zipcode' => $_POST['zipcode'], 
            	'detail' => $_POST['placedetail'], 
            	'longitude' => $_POST['longitude'], 
            	'latitude' => $_POST['latitude'], 
            	'building_type' => $_POST['aptype'], 
            	'pay_type' => $_POST['paytype'], 
            	'phone_number' => $_POST['telnumber'], 
            	'month_stay' => $_POST['time'], 
            	'contact_name' => $_POST['contact_person'], 
            	'water_price' => $_POST['water_price'], 
            	'contact_email' => $_POST['contact_email'], 
            	'electric_price' => $_POST['power_price'], 
            	'website' => $_POST['website'], 
            	'internet_price' => $_POST['internet_price'],
            	'confirm_add_building_token' => '',
            	'publish' =>'2'
			);
            $result = $this->saveBuildingData($newBuildId, $arrData, 'add');
            if (!empty($result)) {
                $buildingId = $result;
                $this->getPathUpload($buildingId);
                $pathDestination = 'images/building/' . $buildingId . '/';
                $pathSource = 'images/building/0/';
                foreach ($arrImageData as $key => &$valueImage) {
                	$newName = $this->changeFileName($valueImage['photo_name'], $key+1);
                    $resultImageMove = $this->moveFile($valueImage['photo_name'], $newName, $pathSource, $pathDestination);
					
					$valueImage['photo_name'] = $newName;
                }
				
                $alert = $this->saveImageData($buildingId, $arrImageData);

                $session = $this->get('session');
                $session->set('addNewBuildId', $buildingId);

                return $this->redirect($this->generateUrl('addNewRoom', array('id' => $buildingId)), 301);
            } else {
                return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
            }
        } else {
            return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
        }
    }

	public function changeFileName($fileName, $no)
	{
		$fileParts = pathinfo($fileName);
		$fileextension = $fileParts['extension'];
		$nameChange = null;
		$time = date("YmdHis");
		$nameChange = $no.'-'.$time.'.'.$fileextension;
		return $nameChange;
	}

    public function addNewRoomAction($id)
    {
        $buildingId = $id;
        $session = $this->get('session');
        if (empty($id)) {
            $newBuildId = $session->get('addNewBuildId');
        }
        $arrRoom = null;
        $countRoom = 0;
        $arrRoomData = null;
        $arrRoom = $this->getImageData($buildingId, null, 'room');
        $em = $this->getDoctrine()->getEntityManager();
        $arrRoomData = null;
        foreach ($arrRoom as $key => $roomPicValue) {
            $roomType2site_id = $roomPicValue['roomtype2site_id'];
            $roomType2siteData = $em->getRepository('FTRWebBundle:Roomtype2site')->findOneBy(array('id' => $roomType2site_id));
            if (!empty($roomPicValue['photo_name'])) {
                $linkPhoto = "images/building/$id/" . $roomPicValue['photo_name'];
                if (!file_exists($linkPhoto)) {
                    $linkPhoto = "images/show.png";
                }
            } else {
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
		$countImage = $this->getNumberImage($buildingId);
        return $this->render('FTRWebBundle:Userbuilding:addImage.html.twig', array(
        	'build_id' => $buildingId, 
        	'rooms' => $arrRoomData, 
        	'roomlines' => $countRoom,
        	'maximagenumber' => $countImage,
		));
    }

    public function addNewGalleryAction($id)
    {
        $buildingId = $id;
        $session = $this->get('session');
        if (empty($id)) {
            $newBuildId = $session->get('addNewBuildId');
        }
        $em = $this->getDoctrine()->getEntityManager();
        $arrGallery = null;
        $countGallery = 0;
        $arrGallery = $this->getImageData($buildingId, null, 'gallery');
        $arrGalleryData = null;
        foreach ($arrGallery as $key => $galleryPicValue) {

            if (!empty($galleryPicValue['photo_name'])) {
                $linkPhoto = "images/building/$id/" . $galleryPicValue['photo_name'];
                if (!file_exists($linkPhoto)) {
                    $linkPhoto = "images/show.png";
                }
            } else {
                $linkPhoto = "images/show.png";
            }
            $arrGalleryData[] = array('id' => $galleryPicValue['id'], 'photo_name' => $galleryPicValue['photo_name'], 'link_photo' => $linkPhoto, 'description' => $galleryPicValue['description'],);
        }
		$countImage = $this->getNumberImage($buildingId);
        return $this->render('FTRWebBundle:Userbuilding:addGallery.html.twig', array(
        	'build_id' => $buildingId, 
        	'galleries' => $arrGalleryData, 
        	'gellerylines' => $countGallery,
        	'maximagenumber' => $countImage,
		));
    }

    public function addNewOtherAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        $buildingId = $id;
        $session = $this->get('session');
        if (empty($id)) {
            $newBuildId = $session->get('addNewBuildId');
        }

        $building_data = $this->getBuildingData($buildingId);
		
		$fac_inRoomList = $this->getFacility('inroom');
        $fac_inRoomLoop = $this->getFacility('inroom', 'loop');
        $fac_outRoomList = $this->getFacility('outroom');
        $fac_outRoomLoop = $this->getFacility('outroom', 'loop');
        $sqlFacilityListP = null;
        if (!empty($buildingId)) {
            $sqlFacilityListP = "
                 and building_site_id = $buildingId
                ";
        }
        $sqlFacilityList = "select facilitylist_id from facility2site where deleted = 0 $sqlFacilityListP";
        $facFetch = $conn->fetchAll($sqlFacilityList);
        $facArray = null;
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
        $provinceId = $building_data['saddrprovince'];
        if (!empty($provinceId)) {
            $provinceName = $this->getProvinceDataAction($provinceId, 'call');
        }
        if (!empty($id)) {
            $building_id = $id;
            if ($building_data['izoneid'] != 0) {
                $zone_data = $em->getRepository('FTRWebBundle:Zone')->findOneBy(array('id' => $building_data['izoneid']));
                //var_dump($zone_data);exit();
                $arrZone[] = array(
                	'id' => $zone_data->getId(), 
                	'zonename' => $zone_data->getZonename(), 
                	'latitude' => $zone_data->getLatitude(), 
                	'longitude' => $zone_data->getLongitude(), 
                	'deleted' => $zone_data->getDeleted(), 
                	'checked' => 'yes',);
            }
            if ($building_data['ipaytypeid'] != 0) {
                $payType_data = $em->getRepository('FTRWebBundle:Pay_type')->findOneBy(array('id' => $building_data['ipaytypeid']));
            }
        }
        if (!empty($zone_data)) {
            $bkkZone = $this->getBkkZone($zone_data->getId());
            $bkkZone = array_merge($arrZone, $bkkZone);
            // รวม array ของโซนในกรุงเทพ
        } else {
            $bkkZone = $this->getBkkZone();
        }
        $provinceOther = $this->getProvince($provinceId, 'other');
        $nearBTS = $this->getNearly(2, $buildingId);
        $nearMRT = $this->getNearly(3, $buildingId);
        $nearUniversity = $this->getNearly(4, $buildingId);
        $nearBy = $this->getNearly(5, $buildingId);
        $nearInCountry = $this->getNearly(6, $buildingId);
		
        return $this->render('FTRWebBundle:Userbuilding:addOther.html.twig', array(
        		'buildingdata' => $building_data, 
        		'zonelist' => $bkkZone,
        	    'provinceName' => $provinceName,
        		'nearBTS' => $nearBTS,
        		'nearMRT' => $nearMRT, 
        		'nearUniversity' => $nearUniversity, 
        		'nearBy' => $nearBy, 
        		'nearInCountry' => $nearInCountry, 
        		'build_id' => $buildingId, 
        		'fac_inroom' => $fac_inRoomList, 
        		'fac_inroom_loop' => $fac_inRoomLoop, 
        		'fac_outroom' => $fac_outRoomList, 
        		'fac_outroom_loop' => $fac_outRoomLoop,
		));
    }

	public function saveNewOtherAction($id)
	{
		if(!empty($id)) {
			$session = $this->get('session');
        	$session->remove('addNewBuildId');
        	
			return $this->redirect($this->generateUrl('FTRWebBundle_gen_confirm_code', array('id' => $id)), 301);
		} else {
			return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
		}
	}
	
	public function getLastestNumberImageAction($id)
	{
		$number = $this->getNumberImage($id);
		echo $number;
		exit();
	}
	
	private function getNumberImage($id)
	{
		$conn = $this->get('database_connection');
        
        $sqlGetLastest = "
			SELECT
			  COUNT(*) as count_number
			FROM `image`
			WHERE building_site_id = $id
        ";
        $arrFetch = $conn->fetchAll($sqlGetLastest);
		$lastest_number = 0;
		if (!empty($arrFetch)) {
			$lastest_number = $arrFetch[0]['count_number'];
		}
		return $lastest_number;
	}

    private function getZoneId($province, $district)
    {
        $conn = $this->get('database_connection');

        $sqlGetZoneId = "
            SELECT `ZONE_ID`
            FROM `amphur`
            WHERE `PROVINCE_ID` = $province AND `AMPHUR_ID` = $district
        ";
        $resultGetZoneId = $conn->fetchAll($sqlGetZoneId);
        $zoneId = $resultGetZoneId["ZONE_ID"];
        return $zoneId;
    }

}

