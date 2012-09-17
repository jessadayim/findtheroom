<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\WebBundle\Entity\User_owner;
use FTR\AdminBundle\Form\User_ownerType;

/**
 * User_owner controller.
 *
 */
class User_ownerController extends Controller
{
    /**
     * Lists all User_owner entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:User_owner')->findAll();

        return $this->render('FTRAdminBundle:User_owner:index.html.twig', array('entities' => $entities));
    }

    /**
     * Finds and displays a User_owner entity.
     *
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');

        $sqlGetEntity = "
						SELECT 
							username 
							,id
						FROM 
							user_owner 
						WHERE deleted != 1";
        try {
            $entities = $conn->fetchAll($sqlGetEntity);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        //$deleteForm = $this->createDeleteForm();

        return $this->render('FTRAdminBundle:User_owner:show.html.twig', array('entities' => $entities
            //'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new User_owner entity.
     *
     */
    public function newAction()
    {
        $entity = new User_owner();
        $entity = $this->getNewEntity($entity);
        $form = $this->createForm(new User_ownerType(), $entity);

        return $this->render('FTRAdminBundle:User_owner:new.html.twig', array('entity' => $entity, 'form' => $form->createView()));
    }

    /**
     * Creates a new User_owner entity.
     *
     */
    public function createAction()
    {
        $entity = new User_owner();
        $entity = $this->getNewEntity($entity);

        $request = $this->getRequest();
        $form = $this->createForm(new User_ownerType(), $entity);
        $form->bindRequest($request);

        $username = $entity->getUsername();
        if ($this->checkUser($username) == 1) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                $entity->setDeleted(0);

                $em->persist($entity);
                $em->flush();
var_dump($entity);
                exit();
                //Create เสร็จแล้ว
                echo 'finish';
                exit();
                //return $this->redirect($this->generateUrl('user_owner_show', array('id' => $entity->getId())));

            }
        } else {
            echo 'fail';
            exit();
        }
        return $this->render('FTRAdminBundle:User_owner:new.html.twig', array('entity' => $entity, 'form' => $form->createView()));
    }

    /**
     * Displays a form to edit an existing User_owner entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:User_owner')->find($id);
        $entity = $this->getNewEntity($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User_owner entity.');
        }

        $editForm = $this->createForm(new User_ownerType(), $entity);
        // $deleteForm = $this->createDeleteForm($id);
        // var_dump($entity);
        // exit();
        return $this->render('FTRAdminBundle:User_owner:edit.html.twig', array('entity' => $entity, 'edit_form' => $editForm->createView()
            //,'delete_form' => $deleteForm->createView()
        ));
        // echo "working";
        // exit();
    }

    /**
     * Edits an existing User_owner entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:User_owner')->find($id);
        $getCheckUpdateDeleted = @$_POST['checkdelete'];
        if ($getCheckUpdateDeleted == 'deleted') {
            $entity->setDeleted(1);
            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
        }

        $entity = $this->getNewEntity($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User_owner entity.');
        }

        $editForm = $this->createForm(new User_ownerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        $username = $entity->getUsername();
        if ($this->checkUser($username, $id) == 1) {
            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();

                echo "finish";
                exit();
                //return $this->redirect($this->generateUrl('user_owner_edit', array('id' => $id)));
            }
        } else {
            echo 'fail';
            exit();
        }
        return $this->render('FTRAdminBundle:User_owner:edit.html.twig', array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Deletes a User_owner entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:User_owner')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User_owner entity.');
            }

            $em->remove($entity);
            $em->flush();
            echo "finish";
            exit();
        }

        return $this->redirect($this->generateUrl('user_owner'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
    }

    private function getNewEntity($Entity)
    {

        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
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
            $Entity->userlevel = $conn->fetchAll($sqlGetUserlevel);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $Entity;
    }

    /**
     * function check Username Owner .
     *
     */
    private function checkUser($username = '', $id = '')
    {
        $conn = $this->get('database_connection');
        if (!$conn) {
            die("MySQL Connection error");
        }
        if (empty($id)) {
            $sqlGetOwner = "
            SELECT
              `username`
            FROM
              `user_owner`
            WHERE username = '$username'
        ";
        } else {
            $sqlGetOwner = "
            SELECT
              `username`
            FROM
              `user_owner`
            WHERE id != $id AND username = '$username'
        ";
        }
        try {
            $entityOwner = $conn->fetchAll($sqlGetOwner);

            if (count($entityOwner) == 0) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

    }
}
