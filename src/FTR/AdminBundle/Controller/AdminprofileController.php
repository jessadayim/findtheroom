<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\AdminBundle\Entity\User_admin;
use FTR\AdminBundle\Form\User_adminType;


class AdminprofileController extends Controller
{
    /**
     * Displays a form to edit an existing User_admin entity.
     *
     */
    public function editAction() {
        $id = $_GET['id'];
        $em = $this -> getDoctrine() -> getEntityManager();
        $entity = $em -> getRepository('FTRAdminBundle:User_admin') -> find($id);

//        $entity = $this -> getNewEntity($entity);

        if (!$entity) {
            throw $this -> createNotFoundException('Unable to find User_admin entity.');
        }

        $editForm = $this -> createForm(new User_adminType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);

        return $this -> render('FTRAdminBundle:Ftr_panel:adminprofile.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm -> createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing User_admin entity.
     *
     */
    public function updateAction($id) {
        $em = $this -> getDoctrine() -> getEntityManager();

        $entity = $em -> getRepository('FTRAdminBundle:User_admin') -> find($id);


//        $entity = $this -> getNewEntity($entity);
        if (!$entity) {
            throw $this -> createNotFoundException('Unable to find User_admin entity.');
        }

        $editForm = $this -> createForm(new User_adminType(), $entity);
        //$deleteForm = $this -> createDeleteForm($id);

        $request = $this -> getRequest();

        $editForm -> bindRequest($request);

        if ($editForm -> isValid()) {
            $em -> persist($entity);
            $em -> flush();

            echo 'finish';
            exit();
            //return $this -> redirect($this -> generateUrl('user_admin_edit', array('id' => $id)));
        }

        return $this -> render('FTRAdminBundle:Ftr_panel:adminprofile.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm -> createView(),
//            'delete_form' => $deleteForm -> createView(),
        ));
    }

}