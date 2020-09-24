<?php
session_start();
include('connect.php');
$id = $_GET['id'];
$sql = "select * from users where id='$id'";
$res = mysqli_query($conn, $sql) or die("Loi truy van");
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
// print_r($row);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Information</title>
    <link href="styleLogin.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1 style="background-color:  #0D1323; text-align: center; color: white; padding-bottom:20px; padding-top:20px; ">QUẢN LÝ ĐÀO TẠO SINH VIÊN</h1>
    <h2>Thông tin người dùng</h2>
    <form action="editfunction.php" class="form" method="post">
        <input hidden type="text" class="form-input" name="id" value="<?php echo $row ['id']; ?> ">
        <div class="form-row">
        <label for="">Tên đăng nhập:</label>
        <input disabled type="text" class="form-input" name="username" value="<?php echo $row ['username']; ?> ">
        </div>
        <div class="form-row">
        <label for="">Họ và tên:</label>
        <input  disabled type="text" class="form-input" name="fullname" value="<?php echo $row ['fullname']; ?> ">
        </div>
        <div class="form-row">
        <label for="">email:</label>
        <input disabled type="text" class="form-input" name="email" value="<?php echo $row ['email']; ?> ">
        </div>
        <div class="form-row">
        <label for="">SDT:</label>
        <input disabled type="text" class="form-input" name="sdt" value="<?php echo $row ['phonenum']; ?> ">
        </div>
        <div class="form-row">
            <label for="">Lời nhắn</label>
            <input style="width:250px; height: 70px;" type="text" name="message" />
            <input type="submit"  value="Gửi" />
        </div>
        
        <a style="margin-top:20px; text-decoration: none; background-color: black; color: white;padding: 5px 15px;" href="welcome.php">Trang chủ </a>
        
    </form>

</body>

</html>