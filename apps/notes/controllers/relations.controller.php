<?php
require_once("../config/connect.php");
require_once("../models/Relations.php");
require_once("../../../config/session.php");
require_once("../helpers/Encrypt.code.php");


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

        $folder_content = json_decode(json_encode($folder_content), true);
        foreach ($folder_content as &$item) {
            if ($item['status'] == 2 && $item['item_type'] === 'note') {
                $item['item_content'] = $Relations->cleanHTMLContent(Encrypt::decrypt($item['item_content']));
            }
        }

        $response = [
            'success' => true,
            'data' => $folder_content
        ];
        echo json_encode($response);
        break;
    case "move_item":
        $data_array = [
            "folder_id" => filter_var($data["folder_id"], FILTER_SANITIZE_NUMBER_INT),
            "item_id" => filter_var($data["item_id"], FILTER_SANITIZE_NUMBER_INT),
            "item_type" => filter_var($data["item_type"], FILTER_SANITIZE_STRING),
            "user_id" => $userid
        ];

        // check if item is being moved to the root folder
        if($data_array["folder_id"] == 0){
            $move_to_root = $Relations->moveToRoot($data_array);
            if(!$move_to_root){
                $response = [
                    'success' => false,
                    'message' => "Error moving item to root folder"
                ];
            }else{
                $response = [
                    'success' => true,
                    'message' => "Item moved to root folder"
                ];
            }
            echo json_encode($response);
            exit;
        }

        // Check if item is being moved to the same folder
        if($data_array["folder_id"] == $data["item_id"] && $data["item_type"] == "folder"){
            $response = [
                'success' => false,
                'message' => "Cannot move item to the same folder"
            ];
            echo json_encode($response);
            exit;
        }

        // check if item is being moved to a folder that is inside the item
        $folder_content = $Relations->getFolderContent(["folder_id" => $data_array["item_id"], "user_id" => $userid]);
        foreach($folder_content as $item){
            if($item["item_type"] == "folder" && $item["item_id"] == $data_array["folder_id"]){
                $response = [
                    'success' => false,
                    'message' => "No puedes moverlo a esta carpeta"
                ];
                echo json_encode($response);
                exit;
            }
        }

        // check if item is being moved to a folder with no rows in folder_relations
        $check_if_relation_exists = $Relations->checkIfRelationExists($data_array);
        if($check_if_relation_exists <= 0){
            $create_relation = $Relations->createRelation($data_array);
            if(!$create_relation){
                $response = [
                    'success' => false,
                    'message' => "Error creating relation"
                ];
            }else{
                $response = [
                    'success' => true,
                    'objetive_folder' => $data_array["folder_id"],
                    'item_to_move' => $data_array["item_id"],
                    'count' => $check_if_relation_exists,
                    'message' => "Item moved successfully good."
                ];
            }

            echo json_encode($response);
            exit;
        }

        // check if exact elation already exists
        // $check_if_relation_exists = $Relations->checkIfExactRelationExists($data_array);
        // if($check_if_relation_exists > 0){
        //     $response = [
        //         'success' => false,
        //         'data' => $check_if_relation_exists,
        //         'message' => "Ya se encuentra en esta carpeta"
        //     ];
        //     echo json_encode($response);
        //     exit;
        // }
        
        // if all checks pass, move item
        $move_item = $Relations->moveItem($data_array);
        if(!$move_item){
            $response = [
                'success' => false,
                'message' => "Error moving item"
            ];
        }else{
            $response = [
                'success' => true,
                'message' => "Item moved successfully"
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