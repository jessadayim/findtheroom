<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\AdminBundle\Entity\Ads_Control;
use FTR\AdminBundle\Form\Ads_ControlType;

/**
 * Ads_Control controller.
 *
 */
class Ads_ControlController extends Controller
{
    /**
     * Lists all Ads_Control entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRAdminBundle:Ads_Control')->findAll();

        return $this->render('FTRAdminBundle:Ads_Control:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Ads_Control entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:Ads_Control')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ads_Control entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Ads_Control:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Ads_Control entity.
     *
     */
    public function newAction()
    {
        $entity = new Ads_Control();
        $form   = $this->createForm(new Ads_ControlType(), $entity);

        return $this->render('FTRAdminBundle:Ads_Control:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Ads_Control entity.
     *
     */
    public function createAction()
    {
        $entity  = new Ads_Control();
        $request = $this->getRequest();
        $form    = $this->createForm(new Ads_ControlType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ads_control_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRAdminBundle:Ads_Control:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Ads_Control entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:Ads_Control')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ads_Control entity.');
        }

        $editForm = $this->createForm(new Ads_ControlType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Ads_Control:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Ads_Control entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:Ads_Control')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ads_Control entity.');
        }

        $editForm   = $this->createForm(new Ads_ControlType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ads_control_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Ads_Control:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ads_Control entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRAdminBundle:Ads_Control')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ads_Control entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ads_control'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
