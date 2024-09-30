<?php

class Folders extends ActiveRecord{
    protected static $table = 'folders';
    protected static $columns = ["id","user_id","folder_name","created_at"];

    public $id;
    public $user_id;
    public $folder_name;
    public $created_at;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->folder_name = $args["folder_name"] ?? "";
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
    }

    public function createFolder(){
        $query = "INSERT INTO folders ( user_id, folder_name, created_at) VALUES 
        ('$this->user_id', '$this->folder_name', '$this->created_at')";
        $result = self::$db->query($query);

        return [
            'success' =>  $result,
            'id' => self::$db->insert_id
        ];
    }

    public function getFolders($data_array){
        $query = "SELECT * FROM folders
            WHERE user_id = $data_array[user_id] ORDER BY id DESC LIMIT {$data_array["limit"]} OFFSET {$data_array["offset"]}
        ";
        $result = self::querySQL($query);
        return $result;
    }

    public static function getTotalRows($userid){
        $query = "SELECT COUNT(*) as total_rows FROM " .static::$table ." WHERE user_id = ${userid} ";
        $result = self::querySQL($query);
        return array_shift( $result );
    }
}