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
        return array(
            'checkhide' => 'false',
            'session'   => true
        );
    }

    /**
     * Finds and displays a Building_site entity.
     *
     * @Route("/{id}/show", name="building_site_show")
     * @Template()
     */
    public function showAction()
    {
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        $sqlGetEntity = "
            SELECT 
              b.*,
              f.id AS facility_id,
              t.id AS room_type_id,
              n.id AS nearly_id,
              i.id AS image_id 
            FROM
              `building_site` b 
              LEFT JOIN `facility2site` f 
                ON (b.`id` = f.`building_site_id`) 
              LEFT JOIN `roomtype2site` t 
                ON (b.`id` = t.`building_site_id`) 
              LEFT JOIN `nearly2site` n 
                ON (b.`id` = n.`building_site_id`) 
              LEFT JOIN `image` i 
                ON (b.`id` = i.`building_site_id`) 
            WHERE b.`deleted` != 1   
            GROUP BY b.id
        ";
        $entities = $this->getDataArray($sqlGetEntity);
        return array(
            'entities'  => $entities
        );
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
        
        // เพิ่มชุด array ใช้ในการค้นหา
        $entity = $this->getNewEntity($entity);
        
        $form   = $this->createForm(new Building_siteType(), $entity);

        return array(
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }

    /**
     * Creates a new Building_site entity.
     *
     * @Route("/create", name="building_site_create")
     * @Method("post")
     * @Template()
     */
    public function createAction()
    {
        $entity  = new Building_site();

        // เพิ่มชุด array ใช้ในการค้นหา
        $entity = $this->getNewEntity($entity);

        $request = $this->getRequest();
        $form    = $this->createForm(new Building_siteType(), $entity);
        $form->bindRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            //Check ว่ามี ขื่อนี้หรือไม่
            $gtBuildingName = $entity->getBuildingName();
            $sqlGetNameBuildingSite = "
                SELECT
                 *
                FROM
                  `building_site`
                WHERE `deleted` != 1
                AND `building_name` = '$gtBuildingName'
            ";
            $objGetNameBuildingSite = $this->getDataArray($sqlGetNameBuildingSite);
            if(!empty($objGetNameBuildingSite)){
                echo "error_$gtBuildingName";
                exit();
            }

            //ตั่งค่าพื้นฐาน
            $entity->setDeleted(0);
            $entity->setDatetimestamp(new \DateTime());
            $entity->setStartPrice(0);
            $entity->setEndPrice(0);
            
            $em->persist($entity);
            $em->flush();

            $getNewID = $entity->getId();

            //สร้าง folder building/$id
            $this->createFolderBuildingId($getNewID);

            //Create เสร็จแล้ว            
            echo "finish_$getNewID";
            exit();
            
            //return $this->redirect($this->generateUrl('building_site_show', array('id' => $entity->getId())));
            
        }
        return $this->render('FTRAdminBundle:Building_site:new.html.twig', array(
            'entity'    => $entity,
            'form'      => $form->createView(),
        ));
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

        // เพิ่มชุด array ใช้ในการค้นหา
        $entity = $this->getNewEntity($entity);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_site entity.');
        }

        $editForm = $this->createForm(new Building_siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Building_site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            // 'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Building_site entity.
     *
     * @Route("/{id}/update", name="building_site_update")
     * @Method("post")
     * @Template()
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Building_site')->find($id);
        
        //ตรวจสอบการ ส่งตัวแปรให้อัพเดท Building Site Feid Deleted เป็น 1
        $getCheckUpdateDeleted = @$_POST['checkdelete'];
        if ($getCheckUpdateDeleted == 'deleted'){
            $entity->setDeleted(1);
            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
        }
        // เพิ่มชุด array ใช้ในการค้นหา
        $entity = $this->getNewEntity($entity);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_site entity.');
        }

        $editForm   = $this->createForm(new Building_siteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();
        
        $editForm->bindRequest($request);
        
        if ($editForm->isValid()) {
            //Check ว่ามี ขื่อนี้หรือไม่
            $gtBuildingName = $entity->getBuildingName();
            $sqlGetNameBuildingSite = "
                SELECT
                 *
                FROM
                  `building_site`
                WHERE `deleted` != 1
                AND `building_name` = '$gtBuildingName'
            ";
            $objGetNameBuildingSite = $this->getDataArray($sqlGetNameBuildingSite);
            if(!empty($objGetNameBuildingSite)){
                echo "error_$gtBuildingName";
                exit();
            }
            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
            // return $this->redirect($this->generateUrl('building_site_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Building_site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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

    /*
     * สร้าง folder building/id
     */
    private function createFolderBuildingId($id){
        $path = "./images/building/$id";
        if(!file_exists("./images/building")){
            mkdir("./images/building", 0777);
        }
        if(!file_exists($path)){
            mkdir($path, 0777);
        }
    }

    /*
     * Function return result data from database
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

    /*
     * Get list id ที่ใช้ผูกกับตาราง building_site
     * 
     * 
     */
    private function getNewEntity($Entity){
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}
        $sqlGetBuildingType = "
            SELECT 
              `id`,
              `type_name` 
            FROM
              `building_type` 
            WHERE `deleted` != 1 
        ";
        $sqlGetZone = "
            SELECT 
              `id`,
              `zonename` 
            FROM
              `zone` 
            WHERE `deleted` != 1   
        ";
        $sqlGetPayType = "
            SELECT 
              `id`,
              `typename` 
            FROM
              `pay_type` 
            WHERE `deleted` != 1   
        ";
        $sqlGetUserOwner = "
            SELECT 
              `id`,
              `username` 
            FROM
              `user_owner` 
            WHERE `deleted` != 1  
        ";
        $Entity->buildingtype = $this->getDataArray($sqlGetBuildingType);
        $Entity->zone = $this->getDataArray($sqlGetZone);
        $Entity->paytype = $this->getDataArray($sqlGetPayType);
        $Entity->userowner = $this->getDataArray($sqlGetUserOwner);
        return $Entity;
    }
}
