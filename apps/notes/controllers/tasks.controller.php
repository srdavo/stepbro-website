<?php
require_once("../config/connect.php");
require_once("../models/Tasks.php");
require_once("../../../config/session.php");


// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "save_task":
        $data_array = [
            "task" => $data["task"], 
            "user_id" => $userid,
            "id" => $data["id"] ?? null,
            "status" => $data["status"] ?? null,
            "created_at" => $data["created_at"] ?? null
        ];
        $task = new Tasks($data_array);
        $result =  $task->save();
        echo json_encode($result);

        break;

    case "get_tasks":
        $result = Tasks::allByUserId($userid);
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