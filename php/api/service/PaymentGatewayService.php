<?php
use Razorpay\Api\Api;
include_once '../../../vendor/autoload.php';
class PaymentGatewayService {

    private $api;
    private $connection;
    
    public function __construct($db)
    {
    	$this->api = new Api("rzp_test_TYAsXdXhKaGSa6", "CBhddDsuif6iwFGPhnuEzBEG");
        $this->connection = $db;
    }   



    public function getOrderId($orderId)
    {
		$order = $this->api->order->create(array(
		  'receipt' => $orderId,
		  'amount' => 10000,
		  'payment_capture' => 0,
		  'currency' => 'INR'

		  )
		);
		return $order->id;
	}  


    public function processOrderInit($reqData, $orderId)
    {
		$order = $this->api->order->create(array(
		  'receipt' => $orderId,
		  'amount' => 10000,
		  'payment_capture' => 0,
		  'currency' => 'INR',
			'notes'=>$reqData
		  )
		);
		//insertBookingOrderDetail($order, $reqData)
		return $order->id;
	}  

	function insertBookingOrderDetail($order, $reqData)
    {
       
        $bookingRef         = 'bookingRef';
        $Booking_Time   = time();
        $response=array();

/*
        $ScheduleId         = array_key_exists('scheduleId', $reqData)? $reqData['scheduleId']:"";
        $programid          = array_key_exists('programId', $data)? $data['programId']:0;
        $StartDate          = array_key_exists('StartDate', $data)? $data['StartDate']:"";
        $EndDate            = array_key_exists('EndDate', $data) ? $data['EndDate']:"";
        $programName        = array_key_exists('programName', $data) ? $data['programName']:"";
        $programLocation    = array_key_exists('programLocation', $data) ? $data['programLocation']:"";
        $graguatedProgram   = array_key_exists('GraduationLevel', $data) ? $data['GraduationLevel']:"";
        $PaymentDocs        = array_key_exists('paymentRecipt', $data) ? $data['paymentRecipt']:"";
        $DairyNumber        = array_key_exists('dairyNumber', $data)? $data['dairyNumber']:"";
        $phoneNumber        = array_key_exists('phoneNumber', $data)? $data['phoneNumber']:"";
        $EmailId            = array_key_exists('emailId', $data) ? $data['emailId']:"";
        $UserName           = array_key_exists('userName', $data)? $data['userName']:"";
        $bankName           = array_key_exists('bankName', $data)? $data['bankName']:"";
        $transferType           = array_key_exists('transferType', $data)? $data['transferType']:"";
        $transactionId           = array_key_exists('transactionId', $data)? $data['transactionId']:"";
        $comments           = array_key_exists('comments', $data)? $data['comments']:"";

        $state              = array_key_exists('userState', $data)? $data['userState']:"";
        $City               = array_key_exists('city', $data)? $data['city']:"";

        $Address = $UserName.", ".$state.", ".$City;
        $Remark = "Bank Name : ".$bankName.", transfer type : ".$transferType.", transaction Id : ".$transactionId.", comments : ".$comments;

        $GraguatedProgramId = array_key_exists('GraguatedProgramId', $data) ? $data['GraguatedProgramId']:"";
        $PendingProgram = array_key_exists('PendingProgram', $data) ? $data['PendingProgram']:"";
        $PendingProgramId = array_key_exists('PendingProgramId', $data) ? $data['PendingProgramId']:"";

        $query = "INSERT INTO `tb_od_bookingDetail`( `bookingRef`, `ScheduleId`, `StartDate`, `EndDate`, `programid`, `programName`, `programLocation`, `graguatedProgram`, `GraguatedProgramId`, `PendingProgram`, `PendingProgramId`, `PaymentDocs`, `UserName`, `DairyNumber`, `phoneNumber`, `EmailId`, `Address`, `state`, `City`, `Remark`) VALUES ('".$bookingRef."', '".$ScheduleId."', '".$StartDate."', '".$EndDate."', '".$programid."', '".$programName."', '".$programLocation."', '".$graguatedProgram."','".$GraguatedProgramId."', '".$PendingProgram."', '".$PendingProgramId."', '".$PaymentDocs."', '".$UserName."', '".$DairyNumber."', '".$phoneNumber."', '".$EmailId."', '".$Address."', '".$state."', '".$City."', '".$Remark."') ";

        $result =mysqli_query($this->connection, $query);

        if(mysqli_query($this->connection, $query) === TRUE)
        {
            $response=array(
                'bookingId' => $this->connection->insert_id,
                'status' =>$result ,
                'status_message' =>'packagefeature Added Successfully.'
            );
        }
        else
        {
            $response=array(
                'bookingId' => '0',
                'status' => 0,
                'status_message' =>'packagefeature Addition Failed.'
            );
        }*/
        return $response;
    }  

	public function processRequest($mailid, $bodyTampate, $subject, $UserName)
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

		$this->mail->Subject = $subject;
		if($mailid){
		    $this->mail->addAddress($mailid,$UserName);
		}else{
		   $this->mail->addAddress('booking@oshodhara.org.in', 'Vikash Ranjan'); 
		}
		$this->mail->Body =$bodyTampate;
		$this->mail->AltBody = 'Booking request for the Sent';
		if (!$this->mail->send()) {
		    return 'Mailer Error: ' . $this->mail->ErrorInfo;
		} else {
		    return 'Message sent!';
		}
	}
	
	public function sendToReceptionMessage($data, $bookingId){

		$StartDate          = array_key_exists('StartDate', $data)? $data['StartDate']:"";
		$programName        = array_key_exists('programName', $data) ? $data['programName']:"";
		$programLocation    = array_key_exists('programLocation', $data) ? $data['programLocation']:"";
		$graguatedProgram   = array_key_exists('GraduationLevel', $data) ? $data['GraduationLevel']:"";
		$PaymentDocs        = array_key_exists('paymentRecipt', $data) ? $data['paymentRecipt']:"";
		$DairyNumber        = array_key_exists('dairyNumber', $data)? $data['dairyNumber']:"";
		$phoneNumber        = array_key_exists('phoneNumber', $data)? $data['phoneNumber']:"";
		$EmailId            = array_key_exists('emailId', $data) ? $data['emailId']:"";
		$UserName           = array_key_exists('userName', $data)? $data['userName']:"";
		$programName        = array_key_exists('programName', $data) ? $data['programName']:"";
		$mailid        		= array_key_exists('emailId', $data) ? $data['emailId']:"";
		$bankName           = array_key_exists('bankName', $data)? $data['bankName']:"";
        $transferType       = array_key_exists('transferType', $data)? $data['transferType']:"";
        $transactionId      = array_key_exists('transactionId', $data)? $data['transactionId']:"";
        $comments           = array_key_exists('comments', $data)? $data['comments']:"";
		$subject            = $programName." Booking Confirmation for Ref. No. :".$bookingId;

		$officeMailid  		="booking@oshodhara.org.in";
		$bodyTampate = "Dear Team,<br /> Requesting you to address the booking from ".$UserName ." to ".$programName.". <br />Please check booking and payment receipt attched.<br />Booking Ref No. :".$bookingId ."<br />User name  :".$UserName .".<br />Phone No. :".$phoneNumber .".<br />Emailid :".$EmailId ."<br />Dairy Number :".$DairyNumber ."<br />Start Date:".$StartDate ."<br />Program Name :".$programName ."<br />Payment receipt :".$PaymentDocs."<br />Program Location :".$programLocation."<br />Payment Bank Name :".$bankName ."<br />Payment Transfer Type :".$transferType."<br />Payment Tranasction Id :".$transactionId."<br />Comment  :".$comments;
		return $this->processRequest($officeMailid, $bodyTampate, $subject, $UserName);
	}


	public function sendToUserMessage($data, $bookingId){
		$UserName           = array_key_exists('userName', $data)? $data['userName']:"";
		$programName        = array_key_exists('programName', $data) ? $data['programName']:"";
		$mailid        		= array_key_exists('emailId', $data) ? $data['emailId']:"";
		$subject            = "Booking Confirmation Mail";
		$bodyTampate = "Dear ".$UserName.",<br /> Thank you for booking to ".$programName.". Your booking and payment receipt has been received.<br />Please use the booking reference number :".$bookingId ." while contacting to reception.<br /> <br /> You can query with us on this email: booking.query@oshodhara.org.in. <br /> Kind Regards, <br /> Oshodhara <br />Oshodhara Nanak Dham, Murthal <br /> N.H.1, 50th Milestone, GT Road, <br /> Murthal Sonepat, <br /> Haryana - 131027 (India) <br /> Mobile No.- 09671400196/3 <br />  Land line No. - 0130-2483911/12 <br /> Email: info@oshodhara.org.in <br />";
		return $this->processRequest($mailid, $bodyTampate, $subject, $UserName);
	}
}
