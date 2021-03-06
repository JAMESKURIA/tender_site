<?php
if (!isset($_SESSION)) {
    session_start();
}
include './assets/connection.php';

if ($_SESSION['user_name']) {
    $user = $_SESSION['user_name'];
    $email = $_SESSION['email'];
    $id = $_SESSION['bidder_id'];
} else {
    header("Location: ./login.php");
}

$user_bids = mysqli_query($db, "SELECT * FROM BIDDING WHERE BIDDING_BIDDER_ID = $id");
$bids = mysqli_fetch_all($user_bids, MYSQLI_ASSOC);

// var_dump($bids);

include './includes/header.php';
?>

<!-- Main section -->
<main>
    <!-- Biddings section -->
    <section class="biddings-section">
        <h1>Present Biddings</h1>
        <table class="biddings-table">
            <thead>
                <tr>
                    <th>TENDER_NUMBER</th>
                    <th>BIDDING_DESCRIPTION</th>
                    <th>BIDDING_AMOUNT</th>
                    <th>BIDDING_DATE</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($user_bids) > 0) : foreach ($bids as $bid) :  ?>
                        <tr>
                            <?php
                            $t_id = $bid['BIDDING_TENDER_ID'];
                            $tender_number = mysqli_query($db, "SELECT TENDER_NUMBER FROM TENDER WHERE TENDER_ID = $t_id");
                            $number = mysqli_fetch_assoc($tender_number);
                            $t_number = $number['TENDER_NUMBER'];
                            ?>
                            <td><?php echo $t_number; ?></td>
                            <td class="desc"><?php echo $bid['BIDDING_DESC'] ?></td>
                            <td><?php echo $bid['BIDDING_TOTAL_COST'] ?></td>
                            <td><?php echo $bid['BIDDING_DATE'] ?></td>
                        </tr>
                <?php endforeach;
                else : echo "Bid More for your Tenders to appear here";
                endif; ?>
        </table>
    </section>
</main>

</body>

</html>