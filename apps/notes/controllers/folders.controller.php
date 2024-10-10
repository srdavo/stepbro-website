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
        }else{
            $response = [
                'success' => true,
                'message' => "Folder created successfully",
                'id' => $result["id"]
            ];
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
    case "delete_folder":
        $data_array = [
            "id" => filter_var($data["folder_id"], FILTER_SANITIZE_NUMBER_INT),
            "user_id" => $userid
        ];
        $folder = new Folders($data_array);
        $result =  $folder->deleteFolder();
        if($result){
            $response = [
                'success' => true,
                'message' => "Folder deleted successfully"
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "Error deleting folder"
            ];
        }
        echo json_encode($response);

        break;
    case "get_deleted_folders":
        $page = filter_var($data["page"], FILTER_SANITIZE_NUMBER_INT);
        $limit = 100;
        $offset = (($page+1) * $limit)-$limit;

        $data_array = [
            "page" => $page,
            "limit" => $limit,
            "offset" => $offset,
            "user_id" => $userid
        ];

        $deleted_folders = $Folders->getDeletedFolders($data_array);
        $response = [
            'success' => true,
            'data' => $deleted_folders,
            'total_rows' => $Folders->getTotalDeletedFolders($userid),
            'limit' => $data_array["limit"],
            'offset' => $data_array["offset"]
        ];
        echo json_encode($response);
        break;
    case "restore_deleted_folder":
        $data_array = [
            "id" => filter_var($data["folder_id"], FILTER_SANITIZE_NUMBER_INT),
            "user_id" => $userid
        ];
        $folder = new Folders($data_array);
        $result =  $folder->restoreFolder();
        if(!$result){
            $response = [
                'success' => false,
                'message' => "Error restoring folder"
            ];
            echo json_encode($response);
            exit;
        }

        $get_folder_folder_parent = $Folders->getFolderFolderParent($data_array["id"]);
        if(!$get_folder_folder_parent){
            $response = [
                'success' => true,
                'message' => "Folder restored successfully",
                'folder_d' => 0,
                'item_id' => $data_array["id"]
            ];
            echo json_encode($response);
            exit;
        }

        $response = [
            'success' => true,
            'message' => "Folder restored successfully",
            'folder_id' => $get_folder_folder_parent["folder_id"],
            'item_id' => $data_array["id"]
        ];

        echo json_encode($response);
        
        break;
    case "delete_folder_forever":
        // Asegúrate de recibir el `folder_id` desde el request
        $folder_id = $data["folder_id"];
    
        // Verifica que el folder existe y pertenece al usuario actual
        $folder = new Folders(["id" => $folder_id, "user_id" => $userid]);
        
        if ($folder->deleteFolderWithContents()) {
            $response = [
                'success' => true,
                'message' => "Folder and its contents deleted successfully"
            ];
        } else {
            $response = [
                'success' => false,
                'message' => "Error deleting folder and its contents"
            ];
        }
    
        echo json_encode($response);
        exit;
        
    default:
        $response = [
            "success" => false,
            "message" => "Invalid Operation"
        ];
        echo json_encode($response);
        break;
}