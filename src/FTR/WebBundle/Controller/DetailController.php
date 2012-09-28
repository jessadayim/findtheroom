<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\AdminBundle\Helper\FTRHelper;


class DetailController extends Controller
{

    public function getBuildingId($slug)
    {
        $doctrine = $this->getDoctrine();
        $ftr_helper = new FTRHelper();
        $ftr_helper->setDoctrine($doctrine);
        $buildingId = $ftr_helper->getBuildingIdFromLink($slug);
        return $buildingId;
    }

    public function DetailAction($buildId=null)
    {
        $detailData = array();
        $countData = 0;
        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        //echo $buildId;
        if (!empty($buildId)) {
            $id = $buildId;
            $id = $this->getBuildingId($id);
            try {
                /**
                 * query Detail page general detail
                 * */
                $sqlGeneral = "SELECT b.*,t.type_name, t.deleted AS 'typeDeleted',z.zonename, z.deleted AS 'zoneDeleted',p.typename, p.deleted AS 'payDeleted'
                               FROM building_site b JOIN building_type t ON b.building_type_id = t.id
                                  JOIN zone z ON b.zone_id = z.id
                                  JOIN pay_type p ON p.id = b.pay_type_id
                               WHERE b.id = $id
                                  AND b.deleted =0";

                $objGeneral = $conn->fetchAll($sqlGeneral);
                $countData = count($objGeneral);

                if ($countData == 1) {
                    $detailData = $objGeneral[0];

                    $sqlAdd = "SELECT am.AMPHUR_NAME, pro.PROVINCE_NAME
                                   FROM building_site b
                                      JOIN amphur am ON b.addr_prefecture = am.AMPHUR_ID
                                      JOIN province pro ON b.addr_province = pro.PROVINCE_ID
                                   WHERE b.id = $id
                                   AND b.deleted =0";

                    $objAdd = $conn->fetchAll($sqlAdd);
                    $amphur = "";
                    $province = "";
                    foreach ($objAdd as $value) {
                        if($value['AMPHUR_NAME'] != ""){
                            $amphur = $value['AMPHUR_NAME'];
                        }if($value['AMPHUR_NAME'] != ""){
                            $province = $value['AMPHUR_NAME'];
                        }
                    }
                    /**
                     * query image MAP HEAD
                     * */
                    $sqlImageType = "SELECT photo_name, building_site_id, description, photo_type
                                    FROM image
                                    WHERE photo_type = 'head' OR photo_type = 'map'
                                      AND building_site_id = $id
                                      AND deleted = 0";
                    $objImageType = $conn->fetchAll($sqlImageType);
                    $head = "";
                    $map = "";
                    foreach ($objImageType as $value) {
                        if($value['photo_type'] == 'head'){
                            $head = $value['photo_name'];
                        }if($value['photo_type'] == 'map'){
                            $map = $value['photo_name'];
                        }
                    }

                    /**
                     * query Detail Nearly Type Bts
                     * */
                    $sqlNearlyBts = "SELECT nl.name,nt.id
                                     FROM nearly2site n2
                                        JOIN nearly_location nl ON n2.nearly_location_id = nl.id
                                        JOIN nearly_type nt ON nl.nearly_type_id = nt.id
                                     WHERE n2.building_site_id = $id
                                        AND nt.id IN (1,2,3)
                                        AND n2.deleted =0
                                        AND nl.deleted =0
                                        AND nt.deleted =0";
                    $objNearBts = $conn->fetchAll($sqlNearlyBts);
                    $nearBts = "";
                    $nearMrt = "";
                    $nearCollege = "";
                    foreach ($objNearBts as $value) {
                        if ($value['id'] == 1) {
                            $nearBts = $value['name'];
                        } else if ($value['id'] == 2) {
                            $nearMrt = $value['name'];
                        } else if ($value['id'] == 3) {
                            $nearCollege = $value['name'];
                        }
                    }

                    /**
                     * query Detail facility roomtype
                     * */
                    $sqlRoomType = "SELECT r2.room_size, r2.room_price, r2.room_typename,img.building_site_id, img.photo_name, img.deleted, img.sequence
                                    FROM roomtype2site r2
                                    LEFT JOIN image img
                                        ON r2.id = img.roomtype2site_id
                                    WHERE r2.building_site_id = $id AND r2.deleted = 0
                                    ORDER BY img.sequence";
                    $objRoomType = $conn->fetchAll($sqlRoomType);

                    /**
                     * query Detail facility inroom
                     * */
                    $sqlInRoom = "SELECT f2.building_site_id, f2.deleted, f.facility_name
                                  FROM facilitylist f
                                  LEFT JOIN facility2site f2 ON f2.facilitylist_id = f.id
                                  WHERE f.facility_type =  'inroom'
                                      AND f.deleted = 0";
                    $objInRoom = $conn->fetchAll($sqlInRoom);

                    /**
                     * query Detail facility outroom
                     * */
                    $sqlOutRoom = "SELECT f2.building_site_id, f2.deleted, f.facility_name
                                   FROM facilitylist f
                                   LEFT JOIN facility2site f2 ON f2.facilitylist_id = f.id
                                   WHERE f.facility_type =  'outroom'
                                      AND f.deleted = 0";
                    $objOutRoom = $conn->fetchAll($sqlOutRoom);

                    /**
                     * query image Gallery
                     * */
                    $sqlImage = "SELECT photo_name, building_site_id, description
                                    FROM image
                                    WHERE photo_type = 'gallery'
                                      AND building_site_id = $id
                                      AND deleted = 0
                                    ORDER BY sequence";
                    $objImage = $conn->fetchAll($sqlImage);
                    if(empty($objImage[0]['photo_name'])){
                        $objImage = "";
                    }
                }else{
                    return $this->redirect($this->generateUrl('FTRWebBundle_list'));
                }
            } catch (Exception $e) {
                return $this->redirect($this->generateUrl('FTRWebBundle_list'));
            }
            return $this->render('FTRWebBundle:Detail:detail.html.twig', array(
                'general' => $detailData,
                'roomType' => $objRoomType,
                'inRoom' => $objInRoom,
                'outRoom' => $objOutRoom,
                'nearBts' => $nearBts,
                'nearMrt' => $nearMrt,
                'nearCol' => $nearCollege,
                'id' => $id,
                'countData' => $countData,
                'imageName'=> $objImage,
                'countGallery'=>count($objImage),
                'head'=>$head,
                'map'=>$map,
                'amphur'=>$amphur,
                'province'=>$province
            ));
        } else {
            return $this->redirect($this->generateUrl('FTRWebBundle_list'));
        }
    }
}