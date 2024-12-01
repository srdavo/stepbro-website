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
        if(!isset($_SESSION["additional_data"]["diary_open"]) || !$_SESSION["additional_data"]["diary_open"]){
            echo json_encode([
                "success" => false,
                "message" => "No tienes acceso al diario"
            ]);
            exit;
        }

        $results =  Diary::getJournal($data["offset"], $data["limit"], $userid);
        $noMoreRecords = count($results) < $data["limit"];
        foreach($results as $result){
            $result->content = Encrypt::decrypt($result->content);
        }
        $_SESSION["additional_data"]["diary_open"] = false;
        echo json_encode([
            "entries" => $results,
            "noMoreRecords" => $noMoreRecords,
            "success" => empty($results) ? false : true
        ]);

        break;
    case "check_diary_pin":
        $_SESSION["additional_data"]["diary_open"] = false;
        $result = Diary::checkDiaryPin($userid);
        if(!$result){
            echo json_encode([
                "success" => false
            ]);
            exit;
        }
        echo json_encode([
            "success" => true
        ]);

        break;
    case "set_diary_pin":
        $hashed_pin = password_hash($data["pin"], PASSWORD_DEFAULT);
        $data_array = [
            "pin" => $hashed_pin,
            "user_id" => $userid
        ];
        $check_if_has_pin = Diary::checkDiaryPin($userid);
        if($check_if_has_pin){
            echo json_encode([
                "success" => false,
                "message" => "Ya tienes un pin configurado"
            ]);
            exit;
        }


        $result = Diary::setDiaryPin($data_array);
        if(!$result){
            echo json_encode([
                "success" => false
            ]);
            exit;
        }
        $_SESSION["additional_data"]["diary_pin"] = $hashed_pin;
        echo json_encode([
            "success" => true
        ]);
        break;
    case "validate_diary_pin":
        $data_array = [
            "pin" => $data["pin"],
            "user_id" => $userid
        ];
        $diary_pin = Diary::checkDiaryPin($userid);
        if(!$diary_pin){
            $_SESSION["additional_data"]["diary_open"] = false;
            echo json_encode([
                "success" => false,
                "message" => "No tienes un pin configurado"
            ]);
            exit;
        }
        if(!password_verify($data["pin"], $diary_pin[0]->diary_pin)){
            $_SESSION["additional_data"]["diary_open"] = false;
            echo json_encode([
                "success" => false,
                "message" => "Pin incorrecto"
            ]);
            exit;
        }
        $_SESSION["additional_data"]["diary_open"] = true;
        echo json_encode([
            "success" => true
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