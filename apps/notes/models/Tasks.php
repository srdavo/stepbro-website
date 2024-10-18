<?php


class Tasks extends ActiveRecord{
    protected static $table = 'tasks';
    protected static $columns = ["id","user_id","task","status","created_at","updated_at"];

    public $id;
    public $task;
    public $status;
    public $user_id;
    public $updated_at;
    public $created_at;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->task = $args["task"] ?? "";
        $this->user_id = $args["user_id"] ?? "";
        $this->status = $args["status"] ?? "Pendiente";
        $this->updated_at = $args["updated_at"] ?? date('Y-m-d H:i:s');
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
    }
}