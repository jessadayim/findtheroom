<?php
/**
 * Created by Rux
 * Date: 2012-09-24
 * Time: 15:40 น.
 *
 */

namespace FTR\AdminBundle\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FTRConstant
{
    /*
     * return array Ads position
     */
    public function getAdsPosition(){
        return array(
            "A", "BA-1", "BA-2", "BA-3",
            "BB-1", "BB-2", "BB-3",
            "BC-1", "BC-2", "BC-3",
            "BD-1", "BD-2", "BD-3",
            "C-1", "C-2", "C-3", "C-4",
            "C-5", "C-6", "C-7", "C-8",
            "D-1", "D-2", "D-3", "D-4",
            "D-5", "D-6", "D-7", "D-8"
        );
    }

    // Pin Google Map
    private $googlePinApartment = "http://aux.iconpedia.net/uploads/18144547311350443868.png";//"http://www.findtheroom.com/web/images/Pin-GG/apartment.png";
    private $googlePinMan = "http://cdn1.iconfinder.com/data/icons/fugue/icon/pin.png";//"http://www.findtheroom.com/web/images/Pin-GG/man.png";
    private $googlePinWomen = "http://www.phukieo.net/hospital/images/stories/pin-icon.png";//"http://www.findtheroom.com/web/images/Pin-GG/woman.png";

    public function getPinApartment()
    {
        return $this->googlePinApartment;
    }

    public function getPinMan()
    {
        return $this->googlePinMan;
    }

    public function getPinWomen()
    {
        return $this->googlePinWomen;
    }
    // end Pin Google Map
}