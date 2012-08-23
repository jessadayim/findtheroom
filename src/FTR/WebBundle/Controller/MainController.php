<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\WebBundle\Entity\Building_site;
use Acme\WebBundle\Repository\Building_siteRepository;

class MainController extends Controller
{
    
    public function indexAction()
    {
       return $this->render('FTRWebBundle:Main:index.html.twig',array());
    }
	/**
	 * function for query slide recommend
	 * */
	public function recomAction(){
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
						WHERE b.recommend = 1 and nt.id = 1";
				$objSQL1 = $conn->fetchAll($sql1);
				if(count($objSQL1)<=3){
					$numrow1 = 0;
				}else{
					$numrow1 = 1;
				}	
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			try{
				$sql2 ="SELECT b.*,n.*,t.*,z.* FROM building_site b JOIN building_type t ON b.building_type_id = t.id
									 JOIN zone z ON b.zone_id = z.id
									 JOIN nearly2site n2 ON n2.building_site_id = b.id
									 JOIN nearly_location n ON n.id = n2.nearly_location_id
									 JOIN nearly_type nt ON nt.id = n.nearly_type_id
						WHERE b.recommend = 1 and nt.id = 2";
				$objSQL2 = $conn->fetchAll($sql2);
				if(count($objSQL2)<=3){
					$numrow2 = 0;
				}else{
					$numrow2 = 1;
				}				
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			try{
				$sql3 ="SELECT b.*,n.*,t.*,z.* FROM building_site b JOIN building_type t ON b.building_type_id = t.id
									 JOIN zone z ON b.zone_id = z.id
									 JOIN nearly2site n2 ON n2.building_site_id = b.id
									 JOIN nearly_location n ON n.id = n2.nearly_location_id
									 JOIN nearly_type nt ON nt.id = n.nearly_type_id
						WHERE b.recommend = 1 and nt.id =3";
				$objSQL3 = $conn->fetchAll($sql3);
				if(count($objSQL3)<=3){
					$numrow3 = 0;
				}else{
					$numrow3 = 1;
				}
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			return $this->render('FTRWebBundle:Main:recom.html.twig',array('item1'=>$objSQL1,'numrow1'=>$numrow1,'item2'=>$objSQL2,'numrow2'=>$numrow2,'item3'=>$objSQL3,'numrow3'=>$numrow3));
	}
}
