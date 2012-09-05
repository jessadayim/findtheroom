<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Roomtype2site;
use FTR\AdminBundle\Form\Roomtype2siteType;

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
        
        $sqlGetRoomType = "
            SELECT 
              * 
            FROM
              `roomtype` 
            WHERE `deleted` != 1 
        ";
        $ObjRoomType = $this->getDataArray($sqlGetRoomType);
        
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
            'roomtype'          => $ObjRoomType,
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
        $getRoomTypeId = @$_POST['selectRoomType'];
        $getRoomSize = @$_POST['roomSize'];
        $getRoomPrice = @$_POST['roomPrice'];
        
        $countRoomTypeId = count($getRoomTypeId);
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
                    $entity ->setRoomtypeId($this->checkEmptyValue($getRoomTypeId[$key]));
                    $entity ->setRoomsize($this->checkEmptyValue($getRoomSize[$key]));
                    $entity ->setRoomprice($this->checkEmptyValue($getRoomPrice[$key]));
                    $entity ->setDeleted(0);  
                }else{
                    $entity ->setBuildingSiteId($getBuildingSiteId);
                    $entity ->setRoomtypeId(0);
                    $entity ->setRoomsize(0);
                    $entity ->setRoomprice(0);
                    $entity ->setDeleted(1);
                }
                $em->persist($entity);
            }            
            if (count($objGetRoomType2Site) < $countRoomTypeId){
                foreach($getRoomTypeId as $key => $value){
                    if ($key >= count($objGetRoomType2Site)){
                        $entity  = new Roomtype2site();            
                        $entity ->setBuildingSiteId($getBuildingSiteId);
                        $entity ->setRoomtypeId($this->checkEmptyValue($value));
                        $entity ->setRoomsize($this->checkEmptyValue($getRoomSize[$key]));
                        $entity ->setRoomprice($this->checkEmptyValue($getRoomPrice[$key]));
                        $entity ->setDeleted(0);
                        $em->persist($entity);
                    }
                }
            }
        }else{
            foreach($getRoomTypeId as $key => $value){
                $entity  = new Roomtype2site();            
                $entity ->setBuildingSiteId($getBuildingSiteId);
                $entity ->setRoomtypeId($value);
                $entity ->setRoomsize($this->checkEmptyValue($getRoomSize[$key]));
                $entity ->setRoomprice($this->checkEmptyValue($getRoomPrice[$key]));
                $entity ->setDeleted(0);
                $em->persist($entity);
            }
        }
        $em->flush();
        echo 'finish';
        exit();        
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
