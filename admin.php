<?php
if (!isset($_SESSION)) {
    session_start();

    if (isset($_SESSION['admin_name'])) {
        $user = $_SESSION['admin_name'];
        $email = $_SESSION['email'];
        $id = $_SESSION['admin_id'];
    } else {
        header("Location: ./login.php");
    }
}

include './assets/connection.php';



$user_bids = mysqli_query($db, "SELECT * FROM BIDDING");
$bids = mysqli_fetch_all($user_bids, MYSQLI_ASSOC);

// var_dump($bids);
if (isset($_GET['accepted_id'])) {
    $accepted_id = $_GET['accepted_id'];
    // echo "Accepted:" . $_GET['accepted_id'];

    $query = mysqli_query($db, "SELECT * FROM ACCEPTED_BID WHERE ACCEPTED_BIDDING_ID = $accepted_id ");
    $numrows = mysqli_num_rows($query);

    if (!$numrows > 0) {
        mysqli_query($db, "INSERT INTO ACCEPTED_BID(ACCEPTED_BIDDING_ID) VALUES($accepted_id)");
    } else {
        echo "<script>alert('You already approved this bid')</script>";
    }
}


$accepted_bids = mysqli_query($db, "SELECT * FROM ACCEPTED_BID");
$acc_bids = mysqli_fetch_all($accepted_bids, MYSQLI_ASSOC);

// var_dump($acc_bids);

if (isset($_POST['pay'])) {
    $pay_amount = $_POST['pay_amount'];
    $pay_ref = $_POST['pay_ref'];
    $pay_mode = $_POST['pay_mode'];
    $pay_accepted_id = $_POST['pay_acc_id'];


    $sql = mysqli_query($db, "SELECT * FROM PAYMENTS WHERE PAYMENT_ACCEPTED_ID = $pay_accepted_id ");
    $rows = mysqli_num_rows($sql);

    if (!$rows > 0) {
        mysqli_query($db, "INSERT INTO PAYMENTS(
                PAYMENT_AMOUNT,
                PAYMENT_REF,
                PAYMENT_MODE,
                PAYMENT_ACCEPTED_ID) VALUES($pay_amount, '$pay_ref', '$pay_mode', $pay_accepted_id)");
    } else {
        echo "<script>alert('You already paid for this bid')</script>";
    }
}
$paid_bids_query = mysqli_query($db, "SELECT * FROM PAYMENTS");
$paid_bids = mysqli_fetch_all($paid_bids_query, MYSQLI_ASSOC);

include './includes/header.php';
?>

<main>
    <section class="intro-section" style="height: 30vh;">
        <div class="intro-section-content">
            <h2>Positivity all through</h2>
            <div class="navigation">
                <h3><a href="./admin.php">Dashboard</a>
            </div>
        </div>
    </section>

    <p style="margin-top: 2rem; font-size:large; margin-left: 2rem;">welcome <span style="color: var(--primary-color);"><?php echo $user;  ?></span></p>
    <!-- Biddings section -->
    <section class="biddings-section" style="margin-top: -2rem;">
        <h1>Present Biddings</h1>
        <table class="biddings-table">
            <thead>
                <tr>
                    <th>BIDDING_ID</th>
                    <th>AMOUNT_BID</th>
                    <th>DESCRIPTION</th>
                    <th>TENDER_NO</th>
                    <th>BIDDING_DATE</th>
                    <th>BIDDER_ID</th>
                    <th>APPROVE</th>
                </tr>
            </thead>
            <tbody class="present_bids_body">
                <?php if (mysqli_num_rows($user_bids) > 0) : foreach ($bids as $bid) :  ?>
                        <tr>

                            <td><?php echo $bid['BIDDING_ID'] ?></td>
                            <td><?php echo $bid['BIDDING_TOTAL_COST'] ?></td>
                            <td class="desc"><?php echo $bid['BIDDING_DESC'] ?></td>

                            <?php
                            $t_id = $bid['BIDDING_TENDER_ID'];
                            $tender_number = mysqli_query($db, "SELECT TENDER_NUMBER FROM TENDER WHERE TENDER_ID = $t_id");
                            $number = mysqli_fetch_assoc($tender_number);
                            $t_number = $number['TENDER_NUMBER'];
                            ?>
                            <td><?php echo $t_number ?></td>
                            <td><?php echo $bid['BIDDING_DATE'] ?></td>
                            <td><?php echo  $bid['BIDDING_BIDDER_ID'] ?></td>
                            <td class="btn btn-approved"><button>approve</button></td>
                        </tr>
                <?php endforeach;
                else : echo "<tr><td colspan='7'>There are currently no bids to show</td></tr>";
                endif; ?>
        </table>
    </section>

    <!-- Accepted Biddings section -->
    <section class="biddings-section">
        <h1>Accepted Biddings</h1>
        <table class="accepted-biddings-table">
            <thead>
                <tr>
                    <th>ACCEPTED_ID</th>
                    <th>TENDER_NUMBER</th>
                    <th>ACCEPTED_BIDDING_ID</th>
                    <!-- <th>ACCEPTED_TENDER</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($accepted_bids) > 0) : foreach ($acc_bids as $acc_bid) :  ?>
                        <tr>

                            <?php
                            $acc_bidding_id = $acc_bid['ACCEPTED_BIDDING_ID'];
                            $bidding_tender_id = mysqli_query($db, "SELECT BIDDING_TENDER_ID FROM BIDDING WHERE BIDDING_ID = $acc_bidding_id");
                            $tender_id = mysqli_fetch_assoc($bidding_tender_id);
                            $t_id = $tender_id['BIDDING_TENDER_ID'];

                            $tender_number = mysqli_query($db, "SELECT TENDER_NUMBER FROM TENDER WHERE TENDER_ID = $t_id");
                            $number = mysqli_fetch_assoc($tender_number);
                            $t_number = $number['TENDER_NUMBER'];
                            ?>
                            <td><?php echo $acc_bid['ACCEPTED_ID'] ?></td>
                            <td><?php echo $t_number ?></td>
                            <td><?php echo $acc_bidding_id ?></td>
                        </tr>
                <?php endforeach;
                else : echo "<tr><td colspan='3'>You have not approved any bids yet</td></tr>";
                endif; ?>
            </tbody>
        </table>
    </section>

    <!-- Payments section -->
    <section class="biddings-section">
        <h1>Payments made</h1>
        <table class="accepted-biddings-table">
            <thead>
                <tr>
                    <th>PAYMENT_ID</th>
                    <th>PAYMENT_AMOUNT</th>
                    <th>PAYMENT_DATE</th>
                    <th>PAYMENT_REF</th>
                    <th>PAYMENT_MODE</th>
                    <th>PAYMENT_ACCEPTED_ID</th>
                </tr>
            </thead>
            <tbody class="acc_bids_body">
                <?php if (mysqli_num_rows($paid_bids_query) > 0) : foreach ($paid_bids as $paid_bid) :  ?>
                        <tr>
                            <td><?php echo $paid_bid['PAYMENT_ID'] ?></td>
                            <td><?php echo $paid_bid['PAYMENT_AMOUNT'] ?></td>
                            <td><?php echo $paid_bid['PAYMENT_DATE'] ?></td>
                            <td><?php echo $paid_bid['PAYMENT_REF'] ?></td>
                            <td><?php echo $paid_bid['PAYMENT_MODE'] ?></td>
                            <td><?php echo $paid_bid['PAYMENT_ACCEPTED_ID'] ?></td>
                        </tr>
                <?php endforeach;
                else : echo "<tr><td colspan='6'>You have not paid any bids yet</td></tr>";
                endif; ?>
            </tbody>
        </table>
    </section>

    <script>
        const present_bids_body = document.querySelector('.present_bids_body');
        const rows = Array.from(present_bids_body.rows);

        rows.forEach((row) => {
            const len = row.children.length - 1;
            const btn = row.children[len];
            const accepted_id = row.children[0].textContent;

            btn.firstChild.addEventListener('click', () => {
                btn.firstChild.classList.add('btn-approved');
                console.log("Button clicked");
                window.location.href = ` ./admin.php?accepted_id= ${accepted_id}`;
            })
        })
    </script>
    </body>

    </html>