<?php

class Diary extends ActiveRecord{
    protected static $table = 'diary';
    protected static $columns = ["id","user_id","content","created_at"];

    public $id;
    public $user_id;
    public $pwd;
    public $content;
    public $created_at;


    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->content = $args["content"] ?? "";
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
       
    }

    

}