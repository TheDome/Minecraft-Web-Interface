<?php

namespace api\api_libs;


class session_api
{

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
        return api::getInstance();
    }

    /**
     * This function returns the UUID of a user
     * @param $username string The Username
     * @return boolean
     */
    public function get_unique_id($username)
    {

        return $this->getAPI()->get_sql()->query("select token from users where username = '$username'");

    }

}