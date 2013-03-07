<?php
namespace FTR\SCAPI\Helper;

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Swift_Attachment;
use Swift_Encoder_Base64Encoder;
use Swift_Validate;
use Swift_SpoolTransport;
use Swift_Encoding;

/**
 * Created by JetBrains PhpStorm.
 * User: Exodist
 * Date: 18/1/2556
 * Time: 13:08 น.
 */
class Mailer
{
    private $_mailerHost;
    private $_mailerPort;
    private $_mailerUser;
    private $_mailerPass;

    function __construct()
    {
        $this->_mailerHost = 'mail.sourcecode.co.th';
        $this->_mailerPort = 587;
        $this->_mailerUser = 'jessaday@sourcecode.co.th';
        $this->_mailerPass = 'jy2011';
    }

    private function setTransport()
    {
        $transport = Swift_SmtpTransport::newInstance($this->_mailerHost, $this->_mailerPort)
            ->setUsername($this->_mailerUser)
            ->setPassword($this->_mailerPass);
        return $transport;
    }

    private function setMailer()
    {
        $mailer = Swift_Mailer::newInstance($this->setTransport());
        return $mailer;
    }

    /**
     * sendEmail Function
     *
     * This function use for send a email to useremail
     *
     * Example:
     * input
     *
     * $subject = 'ทดสอบอีเมล'; //หัวข้อ Email
     * $fromEmail = 'exodist_jyx@hotmail.com'; //อีเมลผู้ส่ง
     * $toEmail = $arrEmail; //ชุด Email ผู้รับ
     * $ccEmail = null; //ชุด Email ผู้รับ แบบ Carbon Copy
     * $bccEmail = null; //ชุด Email ผู้รับ แบบ Blind Carbon Copy
     * $message = 'ทดสอบว่าส่งได้ไหม'; //ข้อความหรือ html render สำหรับส่ง email
     * $partMessage = 'ทดสอบข้อความด้านหลัง'; //ข้อความส่ง email สำหรับ email ที่ไม่รองรับ html render
     * $result = $mailClass->sendEmail($subject,$fromEmail,$toEmail,$ccEmail,$bccEmail,$message,$partMessage);
     *
     * ค่าที่ได้กลับมา $result = จำนวน Email ที่ส่งออกไปได้จากรายชื่อEmail ที่ส่งค่าไว้
     *
     * อธิบายเพิ่ม และรูปแบบ
     * รูปแบบการส่งค่า $subject = 'test email for class';
     *
     * รูปแบบการส่งค่า $fromEmail can be use string value like 'newsletter@specialsquare.com'
     * or use array value like array('newsletter@specialsquare.com' => 'Special Square');
     * ->>It will be send by 'Special Square' and from email 'newsletter@specialsquare.com'
     *
     * รูปแบบการส่งค่า $toEmail,$ccEmail,$bccEmail
     * can be use string value like 'korakotc@sourcecode.co.th'
     * or use array value like array('korakotc@sourcecode.co.th' => Korakot C.,jessaday@sourcecode.co.th)
     * ->>It will be send to user 'Korakot C.' and to email 'korakotc@sourcecode.co.th'
     * ->>and to email jessaday@sourcecode.co.th
     *
     * รูปแบบการส่งค่า $message can be use text or html render
     *
     * รูปแบบการส่งค่า $partMessage can be use text
     *
     * @param $subject subject for email
     * @param $fromEmail string of email user who send email
     * @param $toEmail string of email user or array of email user
     * @param $ccEmail string of email user or array of email user
     * @param $bccEmail string of email user or array of email user
     * @param $message messages or html render for send out email
     * @param $partMessage messages for email that can't receive html email render
     * @return integer
     */
    public function sendEmail($subject, $fromEmail, $toEmail, $ccEmail = null, $bccEmail = null, $message, $partMessage)
    {
        $mailer = $this->setMailer();

        if (!is_array($toEmail) && !empty($toEmail)) {
            $toEmail = $this->convertTextToArray($toEmail);
        }
        if (!is_array($ccEmail) && !empty($ccEmail)) {
            $ccEmail = $this->convertTextToArray($ccEmail);
        }
        if (!is_array($bccEmail) && !empty($bccEmail)) {
            $bccEmail = $this->convertTextToArray($bccEmail);
        }

        $message = Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($fromEmail)
            ->setTo($toEmail)
            ->setCc($ccEmail)
            ->setBcc($bccEmail)
            ->setBody($message, 'text/html')
            ->addPart($partMessage);
        $result = $mailer->send($message);
        return $result;
    }

    private function convertTextToArray($text)
    {
        return array($text);
    }
}
