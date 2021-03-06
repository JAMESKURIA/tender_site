<?php
include './assets/connection.php';

if (isset($_POST['post-tender-button'])) {
    $file = $_FILES['file'];
    $file_name = $_FILES["file"]["name"];
    $size = $_FILES['file']['size'];
    $type = $_FILES['file']['type'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];


    if (isset($file_name)) {
        if (!empty($file_name)) {

            $location = './admin/uploads/';
            $upload =  move_uploaded_file($tmp_name, $location . $file_name);
        }
    }

    $tender_name = $_POST['name'];
    $tender_number = $_POST['number'];
    $closing_date = $_POST['date'];
    $tender_description = $_POST['description'];

    $tender_number = strtoupper($tender_number);

    if ($upload) {

        $check = "SELECT * FROM TENDER WHERE TENDER_NUMBER = '$tender_number'";

        $check_tender = mysqli_query($db, $check);

        if (mysqli_num_rows($check_tender) > 0) {
            $message = "Tender already in the database";
            echo "<script>alert('$message')</script>";
        } else {

            $sql = "INSERT INTO TENDER(TENDER_NAME,
                                TENDER_NUMBER,
                                TENDER_FILE,
                                TENDER_DESC,
                                TENDER_DATE)
                                VALUES('$tender_name', '$tender_number', '$file_name', '$tender_description', '$closing_date')";

            if (mysqli_query($db, $sql)) {
                $message = 'Successfully addded Tender to database';
                echo "<script>alert('$message')</script>";
            } else {
                $message = 'Some error occured while adding tender to database';
                echo "<script>alert('$message')</script>";
            }
        }
    }
}
