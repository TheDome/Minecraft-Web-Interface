<?php

    try {
        require_once (".".DIRECTORY_SEPARATOR."settings.php");
        require_once ("." . DIRECTORY_SEPARATOR . "api.php");

        $api = new api_main();
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
    $length = strlen(UUID_PREFIX) + 23;
    $mysql->select_db($table);
    $mysql->query("create table if not exists users(id int NOT NULL AUTO_INCREMENT, username VARCHAR(16) NOT NULL, password VARCHAR(64) NOT NULL, token VARCHAR($length), time datetime, PRIMARY KEY(id))");
    echo "Finished ... <br>";

    echo 'Inserting User and getting up ... <br>';
    echo "\n";

//    try {
        print_r ($api->sign_up ("Hallo", hash ("sha256", "Hallo"), hash ("sha256", "Hallo")));
//        $api->query ('INSERT INTO users(username, password) VALUES (Hollo, ' . hash ("sha256", "Hallo") . ')');
/*    }catch(Exception $e){
        echo $e->getTraceAsString();
        echo "\n at :".$e->getLine();
    }
*/
    echo "\n";
    echo 'User Hallo with Password Hallo inserted ...<br>';

    echo 'Created the SQL and made Tables ...<br> ';

    echo '<iframe src="../login"></iframe>';


    echo "\n";
    echo '<a href="../index.php">Go Back</a>';

