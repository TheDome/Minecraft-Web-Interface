<?php
/**
 * Created by PhpStorm.
 * User: Dominic
 * Date: 30.08.2015
 * Time: 18:55
 */

namespace api\api_libs;

require_once $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.php';
require_once $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'api_libs' . DIRECTORY_SEPARATOR . "api.php";

class login_api
{

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
            return ["stat" => "suc", "uuid" => $uuid, "time" => $time];
        } else {
            return ["stat" => "nosuc"];
        }


    }

    /**
     * @return api
     */
    private function getAPI()
    {
        return \api\api_libs\api::getInstance();
    }

    /** Log the User out
     * @param string $username The Username of the User
     */
    public function logout($username)
    {

        $this->getAPI()->get_sql()->query("update users set token and time = null where username = '$username'");
    }

}