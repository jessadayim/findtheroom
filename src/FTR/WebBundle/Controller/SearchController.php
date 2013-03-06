<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\AdminBundle\Helper\FTRConstant;
use FTR\Config\Config;


class SearchController extends Controller
{
    public function searchAction()
    {
// เรียกข้อมูลเบื้องต้นของ website
        $siteConfig = new Config();
        $siteConfigDetail = $siteConfig->setSiteGlobal();

        return $this->render(
            'FTRWebBundle:Search:index.html.twig',
            array(
                'siteTitle' => $siteConfigDetail["pageSearchTitle"],
                'siteDesc' => $siteConfigDetail["pageSearchDesc"],
                'siteKeyword' => $siteConfigDetail["siteKeyword"],
                'siteAuthor' => $siteConfigDetail["siteAuthor"],
                'siteCopyRight' => $siteConfigDetail["siteCopyright"],
                'siteRobot' => $siteConfigDetail["siteRobot"],
                'siteRevisitAfter' => $siteConfigDetail["siteRevisitAfter"],
                'siteDistribution' => $siteConfigDetail["siteDistribution"],
                'siteImage' => $siteConfigDetail["siteImage"],
                'siteUrl' => $siteConfigDetail["siteUrl"]
            )
        );

    }

    public function shortsearchAction($parameter = null)
    {
        //var_dump($parameter);

        $shortSearchType = "bkk";
        $zone = null;
        $bkkPayType = null;
        $selBuildingType = null;
        $lessPrice = null;
        $mostPrice = null;
        $selProvince = null;

        if ($parameter != null) {
            $shortSearchType = $parameter['shortSearchType'];
            $zone = $parameter['zone'];
            $bkkPayType = $parameter['bkkPayType'];
            $selBuildingType = $parameter['buildingType'];
            $lessPrice = $parameter['lessPrice'];
            $mostPrice = $parameter['mostPrice'];
            $selProvince = $parameter['selProvince'];
        }
        //echo "shortSearchType = ".$shortSearchType;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        //rux
        $sqlGetMap1 = "
            SELECT
              a.`start_price`,
              a.`end_price`,
              a.id,
              a.building_name,
              IFNULL(a.latitude, 13.0) AS latitude,
              IFNULL(a.longitude, 100.0) AS longitude,
              b.type_name,
              b.id AS bt_id,
              IFNULL(
                CONCAT(
                  'images/building/',
                  a.id,
                  '/',
                  c.`photo_name`
                ),
                'images/default-image.png'
              ) AS path_image,
              d.`type_name`
            FROM
              building_site a
              INNER JOIN building_type b
                ON (b.id = a.building_type_id)
              LEFT JOIN image c
                ON (
                  c.`building_site_id` = a.id
                  AND c.`photo_type` = 'head'
                  AND c.`deleted` = 0
                )
              INNER JOIN `building_type` d
                ON (
                  d.`id` = a.`building_type_id`
                  AND d.`deleted` = 0
                )
            WHERE 1
              AND a.publish = 1
              AND b.`deleted` = 0
              AND b.deleted = 0
        ";

        $sqlGetMap2 = "$sqlGetMap1 AND b.`id` = 1";
        $sqlGetMap3 = "$sqlGetMap1 AND b.`id` = 2";
        $sqlGetMap4 = "$sqlGetMap1 AND b.`id` = 3";

        try {
            $objGetMap1 = $conn->fetchAll($sqlGetMap1);
            foreach ($objGetMap1 as $key => $value) {
                $objGetMap1[$key]['path_image'] = $this->getPathImage($value['path_image']);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        try {
            $objGetMap2 = $conn->fetchAll($sqlGetMap2);
            foreach ($objGetMap2 as $key => $value) {
                $objGetMap2[$key]['path_image'] = $this->getPathImage($value['path_image']);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        try {
            $objGetMap3 = $conn->fetchAll($sqlGetMap3);
            foreach ($objGetMap3 as $key => $value) {
                $objGetMap3[$key]['path_image'] = $this->getPathImage($value['path_image']);
            }

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        try {
            $objGetMap4 = $conn->fetchAll($sqlGetMap4);
            foreach ($objGetMap4 as $key => $value) {
                $objGetMap4[$key]['path_image'] = $this->getPathImage($value['path_image']);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        $payType = $this->getPayType();
        $bkkZone = $this->getBkkZone();
        $buildingType = $this->getBuildingType();
        $province = $this->getProvince();

        $constant = new FTRConstant();
        $pinApartment = $constant->getPinApartment();
        $pinMan = $constant->getPinMan();
        $pinWomen = $constant->getPinWomen();


        return $this->render('FTRWebBundle:Search:shortSearch.html.twig', array(
            'payType' => $payType,
            'bkkZone' => $bkkZone,
            'buildingType' => $buildingType,
            'province' => $province,
            'get_map1' => $objGetMap1,
            'get_map2' => $objGetMap2,
            'get_map3' => $objGetMap3,
            'get_map4' => $objGetMap4,
            'shortSearchType' => $shortSearchType,
            'zone' => $zone,
            'bkkPayType' => $bkkPayType,
            'selBuildingType' => $selBuildingType,
            'lessPrice' => $lessPrice,
            'mostPrice' => $mostPrice,
            'selProvince' => $selProvince,
            'pinApartment' => $pinApartment,
            'pinMan' => $pinMan,
            'pinWomen' => $pinWomen
        ));
    }

    /**
     * @param $image
     * @return string
     */
    public function getPathImage($image)
    {
        $pageURL = 'http';
        if (!empty($_SERVER['HTTPS'])) {
            if ($_SERVER["HTTPS"] == "on") {
                $pageURL .= "s";
            }
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        if(strrpos($pageURL, 'app_dev.php')) {
            $pageURL = substr($pageURL, 0, strrpos($pageURL, 'app_dev.php'));
        }
        return $pageURL.$image;
    }

    public function fullsearchAction($parameter = null)
    {
        $shortSearchType = null;
        $zone = null;
        $bkkPayType = null;
        $buildingType = null;
        $lessPrice = null;
        $mostPrice = null;
        $selProvince = 0;
        $bc = "bkk";
        $nBts = null;
        $nMrt = null;
        $nUniversity = null;
        $inRoom[] = null;
        $outRoom[] = null;
        $selAmpher = null;

        //$shortSearchType    = $parameter['shortSearchType'];
        $zone = $parameter['zone'];
        $bkkPayType = $parameter['bkkPayType'];
        $selBuildingType = $parameter['buildingType'];
        $lessPrice = $parameter['lessPrice'];
        $mostPrice = $parameter['mostPrice'];
        $selProvince = $parameter['selProvince'];
        $bc = $parameter['bc'];
        $nBts = $parameter['nBts'];
        $nMrt = $parameter['nMrt'];
        $nUniversity = $parameter['nUniversity'];
        $inRoom = $parameter['inRoom'];
        $outRoom = $parameter['outRoom'];
        $selAmpher = $parameter['selAmpher'];

        $fac_inroomlist = $this->getFacility('inroom');
        $fac_outroomlist = $this->getFacility('outroom');

        foreach ($fac_inroomlist as $key => $var) {
            $row = $fac_inroomlist[$key]['loop'];
            foreach ($row as $keys => $vars) {
                $fId = $row[$keys]['id'];
                if (is_array($inRoom) == true) {
                    if (in_array("$fId", $inRoom) == true) {
                        $fac_inroomlist[$key]['loop'][$keys]['checked'] = "yes";
                    } else {
                        $fac_inroomlist[$key]['loop'][$keys]['checked'] = "no";
                    }
                }
            }
        }

        foreach ($fac_outroomlist as $key => $var) {
            $row = $fac_outroomlist[$key]['loop'];
            foreach ($row as $keys => $vars) {
                $fId = $row[$keys]['id'];
                if (is_array($outRoom) == true) {
                    if (in_array("$fId", $outRoom) == true) {
                        $fac_outroomlist[$key]['loop'][$keys]['checked'] = "yes";
                    } else {
                        $fac_outroomlist[$key]['loop'][$keys]['checked'] = "no";
                    }
                }
            }
        }

        $zonelist = $this->getBkkZone();
        $province = $this->getProvince();
        $buildingTypeList = $this->getBuildingType();
        $payType = $this->getPayType();
        $nearBTS = $this->getNearly(2);
        $nearMRT = $this->getNearly(3);
        $nearUniversity = $this->getNearly(4);

        if ($selProvince == '0') {
            $province_id = $selProvince;
        } else {
            $province_id = $this->getProvince("id", $selProvince);
        }
        $ampher = $this->getAmpher($province_id);
        //$nearInCountry		= $this->getNearly(6);

        //var_dump($ampher);

        return $this->render('FTRWebBundle:Search:search.html.twig', array(
            'fac_inroom' => $fac_inroomlist,
            'fac_outroom' => $fac_outroomlist,
            'zonelist' => $zonelist,
            'province' => $province,
            'buildingTypeList' => $buildingTypeList,
            'payType' => $payType,
            'nearBTS' => $nearBTS,
            'nearMRT' => $nearMRT,
            'nearUniversity' => $nearUniversity,
            'ampher' => $ampher,
            'bc' => $bc,
            'selBuildingType' => $selBuildingType,
            'bkkPayType' => $bkkPayType,
            'lessPrice' => $lessPrice,
            'mostPrice' => $mostPrice,
            'selProvince' => $selProvince,
            'bkkZone' => $zone,
            'nBts' => $nBts,
            'nMrt' => $nMrt,
            'nUniversity' => $nUniversity,
            'inRoom' => $inRoom,
            'outRoom' => $outRoom,
            'selAmpher' => $selAmpher,
        ));
    }

    function ampherAction()
    {
        $province_name = $_GET['province_name'];
        if ($province_name == '0') {
            $province_id = $province_name;
        } else {
            $province_id = $this->getProvince("id", $province_name);
        }
        if ($province_id != null) {
            $ampher = $this->getAmpher($province_id);
            echo "
                <div class=\"styled-select\">
                <select class=\"select\" id=\"scou\" name=\"selAmpher\">";
            foreach ($ampher as $key => $var) {
                echo "<option value=\"" . $ampher[$key]['AMPHUR_VALUE'] . "\">" . $ampher[$key]['AMPHUR_NAME'] . "</option>";
            }
            echo "
                </div>
                </select>
            ";
        } else {
            echo "no";
        }
        exit();
    }

    function getBkkZone()
    {
        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $whereQuery = null;
            $sql = "
				select * from zone
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        $all[] = array('id' => 0, 'zonename' => 'ทุกเขต');

        $result = array_merge($all, $result_data);
        return $result;
    }

    function getProvince($type = "list", $provinceName = null)
    {
        switch ($type) {
            case "list":
                $result_data = array();
                $conn = $this->get('database_connection');
                if (!$conn) {
                    die("MySQL Connection error");
                }
                try {
                    $sql = "
                            select PROVINCE_NAME as PROVINCE_VALUE , PROVINCE_NAME
                            from province
                            where PROVINCE_ID != 1
                            order by PROVINCE_NAME asc
                        ";
                    $result_data = $conn->fetchAll($sql);
                } catch (Exception $e) {
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }
                $all[] = array('PROVINCE_VALUE' => '0', 'PROVINCE_NAME' => 'ทุกจังหวัด');

                $result = array_merge($all, $result_data);
                return $result;
                break;
            case "id":
                $result_data = array();
                $result = null;
                $conn = $this->get('database_connection');
                if (!$conn) {
                    die("MySQL Connection error");
                }
                try {
                    $provinceName = trim($provinceName);
                    $sql = "
                            SELECT PROVINCE_ID
                            FROM province
                            where PROVINCE_NAME = '$provinceName'
                        ";
                    $result_data = $conn->fetchAll($sql);
                } catch (Exception $e) {
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }
                if (count($result_data) > 0) {
                    $result = $result_data[0]['PROVINCE_ID'];
                }
                return $result;
                break;
        }

    }

    function getAmpher($id = null)
    {
        $result_data = array();
        $all[] = array('AMPHUR_VALUE' => 0, 'AMPHUR_NAME' => ' - กรุณาระบุ - ');
        $whereQuery = NULL;
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            if ($id != null) {
                $whereQuery .= " AND PROVINCE_ID = '$id'";
                $sql = "
				  SELECT AMPHUR_NAME as AMPHUR_VALUE , AMPHUR_NAME
				  FROM amphur
				  WHERE 1 $whereQuery
			    ";
                $result_data = $conn->fetchAll($sql);
            }
            $result = array_merge($all, $result_data);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $result;
    }

    function getBuildingType($type = null)
    {
        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $whereQuery = null;
            if ($type != null) {
                $whereQuery = " where id in (select distinct(building_type_id) from building_site where pay_type_id = $type)";
            }
            $sql = "
				select * from building_type $whereQuery
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        $all[] = array('id' => 0, 'type_name' => 'ทุกประเภท');

        $result = array_merge($all, $result_data);
        return $result;
    }

    function getFacility($type = 'inroom')
    {
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            /**
             * query for facility list inroom type
             */
            $sql = "select * from facilitylist where facility_type = '$type'";
            $faclist_inroom = $conn->fetchAll($sql);
            $countall_inroom = count($faclist_inroom);
            foreach ($faclist_inroom as $key => $value) {
                $count = $key + 1;
                $list[] = array(
                    'id' => $value['id'],
                    'facility_name' => $value['facility_name'],
                    'facility_type' => $value['facility_type'],
                    'checked' => 'no',
                );
                if ($count % 4 == 0) {
                    $fac_inroomlist[] = array('loop' => $list);
                    $list = NULL;
                } elseif ($count == $countall_inroom) {
                    $fac_inroomlist[] = array('loop' => $list);
                    $list = NULL;
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $fac_inroomlist;
    }

    function getPayType()
    {
        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
				select  `id`,`typename` from pay_type order by id desc
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        $result = $result_data;
        return $result;
    }

    function getNearly($type = 2)
    {
        $result_data = array();
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        try {
            $sql = "
				select * from nearly_location where nearly_type_id = $type
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        switch ($type) {
            case 2:
            case 3:
                $all[] = array('id' => 0, 'name' => 'ทุกสถานี');
                break;
            case 4:
            case 5:
            case 6:
                $all[] = array('id' => 0, 'name' => ' - กรุณาระบุ - ');
                break;
        }

        $result = array_merge($all, $result_data);
        return $result;
    }

}