<?php
include 'function.php';
session_start();
$_SESSION = [];

session_unset();
session_destroy();
// deleteSession();
setcookie('login', '', time() - 3600 );
// setcookie('true', '', time() - 3600 );


header("location:/event/index.php");
exit;
?>