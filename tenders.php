<?php
if (!isset($_SESSION)) {
    session_start();
}
$db = mysqli_connect("localhost", "root", "", "tenders");
// require('./assets/login_handler.php');

if ($_SESSION['user_name']) {
    $user = $_SESSION['user_name'];
    $email = $_SESSION['email'];

    $check_user_exist = "SELECT * FROM BIDDER WHERE BIDDER_EMAIL = '$email'";
    $bidder_details = mysqli_query($db, $check_user_exist);
    $details = mysqli_fetch_assoc($bidder_details);
    $bidder_id = $details['BIDDER_ID'];
    // echo $bidder_id;

    $_SESSION['bidder_id'] = $bidder_id;

    $id = $_SESSION['bidder_id'];
} else {
    header("Location: ./login.php");
}

include './includes/header.php';
include './assets/select_tender.php';
include './assets/apply_tender.php'

?>

<!-- Main section -->
<main class="tenders-page">
    <section class="intro-section">
        <div class="intro-section-content">
            <h2>Browse for Tenders</h2>
            <div class="navigation">
                <h3><a href="./bidder.php">Dashboard</a></h3>
                <i class="fas fa-chevron-right"></i>
                <h3>Find Tender</h3>
            </div>
        </div>
    </section>

    <!-- Featured tenders -->
    <p style="margin-top: 2rem; font-size:large; margin-left: 2rem;">welcome <span style="color: var(--primary-color);"><?php echo $user;  ?></span></p>
    <section class="featured-tenders">
        <!-- welcome <?php echo $user;  ?> -->
        <h1 style="margin-top: -2rem;">Featured Tenders</h1>
        <?php if (mysqli_num_rows($result) > 0) : foreach ($tenders as $tender) :  ?>
                <form method="POST" class="tender" action="./tenders.php" enctype="multipart/form-data">
                    <div class="short-details">
                        <h3 class="tender-name"><?php echo $tender["TENDER_NAME"]; ?></h3>
                        <h3 class="tender-number">Tender number <span><?php echo $tender["TENDER_NUMBER"]; ?></span></h3>
                        <!-- <h4 class="owner">Posted by <span>Michael Bronson</span></h4> -->
                        <p class="closing-date">Closing Date: <span><?php echo $tender['TENDER_DATE']; ?></span><span></span></p>
                    </div>
                    <div class="tender-description js-excerpt exerpt-hidden">
                        <h2>Description:</h2>
                        <p id="p"><?php echo nl2br($tender["TENDER_DESC"]); ?></p>
                        <textarea name="cover-letter" id="cover-letter" placeholder="Write a cover letter bidding for this tender" required></textarea>
                        <div class="bid-amount">
                            <label for="bid-amount">Bid amount: </label>
                            <input type="number" name="bid-amount" id="bid-amount" placeholder="250000" required>
                        </div>
                    </div>
                    <a role="button" class="show js-show-more">show more ...</a>
                    <input type="hidden" name="id_tender" value="<?php echo $tender['TENDER_ID'] ?>">
                    <div class="buttons">
                        <button onclick="window.location.href='./tenders.php?tender_id=<?php echo $tender['TENDER_ID'] ?>' ">Download files</button>
                        <button type="submit" name="apply" class="bid-tender">Apply Tender</button>
                    </div>
                </form>
        <?php endforeach;
        else : echo "Oops! There are currently no Tenders to Display";
        endif; ?>

    </section>
</main>
<script src="./scripts/show_more.js"></script>
</body>

</html>