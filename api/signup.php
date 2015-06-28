<?php

require_once 'api.php';
$api = new api_main();

$user = $_POST["username"];
$pass = hash("sha256", $_POST["password"]);



$api->sign_up($user, $pass);
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Signup - Reloading</title>
</head>
<body>
<script src="../post.js"></script>
<script type="text/javascript">
    submit("login.php", {username: <?php echo $user;?>, password: <?php echo $_POST["password"];?>})
</script>
</body>
</html>