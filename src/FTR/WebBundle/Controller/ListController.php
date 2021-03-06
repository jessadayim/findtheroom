<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use FTR\Config\Config;

class ListController extends Controller
{

    public function indexAction()
    {
        $searchType = "shortSearch";
        $buildingType = null;
        $zone = null;
        $nearly = null;
        $textSearch = "ห้องพัก";
        $bkkPayType = null;
        $selZone = null;
        $selProvince = null;
        $lessPrice = null;
        $mostPrice = null;
        $shortSearchType = "กรุงเทพมหานคร";
        $bc = null;
        $nBts = null;
        $nMrt = null;
        $nUniversity = null;
        $inRoom = null;
        $outRoom = null;
        $inRoomQuery = null;
        $outRoomQuery = null;
        $selAmpher = null;
        $txtSearch = "";
        $result = null;
        $isAjax = "no";
        $searchTitle = null;

        //query value
        $whereQuery = null;
        $numShow = 10;
        $pageNumber = 1;
        $parameter = array();

        // post zone aaaaaa
        if ($_GET) {
            $searchType = @$_GET['searchType'];
            $buildingType = @$_GET['buildingType'];
            $zone = @$_GET['zone'];
            $nearly = @$_GET['nearly'];
            $isAjax = @$_GET['isAjax'];
            $pageNumber = @$_GET['numPage'];
        }
        if (empty($pageNumber)) {
            $pageNumber = 1;
        }
        $numStart = $numShow * $pageNumber - $numShow;
        $numStartDisplay = $numStart + 1;
        $numEnd = $numStart + $numShow;

        //display textSearch
        if (!empty($buildingType)) {
            $textSearch = $this->getBuildingTypeSearch($buildingType);
            $whereQuery .= " AND a.building_type_id = '$buildingType'";
        }
        if (!empty($nearly)) {
            $textSearch = $this->getNearlyType($nearly);
            $whereQuery .= " AND f.nearly_type_id = '$nearly'";
        }
        // end get zone

        $zoneName = urldecode(@$_GET['โซน']);
        $zoneID = $this->convertNameZoneToID($zoneName);

        /*if ($zoneName == "bkk") {
            $textSearch = "โซนในกรุงเทพฯ";
            $whereQuery .= " AND a.addr_province = 'กรุงเทพมหานคร'";
        }*/
        $shortSearchType = urldecode(@$_GET['ค้นหาจังหวัด']);

        $bkkPayTypeName = urldecode(@$_GET['ชนิด']);

        $bkkPayTypeID = $this->convertNamePayTypeToID($bkkPayTypeName);

        $buildingTypeName = urldecode(@$_GET['ประเภทหอพัก']);
        $buildingTypeID = $this->convertNameBuildingTypeToID($buildingTypeName);

        $selProvinceName = urldecode(@$_GET['จังหวัด']);
        $selProvinceID = $this->convertNameProvenceToID($selProvinceName);

        $lessPrice = urldecode(@$_GET['ราคาเริ่มต้น']);
        $mostPrice = urldecode(@$_GET['ราคาไม่เกิน']);


        // post zone
        if ($_GET) {

            //short search
            switch ($searchType) {
                case "shortSearch":
                    if ($shortSearchType == "กรุงเทพมหานคร") {
                        //$whereQuery .= " AND a.zone_id != 0";
                    } elseif ($shortSearchType == "ต่างจังหวัด") {
//                        $whereQuery .= " AND a.zone_id = 0";
                        $whereQuery .= " AND p.PROVINCE_ID != 1";
                    }

                    /*if (!empty($_GET['searchBkk'])) {
                        $shortSearchType = trim(@$_GET['searchBkk']);
                    }
                    if (!empty($_GET['searchCountry'])) {
                        $shortSearchType = trim(@$_GET['searchCountry']);
                    }*/

                    switch ($shortSearchType) {
                        case "กรุงเทพมหานคร":
                            //$zone = $this->convertNameZoneToID(htmlentities(@$_GET['โซน']));
                            //$bkkPayType = @$_GET['bkkPayType'];
                            //$buildingType = @$_GET['bkkBuildingType'];
                            //$lessPrice = @$_GET['lessPrice'];
                            //$mostPrice = @$_GET['mostPrice'];

                            if (($zoneID != 0) && (!empty($zoneID))) {
                                $whereQuery .= " AND a.zone_id = $zoneID";
                            }

                            if (!empty($bkkPayTypeID)) {
                                 $whereQuery .= " AND a.pay_type_id = $bkkPayTypeID";
                            }
                            if (($buildingTypeID != 0) && (!empty($buildingTypeID))) {
                                $whereQuery .= " AND a.building_type_id = $buildingTypeID";
                            }
                            $whereQuery .= " AND a.addr_province = 1";
                            /*if (!empty($lessPrice) && (!empty($mostPrice))) {
                                $whereQuery .= "
                                    AND (
                                        a.start_price <= $lessPrice <= end_price  or
                                        a.start_price <= $mostPrice <= end_price
                                    )
                                ";
                            }*/
                            break;
                        case "ต่างจังหวัด":
                            //$selProvince = @$_GET['selProvince'];
                            //$bkkPayType = @$_GET['bkkPayType'];
                            //$buildingType = @$_GET['bkkBuildingType'];
                            //$lessPrice = @$_GET['lessPrice'];
                            //$mostPrice = @$_GET['mostPrice'];

                            $whereQuery .= " AND a.addr_province != 1";

                            if (($selProvinceID != 0) && (!empty($selProvinceID))) {
                                $whereQuery .= " AND a.addr_province = $selProvinceID";
                            }
                            if (!empty($bkkPayTypeID)) {
                                $whereQuery .= " AND a.pay_type_id = $bkkPayTypeID";
                            }
                            if (($buildingTypeID != 0) && (!empty($buildingTypeID))) {
                                $whereQuery .= " AND a.building_type_id = $buildingTypeID";
                            }
                            break;
                    }
                    //end short search
                    break;
                case "fullSearch":
                    //echo $searchType;
                    //var_dump(@$_GET);
                    //$buildingType = @$_GET['selBuildingType'];
                    $buildingTypeID = @$_GET['selBuildingType'];

                    //$lessPrice = @$_GET['lessPrice'];
                    $mostPrice = @$_GET['mostPrice'];
                    //$bkkPayType = @$_GET['bkkPayType'];
                    $bc = @$_GET['bc'];
                    //$selProvince = @$_GET['selProvince'];
                    //$zone = $this->convertNameZoneToID(htmlentities(@$_GET['โซน']));
                    $nBts = @$_GET['nBts'];
                    $nMrt = @$_GET['nMrt'];
                    $nUniversity = @$_GET['nUniversity'];
                    $inRoom = @$_GET['inRoom'];
                    $outRoom = @$_GET['outRoom'];
                    $selAmpher = @$_GET['selAmpher'];

                    if (($buildingTypeID != 0) && (!empty($buildingTypeID))) {
                        $whereQuery .= " AND a.building_type_id = $buildingTypeID";
                    }

                    /*if (!empty($lessPrice) && (!empty($mostPrice))) {
                        $whereQuery .= "
                            AND (
                                a.start_price <= $lessPrice <= end_price  or
                                a.start_price <= $mostPrice <= end_price
                            )
                        ";
                    }*/

                    if (!empty($bkkPayTypeID)) {
                        $whereQuery .= " AND a.pay_type_id = $bkkPayTypeID";
                    }

                    if ($bc == "bkk") {
                        if (($zoneID == 0) && ($nBts == 0) && ($nMrt == 0) && ($nUniversity == 0)) {
                            $nearlyZone = null;
                            $whereQuery .= " AND a.zone_id != 0 ";
                        } else {
                            $nearlyZone = "(";
                            if ($zoneID != 0) {
                                $nearlyZone .= "'" . $zoneID . "',";
                            }

                            if ($nBts != 0) {
                                $nearlyZone .= "'" . $nBts . "',";
                            }

                            if ($nMrt != 0) {
                                $nearlyZone .= "'" . $nMrt . "',";
                            }

                            if ($nUniversity != 0) {
                                $nearlyZone .= "'" . $nUniversity . "',";
                            }
                            $nearlyZone .= "'')";
                            $whereQuery .= " AND f.id in $nearlyZone";
                            $whereQuery .= " AND a.zone_id = $zoneID";
                        }
                    } elseif ($bc == "country") {
                        $whereQuery .= "
                            AND a.zone_id = 0
                            AND a.addr_province = '$selProvinceID'
                        ";
                        if ($selAmpher != 0 && $selAmpher != null) {
                            $whereQuery .= " a.addr_prefecture = '$selAmpher'";
                        }
                    }

                    if (is_array($inRoom) == true) {
                        $inRoomQuery = " d.facilitylist_id in (";
                        foreach ($inRoom as $key => $var) {
                            if ($key == 0) {
                                $inRoomQuery .= "'" . $inRoom[$key] . "'";
                            } else {
                                $inRoomQuery .= ",'" . $inRoom[$key] . "'";
                            }
                        }
                        $inRoomQuery .= ")";
                    }
                    if (is_array($outRoom) == true) {
                        $outRoomQuery = " d.facilitylist_id in (";
                        foreach ($outRoom as $key => $var) {
                            if ($key == 0) {
                                $outRoomQuery .= "'" . $outRoom[$key] . "'";
                            } else {
                                $outRoomQuery .= ",'" . $outRoom[$key] . "'";
                            }
                        }
                        $outRoomQuery .= ")";
                    }
                    if ((is_array($inRoom) == true) && (is_array($outRoom) == true)) {
                        $whereQuery .= " AND ($inRoomQuery OR $outRoomQuery)";
                    } elseif ((is_array($inRoom) == true) && (is_array($outRoom) == false)) {
                        $whereQuery .= " AND ($inRoomQuery)";
                    } elseif ((is_array($inRoom) == false) && (is_array($outRoom) == true)) {
                        $whereQuery .= " AND ($outRoomQuery)";
                    }
                    break;
                case "txtSearch":
                    $txtSearch = trim(@$_GET['คำค้นหา']);
                    $session = $this->get('session');
                    $session->set('txtSearch', $txtSearch);
                    if (!empty($txtSearch) && $txtSearch != null && $txtSearch != '') {
                        $whereQuery .= "
                            AND (
                                 a.building_name like '%$txtSearch%' OR
                                 a.contact_name like '%$txtSearch%' OR
                                 am.`AMPHUR_NAME` like '%$txtSearch%' OR
                                 p.`PROVINCE_NAME` like '%$txtSearch%' OR
                                 b.type_name like '%$txtSearch%' OR
                                 c.typename like '%$txtSearch%' OR
                                 f.name like '%$txtSearch%'
                            )
                         ";
                    }
                    break;
                case "cateSearch":

                    // รับค่าของประเภทการค้นหา
                    $buildingTypeSearch = @$_GET['ประเภทห้องพัก'];
                    $buildingPayTypeSearch = @$_GET['ชนิดห้องพัก'];
                    $buildingNearlyBtsLocation = @$_GET['ใกล้เคียงสถานีbts'];
                    $buildingNearlyMrtLocation = @$_GET['ใกล้เคียงสถานีmrt'];
                    $buildingNearlyUniversityLocation = @$_GET['ใกล้มหาวิทยาลัย'];
                    $buildingZoneLocation = $zoneID;


                    // เงื่อนไขการค้นหาแบบประเภทห้องพัก
                    if(!empty($buildingTypeSearch)){

                        $cateSearch = trim($buildingTypeSearch);
                        $session = $this->get('session');
                        $session->set('cateSearch', $cateSearch);
                        if (!empty($cateSearch) && $cateSearch != null && $cateSearch != '') {
                            $whereQuery .= "
                            AND b.type_name like '%$cateSearch%'
                         ";

                        $searchTitle = $cateSearch;
                        }

                    // เงื่อนไขการค้นหาแบบชนิดการจ่ายเงิน
                    } elseif(!empty($buildingPayTypeSearch)) {

                        $cateSearch = trim($buildingPayTypeSearch);
                        $session = $this->get('session');
                        $session->set('cateSearch', $cateSearch);
                        if (!empty($cateSearch) && $cateSearch != null && $cateSearch != '') {
                            $whereQuery .= "
                            AND `typename` LIKE '%$cateSearch%'
                         ";

                            $searchTitle = $cateSearch;
                        }

                    // เงื่อนไขการค้นหาใกล้สถานี BTS
                    } elseif(!empty($buildingNearlyBtsLocation)) {
                        $cateSearch = trim($buildingNearlyBtsLocation);
                        $session = $this->get('session');
                        $session->set('cateSearch', $cateSearch);
                        if (!empty($cateSearch) && $cateSearch != null && $cateSearch != '') {
                            $whereQuery .= "
                            AND `name` LIKE '%$cateSearch%'
                         ";

                            $searchTitle = "รถไฟฟ้า BTS".$cateSearch;
                        }

                    // เงื่อนไขการค้นหาใกล้สถานี MRT
                    } elseif(!empty($buildingNearlyMrtLocation)) {
                        $cateSearch = trim($buildingNearlyMrtLocation);
                        $session = $this->get('session');
                        $session->set('cateSearch', $cateSearch);
                        if (!empty($cateSearch) && $cateSearch != null && $cateSearch != '') {
                            $whereQuery .= "
                            AND `name` LIKE '%$cateSearch%'
                         ";

                            $searchTitle = "รถไฟฟ้า MRT".$cateSearch;
                        }

                    // เงื่อนไขการค้นหาใกล้มหาวิทยาลัย
                    } elseif(!empty($buildingNearlyUniversityLocation)) {
                        $cateSearch = trim($buildingNearlyUniversityLocation);
                        $session = $this->get('session');
                        $session->set('cateSearch', $cateSearch);
                        if (!empty($cateSearch) && $cateSearch != null && $cateSearch != '') {
                            $whereQuery .= "
                            AND `name` LIKE '%$cateSearch%'
                         ";

                            $searchTitle = $cateSearch;
                        }

                    // เงื่อนไขการค้นหาตามโซน
                    } elseif(!empty($buildingZoneLocation)) {
                        $cateSearch = trim($buildingZoneLocation);
                        $session = $this->get('session');
                        $session->set('cateSearch', $cateSearch);
                        if (!empty($cateSearch) && $cateSearch != null && $cateSearch != '') {
                            $whereQuery .= "
                            AND a.`zone_id` = $cateSearch
                         ";

                            $searchTitle = "โซน".$zoneName;
                        }
                    }


                    break;
            }
        }

        //parameter for short search
        $parameter['shortSearchType'] = $shortSearchType;
        $parameter['zone'] = $zoneName;
        $parameter['bkkPayType'] = $bkkPayTypeName;
        $parameter['buildingType'] = $buildingTypeName;
        $parameter['lessPrice'] = $lessPrice;
        $parameter['mostPrice'] = $mostPrice;
        $parameter['selProvince'] = $selProvinceName;
        $parameter['bc'] = $bc;
        $parameter['nBts'] = $nBts;
        $parameter['nMrt'] = $nMrt;
        $parameter['nUniversity'] = $nUniversity;
        $parameter['inRoom'] = $inRoom;
        $parameter['outRoom'] = $outRoom;
        $parameter['selAmpher'] = $selAmpher;

        //end get zone

        //setting $whereQuery

        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $selectFieldCount = "SELECT count(*) as count ";
            $selectField = "
                 SELECT
                  a.id,
                  a.slug,
                  a.building_name,
                  b.type_name,
                  c.typename,
                  a.addr_number,
                  a.addr_prefecture,
                  a.addr_province,
                  a.addr_zipcode,
                  a.detail,
                  a.start_price,
                  a.end_price,
                  a.latitude,
                  a.longitude,
                  d.facilitylist_id,
                  p.PROVINCE_NAME,
                  am.AMPHUR_NAME,
                  IF(d.`facilitylist_id` IS NULL, 0, 1) AS wifi,
                  (SELECT
                    `photo_name`
                  FROM
                    `image`
                  WHERE `building_site_id` = a.`id`
                    AND `photo_type` = 'head') AS image_head,
                  (SELECT
                    `photo_name`
                  FROM
                    `image`
                  WHERE `building_site_id` = a.`id`
                    AND `photo_type` = 'map') AS image_map
            ";
            $fromTable = "
                FROM building_site a
                    INNER JOIN building_type b ON(a.building_type_id=b.id)
                    INNER JOIN pay_type c ON(a.pay_type_id=c.id)
                    INNER JOIN province p ON(a.addr_province=p.PROVINCE_ID)
                    INNER JOIN amphur am ON(a.addr_prefecture=am.AMPHUR_ID)
                    LEFT OUTER JOIN facility2site d
                    ON (
                      d.building_site_id = a.id
                      AND d.`facilitylist_id` = 2
                      AND d.`deleted` = 0
                    )
                    LEFT OUTER JOIN nearly2site e ON (e.building_site_id = a.id)
                    LEFT OUTER JOIN nearly_location f ON (e.nearly_location_id = f.id)
            ";
            //$limitDisplay = " LIMIT $numStart , $numShow";

            $havingQuery = "";

            $orderBy = "ORDER BY a.id DESC";

            if (($lessPrice == 0 || empty($lessPrice)) && empty($mostPrice)) {
                $mostPrice = 9999999;
            }
            if (empty($lessPrice)) {
                $lessPrice = 0;
            }
            if (!empty($lessPrice) && !empty($mostPrice) || ($lessPrice <= $mostPrice)) {
                //AND start_price >= $lessPrice
                //AND end_price <= $mostPrice
                $havingQuery .= "
                    HAVING 1
                        AND (start_price BETWEEN $lessPrice AND $mostPrice)
                        OR (end_price BETWEEN $lessPrice AND $mostPrice)
                ";

                $orderBy = "ORDER BY start_price ASC";
            } elseif($lessPrice > $mostPrice) {
                $havingQuery .= "
                    HAVING 1
                        AND end_price <= $mostPrice
                ";

                $orderBy = "ORDER BY start_price ASC";
            }

            $sql = "
                $selectField
                $fromTable
                WHERE 1
                    AND a.deleted = 0
                    AND a.publish = 1
                    $whereQuery
                     GROUP BY id
                $havingQuery
                $orderBy
            ";
            $result = $conn->fetchAll($sql);

            /*
            foreach ($result as $key => $value) {
                $buildingId = $value['id'];

                $sqlWifi = "
                      SELECT `id`
                      FROM `facility2site`
                      WHERE `building_site_id` = $buildingId
                      AND `facilitylist_id` = 2
                      AND `deleted` = 0
                    ";

                $resultWifiStatus = $conn->fetchAll($sqlWifi);

                if(empty($resultWifiStatus)){
                    $resultWifiStatus = "0";
                } else {
                    $resultWifiStatus = "1";
                }

                $sqlImage = "
                    SELECT
                      a.`latitude`,
                      a.`longitude`,
                      a.`id`,
                      a.`slug`,
                      b.`building_site_id`,
                      b.`roomtype2site_id`,
                      b.`photo_name`,
                      b.`photo_type`,
                      b.`description`,
                      b.`sequence`,
                      b.`deleted`,
                      c.`PROVINCE_NAME`,
                      d.`AMPHUR_NAME`
                    FROM
                      building_site a
                      INNER JOIN image b ON (a.`id` = b.`building_site_id`)
                      INNER JOIN `province` c ON ( a.`addr_province` = c.`PROVINCE_ID` )
                      INNER JOIN `amphur` d ON (a.`addr_prefecture` = d.`AMPHUR_ID`)
                    WHERE b.`building_site_id` = $buildingId
                      AND b.`deleted` = 0
                      AND a.`addr_prefecture` > 0
                      AND a.`addr_province` > 0
                 ";
                $arrImage = $conn->fetchAll($sqlImage);
                foreach ($arrImage as $key2 => $value2) {
                    switch ($value2['photo_type']) {
                        case 'head':
                            $result[$key]['image_head'] = $value2['photo_name'];
                            break;
                        case 'map':
                            $result[$key]['image_map'] = $value2['photo_name'];
                            break;

                        default:

                            break;
                    }

                    $result[$key]['id'] = $value2['id'];
                    $result[$key]['slug'] = $value2['slug'];
                    $result[$key]['latitude'] = $value2['latitude'];
                    $result[$key]['longitude'] = $value2['longitude'];
                    $result[$key]['searchTitle'] = $searchTitle;

                }

                $result[$key]['wifi'] = $resultWifiStatus;

            }
        */
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        $numData = count($result);
        if ($numEnd > $numData) {
            $numEnd = $numData;
        }
        $countNumPage = ceil($numData / $numShow);

        $dataSetIsAjax = array(
            'result' => array_slice($result, $numStart, $numShow),
            'numData' => $numData,
            'searchType' => $searchType,
            'numStartDisplay' => $numStartDisplay,
            'numEnd' => $numEnd,
            'countNumPage' => $countNumPage,
            'parameter' => $parameter,
            'pageNumber' => $pageNumber,
            'textSearch' => $textSearch,
            'txtSearch' => $txtSearch,

        );
        //var_dump( $isAjax);
        if ($isAjax == "yes") {
            return $this->showListAction($dataSetIsAjax);
            /*return $this->render('FTRWebBundle:List:showList.html.twig',array(
                'result'            => $result,
                'numData'           => $numData,
                'searchType'        => $searchType,
                'numStartDisplay'   => $numStartDisplay,
                'numEnd'            => $numEnd,
                'parameter'         => $parameter,
                'pageNumber'        => $pageNumber,
                'textSearch'        => $textSearch,
                'txtSearch'         => $txtSearch,
            ));*/
        } else {

            // เรียกข้อมูลเบื้องต้นของ website
            $siteConfig = new Config();
            $siteConfigDetail = $siteConfig->setSiteGlobal();

            return $this->render('FTRWebBundle:List:index.html.twig',
                array(
                    'result' => $result,
                    'numData' => $numData,
                    'searchType' => $searchType,
                    'numStartDisplay' => $numStartDisplay,
                    'numEnd' => $numEnd,
                    'countNumPage' => $countNumPage,
                    'parameter' => $parameter,
                    'pageNumber' => $pageNumber,
                    'textSearch' => $textSearch,
                    'txtSearch' => $txtSearch,
                    'dataSet' => $dataSetIsAjax,
                    'siteTitle'=> $siteConfigDetail["pageListTitle"],
                    'siteDesc' => $siteConfigDetail["pageListDesc"],
                    'siteKeyword' => $siteConfigDetail["siteKeyword"],
                    'siteAuthor' => $siteConfigDetail["siteAuthor"],
                    'siteCopyRight' => $siteConfigDetail["siteCopyright"],
                    'siteRobot' => $siteConfigDetail["siteRobot"],
                    'siteRevisitAfter' => $siteConfigDetail["siteRevisitAfter"],
                    'siteDistribution' => $siteConfigDetail["siteDistribution"],
                    'siteImage' => $siteConfigDetail["siteImage"],
                    'siteUrl' => $siteConfigDetail["siteUrl"],
                    'searchTitle' => $searchTitle
                ));
        }
    }

    /**
     * @param $zoneName
     * @return int
     */
    public function convertNameZoneToID($zoneName)
    {
        $resultData = 0;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
               SELECT
                  `id`
                FROM `zone`
                WHERE 1
                  AND `zonename` LIKE '%$zoneName%'
            ";
            $result = $conn->fetchAll($sql);
            if (count($result) == 1) {
                $resultData = $result[0]['id'];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $resultData;
    }

    /**
     * @param $payTypeName
     * @return int
     */
    public function convertNamePayTypeToID($payTypeName)
    {
        $resultData = 0;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
               SELECT
                  `id`
                FROM `pay_type`
                WHERE 1
                  AND `typename` LIKE '$payTypeName'
            ";
            $result = $conn->fetchAll($sql);

//            var_dump($result);exit();

            if (count($result) == 1) {
                $resultData = $result[0]['id'];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $resultData;
    }

    /**
     * @param $buildingTypeName
     * @return int
     */
    public function convertNameBuildingTypeToID($buildingTypeName)
    {
        $resultData = 0;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
               SELECT
                  `id`
                FROM `building_type`
                WHERE 1
                  AND `type_name` LIKE '%$buildingTypeName%'
            ";
            $result = $conn->fetchAll($sql);
            if (count($result) == 1) {
                $resultData = $result[0]['id'];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $resultData;
    }

    /**
     * @param $provenceName
     * @return int
     */
    public function convertNameProvenceToID($provenceName)
    {
        $resultData = 0;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
               SELECT
                  `PROVINCE_ID`
                FROM `province`
                WHERE 1
                  AND `PROVINCE_NAME` LIKE '%$provenceName%'
            ";
            $result = $conn->fetchAll($sql);
            if (count($result) == 1) {
                $resultData = $result[0]['PROVINCE_ID'];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $resultData;
    }

    public function getBuildingTypeSearch($id)
    {
        $resultData = null;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
                SELECT
                  type_name
                FROM
                  building_type
                WHERE id = $id
            ";
            $result = $conn->fetchAll($sql);
            if (count($result) == 1) {
                $resultData = $result[0]['type_name'];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $resultData;
    }

    /**
     * @param $id
     * @return null
     */
    public function getNearlyType($id)
    {
        $resultData = null;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
                SELECT
                  label
                FROM
                  nearly_type
                WHERE id = $id
            ";
            $result = $conn->fetchAll($sql);
            if (count($result) == 1) {
                $resultData = $result[0]['label'];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $resultData;
    }

    public function showListAction($dataSet)
    {
        $result = $dataSet['result'];
        $numData = $dataSet['numData'];
        $searchType = $dataSet['searchType'];
        $numStartDisplay = $dataSet['numStartDisplay'];
        $numEnd = $dataSet['numEnd'];
        $parameter = $dataSet['parameter'];
        $pageNumber = $dataSet['pageNumber'];
        $textSearch = $dataSet['textSearch'];
        $txtSearch = $dataSet['txtSearch'];

        return $this->render('FTRWebBundle:List:showList.html.twig', array(
            'result' => $result,
            'numData' => $numData,
            'searchType' => $searchType,
            'numStartDisplay' => $numStartDisplay,
            'numEnd' => $numEnd,
            'parameter' => $parameter,
            'pageNumber' => $pageNumber,
            'textSearch' => $textSearch,
            'txtSearch' => $txtSearch,
        ));
    }
}
