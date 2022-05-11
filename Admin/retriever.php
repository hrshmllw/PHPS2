<?php
include("../connections.php");

$retrieve_query = mysqli_query($connections, "SELECT * FROM table_user");

while($row_users = mysqli_fetch_assoc($retrieve_query)){
    $id_user = $row_users["id_user"];
    $db_first_name = $row_users["first_name"];
    $db_middle_name = $row_users["middle_name"];
    $db_last_name = $row_users["last_name"];
    $db_gender = $row_users["gender"];
    $db_prefix = $row_users["prefix"];
    $db_seven_digits = $row_users["seven_digits"];
    $db_email = $row_users["email"];
    $db_password = $row_users["password"];

    echo $db_first_name . " <br> ";
}
?>