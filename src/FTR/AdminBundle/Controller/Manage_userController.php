<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\AdminBundle\Entity\User_admin;

/**
 * Manage_user controller.
 *
 * @Route("/manage_user")
 */
class Manage_userController extends Controller {
	/**
	 * Lists all User_admin entities.
	 *
	 * @Route("/", name="manage_user")
	 * @Template()
	 */
	public function indexAction() {
		// $em = $this -> getDoctrine() -> getEntityManager();
		//
		// $entities = $em -> getRepository('FTRAdminBundle:User_admin') -> findAll();
		//
		// return array('entities' => $entities);
		return array('checkhide' => 'false', 'session' => true);
		//return $this -> render('FTRAdminBundle:User_admin:index.html.twig', array());
	}

	public function createAction() {
		if ($_POST) {
			$entity = new User_admin();
			
			$username = $_POST['AdminUsername'];
			$password = $_POST['AdminPassword'];
			$firstname = $_POST['AdminFristName'];
			$lastname = $_POST['AdminLastName'];
			$phonenumber = $_POST['AdminPhoneNumber'];

			$em = $this -> getDoctrine() -> getEntityManager();
			
			try {
				$entity -> setUsername($username);
				$entity -> setPassword($password);
				$entity -> setFirstname($firstname);
				$entity -> setLastname($lastname);
				$entity -> setPhone_number($phonenumber);
				$entity -> setUserlevel(0);
				$entity -> setDeleted(0);
				
				$em->persist($entity);
				$em -> flush();

				echo "finish";
			} catch (Exception $e) {
				echo "error";
			}

			exit();
		}
		return $this -> render('FTRAdminBundle:User_admin:Manage_user:create.html.twig', array());
	}

	public function editAction($id) {
		$em = $this -> getDoctrine() -> getEntityManager();
		$entity = $em -> getRepository('FTRAdminBundle:User_admin') -> find($id);

		return $this -> render('FTRAdminBundle:User_admin:Manage_user:edit.html.twig', array('entity' => $entity));
	}

	public function updateAction($id) {
		if ($_POST) {
			$username = $_POST['AdminUsername'];
			$password = $_POST['AdminPassword'];
			$firstname = $_POST['AdminFristName'];
			$lastname = $_POST['AdminLastName'];
			$phonenumber = $_POST['AdminPhoneNumber'];

			$em = $this -> getDoctrine() -> getEntityManager();
			$entity = $em -> getRepository('FTRAdminBundle:User_admin') -> find($id);
			try {
				if (!$entity) {
					throw $this -> createNotFoundException('No product found for id ' . $id);
				}
				$entity -> setUsername($username);
				$entity -> setPassword($password);
				$entity -> setFirstname($firstname);
				$entity -> setLastname($lastname);
				$entity -> setPhone_number($phonenumber);

				$em -> flush();

				echo "finish";
			} catch (Exception $e) {
				echo "error";
			}

			exit();
		}

	}

	public function deleteAction($id) {
		if (!empty($id)) {
			$em = $this -> getDoctrine() -> getEntityManager();
			$entity = $em -> getRepository('FTRAdminBundle:User_admin') -> find($id);
			try {
				if (!$entity) {
					throw $this -> createNotFoundException('No product found for id ' . $id);
				}

				$em -> remove($entity);
				$em -> flush();

				echo "finish";
			} catch (Exception $e) {
				echo "error";
			}
			exit();
		}
	}

	/**
	 * Finds and displays a User_admin entity.
	 *
	 * @Route("/{id}/show", name="user_admin_show")
	 * @Template()
	 */
	public function showAction() {
		$em = $this -> getDoctrine() -> getEntityManager();

		$entity = $em -> getRepository('FTRAdminBundle:User_admin') -> findAll();

		if (!$entity) {
			throw $this -> createNotFoundException('Unable to find User_admin entity.');
		}

		return array('entities' => $entity, );
	}

}
