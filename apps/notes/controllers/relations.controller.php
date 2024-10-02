<?php
require_once("../config/connect.php");
require_once("../models/Relations.php");
require_once("../../../config/session.php");

$Relations = new Relations();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "get_folder_content":
        $folder_id = filter_var($data["folder_id"], FILTER_SANITIZE_NUMBER_INT);
        $data_array = [
            "folder_id" => $folder_id,
            "user_id" => $userid
        ];
        $folder_content = $Relations->getFolderContent($data_array);
        $response = [
            'success' => true,
            'data' => $folder_content
        ];
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