<?php
/**
 * @project Nitrado Interface
 */

    $key = $_GET["key"];
    $seed = $_GET["seed"];

    require_once '../api/totp.php';

    $res = Google2FA::verify_key($seed, $key);



        echo $res;

