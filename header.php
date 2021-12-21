<?php
/**
 * Header Template
 */

include './inc/functions.php';
include './inc/config.php';


// Login check
$curr_script_name = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
$curr_script_name = explode('/', $curr_script_name);
$exclude_pages = array('login.php', 'register.php');

if (empty(eticket_current_user_id()) && !in_array(end($curr_script_name), $exclude_pages)) {
    header('Location: login.php');
}


// Sign out handling
if (eticket_get_var('logout', $_GET) === 'true') {

    // Remove cookie data
    setcookie('user_logged_in', '');

    // Redirect to login page
    header('Location: login.php');
}

$current_user_id = eticket_current_user_id();
$current_user = eticket_get_user($current_user_id);
$current_user_name = eticket_get_var('user_name', $current_user);
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Online Ticketing Application</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="theme-color" content="#7952b3">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.1/examples/dashboard/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<!--    <link rel="stylesheet" href="/resources/demos/style.css">-->

    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
<?php if (!in_array('login.php', $curr_script_name) && !in_array('register.php', $curr_script_name)) : ?>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-capitalize" href="#">Online Ticketing Application</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="dropdown me-3">
        <a class="btn btn-secondary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $current_user_name; ?>
        </a>

        <ul class="dropdown-menu">
            <li><a class="nav-link px-3" href="?logout=true">Sign out</a></li>
        </ul>
    </div>
</header>
<?php endif;