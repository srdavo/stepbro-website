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
    default:
        $response = [
            "success" => false,
            "message" => "Invalid Operation"
        ];
        echo json_encode($response);
        break;
}