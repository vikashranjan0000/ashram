<?php

include_once "../config/database.php"; 
include_once "../service/MailService.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $db = new Database();
    $dbConnection =  $db->getConnection();
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $controller = new BookingController($dbConnection, $requestMethod);
    $controller->processRequest();

class BookingController {

    private $db;
    private $requestMethod;

    private $mailService;

    public function __construct($db, $requestMethod)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->mailService = new MailService($this->db);
    }   

    public function processRequest()
    {
        switch ($this->requestMethod) {
        case 'GET':
                if (!empty($_GET["bookService"])) {
                    $response = $this->bookServiceTestMail();
                }else if(!empty($data["masterid"])){
                    $response = $this->getMaster(($data["masterid"]));
                }else {
                    $response = $this->getAllMaster();
                };
                break;
            case 'POST':
                if (!empty($_POST["bookService"])) {
                    $response = $this->bookServiceMail();
                }else if(!empty($data["masterid"])){
                    $response = $this->getMaster(($data["masterid"]));
                } else {
                    $response = $this->getAllMaster();
                };
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        
        if ($response['body']) {
            echo json_encode($response['body']);
            //echo $response['body'];
        }
    }

    private function getAllMaster()
    {
        $result = $this->masterService->findAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function bookServiceMail()
    {
        $result = $this->mailService->processRequest($_POST);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }
    private function bookServiceTestMail()
    {   $_POST = $_GET;
        $result = $this->mailService->processRequest($_POST);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = "Successfully sent";
        return $response;
    }


    

    private function getMaster($id)
    {
        $result = $this->masterService->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}