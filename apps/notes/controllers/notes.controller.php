<?php
require_once("../config/connect.php");
require_once("../models/Notes.php");
require_once("../../../config/session.php");

$Notes = new Notes();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "save_note":
        $data_array = [
            "content" => $data["content"], // filter_var($data["content"], FILTER_SANITIZE_STRING)
            "user_id" => $userid,
            "id" => $data["id"]
        ];
        $note = new Notes($data_array);
        $result =  $note->save();
        echo json_encode($result);
        break;
    case "get_notes":
        $page = filter_var($data["page"], FILTER_SANITIZE_NUMBER_INT);
        $limit = 100;
        $offset = (($page+1) * $limit)-$limit;

        $data_array = [
            "page" => $page,
            "limit" => $limit,
            "offset" => $offset
        ];
        $get_notes = $Notes->getRowstoPaginator($userid, $data_array);
        $response = [
            'success' => true,
            'data' => $get_notes,
            'total_rows' => $Notes->getTotalrowsByUserId($userid),
            'limit' => $data_array["limit"],
            'offset' => $data_array["offset"]
        ];
        
        echo json_encode($response);
        
        break;
    case "get_note_content":
        $data_array = [
            "note_id" => $data["note_id"],
            "user_id" => $userid
        ];

        $note = $Notes->getNoteContent($data_array);
        echo json_encode($note);


        break;
    case "create_note_inside_folder":
        $data_array = [
            "user_id" => $userid
        ];
        $note = new Notes($data_array);
        $result =  $note->createNote();

        if(!$result["ok"]){
            $response = [
                'success' => false,
                'message' => "Error creating note"
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
                "item_type" => "note",
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
                    'message' => "Note created successfully",
                    'id' => $result["id"]
                ];
            }
            echo json_encode($response);
            exit;
        }else{
            $response = [
                'success' => true,
                'message' => "Note created successfully",
                'id' => $result["id"]
            ];
            echo json_encode($response);
            exit;
        }

        break;
    case "delete_note":
        $data_array = [
            "id" => filter_var($data["note_id"], FILTER_SANITIZE_NUMBER_INT),
            "user_id" => $userid
        ];
        $note = new Notes($data_array);
        $result =  $note->deleteNote();
        if($result){
            $response = [
                'success' => true,
                'message' => "Note deleted successfully"
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "Error deleting note"
            ];
        }
        echo json_encode($response);

        break;
    case "get_deleted_notes":
        $page = filter_var($data["page"], FILTER_SANITIZE_NUMBER_INT);
        $limit = 100;
        $offset = (($page+1) * $limit)-$limit;

        $data_array = [
            "page" => $page,
            "limit" => $limit,
            "offset" => $offset,
            "user_id" => $userid
        ];

        $deleted_notes = $Notes->getDeletedNotes($data_array);
        $response = [
            'success' => true,
            'data' => $deleted_notes,
            'total_rows' => $Notes->getTotalDeletedNotes($userid),
            'limit' => $data_array["limit"],
            'offset' => $data_array["offset"]
        ];
        echo json_encode($response);
        
        break;
    case "restore_deleted_note":
        $data_array = [
            "id" => filter_var($data["note_id"], FILTER_SANITIZE_NUMBER_INT),
            "user_id" => $userid
        ];
        $note = new Notes($data_array);
        $result =  $note->restoreDeletedNote();
        if(!$result){
            $response = [
                "success" => false,
                "message" => "Error restoring note"
            ];
            echo json_encode($response);
            exit;
        }

        $get_note_folder_parent = $Notes->getNoteFolderParent($data_array["id"]);
        if(!$get_note_folder_parent){
            $response = [
                "success" => true,
                "message" => "Note restored successfully",
                "folder_id" => 0,
                "item_id" => $data_array["id"]
            ];
            echo json_encode($response);
            exit;
        }

        $response = [
            "success" => true,
            "message" => "Note restored successfully",
            "folder_id" => $get_note_folder_parent["folder_id"],
            "item_id" => $get_note_folder_parent["item_id"]
        ];

        echo json_encode($response);

        break;
    case "delete_note_forever":
        $data_array = [
            "id" => filter_var($data["note_id"], FILTER_SANITIZE_NUMBER_INT),
            "user_id" => $userid
        ];
        $note = new Notes($data_array);
        $result =  $note->deleteNoteForever();
        if($result){
            $response = [
                'success' => true,
                'message' => "Note deleted successfully"
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "Error deleting note"
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