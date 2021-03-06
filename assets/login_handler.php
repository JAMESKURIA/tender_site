<?php

if (!isset($_SESSION)) {
    session_start();
}

$db = mysqli_connect("localhost", "root", "", "tenders");

if (isset($_POST["login"])) {

    if (!empty($_POST['login_email']) && !empty($_POST['login_password'])) {

        $login_email = $_POST['login_email'];
        $login_password = $_POST['login_password'];
       
        $query = mysqli_query($db, "SELECT * FROM LOGIN WHERE LOGIN_EMAIL = '$login_email' AND LOGIN_PASSWORD = '$login_password' ");
        $numrows = mysqli_num_rows($query);

        if ($numrows != 0) {

            while ($login = mysqli_fetch_assoc($query)) {
                $dblogin_email = $login['LOGIN_EMAIL'];
                $dblogin_password = $login['LOGIN_PASSWORD'];
                $dbrank = $login['LOGIN_RANK'];
            }

            if ($login_email == $dblogin_email && $login_password == $dblogin_password) {

                if ($dbrank == 'admin') {
                    $select_admin = mysqli_query($db, "SELECT * FROM ADMINISTRATOR WHERE ADMIN_EMAIL = '$login_email'");
                    $admin_names = mysqli_fetch_assoc($select_admin);
                    $admin_name = $admin_names['ADMIN_FNAME'];

                    $check_admin_exist = "SELECT * FROM ADMINISTRATOR WHERE ADMIN_EMAIL = '$email'";
                    $admin_details = mysqli_query($db, $check_admin_exist);
                    $details = mysqli_fetch_assoc($admin_details);
                    $admin_id = $details['ADMIN_ID'];
                    // echo $admin_id;

                    // echo $admin_name;
                    $_SESSION['rank'] = $dbrank;
                    $_SESSION['admin_name'] = $admin_name;
                    $_SESSION['email'] = $dblogin_email;
                    $_SESSION['admin_id'] = $admin_id;
                    

                    header("Location: ./admin.php");
                } else if ($dbrank == 'bidder') {
                    $select_user = mysqli_query($db, "SELECT * FROM BIDDER WHERE BIDDER_EMAIL = '$login_email'");
                    $usernames = mysqli_fetch_assoc($select_user);
                    $user_name = $usernames['BIDDER_FNAME'];

                    $check_user_exist = "SELECT * FROM BIDDER WHERE BIDDER_EMAIL = '$email'";
                    $bidder_details = mysqli_query($db, $check_user_exist);
                    $details = mysqli_fetch_assoc($bidder_details);
                    $bidder_id = $details['BIDDER_ID'];
                    // echo $bidder_id;


                    // echo $user_name;
                    $_SESSION['rank'] = $dbrank;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['email'] = $dblogin_email;
                    $_SESSION['bidder_id'] = $bidder_id;

                    header("Location: ./tenders.php");
                }
            }
        } else {
            $message = "Invalid credentials !";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
        echo "All fields are required!";
    }
}
