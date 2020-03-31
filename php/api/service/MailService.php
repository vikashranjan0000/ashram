<?php
include_once "../../../vendor/phpmailer/phpmailer/src/PHPMailer.php";
include_once '../../../vendor/autoload.php';
class MailService {

    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer\PHPMailer\PHPMailer();
    }   

    public function processRequest($request)
    {
		$this->mail->isSMTP();
		$this->mail->SMTPDebug = 2;
		$this->mail->Host = 'smtp.gmail.com';
		$this->mail->Port = 587;
		$this->mail->protocol = 'mail';
		$this->mail->SMTPAuth = true;
		$this->mail->SMTPSecure = false;
		$this->mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);
		//$this->mail->SMTPSecure = 'tls'; 
		//$this->mail->SMTPAuth = true;
		$this->mail->Username = 'vikashranjan0000@gmail.com';
		$this->mail->Password = 'vivekJAY00.';
		$this->mail->setFrom('vikashranjan0000@gmail.com', 'Avinash Kumar');
		$this->mail->addReplyTo('vikashranjan0000@gmail.com', 'Avinash Kumar');
		$this->mail->addAddress('vikashranjan0000@gmail.com', 'Vikash Ranjan');
		$this->mail->Subject = 'PHPMailer SMTP message';
		//$this->mail->msgHTML(file_get_contents('message.html'), __DIR__);
		//$this->mail->msgHTML("this is hello world mail!!");
		$this->mail->Body ="Dear receiver, this is test mail..".$_POST['programName']." address ". $_POST['programLocation']. " startDate ".$_POST['userName']. " file URL ". $_POST['paymentRecipt']."";
		$this->mail->AltBody = 'This is a plain text message body';
		//$this->mail->addAttachment('Report.xlsx');
		if (!$this->mail->send()) {
		    return 'Mailer Error: ' . $this->mail->ErrorInfo;
		} else {
		    return 'Message sent!';
		}
	}
}