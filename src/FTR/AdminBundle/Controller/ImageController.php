<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Image;
use FTR\AdminBundle\Form\ImageType;
use FTR\AdminBundle\Helper\LoggerHelper;

/**
 * Image controller.
 *
 */
class ImageController extends Controller
{
    /**
     * Finds and displays a Image entity.
     *
     */
    public function showAction($id)
    {

        $this->createFolderBuildingId($id);
        $sqlGetBuildingSite = "
            SELECT
              *
            FROM
              `building_site`
            WHERE `deleted` != 1
              AND id = $id
        ";
        $ObjBuildingSite = $this->getDataArray($sqlGetBuildingSite);

        $sqlGetRoomType2Site = "
            SELECT
              r.*,
              i.`photo_name`,
              i.`photo_type`,
              i.`sequence`,
              i.id AS image_id
            FROM
              `roomtype2site` r
              LEFT JOIN `image` i
                ON (
                  r.`id` = i.`roomtype2site_id`
                  AND i.`photo_type` = 'room'
                )
            WHERE r.`building_site_id` = $id
              AND r.`deleted` != 1
        ";
        $ObjRoomType2SiteImage = $this->getDataArray($sqlGetRoomType2Site);
        foreach ($ObjRoomType2SiteImage as $key => $value) {
            if (empty($value['photo_name'])){
                $ObjRoomType2SiteImage[$key]['photo_name'] = 'show.png';
                $ObjRoomType2SiteImage[$key]['image_id'] = 0;
            }else{
                $ObjRoomType2SiteImage[$key]['photo_name'] = "building/$id/".$value['photo_name'];
            }
            $ObjRoomType2SiteImage[$key]['count'] = $key+1;
        }

        $sqlGetGallery = "
            SELECT
              `id`,
              `building_site_id`,
              `roomtype2site_id`,
              `photo_name`,
              `photo_type`,
              `deleted`,
              `description`,
              `sequence`
            FROM
              `image`
            WHERE `deleted` != 1
              AND `photo_type` = 'gallery'
              AND `building_site_id` = $id
            ORDER BY `sequence`
        ";
        $ObjGetGallery = $this->getDataArray($sqlGetGallery);
        if (empty($ObjGetGallery)){
            $em = $this->getDoctrine()->getEntityManager();
            $entity = new Image();
            $entity -> setDeleted(0);
            $entity -> setBuildingSiteId($id);
            $entity -> setDescription('');
            $entity -> setPhotoName('');
            $entity -> setPhotoType('gallery');
            $entity -> setSequence(0);
            $em->persist($entity);

            //สร้าง logs
            $this->addLogger('Insert Image', $entity);
            $em->flush();
        }
        $ObjGetGallery = $this->getDataArray($sqlGetGallery);

        foreach ($ObjGetGallery as $key => $value) {
            if (empty($value['photo_name'])){
                $ObjGetGallery[$key]['photo_name'] = 'show.png';
//                $ObjGetGallery[$key]['id'] = 0;
            }else{
                $ObjGetGallery[$key]['photo_name'] = "building/$id/".$value['photo_name'];
            }
            $ObjGetGallery[$key]['count'] = $key+1;
        }
        $sqlGetHead = "
            SELECT
              `id`,
              `building_site_id`,
              `roomtype2site_id`,
              `photo_name`,
              `photo_type`,
              `deleted`,
              `description`,
              `sequence`
            FROM
              `image`
            WHERE `deleted` != 1
              AND `photo_type` = 'head'
              AND `building_site_id` = $id
        ";
        $ObjGetHead = $this->getDataArray($sqlGetHead);
        if (empty($ObjGetHead[0]['photo_name'])){
            $ObjGetHead[0]['photo_name'] = 'show.png';
            $ObjGetHead[0]['id'] = 0;
        }else{
            $ObjGetHead[0]['photo_name'] = "building/$id/" . $ObjGetHead[0]['photo_name'];
        }
        $sqlGetMap = "
            SELECT
              `id`,
              `building_site_id`,
              `roomtype2site_id`,
              `photo_name`,
              `photo_type`,
              `deleted`,
              `description`,
              `sequence`
            FROM
              `image`
            WHERE `deleted` != 1
              AND `photo_type` = 'map'
              AND `building_site_id` = $id
        ";
        $ObjGetMap = $this->getDataArray($sqlGetMap);
        if (empty($ObjGetMap[0]['photo_name'])){
            $ObjGetMap[0]['photo_name'] = 'show.png';
            $ObjGetMap[0]['id'] = 0;
        }else{
            $ObjGetMap[0]['photo_name'] = "building/$id/" . $ObjGetMap[0]['photo_name'];
        }

        $sqlGetRecommend = "
            SELECT
              `id`,
              `building_site_id`,
              `roomtype2site_id`,
              `photo_name`,
              `photo_type`,
              `deleted`,
              `description`,
              `sequence`
            FROM
              `image`
            WHERE `deleted` != 1
              AND `photo_type` = 'recommend'
              AND `building_site_id` = $id
        ";
        $ObjGetRecommend = $this->getDataArray($sqlGetRecommend);
        if (empty($ObjGetRecommend[0]['photo_name'])){
            $ObjGetRecommend[0]['photo_name'] = 'show.png';
            $ObjGetRecommend[0]['id'] = 0;
        }else{
            $ObjGetRecommend[0]['photo_name'] = "building/$id/" . $ObjGetRecommend[0]['photo_name'];
        }

        return $this->render('FTRAdminBundle:Image:show.html.twig', array(
            'buildingSite'          => $ObjBuildingSite,
            'roomtype2siteimage'    => $ObjRoomType2SiteImage,
            'gallery'               => $ObjGetGallery,
            'headImage'             => $ObjGetHead,
            'mapImage'              => $ObjGetMap,
            'recommendImage'        => $ObjGetRecommend
        ));
    }


    /**
     * Creates a new Image entity.
     *
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $getBuildingSiteId = @$_POST["building_site_id"];
        $getTypePost = @$_POST['typePost'];
        $getIdImage = @$_POST['idImage'];
        $getNameImage = @$_POST['nameImage'];
        $getDescription = @$_POST['description'];
        $getNewImageGallery = @$_POST['newImageGallery'];
        $getSequence = @$_POST['sequence'];
        $sqlGetImage = "
            SELECT
              `id`,
              `building_site_id`,
              `roomtype2site_id`,
              `photo_name`,
              `photo_type`,
              `deleted`,
              `description`,
              `sequence`
            FROM
              `image`
            WHERE `id` = $getIdImage
              AND `deleted` != 1
        ";
        switch ($getTypePost){
            case "head":{
                if ($getIdImage == '0'){
                    $entity = new Image();
                    $entity -> setDeleted(0);
                    $entity -> setBuildingSiteId($getBuildingSiteId);
                    $entity -> setDescription('');
                    $entity -> setPhotoName($getNameImage);
                    $entity -> setPhotoType('head');
                    $entity -> setSequence(0);

                    //สร้าง logs
                    $this->addLogger('Insert Head Image', $entity);

                }else{
                    $ObjGetImage = $this->getDataArray($sqlGetImage);
                    $getNameImageOld = $ObjGetImage[0]['photo_name'];
                    $this->deleteFileByBuildingId($getBuildingSiteId, $getNameImageOld);
                    $entity = $em->getRepository('FTRWebBundle:Image')->find($getIdImage);
                    $entity -> setPhotoName($getNameImage);

                    //สร้าง logs
                    $this->addLogger('Update Head Image', $entity);
                }
            }break;
            case "map":{
                if ($getIdImage == '0'){
                    $entity = new Image();
                    $entity -> setDeleted(0);
                    $entity -> setBuildingSiteId($getBuildingSiteId);
                    $entity -> setDescription('');
                    $entity -> setPhotoName($getNameImage);
                    $entity -> setPhotoType('map');
                    $entity -> setSequence(0);

                    //สร้าง logs
                    $this->addLogger('Insert Map Image', $entity);
                }else{
                    $ObjGetImage = $this->getDataArray($sqlGetImage);
                    $getNameImageOld = $ObjGetImage[0]['photo_name'];
                    $this->deleteFileByBuildingId($getBuildingSiteId, $getNameImageOld);
                    $entity = $em->getRepository('FTRWebBundle:Image')->find($getIdImage);
                    $entity -> setPhotoName($getNameImage);

                    //สร้าง logs
                    $this->addLogger('Update Map Image', $entity);
                }
            }break;
            case "room":{
                $sqlGetImageByRoomType = "
                    SELECT
                      `id`,
                      `building_site_id`,
                      `roomtype2site_id`,
                      `photo_name`,
                      `photo_type`,
                      `deleted`,
                      `description`,
                      `sequence`
                    FROM
                      `image`
                    WHERE `roomtype2site_id` = $getIdImage
                ";
                $ObjGetImageByRoomType = $this->getDataArray($sqlGetImageByRoomType);
                if (empty($ObjGetImageByRoomType)){
                    $entity = new Image();
                    $entity -> setDeleted(0);
                    $entity -> setBuildingSiteId($getBuildingSiteId);
                    $entity -> setRoomtype2siteId($getIdImage);
                    $entity -> setDescription('');
                    $entity -> setPhotoName($getNameImage);
                    $entity -> setPhotoType('room');
                    $entity -> setSequence(0);

                    //สร้าง logs
                    $this->addLogger('Insert Room Image', $entity);
                }else{
                    $sqlGetImage = "
                        SELECT
                          `id`,
                          `building_site_id`,
                          `roomtype2site_id`,
                          `photo_name`,
                          `photo_type`,
                          `deleted`,
                          `description`,
                          `sequence`
                        FROM
                          `image`
                        WHERE `roomtype2site_id` = $getIdImage
                          AND `deleted` != 1
                    ";
                    $ObjGetImage = $this->getDataArray($sqlGetImage);
                    $getNameImageOld = $ObjGetImage[0]['photo_name'];
                    $this->deleteFileByBuildingId($getBuildingSiteId, $getNameImageOld);
                    $getIdImageOld = $ObjGetImage[0]['id'];
                    $entity = $em->getRepository('FTRWebBundle:Image')->find($getIdImageOld);
                    $entity -> setPhotoName($getNameImage);
                    $em->persist($entity);

                    //สร้าง logs
                    $this->addLogger('Update Room Image', $entity);
                }
            }break;
            case "gallery":{
                if ($getIdImage == '0' || $getNewImageGallery == 'new'){
                    $entity = new Image();
                    $entity -> setDeleted(0);
                    $entity -> setBuildingSiteId($getBuildingSiteId);
                    $entity -> setDescription($getDescription);
                    $entity -> setPhotoName($getNameImage);
                    $entity -> setPhotoType('gallery');
                    $entity -> setSequence($getSequence);

                    //สร้าง logs
                    $this->addLogger('Insert Gallery Image', $entity);
                }else if ($getNewImageGallery == 'delete'){
                    $sqlGetGallery = "
                        SELECT
                          `id`,
                          `building_site_id`,
                          `roomtype2site_id`,
                          `photo_name`,
                          `photo_type`,
                          `deleted`,
                          `description`,
                          `sequence`
                        FROM
                          `image`
                        WHERE `deleted` != 1
                          AND `photo_type` = 'gallery'
                          AND `building_site_id` = $getBuildingSiteId
                        ORDER BY `sequence`
                    ";
                    $ObjGetImage = $this->getDataArray($sqlGetGallery);
                    foreach ($ObjGetImage as $key => $value) {
                        if (intval($value['sequence']) > intval($getSequence)){
                            $entity = $em->getRepository('FTRWebBundle:Image')->find($value['id']);
                            $entity -> setSequence(intval($value['sequence'])-1);
                            $em->persist($entity);
                        }
                        if ($value['id'] == $getIdImage){
                            if (!empty($value['photo_name'])){
                                $this->deleteFileByBuildingId($getBuildingSiteId, $value['photo_name']);
                            }
                            //delete
                            $entity = $em->getRepository('FTRWebBundle:Image')->find($value['id']);
                            $em->remove($entity);
                        }
                    }
                    $em->flush();

                    //สร้าง logs
                    $this->addLogger('Update Gallery Image', $entity);
                    echo 'finish';
                    exit();
                }else{

                    $entity = $em->getRepository('FTRWebBundle:Image')->find($getIdImage);
                    $entity -> setDescription($getDescription);
                    if ($getNewImageGallery != 'edit'){
                        $ObjGetImage = $this->getDataArray($sqlGetImage);
                        $getNameImageOld = $ObjGetImage[0]['photo_name'];
                        if (!empty($getNameImageOld)){
                            $this->deleteFileByBuildingId($getBuildingSiteId, $getNameImageOld);
                        }
                        $entity -> setPhotoName($getNameImage);
                    }

                    //สร้าง logs
                    $this->addLogger('Update Image', $entity);
                }
            }break;
            case "recommend":{
                if ($getIdImage == '0'){
                    $entity = new Image();
                    $entity -> setDeleted(0);
                    $entity -> setBuildingSiteId($getBuildingSiteId);
                    $entity -> setDescription('');
                    $entity -> setPhotoName($getNameImage);
                    $entity -> setPhotoType('recommend');
                    $entity -> setSequence(0);

                    //สร้าง logs
                    $this->addLogger('Insert Recommend Image', $entity);
                }else{
                    $ObjGetImage = $this->getDataArray($sqlGetImage);
                    $getNameImageOld = $ObjGetImage[0]['photo_name'];
                    $this->deleteFileByBuildingId($getBuildingSiteId, $getNameImageOld);
                    $entity = $em->getRepository('FTRWebBundle:Image')->find($getIdImage);
                    $entity -> setPhotoName($getNameImage);

                    //สร้าง logs
                    $this->addLogger('Update Recommend Image', $entity);
                }
            }break;
            default :{
                echo "error";
                exit();
            }break;
        }
        $em->persist($entity);
        $em->flush();
        echo 'finish_' . $entity->getId();
        exit();
    }

    /*
     * ลบไฟล์รูปภาพ เมื่อมีคำสั่งลบรูปมา
     */
    private function deleteFileByBuildingId($id, $nameImage){
        $path = "./images/building/".$id."/".$nameImage;
        if(!file_exists($path)){
            echo "No File is path : '$path'";
        }else{
            unlink($path);
        }
    }

    /*
    * สร้าง folder building/id
    */
    private function createFolderBuildingId($id){
        $path = "./images/building/".$id;
        if(!file_exists("./images/building")){
            mkdir("./images/building", 0777);
        }
        if(!file_exists($path)){
            mkdir($path, 0777);
        }
    }

    /*
    * บันทึก log เกี่ยวกับการ insert, delete, update database
    */
    private function addLogger($message, $entity){
        $logger = new LoggerHelper();
        $newArray = $logger->objectToArray($entity);

        //Get Session Username
        $session = $this->get('session');
        $username = $session->get('username');

        //add log
        $logger->addInfo("$message by '$username'", $newArray);
    }

    private function getDataArray($sql){
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