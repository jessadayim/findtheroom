<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use FTR\Config\Config;

class PanelController extends Controller
{
    public function signinAction()
    {
        //$username = $_POST['username'];!empty($_POST['username']) && !empty($_POST['password'])
        $request = $this->get('request');
        $em = $this->getDoctrine()->getEntityManager();
        $conn = $this->get('database_connection');

        if (!$conn) {
            die("MySQL Connection error");
        }
        if ($request->getMethod() == 'POST') {
            $username = $request->get('username');
            $password = md5($request->get('password'));
            //$getURl = $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

            /*
            // เรียกข้อมูลเบื้องต้นของ website
            $siteConfig = new Config();
            $siteConfigDetail = $siteConfig->setSiteGlobal();
            $siteUrl = $siteConfigDetail['siteUrl'];

            $siteUrl = $this->getRequest()->getUri();
            */

            $session = $this->get('session');
            $siteUrl = $request->getScheme() . '://' . $request->getHttpHost().
                $this->generateUrl('FTRAdminBundle_Dashboard');
            $siteUrlLogout = $request->getScheme() . '://' . $request->getHttpHost().
                $this->generateUrl('FTRAdminBundle_logout');

            if ($username == '' || $password == '') {
                return $this->render(
                    'FTRAdminBundle:Ftr_panel:signin.html.twig',
                    array('txterror' => 'กรุณากรอกข้อมูลให้ครบ'
                    )
                );
            } else {
                try {
                    $sql1 = "
                        SELECT
                            id, username
                        FROM
                            user_admin
                        WHERE 1
                            AND username = '$username'
                            AND password = '$password'
                            AND userlevel = 1
                            AND deleted = 0
                    ";
                    $objSQL1 = $conn->fetchAll($sql1);
                    if (!empty($objSQL1)) {
                        $session->set('username', $objSQL1[0]['username']);
                        $session->set('id', $objSQL1[0]['id']);
                        $session->set('urlDashBoard', $siteUrl);
                        $session->set('urlLogout', $siteUrlLogout);

                        return $this->redirect($this->generateUrl('FTRAdminBundle_Dashboard'));
                    } else {
                        return $this->render(
                            'FTRAdminBundle:Ftr_panel:signin.html.twig',
                            array('txterror' => 'กรุณาตรวจสอบชื่อ และรหัสผ่าน'
                            )
                        );
                    }
                } catch (Exception $e) {
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }
            }
        }
        exit();
    }

    public function logoutAction()
    {
        $session = $this->get('session');
        $session->set('username', null);
        $session->set('id', null);
        return $this->redirect($this->generateUrl('FTRAdminBundle_panel'));
    }

    public function indexAction()
    {
        $request = $this->get('request');
        $session = $this->get('session');
        $checkSession = $session->get('username');

        if (!empty($checkSession)) {
            return $this->redirect($this->generateUrl('FTRAdminBundle_Dashboard'));
        } else {
            return $this->render('FTRAdminBundle:Ftr_panel:signin.html.twig', array('txterror' => ''));
        }
    }

}