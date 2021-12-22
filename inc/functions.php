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

if (!function_exists('eticket_admin_registration')) {
    /**
     * @param $usersname
     * @param $email
     * @param $password
     * @return mixed|admin id
     */
    function eticket_admin_registration( $usersname, $email, $password)
    {
        $conn = eticket_get_var('conn');
        $password = md5($password);
        $sql = "INSERT INTO " . BUS_BOOKING_TBL_USERS . " (user_name, email_address, password) VALUES ('$usersname', '$email','$password')";

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

if (!function_exists('eticket_get_user')) {
    /**
     * Return User data from username or user ID
     *
     * @param $username_or_id
     * @return false
     */
    function eticket_get_user($username_or_id = '')
    {

        $conn = eticket_get_var('conn');
        $username_or_id = empty($username_or_id) ? eticket_current_user_id() : $username_or_id;

        if (is_numeric($username_or_id)) {
            $sql = "SELECT * FROM " . BUS_BOOKING_TBL_USERS . " WHERE `id` = '$username_or_id' LIMIT 1";
        } else {
            $sql = "SELECT * FROM " . BUS_BOOKING_TBL_USERS . " WHERE `user_name` = '$username_or_id' LIMIT 1";
        }

        if (!$result = $conn->query($sql)) {
            return false;
        }

        return $result->fetch_assoc();
    }
}

if (!function_exists('eticket_get_users')) {
    /**
     * Return User data from username
     *
     * @return array
     */
    function eticket_get_users()
    {

        $conn = eticket_get_var('conn');
        $sql = "SELECT * FROM " . BUS_BOOKING_TBL_USERS . " WHERE 1";
        $users = array();

        if (!$result = $conn->query($sql)) {
            return array();
        }

        while ($user = $result->fetch_assoc()) {
            $users[] = $user;
        }

        return $users;
    }
}

function eticket_is_user_administrator($user_id_user_name = '')
{
    $user_id_user_name = empty($user_id_user_name) ? eticket_current_user_id() : $user_id_user_name;
    $user_role = eticket_get_var('user_role', eticket_get_user($user_id_user_name));

    return $user_role == 'administrator';
}

if (!function_exists('eticket_get_user_row')) {
    /**
     * Return HTML for an user row
     *
     * @param $user_id
     * @return false|string
     */
    function eticket_get_user_row($user_id)
    {
        $user = eticket_get_user($user_id);
        $current_user = eticket_get_user(eticket_current_user_id());

        ob_start();
        ?>
        <td><?php echo $user_id; ?> <span class="d-none user-name"
                                          data-user-name="<?php echo eticket_get_var('user_name', $user); ?>"></span></td>
        <td><?php echo ucwords(eticket_get_var('first_name', $user)) . ' ' . ucwords(eticket_get_var('last_name', $user)); ?></td>
        <td><?php echo eticket_get_var('user_name', $user); ?></td>
        <td><?php echo eticket_get_var('email_address', $user); ?></td>
        <td><?php echo ucwords(eticket_get_var('user_role', $user)); ?></td>
        <td><?php echo ucwords(eticket_get_var('status', $user)); ?></td>
        <td>
            <button type="button" class="btn btn-primary btn-sm view-user-data" data-bs-toggle="modal" data-bs-target="#showViewWindow">View</button>

            <?php if ($user_id != eticket_current_user_id() && eticket_get_var('user_role', $current_user) == 'administrator') : ?>

                <?php if (eticket_get_var('status', $user) == 'pending') : ?>
                    <a href="" class="btn btn-success btn-sm empm-update-user-status" data-status-target="active">Activate</a>
                    <a href="" class="btn btn-warning btn-sm empm-update-user-status" data-status-target="deactive">Deactivate</a>
                <?php elseif (eticket_get_var('status', $user) == 'active') : ?>
                    <a href="" class="btn btn-warning btn-sm empm-update-user-status" data-status-target="deactive">Deactivate</a>
                <?php elseif (eticket_get_var('status', $user) == 'deactive') : ?>
                    <a href="" class="btn btn-success btn-sm empm-update-user-status" data-status-target="active">Activate</a>
                <?php endif; ?>
            <?php endif; ?>
            <button type="button" class="btn btn-secondary btn-sm edit-user-data" data-bs-toggle="modal" data-bs-target="#showEditWindow">Edit
            </button>
        </td>
        <?php
        return ob_get_clean();
    }
}

function eticket_add_bus($busname,$bus_number,$bus_condition,$route,$start_time,$end_time,$total_seat,$date,$status){
    $conn = eticket_get_var('conn');
    $sql_add_bus = "INSERT INTO " . BUS_BOOKING_SCHEDULE_LIST . " (bus_name,bus_number,bus_condition,route,start_time,end_time,total_seat,date,status)
     VALUES('$busname','$bus_number','$bus_condition','$route','$start_time','$end_time','$total_seat','$date','$status')";

    if(!$conn->query($sql_add_bus)){
        return false;
    }
}