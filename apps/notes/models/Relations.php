<?php
class Relations extends ActiveRecord{
    protected static $table = 'folder_relations';
    protected static $columns = ["id", "user_id", "folder_id", "item_id", "item_type", "created_at"];

    public $id;
    public $folder_id;
    public $item_id;
    public $item_type;
    public $item_title;
    public $item_content;
    public $item_created_at;
    public $created_at;



    public function __construct($args = []) {
        $this->id = $args["id"] ?? NULL;
        $this->user_id = $args["user_id"] ?? "";
        $this->folder_id = $args["folder_id"] ?? "";
        $this->item_id = $args["item_id"] ?? "";
        $this->item_type = $args["item_type"] ?? "";
        $this->created_at = $args["created_at"] ?? date('Y-m-d H:i:s');
    }

    // Método para obtener el contenido de una carpeta
    public function getFolderContent($data_array) {
        // Escapar las variables para prevenir inyecciones SQL
        $folder_id = self::escape($data_array['folder_id']);
        $user_id = self::escape($data_array['user_id']);

        // Consulta para obtener notas y carpetas dentro del folder
        $query = "SELECT 
                    fr.id AS id,
                    fr.folder_id AS folder_id,
                    fr.created_at AS created_at,
                    n.id AS item_id,
                    'note' AS item_type,
                    n.title AS item_title,
                    n.content AS item_content,
                    n.created_at AS item_created_at
                FROM 
                    folder_relations fr
                JOIN 
                    notes n ON fr.item_id = n.id
                WHERE 
                    fr.folder_id = '$folder_id'
                    AND fr.user_id = '$user_id'
                    AND n.user_id = '$user_id'
                    AND fr.item_type = 'note'

                UNION

                SELECT 
                    fr.id AS id,
                    fr.folder_id AS folder_id,
                    fr.created_at AS created_at,
                    f.id AS item_id,
                    'folder' AS item_type,
                    f.folder_name AS item_title,
                    NULL AS item_content,
                    f.created_at AS item_created_at
                FROM 
                    folder_relations fr
                JOIN 
                    folders f ON fr.item_id = f.id
                WHERE 
                    fr.folder_id = '$folder_id'
                    AND fr.user_id = '$user_id'
                    AND f.user_id = '$user_id'
                    AND fr.item_type = 'folder'";

        // Ejecutar la consulta
        $result = self::querySQL($query);

        // Retornar todos los resultados, no solo el primero
        return $result;
    }

    // Método para escapar cadenas y prevenir inyección SQL (esto depende de tu implementación)
    private static function escape($value) {
        // Aquí puedes utilizar la función de escape de tu framework o base de datos (ej. mysqli_real_escape_string)
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
