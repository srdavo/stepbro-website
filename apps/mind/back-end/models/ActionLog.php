<?php
class ActionLog extends ActiveRecord {
    protected static $table = "action_logs";
    protected static $columns = [
        "id",
        "user_id",
        "owner_id",
        "action_id",
        "action_datetime",
        "target_id",
        "target_type",
        "old_value", // this is gonna be a json
    ];

    public $id;
    public $user_id;
    public $owner_id;
    public $action_id;
    public $action_datetime;
    public $target_id;
    public $target_type;
    public $old_value;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->owner_id = $args["owner_id"] ?? "";
        $this->action_id = $args["action_id"] ?? "";
        $this->action_datetime = $args["action_datetime"] ?? "";
        $this->target_id = $args["target_id"] ?? "";
        $this->target_type = $args["target_type"] ?? "";
        $this->old_value = $args["old_value"] ?? "";
    }


    /**
     * Saves a new action log entry with default values if not provided
     * @param array $log The log data containing user_id and other optional fields
     * @return bool True if save successful, false otherwise
     * @throws InvalidArgumentException If required fields are missing
     */
    public static function saveLog(array $log): bool {
        // Validate required field
        if (!isset($log['user_id']) || empty($log['user_id'])) {
            throw new InvalidArgumentException('user_id is required');
        }

        // Set default values using null coalescing operator
        $log['owner_id'] = $log['owner_id'] ?? $log['user_id'];
        $log['action_datetime'] = $log['action_datetime'] ?? date('Y-m-d H:i:s');
        $log['old_value'] = $log['old_value'] ?? '{}';
        $log['id'] = null;

        $actionLog = new self($log);
        $result = $actionLog->save();
        return $result["ok"] === true;
    }
     
}