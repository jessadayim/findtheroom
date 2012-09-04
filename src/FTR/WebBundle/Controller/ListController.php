<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ListController extends Controller
{
    
    public function indexAction()
    {
        $searchType         = "shortSearch";
        $buildingType       = null;
        $zone               = null;
        $nearly             = null;
        $textSearch         = "ห้องพัก";
        $bkkPayType         = null;
        $selZone            = null;
        $selProvince        = null;
        $lessPrice          = null;
        $mostPrice          = null;
        $shortSearchType    = "bkk";

        //query value
        $whereQuery         = null;
        $numStart           = 0;
        $numShow            = 10;
        $pageNumber         = 1;
        $numStartDisplay    = $numStart + 1;
        $numEnd             = $numStart + $numShow;
        $parameter          = array();

        // post zone
        if($_GET){
            $searchType     = @$_GET['searchType'];
            $buildingType   = @$_GET['buildingType'];
            $zone           = @$_GET['zone'];
            $nearly         = @$_GET['nearly'];
        }

        //display textSearch
        if( !empty($buildingType) )
        {
            $textSearch = $this->getBuildingTypeSearch($buildingType);
            $whereQuery .= " AND a.building_type_id = '$buildingType'";
        }
        if($zone == "bkk")
        {
            $textSearch = "โซนในกรุงเทพฯ";
            $whereQuery .= " AND a.addr_province = 'กรุงเทพมหานคร'";
        }
        if(!empty($nearly)){
            $textSearch = $this->getNearlyType($nearly);
            $whereQuery .= " AND f.nearly_type_id = '$nearly'";
        }
        // end get zone

        // post zone
        if($_POST)
        {
            //short search

            //var_dump(@$_POST);
            if(!empty($_POST['searchBkk']))
            {
                $shortSearchType = trim(@$_POST['searchBkk']);
                $whereQuery .= " AND a.zone_id != 0";
            }
            if(!empty($_POST['searchCountry']))
            {
                $shortSearchType = trim(@$_POST['searchCountry']);
                $whereQuery .= " AND a.zone_id = 0";
            }

            switch ($shortSearchType) {
                case "bkk":
                        $zone           = @$_POST['bkkZone'];
                        $bkkPayType     = @$_POST['bkkPayType'];
                        $buildingType   = @$_POST['bkkBuildingType'];
                        $lessPrice      = @$_POST['lessPrice'];
                        $mostPrice      = @$_POST['mostPrice'];

                        if(($zone != 0)&&(!empty($zone)))
                        {
                            $whereQuery .= " AND a.zone_id = $zone";
                        }
                        if(!empty($bkkPayType))
                        {
                            $whereQuery .= " AND a.pay_type_id = $bkkPayType";
                        }
                        if(($buildingType != 0)&&(!empty($buildingType)))
                        {
                            $whereQuery .= " AND a.building_type_id = $buildingType";
                        }

                        if(!empty($lessPrice)&&(!empty($mostPrice)))
                        {
                            $whereQuery .= "
                                AND (
                                    a.start_price <= $lessPrice <= end_price  or
                                    a.start_price <= $mostPrice <= end_price
                                )
                            ";
                        }


                    break;
                case "country":
                        $selProvince    = @$_POST['selProvince'];
                        $bkkPayType     = @$_POST['bkkPayType'];
                        $buildingType   = @$_POST['bkkBuildingType'];
                        $lessPrice      = @$_POST['lessPrice'];
                        $mostPrice      = @$_POST['mostPrice'];

                        if(($selProvince != 0)&&(!empty($selProvince)))
                        {
                            $whereQuery .= " AND a.addr_province = '$selProvince''";
                        }
                        if(!empty($bkkPayType))
                        {
                            $whereQuery .= " AND a.pay_type_id = $bkkPayType";
                        }
                        if(($buildingType != 0)&&(!empty($buildingType)))
                        {
                            $whereQuery .= " AND a.building_type_id = $buildingType";
                        }

                        if(!empty($lessPrice)&&(!empty($mostPrice)))
                        {
                            $whereQuery .= "
                                    AND (
                                        a.start_price <= $lessPrice <= end_price  or
                                        a.start_price <= $mostPrice <= end_price
                                    )
                                ";
                        }
                    break;
            }
            //end short search
        }

        //parameter for short search
        $parameter['shortSearchType']   = $shortSearchType;
        $parameter['zone']              = $zone;
        $parameter['bkkPayType']        = $bkkPayType;
        $parameter['buildingType']      = $buildingType;
        $parameter['lessPrice']         = $lessPrice;
        $parameter['mostPrice']         = $mostPrice;
        $parameter['selProvince']       = $selProvince;

        //end get zone

        //setting $whereQuery

        $result_data = array();
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $selectFieldCount = "SELECT count(*) as count ";
            $selectField = "
                 SELECT
                    a.id,
                    a.building_name,b.type_name,c.typename,
                    a.addr_number,a.addr_prefecture,a.addr_province,
                    a.addr_zipcode,a.detail,a.start_price,a.end_price,
                    a.latitude,a.longitude,d.facilitylist_id
            ";
            $fromTable = "
                FROM building_site a
                    INNER JOIN building_type b ON(a.building_type_id=b.id)
                    INNER JOIN pay_type c ON(a.pay_type_id=c.id)
                    LEFT OUTER JOIN facility2site d ON (d.building_site_id = a.id)
                    LEFT OUTER JOIN nearly2site e ON (e.building_site_id = a.id)
                    LEFT OUTER JOIN nearly_location f ON (e.nearly_location_id = f.id)
            ";
            $limitDisplay = " LIMIT $numStart , $numShow";

            $sql_c = "
                $selectFieldCount
                $fromTable
                WHERE 1
                    $whereQuery
                $limitDisplay
            ";

            $sql = "
                $selectField
                $fromTable
                WHERE 1
                    $whereQuery
                $limitDisplay
            ";

            $resultCount    = $conn->fetchAll($sql_c);
            $result         = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        $numData = $resultCount[0]['count'];
        if($numEnd > $numData)
        {
             $numEnd = $numStart + $numData;
        }
		return $this->render('FTRWebBundle:List:index.html.twig', array(
            'result'            => $result,
            'numData'           => $numData,
            'searchType'        => $searchType,
            'numStartDisplay'   => $numStartDisplay,
            'numEnd'            => $numEnd,
            'parameter'         => $parameter,
            'pageNumber'        => $pageNumber,
            'textSearch'        => $textSearch,
        ));
    }

    function getBuildingTypeSearch($id)
    {
        $resultData = null;
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $sql = "
                SELECT
                  type_name
                FROM
                  building_type
                WHERE id = $id
            ";
            $result = $conn->fetchAll($sql);
            if(count($result)==1){
                 $resultData = $result[0]['type_name'];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $resultData;
    }

    function getNearlyType($id)
    {
        $resultData = null;
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $sql = "
                SELECT
                  label
                FROM
                  nearly_type
                WHERE id = $id
            ";
            $result = $conn->fetchAll($sql);
            if(count($result)==1){
                $resultData = $result[0]['label'];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $resultData;
    }
}
