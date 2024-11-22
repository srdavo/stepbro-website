<?php
Class Admin extends Connect {
    public function getUsers($data_array){
        $connect = parent::Conection();
        $sql = "SELECT * FROM users JOIN users_data ON users.id = users_data.user_id"; 
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
}