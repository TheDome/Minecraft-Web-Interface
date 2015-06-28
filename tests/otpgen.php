<?php
/**
 * @project Nitrado Interface
 */

    include_once "../api/ototp.php";
    include_once '../api/phpqrcode.php';

    $secret = $_GET["sec"];
    $algo = $_GET["algo"];
    $period = $_GET["per"];


    ?>
    <!DOCTYPE html >
    <html >
    <head lang = "" >
        <meta charset = "" >
        <meta http-equiv="refresh" content="5">
        <title > </title >
    </head >
    <body >
        <?php

            /*$InitalizationKey = $secret;					// Set the inital key

            $TimeStamp	  = Google2FA::get_timestamp($period);
            $secretkey 	  = Google2FA::base32_decode($InitalizationKey);	// Decode it into binary
            $otp       	  = Google2FA::oath_hotp($secretkey, $TimeStamp, $algo);



            $trim = 15;
            $exact_time = microtime(true)+$trim;

            $str_time_to_expire = $exact_time/$period;
            $array_time_to_expire= explode(".", $str_time_to_expire);
            $erg_time_to_expire="0.".$array_time_to_expire[1];
            $time_to_expire=$period-floor($erg_time_to_expire*$period);

            $otp = oauth_totp($secret, floor($exact_time/$period), 8, $algo );

            echo("<br><br><br><hr>");
            echo("<span style='text-align:center'>One time password: $otp </span><br>");
            echo("<span style='text-align:center'>Time to expire: $time_to_expire </span><br>");
            echo("<hr>");
            */

            $digits=8;
            $algorithm=$algo;
            $period= $period;
            // Initial Settings - Seed
            $MY_SECRET=$secret;
            // Initial Settings - Trim Time
            $trim=15;
            // Determine the time window
            $time_window = $period;
            //echo "TimeWindow:".$time_window."<br>";
            // Get the exact time from the server
            $exact_time = microtime(true)+$trim;
            //echo "exact_time:".$exact_time".<br>";
            // Round the time down to the time window
            $rounded_time = floor($exact_time/$time_window);
            //echo "rounded time:".$rounded_time."<br>";
            // Seconds until key expires
            $str_time_to_expire = $exact_time/$time_window;
            $array_time_to_expire= explode(".", $str_time_to_expire);
            $erg_time_to_expire="0.".$array_time_to_expire[1];
            $time_to_expire=$time_window-floor($erg_time_to_expire*$time_window);
            // Generate TOTP
            $totp_generated=oauth_totp($MY_SECRET, $rounded_time, $digits, $algorithm);
            echo '<h1>'.$totp_generated."</h1>";
            echo "time to expire: ".$time_to_expire."s";

            // Use this to verify a key as it allows for some time drift.
            $QRTEXT="otpauth://totp/tresor.inc?secret=$secret&period=$period&digits=8&algorithm=".strtoupper($algo);

           // echo QRcode::png($QRTEXT, "tmp".DIRECTORY_SEPARATOR."img.png");
            echo QRcode::png("https://www.dropbox.com/s/1r642l42llbpjjr/Nitrado%20Interface.zip?dl=0", "tmp".DIRECTORY_SEPARATOR."img.png");
        ?>
        <h1> look ... <img src="tmp/img.png"></h1>
    </body >
    </html >