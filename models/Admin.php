<?php
Class Admin extends Connect {
    public function getUsers($data_array){
        $connect = parent::Conection();
        $sql = "SELECT * FROM users JOIN users_data ON users.id = users_data.user_id 
        ORDER BY users.id ASC LIMIT ${data_array['limit']} OFFSET ${data_array['offset']}"; 
        $stmt = $connect->prepare($sql);
        
        try{
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = [
                "success" => true,
                "data" => $data
            ];
            return $response;
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }
    public function getPageAccess($data_array){
        $connect = parent::Conection();
        $sql = "SELECT * FROM user_page_access 
            JOIN users ON user_page_access.user_id = users.id 
            JOIN users_data ON users.id = users_data.user_id 
            ORDER BY user_page_access.id DESC 
            LIMIT ${data_array['limit']} OFFSET ${data_array['offset']}"; 
        $stmt = $connect->prepare($sql);
        
        try{
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = [
                "success" => true,
                "data" => $data
            ];
            return $response;
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }
    public function getSuggestions($data_array){
        $connect = parent::Conection();
        $sql = "SELECT * FROM suggestions 
            JOIN users ON suggestions.user_id = users.id 
            JOIN users_data ON users.id = users_data.user_id 
            ORDER BY suggestions.id DESC 
            LIMIT ${data_array['limit']} OFFSET ${data_array['offset']}"; 
        $stmt = $connect->prepare($sql);
        
        try{
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = [
                "success" => true,
                "data" => $data
            ];
            return $response;
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }



    public function getTotalRows($tableName){
        $connect = parent::Conection();
        $sql = "SELECT COUNT(*) as total_rows FROM $tableName"; 
        $stmt = $connect->prepare($sql);
        
        try{
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data["total_rows"];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}