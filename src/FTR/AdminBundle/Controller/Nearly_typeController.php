<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Nearly_type;
use FTR\AdminBundle\Form\Nearly_typeType;

/**
 * Nearly_type controller.
 *
 */
class Nearly_typeController extends Controller
{
    /**
     * Lists all Nearly_type entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:Nearly_type')->findAll();

        return $this->render('FTRAdminBundle:Nearly_type:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Nearly_type entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly_type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly_type entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Nearly_type:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Nearly_type entity.
     *
     */
    public function newAction()
    {
        $entity = new Nearly_type();
        $form   = $this->createForm(new Nearly_typeType(), $entity);

        return $this->render('FTRAdminBundle:Nearly_type:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Nearly_type entity.
     *
     */
    public function createAction()
    {
        $entity  = new Nearly_type();
        $request = $this->getRequest();
        $form    = $this->createForm(new Nearly_typeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nearly_type_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRAdminBundle:Nearly_type:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Nearly_type entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly_type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly_type entity.');
        }

        $editForm = $this->createForm(new Nearly_typeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Nearly_type:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Nearly_type entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly_type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly_type entity.');
        }

        $editForm   = $this->createForm(new Nearly_typeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nearly_type_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Nearly_type:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Nearly_type entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Nearly_type')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nearly_type entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nearly_type'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
