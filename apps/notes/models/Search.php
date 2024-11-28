<?php
class Search extends ActiveRecord{
    // public static function getSearch($data_array) {
    //     $search = '%' . $data_array["search"] . '%';
    //     $user_id = $data_array["user_id"];
    //     $sql = "SELECT * FROM notes WHERE user_id = :user_id AND (content LIKE :search)";
        
    //     try {
    //         $stmt = self::$db->prepare($sql);
    //         $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    //         $stmt->bindParam(":search", $search, PDO::PARAM_STR);
    //         $stmt->execute();
    //         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    //         return [
    //             "success" => true,
    //             "data" => $result
    //         ];
    //     } catch (PDOException $e) {
    //         return [
    //             "success" => false,
    //             "error" => $e->getMessage()
    //         ];
    //     }
    // }

    public static function getSearch($data_array) {
        $search = '%' . $data_array["search"] . '%';
        $user_id = $data_array["user_id"];
        $sql = "SELECT * FROM notes WHERE user_id = ? AND status = 1 AND (content LIKE ?)";
        
        try {
            $stmt = self::$db->prepare($sql);
            if (!$stmt) {
                throw new Exception(self::$db->error);
            }
            
            $stmt->bind_param("is", $user_id, $search);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
            return [
                "success" => true,
                "data" => $result
            ];
        } catch (Exception $e) {
            return [
                "success" => false,
                "error" => $e->getMessage()
            ];
        }
    }
    
}