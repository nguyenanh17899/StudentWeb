<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Add</title>
    <link href="styleLogin.css" rel="stylesheet" type="text/css" />
    <link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="container">
        <div class="header">
            <h1>QUẢN LÝ ĐÀO TẠO SINH VIÊN</h1>
        </div>
        <div class="menu">
            <div class="container">
                <ul>
                    <li><a href="welcome.php">Trang chủ</a></li>
                    <li><a href="">Giới thiệu</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">Đào tạo</a></li>
                    <!-- <li></li> -->
                    <li style="margin-left: auto;"> <a href="logout.php">Thoát </a>
                        Welcome <?php
                                echo $_SESSION['loged_name'] . '!';
                                ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <h2>Thêm sinh viên</h2>
    <form action="addfunction.php" class="form" method="post">
        <div class="form-row">
            <label for="">Tên đăng nhập:</label>
            <input type="text" class="form-input" name="username">
        </div>
        <div class="form-row">
            <label for="">Mật khẩu:</label>
            <input type="password" class="form-input" name="password">
        </div>
        <div class="form-row">
            <label for="">Họ và tên:</label>
            <input type="text" class="form-input" name="fullname">
        </div>
        <div class="form-row">
            <label for="">Email:</label>
            <input type="text" class="form-input" name="email">
        </div>
        <div class="form-row">
            <label for="">SDT:</label>
            <input type="text" class="form-input" name="phonenum">
        </div>
        <input type="submit" value="Thêm" name = "submit"> 
    </form>

</body>

</html>