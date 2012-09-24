<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Zone;
use FTR\AdminBundle\Form\ZoneType;
use FTR\AdminBundle\Helper\Paginator;
use FTR\AdminBundle\Helper\LoggerHelper;
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

        $getEntitiesAllZone = $em->getRepository('FTRWebBundle:Zone')->findBy(array('deleted' => 0));
        $countListZone = count($getEntitiesAllZone);

        $entities = $em->getRepository('FTRWebBundle:Zone')->getDataZone($limit, $offset, $getTextSearch, $countListZone, "$getOrderBy $getOrderByType");

        $paginator = new Paginator($countListZone, $offset, $limit, $midRange);

        return $this->render('FTRAdminBundle:Zone:index.html.twig', array(
            'entities'          => $entities,
            'paginator'	        => $paginator,
            'countListZone'		=> $countListZone,
            'limit' 	        => $limit,
            'noPage'	        => $page,
            'record'	        => $getRecord,
            'textSearch'        => $getTextSearch,
            'orderBy'           => $getOrderBy,
            'orderByType'       => $getOrderByType
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

            //Check ชื่อ zone ซ้ำ
            $getName = $entity->getZonename();
            if (!$this->checkName($getName, "")){
                echo "finish_comp";
                exit();
            }
            $em->persist($entity);

            $em->flush();

            //สร้าง logs
            $this->addLogger('Insert Zone', $entity);

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

        //Check post เปลี่ยน deleted เป็น 1
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

            //สร้าง logs
            $this->addLogger('Update Zone: Deleted = 1', $entity);

            echo 'finish';
            exit();
        }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zone entity.');
        }

        $editForm = $this->createForm(new ZoneType(), $entity);

        return $this->render('FTRAdminBundle:Zone:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
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

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {

            //Check ชื่อซ้ำกันหรือไม่
            if(!$this->checkName($entity->getZonename(), "AND id != $id")){
                echo "finish_comp";
                exit();
            }

            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Update Zone', $entity);

            echo 'finish';exit();
//            return $this->redirect($this->generateUrl('zone_edit', array('id' => $id)));
        }
        return $this->render('FTRAdminBundle:Zone:edit.html.twig', array(
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
              `zone`
            WHERE `deleted` = 0
            AND `zonename` = '$name'
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
