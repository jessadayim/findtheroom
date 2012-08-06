<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\WebBundle\Entity\Building_site;
use Acme\WebBundle\Repository\Building_siteRepository;

class MainController extends Controller
{
    
    public function indexAction()
    {
    	$id = 1;
    	$em = $this->getDoctrine()->getEntityManager();
		
		$conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				$sql1 ="SELECT b.*,n.*,t.*,z.* FROM building_site b JOIN building_type t ON b.building_type_id = t.id
									 JOIN zone z ON b.zone_id = z.id
									 JOIN nearly2site n2 ON n2.building_site_id = b.id
									 JOIN nearly_location n ON n.id = n2.nearly_location_id
									 JOIN nearly_type nt ON nt.id = n.nearly_type_id
						WHERE b.recommend = 0 and nt.id = 1";
				$objSQL1 = $conn->fetchAll($sql1);
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			try{
				$sql2 ="SELECT b.*,n.*,t.*,z.* FROM building_site b JOIN building_type t ON b.building_type_id = t.id
									 JOIN zone z ON b.zone_id = z.id
									 JOIN nearly2site n2 ON n2.building_site_id = b.id
									 JOIN nearly_location n ON n.id = n2.nearly_location_id
									 JOIN nearly_type nt ON nt.id = n.nearly_type_id
						WHERE b.recommend = 0 and nt.id = 2";
				$objSQL2 = $conn->fetchAll($sql2);
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			try{
				$sql3 ="SELECT b.*,n.*,t.*,z.* FROM building_site b JOIN building_type t ON b.building_type_id = t.id
									 JOIN zone z ON b.zone_id = z.id
									 JOIN nearly2site n2 ON n2.building_site_id = b.id
									 JOIN nearly_location n ON n.id = n2.nearly_location_id
									 JOIN nearly_type nt ON nt.id = n.nearly_type_id
						WHERE b.recommend = 0 and nt.id =3";
				$objSQL3 = $conn->fetchAll($sql3);
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		//var_dump($objSQL1,$objSQL2,$objSQL3);
		//exit();
       return $this->render('FTRWebBundle:Main:index.html.twig',array('item1'=>$objSQL1,'item2'=>$objSQL2,'item3'=>$objSQL3));
    }
}
