<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContactController extends Controller
{
	
	/**
	 * function for random captcha
	 * */
    private function random_password(){
    	$length = 4;
    	$validchars = '23456789ABCDEFGHJKLMN';
    	$numchars = mb_strlen ($validchars,'utf-8');
		$password = '';

		// each loop random 1 character
		for ($i = 0; $i < $length; $i++) {
			mt_srand();
			// random index of valid characters
			$index = mt_rand(0, $numchars - 1);
			// get character at index and append to password
			$password .= mb_substr($validchars, $index, 1,'utf-8');
			if(mb_strlen($password,'utf-8')==$length){
				break;
			}
		}
		//var_dump($password);
		return $password;
    }
	
	/**
	 * function for upload image captcha
	 **/
	private function imgCode($code){
		if($code!=""){
		
				$font = "captcha/LayijiBao.ttf";
				$font_size = 15;
				$string = $code; // String
				
				$im = imagecreatefromjpeg("captcha/bg.jpg"); // Path From Upload Temp
				$color = imagecolorallocate($im, 0, 0, 0); // Text BackColor
				$pxX = ((imagesx($im))/2)-40;
				$pxY = 25;
			
				imagettftext($im, $font_size, 0, $pxX, $pxY, $color, $font, $string);
				$file_path = "captcha/test.jpg";
				imageJpeg($im,$file_path);
				ImageDestroy($im);
		}else{
			return "";
		}
	}
	
    public function ContactAction()
    {
    	$chkChar = trim($this->random_password());
		$this->imgCode($chkChar);
		
        return $this->render('FTRWebBundle:Contact:contact.html.twig', array('char'=>$chkChar));
    }
}