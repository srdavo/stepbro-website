<?php
Class Notes extends Connect {
    public function createNote($userid, $data_array){
        $connect=parent::Conection();
        $sql = "INSERT INTO notes
            (user_id, content)
            VALUES (?, ?)
        ";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $userid, PDO::PARAM_INT);
        $stmt->bindParam(2, $data_array["content"], PDO::PARAM_STR);

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

    public function getNotes($userid, $data_array){
        $connect = parent::Conection();
        $sql = "SELECT * FROM notes
            WHERE user_id = ? ORDER BY id DESC LIMIT ? OFFSET ?
        ";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $userid, PDO::PARAM_INT);
        $stmt->bindParam(2, $data_array["limit"], PDO::PARAM_INT);
        $stmt->bindParam(3, $data_array["offset"], PDO::PARAM_INT);

        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $total_rows = $this->getTotalNotesRows($userid);
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
    private function getTotalNotesRows($userid){
        $connect = parent::Conection();
        $sql = "SELECT COUNT(*) as total_rows FROM notes WHERE user_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $userid, PDO::PARAM_INT);

        try {
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data["total_rows"];
        } catch (Exception $e) {
            return 0;
        }
    }
}