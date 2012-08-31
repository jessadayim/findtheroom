<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Facility2site;
use FTR\AdminBundle\Form\Facility2siteType;

/**
 * Facility2site controller.
 *
 */
class Facility2siteController extends Controller
{
    /**
     * Lists all Facility2site entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:Facility2site')->findAll();

        return $this->render('FTRWebBundle:Facility2site:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Facility2site entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Facility2site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facility2site entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Facility2site:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Facility2site entity.
     *
     */
    public function newAction()
    {
        $entity = new Facility2site();
        $form   = $this->createForm(new Facility2siteType(), $entity);

        return $this->render('FTRWebBundle:Facility2site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Facility2site entity.
     *
     */
    public function createAction()
    {
        $entity  = new Facility2site();
        $request = $this->getRequest();
        $form    = $this->createForm(new Facility2siteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facility2site_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRWebBundle:Facility2site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Facility2site entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Facility2site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facility2site entity.');
        }

        $editForm = $this->createForm(new Facility2siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Facility2site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Facility2site entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Facility2site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facility2site entity.');
        }

        $editForm   = $this->createForm(new Facility2siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facility2site_edit', array('id' => $id)));
        }

        return $this->render('FTRWebBundle:Facility2site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Facility2site entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Facility2site')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Facility2site entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('facility2site'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
