<?php
class Notes extends ActiveRecord{
    protected static $table = 'notes';
    protected static $columns = ["id","user_id","title","content","created_at","status"];

    public $id;
    public $user_id;
    public $title;
    public $content;
    public $created_at;
    public $status = 1;


    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->title = $args["title"] ?? "";
        $this->content = $args["content"] ?? "";
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
        $this->status = $args["status"] ?? 1;
    }

    public static function getTotalrowsByUserId($id){
        $query = "SELECT COUNT(*) as total_rows FROM " .static::$table ." WHERE user_id = ${id} ";
        $result = self::querySQL($query);
        return array_shift( $result );
    }


    public function save() {
        $result = '';
        if(!is_null($this->id)) {
            // actualizar
            $result = $this->UpdateNote();
        } else {
            // Creando un nuevo registro
            $result = $this->createNote();
        }
        return $result;
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

    public function UpdateNote() {
        $this->content = $this->sanitizeContent();
        $query = "UPDATE notes 
          SET user_id = '$this->user_id', 
              title = '$this->title', 
              content = '$this->content', 
              created_at = '$this->created_at'
          WHERE id = '$this->id'";

        $result = self::$db->query($query);

        return [
            'ok' =>  $result,
            'id' => $this->id
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

    public function getNoteContent($data_array){
        $query = "SELECT * FROM notes WHERE id = {$data_array["note_id"]} AND user_id = {$data_array["user_id"]}";
        $result = self::querySQL($query);
        return [
            "success" => true,
            "data" => $result
        ];
    }

    public function deleteNote(){
        $query = "UPDATE notes SET status = 0 WHERE id = $this->id";
        $result = self::$db->query($query);
        return $result;
    }
    
    public function getDeletedNotes($data_array){
        try {
            $query = "SELECT * FROM notes 
                WHERE user_id = {$data_array["user_id"]} 
                AND status = 0
                LIMIT {$data_array["limit"]} OFFSET {$data_array["offset"]}    
            ";
            $result = self::querySQL($query);
            return $result;
        } catch (Exception $e) {
            // Handle exception
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    public static function getTotalDeletedNotes($userid) {
        $query = "SELECT COUNT(*) as total_rows FROM " . static::$table . " WHERE user_id = ? AND status = 0";    
        $stmt = self::$db->prepare($query);    
        $stmt->bind_param("i", $userid); // "i" indica que es un entero
    
        try {
            $stmt->execute();    
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
    
            // Devolver el total de filas
            return $data["total_rows"] ?? 0;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function restoreDeletedNote(){
        $query = "UPDATE notes SET status = 1 WHERE id = $this->id";
        $result = self::$db->query($query);
        return $result;
    }

    public function getNoteFolderParent($note_id){
        $query = "SELECT folder_id, item_id FROM folder_relations WHERE item_id = ? AND item_type = 'note'";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("i", $note_id);

        try {
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            return $data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteNoteForever(){
        $query = "DELETE FROM notes WHERE id = $this->id";
        $result = self::$db->query($query);
        return $result;
    }
    
    
    
    

}