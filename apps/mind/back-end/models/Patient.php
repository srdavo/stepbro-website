<?php
class Patient extends ActiveRecord {
    protected static $table = "patients";
    protected static $columns = [
        "id",
        "user_id",
        "patient_name"
    ];

    public $id;
    public $user_id;
    public $patient_name;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->patient_name = $args["patient_name"] ?? "";
    }


}