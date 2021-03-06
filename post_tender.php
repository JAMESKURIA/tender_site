<?php

session_start();
// require('./assets/login_handler.php');

if (isset($_SESSION['admin_name'])) {
    $user = $_SESSION['admin_name'];
    $email = $_SESSION['email'];
    $id = $_SESSION['admin_id'];
} else {
    header("Location: ./login.php");
}

echo 

include './includes/header.php';
include './assets/insert_tender.php';

?>
<main>

    <section class="intro-section">
        <div class="intro-section-content">
            <h2>Post a Tender</h2>
            <div class="navigation">
                <h3><a href="./index.php">Home</a></h3>
                <i class="fas fa-chevron-right"></i>
                <h3>Post Tender</h3>
            </div>
        </div>
    </section>

    <!-- Post Tender Section -->
    <form form action="./post_tender.php" method="POST" enctype="multipart/form-data" class="post-section">
        <h1>Get Your Project Done</h1>
        <h2>Post tender and start receiving proposals</h2>

        <div class="inputs">
            <div class="name">
                <label for="name">Tender name: </label>
                <input type="text" name="name" id="name" placeholder="e.g. General Ledger Accountant" required>
            </div>
            <div class="number">
                <label for="number">Tender Number: </label>
                <input type="text" name="number" id="number" placeholder="e.g. BSCHD8934" required>
            </div>
            <div class="date">
                <label for="date">Closing Date: </label>
                <input type="date" name="date" id="date" required>
            </div>
            <div class="description">
                <label for="description">Description: </label>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Provide a more detailed description to help you get more proposals" required></textarea>
            </div>
        </div>

        <div class="upload-section">
            <input type="file" name="file" id="file" required>
            <!-- <button>+ Upload Files</button>
            <p>Drag & Drop any image/documents that might be helpful in explaining your project</p> -->
        </div>

        <button type="submit" id="post-tender-button" name="post-tender-button">Post Tender</button>
    </form>
</main>
</body>

</html>