<?php
include("nav.php");

$first_name = $middle_name = $last_name = $gender = $prefix = $seven_digits = $email = "";
$first_nameErr = $middle_nameErr = $last_nameErr = $genderErr = $prefixErr = $seven_digitsErr = $emailErr = "";

if (isset($_POST["button_register"])){
    if (empty($_POST["first_name"])){
        $first_nameErr = "Required!";
    } else{
        $first_name = $_POST["first_name"];
    }

    if (empty($_POST["middle_name"])){
        $middle_nameErr = "Required!";
    } else{
        $middle_name = $_POST["middle_name"];
    }

    if (empty($_POST["last_name"])){
        $last_nameErr = "Required!";
    } else{
        $last_name = $_POST["last_name"];
    }

    if (empty($_POST["gender"])){
        $genderErr = "Required!";
    } else{
        $gender = $_POST["gender"];
    }

    if (empty($_POST["prefix"])){
        $prefixErr = "Required!";
    } else{
        $prefix = $_POST["prefix"];
    }

    if (empty($_POST["seven_digits"])){
        $seven_digitsErr = "Required!";
    } else{
        $seven_digits = $_POST["seven_digits"];
    }

    if (empty($_POST["email"])){
        $emailErr = "Required!";
    } else{
        $email = $_POST["email"];
    }

    if ($first_name && $middle_name && $last_name && $gender && $prefix && $seven_digits && $email){
        if (!preg_match("/^[a-zA-Z ]*$/", $first_name)){
            $first_nameErr = "Only alphabetic characters are allowed.";
        } else{
            $count_first_name_string = strlen($first_name);
            $count_middle_name_string = strlen($middle_name);
            $count_last_name_string = strlen($last_name);
            $count_seven_digit_string = strlen($seven_digits);
            if ($count_first_name_string < 2){
                $first_nameErr = "Minimum of 3 characters required.";
            }
            if ($count_middle_name_string < 2){
                $middle_nameErr = "Minimum of 3 characters required.";
            }
            if ($count_last_name_string < 2){
                $last_nameErr = "Minimum of 3 characters required.";
            }
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid email format.";
        }
        if ($count_seven_digit_string < 7){
            $seven_digitsErr = "7 digits required.";
        }
        function random_password($length = 5){
            $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $shuffled = substr(str_shuffle($str), 0, $length);
            return $shuffled;
        }
        $password = random_password(8);
        include("connections.php");
        mysqli_query($connections, "INSERT INTO table_user(first_name, middle_name, last_name, gender, prefix, seven_digits, email, password, account_type)
        VALUES('$first_name', '$middle_name', '$last_name', '$gender', '$prefix', '$seven_digits', '$email', '$password', '2')");

        echo "<script>window.location.href='success.php';</script>";
    }
}

?>

<style>
    .error{
        color:red;
    }
</style>

<script type="application/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
}
</script>

<form method="POST">
    <center>
        <table border="0" width="50%">
            <tr>
                <td>
                    <input type="text" name="first_name" placeholder="First name" value="<?php echo $first_name; ?>">
                    <span class="error"><?php echo $first_nameErr; ?></span>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="text" name="middle_name" placeholder="Middle name" value="<?php echo $middle_name; ?>">
                    <span class="error"><?php echo $middle_nameErr; ?></span>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="text" name="last_name" placeholder="Last name" value="<?php echo $last_name; ?>">
                    <span class="error"><?php echo $last_nameErr; ?></span>
                </td>
            </tr>

            <tr>
                <td>
                    <select name="gender">
                        <option name="gender" value="">Select gender</option>
                        <option name="gender" value="Male" <?php if ($gender == "Male") { echo "selected"; } ?>>Male</option>
                        <option name="gender" value="Female" <?php if ($gender == "Female") { echo "selected"; } ?>>Female</option>
                    </select>
                    <span class="error"><?php echo $genderErr; ?></span>
                </td>
            </tr>

            <tr>
                <td>
                    <select name="prefix">
                        <option name="prefix" id="prefix" value="">Network Provider</option>
                        <option name="prefix" id="prefix" value="0916" <?php if ($prefix == "0916") { echo "selected"; } ?>>0916</option>
                        <option name="prefix" id="prefix" value="0917" <?php if ($prefix == "0917") { echo "selected"; } ?>>0917</option>
                        <option name="prefix" id="prefix" value="0926" <?php if ($prefix == "0926") { echo "selected"; } ?>>0926</option>
                        <option name="prefix" id="prefix" value="0927" <?php if ($prefix == "0927") { echo "selected"; } ?>>0927</option>
                        <option name="prefix" id="prefix" value="0929" <?php if ($prefix == "0929") { echo "selected"; } ?>>0929</option>
                        <option name="prefix" id="prefix" value="0949" <?php if ($prefix == "0949") { echo "selected"; } ?>>0949</option>
                    </select>
                    <span class="error"><?php echo $prefixErr; ?></span>
                    <input type="text" name="seven_digits" value="<?php echo $seven_digits; ?>" maxlength="7" placeholder="Other seven digits" onkeypress = 'return isNumberKey(event)'>
                    <span class="error"><?php echo $seven_digitsErr; ?></span>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email">
                    <span class="error"><?php echo $emailErr; ?></span>
                </td>
            </tr>

            <tr>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" name="button_register" value="Register">
                </td>
            </tr>
        </table>
    </center>
</form>