<?php
namespace FTR\Config;

class Config
{
    /**
     * ประกาศ Global variable ของ site
     *
     * Created by MICK
     * Date: 3/1/13
     * Time: 1:43 PM
     */
    public function setSiteGlobal(){

        // Default Site Config
        $siteTitle = "รวมข้อมูลหอพัก และรายละเอียดหอพักที่ท่านตามหา";
        $siteDesc = "หากวันนี้ท่านกำลังหาข้อมูลอยู่ findtheroom เป็นที่ีที่ท่านต้องการแนะนำ";
        $siteKeyword = "หอพัก, รายละเอียด หอพัก";
        $siteAuthor = "specialsquare.co.,led.";
        $siteCopyRight = "specialsquare.co.,led.";
        $siteRobot = "index";
        $siteRevisitAfter = "7 days";
        $siteDistribution = "Global";
        $siteImage = "http://localhost:8081/findtheroom/web/images/logo.png";
        $siteUrl = "http://localhost:8081/findtheroom/web/";

        // Page Site Config
        $pageBannerTitle = "ลงโฆษณาหอพัก | ".$siteTitle;
        $pageBannerDesc = $siteDesc;
        $pageSearchTitle = "ค้นหาหอพัก | ".$siteTitle;
        $pageSearchDesc = $siteDesc;
        $pagePublishTitle = "ประกาศหอพักฟรี | ".$siteTitle;
        $pagePublishDesc = $siteDesc;
        $pageContactTitle = "ติดต่อ FindTheRoom | ".$siteTitle;
        $pageContactDesc = $siteDesc;

        return array(
            "siteTitle"=>$siteTitle,
            "siteDesc"=>$siteDesc,
            "siteKeyword"=>$siteKeyword,
            "siteAuthor"=>$siteAuthor,
            "siteCopyright"=>$siteCopyRight,
            "siteRobot"=>$siteRobot,
            "siteRevisitAfter"=>$siteRevisitAfter,
            "siteDistribution"=>$siteDistribution,
            "siteImage"=>$siteImage,
            "siteUrl"=>$siteUrl,
            "pageBannerTitle" => $pageBannerTitle,
            "pageBannerDesc" => $pageBannerDesc,
            "pageSearchTitle" => $pageSearchTitle,
            "pageSearchDesc" => $pageSearchDesc,
            "pagePublishTitle" => $pagePublishTitle,
            "pagePublishDesc" => $pagePublishDesc,
            "pageContactTitle" => $pageContactTitle,
            "pageContactDesc" => $pageContactDesc
        );
    }
}

