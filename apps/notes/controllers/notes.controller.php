<?php
require_once("../config/connect.php");
require_once("../models/Notes.php");
require_once("../../../config/session.php");

$Notes = new Notes();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "create_note":
        $data_array = [
            "content" => filter_var($data["content"], FILTER_SANITIZE_STRING),
            "user_id" => $userid
        ];
        $note = new Notes($data_array);
        $resultado =  $note->guardar();
        // $create_note = $Notes->createNote($userid, $data_array);
        echo json_encode($resultado);
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
            'total_rows' => $total_rows,
            'limit' => $data_array["limit"],
            'offset' => $data_array["offset"]
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