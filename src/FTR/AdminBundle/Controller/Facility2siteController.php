<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Facility2site;
use FTR\AdminBundle\Form\Facility2siteType;
use FTR\AdminBundle\Helper\LoggerHelper;

/**
 * Facility2site controller.
 *
 */
class Facility2siteController extends Controller
{
    /**
     * Finds and displays a Facility2site entity.
     *
     */
    public function showAction($id)
    {
        $sqlFacility = "
            SELECT 
              l.*,
              f.id AS facility2site_id 
            FROM
              `facilitylist` l 
              LEFT JOIN `facility2site` f 
                ON (
                  f.`facilitylist_id` = l.id 
                  AND f.`building_site_id` = $id 
                  AND f.`deleted` != 1
                ) 
            WHERE l.`deleted` != 1   
        ";
        $sqlGetBuildingSite = "
            SELECT 
              * 
            FROM
              `building_site` 
            WHERE `deleted` != 1 
              AND id = $id
        ";
        $facilityList = $this->getDataArray($sqlFacility);         
        foreach ($facilityList as $key => $value){
            $facilityList[$key]['count'] = $key+1;
        }
        $getBuildingSite = $this->getDataArray($sqlGetBuildingSite);  
        //$form   = $this->createForm(new Facility2siteType(), $entity);

        return $this->render('FTRAdminBundle:Facility2site:show.html.twig', array(
            'buildingsite'    => $getBuildingSite,  
            'facilityList'      => $facilityList
        ));
    }

    /**
     * Creates a new Facility2site entity.
     *
     */
    public function createAction()
    {
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $getPostFacilityListID = @$_POST['facility_list_id'];
        $getBuildingSiteID = @$_POST['building_site_id'];
        $getCheckPost = @$_POST['check_post'];
        
        $sqlGetFacility = "
            SELECT
                id
            FROM 
                `facility2site`
            WHERE facilitylist_id = $getPostFacilityListID 
            AND building_site_id = $getBuildingSiteID
        ";
        $getFacility = $this->getDataArray($sqlGetFacility);
        
        if (empty($getFacility)){
            if ($getCheckPost == 'true'){
                $entity  = new Facility2site();            
                $entity ->setBuildingSiteId($getBuildingSiteID);
                $entity ->setDeleted(0);
                $entity ->setFacilitylistId($getPostFacilityListID);

                //สร้าง logs
                $this->addLogger('Insert Facility2site', $entity);
            }        
            else {
                echo 'finish';
                exit();
            }   
        }else{
            $entity = $em->getRepository('FTRWebBundle:Facility2site')->find($getFacility[0]['id']);
            if ($getCheckPost == 'true'){
                $entity ->setDeleted(0);

                //สร้าง logs
                $this->addLogger('Update Facility2site', $entity);
            }else {
                $entity ->setDeleted(1);

                //สร้าง logs
                $this->addLogger('Update Facility2site: Deleted = 1', $entity);
            }
        } 
        $em->persist($entity);
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
}
