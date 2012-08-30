<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SearchController extends Controller
{
    public function searchAction()
    {
        return $this->render('FTRWebBundle:Search:index.html.twig');

    }

    public function shortsearchAction($name=NULL)
    {
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        //rux
        $sqlGetMap1 = "
            SELECT 
              a.*, 
              b.`type_name`,
			  b.id as bt_id
            FROM
              `building_site` a
              INNER JOIN `building_type` b
                ON (b.`id` = a.`building_type_id`)
            WHERE a.`publish` = 1
              AND b.`deleted` = 0 ";
        $sqlGetMap2 = "
            $sqlGetMap1 AND b.`id` = 1
        ";
        $sqlGetMap3 = "
            $sqlGetMap1 AND b.`id` = 2
        ";
        $sqlGetMap4 = "
            $sqlGetMap1 AND b.`id` = 3
        ";
        try{
            $objGetMap1 = $conn->fetchAll($sqlGetMap1);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        try{
            $objGetMap2 = $conn->fetchAll($sqlGetMap2);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        try{
            $objGetMap3 = $conn->fetchAll($sqlGetMap3);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        try{
            $objGetMap4 = $conn->fetchAll($sqlGetMap4);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        //peung
        //$zonelist_day		= $this->getZone();
        //$zonelist_month		= $this->getZone(2);
        //$buildingtype_day	= $this->getBuildingType(1);
        //$buildingtype_month	= $this->getBuildingType(2);

        $payType        = $this->getPayType();
        $bkkZone        = $this->getBkkZone();
        $buildingType   = $this->getBuildingType();
        $province       = $this->getProvince();


        return $this->render('FTRWebBundle:Search:shortSearch.html.twig', array(
            'payType' 			    =>$payType,
            'bkkZone' 		        =>$bkkZone,
            'buildingType' 		    =>$buildingType,
            'province' 		        =>$province,
            'get_map1'              =>$objGetMap1,
            'get_map2'              =>$objGetMap2,
            'get_map3'              =>$objGetMap3,
            'get_map4'              =>$objGetMap4,
            'name'                  =>$name,
        ));
    }

    public function fullsearchAction()
    {
        $fac_inroomlist 	= $this->getFacility('inroom');	
        $fac_outroomlist 	= $this->getFacility('outroom');	
		$zonelist			= $this->getBkkZone();
		$province			= $this->getProvince();
		$buildingTypeList	= $this->getBuildingType();
		$payType			= $this->getPayType();
		$nearBTS			= $this->getNeary(2);
		$nearMRT			= $this->getNeary(3);
		$nearUniversity		= $this->getNeary(4);
		$nearBy				= $this->getNeary(5);
		$nearInCountry		= $this->getNeary(6);

        return $this->render('FTRWebBundle:Search:search.html.twig', array(
			'fac_inroom' 		=> $fac_inroomlist,
			'fac_outroom' 		=> $fac_outroomlist,
			'zonelist' 			=> $zonelist,
			'province' 			=> $province,
			'buildingTypeList' 	=> $buildingTypeList,
			'payType' 			=> $payType,
			'nearBTS' 			=> $nearBTS,
			'nearMRT' 			=> $nearMRT,
			'nearUniversity' 	=> $nearUniversity,
			'nearBy' 			=> $nearBy,
			'nearInCountry' 	=> $nearInCountry,
		));
    }

    function getBkkZone()
    {
        $result_data = array();
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $whereQuery = null;
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

    function getProvince()
    {
        $result_data = array();
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $sql = "
				select PROVINCE_NAME as PROVINCE_VALUE , PROVINCE_NAME
				from province
				where PROVINCE_ID != 1
				order by PROVINCE_NAME asc
			";
            $result_data = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $all[] = array('PROVINCE_VALUE'=>'0','PROVINCE_NAME'=>'ทุกจังหวัด');

        $result = array_merge($all,$result_data);
        return $result;
    }

    function getBuildingType($type=null)
    {
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

	function getFacility($type='inroom')
    {
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
	
	function getPayType()
    {
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
	
	function getNeary($type=2)
    {
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
            case 6:
				$all[] = array('id'=>0,'name'=>' - กรุณาระบุ - ');
				break;
		}
		
		$result = array_merge($all,$result_data);
		return $result;
	}
}