<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\AdminBundle\Helper\FTRHelper;
use FTR\Config\Config;


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

    public function DetailAction($buildId,$province,$prefecture,$slug)
    {
        $detailData = array();
        $countData = 0;
        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        
        if (!empty($buildId)) {
            $id = $buildId;
//            $id = $this->getBuildingId($id);

            try {
                /**
                 * query Detail page general detail
                 */
                $sqlGeneral = "SELECT b.*, t.id,t.type_name,z.zonename,z.id,p.typename, pro.PROVINCE_NAME, am.AMPHUR_NAME
                               FROM building_site b
                                  LEFT JOIN building_type t ON (b.building_type_id = t.id AND t.deleted = 0)
                                  LEFT JOIN zone z ON (b.zone_id = z.id AND z.deleted = 0)
                                  LEFT JOIN pay_type p ON ( b.pay_type_id = p.id AND p.deleted = 0)
                                  LEFT JOIN amphur am ON (b.addr_prefecture = am.AMPHUR_ID )
                                  LEFT JOIN province pro ON (b.addr_province = pro.PROVINCE_ID )
                               WHERE b.id = $id
                                  AND b.deleted =0";

                $objGeneral = $conn->fetchAll($sqlGeneral);

                $buildingName = $objGeneral[0]["building_name"];
                $buildingAddress = $objGeneral[0]["building_address"];
                $buildingNearlyPlace = $objGeneral[0]["nearly_place"];

//                echo $objGeneral[0]["building_name"];exit();

                $countData = count($objGeneral);
				//var_dump($sqlGeneral);exit();
                if ($countData == 1) {
                    $detailData = $objGeneral[0];

                    /**
                     * query image MAP HEAD
                     * */
                    $sqlImageType = "SELECT photo_name, building_site_id, description, photo_type
                                     FROM image
                                     WHERE (photo_type = 'head'OR photo_type = 'map')
                                        AND building_site_id = $id
                                        AND deleted = 0
                                        ";
                    $objImageType = $conn->fetchAll($sqlImageType);
                    $head = "";
                    $map = "";
//                    echo "<pre>";
//                    var_dump($objImageType);exit();
//                    echo "<pre/>";

                    foreach ($objImageType as $value) {
                        if($value['photo_type'] == 'head'){
                            $head = $value['photo_name'];
                        }if($value['photo_type'] == 'map'){
                            $map = $value['photo_name'];
                        }
                    }

                    /**
                     * query Detail Nearly Type
                     * */
                    $sqlNearlyType = "SELECT nl.name,nt.type_name
                                     FROM nearly2site n2
                                        LEFT JOIN nearly_location nl ON (n2.nearly_location_id = nl.id AND nl.deleted =0)
                                        LEFT JOIN nearly_type nt ON (nl.nearly_type_id = nt.id AND nt.deleted =0)
                                     WHERE n2.building_site_id = $id
                                        AND nt.type_name IN ('bts','mrt','university')
                                        AND n2.deleted =0";
                    $objNearType = $conn->fetchAll($sqlNearlyType);
                    $nearBts = "";
                    $nearMrt = "";
                    $nearCollege = "";
                    foreach ($objNearType as $value) {
                        if ($value['type_name'] == 'bts') {
                            $nearBts = $value['name'];
                        } else if ($value['type_name'] == 'mrt') {
                            $nearMrt = $value['name'];
                        } else if ($value['type_name'] == 'university') {
                            $nearCollege = $value['name'];
                        }
                    }

                    /**
                     * query Detail facility roomtype
                     * */
                    $sqlRoomType = "SELECT
                                    r2.room_size,
                                    r2.room_price,
                                    r2.room_typename,
                                    r2.building_site_id,
                                    img.photo_name,
                                    img.photo_type,
                                    img.deleted,
                                    img.sequence
                                  FROM
                                    roomtype2site r2
                                    LEFT JOIN image img
                                      ON (
                                        r2.id = img.roomtype2site_id
                                        AND img.deleted = 0
                                        AND img.photo_type != 'gallery'
                                        AND img.photo_type != 'head'
                                      )
                                  WHERE r2.building_site_id = $id
                                    AND r2.deleted = 0
                                  ORDER BY img.sequence  ";
                    $objRoomType = $conn->fetchAll($sqlRoomType);

                    /**
                     * query Detail facility inroom
                     * */
                    $sqlInRoom = "SELECT f.*, f2.id AS facility2site_id
                                  FROM
                                      facilitylist f
                                  LEFT JOIN facility2site f2
                                      ON (
                                          f2.facilitylist_id = f.id
                                          AND f2.building_site_id = $id
                                          AND f2.deleted = 0
                                      )
                                  WHERE f.deleted = 0 AND f.display = 1   AND f.facility_type= 'inroom'";
                    $objInRoom = $conn->fetchAll($sqlInRoom);

                    /**
                     * query Detail facility outroom
                     * */
                    $sqlOutRoom = "SELECT f.*, f2.id AS facility2site_id
                                   FROM
                                       facilitylist f
                                   LEFT JOIN facility2site f2
                                       ON (
                                           f2.facilitylist_id = f.id
                                           AND f2.building_site_id = $id
                                           AND f2.deleted = 0
                                       )
                                   WHERE f.deleted = 0 AND f.display = 1   AND f.facility_type= 'outroom'";
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

                    /**
                     * query wifi
                     */
                    $sqlWifi = "SELECT `id`
                            FROM `facility2site`
                            WHERE `building_site_id` = $id
                            AND `facilitylist_id` = 2
                            AND `deleted` = 0
                        ";
                    $objWifi = $conn->fetchAll($sqlWifi);
                    if(empty($objWifi)){
                        $objWifi = false;
                    } else {
                        $objWifi = $sqlWifi;
                    }
                }else{
                	echo "test";exit();
                    return $this->redirect($this->generateUrl('FTRWebBundle_list'));
                }
            } catch (Exception $e) {
                return $this->redirect($this->generateUrl('FTRWebBundle_list'));
            }

            // เรียกข้อมูลเบื้องต้นของ website
            $siteConfig = new Config();
            $siteConfigDetail = $siteConfig->setSiteGlobal();

            $buldingSiteTitle = $buildingName." - ".$siteConfigDetail["siteTitle"];
            $buildingSiteKeyword = $buildingName.", ".$buildingNearlyPlace.", ".$siteConfigDetail["siteKeyword"];

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
                'imgHead'=>$head,
                'map'=>$map,
                'wifi'=>$objWifi,
                'siteTitle'=> $buldingSiteTitle,
                'siteDesc' => $detailData["detail"],
                'siteKeyword' => $buildingSiteKeyword,
                'siteAuthor' => $siteConfigDetail["siteAuthor"],
                'siteCopyRight' => $siteConfigDetail["siteCopyright"],
                'siteRobot' => $siteConfigDetail["siteRobot"],
                'siteRevisitAfter' => $siteConfigDetail["siteRevisitAfter"],
                'siteDistribution' => $siteConfigDetail["siteDistribution"],
                'siteImage' => $siteConfigDetail["siteImage"],
                'siteUrl' => $siteConfigDetail["siteUrl"]
            ));
        } else {
            return $this->redirect($this->generateUrl('FTRWebBundle_list'));
        }
    }
}