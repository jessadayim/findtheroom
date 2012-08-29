<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ListController extends Controller
{
    
    public function indexAction()
    {
        // var_dump($_POST);
        $test = "a";

        $result_data = array();
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            $whereQuery = null;
            $sql = "
                SELECT  a.id,
                    a.building_name,b.type_name,c.typename,
                    a.addr_number,a.addr_prefecture,a.addr_province,
                    a.addr_zipcode,a.detail,a.start_price,a.end_price,
                    a.latitude,a.longitude
                FROM building_site a
                INNER JOIN building_type b ON(a.building_type_id=b.id)
                INNER JOIN pay_type c ON(a.pay_type_id=c.id)
                WHERE 1
            ";
            $result = $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $name="aaaa";
        $numdata = count($result);
		return $this->render('FTRWebBundle:List:index.html.twig', array(
            'result' => $result,
            'numdata'=> $numdata,
            'test'=> $test,
            'name'=> $name,
        ));
    }
}
