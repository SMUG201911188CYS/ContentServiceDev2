<?php
session_start();
$_SESSION['id'] = NULL;
$_SESSION['password'] = NULL;
$prevPage = $_SERVER['HTTP_REFERER'];
echo "<script>alert('로그아웃');</script>";
echo "<script>location.replace('$prevPage')</script>";

include("./writeLog.php");

exit();
?>
