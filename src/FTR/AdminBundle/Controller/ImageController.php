<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FTR\WebBundle\Entity\Image;
use FTR\AdminBundle\Form\ImageType;

/**
 * Image controller.
 *
 */
class ImageController extends Controller
{
    /**
     * Finds and displays a Image entity.
     *
     */
    public function showAction($id)
    {

        $this->createFolderBuildingId($id);
        $sqlGetBuildingSite = "
            SELECT
              *
            FROM
              `building_site`
            WHERE `deleted` != 1
              AND id = $id
        ";
        $ObjBuildingSite = $this->getDataArray($sqlGetBuildingSite);

        $sqlGetRoomType2Site = "
            SELECT
              r.*,
              i.`photo_name`,
              i.`photo_type`,
              i.`sequence`
            FROM
              `roomtype2site` r
              LEFT JOIN `image` i
                ON (
                  r.`id` = i.`roomtype2site_id`
                  AND i.`photo_type` = 'room'
                )
            WHERE r.`building_site_id` = $id
              AND r.`deleted` != 1
        ";
        $ObjRoomType2SiteImage = $this->getDataArray($sqlGetRoomType2Site);
        foreach ($ObjRoomType2SiteImage as $key => $value) {
            if (empty($value['photo_name'])){
                $ObjRoomType2SiteImage[$key]['photo_name'] = 'show.png';
                $ObjRoomType2SiteImage[0]['id'] = 0;
            }else{
                $ObjRoomType2SiteImage[$key]['photo_name'] = "building/$id/".$value['photo_name'];
            }
            $ObjRoomType2SiteImage[$key]['count'] = $key+1;
        }

        $sqlGetGallery = "
            SELECT
              `id`,
              `building_site_id`,
              `roomtype2site_id`,
              `photo_name`,
              `photo_type`,
              `deleted`,
              `description`,
              `sequence`
            FROM
              `image`
            WHERE `deleted` != 1
              AND `photo_type` = 'gallery'
              AND `building_site_id` = $id
        ";
        $ObjGetGallery = $this->getDataArray($sqlGetGallery);
        foreach ($ObjGetGallery as $key => $value) {
            if (empty($value['photo_name'])){
                $ObjGetGallery[$key]['photo_name'] = 'show.png';
                $ObjGetGallery[0]['id'] = 0;
            }else{
                $ObjGetGallery[$key]['photo_name'] = "building/$id/".$value['photo_name'];
            }
            $ObjGetGallery[$key]['count'] = $key+1;
        }
        $sqlGetHead = "
            SELECT
              `id`,
              `building_site_id`,
              `roomtype2site_id`,
              `photo_name`,
              `photo_type`,
              `deleted`,
              `description`,
              `sequence`
            FROM
              `image`
            WHERE `deleted` != 1
              AND `photo_type` = 'head'
              AND `building_site_id` = $id
        ";
        $ObjGetHead = $this->getDataArray($sqlGetHead);
        if (empty($ObjGetHead[0]['photo_name'])){
            $ObjGetHead[0]['photo_name'] = 'show.png';
            $ObjGetHead[0]['id'] = 0;
        }else{
            $ObjGetHead[0]['photo_name'] = "building/$id/" . $ObjGetHead[0]['photo_name'];

        }
        $sqlGetMap = "
            SELECT
              `id`,
              `building_site_id`,
              `roomtype2site_id`,
              `photo_name`,
              `photo_type`,
              `deleted`,
              `description`,
              `sequence`
            FROM
              `image`
            WHERE `deleted` != 1
              AND `photo_type` = 'map'
              AND `building_site_id` = $id
        ";
        $ObjGetMap = $this->getDataArray($sqlGetMap);
        if (empty($ObjGetMap[0]['photo_name'])){
            $ObjGetMap[0]['photo_name'] = 'show.png';
            $ObjGetMap[0]['id'] = 0;
        }else{
            $ObjGetMap[0]['photo_name'] = "building/$id/" . $ObjGetMap[0]['photo_name'];
        }

        $sqlGetRecommend = "
            SELECT
              `id`,
              `building_site_id`,
              `roomtype2site_id`,
              `photo_name`,
              `photo_type`,
              `deleted`,
              `description`,
              `sequence`
            FROM
              `image`
            WHERE `deleted` != 1
              AND `photo_type` = 'recommend'
              AND `building_site_id` = $id
        ";
        $ObjGetRecommend = $this->getDataArray($sqlGetRecommend);
        if (empty($ObjGetRecommend[0]['photo_name'])){
            $ObjGetRecommend[0]['photo_name'] = 'show.png';
            $ObjGetRecommend[0]['id'] = 0;
        }else{
            $ObjGetRecommend[0]['photo_name'] = "building/$id/" . $ObjGetRecommend[0]['photo_name'];
        }

        return $this->render('FTRAdminBundle:Image:show.html.twig', array(
            'buildingSite'          => $ObjBuildingSite,
            'roomtype2siteimage'    => $ObjRoomType2SiteImage,
            'gallery'               => $ObjGetGallery,
            'headImage'             => $ObjGetHead,
            'mapImage'              => $ObjGetMap,
            'recommendImage'        => $ObjGetRecommend
        ));
    }


    /**
     * Creates a new Image entity.
     *
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $getBuildingSiteId = @$_POST["building_site_id"];
        $getTypePost = @$_POST['typePost'];
        $getIdImage = @$_POST['idImage'];
        $getNameImage = @$_POST['nameImage'];
        switch ($getTypePost){
            case "head":{
                if ($getIdImage == '0'){
                    $entity = new Image();
                    $entity -> setDeleted(0);
                    $entity -> setBuildingSiteId($getBuildingSiteId);
                    $entity -> setDescription('');
                    $entity -> setPhotoName($getNameImage);
                    $entity -> setPhotoType('head');
                    $entity -> setSequence(0);
                }else{
                    $sqlGetImage = "
                        SELECT
                          `id`,
                          `building_site_id`,
                          `roomtype2site_id`,
                          `photo_name`,
                          `photo_type`,
                          `deleted`,
                          `description`,
                          `sequence`
                        FROM
                          `image`
                        WHERE `id` =
                          AND `deleted` != 1
                    ";
                    $ObjGetImage = $this->getDataArray($sqlGetImage);
                    $this->deleteFileByBuildingId($ObjGetImage[0][id], $ObjGetImage[0]['photo_name']);
                    $entity = $em->getRepository('FTRWebBundle:Image')->find($getNameImage);
//                    var_dump($entity);exit();
                    $entity -> setPhotoName($getNameImage);
                }
            }break;
            case "map":break;
            case "room":break;
            case "gallery":break;
            case "recommend":break;
            default :{
                echo "error";
                exit();
            }break;
        }
        $em->persist($entity);
        $em->flush();
        echo 'finish_' . $entity->getId();
        exit();
//        $entity  = new Image();
//        $request = $this->getRequest();
//        $form    = $this->createForm(new ImageType(), $entity);
//        $form->bindRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getEntityManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('image_show', array('id' => $entity->getId())));
//
//        }
//
//        return $this->render('FTRAdminBundle:Image:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView()
//        ));
    }

    /**
     * Displays a form to edit an existing Image entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $editForm = $this->createForm(new ImageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FTRAdminBundle:Image:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Image entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRWebBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $editForm   = $this->createForm(new ImageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('image_edit', array('id' => $id)));
        }

        return $this->render('FTRAdminBundle:Image:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Image entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTRWebBundle:Image')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Image entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('image'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /*
     * ลบไฟล์รูปภาพ เมื่อมีคำสั่งลบรูปมา
     */
    private function deleteFileByBuildingId($id, $nameImage){
        echo $path = "./images/building/$id/$nameImage";exit();
        unlink($path);
    }

    /*
    * สร้าง folder building/id
    */
    private function createFolderBuildingId($id){
        $path = "./images/building/".$id;
        if(!file_exists("./images/building")){
            mkdir("./images/building", 0777);
        }
        if(!file_exists($path)){
            mkdir($path, 0777);
        }
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
