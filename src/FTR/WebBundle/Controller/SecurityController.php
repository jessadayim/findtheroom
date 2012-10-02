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
		$password = md5($_POST['password']);
		if($username !=NULL&& $password !=NULL){
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
	public function logPublishAction()
    {

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
        return $this->render('FTRWebBundle:Security:login.html.twig',array());
    }

	public function logoutAction()
	{
		$session = $this->get('session');
		$session->set('user', '');
        $session->set('id', '');
		return $this->redirect($this->generateUrl('FTRWebBundle_homepage'));
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
        $id = $me['id'];
        $email = $me['email'];
        $username = $me['username'];

        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}

        $session = $this->get('session');

        try{
            $sqlCheckUser ="SELECT id, username
                            FROM user_owner
                            WHERE facebook_id = '$id'
                                AND deleted = 0";
            $objCheckUser = $conn -> fetchAll($sqlCheckUser);
            $rowCount = count($objCheckUser);

            if($rowCount == 1){
                $user = $objCheckUser[0]['username'];
                $id = $objCheckUser[0]['id'];
                $session->set('user', $user);
                $session->set('id', $id);
            }else{
                $sqlCheckEmail = "SELECT id
                                  FROM user_owner
                                  WHERE email = '$email'
                                      AND deleted = 0";
                $objCheckEmail = $conn -> fetchAll($sqlCheckEmail);

                if(count($objCheckUser) == 1){
                    $userId = $objCheckEmail[0]['id'];
                    $sqlUpdateUser ="UPDATE user_owner
                                     SET facebook_id = '$id'
                                     WHERE id = '$userId'";
                    $conn->query($sqlUpdateUser);
                }else{
                    $sqlRegisterUser ="INSERT INTO user_owner(username, email, deleted, user_level, facebook_id)
                                       VALUES('$username', '$email', 0, 2, '$id')";
                    $conn->query($sqlRegisterUser);
                }

                $sqlGetUser ="SELECT id, username
                            FROM user_owner
                            WHERE facebook_id = '$id'
                                AND deleted = 0";
                $objGetUser = $conn -> fetchAll($sqlGetUser);

                $user = $objGetUser[0]['username'];
                $id = $objGetUser[0]['id'];
                $session->set('user', $user);
                $session->set('id', $id);
            }
        }catch (\Exception $e){
            echo "ERROR : ".$e;
        }
        exit();
    }
}

