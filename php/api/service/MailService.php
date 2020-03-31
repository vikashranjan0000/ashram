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
		$this->mail->Host = 'localhost';
		$this->mail->Port = 25;
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
		$this->mail->Username = 'booking@oshodhara.org.in';
		$this->mail->Password = 'vivekJAY00.';
		$this->mail->setFrom('booking@oshodhara.org.in', 'Oshodhara');
		$this->mail->addReplyTo('booking@oshodhara.org.in', 'Oshodhara');
		$this->mail->addAddress('vikashranjan0000@gmail.com', 'Vikash Ranjan');
		$this->mail->Subject = 'Booking Request from '.$_POST['userName'];
		if($_POST['programName']){
		    $this->mail->addAddress($_POST['emailId'], $_POST['userName']);
		}else{
		   $this->mail->addAddress('vikashranjan0000@gmail.com', 'Vikash Ranjan'); 
		}
		$this->mail->Body ="Booking request for the ".$_POST['programName']." program has came from <br />User name  ". $_POST['programLocation']. " <br /> startDate ".$_POST['userName']. " <br />Payment Receipt URL ". $_POST['paymentRecipt']."";
		$this->mail->AltBody = 'Booking request for the ';
		if (!$this->mail->send()) {
		    return 'Mailer Error: ' . $this->mail->ErrorInfo;
		} else {
		    return 'Message sent!';
		}
	}
}