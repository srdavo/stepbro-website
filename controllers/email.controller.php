<?php
require_once("../config/connect.php");
require_once("../config/session.php");
require_once("../email/email_functions.php");
require_once("../models/Admin.php");
$admin = new Admin();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "sendEmail":
        $emailSends = sendEmail($data['header'],$data['content'], $data['users'],true); // obtiene un true si envio todos, un false si hubo un error
        if($emailSends){
            $response = [
                "success" => true
            ];
        }else{
            $response = [
                "success" => false,
                "message" => "Error al enviar los correos"
            ];
        }
        echo json_encode($response);
        break;

    case "sendEmailAllUsers":
        $emailSends = sendEmailToAllUser($data['header'],$data['content'],10,$admin); // obtiene un true si envio todos, un false si hubo un error
        //echo json_encode($admin->getAllUsersEmails($batchSize = 1000, $offset = 0));
        echo json_encode($emailSends);
        return;
        if($emailSends){
             $response = [
                "success" => true
            ];
        }else{
              $response = [
               "success" => false,
               "message" => "Error al enviar los correos"
            ];
        }
            echo json_encode($response);
            break;

    default:
        $response = [
            "success" => false,
            "message" => "Invalid Operation"
        ];
        echo json_encode($response);
        break;
}