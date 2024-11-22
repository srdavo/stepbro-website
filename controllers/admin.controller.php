<?php
require_once("../config/connect.php");
require_once("../models/Admin.php");
require_once("../config/session.php");
$admin = new Admin();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "get_users":
        $page = filter_var($data["page"], FILTER_SANITIZE_NUMBER_INT);
        $limit = 10;
        $offset = (($page+1) * $limit)-$limit;

        $data_array = [
            "page" => $page,
            "limit" => $limit,
            "offset" => $offset,
            "user_id" => $userid
        ];
        $get_users = $admin->getUsers($data_array);
        if($get_users["success"]){
            $response = [
                "success" => true,
                "data" => $get_users["data"],
                "total_rows" => null, //there is no pagination yet
                "limit" => $data_array["limit"],
                "offset" => $data_array["offset"]
            ];
        }else{
            $response = [
                "success" => false,
                "message" => "Error al obtener los usuarios"
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