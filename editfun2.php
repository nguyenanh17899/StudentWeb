<?php
session_start();
include('connect.php');
$id = $_POST['id'];
$email = $_POST['email'];
$sdt = $_POST['sdt'];

$sql = "update users set email='$email', phonenum='$sdt' where id='$id'";
$res = mysqli_query($conn, $sql) or die("loi truy van");
if($res){
    header("location: welcome.php");
}
?>