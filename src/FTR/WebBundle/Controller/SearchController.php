<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SearchController extends Controller
{
    
    public function searchAction()
    {
        $fac_inroomlist 	= $this->getFacility('inroom');	
        $fac_outroomlist 	= $this->getFacility('outroom');	
		$zonelist			= $this->getZone();
		$buildingTypeList	= $this->getBuildingType();
		$payType			= $this->getPayType();
		$nearBTS			= $this->getNeary(2);
		$nearMRT			= $this->getNeary(3);
		$nearUniversity		= $this->getNeary(4);
		$nearBy				= $this->getNeary(5);
       
        return $this->render('FTRWebBundle:Search:search.html.twig', array(
			'fac_inroom' 		=> $fac_inroomlist,
			'fac_outroom' 		=> $fac_outroomlist,
			'zonelist' 			=> $zonelist,
			'buildingTypeList' 	=> $buildingTypeList,
			'payType' 			=> $payType,
			'nearBTS' 			=> $nearBTS,
			'nearMRT' 			=> $nearMRT,
			'nearUniversity' 	=> $nearUniversity,
			'nearBy' 			=> $nearBy,
		));
    }
	
	function getZone(){
		$result_data = array();
		$em = $this->getDoctrine()->getEntityManager();
		
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
		try{
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
	
	function getBuildingType(){
		$result_data = array();
		$em = $this->getDoctrine()->getEntityManager();
		
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
		try{
			$sql = "
				select * from building_type
			";
			$result_data = $conn->fetchAll($sql);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		$all[] = array('id'=>0,'type_name'=>'ทุกประเภท');
		
		$result = array_merge($all,$result_data);
		return $result;
	}
	
	function getFacility($type='inroom'){
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
		try{
			/**
			 * query for facility list inroom type
			 */
			$sql ="select * from facilitylist where facility_type = '$type'";
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
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $fac_inroomlist;
	}
	
	function getPayType(){
		$result_data = array();
		$em = $this->getDoctrine()->getEntityManager();
		
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
	
	function getNeary($type=2){
		$result_data = array();
		$em = $this->getDoctrine()->getEntityManager();
		
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
				$all[] = array('id'=>0,'name'=>' - กรุณาระบุ - ');
				break;
		}
		
		$result = array_merge($all,$result_data);
		return $result;
	}
}
