<?php
namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\Config\Config;

class GooglemapController extends Controller
{
    public function sendToGooglemapViewAction($id){

// เรียกข้อมูลเบื้องต้นของ website
        $siteConfig = new Config();
        $siteConfigDetail = $siteConfig->setSiteGlobal();

        $sql = "
        SELECT
              a.`building_name`,
              a.`start_price`,
              a.`end_price`,
              a.id,
              IFNULL(a.latitude, 13.0) AS latitude,
              IFNULL(a.longitude, 100.0) AS longitude,
              b.type_name,
              b.id AS bt_id,
              IFNULL(
                CONCAT(
                  'images/building/',
                  a.id,
                  '/',
                  c.`photo_name`
                ),
                'images/default-image.png'
              ) AS path_image,
              d.`type_name` ,
              e.`PROVINCE_NAME` AS province_name,
              f.`AMPHUR_NAME` AS amphur_name,
              a.`slug`
            FROM
              building_site a
              INNER JOIN building_type b
                ON (b.id = a.building_type_id)
              LEFT JOIN image c
                ON (
                  c.`building_site_id` = a.id
                  AND c.`photo_type` = 'head'
                  AND c.`deleted` = 0
                )
              INNER JOIN `building_type` d
                ON (
                  d.`id` = a.`building_type_id`
                  AND d.`deleted` = 0
                )
                INNER JOIN `province` e
                ON (
                a.`addr_province` = e.`PROVINCE_ID`
                )
                INNER JOIN `amphur` f
                ON (
                a.`addr_prefecture` = f.`AMPHUR_ID`
                )
            WHERE 1
              AND a.publish = 1
              AND b.`deleted` = 0
              AND b.deleted = 0
              AND a.id = $id
        ";

        $resultGoogleData = $this->getGogolemapDataArray($sql);
//        var_dump($sql);
        $arrayReturn = array(
            "result"=>$resultGoogleData
        );

        return $this->render('FTRWebBundle:Googlemap:googlemapViewFancybox.html.twig', $arrayReturn);

//        $this->renderView('FTRWebBundle:Confirm:viewResult.html.twig', $arrBuildingPoint);
    }

    private function getGogolemapDataArray($sql){
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            return $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return array();
    }
}