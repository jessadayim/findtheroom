<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FTR\Config\Config;

class PublishController extends Controller
{
    
    public function PublishAction()
    {
// เรียกข้อมูลเบื้องต้นของ website
        $siteConfig = new Config();
        $siteConfigDetail = $siteConfig->setSiteGlobal();

        return $this->render(
            'FTRWebBundle:Publish:publish.html.twig',
            array(
                'enable'            =>false,
                'siteTitle'         => $siteConfigDetail["pagePublishTitle"],
                'siteDesc'          => $siteConfigDetail["pagePublishDesc"],
                'siteKeyword'       => $siteConfigDetail["siteKeyword"],
                'siteAuthor'        => $siteConfigDetail["siteAuthor"],
                'siteCopyRight'     => $siteConfigDetail["siteCopyright"],
                'siteRobot'         => $siteConfigDetail["siteRobot"],
                'siteRevisitAfter'  => $siteConfigDetail["siteRevisitAfter"],
                'siteDistribution'  => $siteConfigDetail["siteDistribution"],
                'siteImage'         => $siteConfigDetail["siteImage"],
                'siteUrl'           => $siteConfigDetail["siteUrl"]
            )
        );
    }
}