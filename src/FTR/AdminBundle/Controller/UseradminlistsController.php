<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\AdminBundle\Entity\User_admin;

class UseradminlistsController extends Controller {
	
	public function createAction() {
		$request = $this -> get('request');

		$username = $request -> get('AdminUsername');
		$password = $request -> get('AdminPassword');
		$fristName = $request -> get('AdminFristName');
		$lastName = $request -> get('AdminLastName');
		$phone = $request -> get('AdminPhoneNumber');
		$level = $request -> get('AdminLevel');

		$em = $this -> getDoctrine() -> getEntityManager();
		$conn = $this -> get('database_connection');
		if (!$conn) {
			die("MySQL Connection error");
			exit();
		}
		if ($request -> getMethod() == 'POST') {
			if ($username != '' && $password != '') {
				try {
					$sql1 = "INSERT INTO user_admin(username,password,firstname,lastname,phone_number,userlevel) 
									VALUES('$username','$password','$fristName','$lastName','$phone','$level')";
					$conn -> query($sql1);
				} catch(exception $e) {
					echo 'Caught exception: ', $e -> getMessage(), "\n";
				}
			}
		}
		return $this -> redirect($this -> generateUrl('FTRAdminBundle_Useradminlists'));
	}

    public function showdataAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
		$conn = $this -> get('database_connection');
		if (!$conn) {
			die("MySQL Connection error");
			exit();
		}

        $entity = $em->getRepository('FTRAdminBundle:user_admin')->find($id);

        //$entity = $this->getNewEntity($entity);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_site entity.');
        }

        //$editForm = $this->createForm(new Building_siteType(), $entity);
        //$deleteForm = $this->createDeleteForm($id);
        $id = $entity->getID();
        $data = array('id' => $entity->getID() );
		echo $data;
        exit();
        // return $this->render('FTRAdminBundle:Ftr_panel:useradminlists.html.twig', array(
            // 'entity'      => $entity
            // //'edit_form'   => $editForm->createView(),
            // // 'delete_form' => $deleteForm->createView(),
        // ));
    }

	public function indexAction() {
		$em = $this -> getDoctrine() -> getEntityManager();
		$conn = $this -> get('database_connection');
		if (!$conn) {
			die("MySQL Connection error");
			exit();
		}
		try {
			$sql1 = "SELECT * FROM user_admin";
			$objSQL1 = $conn -> fetchAll($sql1);
		} catch(exception $e) {
			echo 'Caught exception: ', $e -> getMessage(), "\n";
		}
		
		return $this -> render('FTRAdminBundle:Ftr_panel:useradminlists.html.twig', array('objSQL1'=>$objSQL1));
	}

}
