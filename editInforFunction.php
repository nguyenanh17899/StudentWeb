<?php
session_start();
include('connect.php');
$id = $_POST['id'];
$email = $_POST['email'];
$sdt = $_POST['sdt'];

// $sql = "update users set email='$email', phonenum='$sdt' where id='$id'";
// $res = mysqli_query($conn, $sql) or die("loi truy van");
// if($res){
//     header("location: welcome.php");
// }

if (isset($_POST['update'])) {
    $sql = "update users set email='$email', phonenum='$sdt' where id='$id'";
    $res = mysqli_query($conn, $sql) or die("loi truy van");
    if ($res) {
        echo '<script>';
        echo 'alert("Update thành coong!");';
        echo 'window.open("welcome.php","_self");';
        echo '</script>';
    }
    else{
        echo '<script>';
        echo 'alert("Thất bại !");';
        echo 'window.open("editInfor.php?id='.$id.'"'.',"_self");';
        echo '</script>';
    }
}

?>