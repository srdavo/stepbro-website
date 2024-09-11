<?php
Class Settings extends Connect {
  
  public function saveSettings($userid, $data_array){
    $connect = parent::Conection();
    $sql = "UPDATE users_data 
      SET 
        store_name = ?, 
        admin_name = ?,
        contact_phone = ?,
        contact_email = ?,
        address_1 = ?,
        address_2 = ?,
        address_3 = ? 
      WHERE user_id = ?;
    ";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $data_array["store_name"], PDO::PARAM_STR);
    $stmt->bindParam(2, $data_array["store_owner_name"], PDO::PARAM_STR);
    $stmt->bindParam(3, $data_array["store_contact_phone"], PDO::PARAM_INT);
    $stmt->bindParam(4, $data_array["store_contact_email"], PDO::PARAM_STR);
    $stmt->bindParam(5, $data_array["store_address_1"], PDO::PARAM_STR);
    $stmt->bindParam(6, $data_array["store_address_2"], PDO::PARAM_STR);
    $stmt->bindParam(7, $data_array["store_address_3"], PDO::PARAM_STR);
    $stmt->bindParam(8, $userid, PDO::PARAM_INT);

    try {
      $stmt->execute();

      // sync result with the session data
      $_SESSION["additional_data"]["store_name"] = $data_array["store_name"];
      $_SESSION["additional_data"]["admin_name"] = $data_array["store_owner_name"];
      $_SESSION["additional_data"]["contact_phone"] = $data_array["store_contact_phone"];
      $_SESSION["additional_data"]["contact_email"] = $data_array["store_contact_email"];
      $_SESSION["additional_data"]["address_1"] = $data_array["store_address_1"];
      $_SESSION["additional_data"]["address_2"] = $data_array["store_address_2"];
      $_SESSION["additional_data"]["address_3"] = $data_array["store_address_3"];

        $response = [
          'success' => true,
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

  public function getSettings($userid){
    $connect = parent::Conection();
    $sql = "SELECT u.email, ud.* FROM users_data ud JOIN users u ON ud.user_id = u.id WHERE ud.user_id = ?;";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $userid, PDO::PARAM_INT);

    try {
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $response = [
        'success' => true,
        'data' => $result
      ];
      return $response;
    } catch (PDOException $e) {
      $response = [
        'success' => false,
        'message' => $e->getMessage()
      ];
      return $response;
    }
  }
  

  // public function getSettings($userid){
  //   $connect=parent::Conection();
  //   $sql = "SELECT *
  //     FROM users_data 
  //     WHERE user_id = ?;
  //   ";
  //   $stmt = $connect->prepare($sql);
  //   $stmt->bindParam(1, $userid, PDO::PARAM_INT);

  //   try {
  //     $stmt->execute();
  //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
  //     return $result;
  //   } catch (PDOException $e) {
  //     echo "Error: " . $e->getMessage();
  //     return false;
  //   }
  // }
}