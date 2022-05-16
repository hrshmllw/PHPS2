<?php
include("../connections.php");
if(isset($_SESSION["email"])){
    $email = $_SESSION["email"];
    $authentication = mysqli_query($connections, "SELECT * FROM table_user WHERE email = '$email'");
    $fetch = mysqli_fetch_assoc($authentication);
    $account_type = $fetch["account_type"];

    if($account_type != 1){
        echo "<script>window.location.href='../forbidden';</script>";
    }
}
$id_user = $_GET["id_user"];

$get_record = mysqli_query($connections, "SELECT * FROM table_user WHERE id_user = '$id_user'");

while($get = mysqli_fetch_assoc($get_record)){
    $db_first_name = $get["first_name"];
    $db_middle_name = $get["middle_name"];
    $db_last_name = $get["last_name"];
    $db_gender = $get["gender"];
    $db_prefix = $get["prefix"];
    $db_seven_digits = $get["seven_digits"];
    $db_email = $get["email"];
    $db_password = $get["password"];
}

$new_first_name = $new_middle_name = $new_last_name = $new_gender = $new_prefix = $new_seven_digits = $new_email = "";
$new_first_nameErr = $new_middle_nameErr = $new_last_nameErr = $new_genderErr = $new_prefixErr = $new_seven_digitsErr = $new_emailErr = "";

if(isset($_POST["btn_update"])){
    if(empty($_POST["new_first_name"])){
        $new_first_nameErr = "This field must not be empty.";
    } else{
        $new_first_name = $_POST["new_first_name"];
        $db_first_name = $new_first_name;
    }

    if(empty($_POST["new_middle_name"])){
        $new_middle_nameErr = "This field must not be empty.";
    } else{
        $new_middle_name = $_POST["new_middle_name"];
        $db_middle_name = $new_middle_name;
    }

    if(empty($_POST["new_last_name"])){
        $new_last_nameErr = "This field must not be empty.";
    } else{
        $new_last_name = $_POST["new_last_name"];
        $db_last_name = $new_last_name;
    }

    if(empty($_POST["new_seven_digits"])){
        $new_seven_digitsErr = "This field must not be empty.";
    } else{
        $new_seven_digits = $_POST["new_seven_digits"];
        $db_seven_digits = $new_seven_digits;
    }

    if(empty($_POST["new_email"])){
        $new_emailErr = "This field must not be empty.";
    } else{
        $new_email = $_POST["new_email"];
        $db_email = $new_email;
    }

    $db_gender = $_POST["new_gender"];
    $db_prefix = $_POST["new_prefix"];

    if($new_first_name && $new_middle_name && $new_last_name && $new_seven_digits && $new_email){
        mysqli_query($connections, "UPDATE table_user SET
        
        first_name = '$db_first_name',
        middle_name = '$db_middle_name',
        last_name = '$db_last_name',
        gender = '$db_gender',
        prefix = '$db_prefix',
        seven_digits = '$db_seven_digits',
        email = '$db_email' WHERE id_user = '$id_user'");

        $encrypted = md5(rand(1,9));
        echo "<script>window.location.href = 'view_records?$encrypted&&notify=Record has been updated!';</script>";
    }
}
?>

<center>
<br>
<br>
<br>
<form method = "POST">
    <table border = "0" width = "50%">
        <tr>
            <td>
                <input type = "text" name = "new_first_name" value = "<?php echo $db_first_name; ?>" placeholder = "First name">
                <span class = "error"><?php echo $new_first_nameErr; ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <input type = "text" name = "new_middle_name" value = "<?php echo $db_middle_name; ?>" placeholder = "Middle name">
                <span class = "error"><?php echo $new_middle_nameErr; ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <input type = "text" name = "new_last_name" value = "<?php echo $db_last_name; ?>" placeholder = "Last name">
                <span class = "error"><?php echo $new_last_nameErr; ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <select name = "new_gender">
                    <option name = "new_gender" value = "Male" <?php if($db_gender == "Male") { echo "selected"; } ?>>Male</option>
                    <option name = "new_gender" value = "Female" <?php if($db_gender == "Female") { echo "selected"; } ?>>Female</option>
                </select>
                <span class = "error"><?php echo $new_genderErr; ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <select name = "new_prefix">
                    <option name = "new_prefix" value = "">Network Provider</option>
                    <option name = "new_prefix" value = "0916" <?php if ($db_prefix == "0916") { echo "selected"; } ?>>0916</option>
                    <option name = "new_prefix" value = "0917" <?php if ($db_prefix == "0917") { echo "selected"; } ?>>0917</option>
                    <option name = "new_prefix" value = "0926" <?php if ($db_prefix == "0926") { echo "selected"; } ?>>0926</option>
                    <option name = "new_prefix" value = "0927" <?php if ($db_prefix == "0927") { echo "selected"; } ?>>0927</option>
                    <option name = "new_prefix" value = "0929" <?php if ($db_prefix == "0929") { echo "selected"; } ?>>0929</option>
                    <option name = "new_prefix" value = "0949" <?php if ($db_prefix == "0949") { echo "selected"; } ?>>0949</option>
                </select>
                <span class = "error"><?php echo $new_prefixErr; ?></span>
                <input type = "text" name = "new_seven_digits" value = "<?php echo $db_seven_digits; ?>" maxlength = "7" placeholder = "Other seven digits" onkeypress = 'return isNumberKey(event)'>
                <span class = "error"><?php echo $new_seven_digitsErr; ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <input type = "text" name = "new_email" value = "<?php echo $db_email; ?>" placeholder = "Email" size = "30">
                <span class = "error"><?php echo $new_emailErr; ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <input type = "submit" name = "btn_update" value = "Update" class = "btn-primary">
            </td>
        </tr>
    </table>
</form>
</center>