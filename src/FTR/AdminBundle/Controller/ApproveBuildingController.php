<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * ApproveBuildingControl controller.
 *
 */
class ApproveBuildingController extends Controller
{

    public function indexAction($page)
    {
        $session = $this->get('session');
        $getPathSiteDashboard = $session->get('urlDashBoard');
        $request = $this->get('request');
        $getUrl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

        //$request = $this->container->get('request');
        echo  $currentUrl = $this->getRequest()->getUri();

        var_dump($this->generateUrl('FTRAdminBundle_Dashboard'));

        switch ($page) {
            case "approve":
                header("Location: $getUrl" . "/datagrid-backend/approve-building.php");
                break;
            case "recommend":
                header("Location: $getUrl" . "/datagrid-backend/recommend-building.php");
                break;
            default:
                header("Location: $getPathSiteDashboard");
                break;
        }
        exit();
        //return $this->render('FTRAdminBundle:Ads_Control:index.html.twig', array());
    }
}
