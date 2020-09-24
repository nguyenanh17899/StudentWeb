<?php
session_start();
include('connect.php');
$id = $_POST['id'];
$uname = $_POST['username'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$sdt = $_POST['sdt'];

$sql = "update users set username='$uname', fullname='$fullname', email='$email', phonenum='$sdt' where id='$id'";
$res = mysqli_query($conn, $sql) or die("loi truy van");
if($res){
    header("location: welcome.php");
}
?>