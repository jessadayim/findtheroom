<?php

session_start();
$attribute = @$_SESSION['_symfony2']['attributes'];
$getUser = $attribute['username'];
$getUserID = $getUser['id'];
$getPathDashboard = $attribute['urlDashBoard'];
$getPathLogout = $attribute['urlLogout'];

if (empty($getUser) || empty($getUserID)) {
    header("Location: $getPathDashboard");
    exit();
}
?>