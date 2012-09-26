<?php
/**
 * Created by Rux
 * Date: 2012-09-25
 * Time: 14:50 น.
 *
 */

namespace FTR\AdminBundle\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FTRHelper
{
    /*
     * return array Ads position
     */
    public function dateDiff($date_start, $date_end){
        if((!empty($date_start))&&(!empty($date_end))){
            $date_diff_sec = strtotime($date_end) - strtotime($date_start);
            $date_sec = 60*60*24;
            $num_date = floor($date_diff_sec/$date_sec);
            $hour_sec = $date_diff_sec%$date_sec;
            $num_hour = floor($hour_sec/3600);
            $min_sec  = $hour_sec%3600;
            $num_min  = floor($min_sec/60);
            $sec 	  = $min_sec%60;

            $return_array = array(
                'num_date' 	=>str_pad($num_date, 2, "0", STR_PAD_LEFT),
                'num_hour'	=>str_pad($num_hour, 2, "0", STR_PAD_LEFT),
                'num_min'	=>str_pad($num_min, 2, "0", STR_PAD_LEFT),
                'num_sec'	=>str_pad($sec, 2, "0", STR_PAD_LEFT)
            );
            return $return_array;
        }
        else{
            $message = "Date start or Date empty .Please check your parameter.";
            return $message;
        }
    }

    /*
     * Convert วันที่และ เวลาเป็นแปบไทย
     */
    public function convertThaiMonth($date, $monthType = null)
    {
        $month = array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
        if($monthType == 'full'){
            $month = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
        }
        $dd = date("d",strtotime($date));
        $mn = date("m",strtotime($date));
        $mm = $month[intval($mn)];
        $yn = date("Y",strtotime($date));
//        $yy = intval($yn) + 543;
//        $h  = date("H",strtotime($date));
//        $m  = date("i",strtotime($date));
//        $s  = date("s",strtotime($date));

        $newDate = $mm;
        return $newDate;
    }

    public function convertThaiDate($date)
    {
        $month = array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
        $dd = date("d",strtotime($date));
        $mn = date("m",strtotime($date));
        $mm = $month[intval($mn)];
        $yn = date("Y",strtotime($date));
        $yy = intval($yn) + 543;
//        $h  = date("H",strtotime($date));
//        $m  = date("i",strtotime($date));
//        $s  = date("s",strtotime($date));

        return intval($dd)." ".$mm." ".$yy;
    }

    public function convertThaiDateTime($date,$monthtype='shot')
    {
        $month = array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
        if($monthtype=='full'){
            $month = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
        }

        $dd = date("d",strtotime($date));
        $mn = date("m",strtotime($date));
        $mm = $month[intval($mn)];
        $yn = date("Y",strtotime($date));
        $yy = intval($yn) + 543;
        $h  = date("H",strtotime($date));
        $m  = date("i",strtotime($date));
        $s  = date("s",strtotime($date));

        $newDate = intval($dd)." ".$mm." ".$yy." เวลา ".$h.":".$m." น." ;
        return $newDate;
    }
}