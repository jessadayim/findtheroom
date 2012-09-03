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

        return $this->render('FTRAdminBundle:Facility2site:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Facility2site entity.
     *
     */
    public function showAction($id)
    {
        $entity = new Facility2site();
        $entity->setBuildingSiteId($id);
        $sqlFacility = "
            SELECT 
              l.*,
              f.id AS facility2site_id 
            FROM
              `facilitylist` l 
              LEFT JOIN `facility2site` f 
                ON (
                  f.`facilitylist_id` = l.id 
                  AND f.`building_site_id` = $id 
                  AND f.`deleted` != 1
                ) 
            WHERE l.`deleted` != 1   
        ";
        $sqlGetBuildingSite = "
            SELECT 
              * 
            FROM
              `building_site` 
            WHERE `deleted` != 1 
              AND id = $id
        ";
        $facilityList = $this->getDataArray($sqlFacility);         
        foreach ($facilityList as $key => $value){
            $facilityList[$key]['count'] = $key+1;
        }
        $getBuildingSite = $this->getDataArray($sqlGetBuildingSite);  
        //$form   = $this->createForm(new Facility2siteType(), $entity);

        return $this->render('FTRAdminBundle:Facility2site:show.html.twig', array(
            'buildingsite'    => $getBuildingSite,  
            'facilityList'      => $facilityList
        ));
    }

    /**
     * Displays a form to create a new Facility2site entity.
     *
     */
    public function newAction($buildingsiteid)
    {
        // $entity = new Facility2site();
        // $entity->setBuildingSiteId($buildingsiteid);
        // $sqlFacility = "
            // SELECT
                // *
            // FROM 
                // `facilitylist`
            // WHERE `deleted` != 1 
        // ";
        // $sqlGetBuildingSite = "
            // SELECT 
              // * 
            // FROM
              // `building_site` 
            // WHERE `deleted` != 1 
              // AND id = $buildingsiteid
        // ";
        // $facilityList = $this->getDataArray($sqlFacility);        
//         
        // $getBuildingSite = $this->getDataArray($sqlGetBuildingSite);  
        // //$form   = $this->createForm(new Facility2siteType(), $entity);
// 
        // return $this->render('FTRAdminBundle:Facility2site:new.html.twig', array(
            // 'buildingsite'    => $getBuildingSite,  
            // 'facilityList'      => $facilityList
        // ));
    }

    /**
     * Creates a new Facility2site entity.
     *
     */
    public function createAction()
    {
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $getPostFacilityListID = @$_POST['facility_list_id'];
        $getBuildingSiteID = @$_POST['building_site_id'];
        $getCheckPost = @$_POST['check_post'];
        
        $sqlGetfacility = "
            SELECT
                id
            FROM 
                `facility2site`
            WHERE facilitylist_id = $getPostFacilityListID 
            AND building_site_id = $getBuildingSiteID
        ";
        $getfacility = $this->getDataArray($sqlGetfacility);
        
        if (empty($getfacility)){
            if ($getCheckPost == 'true'){
                $entity  = new Facility2site();            
                $entity ->setBuildingSiteId($getBuildingSiteID);
                $entity ->setDeleted(0);
                $entity ->setFacilitylistId($getPostFacilityListID);
            }        
            else {
                echo 'finish';
                exit();
            }   
        }else{
            $entity = $em->getRepository('FTRWebBundle:Facility2site')->find($getfacility[0]['id']);
            if ($getCheckPost == 'true'){
                $entity ->setDeleted(0);
            }else {
                $entity ->setDeleted(1);
            }
        } 
        $em->persist($entity);
        $em->flush();
        echo 'finish';
        exit();
        // return $this->render('FTRAdminBundle:Facility2site:new.html.twig', array(
            // 'entity' => $entity,
            // 'form'   => $form->createView()
        // ));
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

        return $this->render('FTRAdminBundle:Facility2site:edit.html.twig', array(
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

        return $this->render('FTRAdminBundle:Facility2site:edit.html.twig', array(
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
