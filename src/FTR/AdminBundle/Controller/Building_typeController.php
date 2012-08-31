<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Building_type;
use FTR\AdminBundle\Form\Building_typeType;

/**
 * Building_type controller.
 *
 */
class Building_typeController extends Controller
{
    /**
     * Lists all Building_type entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:Building_type')->findAll();

        return $this->render('FTRWebBundle:Building_type:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Building_type entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Building_type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_type entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Building_type:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Building_type entity.
     *
     */
    public function newAction()
    {
        $entity = new Building_type();
        $form   = $this->createForm(new Building_typeType(), $entity);

        return $this->render('FTRWebBundle:Building_type:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Building_type entity.
     *
     */
    public function createAction()
    {
        $entity  = new Building_type();
        $request = $this->getRequest();
        $form    = $this->createForm(new Building_typeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('building_type_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRWebBundle:Building_type:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Building_type entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Building_type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_type entity.');
        }

        $editForm = $this->createForm(new Building_typeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Building_type:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Building_type entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Building_type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_type entity.');
        }

        $editForm   = $this->createForm(new Building_typeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('building_type_edit', array('id' => $id)));
        }

        return $this->render('FTRWebBundle:Building_type:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Building_type entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Building_type')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Building_type entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('building_type'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
