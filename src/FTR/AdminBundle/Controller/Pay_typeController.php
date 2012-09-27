<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Pay_type;
use FTR\AdminBundle\Form\Pay_typeType;
use FTR\AdminBundle\Helper\Paginator;
use FTR\AdminBundle\Helper\LoggerHelper;

/**
 * Pay_type controller.
 *
 */
class Pay_typeController extends Controller
{
    /**
     * Lists all Pay_type entities.
     *
     */
    public function indexAction()
    {
        return $this->render('FTRAdminBundle:Pay_type:index.html.twig', array());
    }

    public function showAction()
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

        $getEntitiesAllPayType = $em->getRepository('FTRWebBundle:Pay_type')->findBy(array('deleted' => 0));
        $countListPayType = count($getEntitiesAllPayType);

        $entities = $em->getRepository('FTRWebBundle:Pay_type')->getDataPayType($limit, $offset, $getTextSearch, $countListPayType, "$getOrderBy $getOrderByType");

        $paginator = new Paginator($countListPayType, $offset, $limit, $midRange);

        return $this->render('FTRAdminBundle:Pay_type:show.html.twig', array(
            'entities'          => $entities,
            'paginator'	        => $paginator,
            'countList'	        => $countListPayType,
            'limit' 	        => $limit,
            'noPage'	        => $page,
            'record'	        => $getRecord,
            'textSearch'        => $getTextSearch,
            'orderBy'           => $getOrderBy,
            'orderByType'       => $getOrderByType
        ));
    }

    /**
     * Displays a form to create a new Pay_type entity.
     *
     */
    public function newAction()
    {
        $entity = new Pay_type();
        $form   = $this->createForm(new Pay_typeType(), $entity);

        return $this->render('FTRAdminBundle:Pay_type:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Pay_type entity.
     *
     */
    public function createAction()
    {
        $entity  = new Pay_type();
        $request = $this->getRequest();

        //Set ค่า deleted = 0
        $entity->setDeleted(0);
        $form    = $this->createForm(new Pay_typeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            //Check ชื่อ pay type ซ้ำ
            $getTypeName = $entity->getTypename();
            if (!$this->checkName($getTypeName, "")){
                echo "finish_comp";
                exit();
            }

            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Insert Pay Type', $entity);

            echo 'finish';
            exit();
//            return $this->redirect($this->generateUrl('pay_type_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRAdminBundle:Pay_type:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Pay_type entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Pay_type')->find($id);

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
            $this->addLogger('Update Pay Type: Deleted = 1', $entity);

            echo 'finish';
            exit();
        }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pay_type entity.');
        }

        $editForm = $this->createForm(new Pay_typeType(), $entity);

        return $this->render('FTRAdminBundle:Pay_type:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Pay_type entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Pay_type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pay_type entity.');
        }

        $editForm   = $this->createForm(new Pay_typeType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {

            //Check ชื่อซ้ำกันหรือไม่
            if(!$this->checkName($entity->getTypename(), "AND id != $id")){
                echo "finish_comp";
                exit();
            }

            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Update Pay type', $entity);
            echo 'finish';exit();
//            return $this->redirect($this->generateUrl('pay_type_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Pay_type:edit.html.twig', array(
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
              `pay_type`
            WHERE `typename` = '$name'
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

        //Get Session Username
        $session = $this->get('session');
        $username = $session->get('username');

        //add log
        $logger->addInfo("$message by '$username'", $newArray);
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
