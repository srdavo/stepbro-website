<?php

class Folders extends ActiveRecord{
    protected static $table = 'folders';
    protected static $columns = ["id","user_id","folder_name","created_at"];

    public $id;
    public $user_id;
    public $item_name;
    public $created_at;

    public $item_type;
    public $item_content;

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
        $query = "SELECT 
                f.id AS id,
                'folder' AS item_type,
                f.folder_name AS item_name,
                NULL AS item_content, 
                f.created_at AS created_at
            FROM 
                folders f
            LEFT JOIN 
                folder_relations fr ON fr.item_id = f.id AND fr.item_type = 'folder'
            WHERE 
                fr.id IS NULL 
                AND f.user_id = '$data_array[user_id]'

            UNION
            SELECT 
                n.id AS id,
                'note' AS item_type,
                n.title AS item_name,
                n.content AS item_content,
                n.created_at AS created_at
            FROM 
                notes n
            LEFT JOIN 
                folder_relations fr ON fr.item_id = n.id AND fr.item_type = 'note'
            WHERE 
                fr.id IS NULL 
                AND n.user_id = '$data_array[user_id]'

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