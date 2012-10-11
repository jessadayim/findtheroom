<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;


class SecurityController extends Controller
{
    public function loginAction()
    {
    	$username = $_POST['username'];
		$password = md5(trim(trim($_POST['password'])));
		if($username != ""&& $password != ""){
			$conn= $this->get('database_connection');
			if(!$conn){ die("MySQL Connection error");}
				try{
					$sql1 ="SELECT * FROM user_owner WHERE (username = '$username' OR email = '$username') and password = '$password' and deleted != '1'";
					$objSQL1 = $conn -> fetchAll($sql1);
					$rowcount = count($objSQL1);
					if($rowcount == 1){
						$session = $this->get('session');
						$user = $objSQL1[0]['username'];
						$id = $objSQL1[0]['id'];

						$session->set('user', $user);
						$session->set('id', $id);
						
						$time = date("Y-m-d : H:i:s", time());
						
						$sql2 ="UPDATE user_owner SET last_login = '$time' WHERE id= '$id'";
						$conn->query($sql2);
						
						echo "1";
						exit();
					}
					else{
						echo "0";
						exit();
					}					
				} catch (Exception $e) {
					//echo 'Caught exception: ',  $e->getMessage(), "\n";
					return $this->render('FTRWebBundle:Security:login.html.twig',array());
				}
		}else{
			echo "2";
			exit();
		}
	}
	public function logPublishAction($message)
    {
        if($message == '2'){
            $alert = "กรุณากรอก ชื่อผู้ใช้งาน และรหัสผ่าน ให้ครบ";
        }else if($message == '0'){
            $alert = "กรุณาตรวจสอบ ชื่อผู้ใช้งาน หรือรหัสผ่าน";
        }else{
            $alert = "";
        }
//    		if(empty($_COOKIE['username'])){
//				$username ="";
//			}else{
//				$username = $_COOKIE['username'];
//			}if(empty($_COOKIE['password'])){
//				$password = "";
//			}else{
//				$password = $_COOKIE['password'];
//			}if(empty($_COOKIE['chbox'])){
//				$chbox = "";
//			}else{
//				$chbox = $_COOKIE['chbox'];
//			}
			
//			 return $this->render('FTRWebBundle:Security:login.html.twig',array('username'=>$username,'password'=>$password,'chbox'=>$chbox));
        return $this->render('FTRWebBundle:Security:login.html.twig',array('message'=>$alert));
    }

	public function logoutAction()
	{
		$session = $this->get('session');
		$session->set('user', '');
        $session->set('id', '');
		return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
	}

    public function sendEmail($id){
        $conn= $this->get('database_connection');
        $sqlOwner = "SELECT email, confirm_token, firstname, lastname, facebook_id
                     FROM user_owner
					 WHERE id = '$id' AND deleted = 0";
        $objOwner = $conn -> fetchAll($sqlOwner);
        $token = $objOwner[0]['confirm_token'];
        $email = $objOwner[0]['email'];

        $host = "http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
        $url = $this->get('router')->generate('FTRWebBundle_homepage', array());
        $url .= "?confirmToken=". $token;

        $link = "ท่านได้ทำการลงทะเบียนกับ FindTheRoom.com เรียบร้อยแล้ว
    กรุณาคลิกลิงค์  "
            .$host.$url."
    เพื่อทำการยืนยันการลงทะเบียน
เมื่อท่านทำการยืนยันการลงทะเบียนเสร็จเรียบร้อยแล้ว ท่านจะสามารถใช้บริการเหล่านี้ได้
-ลงทะเบียนหอพักฟรี
-รับบริการเสริมจาก FindTheRoom.com
ติดต่อสอบถามข้อมูลเพิ่มเติม โทร 02-692-1199";

        $message = \Swift_Message::newInstance()
            ->setSubject('ยินดีต้อนรับสมาชิกใหม่ '.$email.' สู่ FindTheRoom.com')
            ->setFrom('support@findtheroom.com')
            ->setTo($email)
            ->addPart($link)
            ->setBody($this->renderView('FTRWebBundle:Register:email.html.twig', array(
            'host' => $host
        ,'url' => $url
        ,'firstName'=>$objOwner[0]['firstname']
        ,'lastName'=>$objOwner[0]['lastname'])),'text/html');

        $this->get('mailer')->send($message);
    }

    public function updateLogin($id){
        $conn= $this->get('database_connection');
        $time = date("Y-m-d H:i:s", time());
        $sql2 ="UPDATE user_owner SET last_login = '$time' WHERE id = '$id' AND deleted = 0";
        $conn->query($sql2);
    }

    public function loginFacebookAction(){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/findtheroom/web/facebook-php-sdk/facebook.php");
        $facebook = new \facebook(array(
            'appId'  => '414830161885886', // appid ที่ได้จาก facebook
            'secret' => '52377fb41e97b22b385d6563a354313d', // app secret ที่ได้จาก facebook
            'cookie' => false, // อนุญาตใช้งาน cookie
        ));

        $fbuser = $facebook->getUser();

        $me = null;

        if ($fbuser) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $me = $facebook->api('/me'); //user
                $uid = $facebook->getUser();
            }
            catch (FacebookApiException $e)
            {
                //echo error_log($e);
                $fbuser = null;
            }
        }
        if (!$fbuser){
            $loginUrl = $facebook->getLoginUrl();
            header('Location: '.$loginUrl);
        }

        //user details
        $facebookId = $me['id'];
        $email = $me['email'];
        $username = $me['username'];

        if(empty($facebookId) || empty($email) || empty($username)){
            echo "fail";
        }else{
            $conn= $this->get('database_connection');
            if(!$conn){ die("MySQL Connection error");}

            $session = $this->get('session');

            try{
                //query ใช้ตรวจสอบ id facebook ของ user
                $sqlCheckUser ="SELECT id, username
                                FROM user_owner
                                WHERE facebook_id = '$facebookId'
                                    AND deleted = 0";
                $objCheckUser = $conn -> fetchAll($sqlCheckUser);
                $rowCount = count($objCheckUser);

                if($rowCount == 1){
                    $this->updateLogin($objCheckUser[0]['id']);

                    $user = $objCheckUser[0]['username'];
                    $id = $objCheckUser[0]['id'];
                    $session->set('user', $user);
                    $session->set('id', $id);
                }else{
                    //query ตรวจสอบอีเมล
                    $sqlCheckEmail = "SELECT id
                                      FROM user_owner
                                      WHERE email = '$email'
                                          AND deleted = 0";
                    $objCheckEmail = $conn -> fetchAll($sqlCheckEmail);

                    if(count($objCheckEmail) == 1){
                        $userId = $objCheckEmail[0]['id'];
                        $sqlUpdateUser ="UPDATE user_owner
                                         SET facebook_id = '$facebookId'
                                         WHERE id = '$userId'
                                            AND deleted = 0";
                        $conn->query($sqlUpdateUser);
                    }else{
                        $random_token = md5(uniqid(rand(),true));
                        $sqlRegisterUser ="INSERT INTO user_owner(username, email, deleted, user_level, confirm_token, facebook_id)
                                           VALUES('$username', '$email', 0, 2, '$random_token', '$facebookId')";
                        $conn->query($sqlRegisterUser);
                    }

                    $sqlGetUser ="SELECT id, username
                                  FROM user_owner
                                  WHERE facebook_id = '$facebookId'
                                      AND deleted = 0";
                    $objGetUser = $conn -> fetchAll($sqlGetUser);

                    $this->sendEmail($objGetUser[0]['id']);
                    $this->updateLogin($objGetUser[0]['id']);

                    $user = $objGetUser[0]['username'];
                    $id = $objGetUser[0]['id'];
                    $session->set('user', $user);
                    $session->set('id', $id);
                }
            }catch (\Exception $e){
                echo "ERROR : ".$e;
            }
        }
        exit();
    }
}

