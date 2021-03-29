<?php 

session_start();
if (isset($_SESSION['user_name'])) {
    unset($_SESSION['bidder_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['email']);

    header("location: ./index.php");
}
else{
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_name']);
    unset($_SESSION['email']);

    header("location: ./login.php");
}
session_destroy();
