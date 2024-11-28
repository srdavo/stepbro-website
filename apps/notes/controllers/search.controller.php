<?php
require_once("../config/connect.php");
require_once("../models/Search.php");
require_once("../../../config/session.php");

$Search = new Search();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "get_search":
        $data_array = [
            "search" => $data["search"],
            "user_id" => $userid
        ];
        $response = $Search->getSearch($data_array);
        if($response["success"]){
            $response = [
                'success' => true,
                'message' => "Resultados encontrados",
                'data' => $response["data"]
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "No se encontraron resultados"
            ];
        }
        echo json_encode($response);

        break;
    default:
        $response = [
            'success' => false,
            'message' => "Operation not found"
        ];
        echo json_encode($response);
        exit;
        break;
}