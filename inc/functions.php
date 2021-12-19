<?php
/**
 * All functions here
 */


if (!function_exists('eticket_get_var')) {
    /**
     * Return var from anywhere
     *
     * @param $key
     * @param $args
     *
     * @return mixed|string
     */
    function eticket_get_var($key, $args = array())
    {

        if (empty($args)) {
            $args = $_SESSION;
        }

        return isset($args[$key]) ? $args[$key] : '';
    }
}

if (!function_exists('eticket_user_registration')) {
    /**
     * @param $firstname
     * @param $lastname
     * @param $usersname
     * @param $email
     * @param $password
     * @param $phone
     * @return mixed
     */
    function eticket_user_registration($firstname, $lastname, $usersname, $email, $password, $phone)
    {
        $conn = eticket_get_var('conn');
        $password = md5($password);
        $sql = "INSERT INTO " . BUS_BOOKING_TBL_USERS . " (first_name,last_name,user_name, email_address, password,phone_number) VALUES ('$firstname', '$lastname', '$usersname', '$email','$password','$phone')";

        if (!$conn->query($sql)) {
            return $conn->error;
        }

        return $conn->insert_id;
    }
}

//login function
if (!function_exists("eticket_login")) {
    /**
     * @param $un
     * @param $pw
     * @return false
     */

    function eticket_login($un, $pw)
    {
        $conn = eticket_get_var('conn');
        $password = md5($pw);
        $sql_ticket_login = "SELECT (id) FROM " . BUS_BOOKING_TBL_USERS . " WHERE `user_name`= '$un' AND `password` = '$password' LIMIT 1";

        if (!$result = $conn->query($sql_ticket_login)) {
            return false;
        }
        $user_data = $result->fetch_assoc();
        if (is_array($user_data) && isset($user_data['id'])) {
            return $user_data['id'];
        }
        return false;
    }
    
}

if (!function_exists('eticket_current_user_id')) {
    /**
     * If any user logged in then return that user ID, if no return false
     *
     * @return mixed|string
     */
    function eticket_current_user_id()
    {
        return eticket_get_var('user_logged_in', $_COOKIE);
    }
}