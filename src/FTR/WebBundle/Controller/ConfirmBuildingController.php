<?php
namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\Config\Config;
use FTR\SCAPI\Helper\Mailer;

class ConfirmBuildingController extends Controller
{
    public function validateConfirmBuildingTokenAction($id, $token)
    {
        $conn = $this->get('database_connection');

        if (!empty($id) && !empty($token))
        {
            try
            {

                $sqlValidateToken = "
                    SELECT id
                    FROM building_site
                    WHERE id = ".$id." AND confirm_add_building_token = '".$token."'
                ";
                $buildingId = $conn->fetchAll($sqlValidateToken);
                $countData = count($buildingId);

                if($countData <= 0)
                {
                    $result = false;
                } else {

                    $result = true;

                    // Update publish ของห้องพักจาก 2 => รอการapprove เป็น 1 => approve
                    $sqlUpdateConfirmCode ="
                        UPDATE building_site
                        SET publish = 1
                        WHERE id = ".$id."
                    ";
                            $queryUpdateConfirmCode = $conn->query($sqlUpdateConfirmCode);
                }

                return $this->render('FTRWebBundle:Confirm:confirmAddBuildingResult.html.twig', array(
                    'result' => $result
                ));

            } catch (Excaption $e) {
                return $this->redirect($this->generateUrl('FTRWebBundle_confirm_result'));
            }
        }
    }

    public function genConfirmBuildingCodeAction($id)
    {
        $conn = $this->get('database_connection');

// เรียกข้อมูลเบื้องต้นของ website
        $siteConfig = new Config();
        $siteConfigDetail = $siteConfig->setSiteGlobal();

        $codeToken = md5($this->randomString(8));
        $codePassUpdate = $this->randomString(8);

// ข้อมูล token ในการ confirm ห้องพักและ password ในการแก้ไขข้อมูลห้องพัก
        $confirmToken = $siteConfigDetail["siteUrl"]."confirm_token/".$id."/".$codeToken;
        $confirmPassUpdate = $codePassUpdate;

// Update ข้อมูล token และ password update เข้ายังห้องพัก
        try
        {
            $em = $this->getDoctrine()->getEntityManager();

            $sqlUpdateConfirmCode ="
                UPDATE building_site
                SET confirm_add_building_token = '".$codeToken."',
                    password_update_building = '".$codePassUpdate."'
                WHERE id = ".$id."
            ";
            $queryUpdateConfirmCode = $conn->query($sqlUpdateConfirmCode);

			
			$sqlGetEmailForSendEmail = "
				SELECT
				  `building_name`,
                  `contact_name`,
				  `contact_email`
				FROM
				  building_site 
				WHERE id = $id
				LIMIT 1
			";
			$resultEmail = $conn->fetchall($sqlGetEmailForSendEmail);
            $emailBuildingNameConfirm = $resultEmail[0]['building_name'];
            $emailPersonConfirm = $resultEmail[0]['contact_name'];
			$emailForSendComfirm = $resultEmail[0]['contact_email'];
        } catch (Excaption $e) {
            echo $e;
        }

// ส่ง token และ update password ไปยัง email ของผู้กรอกข้อมูล
        $mailClass = new Mailer();

        $arrConfirmBuilding = array("name"=> $emailPersonConfirm, "building_name"=>$emailBuildingNameConfirm, "createTime"=>date("d/m/Y"), "token_url"=>$confirmToken, "password"=>$confirmPassUpdate);

        $html = $this->renderView('FTRWebBundle:Mail:confirmAddBuilding.html.twig', $arrConfirmBuilding);

//        $var = var_export($arrConfirmBuilding, TRUE);
        $var = "ทางทีมงาน FindTheRoom.com ยินดีเป็นอย่างยิ่งที่ท่านได้เพิ่มข้อมูลห้องพัก  ".$arrConfirmBuilding["building_name"]." ของท่านกับเรา แล้วในวันที่ ".$arrConfirmBuilding["createTime"]." ทางทีมงาน FindTheRoom.com ได้รับข้อมูลเป็นที่เรียบร้อยแล้ว";
        $var .= "กรุณา confirm ข้อมูลการเพิ่มข้อมูลห้องพัก ".$arrConfirmBuilding["building_name"]." ของท่านด้วยการคลิก link ".$arrConfirmBuilding["token_url"]." เพื่อให้ระบบแสดงห้องพักของท่านบนเว็บไซต์";
        $var .= "หากท่านต้องการแก้ไขข้อมูลห้องพัก ".$arrConfirmBuilding["building_name"]." กรุณากรอกรหัสผ่านด้านล่างเพื่อยืนยันการแก้ไข :".$arrConfirmBuilding["password"];

        $subject = "Email Confirm การสร้างหอพักใหม่ FindTheRoom.com";
        $fromEmail = "ftr@sourcecode.co.th";
        $toEmail = "$emailForSendComfirm";
        $message = $html;
        $partMessage = $var;

        $mailClass->sendEmail($subject, $fromEmail, $toEmail, $ccEmail = null, $bccEmail = null, $message, $partMessage);

// เรียกข้อมูลเบื้องต้นของ website
        $siteConfig = new Config();
        $siteConfigDetail = $siteConfig->setSiteGlobal();

        return $this->render('FTRWebBundle:Confirm:genBuildingResult.html.twig', array(
            'token' => $confirmToken,
            'confirmPassUpdate' => $confirmPassUpdate,
            'siteTitle'=> $siteConfigDetail["siteTitle"],
            'siteDesc' => $siteConfigDetail["siteDesc"],
            'siteKeyword' => $siteConfigDetail["siteKeyword"],
            'siteAuthor' => $siteConfigDetail["siteAuthor"],
            'siteCopyRight' => $siteConfigDetail["siteCopyright"],
            'siteRobot' => $siteConfigDetail["siteRobot"],
            'siteRevisitAfter' => $siteConfigDetail["siteRevisitAfter"],
            'siteDistribution' => $siteConfigDetail["siteDistribution"],
            'siteImage' => $siteConfigDetail["siteImage"],
            'siteUrl' => $siteConfigDetail["siteUrl"]
        ));

    }

    public function randomString($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}

