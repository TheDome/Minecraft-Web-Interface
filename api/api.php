<?php
/**
 * @project Nitrado Interface
 */
require_once 'settings.php';

/**
 * Class api
 */
class api
{

    /**
     * The function to send querys to the SQL Server.
     * @param $query string The Query, sending to the SQL Server
     *
     * @return bool|mysqli_result The result of the query
     */
    public static function query($query)
    {
        return self::get_sql()->query($query);
    }

    /**
     * The Main fuction to get The MYSQL server
     * @return mysqli
     */
    public static function get_sql()
    {

        $mysql = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

        // $mysql->query("alter table users change token token varchar(" . 23 + strlen(UUID_PREFIX) . ")");

        if ($mysql->connect_error) {
            die($mysql->connect_error);
        }

        mysqli_close($mysql);
        return $mysql;

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
            return array("stat" => "fail", "reason" => "The two passwords aren't same");
        }

        $sql = $this->get_sql();
        mysqli_real_escape_string($sql, $username);
        $result = $this->get_sql()->query("select id from users where username = '$username'")->num_rows;

        if ($result) {
            return array("stat" => "fail", "reason" => "Username already exists");
        } else {
            $sql->query("INSERT INTO users(username, password) VALUES ('" . $username . "','" . $password . "')");

            return array("stat" => "suc");
        }

    }
}

/**
 * Class login_api
 */
class login_api{

    /**
     * The function to log in to the System
     * @param string $username The is the Username of the person
     * @param string $password THe is the Password of the person
     * @return array An array with the sucess in the <code>stat => suc</code> method and the <code>uuid => uuid</code> and the <code>time => time</code> from the log in if it is sucsess, else <code>stat => nosuc</code>
     */
    public function login($username, $password)
    {


        $result = $this->getAPI()->get_sql()->query("select count(*) from users where username = '$username' and password = '$password'");

        $uuid = uniqid(23);

        if ($result) {


            $this->getAPI()->get_sql()->query("update users set token = '$uuid', time = CURRENT_TIMESTAMP where username = '$username' ");
            $time = $this->getAPI()->get_sql()->query("select time from users where username = '$username'");
            return array("stat" => "suc", "uuid" => $uuid, "time" => $time);
        } else {
            return array("stat" => "nosuc");
        }


    }

    /**
     * @return api
     */
    private function getAPI()
    {
        return new api();
    }

    /** Log the User out
     * @param string $username The Username of the User
     */
    public function logout($username){

        $this->getAPI()->get_sql()->query("update users set token and time = null where username = '$username'");
    }

}

/**
 * The session API, managing the Session Settings
 */
class session_api {

    /**
     *  Checks if the User is logged in.
     * @param $username string The Username
     * @param $token string The token
     * @return bool
     */
    //TODO: Finish!
    public function check_login($username, $token)
    {
        $date = new DateTime(); //TODO finish
        return $this->compare_unique_id($username, $token);
    }

    /**
     * This function is useless. it Compares the uuid with the SQL Database
     * @param $username string The Username
     * @param $uuid string The token to Compare
     * @return bool
     */
    public function compare_unique_id($username, $uuid)
    {
        $uuid_server = $this->getAPI()->get_sql()->query("select token from users where username = '$username'");

        return $uuid_server == $uuid;
    }

    /**
     * @return api The main API
     */
    private function getAPI()
    {
        return new api();
    }

    /**
     * This function returns the UUID of a user
     * @param $username string The Username
     * @return bool|mysqli_result
     */
    public function get_unique_id($username){

        return $this->getAPI()->get_sql()->query("select token from users where username = '$username'");

    }

}



