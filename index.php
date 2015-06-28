<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Test - Index</title>
</head>
<body>

<h1> It works :D</h1>

<!-- <a href="./login">Login</a>   <a href="api/signup.php">Sign Up!</a><br> -->
<a href="tests/test.php">Test</a><br>
<a href="api/create_mysql.php">Create SQL</a><br>

<?php

require_once 'api/api.php';

$token  = uniqid(23);
//echo '<br>The Token is: ';
//echo $token."<br><br>";

$api = new login_api();
$session = new session_api();

$result = $api->login("Hallo", hash("sha256", "Hallo"));

echo "<br> <br> Hallo";

echo $result["stat"]."<br>";
$username = "Hallo";
echo $username."<br>";

if(!isset($_SESSION["username"])) exit;

if($session->check_login($username, $token)){
    echo "You have logged in ... at: " . $_SESSION["time"]."<br>";
}

?>


</body>
</html>