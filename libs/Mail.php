<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
//require 'vendor/autoload.php';
require 'public/PHPMailer/src/PHPMailer.php';
require 'public/PHPMailer/src/SMTP.php';
require 'public/PHPMailer/src/Exception.php';

// Instantiation and passing `true` enables exceptions

class Mail {

    function __construct($host, $username, $password, $title, $port) {
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'UTF-8';
        //Server settings
//        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $this->mail->isSMTP();     // Send using SMTP
//        $this->mail->isSendmail();
        $this->mail->Host = $host;                    // Set the SMTP server to send through
        $this->mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $this->mail->Username = $username;                     // SMTP username
        $this->mail->Password = $password;                               // SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = $port;
        $this->mail->setFrom($username, $title);
        $this->mail->isHTML(true);
        $this->mail->addReplyTo($username, $title);
    }

    function set_content($content, $data = false, $button = false) {
        $this->mail->Subject = $content["subject"];
//        $this->mail->Body .= '';
        $this->mail->Body .= MAIL_HEADER;
        $this->mail->Body .= $content["title"];
        $this->mail->Body .= MAIL_SET1;
        $this->mail->Body .= $content["message"];
        $this->mail->Body .= MAIL_SET2;

        if ($data) {
            $this->mail->Body .= MAIL_DATA_BEFORE;
            $this->mail->Body .= $data["data"];
            $this->mail->Body .= MAIL_DATA_AFTER;
        }

        if ($button) {
            $this->mail->Body .= MAIL_BUTTON_BEFORE;
            $this->mail->Body .= $button["href"];
            $this->mail->Body .= MAIL_BUTTON_BEFORE2;
            $this->mail->Body .= $button["text"];
            $this->mail->Body .= MAIL_BUTTON_AFTER;
        }


        $this->mail->Body .= MAIL_FOOTER;
        if (isset($content["altbody"])) {
            $this->mail->AltBody = $content["altbody"];
        }
    }

    //['email','email','email']
    //can't see BCC
    function set_address($address, $user = 'User') {
        $this->mail->addAddress($address, $user);  // Add a recipient
    }

    //['email','email','email']
    //can't see BCC
    function cc($cc) {
        foreach ($cc as $key => $value) {
            $this->mail->addCC($value);
        }
    }

    //['email','email','email']
    //can't see BCC
    //can see TO, CC
    function bcc($bcc) {
        foreach ($bcc as $key => $value) {
            $this->mail->addBCC($value);
        }
    }

    //['path']
    function attach($attachment) {
        foreach ($attachment as $key => $value) {
            $this->mail->addAttachment($value);
        }
    }

    function send() {
        try {
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}

?>
