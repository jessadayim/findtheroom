<?php
namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class FooterController extends Controller
{
    public function indexAction(){

        $btsLocation = $this->getBtsLocation();
        $mrtLocation = $this->getMrtLocation();
        $typeLocation = $this->getBuildingTypeLocation();
        $payTypeLocation = $this->getBuildingPayTypeLocation();
        $universityLocation = $this->getUniversityLocation();
        $zoneLocation = $this->getZoneLocation();

//        echo "<pre>";
//        var_dump($btsLocation);exit();
//        echo "</pre>";

        return $this->render('FTRWebBundle:Footer:footer.html.twig', array(
            'type'      => $typeLocation,
            'payType'   => $payTypeLocation,
            'bts'       => $btsLocation,
            'mrt'       => $mrtLocation,
            'university'=> $universityLocation,
            'zone'      => $zoneLocation
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
              AND `deleted` = 0
              ";
            $result = $conn->fetchAll($sqlGetBts);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        foreach($result as $key => $value){
            $result[$key]["countBts"] = $key;
        }

        return $result;
    }

    public function getMrtLocation(){

        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }

        try{
            $sqlGetMtr = "
            SELECT
              `id`,
              `nearly_type_id`,
              `name`
            FROM
              `nearly_location`
            WHERE 1
              AND `nearly_type_id` = 3
              AND `deleted` = 0 ";
            $result = $conn->fetchAll($sqlGetMtr);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $result;
    }

    public function getBuildingTypeLocation(){

        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }

        try{
            $sqlGetBuildingType = "
              SELECT
                `id`,
                `type_name`
              FROM
                `building_type`
              WHERE 1
                AND `deleted` = 0  ";
            $result = $conn->fetchAll($sqlGetBuildingType);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $result;

    }

    public function getBuildingPayTypeLocation(){
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }

        try{
            $sqlGetPayType = "
              SELECT
                `id`,
                `typename`
              FROM
                `pay_type`
              WHERE 1
                AND `deleted` = 0  ";
            $result = $conn->fetchAll($sqlGetPayType);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $result;
    }

    public function getUniversityLocation(){

        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }

        try{
            $sqlGetUniversity = "
            SELECT
              `id`,
              `nearly_type_id`,
              `name`
            FROM
              `nearly_location`
            WHERE 1
              AND `nearly_type_id` = 4
              AND `deleted` = 0
              ";
            $result = $conn->fetchAll($sqlGetUniversity);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        foreach($result as $key => $value){
            $result[$key]["countUniversity"] = $key;
        }

        return $result;
    }

    public function getZoneLocation(){

        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }

        try{
            $sqlGetZone = "
            SELECT
              `id`,
              `zonename`,
              `latitude`,
              `longitude`,
              `deleted`
            FROM `zone`
            WHERE 1
              AND `deleted` = 0
              ";
            $result = $conn->fetchAll($sqlGetZone);

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $result;

    }
}
?>