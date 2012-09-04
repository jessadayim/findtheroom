<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\AdminBundle\Entity\User_level;
use FTR\AdminBundle\Form\User_levelType;

/**
 * User_level controller.
 *
 */
class User_levelController extends Controller
{
    /**
     * Lists all User_level entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRAdminBundle:User_level')->findAll();

        return $this->render('FTRAdminBundle:User_level:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a User_level entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:User_level')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User_level entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:User_level:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new User_level entity.
     *
     */
    public function newAction()
    {
        $entity = new User_level();
        $form   = $this->createForm(new User_levelType(), $entity);

        return $this->render('FTRAdminBundle:User_level:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new User_level entity.
     *
     */
    public function createAction()
    {
        $entity  = new User_level();
        $request = $this->getRequest();
        $form    = $this->createForm(new User_levelType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_level_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRAdminBundle:User_level:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing User_level entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:User_level')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User_level entity.');
        }

        $editForm = $this->createForm(new User_levelType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:User_level:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing User_level entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:User_level')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User_level entity.');
        }

        $editForm   = $this->createForm(new User_levelType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_level_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:User_level:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a User_level entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRAdminBundle:User_level')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User_level entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user_level'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
