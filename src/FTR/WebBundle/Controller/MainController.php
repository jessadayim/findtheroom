<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\WebBundle\Entity\Building_site;
use Acme\WebBundle\Repository\Building_siteRepository;

class MainController extends Controller
{
    
    public function indexAction()
    {
    	
		//var_dump($objSQL1,$objSQL2,$objSQL3); test
		//exit();
		
		$zonelist_day		= $this->getZone(1);
		$zonelist_month		= $this->getZone(2);
		$buildingtype_day	= $this->getBuildingType(1);
		$buildingtype_month	= $this->getBuildingType(2);
		
		$top_last_building	= $this->getTopLastBuilding();
		$last_update		= date("Y-m-d H:i:s",mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
		$last_update		= $this->convertThaiDate($last_update);
		
		
		return $this->render('FTRWebBundle:Main:index.html.twig',array(
			'zonelist_day' 			=>$zonelist_day,
			'zonelist_month' 		=>$zonelist_month,
			'buildingtype_day' 		=>$buildingtype_day,
			'buildingtype_month' 	=>$buildingtype_month,
			'top_last_building' 	=>$top_last_building,
			'last_update' 			=>$last_update,
			));
    }
	
	function getZone( $payType = 1){
		$result_data = array();
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
		try{
			$sql = "
				select * from zone where id in (select distinct(zone_id) from building_site where pay_type_id = $payType)
			";
			$result_data = $conn->fetchAll($sql);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		$all[] = array('id'=>0,'zonename'=>'ทุกเขต');
		
		$result = array_merge($all,$result_data);
		return $result;
	}
	
	function getBuildingType($type=1){
		$result_data = array();
		$em = $this->getDoctrine()->getEntityManager();
		
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
		try{
			$sql = "
				select * from building_type where id in (select distinct(building_type_id) from building_site where pay_type_id = $type)
			";
			$result_data = $conn->fetchAll($sql);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		$all[] = array('id'=>0,'type_name'=>'ทุกประเภท');
		
		$result = array_merge($all,$result_data);
		return $result;
	}
	
	function getTopLastBuilding(){
		$result_data = array();
		$em = $this->getDoctrine()->getEntityManager();
		
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
		try{ 
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
			$result_data = $conn->fetchAll($sql);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		$result = $result_data;
		return $result;
	}
	
	public function convertThaiDate($date)
	{
		$month = array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
		$dd = date("d",strtotime($date));
		$mn = date("m",strtotime($date));
		$mm = $month[intval($mn)];
		$yn = date("Y",strtotime($date));
		$yy = intval($yn) + 543;
		$h  = date("H",strtotime($date));
		$m  = date("i",strtotime($date));
		$s  = date("s",strtotime($date));
		
		//$yy = substr($yy,2,2);
		
		$newDate = intval($dd)." ".$mm." ".$yy." ".$h.":".$m;
		return $newDate;
	}
	
	public function recomAction(){
		$id = 1;
    	$em = $this->getDoctrine()->getEntityManager();
		
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				$sql1 ="SELECT b.*,n.*,t.*,z.* FROM building_site b JOIN building_type t ON b.building_type_id = t.id
									 JOIN zone z ON b.zone_id = z.id
									 JOIN nearly2site n2 ON n2.building_site_id = b.id
									 JOIN nearly_location n ON n.id = n2.nearly_location_id
									 JOIN nearly_type nt ON nt.id = n.nearly_type_id
						WHERE b.recommend = 1 and nt.id = 1";
				$objSQL1 = $conn->fetchAll($sql1);
				if(count($objSQL1)<=3){
					$numrow1 = 0;
				}else{
					$numrow1 = 1;
				}	
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			try{
				$sql2 ="SELECT b.*,n.*,t.*,z.* FROM building_site b JOIN building_type t ON b.building_type_id = t.id
									 JOIN zone z ON b.zone_id = z.id
									 JOIN nearly2site n2 ON n2.building_site_id = b.id
									 JOIN nearly_location n ON n.id = n2.nearly_location_id
									 JOIN nearly_type nt ON nt.id = n.nearly_type_id
						WHERE b.recommend = 1 and nt.id = 2";
				$objSQL2 = $conn->fetchAll($sql2);
				if(count($objSQL2)<=3){
					$numrow2 = 0;
				}else{
					$numrow2 = 1;
				}				
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			try{
				$sql3 ="SELECT b.*,n.*,t.*,z.* FROM building_site b JOIN building_type t ON b.building_type_id = t.id
									 JOIN zone z ON b.zone_id = z.id
									 JOIN nearly2site n2 ON n2.building_site_id = b.id
									 JOIN nearly_location n ON n.id = n2.nearly_location_id
									 JOIN nearly_type nt ON nt.id = n.nearly_type_id
						WHERE b.recommend = 1 and nt.id =3";
				$objSQL3 = $conn->fetchAll($sql3);
				if(count($objSQL3)<=3){
					$numrow3 = 0;
				}else{
					$numrow3 = 1;
				}
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			return $this->render('FTRWebBundle:Main:recom.html.twig',array('item1'=>$objSQL1,'numrow1'=>$numrow1,'item2'=>$objSQL2,'numrow2'=>$numrow2,'item3'=>$objSQL3,'numrow3'=>$numrow3));
	}
}
