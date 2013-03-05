<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\Config\Config;


class BannerController extends Controller
{
    public function BannerAction()
    {
// เรียกข้อมูลเบื้องต้นของ website
        $siteConfig = new Config();
        $siteConfigDetail = $siteConfig->setSiteGlobal();

        return $this->render(
            'FTRWebBundle:Banner:banner.html.twig',
            array(
                'siteTitle'=> $siteConfigDetail["pageBannerTitle"],
                'siteDesc' => $siteConfigDetail["pageBannerDesc"],
                'siteKeyword' => $siteConfigDetail["siteKeyword"],
                'siteAuthor' => $siteConfigDetail["siteAuthor"],
                'siteCopyRight' => $siteConfigDetail["siteCopyright"],
                'siteRobot' => $siteConfigDetail["siteRobot"],
                'siteRevisitAfter' => $siteConfigDetail["siteRevisitAfter"],
                'siteDistribution' => $siteConfigDetail["siteDistribution"],
                'siteImage' => $siteConfigDetail["siteImage"],
                'siteUrl' => $siteConfigDetail["siteUrl"]
            )
        );
    }
}