<?php
@E_DEPRECATED;
//TODO: Rework

require_once 'api.php';
$api = new api();

$user = $_POST["username"];
$pass = hash("sha256", $_POST["password"]);
$pass2 = hash("sha256", $_POST["password2"]);


$api->sign_up($user, $pass, $pass2);
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Signup - Reloading</title>
</head>
<body>
<!-- TODO: Use ajax -->
<script src="/api/jquery-2.1.4.js"></script>
<script type="text/javascript">
    /*   $.ajax({
     url:"login.php",
     method: "post",
     }"login.php", {username: <?php echo $user;?>, password: <?php echo $_POST["password"];?>})
     */</script>
</body>
</html>