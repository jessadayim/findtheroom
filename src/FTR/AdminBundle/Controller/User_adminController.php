<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\AdminBundle\Entity\User_admin;
use FTR\AdminBundle\Form\User_adminType;

/**
 * User_admin controller.
 *
 */
class User_adminController extends Controller {
	/**
	 * Lists all User_admin entities.
	 *
	 */
	public function indexAction() {
		$em = $this -> getDoctrine() -> getEntityManager();

		$entities = $em -> getRepository('FTRAdminBundle:User_admin') -> findAll();

		return $this -> render('FTRAdminBundle:User_admin:index.html.twig', array(
			'entities' => $entities
			));
	}

	/**
	 * Finds and displays a User_admin entity.
	 *
	 */
	public function showAction() {
		$em = $this -> getDoctrine() -> getEntityManager();
		$conn= $this->get('database_connection');
		
		$sqlGetEntity = "
						SELECT 
							username 
							,id
						FROM 
							user_admin 
						WHERE deleted != 1";
		try{
            $entities = $conn->fetchAll($sqlGetEntity);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

		//$deleteForm = $this->createDeleteForm($id);

		return $this -> render('FTRAdminBundle:User_admin:show.html.twig', array(
			'entities' => $entities
		//'delete_form' => $deleteForm->createView(),

		));
	}

	/**
	 * Displays a form to create a new User_admin entity.
	 *
	 */
	public function newAction() {

		$entity = new User_admin();
		$entity = $this -> getNewEntity($entity);
		$form = $this -> createForm(new User_adminType(), $entity);

		return $this -> render('FTRAdminBundle:User_admin:new.html.twig', array(
			'entity' => $entity, 
			'form' => $form -> createView()
		));
	}

	/**
	 * Creates a new User_admin entity.
	 *
	 */
	public function createAction() {
		$entity = new User_admin();
		$entity = $this -> getNewEntity($entity);

		$request = $this -> getRequest();
		$form = $this -> createForm(new User_adminType(), $entity);
		$form -> bindRequest($request);

		if ($form -> isValid()) {
			$em = $this -> getDoctrine() -> getEntityManager();

			$entity -> setDeleted(0);

			$em -> persist($entity);
			$em -> flush();

			//Create เสร็จแล้ว
			echo 'finish';
			exit();
			//return $this->redirect($this->generateUrl('user_admin_show', array('id' => $entity->getId())));

		}
		return $this -> render('FTRAdminBundle:User_admin:new.html.twig', array(
			'entity' => $entity, 
			'form' => $form -> createView()));
	}

	/**
	 * Displays a form to edit an existing User_admin entity.
	 *
	 */
	public function editAction($id) {
		$em = $this -> getDoctrine() -> getEntityManager();		
		$entity = $em -> getRepository('FTRAdminBundle:User_admin') -> find($id);
		
		$entity = $this -> getNewEntity($entity);

		if (!$entity) {
			throw $this -> createNotFoundException('Unable to find User_admin entity.');
		}

		$editForm = $this -> createForm(new User_adminType(), $entity);
		$deleteForm = $this->createDeleteForm($id);

		return $this -> render('FTRAdminBundle:User_admin:edit.html.twig', array(
			'entity' => $entity, 
			'edit_form' => $editForm -> createView(),
		//'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Edits an existing User_admin entity.
	 *
	 */
	public function updateAction($id) {
		$em = $this -> getDoctrine() -> getEntityManager();

		$entity = $em -> getRepository('FTRAdminBundle:User_admin') -> find($id);	
		
		//ตรวจสอบการ ส่งตัวแปรให้อัพเดท Building Site Feid Deleted เป็น 1	
		$getCheckUpdateDeleted = @$_POST['checkdelete'];
        if ($getCheckUpdateDeleted == 'deleted'){
            $entity->setDeleted(1);
            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
        }
		
		$entity = $this -> getNewEntity($entity);
		if (!$entity) {
			throw $this -> createNotFoundException('Unable to find User_admin entity.');
		}
	
		$editForm = $this -> createForm(new User_adminType(), $entity);
		$deleteForm = $this -> createDeleteForm($id);

		$request = $this -> getRequest();

		$editForm -> bindRequest($request);

		if ($editForm -> isValid()) {
			$em -> persist($entity);
			$em -> flush();

			echo 'finish';
            exit();
			//return $this -> redirect($this -> generateUrl('user_admin_edit', array('id' => $id)));
		}

		return $this -> render('FTRAdminBundle:User_admin:edit.html.twig', array(
			'entity' => $entity, 
			'edit_form' => $editForm -> createView(), 
			'delete_form' => $deleteForm -> createView(), ));
	}

	/**
	 * Deletes a User_admin entity.
	 *
	 */
	public function deleteAction($id) {
		$form = $this -> createDeleteForm($id);
		$request = $this -> getRequest();

		$form -> bindRequest($request);

		if ($form -> isValid()) {
			$em = $this -> getDoctrine() -> getEntityManager();
			$entity = $em -> getRepository('FTRAdminBundle:User_admin') -> find($id);
			$entity = $this -> getNewEntity($entity);

			if (!$entity) {
				throw $this -> createNotFoundException('Unable to find User_admin entity.');
			}

			$em -> remove($entity);
			$em -> flush();
			
			echo 'finish';
            exit();
		}

		return $this -> redirect($this -> generateUrl('user_admin'));
	}

	private function createDeleteForm($id) {
		return $this -> createFormBuilder(array('id' => $id)) -> add('id', 'hidden') -> getForm();
	}

	private function getNewEntity($Entity) {

		$conn = $this -> get('database_connection');
		if (!$conn) { die("MySQL Connection error");
		}
		$sqlGetUserlevel = "
            SELECT 
              `id`,
              `level_name` 
            FROM
              `user_level` 
            WHERE `is_enabled` != 1 
        ";
		try {
			$Entity -> user_level = $conn -> fetchAll($sqlGetUserlevel);
		} catch (Exception $e) {
			echo 'Caught exception: ', $e -> getMessage(), "\n";
		}
		return $Entity;
	}

}
