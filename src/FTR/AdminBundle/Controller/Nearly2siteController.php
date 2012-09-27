<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Nearly2site;
use FTR\AdminBundle\Form\Nearly2siteType;
use FTR\AdminBundle\Helper\LoggerHelper;

/**
 * Nearly2site controller.
 *
 */
class Nearly2siteController extends Controller
{

    /**
     * Finds and displays a Nearly2site entity.
     *
     */
    public function showAction($id)
    {
        $sqlGetBuildingSite = "
            SELECT
              *
            FROM
              `building_site`
            WHERE `deleted` != 1
              AND id = $id
        ";
        $ObjBuildingSite = $this->getDataArray($sqlGetBuildingSite);
        $sqlGetNear2Site = "
            SELECT
              *
            FROM
              `nearly2site`
            WHERE `building_site_id` = $id
              AND `deleted` != 1
        ";
        $ObjGetNear2Site = $this->getDataArray($sqlGetNear2Site);
        foreach ($ObjGetNear2Site as $key => $value){
            $ObjGetNear2Site[$key]['count'] = $key+1;
        }

        $sqlGetNearlyLocation = "
            SELECT
              l.*,
              t.`type_name`,
              s.id AS nearly2site_id
            FROM
              `nearly_location` l
              INNER JOIN `nearly_type` t
                ON (t.`id` = l.`nearly_type_id`)
              LEFT JOIN `nearly2site` s
                ON (
                  s.`nearly_location_id` = l.`id`
                  AND s.`building_site_id` = $id
                  AND s.`deleted` != 1
                )
            WHERE l.`deleted` != 1
              AND t.`deleted` != 1
        ";
        $ObjGetNearlyLocation = $this->getDataArray($sqlGetNearlyLocation);

        return $this->render('FTRAdminBundle:Nearly2site:show.html.twig', array(
            'near2site'      => $ObjGetNear2Site,
            'buildingsite'   => $ObjBuildingSite,
            'nearlylocation' => $ObjGetNearlyLocation
        ));
    }

    /**
     * Creates a new Nearly2site entity.
     *
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $getBuildingSiteId = @$_POST['building_site_id'];
        $getNearlyPost = @$_POST['nearlyPost'];
        $sqlGeNearly2Site = "
            SELECT
              *
            FROM
              `nearly2site`
            WHERE `building_site_id` = $getBuildingSiteId
        ";
        $objGeNearly2Site = $this->getDataArray($sqlGeNearly2Site);
        if (empty($objGeNearly2Site)){
            foreach ($getNearlyPost as $key => $value) {
                $entity  = new Nearly2site();
                $entity ->setBuildingSiteId($getBuildingSiteId);
                $entity ->setNearlyLocationId($value);
                $entity ->setDeleted(0);
                $em->persist($entity);

                //สร้าง logs
                $this->addLogger('Insert Nearly2site', $entity);
            }
        }else{
            foreach ($objGeNearly2Site as $key => $value) {
                $entity = $em->getRepository('FTRWebBundle:Nearly2site')->find($value['id']);
                if ($key < count($getNearlyPost)){
                    $entity ->setBuildingSiteId($getBuildingSiteId);
                    $entity ->setNearlyLocationId($getNearlyPost[$key]);
                    $entity ->setDeleted(0);
                }else{
                    $entity ->setBuildingSiteId($getBuildingSiteId);
                    $entity ->setNearlyLocationId(0);
                    $entity ->setDeleted(0);
                }
                $em->persist($entity);

                //สร้าง logs
                $this->addLogger('Update Nearly2site', $entity);
            }
            if (count($objGeNearly2Site) < count($getNearlyPost)){
                foreach ($getNearlyPost as $key => $value) {
                    if ($key >= count($objGeNearly2Site)){
                        $entity  = new Nearly2site();
                        $entity ->setBuildingSiteId($getBuildingSiteId);
                        $entity ->setNearlyLocationId($value);
                        $entity ->setDeleted(0);
                        $em->persist($entity);
                    }
                }

                //สร้าง logs
                $this->addLogger('Insert Nearly2site', $entity);
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
