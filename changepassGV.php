<?php
session_start();
include('connect.php');
// include('edituser.php');
$id = $_GET['id'];
$sql = "select * from users where id = '$id' ";
$res = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($res, MYSQLI_ASSOC);

if (isset($_POST['btnChangePassword'])) {
    $newpass = $_POST['new_password'];
    $confpass = $_POST['confirm_password'];
    if ($newpass == $confpass) {
        $newpass = md5($_POST["new_password"]);
        $result = mysqli_query($conn, "UPDATE users set passcode='" . $newpass . "' WHERE id='$id'");

        if ($result) {
            echo '<script>';
            echo 'alert("Update thành coong!");';
            echo 'window.open("welcome.php","_self");';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'alert("Mật khẩu không khớp");';
        echo 'window.open("changepassGV.php?id=' . $id . '"' . ',"_self");';
        echo '</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css" />

    <title>Document</title>
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

    <form action="" name="frmChange" method="post" style="text-align: center;width: 500px;margin: 0 auto;">
        <h2>Đổi mật khẩu</h2>
        <div class="form-group">
            <input disabled type="text" name="username" class="form-control" value="<?php echo $r['username']; ?> ">
        </div>
        <!-- <div class="form-group">
            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Mật khẩu hiện tại">
        </div> -->
        <div class="form-group">
            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Mật khẩu mới">
        </div>
        <div class="form-group">
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu">
        </div>
        <div class="form-group">
            <input type="submit" name="btnChangePassword" class="btn btn-primary" value="Lưu thay đổi" />
        </div>
    </form>

    <script>
        function validatePassword() {
            var currentPassword, newPassword, confirmPassword, output = true;

            currentPassword = document.frmChange.current_password;
            newPassword = document.frmChange.new_password;
            confirmPassword = document.frmChange.confirm_password;

            if (!currentPassword.value) {
                currentPassword.focus();
                document.getElementById("current_password").innerHTML = "required";
                output = false;
            } else if (!newPassword.value) {
                newPassword.focus();
                document.getElementById("new_password").innerHTML = "required";
                output = false;
            } else if (!confirmPassword.value) {
                confirmPassword.focus();
                document.getElementById("confirm_password").innerHTML = "required";
                output = false;
            }
            if (newPassword.value != confirmPassword.value) {
                newPassword.value = "";
                confirmPassword.value = "";
                newPassword.focus();
                document.getElementById("confirm_password").innerHTML = "not same";
                output = false;
            }
            return output;
        }
    </script>
</body>

</html>