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
    <title>Add</title>
    <link href="styleLogin.css" rel="stylesheet" type="text/css" />
    <link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <!-- <h1 style="background-color:  #0D1323; text-align: center; color: white; padding-bottom:20px; padding-top:20px; ">QUẢN LÝ ĐÀO TẠO SINH VIÊN</h1> -->
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
    <h2>Sửa thông tin</h2>
    <form action="editfunction.php" class="form" method="post">
        <input hidden type="text" class="form-input" name="id" value="<?php echo $row['id']; ?> ">
        <div class="form-row">
            <label for="">Tên đăng nhập:</label>
            <input type="text" class="form-input" name="username" value="<?php echo $row['username']; ?> ">
        </div>
        <div class="form-row">
            <label for="">Họ và tên:</label>
            <input type="text" class="form-input" name="fullname" value="<?php echo $row['fullname']; ?> ">
        </div>
        <div class="form-row">
            <label for="">email:</label>
            <input type="text" class="form-input" name="email" value="<?php echo $row['email']; ?> ">
        </div>
        <div class="form-row">
            <label for="">SDT:</label>
            <input type="text" class="form-input" name="sdt" value="<?php echo $row['phonenum']; ?> ">
        </div>
        <input type="submit" name="update" value="cập nhật" />
        <a href='changepass.php?id=<?php echo $id ?>'>Đổi mật khẩu</a>

    </form>

</body>

</html>