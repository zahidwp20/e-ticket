<?php
/**
 * Receive all ajax request here
 */

include './inc/functions.php';
include './inc/config.php';

$action = eticket_get_var('action', $_POST);

if ($action == 'empm_update_user_status') {

    $response = array();
    $conn = eticket_get_var('conn');
    $user_id = eticket_get_var('user_id', $_POST);
    $status_target = eticket_get_var('status_target', $_POST);
    $sql = "UPDATE " . BUS_BOOKING_TBL_USERS . " SET status = '" . $status_target . "' WHERE id = $user_id";

    if (!$conn->query($sql)) {
        $response['status'] = false;
        $response['message'] = 'Something went wrong!';
        die();
    }

    $response['status'] = true;
    $response['message'] = eticket_get_user_row($user_id);

    echo json_encode($response);
    die();
}