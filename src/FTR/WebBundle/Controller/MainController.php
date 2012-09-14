<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\WebBundle\Entity\Building_site;
use Acme\WebBundle\Repository\Building_siteRepository;

class MainController extends Controller {

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

		$top_last_building = $this -> getTopLastBuilding();
		$last_update = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
		$last_update = $this -> convertThaiDate($last_update);

		return $this -> render('FTRWebBundle:Main:index.html.twig', array('top_last_building' => $top_last_building, 'last_update' => $last_update, 'enable' => $enable));
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
			$sql1Bts = "SELECT b.id, b.building_name, n.name, t.type_name, b.start_price, b.end_price
                        FROM building_site b
                        JOIN building_type t ON b.building_type_id = t.id
                        JOIN nearly2site n2 ON n2.building_site_id = b.id
                        JOIN nearly_location n ON n.id = n2.nearly_location_id
                        JOIN nearly_type nt ON nt.id = n.nearly_type_id
                        WHERE b.recommend =1
                        AND nt.id =1
                        AND b.deleted !=  '1'";
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
			$sqlMrt = "SELECT b.id, b.building_name, n.name, t.type_name, b.start_price, b.end_price
                        FROM building_site b
                        JOIN building_type t ON b.building_type_id = t.id
                        JOIN nearly2site n2 ON n2.building_site_id = b.id
                        JOIN nearly_location n ON n.id = n2.nearly_location_id
                        JOIN nearly_type nt ON nt.id = n.nearly_type_id
                        WHERE b.recommend =1
                        AND nt.id =2
                        AND b.deleted !=  '1'";
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
			$sqlCollege = "SELECT b.id, b.building_name, n.name, t.type_name, b.start_price, b.end_price
                        FROM building_site b
                        JOIN building_type t ON b.building_type_id = t.id
                        JOIN nearly2site n2 ON n2.building_site_id = b.id
                        JOIN nearly_location n ON n.id = n2.nearly_location_id
                        JOIN nearly_type nt ON nt.id = n.nearly_type_id
                        WHERE b.recommend =1
                        AND nt.id =3
                        AND b.deleted !=  '1'";
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
            $sqlCountView = "SELECT b.id,b.building_name,n.name,t.type_name, b.start_price, b.end_price, nt.type_name AS nearlyType
                                FROM banner_count ban
                                INNER JOIN building_site b ON ban.building_site_id = b.id
                                INNER JOIN building_type t ON b.building_type_id = t.id
                                INNER JOIN zone z ON b.zone_id = z.id
                                INNER JOIN nearly2site n2 ON n2.building_site_id = b.id
                                INNER JOIN nearly_location n ON n.id = n2.nearly_location_id
                                INNER JOIN nearly_type nt ON nt.id = n.nearly_type_id
                                WHERE b.recommend =1
                                  AND b.deleted !=  '1'
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
