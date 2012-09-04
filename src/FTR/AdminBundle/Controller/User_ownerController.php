<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\WebBundle\Entity\User_owner;

/**
 * User_owner controller.
 *
 * @Route("/user_owner")
 */
class User_ownerController extends Controller {
	/**
	 * Lists all User_admin entities.
	 *
	 * @Route("/", name="user_admin")
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
			$entity = new User_owner();
			
			$username = $_POST['OwnerUsername'];
			$password = $_POST['OwnerPassword'];
			$firstname = $_POST['OwnerFristName'];
			$lastname = $_POST['OwnerLastName'];
			$phonenumber = $_POST['OwnerPhoneNumber'];
			$fax = $_POST['OwnerFaxNumber'];
			$email = $_POST['OwnerEmail'];

			$em = $this -> getDoctrine() -> getEntityManager();
			
			try {
				$entity -> setUsername($username);
				$entity -> setPassword($password);
				$entity -> setFirstname($firstname);
				$entity -> setLastname($lastname);
				$entity -> setPhone_number($phonenumber);
				$entity -> setFax_number($fax);
				$entity -> setEmail($email);
				$entity -> setDeleted(0);
				
				$em->persist($entity);
				$em -> flush();

				echo "finish";
			} catch (Exception $e) {
				echo "error";
			}

			exit();
		}
		return $this -> render('FTRAdminBundle:User_owner:create.html.twig', array());
	}

	public function editAction($id) {
		$em = $this -> getDoctrine() -> getEntityManager();
		$entity = $em -> getRepository('FTRWebBundle:User_owner') -> find($id);
		
		return $this -> render('FTRAdminBundle:User_owner:edit.html.twig', array('entity' => $entity));
	}

	public function updateAction($id) {
		if ($_POST) {
			$username = $_POST['OwnerUsername'];
			$password = $_POST['OwnerPassword'];
			$firstname = $_POST['OwnerFristName'];
			$lastname = $_POST['OwnerLastName'];
			$phonenumber = $_POST['OwnerPhoneNumber'];
			$fax = $_POST['OwnerFaxNumber'];
			$email = $_POST['OwnerEmail'];

			$em = $this -> getDoctrine() -> getEntityManager();
			$entity = $em -> getRepository('FTRWebBundle:User_owner') -> find($id);
			try {
				if (!$entity) {
					throw $this -> createNotFoundException('No product found for id ' . $id);
				}
				$entity -> setUsername($username);
				$entity -> setPassword($password);
				$entity -> setFirstname($firstname);
				$entity -> setLastname($lastname);
				$entity -> setPhone_number($phonenumber);
				$entity -> setFax_number($fax);
				$entity -> setEmail($email);
				
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
			$entity = $em -> getRepository('FTRWebBundle:User_owner') -> find($id);
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

		$entity = $em -> getRepository('FTRWebBundle:User_owner') -> findAll();
	// $entity->getUsername();
		// exit();
		if (!$entity) {
			throw $this -> createNotFoundException('Unable to find User_admin entity.');
		}
		
		return array('entities' => $entity, );
	}

}
