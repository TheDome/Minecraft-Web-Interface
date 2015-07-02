<?php
    /**
     * @project Nitrado Interface*/

    error_reporting(E_ALL);


    try{
        $root = "..".DIRECTORY_SEPARATOR.dirname(__FILE__).DIRECTORY_SEPARATOR;
        require_once '../api/api.php';

    }catch(exception $e) {
        echo $e->getMessage ();
        echo "At File: " . $e->getFile () . ":" . $e->getLine ();
        echo "Trace: " . $e->getTrace ();
    }


/*
    $api = new api();
    $logon_ergebnis = $api->get_sql()->query("select count(*) from users where username = 'Hallo'");

    $userObj = mysql_fetch_object($logon_ergebnis);

    $DOMAIN=$userObj->domain;
    $USER=$userObj->user;
    $base32SECRET=$userObj->encodedsecret;
    $PERIOD=$userObj->period;
    $DIGITS=$userObj->digits;
    $ALGORITHM=$userObj->algorithm;
    $MY_SITE_NAME=$DOMAIN.":".$USER."";

    $base32SECRET=str_replace("=", "", $base32SECRET);
    $QRTEXT="otpauth://totp/".$MY_SITE_NAME."?secret=".$base32SECRET."&period=".$PERIOD."&digits=".$DIGITS."&algorithm=".$ALGORITHM;
*/

    $secret = "PEHM2SDNLXIOG65U";
    $algo = "sha256";
    //$period = 15;


    $wralgo = strtoupper($algo);



    ?>

    <!DOCTYPE html>
    <html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>My Test OTPAuth Site</title>
    </head>
    <body>

    <script src="/api/jquery-2.1.4.js"></script>
    <script type="text/javascript">

        function getOTP(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
            };

            var period = 30;
            xmlhttp.open("GET", "otpgen.php?sec=<?php echo $secret; ?>&algo=<?php echo $algo; ?>&per="+period);
            xmlhttp.send();

            window.setTimeout(getOTP, 500);
        }

        getOTP();

    </script>

    <span id="txtHint">Hallo</span>



    </body>
    </html>