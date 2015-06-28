<?php

/*
 *
 * Ths file may be a bit unuseful but . . . It does the Session Management...
 *
 *
 */
echo 'Hello ... <br>';
session_start();
require_once './api.php';
$api = new login_api();
echo ' Api Loaded .... <br>';

$username = $_POST["username"];
$pass = $_POST["password"];
$password = hash("sha256", $pass);

echo 'Password hashed ... <br>';

if(!isset($username) || !isset($pass)){
    session_destroy();
    header('Location: ../login/?suc=false&user=' . $username);
}
echo 'Trying logging in ... <br>';
$result = $api->login($username, $password);
echo 'result is :' . var_dump($result);

if($result["stat"] == "suc"){
    $_SESSION["username"] = $username;
    $_SESSION["token"] = $result["uuid"];
    $_SESSION["time"] = $result["time"];
    header("Location: ../index.php");
} else {
    session_destroy();
    header("Location: ../login/?suc=false");
}


