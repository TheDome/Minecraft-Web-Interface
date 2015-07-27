<?php

/*
 *
 * Ths file may be a bit unuseful but . . . It does the Session Management...
 *
 *
 */
session_start();
require_once './api.php';
$api = new login_api();
$username = $_POST["username"];
$pass = $_POST["password"];
$password = hash("sha256", $pass);
if(!isset($username) || !isset($pass)){
    echo 'Please insert Username and Password';
}
$result = $api->login($username, $password);
if($result["stat"] == "suc"){
    $_SESSION["username"] = $username;
    $_SESSION["token"] = $result["uuid"];
    $_SESSION["time"] = $result["time"];

    echo(json_encode(array("username" => $username, "uuid" => $result["uuid"])));
} else {
    echo(json_encode(false));
}


