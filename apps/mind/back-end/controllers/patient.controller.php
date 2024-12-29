<?php
require_once("../config/connect.php");
require_once("../models/Patient.php");
require_once("../../../../config/session.php");
require_once("../models/Permissions.php");
require_once("../models/ActionLog.php");
require_once("../helpers/Pagination.php");


$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]){

    case "patient_create":

        // 1. Define data array and log array
        $data_array = [
            "id" => null,
            "user_id" => $userid,
            "patient_name" => htmlspecialchars($data["patient_name"], ENT_QUOTES, 'UTF-8'),
            "owner_id" => $data["owner_id"] ?? null,
            "action_id" => 1
        ];

        $log = [
            "user_id" => $userid,
            "action_id" => $data_array["action_id"],
            "target_type" => "patients"
        ];

        // 2. start process with transaction
        try {
            $db->autocommit(false);

            // 3. Validate permissions
            $permissions = Permissions::validatePermissions($data_array);
            if (!$permissions) { throw new Exception('Insufficient permissions'); }
            if (!is_null($data_array['owner_id'])) { $data_array['user_id'] = $data['owner_id']; }

            // 4. execute the action
            $patient = new Patient($data_array);
            $result = $patient->save();
            if(!$result){ throw new Exception('Failed to save patient'); }

            // 5. save action log
            $log['target_id'] = $result['id'];
            $log['owner_id'] = $data_array['owner_id'] ?? $userid;
            $log_result = ActionLog::saveLog($log);
            if(!$log_result){ throw new Exception('Failed to save action log'); }

            // 6. commit transaction
            $db->commit();
            $response = [
                "success" => true,
                "message" => "Patient created successfully",
                "patient_id" => $result['id']
            ];

        } catch (Exception $e) {
            $db->rollback();
            $response = [
                "success" => false,
                "message" => $e->getMessage(),
                "details" => [
                    "permissions" => $permissions ?? "No permissions",
                    "result" => $result ?? "No result",
                    "log_result" => $log_result ?? "No log"
                ]
            ];
        }

        echo json_encode($response);
        break;

    case "patients_get_list":
        // 1. Define data array
        $data_array = [
            "id" => null,
            "user_id" => $userid,
            "owner_id" => $data["owner_id"] ?? null,
            "action_id" => 5,
            "page" => $data["page"] ?? 0,
        ];

        // 2. start process with transaction
        try {
            $db->autocommit(false);

            // 3. Validate permissions
            $permissions = Permissions::validatePermissions($data_array);
            if (!$permissions) { throw new Exception('Insufficient permissions'); }
            if (!is_null($data_array['owner_id'])) { $data_array['user_id'] = $data['owner_id']; }

            // 4. get pagination offset
            $pagination_values = Pagination::PaginationValues($data_array["page"]);
            $limit = $pagination_values["limit"];
            $offset = $pagination_values["offset"];

            // 4. get table total rows
            $total_rows = Patient::getTotalTableRows($data_array["user_id"]);
            if(!$total_rows){ throw new Exception('Failed to get total rows'); }

            // 6. execute the action
            $result = Patient::allByUserIdWithPagination($data_array["user_id"], $limit, $offset);
            if(!$result){ throw new Exception('Failed to save patient'); }

            // 7. No action log needed for this action

            // 8. commit transaction
            $db->commit();
            $response = [
                "success" => true,
                "data" => $result,
                "pagination" => [
                    "total_rows" => $total_rows,
                    "limit" => $limit,
                    "offset" => $offset
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
