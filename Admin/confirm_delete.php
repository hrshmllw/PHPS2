<?php
$id_user = $_GET["id_user"];
$query_name = mysqli_query($connections, "SELECT * FROM table_user WHERE id_user = '$id_user'");
$row = mysqli_fetch_assoc($query_name);

$db_first_name = $row["first_name"];
$db_middle_name = $row["middle_name"];
$db_last_name = $row["last_name"];
$db_gender = $row["gender"];
$gender_prefix = "";

if($db_gender == "Male"){
    $gender_prefix = "Mr.";
} else{
    $gender_prefix = "Ms.";
}

$full_name = $gender_prefix . " " . ucfirst($db_first_name) . " " . ucfirst($db_middle_name[0]) . ". " . ucfirst($db_last_name);

include("../connections.php");

if(isset($_POST["btn_delete"])){
    mysqli_query($connections, "DELETE FROM table_user WHERE id_user = '$id_user'");
    echo "<script>window.location.href = 'view_records?notify=$full_name has successfully been deleted.'</script>";
}
?>

<br>
<br>
<center>
    <form method="POST">
        <h4>You are about to delete this record: <font color="red"><?php echo $full_name; ?></font></h4>
        <input type="submit" name="btn_delete" value="Confirm" class="btn-update">&nbsp;&nbsp;<a href="?" class="btn-delete">Cancel</a>
    </form> 
</center>