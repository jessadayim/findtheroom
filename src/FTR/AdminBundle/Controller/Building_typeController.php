<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Building_type;
use FTR\AdminBundle\Form\Building_typeType;
use FTR\AdminBundle\Helper\Paginator;
use FTR\AdminBundle\Helper\LoggerHelper;

/**
 * Building_type controller.
 *
 */
class Building_typeController extends Controller
{
    /**
     * Lists all Building_type entities.
     *
     */
    public function indexAction()
    {
        $sqlGetEntity = "
            SELECT
              *
            FROM
              `building_type` b
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
                OR b.type_name LIKE '%$getTextSearch%'
            ";
        }

        $sqlGetEntity = "
            $sqlGetEntity
            GROUP BY b.$getOrderBy $getOrderByType
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
        return $this->render('FTRAdminBundle:Building_type:index.html.twig', array(
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
     * Displays a form to create a new Building_type entity.
     *
     */
    public function newAction()
    {
        $entity = new Building_type();
        $form   = $this->createForm(new Building_typeType(), $entity);

        return $this->render('FTRAdminBundle:Building_type:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Building_type entity.
     *
     */
    public function createAction()
    {
        $entity  = new Building_type();
        $request = $this->getRequest();

        //Set ค่า deleted = 0
        $entity->setDeleted(0);

        $form    = $this->createForm(new Building_typeType(), $entity);
        $form->bindRequest($request);

//        if (!$form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            //Check ชื่อ TypeName ซ้ำ
            $getName = $entity->getTypeName();
            if (!$this->checkName($getName, "")){
                echo "finish_comp";
                exit();
            }

            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
//            return $this->redirect($this->generateUrl('building_type_show', array('id' => $entity->getId())));
            
        //}

//        return $this->render('FTRAdminBundle:Building_type:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView()
//        ));
    }

    /**
     * Displays a form to edit an existing Building_type entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Building_type')->find($id);

        //Check post เปลี่ยน deleted เป็น 1
        $getCheckPost = @$_POST['checkPost'];
        if ($getCheckPost == "delete"){

            $entity->setDeleted(1);
            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
        }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_type entity.');
        }

        $editForm = $this->createForm(new Building_typeType(), $entity);

        return $this->render('FTRAdminBundle:Building_type:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Building_type entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Building_type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building_type entity.');
        }

        $editForm   = $this->createForm(new Building_typeType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {

            //Check ชื่อซ้ำกันหรือไม่
            if(!$this->checkName($entity->getTypeName(), "AND id != $id")){
                echo "finish_comp";
                exit();
            }

            $em->persist($entity);
            $em->flush();
            echo 'finish';
            exit();
//            return $this->redirect($this->generateUrl('building_type_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Building_type:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
              `building_type`
            WHERE `type_name` = '$name'
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
}
