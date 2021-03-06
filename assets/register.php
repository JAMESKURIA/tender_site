<?php
// if(!isset($_SESSION)){
//     session_start();
// }
include './assets/connection.php';

// REGISTER USER

if (isset($_POST['reg'])) {


    // receive all input values from the register form
    $first_name = $_POST['f_name'];
    $last_name = $_POST['l_name'];
    $register_email = $_POST['register_email'];
    $register_password = $_POST['register_password'];
    $register_phone = $_POST['phone_number'];
    $register_address = $_POST['address'];

    if ($register_email != '' || $first_name != '' || $last_name != '' || $register_password != '' || $register_phone != '' || $register_address != '') {
        $query = "INSERT INTO BIDDER(
            BIDDER_FNAME,
            BIDDER_LNAME,
            BIDDER_EMAIL,
            BIDDER_PHONE_NO,
            BIDDER_ADDRESS)
            VALUES('$first_name', '$last_name', '$register_email', '$register_phone', '$register_address')";

        $insert_into_bidder = mysqli_query($db, $query);

        if ($insert_into_bidder) {
            $login_id = $db->insert_id;

            $login = "INSERT INTO LOGIN(
                LOGIN_EMAIL,
                LOGIN_PASSWORD,
                LOGIN_RANK,
                LOGIN_BIDDER_ID)
                VALUES('$register_email', '$register_password', 'bidder', $login_id)";


            $check = "SELECT * FROM LOGIN WHERE LOGIN_EMAIL = '$register_email'";

            $check_user = mysqli_query($db, $check);

            if (mysqli_num_rows($check_user) > 0) {
                $err_message = "user already exists ! ";

                echo "<script type='text/javascript'>alert('$err_message');</script>";
            } else {
                $insert_into_login = mysqli_query($db, $login);

                if ($insert_into_login) {
                    echo "<script>alert('Registration successful! You can now login')</script>";
                } else {
                    echo "<script>alert('Registration not successful!')</script>";
                }
            }
        }
    }
}
