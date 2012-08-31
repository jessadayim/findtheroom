<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Facilitylist;
use FTR\AdminBundle\Form\FacilitylistType;

/**
 * Facilitylist controller.
 *
 */
class FacilitylistController extends Controller
{
    /**
     * Lists all Facilitylist entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:Facilitylist')->findAll();

        return $this->render('FTRAdminBundle:Facilitylist:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Facilitylist entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Facilitylist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facilitylist entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Facilitylist:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Facilitylist entity.
     *
     */
    public function newAction()
    {
        $entity = new Facilitylist();
        $form   = $this->createForm(new FacilitylistType(), $entity);

        return $this->render('FTRAdminBundle:Facilitylist:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Facilitylist entity.
     *
     */
    public function createAction()
    {
        $entity  = new Facilitylist();
        $request = $this->getRequest();
        $form    = $this->createForm(new FacilitylistType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facilitylist_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRAdminBundle:Facilitylist:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Facilitylist entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Facilitylist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facilitylist entity.');
        }

        $editForm = $this->createForm(new FacilitylistType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Facilitylist:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Facilitylist entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Facilitylist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facilitylist entity.');
        }

        $editForm   = $this->createForm(new FacilitylistType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facilitylist_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Facilitylist:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Facilitylist entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Facilitylist')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Facilitylist entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('facilitylist'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
