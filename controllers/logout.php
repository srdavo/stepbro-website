<?php
include_once ("../config/cookies.php");
deleteCookies($cookie_uid, $cookie_pwd);

include_once ("../config/session.php");
session_unset();
session_destroy();
header ("location: ../index");
exit();
?>