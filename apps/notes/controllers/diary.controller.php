<?php
require_once("../config/connect.php");
require_once("../models/Diary.php");
require_once("../../../config/session.php");
require_once("../helpers/EncryptCode.php");

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "save_content":
        $data_array = [
            "content" => Encrypt::encrypt($data["content"]), 
            "user_id" => $userid,
            "id" => $data["id"]
        ];
        $diary = new Diary($data_array);
        $result =  $diary->save();
        echo json_encode($result);
        break;
    default:
        $response = [
            "success" => false,
            "message" => "Invalid Operation"
        ];
        echo json_encode($response);
        break;
}