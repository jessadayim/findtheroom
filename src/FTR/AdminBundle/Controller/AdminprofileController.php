<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\AdminBundle\Entity\User_admin;
use FTR\AdminBundle\Form\User_adminType;
use Symfony\Component\HttpFoundation\Session\Session;


class AdminprofileController extends Controller
{
    /**
     * Displays a form to edit an existing User_admin entity.
     *
     */
    public function editAction()
    {
        $session = $this->get('session');
        $id = $session->get('id');

        if (!empty($id)) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRAdminBundle:User_admin')->find($id);

//        $entity = $this -> getNewEntity($entity);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User_admin entity.');
            }

            $editForm = $this->createForm(new User_adminType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);

            return $this->render('FTRAdminBundle:Ftr_panel:adminprofile.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this -> redirect($this -> generateUrl('FTRAdminBundle_logout'));
        }
    }

    /**
     * Edits an existing User_admin entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:User_admin')->find($id);


//        $entity = $this -> getNewEntity($entity);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User_admin entity.');
        }

        $editForm = $this->createForm(new User_adminType(), $entity);
        //$deleteForm = $this -> createDeleteForm($id);

        $request = $this->getRequest();
        $editForm->bindRequest($request);

        $username = $entity->getUsername();
        if($this->checkUser($username,$id) == 1){
            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();

                echo 'finish';
                exit();
                //return $this -> redirect($this -> generateUrl('user_admin_edit', array('id' => $id)));
            }
        }else{
            echo 'fail';
            exit();
        }

        return $this->render('FTRAdminBundle:Ftr_panel:adminprofile.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm -> createView(),
        ));

    }

    /**
     * function check Username Admin .
     *
     */
    private function checkUser($username,$id){
        $conn = $this -> get('database_connection');
        if (!$conn) { die("MySQL Connection error");
        }
        $sqlGetAdmin = "
            SELECT
              `username`
            FROM
              `user_admin`
            WHERE id != $id AND username = '$username'
        ";
        try {
            $entityAdmin= $conn -> fetchAll($sqlGetAdmin);

            if(count($entityAdmin) == 0){
                return true;
            }
            return false;
        } catch (Exception $e) {
            echo 'Caught exception: ', $e -> getMessage(), "\n";
        }

    }

}