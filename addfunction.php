<?php
session_start();
include('connect.php');
include('adduser.php');

$uname = $_POST['username'];
$pass = md5($_POST['password']);
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$sdt = $_POST['phonenum'];
if (isset($_POST['submit'])) {
    $sql = "INSERT INTO users (username,passcode,fullname, email, phonenum,chucvu, role ) VALUES ('$uname', '$pass','$fullname', '$email', '$sdt', 'Sinh Viên', 0)";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script type="text/javascript">';
        echo 'alert("Thêm thành công !");';
        echo 'window.open("welcome.php","_self");';
        echo '</script>';
    }
    else{
        echo '<script type="text/javascript">';
        echo 'alert("Thất bại !");';
        echo 'window.open("welcome.php","_self"0);';
        echo '</script>';
    }
}
