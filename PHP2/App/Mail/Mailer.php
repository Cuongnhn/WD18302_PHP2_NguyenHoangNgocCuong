<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    public $mail;
    public $adddressMail='';
    public $title = '';
    public $content = '';
    public $email = '';

    public function __construct(){
        $this->mail = new PHPMailer(true);

        try {
            $this->server_settings();
            $this->Recipients();
            $this->Content();
            $this->sendMail($this->title,$this->content,$this->adddressMail);
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function server_settings(){
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->CharSet = 'utf-8';
        $this->mail->Host = 'smtp.gmail.com';                             //Set the SMTP server to send through
        $this->mail->SMTPAuth = true;                                     //Enable SMTP authentication
        $this->mail->Username = 'cuongnhnpc02907@fpt.edu.vn';              //SMTP username
        $this->mail->Password = 'gdtcyagdkuiajzpa';                        //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             //Enable implicit TLS encryption
        $this->mail->Port = 465;                                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $this->mail->SMTPDebug = 0;                                        // Tắt ghi log chi tiết
    }

    public function Recipients(){
        $this->mail->setFrom('cuongnhnpc02907@fpt.edu.vn', 'Cmall102');
        $this->mail->addAddress($this->adddressMail);
    }
    
    public function Content(){
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = $this->title;
        $this->mail->Body = $this->content;
    }

    public function sendMail($title, $content, $adddressMail)
    {
        $this->mail->isHTML(true); 
        $this->mail->Subject = $title;
        $this->mail->Body = $content;
        $this->mail->addAddress($adddressMail); 
        $this->mail->send();
    }
    
}