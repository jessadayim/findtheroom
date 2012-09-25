<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\WebBundle\Entity\Building_site;
use FTR\WebBundle\Repository\Building_siteRepository;

class MainController extends Controller {

    /**
     * Function Get Ads Image
     */
//    public function bannerData(){
//        $conn = $this -> get('database_connection');
//        if (!$conn) { die("MySQL Connection error");
//        }
//
//        /**
//         * Get ads image
//         */
//        $sql = "SELECT codes, zone, date_start, date_end
//                FROM ads_control
//                WHERE publish = 1";
//        $objSQL = $conn -> fetchAll($sql);
//        if(count($objSQL) > 0){
//
//            $zone[][] = '';
//            $j = 0;
//            $uni = '';
//            $zone2[] = '';
//            for($i=0;$i<count($objSQL);$i++){
//                $time = date("Y-m-d H:i:s", time());
//                //echo strtotime($objSQL[$i]['date_end'])." ";
//                if(strtotime($time) >= strtotime($objSQL[$i]['date_start']) && strtotime($time) <= strtotime($objSQL[$i]['date_end'])){
//                    $zone2[$i] = $objSQL[$i]['zone'];
//                    if($uni != $objSQL[$i]['zone']){
//                        $j = 0;
//                    }else{
//                        $j = $j + 1;
//                    }
//                    $zone[$objSQL[$i]['zone']][$j] = $objSQL[$i]['codes'];
//                    $uni = $objSQL[$i]['zone'];
//                }
//            }
//
//            /**
//             * Get Zone Ads image
//             */
//            $zoneNull = implode('', $zone2);
//            if(empty($zoneNull)){
//                $zoneC = '';
//                $zoneA = '';
//                $zoneD = '';
//            }else{
//                $sqlZone = "SELECT zone, date_start, date_end
//                            FROM ads_control
//                            WHERE publish = 1
//                            GROUP BY zone";
//                $objZone = $conn -> fetchAll($sqlZone);
//                for($i=0;$i<count($objZone);$i++){
//                    if(strtotime($time) >= strtotime($objZone[$i]['date_start']) && strtotime($time) <= strtotime($objZone[$i]['date_end'])){
//
//                        if(strstr($objZone[$i]['zone'], "A") ){
//                            $maxZoneA = count($zone[$objZone[$i]['zone']]) - 1;
//                            $zoneSplit[$i] = $zone[$objZone[$i]['zone']][rand(0,$maxZoneA)];
//                            $string1 = explode("<noscript>", $zoneSplit[$i]);
//                            $string2 = explode("</noscript>", $string1[1]);
//                            $zoneA[$i]  = $string2[0];
//                        }else if(strstr($objZone[$i]['zone'], "C") ){
//                            $maxZoneC = count($zone[$objZone[$i]['zone']]) - 1;
//                            $zoneC[$i] = $zone[$objZone[$i]['zone']][rand(0,$maxZoneC)];
//                        }else if(strstr($objZone[$i]['zone'], "D") ){
//                            $maxZoneD = count($zone[$objZone[$i]['zone']]) - 1;
//                            $zoneD[$i] = $zone[$objZone[$i]['zone']][rand(0,$maxZoneD)];
//                        }
//                    }
//                }
//                if(empty($zoneA)){
//                    $zoneA = '';
//                }
//                else if(empty($zoneC)){
//                    $zoneC = '';
//                }else if(empty($zoneD)){
//                    $zoneD = '';
//                }
//            }
//        }else{
//            $zoneA = '';
//            $zoneC = '';
//            $zoneD = '';
//        }
//
//
//
////        exit();
//        return array('zoneA'=>$zoneA, 'zoneC'=>$zoneC, 'zoneD'=>$zoneD);
//
//    }

    public function getAds($zone){
        if(!empty($zone)){
            $conn = $this -> get('database_connection');
            $today = date('Y-m-d');
            $sql = "
                SELECT a.codes
                FROM ads_control a
                WHERE a.publish = 1
                AND a.date_start <= '$today'
                AND a.date_end >= '$today'
                AND a.zone = '$zone'
            ";
            $result = $conn -> fetchAll($sql);
            $countResult = count($result);
            if($countResult>0){
                $resultRandom = $result[rand(0, $countResult -1)];
                $image = $resultRandom['codes'];
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
        $em = $this -> getDoctrine() -> getEntityManager();

        $conn = $this -> get('database_connection');
        if (!$conn) { die("MySQL Connection error");
        }

        if (!empty($_GET['token'])) {
            $token = $_GET['token'];
            // if(!empty($objSQL0)){
            $sql = "UPDATE user_owner SET enabled = '1' WHERE confirm_token= '$token'";
            $conn -> query($sql);

            $sql = "SELECT enabled FROM user_owner WHERE confirm_token = '$token'";
            $objSQL = $conn -> fetchAll($sql);
            if (!empty($objSQL)) {
                if ($objSQL[0]['enabled'] == 1) {
                    $enable = true;
                } else {
                    $enable = false;
                }
            } else {$enable = false;
            }

            //}
        } else {$enable = false;
        }
//        $banner = $this->bannerData();
        $session = $this->get('session');

        $zonec1 = $this->getAds('C-1');
        $zonec2 = $this->getAds('C-2');
        $zonec3 = $this->getAds('C-3');
        $zonec4 = $this->getAds('C-4');

        $session->set('zoneD1', '');
        $session->set('zoneD2', '');
        $session->set('zoneD3', '');
        $session->set('zoneD4', '');
//        $session->set('zoneD', $zoneD);
//        var_dump($session->get('zone'));

        $top_last_building = $this -> getTopLastBuilding();
        $last_update = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
        $last_update = $this -> convertThaiDate($last_update);

        return $this -> render('FTRWebBundle:Main:index.html.twig', array('top_last_building' => $top_last_building, 'last_update' => $last_update
        , 'enable' => $enable, 'zoneA'=>"", 'zoneC1'=>$zonec1, 'zoneC2'=>$zonec2, 'zoneC3'=>$zonec3, 'zoneC4'=>$zonec4));
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
					a.addr_province,
					a.addr_prefecture,
					FORMAT(a.start_price,0) AS start_price,
					FORMAT(a.end_price,0) AS end_price
				FROM
					building_site a
					INNER JOIN building_type b ON (a.building_type_id=b.id)
					INNER JOIN pay_type c ON (a.pay_type_id=c.id)
					INNER JOIN zone d ON (a.zone_id=d.id)
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
            $sql1Bts = "SELECT img.photo_name, img.building_site_id, b.id, b.building_name, n.name, t.type_name, b.start_price, b.end_price
                        FROM building_site b
                        JOIN building_type t ON b.building_type_id = t.id
                        JOIN nearly2site n2 ON n2.building_site_id = b.id
                        JOIN nearly_location n ON n.id = n2.nearly_location_id
                        JOIN nearly_type nt ON nt.id = n.nearly_type_id
                        JOIN image img ON b.id = img.building_site_id
                        WHERE b.recommend =1
                            AND img.photo_type = 'recommend'
                            AND nt.id = 1
                            AND img.deleted =  0
                            AND b.deleted =  0";
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
            $sqlMrt = "SELECT img.photo_name, img.building_site_id, b.id, b.building_name, n.name, t.type_name, b.start_price, b.end_price
                        FROM building_site b
                        JOIN building_type t ON b.building_type_id = t.id
                        JOIN nearly2site n2 ON n2.building_site_id = b.id
                        JOIN nearly_location n ON n.id = n2.nearly_location_id
                        JOIN nearly_type nt ON nt.id = n.nearly_type_id
                        JOIN image img ON b.id = img.building_site_id
                        WHERE b.recommend =1
                            AND img.photo_type = 'recommend'
                            AND nt.id = 2
                            AND img.deleted =  0
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
            $sqlCollege = "SELECT img.photo_name, img.building_site_id, b.id, b.building_name, n.name, t.type_name, b.start_price, b.end_price
                        FROM building_site b
                        JOIN building_type t ON b.building_type_id = t.id
                        JOIN nearly2site n2 ON n2.building_site_id = b.id
                        JOIN nearly_location n ON n.id = n2.nearly_location_id
                        JOIN nearly_type nt ON nt.id = n.nearly_type_id
                        JOIN image img ON b.id = img.building_site_id
                        WHERE b.recommend =1
                            AND img.photo_type = 'recommend'
                            AND nt.id = 3
                            AND img.deleted =  0
                            AND b.deleted =  0 ";
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
            $sqlCountView = "SELECT img.photo_name, img.building_site_id, b.id, b.building_name,n.name,t.type_name, b.start_price, b.end_price, nt.type_name AS nearlyType
                                FROM banner_count ban
                                INNER JOIN building_site b ON ban.building_site_id = b.id
                                INNER JOIN building_type t ON b.building_type_id = t.id
                                INNER JOIN zone z ON b.zone_id = z.id
                                INNER JOIN nearly2site n2 ON n2.building_site_id = b.id
                                INNER JOIN nearly_location n ON n.id = n2.nearly_location_id
                                INNER JOIN nearly_type nt ON nt.id = n.nearly_type_id
                                INNER JOIN image img ON b.id = img.building_site_id
                                WHERE b.recommend =1
                                    AND img.photo_type = 'recommend'
                                    AND img.deleted =  0
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