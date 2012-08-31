<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Nearly_location;
use FTR\WebBundle\Form\Nearly_locationType;

/**
 * Nearly_location controller.
 *
 */
class Nearly_locationController extends Controller
{
    /**
     * Lists all Nearly_location entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:Nearly_location')->findAll();

        return $this->render('FTRWebBundle:Nearly_location:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Nearly_location entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly_location')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly_location entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Nearly_location:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Nearly_location entity.
     *
     */
    public function newAction()
    {
        $entity = new Nearly_location();
        $form   = $this->createForm(new Nearly_locationType(), $entity);

        return $this->render('FTRWebBundle:Nearly_location:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Nearly_location entity.
     *
     */
    public function createAction()
    {
        $entity  = new Nearly_location();
        $request = $this->getRequest();
        $form    = $this->createForm(new Nearly_locationType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nearly_location_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRWebBundle:Nearly_location:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Nearly_location entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly_location')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly_location entity.');
        }

        $editForm = $this->createForm(new Nearly_locationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Nearly_location:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Nearly_location entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly_location')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly_location entity.');
        }

        $editForm   = $this->createForm(new Nearly_locationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nearly_location_edit', array('id' => $id)));
        }

        return $this->render('FTRWebBundle:Nearly_location:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Nearly_location entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Nearly_location')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nearly_location entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nearly_location'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
