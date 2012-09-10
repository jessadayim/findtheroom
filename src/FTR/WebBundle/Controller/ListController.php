<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

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
        $bc                 = null;
        $nBts               = null;
        $nMrt               = null;
        $nUniversity        = null;
        $inRoom             = null;
        $outRoom            = null;
        $inRoomQuery        = null;
        $outRoomQuery       = null;
        $selAmpher          = null;
        $txtSearch          = "";
        $result             = null;

        //query value
        $whereQuery         = null;
        $numStart           = 0;
        $numShow            = 10;
        $pageNumber         = 1;
        $numStartDisplay    = $numStart + 1;
        $numEnd             = $numStart + $numShow;
        $parameter          = array();

        // post zone aaaaaa
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
            //echo $searchType;
            //var_dump(@$_POST);
            switch ($searchType) {
                case "shortSearch":
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
                        }//end short search
                     break;
                case "fullSearch":
                    //echo $searchType;
                    //var_dump(@$_POST);
                    $buildingType       = @$_POST['selBuildingType'];
                    $lessPrice          = @$_POST['lessPrice'];
                    $mostPrice          = @$_POST['mostPrice'];
                    $bkkPayType         = @$_POST['bkkPayType'];
                    $bc                 = @$_POST['bc'];
                    $selProvince        = @$_POST['selProvince'];
                    $zone               = @$_POST['bkkZone'];
                    $nBts               = @$_POST['nBts'];
                    $nMrt               = @$_POST['nMrt'];
                    $nUniversity        = @$_POST['nUniversity'];
                    $inRoom             = @$_POST['inRoom'];
                    $outRoom            = @$_POST['outRoom'];
                    $selAmpher          = @$_POST['selAmpher'];

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

                    if(!empty($bkkPayType))
                    {
                        $whereQuery .= " AND a.pay_type_id = $bkkPayType";
                    }

                    if($bc=="bkk")
                    {
                        if(($zone==0)&&($nBts==0)&&($nMrt==0)&&($nUniversity==0))
                        {
                            $nearlyZone = null;
                            $whereQuery .= " AND a.zone_id != 0 ";
                        }
                        else
                        {
                            $nearlyZone = "(";
                            if($zone!=0){
                                $nearlyZone .= "'".$zone."',";
                            }

                            if($nBts!=0)
                            {
                                $nearlyZone .= "'".$nBts."',";
                            }

                            if($nMrt!=0)
                            {
                                $nearlyZone .= "'".$nMrt."',";
                            }

                            if($nUniversity!=0)
                            {
                                $nearlyZone .= "'".$nUniversity."',";
                            }
                            $nearlyZone .= "'')";
                            $whereQuery .= " AND f.id in $nearlyZone";
                            $whereQuery .= " AND a.zone_id = $zone";
                        }
                    }
                    elseif($bc=="country"){
                        $whereQuery .= "
                            AND a.zone_id = 0
                            AND a.addr_province = '$selProvince'
                        ";
                        if( $selAmpher != 0 && $selAmpher!= null){
                             $whereQuery .= " a.addr_prefecture = '$selAmpher'";
                        }
                    }

                    if(is_array($inRoom)==true){
                        $inRoomQuery = " d.facilitylist_id in (";
                        foreach($inRoom as $key => $var){
                            if($key==0){
                                $inRoomQuery .="'".$inRoom[$key]."'";
                            }
                            else
                            {
                                $inRoomQuery .=",'".$inRoom[$key]."'";
                            }
                        }
                        $inRoomQuery .= ")";
                    }
                    if(is_array($outRoom)==true){
                        $outRoomQuery = " d.facilitylist_id in (";
                        foreach($outRoom as $key => $var){
                            if($key==0){
                                $outRoomQuery .="'".$outRoom[$key]."'";
                            }
                            else
                            {
                                $outRoomQuery .=",'".$outRoom[$key]."'";
                            }
                        }
                        $outRoomQuery .= ")";
                    }
                    if((is_array($inRoom)==true) && (is_array($outRoom)==true))
                    {
                        $whereQuery .= " AND ($inRoomQuery OR $outRoomQuery)";
                    }
                    elseif((is_array($inRoom)==true) && (is_array($outRoom)==false))
                    {
                         $whereQuery .= " AND ($inRoomQuery)";
                    }
                    elseif((is_array($inRoom)==false) && (is_array($outRoom)==true))
                    {
                         $whereQuery .= " AND ($outRoomQuery)";
                    }
                    break;
                case"txtSearch":
                         $txtSearch  =  trim(@$_POST['txtSearch']);
                         $session = $this->get('session');
                         $session->set('txtSearch', $txtSearch);
                         if(!empty($txtSearch)&&$txtSearch!=null&&$txtSearch!=''){
                             $whereQuery .= "
                                AND (
                                     a.building_name like '%$txtSearch%' OR
                                     a.contact_name like '%$txtSearch%' OR
                                     a.addr_prefecture like '%$txtSearch%' OR
                                     a.addr_province like '%$txtSearch%' OR
                                     b.type_name like '%$txtSearch%' OR
                                     c.typename like '%$txtSearch%' OR
                                     f.name like '%$txtSearch%'
                                )
                             ";
                         }
                    break;
            }
        }

        //parameter for short search
        $parameter['shortSearchType']   = $shortSearchType;
        $parameter['zone']              = $zone;
        $parameter['bkkPayType']        = $bkkPayType;
        $parameter['buildingType']      = $buildingType;
        $parameter['lessPrice']         = $lessPrice;
        $parameter['mostPrice']         = $mostPrice;
        $parameter['selProvince']       = $selProvince;
        $parameter['bc']                = $bc;
        $parameter['nBts']              = $nBts;
        $parameter['nMrt']              = $nMrt;
        $parameter['nUniversity']       = $nUniversity;
        $parameter['inRoom']            = $inRoom;
        $parameter['outRoom']           = $outRoom;
        $parameter['selAmpher']         = $selAmpher;

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
            'txtSearch'         => $txtSearch,
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
