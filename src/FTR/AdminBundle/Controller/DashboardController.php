<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DashboardController extends Controller
{
    
    public function indexAction()
    {
        $sql1Day ="
            SELECT
              COUNT(a.`id`) AS c
            FROM
              `ads_control` a
            WHERE DATEDIFF(a.`date_end`, NOW()) = 0
        ";

        $obj1Day = $this->getDataArray($sql1Day);

        $sql3Day ="
            SELECT
              COUNT(a.`id`) AS c
            FROM
              `ads_control` a
            WHERE DATEDIFF(a.`date_end`, NOW()) > 0
              AND DATEDIFF(a.`date_end`, NOW()) < 3
        ";

        $obj3Day = $this->getDataArray($sql3Day);

        $sql7Day ="
            SELECT
              COUNT(a.`id`) AS c
            FROM
              `ads_control` a
            WHERE DATEDIFF(a.`date_end`, NOW()) > 2
              AND DATEDIFF(a.`date_end`, NOW()) < 7
        ";

        $obj7Day = $this->getDataArray($sql7Day);

        return $this->render('FTRAdminBundle:Ftr_panel:dashboard.html.twig', array(
            'session'   => 1,
            'day1'      => $obj1Day[0]['c'],
            'day3'      => $obj3Day[0]['c'],
            'day7'      => $obj7Day[0]['c']
        ));
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
