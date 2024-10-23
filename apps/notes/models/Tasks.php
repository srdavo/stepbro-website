<?php


class Tasks extends ActiveRecord{
    protected static $table = 'tasks';
    protected static $columns = ["id","user_id","task", "description", "limit_date", "status","created_at","updated_at"];

    public $id;
    public $task;
    public $description;
    public $limit_date;
    public $status;
    public $user_id;
    public $updated_at;
    public $created_at;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->task = $args["task"] ?? "";
        $this->description = $args["description"] ?? NULL;
        $this->limit_date = $args["limit_date"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->status = $args["status"] ?? "Pendiente";
        $this->updated_at = $args["updated_at"] ?? date('Y-m-d H:i:s');
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
    }

    public static function updateStatus($data_array){
        $query = "UPDATE tasks SET status = ? WHERE id = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("si", $data_array["status"], $data_array["id"]);

        try{
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}