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

$user_bid_ids  = mysqli_query($db, "SELECT BIDDING_ID FROM BIDDING WHERE BIDDING_BIDDER_ID = $id");
$bid_ids = mysqli_fetch_all($user_bid_ids, MYSQLI_ASSOC);
// var_dump($bid_ids);




include './includes/header.php';
?>

<!-- Main section -->
<main>
    <section class="intro-section" style="height: 30vh;">
        <div class="intro-section-content">
            <h2>Positivity all through</h2>
            <div class="navigation">
                <h3><a href="./bidder.php">Dashboard</a>
            </div>
        </div>
    </section>

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
                    <th>APPROVED?</th>
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
                            <?php
                            $bidd_id = $bid['BIDDING_ID'];

                            $check = mysqli_query($db, "SELECT * FROM ACCEPTED_BID WHERE ACCEPTED_BIDDING_ID = $bidd_id");
                            $num_rows = mysqli_num_rows($check);
                            if ($num_rows > 0) {
                                $approved = 'approved';
                            } else {
                                $approved = 'pending';
                            }
                            ?>
                            <td class="approved"><?php echo $approved;?></td>
                        </tr>
                <?php endforeach;
                else : echo "<tr><td colspan='4'>Bid More for your Tenders to appear here</td></tr>";
                endif; ?>
        </table>
    </section>
</main>
<script>
    const approveds = document.querySelectorAll(".approved");
    approveds.forEach((approved) => {
        if (approved.textContent.toLowerCase() == 'pending') {
            approved.style.backgroundColor = '#f1c40f';
        }else{
            approved.style.backgroundColor = 'green';
            approved.style.color = '#fff';
        }
    });
</script>

</body>

</html>