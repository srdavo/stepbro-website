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
            "description" => $data["description"] ?? null,
            "limit_date" => $data["limit_date"] ?? null,
            "user_id" => $userid,
            "id" => $data["id"] ?? null,
            "status" => $data["status"] ?? null,
            "created_at" => $data["created_at"] ?? null
        ];
        $task = new Tasks($data_array);
        $result =  $task->save();

        echo json_encode([
            "id" => isset($result["id"]) ? $result["id"] : null,
            "description"=> $result["description"] ?? null,
            "limit_date"=>$result["limit_date"] ?? null,
            "status"=>$result["status"] ?? "Pendiente",
            "success" => isset($result["id"]) ? $result["ok"] : $result,
            "created_at" => $task->created_at ?? null,
            "message" => isset($result["id"]) ? "Task saved" : "Error saving task"
        ]);

        break;

    case "get_tasks":
        $result = Tasks::taskByIdWhCompleted($userid);
        echo json_encode($result);
        break;
    case "get_completed_tasks":
        $result = Tasks::CompletedtaskById($userid, $data["month"], $data["year"]);
        echo json_encode($result);
        break;
    case "get_deleted_tasks":
        $result = Tasks::getDeletedTasks($userid);
        echo json_encode($result);
        break;

    case "delete_task":
        $task = new Tasks($data["id"]);
        $result = $task->delete();
        if(!$result){
            $response = [
                "success" => false,
                "message" => "Error deleting task"
            ];
            echo json_encode($response);
            break;
        }
        $response = [
            "success" => true,
            "message" => "Task deleted"
        ];
        echo json_encode($response);
        break;

    case "update_status":
        if(!isset($data["id"])){
            $repsonse = [
                "success"=> false,
                "message"=> "Task id is required"
            ];
            echo json_encode($repsonse);
            break;
        }

        $data_array = [
            "id" => $data["id"],
            "status" => $data["status"] ?? "Pendiente",
            "last_status" => $data["last_status"] ?? "0"
        ];
        $task = new Tasks();
        $update_status = $task->updateStatus($data_array);
        if($update_status){
            $repsonse = [
                "success" => true,
                "message" => "Task updated"
            ];
        }else{
            $repsonse = [
                "success"=> false,
                "message"=> "Error updating task"
            ];
        }
        echo json_encode($repsonse);
        break;

    default:
        $response = [
            "success" => false,
            "message" => "Invalid Operation"
        ];
        echo json_encode($response);
        break;
}