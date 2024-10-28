<?php
require_once("../config/connect.php");
require_once("../models/Diary.php");
require_once("../../../config/session.php");
require_once("../helpers/Encrypt.code.php");

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "save_content":
        $data_array = [
            "content" => Encrypt::encrypt($data["content"]), 
            "user_id" => $userid,
            "id" => $data["id"],
            "created_at" => $data["created_at"]
        ];
        $diary = new Diary($data_array);
        $result =  $diary->save();
        // Codigo original
        echo json_encode([
            "id" => isset($result["id"]) ? $result["id"] : null,
            "success" => isset($result["id"]) ? $result["ok"] : $result
        ]);
        break;

        case "get_journal":
            $results =  Diary::getJournal($data["offset"], $data["limit"], $userid);
            $noMoreRecords = count($results) < $data["limit"];
            foreach($results as $result){
                $result->content = Encrypt::decrypt($result->content);
            }
            echo json_encode([
                "entries" => $results,
                "noMoreRecords" => $noMoreRecords,
                "success" => empty($results) ? false : true
            ]);

            break;
    default:
        $response = [
            "success" => false,
            "message" => "Invalid Operation"
        ];
        echo json_encode($response);
        break;
}