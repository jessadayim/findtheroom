<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\WebBundle\Entity\User_owner;
use FTR\AdminBundle\Form\User_ownerType;
use FTR\AdminBundle\Helper\Paginator;

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

        //get post
        $getSelectPage = @$_GET['numPage'];
        $getRecord = @$_GET['record'];
        $getTextSearch = @$_GET['textSearch'];
        $getOrderBy = @$_GET['orderBy'];
        $getOrderByType = @$_GET['orderByType'];

        //set paging
        $page = 1;
        if (!empty($getSelectPage)) {
            $page = $getSelectPage;
        }
        $limit = 10;
        $midRange = 5;
        if (!empty($getRecord)) {
            $limit = $getRecord;
        } else {
            $getRecord = $limit;
        }
        $offset = $limit * $page - $limit;
        if (empty($getOrderBy) && empty($getOrderByType)) {
            $getOrderBy = 'id';
            $getOrderByType = 'asc';
        }
        $getEntitiesAll = $em->getRepository('FTRWebBundle:User_owner')->findBy(array('deleted' => 0));
        $countListEntities = count($getEntitiesAll);

        $entities = $em->getRepository('FTRWebBundle:User_owner')->getDataOwner($limit, $offset, $getTextSearch, $countListEntities, "$getOrderBy");
        $paginator = new Paginator($countListEntities, $offset, $limit, $midRange);

        return $this->render('FTRAdminBundle:User_owner:show.html.twig', array(
            'entities' => $entities,
            'paginator'	        => $paginator,
            'countListEntities'		=> $countListEntities,
            'limit' 	        => $limit,
            'noPage'	        => $page,
            'record'	        => $getRecord,
            'textSearch'        => $getTextSearch,
            'orderBy'             => $getOrderBy
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

                $password = md5($entity->getPassword());
                $entity->setPassword($password);
                $entity->setDeleted(0);

                $em->persist($entity);
                $em->flush();
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
        $entity = $this->getNewEntity($entity, false);

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
        $getPassword = $entity->getPassword();
        $getCheckUpdateDeleted = @$_POST['checkdelete'];
        if ($getCheckUpdateDeleted == 'deleted') {
            $entity->setDeleted(1);
            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
        }

        $entity = $this->getNewEntity($entity, false);

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
                $newPass = $entity->getPassword();
                if (!empty($newPass)) {
                    $password = md5($newPass);
                    $entity->setPassword($password);
                } else {
                    $entity->setPassword($getPassword);
                }

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

    private function getNewEntity($Entity, $requirePassword = true)
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
            $Entity->requiredPassword = $requirePassword;
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
