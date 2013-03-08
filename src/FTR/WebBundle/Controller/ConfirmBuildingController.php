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
        $confirmToken = $siteConfigDetail["siteUrl"]."/confirm_token/".$id."/".$codeToken;
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

        } catch (Excaption $e) {
            echo $e;
        }

// ส่ง token และ update password ไปยัง email ของผู้กรอกข้อมูล
        $mailClass = new Mailer();

        $arrConfirmBuilding = array("name"=> "member", "building_name"=>"ชื่อตึก", "token_url"=>$confirmToken, "password"=>$confirmPassUpdate);

        $html = $this->renderView('FTRWebBundle:Mail:confirmAddBuilding.html.twig', $arrConfirmBuilding);

        $var = var_export($arrConfirmBuilding, TRUE);

        $subject = "Email Confirm การสร้างหอพักใหม่ FindTheRoom.com";
        $fromEmail = "wararits@sourcecode.co.th";
        $toEmail = "manesz13@gmail.com";
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

