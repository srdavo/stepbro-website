<?php
class Appointment extends ActiveRecord {
    protected static $table = "appointments";
    protected static $columns = [
        "id",
        "user_id",
        "patient_id",
        "appt_date",
        "appt_time",
        "appt_status",
        "appt_cost",
        "appt_concept"
    ];

    public $id;
    public $user_id;
    public $patient_id;
    public $appt_date;
    public $appt_time;
    public $appt_status;
    public $appt_cost;
    public $appt_concept;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->patient_id = $args["patient_id"] ?? "";
        $this->appt_date = $args["appt_date"] ?? "";
        $this->appt_time = $args["appt_time"] ?? "";
        $this->appt_status = $args["appt_status"] ?? "";
        $this->appt_cost = $args["appt_cost"] ?? "";
        $this->appt_concept = $args["appt_concept"] ?? "";
    }


    public static function getRowsCount($user_id, $filters){
        $query = "SELECT COUNT(*) as count, SUM(appt_cost) as total_cost FROM appointments WHERE user_id = ?";
        $params = [$user_id];

        if(!empty($filters["month"])){
            $months = explode(',', $filters["month"]);
            $placeholders = str_repeat('?,', count($months) - 1) . '?';
            $query .= " AND MONTH(appt_date) IN ($placeholders)";
            $params = array_merge($params, $months);
        }

        if(!empty($filters["year"])){
            $years = explode(',', $filters["year"]);
            $placeholders = str_repeat('?,', count($years) - 1) . '?';
            $query .= " AND YEAR(appt_date) IN ($placeholders)";
            $params = array_merge($params, $years);
        }

        if(!empty($filters["status"])){
            $statuses = explode(',', $filters["status"]);
            $placeholders = str_repeat('?,', count($statuses) - 1) . '?';
            $query .= " AND appt_status IN ($placeholders)";
            $params = array_merge($params, $statuses);
        }

        if(!empty($filters["patient"])){
            if($filters["patient"] === "all_patients"){
                $query .= " AND patient_id IS NOT NULL";
            } else {
                $query .= " AND patient_id = ?";
                $params[] = $filters["patient"];
            }
        }

        $stmt = self::$db->prepare($query);
        if (!$stmt || !$stmt->execute($params)) { return false; }
        $result = $stmt->get_result();
        if (!$result) { return false;}
        return $result->fetch_assoc();
    }

    public static function getAppts($data_array){
        $user_id = $data_array["user_id"];
        $filters = $data_array["filters"];
        $limit = $data_array["limit"] ?? 100;
        $offset = $data_array["offset"] ?? 0;

        $query = "SELECT * FROM appointments WHERE user_id = ?";
        $params = [$user_id];

        if(!empty($filters["month"])){
            $months = explode(',', $filters["month"]);
            $placeholders = str_repeat('?,', count($months) - 1) . '?';
            $query .= " AND MONTH(appt_date) IN ($placeholders)";
            $params = array_merge($params, $months);
        }

        if(!empty($filters["year"])){
            $years = explode(',', $filters["year"]);
            $placeholders = str_repeat('?,', count($years) - 1) . '?';
            $query .= " AND YEAR(appt_date) IN ($placeholders)";
            $params = array_merge($params, $years);
        }

        if(!empty($filters["status"])){
            $statuses = explode(',', $filters["status"]);
            $placeholders = str_repeat('?,', count($statuses) - 1) . '?';
            $query .= " AND appt_status IN ($placeholders)";
            $params = array_merge($params, $statuses);
        }

        if(!empty($filters["patient"])){
            if($filters["patient"] === "all_patients"){
                $query .= " AND patient_id IS NOT NULL";
            } else {
                $query .= " AND patient_id = ?";
                $params[] = $filters["patient"];
            }
        }

        $query .= " ORDER BY appt_date DESC, appt_time DESC";
        // $query .= " ORDER BY CONCAT(appt_date, ' ', appt_time) DESC";
        $query .= " LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        
        $stmt = self::$db->prepare($query);
        if (!$stmt) { return false; }
        if (!$stmt->execute($params)) { return false; }
        $result = $stmt->get_result();
        if (!$result) { return false; }
        
        $appointments = [];
        while($row = $result->fetch_assoc()) {
            $appointments[] = new self($row);
        }
        
        return $appointments;
    }
}