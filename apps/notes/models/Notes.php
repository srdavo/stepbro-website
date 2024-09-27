<?php

class Notes extends ActiveRecord{
    protected static $table = 'notes';
    protected static $columns = ["id","user_id","title","content","created_at"];

    public $id;
    public $user_id;
    public $title;
    public $content;
    public $created_at;


    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->title = $args["title"] ?? "";
        $this->content = $args["content"] ?? "";
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
       
    }

    public static function getTotalrowsByUserId($id){
        $query = "SELECT COUNT(*) as total_rows FROM " .static::$table ." WHERE user_id = ${id} ";
        $result = self::querySQL($query);
        return array_shift( $result );
    }

    public function createNote(){
        $this->content = $this->sanitizeContent();

        $query = "INSERT INTO notes ( user_id, title, content, created_at) VALUES 
        ('$this->user_id', '$this->title', '$this->content', '$this->created_at')";

        $result = self::$db->query($query);
        
        return [
           'ok' =>  $result,
           'id' => self::$db->insert_id
        ];
    }

    public static function getRowstoPaginator($userid, $data_array){
        $query = "SELECT * FROM notes
        WHERE user_id = $userid ORDER BY id DESC LIMIT {$data_array["limit"]} OFFSET {$data_array["offset"]}
        ";
        $result = self::querySQL($query);
        return $result;
    }

    public function sanitizeContent() {
        // Permitir etiquetas específicas
        $allowed_tags = '<b><i><u><strong><em><h1><h2><ul><ol><li><div>';
        
        // Usar strip_tags para eliminar etiquetas no permitidas
        $sanitized_content = strip_tags($this->content, $allowed_tags);
        return $sanitized_content;
        // return htmlentities($sanitized_content, ENT_QUOTES, 'UTF-8');
    }

}