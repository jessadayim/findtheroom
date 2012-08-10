<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserbuildingController extends Controller
{
    
    public function indexAction()
    {
        $session = $this->get('session');
		$session->get('user');
		
        return $this->render('FTRWebBundle:Userbuilding:listap.html.twig', array());
    }
	
	public function addDataAction($id=null)
	{
		$fac_inroomlist = NULL;
		$fac_outroomlist = NULL;
        $conn= $this->get('database_connection');
		if(!$conn){ die("MySQL Connection error");}
			try{
				/**
				 * query for facility list inroom type
				 */
				$sql ="select * from facilitylist where facility_type = 'inroom' and display = 1";
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
				
				/**
				 * query for facility list outroom type
				 */
				$sql ="select * from facilitylist where facility_type = 'outroom' and display = 1";
				$faclist_outroom = $conn->fetchAll($sql);
				$countall_outroom = count($faclist_outroom);
				foreach ($faclist_outroom as $key => $value) {
					$count = $key+1;
					$list[] = array(
						'id'				=> $value['id'],
						'facility_name'		=> $value['facility_name'],
						'facility_type'		=> $value['facility_type'],
					);
					if($count%4==0){
						$num = 4;
						if($count==$countall_outroom)
						{
							$fac_outroomlist[] = array('loop'=>$list,'stat'=>'end','count'=>$num);
						}else{
							$fac_outroomlist[] = array('loop'=>$list,'stat'=>'not','count'=>$num);
						}
						$list = NULL;
					}elseif($count==$countall_outroom){
						$countlist = count($list);
						$num = 4-$countlist;
						$fac_outroomlist[] = array('loop'=>$list,'stat'=>'end','count'=>$num);
						$list = NULL;
					}
				}
				/*echo "<pre>";
				var_dump($fac_outroomlist);
				echo "</pre>";
				exit();*/
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
				
		return $this->render('FTRWebBundle:Userbuilding:add.html.twig', array(
			'build_id'		=> $id,
			'fac_inroom'	=> $fac_inroomlist,
			'fac_outroom'	=> $fac_outroomlist,
		));
	}
	
	public function saveDataAction($id=null)
	{
		if($_POST)
		{
			var_dump($_POST);
		}
		exit();
	}
	
	public function sendemailAction()
	{
		$name = "extest";
		$message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('jessaday@sourcecode.co.th')
        ->setTo('exodist@gmail.com')
        ->setBody($this->renderView('FTRWebBundle:Userbuilding:email.html.twig', array('name' => $name)),'text/html');
    	
    	$this->get('mailer')->send($message);

    return $this->render('FTRWebBundle:Userbuilding:email.html.twig', array('name' => $name));
	}
}
