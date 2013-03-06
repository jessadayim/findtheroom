<?php
namespace FTR\Config;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
/**
 * Config file for global configs
 */
class Config
{
    /**
     * ประกาศ Global variable ของ site
     *
     * Created by MICK
     * Date: 3/1/13
     * Time: 1:43 PM
     */
    public function setSiteGlobal()
    {
    	$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '1234';
		$dbname = 'findtheroom';
    	
		$arrData = $this->getSiteDetail($dbhost, $dbname, $dbuser, $dbpass);
		
        // Default Site Config
        $siteTitle = $arrData['title'];
        $siteDesc = $arrData['description'];
        $siteKeyword = $arrData['keyword'];
        $siteAuthor = "specialsquare.co.,led.";
        $siteCopyRight = "specialsquare.co.,led.";
        $siteRobot = "index";
        $siteRevisitAfter = "7 days";
        $siteDistribution = "Global";
        $siteImage = $arrData['base_url']."images/logo.png";
        $siteUrl = $arrData['base_url'];

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

	public function getSiteDetail($dbHost, $dbName, $dbUser, $dbPass)
	{
		$con = mysql_connect($dbHost, $dbUser, $dbPass) ;
		mysql_set_charset('utf8',$con);
		$db = mysql_select_db($dbName) ;
		$sql = "SELECT
  `id`,
  `title`,
  `description`,
  `keyword`,
  `tag_line`,
  `base_url`
FROM `site_detail` LIMIT 1";
		$result = mysql_query($sql) ;
		$arrData = mysql_fetch_array($result);
		if(empty($arrData)){
			$arrData = array(
			'title'			=> 'รวมข้อมูลหอพัก และรายละเอียดหอพักที่ท่านตามหา',
			'description'	=> 'หากวันนี้ท่านกำลังหาข้อมูลอยู่ findtheroom เป็นที่ีที่ท่านต้องการแนะนำ',
			'keyword'		=> 'หอพัก, รายละเอียด หอพัก',
			'base_url'		=> 'http://localhost/findtheroom/web/',
			);
		}
		return $arrData;
	}
}

