<?php
require_once("../config/connect.php");
require_once("../models/Appointment.php");
require_once("../../../../config/session.php");
require_once("../models/Permissions.php");
require_once("../models/ActionLog.php");
require_once("../helpers/Pagination.php");

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){
    case "appt_create":
        $data_array = [
            "id" => null,
            "user_id" => $userid,
            "owner_id" => $data["owner_id"] ?? null,
            "action_id" => 6,
            "patient_id" => $data["patient_id"],
            "appt_date" => $data["appt_date"],
            "appt_time" => $data["appt_time"],
            "appt_status" => 1,
            "appt_cost" => $data["appt_cost"] ?? 0,
            "appt_concept" => $data["appt_concept"] ?? ""
        ];

        $log = [
            "user_id" => $userid,
            "action_id" => $data_array["action_id"],
            "target_type" => "appointments"
        ];

        try{
            $db->autocommit(false);

            $permissions = Permissions::validatePermissions($data_array);
            if (!$permissions) { throw new Exception('Insufficient permissions'); }
            if (!is_null($data_array['owner_id'])) { $data_array['user_id'] = $data['owner_id']; }

            $appointment = new Appointment($data_array);
            $result = $appointment->save();
            if(!$result){ throw new Exception('Failed to save appointment'); }

            $log['target_id'] = $result['id'];
            $log['owner_id'] = $data_array['owner_id'] ?? $userid;
            $log_result = ActionLog::saveLog($log);
            if(!$log_result){ throw new Exception('Failed to save action log'); }

            $db->commit();
            $response = [
                "success" => true,
                "message" => "Appointment created successfully",
                "appt_id" => $result['id'],
                "patient_id" => $data_array['patient_id']
            ];

        } catch (Exception $e) {
            $db->rollback();
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }

        echo json_encode($response);
        break;

    case "appts_get_list":
        $data_array = [
            "id" => null,
            "user_id" => $userid,
            "owner_id" => $data["owner_id"] ?? null,
            "action_id" => 10,
            "page" => $data["page"] ?? 0,
            "filters" => $data["filters"] ?? [],
            "limit" => Pagination::getPageLimit($data["limit"] ?? null)
        ];

        try {
            $db->autocommit(false);

            $permissions = Permissions::validatePermissions($data_array);
            if (!$permissions) { throw new Exception('Insufficient permissions'); }
            if (!is_null($data_array['owner_id'])) { $data_array['user_id'] = $data['owner_id']; }

            $pagination_values = Pagination::PaginationValues($data_array["page"], $data_array["limit"]);
            $data_array["limit"] = $pagination_values["limit"];
            $data_array["offset"] = $pagination_values["offset"];

            $total_rows = Appointment::getRowsCount($data_array["user_id"], $data_array["filters"]);
            if($total_rows === false){ throw new Exception('Failed to get total rows'); }

            $result = Appointment::getAppts($data_array);
            if($result === false){ throw new Exception('Failed to get data'); }

            $db->commit();
            $response = [
                "success" => true,
                "data" => $result,
                "stats" => [
                    "total_cost" => $total_rows["total_cost"]
                ],
                "pagination" => [
                    "total_rows" => $total_rows["count"],
                    "limit" => $data_array["limit"],
                    "offset" => $data_array["offset"]
                ]
            ];

        } catch (Exception $e) {
            $db->rollback();
            $response = [
                "success" => false,
                "message" => $e->getMessage(),
            ];
        }

        echo json_encode($response);
        break;
    default:
        $response = [
            "success" => false,
            "message" => "Invalid Operation",
        ];
        echo json_encode($response);
        break;
}