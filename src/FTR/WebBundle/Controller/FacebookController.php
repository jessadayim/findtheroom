<?php
namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

use FTR\WebBundle\Entity\User_owner;

//  เรียกใช้งานไฟล์ php-sdk สำหรับ facebook 
//require_once("/var/www/html/findtheroom/web/facebook-php-sdk/facebook.php");
//require_once($_SERVER['DOCUMENT_ROOT'] . "/findtheroom/web/facebook-php-sdk/facebook.php");

class FacebookController extends Controller
{
	public function indexAction()
	{
		// สร้าง Application instance
		$facebook = new \Facebook(array(
			'appId'		=> '414830161885886',// appid ที่ได้จาก facebook 
			'secret'	=> '52377fb41e97b22b385d6563a354313d', // app secret ที่ได้จาก facebook  
			'cookie'	=> true, // อนุญาตใช้งาน cookie  
		));
		
		// เก็บ user ของผู้ใช้ไว้ที่ตัวแปร $fbuser กรณีมีการล็อกอิน facebook อยู่  
		$fbuser = $facebook->getUser();
		var_dump($fbuser);
		exit();
		// สร้างตัวแปรสำหรับเก็บข้อมูลของสมาชิกเมื่อได้ทำการ login แล้ว  
		$me = null;
		// ถ้ามีการ login ดึงข้อมูลสมาชิกที่ login มาเก็บที่ตัวแปร $me เป็น array 
		if($fbuser){
			try{
				$me = $facebook->api('/me'); // ดึงข้อมูลผู้ใช้ปัจจุบันทีล็อกอิน facebook มาเก็บในตัวแปร $me  
			}catch (FacebookApiException $e) { // กรณีเกิดข้อผิดพลากแสดงผลลัพธ์ข้อผิดพลาดที่เกิดขึ้น  
				error_log($e);
			}
		}
	}
	
	private function getMemberByFacebookId($facebook_id)
    {
		$member = $this->getDoctrine()
        ->getRepository('FTRWebBundle:User_owner')
        ->findOneBy( array('facebook_id' => $facebook_id) );
        
        return $member;
    }
}
	