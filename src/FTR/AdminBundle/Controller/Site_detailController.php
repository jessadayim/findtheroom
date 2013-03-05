<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\AdminBundle\Entity\Site_detail;
use FTR\AdminBundle\Form\Site_detailType;

/**
 * Site_detail controller.
 *
 */
class Site_detailController extends Controller
{
    /**
     * Lists all Site_detail entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRAdminBundle:Site_detail')->findAll();

        return $this->render('FTRAdminBundle:Site_detail:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Site_detail entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:Site_detail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Site_detail entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Site_detail:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Site_detail entity.
     *
     */
    public function newAction()
    {
        $entity = new Site_detail();
        $form = $this->createForm(new Site_detailType(), $entity);

        return $this->render('FTRAdminBundle:Site_detail:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new Site_detail entity.
     *
     */
    public function createAction()
    {
        $entity = new Site_detail();
        $request = $this->getRequest();
        $form = $this->createForm(new Site_detailType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('site_detail_show', array('id' => $entity->getId())));

        }

        return $this->render('FTRAdminBundle:Site_detail:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Site_detail entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:Site_detail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Site_detail entity.');
        }

        $editForm = $this->createForm(new Site_detailType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Site_detail:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Site_detail entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:Site_detail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Site_detail entity.');
        }

        $editForm = $this->createForm(new Site_detailType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('site_detail_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Site_detail:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Site_detail entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRAdminBundle:Site_detail')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Site_detail entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('site_detail'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
