<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Nearly2site;
use FTR\WebBundle\Form\Nearly2siteType;

/**
 * Nearly2site controller.
 *
 */
class Nearly2siteController extends Controller
{
    /**
     * Lists all Nearly2site entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:Nearly2site')->findAll();

        return $this->render('FTRWebBundle:Nearly2site:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Nearly2site entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly2site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly2site entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Nearly2site:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Nearly2site entity.
     *
     */
    public function newAction()
    {
        $entity = new Nearly2site();
        $form   = $this->createForm(new Nearly2siteType(), $entity);

        return $this->render('FTRWebBundle:Nearly2site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Nearly2site entity.
     *
     */
    public function createAction()
    {
        $entity  = new Nearly2site();
        $request = $this->getRequest();
        $form    = $this->createForm(new Nearly2siteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nearly2site_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRWebBundle:Nearly2site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Nearly2site entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly2site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly2site entity.');
        }

        $editForm = $this->createForm(new Nearly2siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Nearly2site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Nearly2site entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly2site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly2site entity.');
        }

        $editForm   = $this->createForm(new Nearly2siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nearly2site_edit', array('id' => $id)));
        }

        return $this->render('FTRWebBundle:Nearly2site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Nearly2site entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Nearly2site')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nearly2site entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nearly2site'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
