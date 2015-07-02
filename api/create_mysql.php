<?php

    try {
        require_once (".".DIRECTORY_SEPARATOR."settings.php");
        require_once ("." . DIRECTORY_SEPARATOR . "api.php");

        $api = new api();
    } catch (Exception $e){
        echo $e->getTrace();
    }



    $table = DB_NAME;

    echo "Connecting ... <br>";

        $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, '',DB_PORT);

    echo "Connected .. <br>";
    if ($mysql->connect_error) {
        die($mysql->connect_error);
    }

    echo "Creating datatbase ... <br>";
    $mysql->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    echo "Database created <br>";

    echo "Filling with Tables <br>";
    $mysql->select_db($table);
$mysql->query("CREATE TABLE IF NOT EXISTS users(id INT NOT NULL AUTO_INCREMENT, username VARCHAR(16) NOT NULL, password VARCHAR(64) NOT NULL, token VARCHAR(23), time DATETIME, PRIMARY KEY(id))");
    echo "Finished ... <br>";

    echo 'Inserting User and getting up ... <br>';
    echo "\n";

try {
        print_r ($api->sign_up ("Hallo", hash ("sha256", "Hallo"), hash ("sha256", "Hallo")));
    $pass = hash("sha256", "Hallo");
    $api->query("INSERT INTO users(username, password) VALUES ('Hallo', $pass");
} catch (Exception $e) {
        echo $e->getTraceAsString();
        echo "\n at :".$e->getLine();
    }

echo "\n";
    echo 'User Hallo with Password Hallo inserted ...<br>';

    echo 'Created the SQL and made Tables ...<br> ';

    echo '<iframe src="../login"></iframe>';


    echo "\n";
    echo '<a href="../index.php">Go Back</a>';

