<?php
session_start();
include('connect.php');
$id = $_POST['id'];
$uname = $_POST['username'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$sdt = $_POST['sdt'];

if (isset($_POST['update'])) {
    $sql = "update users set username='$uname', fullname='$fullname', email='$email', phonenum='$sdt' where id='$id'";
    $res = mysqli_query($conn, $sql) or die("loi truy van");
    if ($res) {
        echo '<script>';
        echo 'alert("Update thành coong!");';
        echo 'window.open("welcome.php","_self");';
        echo '</script>';
    }
}
