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
}