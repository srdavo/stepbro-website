<?php
require_once 'config.php';
$cookie_uid = $_ENV["SESSION_NAME"]."-uid";
$cookie_pwd = $_ENV["SESSION_NAME"]."-pwd";

function cookiesRedirect($cookie_uid){
  if (isset($_COOKIE[$cookie_uid])) {
    if(!isset($_SESSION["id"])){
      header("location: controllers/users.controller.php?cookies");
    }
  }
}

function deleteCookies($cookie_uid, $cookie_pwd) {
  if (isset($_COOKIE[$cookie_uid])) {
    unset($_COOKIE[$cookie_uid]);
    unset($_COOKIE[$cookie_pwd]);
    setcookie($cookie_uid, null, -1, '/');
    setcookie($cookie_pwd, null, -1, '/');
  }
}


?>