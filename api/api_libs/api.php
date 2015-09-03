<?php

namespace api\api_libs;

require_once $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.php';

/**
 * Class api
 * @package api\main_api
 */
class api
{

    /**
     * The function to send querys to the SQL Server.
     * @param $query string The Query, sending to the SQL Server
     *
     * @return bool|\mysqli_result The result of the query
     */
    public static function query($query)
    {
        return self::get_sql()->query($query);
    }

    /**
     * The Main fuction to get The MYSQL server
     * @return \mysqli
     */
    public static function get_sql()
    {

        $mysql = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

        // $mysql->query("alter table users change token token varchar(" . 23 + strlen(UUID_PREFIX) . ")");

        if ($mysql->connect_error) {
            die($mysql->connect_error);
        }

        return $mysql;

    }

    /**
     * @return api Get The API Instance
     */
    public static function getInstance()
    {
        return new api();
    }

    /**
     * @return $this
     */
    public function getAPI()
    {
        return $this;
    }

    /**The Method to sign a User Up returns an array with stat => suc else stat => fail and the reason => with the reason.
     * The <code>Reason</code> can be parsed.
     *
     * @param string $username The Username to Sign In
     * @param string $password The Password, that the User has entered
     * @param string $password2 The 2nd password, the User entered
     *
     * @return array An array of the success declared in <code>stat</code> and if fails the reason declared in <code>reason</code>
     */
    public function sign_up($username, $password, $password2)
    {

        if ($password != $password2) {
            return ["stat" => "fail", "reason" => "The two passwords aren't same"];
        }

        $sql = $this->get_sql();
        mysqli_real_escape_string($sql, $username);
        $result = $this->get_sql()->query("select id from users where username = '$username'")->num_rows;

        if ($result) {
            return ["stat" => "fail", "reason" => "Username already exists"];
        } else {
            $sql->query("INSERT INTO users(username, password) VALUES ('" . $username . "','" . $password . "')");

            return ["stat" => "suc"];
        }

    }
}


