<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="Interface: Server <?php echo $_SERVER["SERVER_ADDR"]; ?>">
    <title>Interface: Server <?php echo $_SERVER["SERVER_ADDR"]; ?></title>
</head>

<?php
session_start();
if (!isset ($_SESSION["username"])) { ?>

    <form onsubmit="return validateForm()" name="form1">
        <input type="text" name="username" maxlength="16" placeholder="Username ..." required>
        <input type="password" name="password" placeholder="Password ..." required>
        <button type="submit">Log In</button>
    </form>

    <script src="api/libs/jquery-2.1.4.js"></script>
    <script type="text/javascript">


        function validateForm() {
            var username = document.forms["form1"]["username"].value;
            var password = document.forms["form1"]["password"].value;

            if (password == null || password == "") {
                alert("Password has to be filled out");
                return false;
            }

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("POST", "/api/login.php", true);
            xmlhttp.send();

            return false;
        }


    </script>
<?php } ?>
</html>