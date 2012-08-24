<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SearchController extends Controller
{
    public function searchAction()
    {
        return $this->render('FTRWebBundle:Search:index.html.twig');

    }

    public function shotsearchAction()
    {
        $zonelist_day		= $this->getZone(1);
        $zonelist_month		= $this->getZone(2);
        $buildingtype_day	= $this->getBuildingType(1);
        $buildingtype_month	= $this->getBuildingType(2);

        return $this->render('FTRWebBundle:Search:shotsearch.html.twig', array(
            'zonelist_day' 			=>$zonelist_day,
            'zonelist_month' 		=>$zonelist_month,
            'buildingtype_day' 		=>$buildingtype_day,
            'buildingtype_month' 	=>$buildingtype_month,
        ));
    }

    public function fullsearchAction()
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

    function getZone( $payType = null){
        $result_data = array();
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $whereQuery = null;
            if($payType != null){
                $whereQuery = "where id in (select distinct(zone_id) from building_site where pay_type_id = $payType)";
            }

            $sql = "
				select * from zone $whereQuery
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $all[] = array('id'=>0,'zonename'=>'ทุกเขต');

        $result = array_merge($all,$result_data);
        return $result;
    }

    function getBuildingType($type=null){
        $result_data = array();
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $whereQuery = null;
            if($type != null){
                $whereQuery = " where id in (select distinct(building_type_id) from building_site where pay_type_id = $type)";
            }
            $sql = "
				select * from building_type $whereQuery
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
