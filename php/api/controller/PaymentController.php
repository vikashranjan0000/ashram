<?php

include_once "../config/database.php"; 
include_once "../service/PaymentGatewayService.php";
include_once "../service/ScheduleService.php";


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $db = new Database();
    $dbConnection =  $db->getConnection();
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $controller = new PaymentController($dbConnection, $requestMethod);
    $controller->processRequest();

class PaymentController {

    private $db;
    private $requestMethod;

    private $paymentGatewayService;
    private $scheduleService;

    public function __construct($db, $requestMethod)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->paymentGatewayService = new PaymentGatewayService($this->db);
        $this->scheduleService = new ScheduleService($this->db);
        
    }   

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'POST':
                if (!empty($_POST["updatePayment"])) {
                    $response = $this->updatePaymentOrderId(($_POST));
                };
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        
        if ($response['body']) {
            echo json_encode($response['body']);
        }
    }


    private function updatePaymentOrderId($respdata)
    {
        $result = $this->paymentGatewayService->updatePaymentResp($respdata);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $response['body'] = $result;
        return $response;
    }
    
    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}