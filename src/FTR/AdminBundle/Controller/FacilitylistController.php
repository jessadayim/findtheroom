<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Facilitylist;
use FTR\AdminBundle\Form\FacilitylistType;
use FTR\AdminBundle\Helper\Paginator;
use FTR\AdminBundle\Helper\LoggerHelper;

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

        $getEntitiesAll = $em->getRepository('FTRWebBundle:Facilitylist')->findBy(array('deleted' => 0));
        $countList = count($getEntitiesAll);

        $entities = $em->getRepository('FTRWebBundle:Facilitylist')->getData($limit, $offset, $getTextSearch, $countList, "$getOrderBy $getOrderByType");

        $paginator = new Paginator($countList, $offset, $limit, $midRange);

        return $this->render('FTRAdminBundle:Facilitylist:index.html.twig', array(
            'entities'          => $entities,
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

        //Set ค่า deleted = 0
        $entity->setDeleted(0);

        $form    = $this->createForm(new FacilitylistType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            //Check ชื่อ facilitylist ซ้ำ
            $getName = $entity->getFacilityName();
            if (!$this->checkName($getName, "")){
                echo "finish_comp";
                exit();
            }
            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Insert Facility', $entity);

            echo 'finish';
            exit();
//            return $this->redirect($this->generateUrl('facilitylist_show', array('id' => $entity->getId())));
            
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

        //Check post เปลี่ยน deleted เป็น 1
        $getCheckPost = @$_POST['checkPost'];
        if ($getCheckPost == "delete"){
            $sqlCheck = "
                SELECT
                  *
                FROM
                  `building_site`
                WHERE `pay_type_id` = $id
                  AND `deleted` = 0
            ";
            $objCheck = $this->getDataArray($sqlCheck);
            if (!empty($objCheck)){
                echo "finish_math";
                exit();
            }
            $entity->setDeleted(1);
            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Update Facility: Deleted = 1', $entity);

            echo 'finish';
            exit();
        }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facilitylist entity.');
        }

        $editForm = $this->createForm(new FacilitylistType(), $entity);

        return $this->render('FTRAdminBundle:Facilitylist:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {

            //Check ชื่อซ้ำกันหรือไม่
            if(!$this->checkName($entity->getFacilityName(), "AND id != $id")){
                echo "finish_comp";
                exit();
            }

            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Update Facility', $entity);

            echo 'finish';exit();
//            return $this->redirect($this->generateUrl('facilitylist_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Facilitylist:edit.html.twig', array(
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
              `facilitylist`
            WHERE `facility_name` = '$name'
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
