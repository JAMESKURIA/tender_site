<?php

$db = mysqli_connect("localhost", "root", "", "tenders");

$insert_admin = "INSERT INTO ADMINISTRATOR(
	ADMIN_FNAME,
	ADMIN_LNAME,
	ADMIN_EMAIL,
	ADMIN_MOBILE)
	VALUES('Pretty', 'admin', 'prettyadmin@gmail.com', 0700292286)";

$query = mysqli_query($db, $insert_admin);

if ($query) {
    echo "Succesfully added to the administrator table" . "<br/>";
}

if ($query) {
    $admin_id = $db->insert_id;

    $insert_admin_login = "INSERT INTO LOGIN(
        LOGIN_EMAIL,
        LOGIN_PASSWORD,
        LOGIN_RANK,
        LOGIN_ADMIN_ID)
        VALUES('prettyadmin@gmail.com','seed', 'admin', '$admin_id')";

    $sql = mysqli_query($db, $insert_admin_login);

    if ($sql) {
        echo "Succesfully added to the login table";
    }
}
