<?php

class Folders extends ActiveRecord{
    protected static $table = 'folders';
    protected static $columns = ["id","user_id","folder_name","created_at", "status"];

    public $id;
    public $user_id;
    public $item_name;
    public $created_at;
    public $folder_name;

    public $item_type;
    public $item_content;
    public $status;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->folder_name = $args["folder_name"] ?? "";
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
        $this->status = $args["status"] ?? 1;
    }
/*
    public function createFolder(){
        $query = "INSERT INTO folders ( user_id, folder_name, created_at) VALUES 
        ('$this->user_id', '$this->folder_name', '$this->created_at')";
        $result = self::$db->query($query);

        return [
            'success' =>  $result,
            'id' => self::$db->insert_id
        ];
    }
*/
    public function getFolders($data_array){
        $query = "SELECT 
                f.id AS id,
                'folder' AS item_type,
                f.folder_name AS item_name,
                NULL AS item_content, 
                f.created_at AS created_at,
                f.status AS status
            FROM 
                folders f
            LEFT JOIN 
                folder_relations fr ON fr.item_id = f.id AND fr.item_type = 'folder'
            WHERE 
                fr.id IS NULL 
                AND f.user_id = '$data_array[user_id]'
                AND f.status != 0

            UNION
            SELECT 
                n.id AS id,
                'note' AS item_type,
                n.title AS item_name,
                n.content AS item_content,
                n.created_at AS created_at,
                n.status AS status
            FROM 
                notes n
            LEFT JOIN 
                folder_relations fr ON fr.item_id = n.id AND fr.item_type = 'note'
            WHERE 
                fr.id IS NULL 
                AND n.user_id = '$data_array[user_id]'
                AND n.status != 0

        ";
        $result = self::querySQL($query);
        return $result;
    }

    public static function getTotalRows($userid){
        $query = "SELECT COUNT(*) as total_rows FROM " .static::$table ." WHERE user_id = ${userid} ";
        $result = self::querySQL($query);
        return array_shift( $result );
    }

    public function deleteFolder(){
        $query = "UPDATE folders SET status = 0 WHERE id = '$this->id'";
        $result = self::$db->query($query);
        return $result;
    }

    public function getDeletedFolders($data_array){
        try {
            $query = "SELECT * FROM folders 
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

    public static function getTotalDeletedFolders($userid) {
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

    public function restoreFolder(){
        $query = "UPDATE folders SET status = 1 WHERE id = $this->id";
        $result = self::$db->query($query);
        return $result;
    }

    public function getFolderFolderParent($folder_id){
        $query = "SELECT folder_id, item_id FROM folder_relations WHERE item_id = ? AND item_type = 'folder'";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("i", $folder_id);

        try {
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            return $data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteFolderForever(){
        $query = "DELETE FROM folders WHERE id = $this->id";
        $result = self::$db->query($query);
        return $result;
    }

    public function deleteFolderWithContents() {
        // Inicia una transacción para asegurar que todos los cambios se hagan juntos
        self::$db->begin_transaction();
    
        try {
            // 1. Marcar la carpeta como eliminada (status = 0)
            $this->deleteFolderForever();
    
            // 2. Obtener todas las subcarpetas relacionadas
            $subfolders = $this->getSubfolders($this->id);
    
            // 3. Obtener todas las notas relacionadas
            $notes = $this->getNotesInFolder($this->id);
    
            // 4. Eliminar todas las relaciones de la carpeta en `folder_relations`
            $this->deleteRelations($this->id);
    
            // 5. Eliminar las notas
            if (!empty($notes)) {
                foreach ($notes as $note) {
                    $this->deleteNoteById($note['id']);
                }
            }
    
            // 6. Eliminar las subcarpetas y su contenido recursivamente
            if (!empty($subfolders)) {
                foreach ($subfolders as $subfolder) {
                    $subfolderObj = new Folders(["id" => $subfolder['id'], "user_id" => $this->user_id]);
                    $subfolderObj->deleteFolderWithContents(); // Llamada recursiva
                }
            }
    
            // Confirmar la transacción
            self::$db->commit();
    
            return true;
    
        } catch (Exception $e) {
            // En caso de error, revertir la transacción
            self::$db->rollback();
            return false;
        }
    }
    
    // Obtener las notas dentro de la carpeta
    public function getNotesInFolder($folder_id) {
        $query = "SELECT n.id FROM notes n 
                  JOIN folder_relations fr ON fr.item_id = n.id 
                  WHERE fr.folder_id = ? AND fr.item_type = 'note'";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("i", $folder_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    // Obtener las subcarpetas dentro de la carpeta
    public function getSubfolders($folder_id) {
        $query = "SELECT f.id FROM folders f 
                  JOIN folder_relations fr ON fr.item_id = f.id 
                  WHERE fr.folder_id = ? AND fr.item_type = 'folder'";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("i", $folder_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    // Eliminar relaciones de carpeta
    public function deleteRelations($folder_id) {
        $query = "DELETE FROM folder_relations WHERE folder_id = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("i", $folder_id);
        return $stmt->execute();
    }
    
    // Marcar una nota como eliminada
    public function deleteNoteById($note_id) {
        $query = "DELETE FROM notes WHERE id = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("i", $note_id);
        return $stmt->execute();
    }
    
    public function editFolderName(){
        $query = "UPDATE folders SET folder_name = ? WHERE id = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("si", $this->folder_name, $this->id);
        return $stmt->execute();
    }

    public static function cleanHTMLContent($content) {
        // Elimina las clases de los elementos
        $content = preg_replace('/\s*class="[^"]*"/', '', $content);
    
        // Reemplaza &nbsp; y otras entidades comunes de espacio en blanco
        $content = preg_replace('/&nbsp;/', ' ', $content);
        $content = preg_replace('/\s+/', ' ', $content);
    
        // Caso 1: Si comienza con una etiqueta HTML
        if (strpos($content, '<') === 0) {
            $firstClosingTagIndex = strpos($content, '>');
            if ($firstClosingTagIndex !== false) {
                $afterFirstTag = substr($content, $firstClosingTagIndex + 1);
                $secondTagIndex = strpos($afterFirstTag, '<');
                if ($secondTagIndex !== false) {
                    $firstTagContent = trim(substr($afterFirstTag, 0, $secondTagIndex));
                    return $firstTagContent;
                } else {
                    return trim($afterFirstTag);
                }
            }
        }
    
        // Caso 2: Si comienza con texto plano
        $firstTagIndex = strpos($content, '<');
        if ($firstTagIndex !== false) {
            return trim(substr($content, 0, $firstTagIndex));
        }
    
        // Si no hay etiquetas HTML, devuelve el contenido tal como está
        return trim($content);
    }
    
}