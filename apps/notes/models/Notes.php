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
        $this->id = $args["id"] ?? "";
        $this->user_id = $args["user_id"] ?? "";
        $this->tittle = $args["tittle"] ?? "";
        $this->content = $args["content"] ?? "";
        $this->created_at = $args["created_at"] ?? "";
       
    }

}