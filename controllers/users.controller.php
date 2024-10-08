<?php
require_once("../config/connect.php");
require_once("../models/Users.php");
require_once("../config/cookies.php");
$users = new users();

if (isset($_GET["cookies"])) {
    if (isset($_COOKIE[$cookie_uid])) {
        $username = $_COOKIE[$cookie_uid];
        $pwd= $_COOKIE[$cookie_pwd];
        $login = $users->login($username, $pwd, $cookie_uid, $cookie_pwd);
        if($login){header("location: ".$_GET["desired_url"]);}else{
     
            header("location: ../index?error=true");
        }
        exit;
    }
}

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]) {
    case 'login':
        $username = $data["user"];
        $pwd = $data["pwd"];
        $login = $users->login($username, $pwd, $cookie_uid, $cookie_pwd);

        if($login){echo json_encode("access_accepted");}
        break;
    case 'signup' :
        $email = htmlspecialchars($data["email"]);
        $pwd = $data["pwd"];
        $signup = $users->signup($email, $pwd);
        if($signup){
            $login = $users->login($email, $pwd, $cookie_uid, $cookie_pwd);
            if($login){echo json_encode("access_accepted");}
        }
        break;
    case 'getUserData' :
        include_once("../config/session.php");
        $user_data = $users->getUserData($userid);
        $response = [
            "id" => $user_data["id"],
            "name" => $user_data["name"],
            "email" => $user_data["email"]
        ];
        echo json_encode($response);
        break;
    case 'modifyUserData' :
        include_once("../config/session.php");
        $name = htmlspecialchars($data["name"]);
        $modify = $users->modifyUserData($name, $userid);
        if($modify){echo json_encode(true);}
        break;
    case 'logout' :
        include_once ("../config/cookies.php");
        deleteCookies($cookie_uid, $cookie_pwd);

        include_once ("../config/session.php");
        session_unset();
        session_destroy();
        echo json_encode(true);
        break;
    case 'sendPasswordResetCode' :
        $email = $data["email"];
        $sendPasswordResetCode = $users->sendPasswordResetCode($email);
        if($sendPasswordResetCode){echo json_encode($sendPasswordResetCode);}
        break;
    case 'validatePasswordResetCode' :
        $email = $data["email"];
        $code = $data["code"];
        $validatePasswordResetCode = $users->validatePasswordResetCode($email, $code);
        if($validatePasswordResetCode){echo json_encode($validatePasswordResetCode);}
        break;
    case 'updatePassword' :
        $email = $data["email"];
        $pwd = $data["password"];
        $code = $data["code"];
        $updatePassword = $users->updatePassword($email, $pwd, $code);
        if(!$updatePassword){echo json_encode(false); exit;}
        echo json_encode($updatePassword);
        break;
    default:
        # code...
        break;
}
 
