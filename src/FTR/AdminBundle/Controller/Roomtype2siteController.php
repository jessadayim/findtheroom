<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Roomtype2site;
use FTR\WebBundle\Form\Roomtype2siteType;

/**
 * Roomtype2site controller.
 *
 */
class Roomtype2siteController extends Controller
{
    /**
     * Lists all Roomtype2site entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:Roomtype2site')->findAll();

        return $this->render('FTRWebBundle:Roomtype2site:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Roomtype2site entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Roomtype2site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomtype2site entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Roomtype2site:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Roomtype2site entity.
     *
     */
    public function newAction()
    {
        $entity = new Roomtype2site();
        $form   = $this->createForm(new Roomtype2siteType(), $entity);

        return $this->render('FTRWebBundle:Roomtype2site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Roomtype2site entity.
     *
     */
    public function createAction()
    {
        $entity  = new Roomtype2site();
        $request = $this->getRequest();
        $form    = $this->createForm(new Roomtype2siteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('roomtype2site_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRWebBundle:Roomtype2site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Roomtype2site entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Roomtype2site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomtype2site entity.');
        }

        $editForm = $this->createForm(new Roomtype2siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRWebBundle:Roomtype2site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Roomtype2site entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Roomtype2site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomtype2site entity.');
        }

        $editForm   = $this->createForm(new Roomtype2siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('roomtype2site_edit', array('id' => $id)));
        }

        return $this->render('FTRWebBundle:Roomtype2site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Roomtype2site entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Roomtype2site')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Roomtype2site entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('roomtype2site'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
