<?php
session_start();
include("nav.php");
if(isset($_SESSION["email"])){
    $email = $_SESSION["email"];
    $query_account_type = mysqli_query($connections, "SELECT * FROM table_user WHERE email = '$email'");
    $get_account_type = mysqli_fetch_assoc($query_account_type);
    if($account_type == 1){
        echo "<script>window.location.href='Admin';</script>";
    } else{
        echo "<script>window.location.href='Users';</script>";
    }
}

date_default_timezone_set("Asia/Manila");
$date_now = date("m/d/Y");
$time_now = date("h:i a");
$notify = $attempt = $log_time = "";

$end_time = date("h:i A", strtotime("+15 minutes", strtotime($time_now)));

$email = $password = "";
$emailErr = $passwordErr = "";

if(isset($_POST["btn_login"])){
    if(empty($_POST["email"])){
        $emailErr = "Email required.";
    } else{
        $email = $_POST["email"];
    }

    if(empty($_POST["password"])){
        $passwordErr = "Password required.";
    } else{
        $password = $_POST["password"];
    }

    if($email AND $password){
        $check_email = mysqli_query($connections, "SELECT * FROM table_user WHERE email = '$email'");
        $check_row = mysqli_num_rows($check_email);

        if($check_row > 0){
            $fetch = mysqli_fetch_assoc($check_email);
            $db_password = $fetch["password"];
            $db_attempt = $fetch["attempt"];
            $db_log_time = strtotime($fetch["log_time"]);
            $my_log_time = $fetch["log_time"];
            $new_time = strtotime($time_now);
            $account_type = $fetch["account_type"];
            
            if($account_type == "1"){
                if($db_password == $password){
                    $_SESSION["email"] = $email;
                    echo "<script>window.location.href='Admin';</script>";
                } else{
                    $passwordErr = "Incorrect password. You are attempting to log into an admin account.";
                }
            } else{
                if($db_log_time <= $new_time){
                    if($db_password == $password){
                        $_SESSION["email"] = $email;
                        mysqli_query($connections, "UPDATE table_user SET attempt = '', log_time = '' WHERE email = '$email'");
                        echo "<script>window.location.href='Users';</script>";
                    } else{
                        $attempt = (int)$db_attempt + 1;
                        if($attempt >= 3){
                            $attempt = 3;
                            mysqli_query($connections, "UPDATE table_user SET attempt = '$attempt', log_time = '$end_time' WHERE email = '$email'");
                            $notify = "Max attempts reached. Try again after: <b>$end_time</b>";
                        } else{
                            mysqli_query($connections, "UPDATE table_user SET attempt = '$attempt' WHERE email = '$email'");
                            $passwordErr = "Incorrect password.";
                            $notify = "Login attempt: <b>$attempt/3</b>.";
                        }
                    }
                } else{
                    $notify = "Try logging in again after: <b>$my_log_time</b>";
                }
            }

        } else{
            $emailErr = "Account not registered.";
        }
    }
}
?>

<br>
<br>

<center>
    <form method="POST">
        <h2>Login</h2>

        <input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
        <br>
        <span class="error"><?php echo $emailErr; ?></span>
        
        <br>

        <input type="password" name="password" placeholder="Password" value="">
        <br>
        <span class="error"><?php echo $passwordErr; ?></span>
        <br>

        <input type="submit" name="btn_login" class="btn-primary" value="Login">

        <br>
        <span class="error"><?php echo $notify; ?></span>
        <br>

        <a href="?forgot=<?php echo md5(rand(1,9)); ?>">Forgot password?</a>
    </form>
</center>