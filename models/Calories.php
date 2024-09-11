<?php
Class Calories extends Connect {
    public function registerCalories($userid, $data_array){
        $connect=parent::Conection();
        $sql = "INSERT INTO calories_log
            (user_id, calories, description, date, time)
            VALUES (?, ?, ?, ?, ?)
        ";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $userid, PDO::PARAM_INT);
        $stmt->bindParam(2, $data_array["calories"], PDO::PARAM_INT);
        $stmt->bindParam(3, $data_array["description"], PDO::PARAM_STR);
        $stmt->bindParam(4, $data_array["date"], PDO::PARAM_STR);
        $stmt->bindParam(5, $data_array["time"], PDO::PARAM_STR);

        try {
            $stmt->execute();
            $response = [
                'success' => true,
                'id' => $connect->lastInsertId()
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

    public function getCalories($userid, $data_array){
        $connect = parent::Conection();
        $sql = "SELECT * FROM calories_log
            WHERE user_id = ? ORDER BY date DESC, time ASC LIMIT ? OFFSET ?
        ";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $userid, PDO::PARAM_INT);
        $stmt->bindParam(2, $data_array["limit"], PDO::PARAM_INT);
        $stmt->bindParam(3, $data_array["offset"], PDO::PARAM_INT);

        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $total_rows = $this->getTotalCaloriesRows($userid);
            $response = [
                'success' => true,
                'data' => $data,
                'total_rows' => $total_rows,
                'limit' => $data_array["limit"],
                'offset' => $data_array["offset"]
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

    private function getTotalCaloriesRows($userid){
        $connect = parent::Conection();
        $sql = "SELECT COUNT(*) as total FROM calories_log WHERE user_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $userid, PDO::PARAM_INT);

        try {
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data["total"];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getTotalCalories($userid){
        date_default_timezone_set('America/Mazatlan');
        $date = date("Y-m-d");

        $connect = parent::Conection();
        $sql = "SELECT SUM(calories) as total FROM calories_log WHERE user_id = ? AND date = '$date'";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $userid, PDO::PARAM_INT);

        try {
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = [
                'success' => true,
                'data' => $data["total"],
                'date' => $date
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

    public function deleteCalorieLog($userid, $data_array){
        $connect = parent::Conection();
        $sql = "DELETE FROM calories_log WHERE user_id = ? AND id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $userid, PDO::PARAM_INT);
        $stmt->bindParam(2, $data_array["id"], PDO::PARAM_INT);

        try {
            $stmt->execute();
            $response = [
                'success' => true
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