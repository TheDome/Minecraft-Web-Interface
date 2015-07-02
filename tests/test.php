<?php
/**
 * @project Nitrado Interface*/

error_reporting(E_ALL);

//echo 'Init <br>';
require_once '../api/api.php';
$api = new api();
//echo 'Init finished! <br>';


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
</head>
<body>
<script src="../api/jquery-2.1.4.js"></script>

<script type="text/javascript">

    function showHint(str) {
        if (str.length != 8) {
            return
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                console.log(xmlhttp.responseText);
                if(xmlhttp.responseText == "1"){
                    document.getElementById("txtHint").innerHTML = reload(str);
                }else{
                    document.getElementById("txtHint").innerHTML = "Declinded";
                }
               //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            } else if (xmlhttp.readyState != 4){
                document.getElementById("txtHint").innerHTML = "! ! ! Connection failure ! ! !";
            }
        };
        xmlhttp.open("GET", "TOTP-Test.php?key="+str+"&seed=PEHM2SDNLXIOG65U", true);
        xmlhttp.send();
    }

    showHint("Hallo");

    function reload(str){
        window.setTimeout(showHint(str), 100);
        return "Accepted";
    }

</script>

<form action="">
    <label for="in"></label><input type="tel" onkeyup="showHint(this.value);" maxlength="8" id="in">
</form>

<p>Lifetime: <span id="txtHint">Declined</span></p>

</body>
</html>


