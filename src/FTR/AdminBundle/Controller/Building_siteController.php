<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\WebBundle\Entity\Building_site;
use FTR\AdminBundle\Form\Building_siteType;
use FTR\AdminBundle\Helper\Paginator;
use FTR\AdminBundle\Helper\LoggerHelper;

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
            WHERE b.`deleted` = 0
        ";

        //get post
        $getSelectPage = @$_GET['numPage'];
        $getRecord = @$_GET['record'];
        $getTextSearch = @$_GET['textSearch'];
        $getOrderBy = @$_GET['orderBy'];
        $getOrderByType = @$_GET['orderByType'];

        //set paging
        $page = 1;
        if (!empty($getSelectPage)){
            $page = $getSelectPage;
        }
        $limit = 10;
        $midRange = 5;
        if(!empty($getRecord)){
            $limit = $getRecord;
        }else {
            $getRecord = $limit;
        }
        $offset = $limit*$page-$limit;

        if (empty($getOrderBy) && empty($getOrderByType)){
            $getOrderBy = 'id';
            $getOrderByType = 'asc';
        }
        if (!empty($getTextSearch) && $getTextSearch != ''){
            $sqlGetEntity = "
                $sqlGetEntity
                AND b.id LIKE '%$getTextSearch%'
                OR b.building_name LIKE '%$getTextSearch%'
            ";
        }

        $sqlGetEntity = "
            $sqlGetEntity
            GROUP BY b.id
            ORDER BY b.$getOrderBy  $getOrderByType
        ";

        //นับจำนวนที่มีทั้งหมด
        $countList = count($this->getDataArray($sqlGetEntity));

        //จำกัดการแสดงผล
        $sqlGetEntity = "
            $sqlGetEntity
            LIMIT $offset, $limit
        ";
        $objBuildingSite = $this->getDataArray($sqlGetEntity);

        $paginator = new Paginator($countList, $offset, $limit, $midRange);
        return array(
            'entities'          => $objBuildingSite,
            'paginator'	        => $paginator,
            'countList'		    => $countList,
            'limit' 	        => $limit,
            'noPage'	        => $page,
            'record'	        => $getRecord,
            'textSearch'        => $getTextSearch,
            'orderBy'           => $getOrderBy,
            'orderByType'       => $getOrderByType
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
            $getBuildingName = $entity->getBuildingName();

            if(!$this->checkName($getBuildingName, "")){
                echo "error_$getBuildingName";
                exit();
            }

            //ตั่งค่าพื้นฐาน
            $entity->setDeleted(0);
            $entity->setDatetimestamp(new \DateTime());
            $entity->setStartPrice(0);
            $entity->setEndPrice(0);

            //เลือกเขต หรือจังหวัด
            $getProvince = $entity->getAddrProvince();
            $getZone = $entity->getZoneId();
            $checkZone = @$_POST['bc'];
            if ($checkZone == 'bkk'){
                if (empty($getZone)){
                    echo "error_zone";
                    exit();
                }
                $entity->setAddrProvince(null);
            }else{
                if (empty($getProvince)){
                    echo "error_province";
                    exit();
                }
                $entity->setZoneId(null);
            }
            
            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Insert Building Site', $entity);

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

            //สร้าง logs
            $this->addLogger('Update Building Site: Deleted = 1', $entity);

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
            $getBuildingName = $entity->getBuildingName();
            if(!$this->checkName($getBuildingName, "AND id != $id")){
                echo "error_$getBuildingName";
                exit();
            }

            //เลือกเขต หรือจังหวัด
            $getProvince = $entity->getAddrProvince();
            $getZone = $entity->getZoneId();
            $checkZone = @$_POST['bc'];
            if ($checkZone == 'bkk'){
                if (empty($getZone)){
                    echo "error_zone";
                    exit();
                }
                $entity->setAddrProvince(null);
            }else{
                if (empty($getProvince)){
                    echo "error_province";
                    exit();
                }
                $entity->setZoneId(null);
            }

            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Update Building Site', $entity);

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
    * Check ชื่อไม่ให้ซ้ำกัน
    */
    private  function checkName($name, $sql){
        $sqlCheck = "
            SELECT
             *
            FROM
              `building_site`
            WHERE `deleted` = 0
            AND `building_name` = '$name'
            $sql
        ";
        $objCheck = $this->getDataArray($sqlCheck);
        if (!empty($objCheck)){
            return false;
        }
        return true;
    }

    /*
     * บันทึก log เกี่ยวกับการ insert, delete, update database
     */
    private function addLogger($message, $entity){
        $logger = new LoggerHelper();
        $newArray = $logger->objectToArray($entity);
        $logger->addInfo($message, $newArray);
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
        $sqlGetAddressProvince = "
            SELECT
              *
            FROM
              `province`
        ";
        $Entity->buildingtype = $this->getDataArray($sqlGetBuildingType);
        $Entity->zone = $this->getDataArray($sqlGetZone);
        $Entity->paytype = $this->getDataArray($sqlGetPayType);
        $Entity->userowner = $this->getDataArray($sqlGetUserOwner);
        $Entity->proveince = $this->getDataArray($sqlGetAddressProvince);
        return $Entity;
    }
}
