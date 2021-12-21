<?php
session_start();
const BUS_BOOKING_DB_NAME = "bus_booking";
const BUS_BOOKING_TBL_USERS = "bus_users";
const BUS_BOOKING_SCHEDULE_LIST = "bus_schedule";
const BUS_BOOKING_TICKET_lIST = "bus_ticket";
const BUS_BOOKING_SELECT_SEAT = "select_bus_seat";
const BUS_BOOKING_ADMIN_EMAIL = "admin@gmail.com";
const BUS_BOOKING_ADMIN_USERNAME = "admin";
const BUS_BOOKING_ADMIN_PASSWORD = "12345";

//Create Database 
$conn = new mysqli("localhost","root","");
$_SESSION['conn'] = $conn;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Create database
if (!mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS " . BUS_BOOKING_DB_NAME)) {
    die("Error creating database: " . mysqli_error($conn));
}
// Select Database
if (!mysqli_select_db($conn, BUS_BOOKING_DB_NAME)) {
    die("Error selecting database");
}
//Create table 'users'
$sql_create_tbl_users = "CREATE TABLE IF NOT EXISTS " . BUS_BOOKING_TBL_USERS . " (
        `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `first_name` VARCHAR(255),
        `last_name` VARCHAR(255),
        `user_name` VARCHAR(255) UNIQUE NOT NULL,
        `email_address` VARCHAR(255) UNIQUE NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `phone_number` VARCHAR(255),
        `date_of_birth` VARCHAR(255),
        `gender` VARCHAR(255),
        `status` VARCHAR(255) DEFAULT 'pending',
        `user_role` VARCHAR(255) DEFAULT 'employee',
        `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
if (!$conn->query($sql_create_tbl_users)) {
    die("Error creating table: " . $conn->error);
}
//Create table 'bus schedule' 
$sql_create_bus_schedule = "CREATE TABLE IF NOT EXISTS " . BUS_BOOKING_SCHEDULE_LIST . " (
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `bus_name` VARCHAR(250) NOT NULL,
    `bus_number` VARCHAR(50) NOT NULL,
    `bus_condition` VARCHAR(50) NOT NULL,
    `holiday` VARCHAR(50) NOT NULL,
    `route` VARCHAR(50) NOT NULL,
    `start_time` VARCHAR(50) NOT NULL,
    `end_time` VARCHAR(50) NOT NULL,
    `date` VARCHAR(50) NOT NULL,
    `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1 = active',
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if (!$conn->query($sql_create_bus_schedule)) {
die("Error creating table: " . $conn->error);
}
//Create table 'ticket' 
$sql_create_bus_ticket = "CREATE TABLE IF NOT EXISTS " . BUS_BOOKING_TICKET_lIST . " (
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `ticket_name` VARCHAR(250) NOT NULL,
    `ticket_time` VARCHAR(50) NOT NULL,
    `prize` VARCHAR(50) NOT NULL,
    `customer_name` VARCHAR(50) NOT NULL,
    `customer_phone` VARCHAR(50) NOT NULL,
    `customer_email` VARCHAR(50) NOT NULL,
    `customer_gender` VARCHAR(50) NOT NULL,
    `customer_date_of_birth` VARCHAR(50) NOT NULL,
    `bus_name` VARCHAR(50) NOT NULL,
    `seat_number` VARCHAR(250) NOT NULL,
    `route` VARCHAR(50) NOT NULL,
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if (!$conn->query($sql_create_bus_ticket)) {
die("Error creating table: " . $conn->error);
}
//Create table 'select seat' 
$sql_create_bus_select_seat = "CREATE TABLE IF NOT EXISTS " . BUS_BOOKING_SELECT_SEAT . " (
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `bus_name` VARCHAR(50) NOT NULL,
    `A1` VARCHAR(11) NOT NULL,
    `B2` VARCHAR(11) NOT NULL,
    `C3` VARCHAR(11) NOT NULL,
    `D4` VARCHAR(11) NOT NULL,
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if (!$conn->query($sql_create_bus_select_seat)) {
die("Error creating table: " . $conn->error);
}

// Create a default admin user if no admin user is created
if (!eticket_get_user(BUS_BOOKING_ADMIN_USERNAME)) {
    $user_id = eticket_admin_registration(BUS_BOOKING_ADMIN_USERNAME, BUS_BOOKING_ADMIN_EMAIL, BUS_BOOKING_ADMIN_PASSWORD);

    if ($user_id) {
        $sql = "UPDATE " . BUS_BOOKING_TBL_USERS . " SET user_role = 'administrator', status = 'active' WHERE id = $user_id";
        $conn->query($sql);
    }
}