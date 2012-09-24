<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Nearly_location;
use FTR\AdminBundle\Form\Nearly_locationType;
use FTR\AdminBundle\Helper\Paginator;
use FTR\AdminBundle\Helper\LoggerHelper;

/**
 * Nearly_location controller.
 *
 */
class Nearly_locationController extends Controller
{
    /**
     * Lists all Nearly_location entities.
     *
     */
    public function indexAction()
    {
        $sqlGetEntity = "
            SELECT
              n.*,
              t.type_name,
              t.id AS t_id
            FROM
              `nearly_location` n
              INNER JOIN `nearly_type` t
                ON (n.nearly_type_id = t.id)
            WHERE n.`deleted` = 0
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
            $getOrderBy = 'n.id';
            $getOrderByType = 'asc';
        }else{
            $getOrderBy = htmlentities($getOrderBy);
        }
        if (!empty($getTextSearch) && $getTextSearch != ''){
            $sqlGetEntity = "
                $sqlGetEntity
                AND n.id LIKE '%$getTextSearch%'
                OR n.name LIKE '%$getTextSearch%'
                OR n.address LIKE '%$getTextSearch%'
                OR n.latitude LIKE '%$getTextSearch%'
                OR n.longitude LIKE '%$getTextSearch%'
                OR t.type_name LIKE '%$getTextSearch%'
            ";
        }

        $sqlGetEntity = "
            $sqlGetEntity
            ORDER BY $getOrderBy $getOrderByType
        ";

        //นับจำนวนที่มีทั้งหมด
        $countList = count($this->getDataArray($sqlGetEntity));

        //จำกัดการแสดงผล
        $sqlGetEntity = "
            $sqlGetEntity
            LIMIT $offset, $limit
        ";
        $objResult = $this->getDataArray($sqlGetEntity);

        $paginator = new Paginator($countList, $offset, $limit, $midRange);
        return $this->render('FTRAdminBundle:Nearly_location:index.html.twig', array(
            'entities'          => $objResult,
            'paginator'	        => $paginator,
            'countList'		    => $countList,
            'limit' 	        => $limit,
            'noPage'	        => $page,
            'record'	        => $getRecord,
            'textSearch'        => $getTextSearch,
            'orderBy'           => $getOrderBy,
            'orderByType'       => $getOrderByType
        ));
    }

    /**
     * Displays a form to create a new Nearly_location entity.
     *
     */
    public function newAction()
    {
        $entity = new Nearly_location();

        // เพิ่มชุด array ใช้ในการค้นหา
        $entity = $this->getNewEntity($entity);

        $form   = $this->createForm(new Nearly_locationType(), $entity);

        return $this->render('FTRAdminBundle:Nearly_location:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Nearly_location entity.
     *
     */
    public function createAction()
    {
        $entity  = new Nearly_location();
        $request = $this->getRequest();

        //Set ค่า deleted = 0
        $entity->setDeleted(0);

        // เพิ่มชุด array ใช้ในการค้นหา
        $entity = $this->getNewEntity($entity);

        $form    = $this->createForm(new Nearly_locationType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            //Check ชื่อซ้ำ
            $getName = $entity->getName();
            if (!$this->checkName($getName, "")){
                echo "finish_comp";
                exit();
            }

            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Insert Nearly location', $entity);

            echo 'finish';
            exit();

//            return $this->redirect($this->generateUrl('nearly_location_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRAdminBundle:Nearly_location:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Nearly_location entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly_location')->find($id);

        // เพิ่มชุด array ใช้ในการค้นหา
        $entity = $this->getNewEntity($entity);

        //Check post เปลี่ยน deleted เป็น 1
        $getCheckPost = @$_POST['checkPost'];
        if ($getCheckPost == "delete"){
            $entity->setDeleted(1);
            $em->persist($entity);
            $em->flush();
            echo 'finish';

            //สร้าง logs
            $this->addLogger('Update Nearly location: deleted = 1', $entity);
            exit();
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly_location entity.');
        }

        $editForm = $this->createForm(new Nearly_locationType(), $entity);

        return $this->render('FTRAdminBundle:Nearly_location:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Nearly_location entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Nearly_location')->find($id);


        // เพิ่มชุด array ใช้ในการค้นหา
        $entity = $this->getNewEntity($entity);



        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nearly_location entity.');
        }

        $editForm   = $this->createForm(new Nearly_locationType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        if ($editForm->isValid()) {

            //Check ชื่อซ้ำกันหรือไม่
            if(!$this->checkName($entity->getName(), "AND id != $id")){
                echo "finish_comp";
                exit();
            }

            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Update Nearly location', $entity);
            echo 'finish';
            exit();
//            return $this->redirect($this->generateUrl('nearly_location_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Nearly_location:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    /*
     * Check ชื่อไม่ให้ซ้ำกัน
     */
    private  function checkName($name, $sql){
        $sqlCheck = "
            SELECT
              *
            FROM
              `nearly_location`
            WHERE `name` = '$name'
              AND `deleted` = 0
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

    private function getNewEntity($Entity){
        $sql = "
            SELECT
              *
            FROM
              `nearly_type`
            WHERE `deleted` = 0
        ";

        $Entity->nearlyType = $this->getDataArray($sql);
        return $Entity;
    }
}
