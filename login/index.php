<?php
$result = $_GET["suc"];

if(!isset($result)){
    $result="true";
}

require_once '../api/api.php';
$api = new session_api();

if(isset($_SESSION["username"]) && $api->compare_unique_id($_SESSION["username"], $_SESSION["uuid"])){
    header("Location: ../");
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Test of my Login</title>
</head>
<body>

<form ONSUBMIT="return validate()" name="the_form" action="../api/login.php" method="post">
    <?php if($result == "false"){echo '<div>The username or password you entered was incorrect</div>';}?>
    <input name="username" type="text" maxlength="16" <?php if(!isset($_GET["user"])){echo 'autofocus=""';}?> placeholder="Username ..." id="username" value="<?php if(isset($_GET["user"])){echo $_GET["user"];}?>">
    <input name="password" type="password" placeholder="Password ..." id="password" <?php if(isset($_GET["user"])){echo 'autofocus=""';}?>>
    <input type="submit" value="Sign in">
</form>

<script type="text/javascript">



    function validate(){

        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if(username.length < 1){
            alert("Invalid Username (The username must have at least one character!)");
            return false;
        }

        if(password.length < 1){
            alert("Invalid Password (The password must have at least one character!)");
            return false;
        }

        return true;
    }

</script>

</body>
</html>
