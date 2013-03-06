<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('FTRWebBundle:Default:index.html.twig', array());
    }

    public function  countClickAction()
    {
        //var_dump($_SERVER);
        $conn = $this->get('database_connection');

        $datetimestamp  = date("Y-m-d H:i:s");
        $ipaddr 	    = @$_SERVER['REMOTE_ADDR'];
        $refurl 	    = @$_SERVER['HTTP_REFERER'];

        $clickType      = @$_GET['clickType'];

        switch ($clickType) {
            case "buildingRecom":
            case "buildingsite":
                $building_site_id = @$_GET['id'];
                $province = @$_GET['province'];
                $prefecture = @$_GET['prefactre'];
                $slug = @$_GET['slug'];
                $refname = "$clickType";
                $linkname = $this->generateUrl('FTRWebBundle_detail', array('buildId' => $building_site_id, 'province' => $province, 'prefecture' => $prefecture, 'slug' => $slug));
                break;
            case 1:
                echo "i equals 1";
                break;
            case 2:
                echo "i equals 2";
                break;
            default:
                echo "i is not equal to 0, 1 or 2";
        }

		/**
		 * แยก link เพื่อเอา reference link ที่สำคัญเท่านั้น
		 */
		$urlExplode = explode('&',$refurl);
		if (!empty($urlExplode[1])) {// เช็คว่ามีการ explode ไหม
			$urlExplode2 = explode('?',$urlExplode[0]);
			if ($urlExplode[1]=='searchType=shortSearch') {//เช็คว่า explode แล้วเป็น searchType=shortSearch ไหม
				$refurl = $urlExplode2[0].'?'.$urlExplode[1];
			}
		}

        if(!empty($refurl)){
            $sql_insert = "
                INSERT INTO `banner_count`
                    (
                     `building_site_id`,
                     `refname`,
                     `refurl`,
                     `ipaddr`,
                     `datetimestamp`)
                VALUES (
                        '$building_site_id',
                        '$refname',
                        '$refurl',
                        '$ipaddr',
                        '$datetimestamp')
            ";
            $conn->exec($sql_insert);

           // mysql_close($conn);
        }
//        var_dump($linkname);exit();
        return $this->redirect($linkname);
        //exit();
    }
}

