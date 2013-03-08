<?php
namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\Config\Config;

class GooglemapController extends Controller
{
    public function sendToGooglemapViewAction($id){

// เรียกข้อมูลเบื้องต้นของ website
        $siteConfig = new Config();
        $siteConfigDetail = $siteConfig->setSiteGlobal();

        $arrBuildingPoint = array(
            "id"=>$id,
//            'siteTitle'=> $siteConfigDetail["siteTitle"]
//            'siteDesc' => $siteConfigDetail["siteDesc"],
//            'siteKeyword' => $siteConfigDetail["siteKeyword"],
//            'siteAuthor' => $siteConfigDetail["siteAuthor"],
//            'siteCopyRight' => $siteConfigDetail["siteCopyright"],
//            'siteRobot' => $siteConfigDetail["siteRobot"],
//            'siteRevisitAfter' => $siteConfigDetail["siteRevisitAfter"],
//            'siteDistribution' => $siteConfigDetail["siteDistribution"],
//            'siteImage' => $siteConfigDetail["siteImage"],
//            'siteUrl' => $siteConfigDetail["siteUrl"]
        );

        return $this->render('FTRWebBundle:Googlemap:googlemapViewFancybox.html.twig', $arrBuildingPoint);

//        $this->renderView('FTRWebBundle:Confirm:viewResult.html.twig', $arrBuildingPoint);
    }
}