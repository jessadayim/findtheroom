<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Zone;
use FTR\AdminBundle\Form\ZoneType;
use FTR\AdminBundle\Helper\Paginator;

/**
 * Zone controller.
 *
 */
class ZoneController extends Controller
{
    /**
     * Lists all Zone entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        //set paging
        $page = 1;
        $getSelectPage = @$_GET['numPage'];
        if (!empty($getSelectPage)){
            $page = $getSelectPage;
        }
        $limit = 10;
        $midRange = 5;
        $getRecord = @$_GET['record'];
        if(!empty($getRecord)){
            $limit = $getRecord;
        }else {
            $getRecord = $limit;
        }
        $offset = $limit*$page-$limit;

        $entities = $em->getRepository('FTRWebBundle:Zone')->getDataZone($limit, $offset);
//        $sqlGetAllZone = "";
        $getEntitiesAllZone = $em->getRepository('FTRWebBundle:Zone')->findBy(array('deleted' => 0));
        $countListZone = count($getEntitiesAllZone);
        $paginator = new Paginator($countListZone, $offset, $limit, $midRange);

//        $entities = $em->getRepository('FTRWebBundle:Zone')->findBy(array('deleted' => 0));

        return $this->render('FTRAdminBundle:Zone:index.html.twig', array(
            'entities'          => $entities,
            'paginator'	        => $paginator,
            'countListZone'		=> $countListZone,
            'limit' 	        => $limit,
            'noPage'	        => $page,
            'record'	        => $getRecord
        ));
    }

    /**
     * Finds and displays a Zone entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Zone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zone entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Zone:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Zone entity.
     *
     */
    public function newAction()
    {
        $entity = new Zone();
        $form   = $this->createForm(new ZoneType(), $entity);

        return $this->render('FTRAdminBundle:Zone:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Zone entity.
     *
     */
    public function createAction()
    {
        $entity  = new Zone();
        $request = $this->getRequest();

        //Set ค่า deleted = 0
        $entity->setDeleted(0);
        $form    = $this->createForm(new ZoneType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $getZoneName = $entity->getZonename();
            $sqlGetZone = "
                SELECT
                  *
                FROM
                  `zone`
                WHERE `zonename` = '$getZoneName'
                  AND `deleted` = 0
            ";
            $objGetZone = $this->getDataArray($sqlGetZone);
            if (!empty($objGetZone)){
                echo "finish_comp";
                exit();
            }
            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
//            return $this->redirect($this->generateUrl('zone_show', array('id' => $entity->getId())));
        }

        return $this->render('FTRAdminBundle:Zone:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Zone entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Zone')->find($id);
        $getCheckPost = @$_POST['checkPost'];
        if ($getCheckPost == "delete"){
            $sqlCheck = "
                SELECT
                  *
                FROM
                  `building_site`
                WHERE `zone_id` = $id
                  AND `deleted` = 0
            ";
            $objCheckZone = $this->getDataArray($sqlCheck);
            if (!empty($objCheckZone)){
                echo "finish_math";
                exit();
            }
            $entity->setDeleted(1);
            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
        }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zone entity.');
        }

        $editForm = $this->createForm(new ZoneType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Zone:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Zone entity.
     *
     */
    public function updateAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Zone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zone entity.');
        }

        $editForm   = $this->createForm(new ZoneType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            echo 'finish';exit();
//            return $this->redirect($this->generateUrl('zone_edit', array('id' => $id)));
        }
        return $this->render('FTRAdminBundle:Zone:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Zone entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Zone')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Zone entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('zone'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /*
    * Run คำสั่ง Sql
    * return array
    */
    private function getDataArray($sql){
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        try{
            return $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return array();
    }
}
