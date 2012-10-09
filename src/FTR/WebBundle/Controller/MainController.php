<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\WebBundle\Entity\Building_site;
use FTR\WebBundle\Repository\Building_siteRepository;

class MainController extends Controller {

    /**
     * Function Get Ads Image
     */
    public function getAds($zone){
        if(!empty($zone)){
            $conn = $this -> get('database_connection');
            $time = date("Y-m-d H:i:s", time());
            $sql = "
                SELECT a.codes
                FROM ads_control a
                WHERE a.publish = 1
                AND a.date_start <= '$time'
                AND a.date_end >= '$time'
                AND a.zone = '$zone'
            ";
            $result = $conn -> fetchAll($sql);
            $countResult = count($result);
            if($countResult>0){
                $resultRandom = $result[rand(0, $countResult -1)];
                $image = $resultRandom['codes'];
                if(strstr($zone, "A-")){
                    if(strstr($image, "<noscript>") && strstr($image, "</noscript>")){
                        $string1 = explode("<noscript>", $image);
                        $string2 = explode("</noscript>", $string1[1]);
                        $image = $string2[0];
                    }
                }
                return $image;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function indexAction() {

        $userId = "";
        $conn = $this -> get('database_connection');
        if (!$conn) { die("MySQL Connection error");
        }

        if (!empty($_GET['confirmToken'])) {
            $token = $_GET['confirmToken'];
            // if(!empty($objSQL0)){

            $sqlGetUser = "SELECT id,enabled FROM user_owner WHERE confirm_token = '$token' AND deleted = 0";
            $objGetUser = $conn -> fetchAll($sqlGetUser);
            if (count($objGetUser) == 1) {
                try {
                    $sqlEnableUpdate = "UPDATE user_owner SET enabled = '1' WHERE confirm_token= '$token' AND deleted = 0";
                    $conn -> query($sqlEnableUpdate);
                    $enableRegis = true;
                    $enableReset = false;
                } catch (Exception $e) {
                    $enableRegis = false;
                    $enableReset = false;
                    echo 'Caught exception: ', $e -> getMessage(), "\n";
                }
            } else {
                $enableRegis = false;
                $enableReset = false;
            }

            //}
        }else if(!empty($_GET['resetToken'])){
            $token = $_GET['resetToken'];
            try {
                $sqlGetUserReset = "SELECT id,enabled FROM user_owner WHERE confirm_token = '$token' AND deleted = 0";
                $objGetUserReset = $conn -> fetchAll($sqlGetUserReset);
                if(count($objGetUserReset) == 1){
                    $userId = $objGetUserReset[0]['id'];
                    $enableReset = true;
                    $enableRegis = false;
                }else{
                    $enableRegis = false;
                    $enableReset = false;
                }
            } catch (Exception $e) {
                $enableRegis = false;
                $enableReset = false;
                echo 'Caught exception: ', $e -> getMessage(), "\n";
            }
        } else {
            $enableRegis = false;
            $enableReset = false;
        }

        $session = $this->get('session');
//เรียกใช้ banner
        //Zone A
        $zonea1 = $this->getAds('A-1');
        $zonea2 = $this->getAds('A-2');
        $zonea3 = $this->getAds('A-3');
        $zonea4 = $this->getAds('A-4');
        $zonea5 = $this->getAds('A-5');
        $zonea6 = $this->getAds('A-6');
        $zonea7 = $this->getAds('A-7');
        $zonea8 = $this->getAds('A-8');
        $zonea9 = $this->getAds('A-9');
        $zonea10 = $this->getAds('A-10');

        //Zone C
        $zonec1 = $this->getAds('C-1');
        $zonec2 = $this->getAds('C-2');
        $zonec3 = $this->getAds('C-3');
        $zonec4 = $this->getAds('C-4');
        $zonec5 = $this->getAds('C-5');
        $zonec6 = $this->getAds('C-6');
        $zonec7 = $this->getAds('C-7');
        $zonec8 = $this->getAds('C-8');

        //Zone D
        $session->set('zoneD1', $this->getAds('D-1'));
        $session->set('zoneD2', $this->getAds('D-2'));
        $session->set('zoneD3', $this->getAds('D-3'));
        $session->set('zoneD4', $this->getAds('D-4'));
        $session->set('zoneD5', $this->getAds('D-5'));
        $session->set('zoneD6', $this->getAds('D-6'));
        $session->set('zoneD7', $this->getAds('D-7'));
        $session->set('zoneD8', $this->getAds('D-8'));
//echo $zonea2;exit();
        $top_last_building = $this -> getTopLastBuilding();
        $last_update = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
        $last_update = $this -> convertThaiDate($last_update);
//var_dump($enableRegis);
        return $this -> render('FTRWebBundle:Main:index.html.twig', array('top_last_building' => $top_last_building
        , 'last_update' => $last_update, 'enableRegis' => $enableRegis, 'enableReset' => $enableReset, 'userId' => $userId
        , 'zoneA1'=>$zonea1, 'zoneA2'=>$zonea2, 'zoneA3'=>$zonea3, 'zoneA4'=>$zonea4, 'zoneA5'=>$zonea5, 'zoneA6'=>$zonea6, 'zoneA7'=>$zonea7, 'zoneA8'=>$zonea8, 'zoneA9'=>$zonea9, 'zoneA10'=>$zonea10
        , 'zoneC1'=>$zonec1, 'zoneC2'=>$zonec2, 'zoneC3'=>$zonec3, 'zoneC4'=>$zonec4, 'zoneC5'=>$zonec5, 'zoneC6'=>$zonec6, 'zoneC7'=>$zonec7, 'zoneC8'=>$zonec8));
    }

    function getTopLastBuilding() {
        $result_data = array();
        $em = $this -> getDoctrine() -> getEntityManager();

        $conn = $this -> get('database_connection');
        if (!$conn) { die("MySQL Connection error");
        }
        try {
            $sql = "
				SELECT 
					a.building_name,
					b.type_name,
					c.typename,
					d.zonename,
					pro.PROVINCE_NAME,
					am.AMPHUR_NAME,
					a.slug,
					FORMAT(a.start_price,0) AS start_price,
					FORMAT(a.end_price,0) AS end_price,
					a.id
				FROM
					building_site a
					INNER JOIN building_type b ON (a.building_type_id=b.id)
					INNER JOIN pay_type c ON (a.pay_type_id=c.id)
					INNER JOIN zone d ON (a.zone_id=d.id)
					INNER JOIN amphur am ON a.addr_prefecture	 = am.AMPHUR_ID
                    INNER JOIN province pro ON a.addr_province = pro.PROVINCE_ID
				WHERE a.publish = 1
				ORDER BY lastupdate DESC LIMIT 10
			";
            $result_data = $conn -> fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e -> getMessage(), "\n";
        }
        $result = $result_data;
        return $result;
    }

    public function convertThaiDate($date) {
        $month = array('', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
        $dd = date("d", strtotime($date));
        $mn = date("m", strtotime($date));
        $mm = $month[intval($mn)];
        $yn = date("Y", strtotime($date));
        $yy = intval($yn) + 543;
        $h = date("H", strtotime($date));
        $m = date("i", strtotime($date));
        $s = date("s", strtotime($date));

        //$yy = substr($yy,2,2);

        $newDate = intval($dd) . " " . $mm . " " . $yy . " " . $h . ":" . $m;
        return $newDate;
    }

    public function recomAction() {
        $em = $this -> getDoctrine() -> getEntityManager();

        $conn = $this -> get('database_connection');
        if (!$conn) { die("MySQL Connection error");
        }

        try {
            $sql1Bts = "SELECT pro.PROVINCE_NAME, am.AMPHUR_NAME, b.slug, img.photo_name, img.building_site_id, b.id, b.building_name, n.name, t.type_name, b.start_price, b.end_price
                        FROM building_site b
                        LEFT JOIN building_type t ON (b.building_type_id = t.id AND t.deleted = 0)
                        LEFT JOIN nearly2site n2 ON (n2.building_site_id = b.id AND n2.deleted = 0)
                        LEFT JOIN nearly_location n ON (n.id = n2.nearly_location_id AND n.deleted = 0)
                        LEFT JOIN nearly_type nt ON (nt.id = n.nearly_type_id AND nt.deleted = 0)
                        LEFT JOIN image img ON (b.id = img.building_site_id AND img.photo_type = 'recommend' AND img.deleted = 0)
                        LEFT JOIN amphur am ON (b.addr_prefecture = am.AMPHUR_ID)
                        LEFT JOIN province pro ON (b.addr_province = pro.PROVINCE_ID)
                        WHERE b.recommend = 1
                            AND nt.type_name = 'bts'
                            AND b.deleted =  0
                            ";
            $objBts = $conn -> fetchAll($sql1Bts);
            if (count($objBts) <= 3) {
                $numrow1 = 0;
            } else {
                $numrow1 = 1;
            }

        } catch (Exception $e) {
            echo 'Caught exception: ', $e -> getMessage(), "\n";
        }
        try {
            $sqlMrt = "SELECT pro.PROVINCE_NAME, am.AMPHUR_NAME, b.slug, img.photo_name, img.building_site_id, b.id, b.building_name, n.name, t.type_name, b.start_price, b.end_price
                        FROM building_site b
                        LEFT JOIN building_type t ON (b.building_type_id = t.id AND t.deleted = 0)
                        LEFT JOIN nearly2site n2 ON (n2.building_site_id = b.id AND n2.deleted = 0)
                        LEFT JOIN nearly_location n ON (n.id = n2.nearly_location_id AND n.deleted = 0)
                        LEFT JOIN nearly_type nt ON (nt.id = n.nearly_type_id AND nt.deleted = 0)
                        LEFT JOIN image img ON (b.id = img.building_site_id AND img.photo_type = 'recommend' AND img.deleted = 0)
                        LEFT JOIN amphur am ON (b.addr_prefecture = am.AMPHUR_ID)
                        LEFT JOIN province pro ON (b.addr_province = pro.PROVINCE_ID)
                        WHERE b.recommend = 1
                            AND nt.type_name = 'mrt'
                            AND b.deleted =  0";
            $objMrt = $conn -> fetchAll($sqlMrt);
            if (count($objMrt) <= 3) {
                $numrow2 = 0;
            } else {
                $numrow2 = 1;
            }

        } catch (Exception $e) {
            echo 'Caught exception: ', $e -> getMessage(), "\n";
        }
        try {
            $sqlCollege = "SELECT pro.PROVINCE_NAME, am.AMPHUR_NAME, b.slug, img.photo_name, img.building_site_id, b.id, b.building_name, n.name, t.type_name, b.start_price, b.end_price
                        FROM building_site b
                        LEFT JOIN building_type t ON (b.building_type_id = t.id AND t.deleted = 0)
                        LEFT JOIN nearly2site n2 ON (n2.building_site_id = b.id AND n2.deleted = 0)
                        LEFT JOIN nearly_location n ON (n.id = n2.nearly_location_id AND n.deleted = 0)
                        LEFT JOIN nearly_type nt ON (nt.id = n.nearly_type_id AND nt.deleted = 0)
                        LEFT JOIN image img ON (b.id = img.building_site_id AND img.photo_type = 'recommend' AND img.deleted = 0)
                        LEFT JOIN amphur am ON (b.addr_prefecture = am.AMPHUR_ID)
                        LEFT JOIN province pro ON (b.addr_province = pro.PROVINCE_ID)
                        WHERE b.recommend = 1
                            AND nt.type_name = 'university'
                            AND b.deleted =  0";
            $objCollege = $conn -> fetchAll($sqlCollege);
            if (count($objCollege) <= 3) {
                $numrow3 = 0;
            } else {
                $numrow3 = 1;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e -> getMessage(), "\n";
        }
        try {
            $sqlCountView = "SELECT pro.PROVINCE_NAME, am.AMPHUR_NAME, b.slug, COUNT(ban.building_site_id), img.photo_name, img.building_site_id, b.id, b.building_name,n.name,t.type_name, b.start_price, b.end_price, nt.type_name AS nearlyType
                                FROM banner_count ban
                                INNER JOIN building_site b ON (ban.building_site_id = b.id )
                                INNER JOIN building_type t ON (b.building_type_id = t.id AND t.deleted = 0)
                                INNER JOIN nearly2site n2 ON (n2.building_site_id = b.id AND n2.deleted = 0)
                                INNER JOIN nearly_location n ON (n.id = n2.nearly_location_id AND n.deleted = 0)
                                INNER JOIN nearly_type nt ON (nt.id = n.nearly_type_id AND nt.deleted = 0)
                                INNER JOIN image img ON (b.id = img.building_site_id AND img.photo_type = 'recommend' AND img.deleted = 0)
                                INNER JOIN amphur am ON (b.addr_prefecture = am.AMPHUR_ID)
                                INNER JOIN province pro ON (b.addr_province = pro.PROVINCE_ID)
                                WHERE b.recommend =1
                                    AND b.deleted =  0
                                GROUP BY ban.building_site_id
                                ORDER BY COUNT(ban.building_site_id) DESC";
            $objCountView = $conn -> fetchAll($sqlCountView);
            if (count($objCountView) <= 3) {
                $numrow4 = 0;
            } else {
                $numrow4 = 1;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e -> getMessage(), "\n";
        }
        return $this -> render('FTRWebBundle:Main:recom.html.twig', array(
            'roomBts' => $objBts, 'numrow1' => $numrow1
        , 'roomMrt' => $objMrt, 'numrow2' => $numrow2
        , 'roomCollege' => $objCollege, 'numrow3' => $numrow3
        , 'countView' => $objCountView,'numrow4' => $numrow4 ));
    }
}