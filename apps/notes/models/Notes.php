<?php

class Notes extends ActiveRecord{
    protected static $tabla = 'notes';
    protected static $columnasDB = ["id","user_id","tittle","content","created_at"];

    public $id;
    public $user_id;
    public $tittle;
    public $content;
    public $created_at;


    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->tittle = $args["tittle"] ?? "";
        $this->content = $args["content"] ?? "";
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
       
    }

    public static function getTotalrowsByUserId($id){
        $query = "SELECT COUNT(*) as total_rows FROM " .static::$tabla ." WHERE user_id = ${id} ";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado );
    }

    public static function getRowstoPaginator($userid, $data_array){
        $query = "SELECT * FROM notes
        WHERE user_id = $userid ORDER BY id DESC LIMIT {$data_array["limit"]} OFFSET {$data_array["offset"]}
        ";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

}