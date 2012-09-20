<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DetailController extends Controller
{

    public function DetailAction($buildId=null)
    {
        $detailData = array();
        $countData = 0;
        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');
        //echo $buildId;
        if (!empty($buildId)) {
            $id = $buildId;
            try {
                /**
                 * query Detail page general detail
                 * */
                $sqlGeneral = "SELECT b.*,t.*,z.*,p.*
                    FROM building_site b JOIN building_type t ON b.building_type_id = t.id
                        JOIN zone z ON b.zone_id = z.id
                        JOIN pay_type p ON p.id = b.pay_type_id
                    WHERE b.id = $id";

                $objGeneral = $conn->fetchAll($sqlGeneral);
                $countData = count($objGeneral);

                if ($countData == 1) {
                    $detailData = $objGeneral[0];

                    /**
                     * query Detail Nearly Type Bts
                     * */
                    $sqlNearlyBts = "SELECT nl.name,nt.id
                    FROM nearly2site n2
                      JOIN nearly_location nl ON n2.nearly_location_id = nl.id
                      JOIN nearly_type nt ON nl.nearly_type_id = nt.id
                    WHERE n2.building_site_id = $id
                      AND nt.id IN (1,2,3)
                      AND n2.deleted !=1
                      AND nl.deleted !=1
                      AND nt.deleted !=1";
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

                    $sqlRoomType = "SELECT  img.photo_name, img.building_site_id, n2.room_typename, n2.room_size, n2.room_price
                                    FROM roomtype2site n2
                                    JOIN image img ON n2.id = img.roomtype2site_id
                                    WHERE n2.building_site_id =$id
                                        AND img.photo_type = 'room'
                                        AND n2.deleted =0
                                        AND n2.deleted =0";
                    $objRoomType = $conn->fetchAll($sqlRoomType);

                    /**
                     * query Detail facility inroom
                     * */
                    $sqlInRoom = "SELECT building_site_id,facility_name
                    FROM facilitylist f
                      LEFT JOIN facility2site f2 ON f2.facilitylist_id = f.id
                    WHERE f.facility_type = 'inroom'
                      AND f.deleted != 1
                      AND f.display != 1";
                    $objInRoom = $conn->fetchAll($sqlInRoom);

                    /**
                     * query Detail facility outroom
                     * */
                    $sqlOutRoom = "SELECT building_site_id,facility_name
                    FROM facilitylist f
                      LEFT JOIN facility2site f2 ON f2.facilitylist_id = f.id
                    WHERE f.facility_type = 'outroom'
                      AND f.deleted != 1
                      AND f.display != 1";
                    $objOutRoom = $conn->fetchAll($sqlOutRoom);

                    /**
                     * query image Room
                     * */
                    $sqlImage = "SELECT photo_name, building_site_id
                                    FROM image
                                    WHERE photo_type = 'recommend'
                                      AND building_site_id = $id
                                      AND deleted = 0 ";
                    $objImage = $conn->fetchAll($sqlImage);
                    $imageName = $objImage[0]['photo_name'];
                    $imageID = $objImage[0]['building_site_id'];
                }
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
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
                'imageName'=> $imageName,
                'imageID'=>$imageID
            ));
        } else {
            return $this->redirect($this->generateUrl('FTRWebBundle_list'));
        }
    }
}