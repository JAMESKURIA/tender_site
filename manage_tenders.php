<?php

session_start();

if (isset($_SESSION['admin_name'])) {

    include './includes/header.php';
    include './assets/update_and_delete.php';

    $sql = "SELECT * FROM tender";
    $result = mysqli_query($db, $sql);

    $tenders = mysqli_fetch_all($result, MYSQLI_ASSOC);


    if (isset($_GET['status'])) {
        $status = $_GET['status'];

        if ($status == 1) {
            echo "<script>alert('Tender Deleted as successfully!')</script>";
        }
    }
} else {
    header("Location: ./login.php");
}

?>
<main>
    <section class="intro-section" style="height: 30vh;">
        <div class="intro-section-content">
            <h2>Power in your hands</h2>
            <div class="navigation">
                <h3><a href="./admin.php">Dashboard</a></h3>
                <i class="fas fa-chevron-right"></i>
                <h3>Manage Tenders</h3>
            </div>
        </div>
    </section>


    <section class="featured-tenders manage-tenders">
        <h1 style="margin-top: -2rem;">Manage Tenders</h1>
        <?php if (mysqli_num_rows($result) > 0) : foreach ($tenders as $tender) :  ?>
                <form method="POST" class="tender" action="./manage_tenders.php" enctype="multipart/form-data">
                    <div class="short-details">
                        <div class="tender-name">
                            <label for="tender-name">Tender name: &nbsp;</label>
                            <input name="tender-name" id="tender-name" type='text' value="<?php echo $tender["TENDER_NAME"]; ?>">
                        </div>
                        <div class="tender-number">
                            <label for="tender-number">Tender number: &nbsp;</label>
                            <input name="tender-number" id="tender-number" type='text' value="<?php echo $tender["TENDER_NUMBER"]; ?>">
                        </div>
                        <p class="closing-date">Closing Date: &nbsp;<span><input type="text" name="closing-date" value="<?php echo $tender['TENDER_DATE']; ?>"></span></p>
                    </div>
                    <div class="tender-description js-excerpt exerpt-hidden">
                        <h2>Description:</h2>
                        <textarea name="tender-desc" rows="10"><?php echo $tender["TENDER_DESC"]; ?></textarea>
                    </div>
                    <a role="button" class="show js-show-more">show more ...</a>
                    <input type="hidden" name="id_tender" value="<?php echo $tender['TENDER_ID'] ?>">
                    <div class="buttons">
                        <button type="submit" name="update">Update Tender</button>
                        <button type="button" onclick="confirm_delete()" class="bid-tender">Delete Tender </button>
                    </div>
                </form>
        <?php endforeach;
        else : echo "Oops! There are currently no Tenders to Display";
        endif; ?>

    </section>
</main>
<script>
    const confirm_delete = () => {
        if (confirm('Do you really want to delete this Tender?')) {
            window.location.href = "./assets/update_and_delete.php?delete=true&tender_id=<?php echo $tender['TENDER_ID'] ?>";
        }
    }
</script>
<script src="./scripts/show_more.js"></script>
</body>

</html>