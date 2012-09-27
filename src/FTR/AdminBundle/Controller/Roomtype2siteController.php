<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Roomtype2site;
use FTR\AdminBundle\Form\Roomtype2siteType;
use FTR\AdminBundle\Helper\LoggerHelper;

/**
 * Roomtype2site controller.
 *
 */
class Roomtype2siteController extends Controller
{
    /**
     * Finds and displays a Roomtype2site entity.
     *
     */
    public function showAction($id)
    {
        $sqlGetRoomType2Site = "
            SELECT 
              * 
            FROM
              `roomtype2site` 
            WHERE `building_site_id` = $id 
              AND `deleted` != 1 
        ";
        $ObjRoomType2Site= $this->getDataArray($sqlGetRoomType2Site);

        foreach ($ObjRoomType2Site as $key => $value){
            $ObjRoomType2Site[$key]['count'] = $key+1;
        }

        $sqlGetBuildingSite = "
            SELECT 
              * 
            FROM
              `building_site` 
            WHERE `deleted` != 1 
              AND id = $id
        ";
        $ObjBuildingSite = $this->getDataArray($sqlGetBuildingSite);

        return $this->render('FTRAdminBundle:Roomtype2site:show.html.twig', array(
            'buildingsite'      => $ObjBuildingSite,
            'roomtype2site'     => $ObjRoomType2Site,
        ));
    }
   
    private function checkEmptyValue($value){
        if (empty($value)){
            return 0;
        }else{
            $eng_or_world = preg_match 
              ('/^[+-]?'. // start marker and sign prefix 
              '(((([0-9]+)|([0-9]{1,4}(,[0-9]{3,4})+)))?(\\.[0-9])?([0-9]*)|'. // american 
              '((([0-9]+)|([0-9]{1,4}(\\.[0-9]{3,4})+)))?(,[0-9])?([0-9]*))'. // world 
              '(e[0-9]+)?'. // exponent 
              '$/', // end marker 
              $value) == 1;
            if ($eng_or_world == 1){
                return trim($value);
            }else{
                return 0;
            }
        }
        
    }
    /**
     * Creates a new Roomtype2site entity.
     *
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $getBuildingSiteId = @$_POST['building_site_id'];
        $getRoomType = @$_POST['selectRoomType'];
        $getRoomSize = @$_POST['roomSize'];
        $getRoomPrice = @$_POST['roomPrice'];
        
        $countRoomTypeId = count($getRoomType);
        if ($countRoomTypeId <= 0){
            exit();
        }
        $sqlGetRoomType2Site = "
            SELECT 
              * 
            FROM
              `roomtype2site` 
            WHERE `building_site_id` = $getBuildingSiteId
        ";
        $objGetRoomType2Site = $this->getDataArray($sqlGetRoomType2Site);
        if (count($objGetRoomType2Site) > 0){
            $countUpdate = 0;
            foreach($objGetRoomType2Site as $key => $value){
                $entity = $em->getRepository('FTRWebBundle:Roomtype2site')->find($value['id']);
                if ($key < $countRoomTypeId){ 
                    $entity ->setBuildingSiteId($getBuildingSiteId);
                    $entity ->setRoomTypename($getRoomType[$key]);
                    $entity ->setRoomsize($this->checkEmptyValue($getRoomSize[$key]));
                    $entity ->setRoomprice($this->checkEmptyValue($getRoomPrice[$key]));
                    $entity ->setDeleted(0);
                    $em->persist($entity);

                    //สร้าง logs
                    $this->addLogger('Update Roomtype2site', $entity);
                }else{
                    $entity ->setBuildingSiteId($getBuildingSiteId);
                    $entity ->setRoomTypename('');
                    $entity ->setRoomsize(0);
                    $entity ->setRoomprice(0);
                    $entity ->setDeleted(1);
                    $em->persist($entity);

                    $entity = $em->getRepository('FTRWebBundle:Image')->findOneBy(array(
                        "building_site_id" => $getBuildingSiteId,
                        "roomtype2site_id" => $value['id']
                    ));
                    if (!empty($entity)){
                        $nameImage = $entity->getPhotoName();
                        if (!empty($nameImage)){
                            $this->deleteFileByBuildingId($getBuildingSiteId, $nameImage);
                            $em->remove($entity);
                        }

                        //สร้าง logs
                        $this->addLogger('Delete Image', $entity);
                    }
                }

            }

            if (count($objGetRoomType2Site) < $countRoomTypeId){
                foreach($getRoomType as $key => $value){
                    if ($key >= count($objGetRoomType2Site)){
                        $entity  = new Roomtype2site();            
                        $entity ->setBuildingSiteId($getBuildingSiteId);
                        $entity ->setRoomTypename($value);
                        $entity ->setRoomsize($this->checkEmptyValue($getRoomSize[$key]));
                        $entity ->setRoomprice($this->checkEmptyValue($getRoomPrice[$key]));
                        $entity ->setDeleted(0);
                        $em->persist($entity);
                    }
                }

                //สร้าง logs
                $this->addLogger('Insert Roomtype2site', $entity);
            }
        }else{
            foreach($getRoomType as $key => $value){
                $entity  = new Roomtype2site();            
                $entity ->setBuildingSiteId($getBuildingSiteId);
                $entity ->setRoomTypename($value);
                $entity ->setRoomsize($this->checkEmptyValue($getRoomSize[$key]));
                $entity ->setRoomprice($this->checkEmptyValue($getRoomPrice[$key]));
                $entity ->setDeleted(0);
                $em->persist($entity);

                //สร้าง logs
                $this->addLogger('Insert Roomtype2site', $entity);
            }
        }
        $em->flush();

        //Update Table Building_site
        $sqlGetMinMaxPrice = "
            SELECT
              MIN(room_price) AS start_price,
              MAX(room_price) AS end_price
            FROM
              `roomtype2site`
            WHERE `building_site_id` = $getBuildingSiteId
              AND `deleted` = 0
        ";
        $objGetMinMaxPrice = $this->getDataArray($sqlGetMinMaxPrice);
        if (!empty($objGetMinMaxPrice)){
            $startPrice = $objGetMinMaxPrice[0]['start_price'];
            $endPrice = $objGetMinMaxPrice[0]['end_price'];
            $entity = $em->getRepository('FTRWebBundle:Building_site')->find($getBuildingSiteId);
            $entity->setStartPrice($startPrice);
            $entity->setEndPrice($endPrice);
            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Update Roomtype2site', $entity);

        }

        echo 'finish';
        exit();        
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
     * Run คำสั่ง Sql
     * return array
     */
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
