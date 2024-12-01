<?php
require_once("../config/connect.php");
require_once("../models/Notes.php");
require_once("../../../config/session.php");
require_once("../helpers/Encrypt.code.php");

$Notes = new Notes();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "save_note":
        $data_array = [
            "content" => $data["content"], // filter_var($data["content"], FILTER_SANITIZE_STRING)
            "user_id" => $userid,
            "id" => $data["id"],
            "status" => $data["status"]
        ];
        $note = new Notes($data_array);
        
        if($data["status"] == 2){
            $encrypted_note = Encrypt::encrypt($data["content"]);
            if (!$encrypted_note) {
                $response = [
                    "success" => false,
                    "message" => "Failed to encrypt note"
                ];
                echo json_encode($response);
                exit;
            }
            $note->content = $encrypted_note;
        }
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

        if($note["data"][0]->status == 2){
            // if note is encrypted
            if(!isset($_SESSION["additional_data"]["diary_open"]) || !$_SESSION["additional_data"]["diary_open"]){
                echo json_encode([
                    "success" => false,
                    "message" => "No puedes acceder a una nota bloqueada"
                ]);
                exit;
            }
            $note_content = Encrypt::decrypt($note["data"][0]->content);
            $note["data"][0]->content = $note_content;
            $_SESSION["additional_data"]["diary_open"] = false;
        }

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
        $limit = 30;
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
    case "encrypt_note":
        $data_array = [
            "id" => filter_var($data["note_id"], FILTER_SANITIZE_NUMBER_INT),
            "note_id" => filter_var($data["note_id"], FILTER_SANITIZE_NUMBER_INT),
            "user_id" => $userid,
            "status" => 2
        ];
        try {
            // start a transaction
            if(!isset($_SESSION["additional_data"]["diary_open"]) || !$_SESSION["additional_data"]["diary_open"]){
                echo json_encode([
                    "success" => false,
                    "message" => "No tienes acceso a esta operación"
                ]);
                exit;
            }

            $db->autocommit(false);
            $note = new Notes($data_array);

            // 1. Check if note is already encrypted
            $check_if_encrypted = $note->checkIfNoteIsEncrypted();
            if ($check_if_encrypted) {
                throw new Exception("Note is already encrypted ");
            }
        
            // 2. Get note content
            $note_content = $Notes->getNoteContent($data_array)["data"][0]->content;
            if($note_content == ""){
                throw new Exception("Failed to get note content ". $note_content);
            }
        
            // 3. Encrypt note content
            $encrypted_note = Encrypt::encrypt($note_content);
            if (!$encrypted_note) {
                throw new Exception("Failed to encrypt note");
            }
            $data_array["content"] = $encrypted_note;
        
            // 4. Save encrypted note
            $note = new Notes($data_array);
            $result = $note->save();
            if (!$result["ok"]) {
                throw new Exception("Failed to save encrypted note ". $result);
            }
        
            // 5. Set note as encrypted
            $set_note_as_encrypted = $note->setNoteAsEncrypted();
            if (!$set_note_as_encrypted) {
                throw new Exception("Failed to update note encryption status ". $set_note_as_encrypted);
            }
        
            // // Confirm the transaction
            $db->commit();
        
            $response = [
                "success" => true,
                "check_if_encrypted" => $check_if_encrypted,
                "note_content" => $note_content,
                "encrypted_note" => $encrypted_note,
                "result" => $result,
                "set_note_as_encrypted" => $set_note_as_encrypted
                
            ];
        } catch (Exception $e) {
            // revert the transaction
            $db->rollBack();
        
            $response = [
                "success" => false,
                "error" => $e->getMessage(),
            ];
        }
        
        $_SESSION["additional_data"]["diary_open"] = false;
        echo json_encode($response);
        

        break;
    case "decrypt_note":
        $data_array = [
            "id" => filter_var($data["note_id"], FILTER_SANITIZE_NUMBER_INT),
            "note_id" => filter_var($data["note_id"], FILTER_SANITIZE_NUMBER_INT),
            "user_id" => $userid,
            "status" => 1
        ];
        try {
            // start a transaction
            if(!isset($_SESSION["additional_data"]["diary_open"]) || !$_SESSION["additional_data"]["diary_open"]){
                echo json_encode([
                    "success" => false,
                    "message" => "No tienes acceso a esta operación"
                ]);
                exit;
            }

            $db->autocommit(false);
            $note = new Notes($data_array);

            // 1. Check if note is not encrypted
            $check_if_encrypted = $note->checkIfNoteIsEncrypted();
            if (!$check_if_encrypted) {
                throw new Exception("Note is not encrypted");
            }
        
            // 2. Get note content
            $note_content = $Notes->getNoteContent($data_array)["data"][0]->content;
            if($note_content == ""){
                throw new Exception("Failed to get note content ". $note_content);
            }
        
            // 3. Decrypt note content
            $decrypted_note = Encrypt::decrypt($note_content);
            if (!$decrypted_note) {
                throw new Exception("Failed to decrypt note");
            }
            $data_array["content"] = $decrypted_note;
        
            // 4. Save decrypted note
            $note = new Notes($data_array);
            $result = $note->save();
            if (!$result["ok"]) {
                throw new Exception("Failed to save decrypted note ". $result);
            }
        
            // 5. Set note as decrypted
            $set_note_as_decrypted = $note->setNoteAsDecrypted();
            if (!$set_note_as_decrypted) {
                throw new Exception("Failed to update note decryption status ". $set_note_as_decrypted);
            }
        
            // // Confirm the transaction
            $db->commit();
        
            $response = [
                "success" => true,
                "check_if_encrypted" => $check_if_encrypted,
                "note_content" => $note_content,
                "decrypted_note" => $decrypted_note,
                "result" => $result,
                "set_note_as_decrypted" => $set_note_as_decrypted
                
            ];
        } catch (Exception $e) {
            // revert the transaction
            $db->rollBack();
        
            $response = [
                "success" => false,
                "error" => $e->getMessage(),
            ];
        }

        $_SESSION["additional_data"]["diary_open"] = false;
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