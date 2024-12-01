<?php
class Relations extends ActiveRecord{
    protected static $table = 'folder_relations';
    protected static $columns = ["id", "user_id", "folder_id", "item_id", "item_type", "created_at", "status"];

    public $id;
    public $folder_id;
    public $item_id;
    public $item_type;
    public $item_title;
    public $item_content;
    public $item_created_at;
    public $created_at;
    public $status;



    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->folder_id = $args["folder_id"] ?? "";
        $this->item_id = $args["item_id"] ?? "";
        $this->item_type = $args["item_type"] ?? "";
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
        $this->status = $args["status"] ?? 1;
    }

    // public function getFolderContent($data_array) {
    //     // Escapar las variables para prevenir inyecciones SQL
    //     $folder_id = self::escape($data_array['folder_id']);
    //     $user_id = self::escape($data_array['user_id']);

    //     // Consulta para obtener notas y carpetas dentro del folder
    //     $query = "SELECT 
    //                 fr.id AS id,
    //                 fr.folder_id AS folder_id,
    //                 fr.created_at AS created_at,
    //                 n.id AS item_id,
    //                 'note' AS item_type,
    //                 n.title AS item_title,
    //                 n.content AS item_content,
    //                 n.created_at AS item_created_at
    //             FROM 
    //                 folder_relations fr
    //             JOIN 
    //                 notes n ON fr.item_id = n.id
    //             WHERE 
    //                 fr.folder_id = '$folder_id'
    //                 AND fr.user_id = '$user_id'
    //                 AND n.user_id = '$user_id'
    //                 AND fr.item_type = 'note'
    //                 AND n.status = 1

    //             UNION

    //             SELECT 
    //                 fr.id AS id,
    //                 fr.folder_id AS folder_id,
    //                 fr.created_at AS created_at,
    //                 f.id AS item_id,
    //                 'folder' AS item_type,
    //                 f.folder_name AS item_title,
    //                 NULL AS item_content,
    //                 f.created_at AS item_created_at
    //             FROM 
    //                 folder_relations fr
    //             JOIN 
    //                 folders f ON fr.item_id = f.id
    //             WHERE 
    //                 fr.folder_id = '$folder_id'
    //                 AND fr.user_id = '$user_id'
    //                 AND f.user_id = '$user_id'
    //                 AND fr.item_type = 'folder'
    //                 AND f.status = 1
    //     ";

    //     // Ejecutar la consulta
    //     $result = self::querySQL($query);

    //     // Retornar todos los resultados, no solo el primero
    //     return $result;
    // }

    public function getFolderContent($data_array){
        $query = "SELECT 
                fr.id AS id,
                fr.folder_id AS folder_id,
                fr.created_at AS created_at,
                n.id AS item_id,
                'note' AS item_type,
                n.title AS item_title,
                n.content AS item_content,
                n.created_at AS item_created_at,
                n.status AS status
            FROM 
                folder_relations fr
            JOIN 
                notes n ON fr.item_id = n.id
            WHERE 
                fr.folder_id = ?
                AND fr.user_id = ?
                AND n.user_id = ?
                AND fr.item_type = 'note'
                AND n.status != 0

            UNION

            SELECT 
                fr.id AS id,
                fr.folder_id AS folder_id,
                fr.created_at AS created_at,
                f.id AS item_id,
                'folder' AS item_type,
                f.folder_name AS item_title,
                NULL AS item_content,
                f.created_at AS item_created_at,
                f.status AS status
            FROM 
                folder_relations fr
            JOIN 
                folders f ON fr.item_id = f.id
            WHERE 
                fr.folder_id = ?
                AND fr.user_id = ?
                AND f.user_id = ?
                AND fr.item_type = 'folder'
                AND f.status != 0
        ";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("iiiiii", $data_array["folder_id"], $data_array["user_id"], $data_array["user_id"], $data_array["folder_id"], $data_array["user_id"], $data_array["user_id"]);

        try {
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    

    }

    // Método para escapar cadenas y prevenir inyección SQL (esto depende de tu implementación)
    private static function escape($value) {
        // Aquí puedes utilizar la función de escape de tu framework o base de datos (ej. mysqli_real_escape_string)
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public function createRelation($data_array){
        $query = "INSERT INTO folder_relations ( user_id, folder_id, item_id, item_type, created_at) VALUES 
        ('$data_array[user_id]', '$data_array[folder_id]', '$data_array[item_id]', '$data_array[item_type]', '$this->created_at')";
        $result = self::$db->query($query);

        return [
            'success' =>  $result,
            'id' => self::$db->insert_id
        ];
    }

    public function moveItem($data_array){
        $query = "UPDATE folder_relations SET folder_id = '$data_array[folder_id]' WHERE item_id = '$data_array[item_id]' AND item_type = '$data_array[item_type]' AND user_id = '$data_array[user_id]'";
        $result = self::$db->query($query);
        return $result;
    }

    // public function checkIfRelationExists($data_array){
    //     $query = "SELECT COUNT(*) FROM folder_relations WHERE item_id = '$data_array[folder_id]' AND item_type = '$data_array[item_type]' AND user_id = '$data_array[user_id]'";
    //     $result = self::$db->query($query);
    //     $data = $result->fetch_assoc();
    // }
    public function checkIfRelationExists($data_array){
        $query = "SELECT COUNT(*) FROM folder_relations WHERE item_id = $data_array[item_id] AND item_type = '$data_array[item_type]' AND user_id = $data_array[user_id]";
        $result = self::$db->query($query);
        $data = $result->fetch_assoc();
        return $data["COUNT(*)"];
    }

    public function checkIfExactRelationExists($data_array){
        $query = "SELECT COUNT(*) FROM folder_relations WHERE folder_id = '$data_array[folder_id]' AND item_id = '$data_array[item_id]' AND item_type = '$data_array[item_type]' AND user_id = '$data_array[user_id]'";
        $result = self::$db->query($query);
        $data = $result->fetch_assoc();
        return $data["COUNT(*)"];
    }

    public function moveToRoot($data_array){
        $query = "DELETE FROM folder_relations WHERE item_id = '$data_array[item_id]' AND item_type = '$data_array[item_type]' AND user_id = '$data_array[user_id]'";
        $result = self::$db->query($query);
        return $result;
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
