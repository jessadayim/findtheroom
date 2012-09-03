<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Roomtype;
use FTR\AdminBundle\Form\RoomtypeType;

/**
 * Roomtype controller.
 *
 */
class RoomtypeController extends Controller
{
    /**
     * Lists all Roomtype entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:Roomtype')->findAll();

        return $this->render('FTRAdminBundle:Roomtype:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Roomtype entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Roomtype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomtype entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Roomtype:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Roomtype entity.
     *
     */
    public function newAction()
    {
        $entity = new Roomtype();
        $form   = $this->createForm(new RoomtypeType(), $entity);

        return $this->render('FTRAdminBundle:Roomtype:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Roomtype entity.
     *
     */
    public function createAction()
    {
        $entity  = new Roomtype();
        $request = $this->getRequest();
        $form    = $this->createForm(new RoomtypeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('roomtype_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRAdminBundle:Roomtype:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Roomtype entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Roomtype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomtype entity.');
        }

        $editForm = $this->createForm(new RoomtypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Roomtype:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Roomtype entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Roomtype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomtype entity.');
        }

        $editForm   = $this->createForm(new RoomtypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('roomtype_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Roomtype:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Roomtype entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Roomtype')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Roomtype entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('roomtype'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
