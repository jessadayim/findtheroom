<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\WebBundle\Entity\Building_site;
use FTR\AdminBundle\Form\Building_siteType;

/**
 * Building_site controller.
 *
 * @Route("/building_site")
 */
class Building_siteController extends Controller
{
    /**
     * Lists all Building_site entities.
     *
     * @Route("/", name="building_site")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRWebBundle:Building_site')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Building_site entity.
     *
     * @Route("/{id}/show", name="building_site_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Building_site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_site entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Building_site entity.
     *
     * @Route("/new", name="building_site_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Building_site();
        $form   = $this->createForm(new Building_siteType(), $entity);
        // $request = $this->getRequest();
        // if($request->getMethod() == 'POST')
        // {
            // var_dump($_POST['ftr_webbundle_building_sitetype[datetimestamp][date][month]']);
//             
            // exit();
        // }
        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Building_site entity.
     *
     * @Route("/create", name="building_site_create")
     * @Method("post")
     * @Template("FTRWebBundle:Building_site:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Building_site();
        $request = $this->getRequest();
        $form    = $this->createForm(new Building_siteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('building_site_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Building_site entity.
     *
     * @Route("/{id}/edit", name="building_site_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Building_site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_site entity.');
        }

        $editForm = $this->createForm(new Building_siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Building_site entity.
     *
     * @Route("/{id}/update", name="building_site_update")
     * @Method("post")
     * @Template("FTRWebBundle:Building_site:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Building_site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_site entity.');
        }

        $editForm   = $this->createForm(new Building_siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('building_site_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Building_site entity.
     *
     * @Route("/{id}/delete", name="building_site_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Building_site')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Building_site entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('building_site'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
