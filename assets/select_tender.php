<?php
include './assets/connection.php';

$sql = "SELECT * FROM tender";
$result = mysqli_query($db, $sql);

$tenders = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET['tender_id'])) {
    $id = $_GET['tender_id'];

    $query = "SELECT * FROM TENDER WHERE TENDER_ID = $id";
    $run = mysqli_query($db, $query);

    $file = mysqli_fetch_assoc($run);
    $file_path = './uploads/' . $file['TENDER_FILE'];
    $file_name = basename($file_path);

    // echo $file_name;

    if (file_exists($file_path)) {
        header('Cache-Control: must-revalidate');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='. $file_name);
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');    
        header('Pragma: no-cache');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);

    } else {
        echo "Oops! Files cannot be found";
    }
}
