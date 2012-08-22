<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DetailController extends Controller
{
    
    public function DetailAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();		
		$conn= $this->get('database_connection');
		
		try{
				$sql1 ="SELECT b.*,n.*,t.*,z.*,p.* FROM building_site b JOIN building_type t ON b.building_type_id = t.id
									JOIN zone z ON b.zone_id = z.id
									JOIN pay_type p ON p.id = b.pay_type_id
									JOIN nearly2site n2 ON n2.building_site_id = b.id
									JOIN nearly_location n ON n.id = n2.nearly_location_id
									JOIN nearly_type nt ON nt.id = n.nearly_type_id
						WHERE b.id = 1";
				$objSQL1 = $conn->fetchAll($sql1);
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		try{
				$sql2 ="SELECT * FROM roomtype2site s JOIN roomtype t ON s.roomtype_id = t.id
						WHERE s.building_site_id = 1";
				$objSQL2 = $conn->fetchAll($sql2);
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		try{
				$sql3 ="SELECT * FROM facilitylist f LEFT JOIN facility2site f2 ON f2.facilitylist_id = f.id
						WHERE f.facility_type = 'inroom'";
				$objSQL3 = $conn->fetchAll($sql3);
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		try{
				$sql4 ="SELECT * FROM facilitylist f LEFT JOIN facility2site f2 ON f2.facilitylist_id = f.id
						WHERE f.facility_type = 'outroom'";
				$objSQL4 = $conn->fetchAll($sql4);
		
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			 // var_dump($objSQL3);
			 // exit();
        return $this->render('FTRWebBundle:Detail:detail.html.twig', array('item1'=>$objSQL1[0],'item2'=>$objSQL2,'item3'=>$objSQL3,'item4'=>$objSQL4));
    }
}