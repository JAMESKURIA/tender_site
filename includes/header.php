<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tender</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <?php
    if (isset($_SESSION['admin_name'])) {
        echo "<link rel='stylesheet' href='./styles/post_tender.css'>";
        echo "<link rel='stylesheet' href='./styles/login.css'>";
        echo "<link rel='stylesheet' href='./styles/index.css'>";
        echo "<link rel='stylesheet' href='./styles/commons.css'>";
        echo "<link rel='stylesheet' href='./styles/tenders.css'>";
        echo "<link rel='stylesheet' href='./styles/payments.css'>";
        echo "<link rel='stylesheet' href='./styles/manage_tenders.css'>";
    } else if (isset($_SESSION['user_name'])) {
        echo "<link rel='stylesheet' href='./styles/commons.css'>";
        echo "<link rel='stylesheet' href='./styles/login.css'>";
        echo "<link rel='stylesheet' href='./styles/index.css'>";
        echo "<link rel='stylesheet' href='./styles/tenders.css'>";
        echo "<link rel='stylesheet' href='./styles/bidder.css'>";
    } else {
        echo "<link rel='stylesheet' href='./styles/commons.css'>";
        echo "<link rel='stylesheet' href='./styles/login.css'>";
        echo "<link rel='stylesheet' href='./styles/index.css'>";
    }
    ?>

<body>
    <!-- Header -->
    <header>
        <h1 class="logo"><a href="./index.php">Tender</a></h1>
        <nav>
            <ul class="navlinks">
                <?php
                if (isset($_SESSION['user_name'])) {
                    echo "<li><a href='./bidder.php' class='links'>Dashboard</a></li>";
                } else if (isset($_SESSION['admin_name'])) {
                    // echo "<li><a href='./admin.php' class='links'>Home</a></li>";
                    echo "<li><a href='./admin.php' class='links'>Dashboard</a></li>";
                } else {
                    echo "<li><a href='./index.php' class='links'>Home</a></li>";
                }
                ?>
                <?php
                if (isset($_SESSION['admin_name'])) {
                    echo "<li><a href=' ./post_tender.php' class='links'>Post Tenders</a></li>";
                    echo "<li class='manage'><a href=' ./manage_tenders.php' class='links' style='background: none; border: none; box-shadow: none; font-weight: normal;'>Manage Tenders</a></li>";
                    echo "<li><a href=' ./payments.php' class='links'>Payments</a></li>";
                } else {
                    echo "<li><a href='./tenders.php' class='links'>Find Tenders</a></li>";
                }
                ?>

                <?php
                if (isset($_SESSION['user_name'])) {
                    echo "<li><a href=' ./logout.php' class='links'>Logout</a></li>";
                } else if (isset($_SESSION['admin_name'])) {
                    echo "<li><a href=' ./logout.php' class='links logout'>Logout</a></li>";
                } else {
                    echo "<li><a href='./login.php' class='links'>Login / Register</a></li>";
                }
                ?>

            </ul>
        </nav>
    </header>