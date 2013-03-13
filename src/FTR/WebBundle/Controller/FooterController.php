<?php
namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ListController extends Controller
{
    public function indexAction(){

        $btsLocation = $this->getBtsLocation();
        $mrtLocation = $this->getMrtLocation();
        $buildingType = $this->getBuildingType();

        return $this->render('FTRWebBundle:List:showList.html.twig', array(
            'bts' => $btsLocation,
            'mrt' => $mrtLocation
        ));
    }

    public function getBtsLocation(){

        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }

        try{
            $sqlGetBts = "
            SELECT
              `id`,
              `nearly_type_id`,
              `name`
            FROM
              `nearly_location`
            WHERE 1
              AND `nearly_type_id` = 2
              AND `deleted` = 0 ";
            $result = $conn->fetchAll($sqlGetBts);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $result;

    }

    public function getMrtLocation(){
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }

        try{
            $sqlGetBts = "
            SELECT
              `id`,
              `nearly_type_id`,
              `name`
            FROM
              `nearly_location`
            WHERE 1
              AND `nearly_type_id` = 3
              AND `deleted` = 0 ";
            $result = $conn->fetchAll($sqlGetBts);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $result;
    }

    public function getBuildingType(){

        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }

        try{
            $sqlGetBts = "
              SELECT
                `id`,
                `type_name`
              FROM
                `building_type`
              WHERE 1
                AND `deleted` = 0  ";
            $result = $conn->fetchAll($sqlGetBts);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $result;

    }
}
?>