<?php
session_start();
include('connect.php');
$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id='$id'";

$result = mysqli_query($conn, $sql);
if ($result) {
    header('location: welcome.php');
    echo '<script language="javascript">';
    echo 'alert("Xóa thành công !")';
    echo '</script>';
}
?>