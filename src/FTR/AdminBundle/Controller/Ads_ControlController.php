<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\AdminBundle\Entity\Ads_Control;
use FTR\AdminBundle\Form\Ads_ControlType;
use FTR\AdminBundle\Helper\Paginator;
use FTR\AdminBundle\Helper\LoggerHelper;
use FTR\AdminBundle\Helper\FTRConstant;
use FTR\AdminBundle\Helper\FTRHelper;

/**
 * Ads_Control controller.
 *
 */
class Ads_ControlController extends Controller
{
    /**
     * Lists all Ads_Control entities.
     *
     */
    public function indexAction()
    {
        return $this->render('FTRAdminBundle:Ads_Control:index.html.twig', array());
    }

    public function showAction()
    {
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
            $getOrderBy = 'cutDate >= 0';
            $getOrderByType = 'asc';
        }

        $sqlGetEntity = "
            SELECT
              *,
              DATEDIFF(`date_end`, NOW()) AS cutDate
            FROM
              `ads_control` a
            WHERE 1
        ";
        if (!empty($getTextSearch) && $getTextSearch != ''){
            $sqlGetEntity = "
                $sqlGetEntity
                AND a.id LIKE '%$getTextSearch%'
                OR a.title LIKE '%$getTextSearch%'
                OR a.zone LIKE '%$getTextSearch%'
                OR a.codes LIKE '%$getTextSearch%'
            ";
        }

        echo $sqlGetEntity = "
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

//        $helper = new FTRHelper();
        foreach($objResult as $key => $value){
            $getCutDate = $value["cutDate"];
            if(intval($getCutDate) == 0){
                $objResult[$key]['bg'] = 'red';
            }else if (intval($getCutDate) <= 3 && intval($getCutDate) > 0){
                $objResult[$key]['bg'] = 'orange';
            }else if (intval($getCutDate) <= 7 && intval($getCutDate) > 0){
                $objResult[$key]['bg'] = 'yellow';
            }else{
                $objResult[$key]['bg'] = 'white';
            }
//            $newDate = $helper->convertThaiDateTime($value['date_start']);
//            $objResult[$key]['date_start'] = $newDate;
//            $newDate = $helper->convertThaiDateTime($value['date_end']);
//            $objResult[$key]['date_end'] = $newDate;
        }
        $paginator = new Paginator($countList, $offset, $limit, $midRange);
        return $this->render('FTRAdminBundle:Ads_Control:show.html.twig', array(
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
     * Displays a form to create a new Ads_Control entity.
     *
     */
    public function newAction()
    {
        $entity = new Ads_Control();

        //เพิ่ม array ads
        $entity = $this->getNewEntity($entity);

        $form   = $this->createForm(new Ads_ControlType(), $entity);

        return $this->render('FTRAdminBundle:Ads_Control:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Ads_Control entity.
     *
     */
    public function createAction()
    {
        $entity  = new Ads_Control();

        //เพิ่ม array ads
        $entity = $this->getNewEntity($entity);

        $request = $this->getRequest();
        $form    = $this->createForm(new Ads_ControlType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            //Check ชื่อ zone ซ้ำ
            $getName = $entity->getTitle();
            if (!$this->checkName($getName, "")){
                echo "finish_comp";
                exit();
            }
            $em->persist($entity);

            $em->flush();

            //สร้าง logs
            $this->addLogger('Insert Ads Control', $entity);

            echo 'finish';
            exit();
//            return $this->redirect($this->generateUrl('ads_control_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FTRAdminBundle:Ads_Control:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Ads_Control entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity =  $em->getRepository('FTRAdminBundle:Ads_Control')->find($id);

        //เพิ่ม array ads
        $entity = $this->getNewEntity($entity);

        //Check post เปลี่ยน deleted เป็น 1
        $getCheckPost = @$_POST['checkPost'];
        if ($getCheckPost == "delete"){
            $sqlCheck = "
                SELECT
                  *
                FROM
                  `ads_control`
                WHERE `title` = $id
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
            $this->addLogger('Update Ads Control: Deleted = 1', $entity);

            echo 'finish';
            exit();
        }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ads_Control entity.');
        }

        $editForm = $this->createForm(new Ads_ControlType(), $entity);
        return $this->render('FTRAdminBundle:Ads_Control:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Ads_Control entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:Ads_Control')->find($id);

        //เพิ่ม array ads
        $entity = $this->getNewEntity($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ads_Control entity.');
        }

        $editForm   = $this->createForm(new Ads_ControlType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            //Check ชื่อซ้ำกันหรือไม่
            if(!$this->checkName($entity->getTitle(), "AND id != $id")){
                echo "finish_comp";
                exit();
            }

            $em->persist($entity);
            $em->flush();

            //สร้าง logs
            $this->addLogger('Update Ads Control', $entity);

            echo 'finish';exit();
//            return $this->redirect($this->generateUrl('ads_control_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Ads_Control:edit.html.twig', array(
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
              `ads_control`
            WHERE `title` = '$name'
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

    private function getNewEntity($Entity){

        $constant = new FTRConstant();
        $getAdsPosition = $constant->getAdsPosition();

        $Entity->adsPosition = $getAdsPosition;
        return $Entity;
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
