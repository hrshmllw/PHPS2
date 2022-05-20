<?php
session_start();

if(isset($_SESSION["email"])){
    $email = $_SESSION["email"];
} else{
    echo "<script>window.location.href='../';</script>";
}

include("../connections.php");
include("nav.php");

$check = $checkErr = "";

if(isset($_POST["btn_submit"])){
    if(empty($_POST["check"])){
        $checkErr = "Select at least one (1).";
    } else{
        $check = $_POST["check"];
    }

    if($check){
        echo "<br><br>";
        foreach($check as $new_check){
            echo $new_check . "<br>";
        }
    }
}
?>

<br>
<hr>

<form method="POST">
    <span class="error"><?php echo $checkErr; ?></span>
    <br>
    <input type="checkbox" name="check[]" value="Pale Pilsen">Pale Pilsen
    <br>
    <input type="checkbox" name="check[]" value="San Mig Super Dry ">San Mig Super Dry
    <br>
    <input type="checkbox" name="check[]" value="Red Horse">Red Horse
    <br>
    <input type="checkbox" name="check[]" value="Colt 45">Colt 45
    <br>
    <input type="checkbox" name="check[]" value="Tiger Black">Tiger Black
    <br>
    <input type="checkbox" name="check[]" value="Jim Bean">Jim Beam
    <br>
    <input type="checkbox" name="check[]" value="Glenfiddich">Glenfiddich
    <br>
    <input type="checkbox" name="check[]" value="Black Label">Black Label
    <br>
    <input type="checkbox" name="check[]" value="Chivas Regal">Chivas Regal
    <br>
    <input type="checkbox" name="check[]" value="Hennessy">Hennessy
    <br>
    <input type="submit" name="btn_submit" value="Submit">
</form>