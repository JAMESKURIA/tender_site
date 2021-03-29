<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['admin_name']) {
    $db = mysqli_connect("localhost", "root", "", "tenders");
    // Delete
    if (isset($_GET['delete'])) {
        $confirm = $_GET['delete'];

        if ($confirm) {

            $tender_id = $_GET['tender_id'];

            $bidding_tender_ids = mysqli_query($db, "SELECT BIDDING_ID FROM BIDDING WHERE BIDDING_TENDER_ID = $tender_id");
            $bidding_ids = mysqli_fetch_all($bidding_tender_ids, MYSQLI_ASSOC);

            foreach ($bidding_ids as $bidding_id) {
                $id = $bidding_id['BIDDING_ID'];
                $acc_bidding_ids = mysqli_query($db, "SELECT ACCEPTED_ID FROM ACCEPTED_BID WHERE ACCEPTED_BIDDING_ID = $id");
                $acc_ids =  mysqli_fetch_all($acc_bidding_ids, MYSQLI_ASSOC);

                foreach ($acc_ids as $acc_id) {
                    $accepted_id =  $acc_id['ACCEPTED_ID'];
                    $payment_accepted_ids = mysqli_query($db, "SELECT PAYMENT_ID FROM PAYMENTS WHERE PAYMENT_ACCEPTED_ID = $accepted_id");
                    $accepted_ids = mysqli_fetch_all($payment_accepted_ids, MYSQLI_ASSOC);

                    foreach ($accepted_ids as $accptd_id) {
                        $payment_id = $accptd_id['PAYMENT_ID'];

                        mysqli_query($db, "DELETE FROM PAYMENTS WHERE PAYMENT_ID = $payment_id");
                    }

                    mysqli_query($db, "DELETE FROM ACCEPTED_BID WHERE ACCEPTED_ID = $accepted_id");
                }

                mysqli_query($db, "DELETE FROM BIDDING WHERE BIDDING_ID = $id");
            }

            mysqli_query($db, "DELETE FROM TENDER WHERE TENDER_ID = $tender_id");
        }
        header("Location: ../manage_tenders.php?status=1");
    }

    // Update
    if (isset($_POST['update'])) {
        $tender_name = $_POST['tender-name'];
        $tender_number = $_POST['tender-number'];
        $closing_date = $_POST['closing-date'];
        $tender_desc = $_POST['tender-desc'];
        $tender_id = $_POST['id_tender'];

        $query = "UPDATE TENDER
        SET TENDER_NAME = '$tender_name',
            TENDER_NUMBER = '$tender_number',
            TENDER_DATE = '$closing_date',
            TENDER_DESC = '$tender_desc'
        WHERE TENDER_ID = '$tender_id'";

        if (mysqli_query($db, $query)) {
            echo "<script>alert('Successfully updated Tender')</script>";
        } else {
            echo "<script>alert('Error updating Tender')</script>";
        }
    }
} else {
    header("Location: ./login.php");
}
