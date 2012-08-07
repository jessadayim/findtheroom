<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SearchController extends Controller
{
    
    public function searchAction()
    {
        $fac_inroomlist = NULL;	
		
        $conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				/**
				 * query for facility list inroom type
				 */
				$sql ="select * from facilitylist where facility_type = 'inroom'";
				$faclist_inroom = $conn->fetchAll($sql);
				$countall_inroom = count($faclist_inroom);
				foreach ($faclist_inroom as $key => $value) {
					$count = $key+1;
					$list[] = array(
						'id'				=> $value['id'],
						'facility_name'		=> $value['facility_name'],
						'facility_type'		=> $value['facility_type'],
					);
					if($count%4==0){
						$fac_inroomlist[] = array('loop'=>$list);
						$list = NULL;
					}elseif($count==$countall_inroom){
						$fac_inroomlist[] = array('loop'=>$list);
						$list = NULL;
					}
				}
				/*echo "<pre>";
				var_dump($fac_inroomlist);
				echo "</pre>";
				exit();*/
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
		
        return $this->render('FTRWebBundle:Search:search.html.twig', array('fac_inroom' => $fac_inroomlist));
    }
}
