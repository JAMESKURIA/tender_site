<?php
if (!isset($_SESSION)) {
    session_start();
}
include './assets/connection.php';

if (isset($_SESSION['admin_name'])) {
    $user = $_SESSION['admin_name'];
    $email = $_SESSION['email'];
    $id = $_SESSION['admin_id'];
} else {
    header("Location: ../login.php");
}

$user_bids = mysqli_query($db, "SELECT * FROM BIDDING");
$bids = mysqli_fetch_all($user_bids, MYSQLI_ASSOC);

// var_dump($bids);

include './includes/header.php';
?>


<div class="biddings-section">
    <h1>Make payments</h1>
    <table>
        <thead>
            <tr>
                <th>PAYMENT_AMOUNT</th>
                <th>PAYMENT_REF</th>
                <th>PAYMENT_MODE</th>
                <th>PAYMENT_ACCEPTED_ID</th>
                <th>PAY NOW</th>
            </tr>
        </thead>
        <tbody>
            <tr class="payment-inputs">
                <form method="POST" enctype="multipart/form-data" action="./admin.php">
                    <td><input type="number" name="pay_amount" placeholder="e.g. 450000" required></td>
                    <td><input type="text" name="pay_ref" required placeholder="e.g. XFMHSS75S"></td>
                    <td><input type="text" name="pay_mode" required placeholder="e.g.MPESA"></td>
                    <td><input type="number" name="pay_acc_id" placeholder="e.g. 2" required></td>
                    <td><button type="submit" name="pay">Pay now</button></td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
