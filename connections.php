<?php
$connections = mysqli_connect("localhost", "root", "", "s2_database");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_errno();
}
?>

<style>
.error{
    color:red;
}

.btn-primary{
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0px;
    font-family: 'Montserrat';
    color: #ffffff;
    font-size: 16px;
    background: #808080;
    padding: 6px 20px 8px 20px;
    text-decoration: none;
}

.btn-primary:hover{
    background: #a9a9a9;
    text-decoration: none;
}

.btn-update{
    font-family: 'Montserrat';
    color: #ffffff;
    font-size: 15px;
    background: #a9a9a9;
    padding: 6px 20px 8px 20px;
    text-decoration: none;
}

.btn-update:hover{
    background: #808080;
    text-decoration: none;
}

.btn-delete{
    font-family: 'Montserrat';
    color: #ffffff;
    font-size: 15px;
    background: #d93434;
    padding: 6px 20px 8px 20px;
    text-decoration: none;
}

.btn-delete:hover{
    background: #fc3c3c;
    text-decoration: none;
}
</style>