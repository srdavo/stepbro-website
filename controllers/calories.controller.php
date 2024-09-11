<?php
require_once("../config/connect.php");
require_once("../models/Calories.php");
require_once("../config/session.php");
$calories = new Calories();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "register_calories":
        $data_array = [
            "calories" => filter_var($data["calories"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            "description" => filter_var($data["description"], FILTER_SANITIZE_STRING),
            "date" => filter_var($data["date"], FILTER_SANITIZE_STRING),
            "time" => filter_var($data["time"], FILTER_SANITIZE_STRING)
        ];
        $register_calories = $calories->registerCalories($userid, $data_array);
        echo json_encode($register_calories);
        break;

    case "get_calories":
        $page = filter_var($data["page"], FILTER_SANITIZE_NUMBER_INT);
        $limit = 100;
        $offset = (($page+1) * $limit)-$limit;

        $data_array = [
            "page" => $page,
            "limit" => $limit,
            "offset" => $offset
        ];
        $get_calories = $calories->getCalories($userid, $data_array);
        echo json_encode($get_calories);

        break;
    case "get_total_calories":
        $total_calories = $calories->getTotalCalories($userid);
        echo json_encode($total_calories);
        break;
    case "delete_calorie_log":
        $data_array = [
            "id" => filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT)
        ];
        $delete_calorie_log = $calories->deleteCalorieLog($userid, $data_array);
        echo json_encode($delete_calorie_log);
        break;
    default:
        $response = [
            "success" => false,
            "message" => "Invalid Operation"
        ];
        echo json_encode($response);
        break;
}