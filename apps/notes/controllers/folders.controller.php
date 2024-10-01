<?php
require_once("../config/connect.php");
require_once("../models/Folders.php");
require_once("../../../config/session.php");

$Folders = new Folders();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "create_folder":
        $data_array = [
            "folder_name" => filter_var($data["folder_name"], FILTER_SANITIZE_STRING),
            "user_id" => $userid
        ];
        $folder = new Folders($data_array);
        $result =  $folder->createFolder();
        if(!$result["success"]){
            $response = [
                'success' => false,
                'message' => "Error creating folder"
            ];
            echo json_encode($response);
            exit;
        }

        if($data["parent_folder_id"] && $data["parent_folder_id"] != 0){
            require_once("../models/Relations.php");
            $Relations = new Relations();
            $relation_data = [
                "folder_id" => $data["parent_folder_id"],
                "item_id" => $result["id"],
                "item_type" => "folder",
                "user_id" => $userid
            ];
            $create_relation = $Relations->createRelation($relation_data);
            if(!$create_relation){
                $response = [
                    'success' => false,
                    'message' => "Error creating relation"
                ];
            }else{
                $response = [
                    'success' => true,
                    'message' => "Folder created successfully",
                    'id' => $result["id"]
                ];
            }
            echo json_encode($response);
            exit;
        }
        break;
    case "get_folders":
        $page = filter_var($data["page"], FILTER_SANITIZE_NUMBER_INT);
        $limit = 100;
        $offset = (($page+1) * $limit)-$limit;

        $data_array=[
            "page" => $page,
            "limit" => $limit,
            "offset" => $offset,
            "user_id" => $userid
        ];
        $get_folders = $Folders->getFolders($data_array);
        if(!$get_folders){
            $response = [
                'success' => false,
                'message' => "No folders found"
            ];
        }else{
            $response = [
                'success' => true,
                'data' => $get_folders,
                'total_rows' => $Folders->getTotalRows($userid),
                'limit' => $data_array["limit"],
                'offset' => $data_array["offset"]
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