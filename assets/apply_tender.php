<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['user_name']) {
    $email = $_SESSION['email'];
    $admin = $_SESSION['user_name'];
    $rank = $_SESSION['rank'];
} else {
    header("Location: ./login.php");
}

include './assets/connection.php';

$check_user_exist = "SELECT * FROM BIDDER WHERE BIDDER_EMAIL = '$email'";
$bidder_details = mysqli_query($db, $check_user_exist);
$details = mysqli_fetch_assoc($bidder_details);
$bidder_id = $details['BIDDER_ID'];
// echo $bidder_id;


if (isset($_POST['apply'])) {


    $cover_letter = $_POST['cover-letter'];
    $bid_amount = $_POST['bid-amount'];
    $tender_id = $_POST['id_tender'];


    if ($cover_letter != '' && $bid_amount != '') {

        $confirm = "SELECT * FROM BIDDING WHERE BIDDING_TENDER_ID = $tender_id && BIDDING_BIDDER_ID = $bidder_id ";

        if (mysqli_num_rows(mysqli_query($db, $confirm)) > 0) {
            echo "<script>alert('You have already bid for this tender')</script>";
        } else {

            $query_to_bid = "INSERT INTO BIDDING(
            BIDDING_TOTAL_COST,
            BIDDING_DESC,
            BIDDING_TENDER_ID,
            BIDDING_BIDDER_ID)
            VALUES($bid_amount, '$cover_letter', $tender_id, $bidder_id)";

            $insert_into_bidding = mysqli_query($db, $query_to_bid);

            if ($insert_into_bidding) {
                echo "<script>alert('Successfully submitted')</script>";
            } else {
                echo "<script>alert('Some error occurred while submitting')</script>";
            }
        }
    }
}
