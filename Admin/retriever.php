<br>
<br>
<br>
<br>

<center>
    <table border = "0" width = "80%">
        <tr>
            <td width = "16%"><b>Name</b></td>
            <td width = "10%"><b>Gender</b></td>
            <td width = "16%"><b>Contact</b></td>
            <td width = "16%"><b>Email</b></td>
            <td width = "16%"><b>Password</b></td>
            <td width = "16%"><center><b>Action</b></center></td>
        </tr>
        <tr>
            <td colspan="6"><hr></td>
        </tr>

<?php
include("../connections.php");

$retrieve_query = mysqli_query($connections, "SELECT * FROM table_user");

while($row_users = mysqli_fetch_assoc($retrieve_query)){
    $id_user = $row_users["id_user"];
    $db_first_name = $row_users["first_name"];
    $db_middle_name = $row_users["middle_name"];
    $db_last_name = $row_users["last_name"];
    $db_gender = ucfirst($row_users["gender"]);
    $db_prefix = $row_users["prefix"];
    $db_seven_digits = $row_users["seven_digits"];
    $db_email = $row_users["email"];
    $db_password = $row_users["password"];

    $full_name = ucfirst($db_first_name) . " " . ucfirst($db_middle_name[0]) . ". " . ucfirst($db_last_name);
    $contact = $db_prefix.$db_seven_digits;

    $jScript = md5(rand(1,9));
    $newScript = md5(rand(1,9));
    $getUpdate = md5(rand(1,9));
    $getDelete = md5(rand(1,9));

    echo "
    <tr>
        <td>$full_name</td>
        <td>$db_gender</td>
        <td>$contact</td>
        <td>$db_email</td>
        <td>$db_password</td>
        <td>
            <center>
                <br>
                    <a href='?jScript=$jScript&&newScript=$newScript&&getUpdate=$getUpdate&&id_user=$id_user' class = 'btn-update'>Update</a>
                    &nbsp;
                    <a href='?jScript=$jScript&&newScript=$newScript&&getDelete=$getDelete&&id_user=$id_user' class = 'btn-delete'>Delete</a>
                <br>
                <br>
            </center>
        </td>
    </tr>";

    echo "
    <tr>
        <td colspan='6'><hr></td>
    </tr>
    ";
}
?>

    </table>
</center>