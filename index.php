<?php
session_start();
include("connect.php");


if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $sql = "SELECT * FROM users WHERE username = '$username' AND passcode = '$password'";
  $result = mysqli_query($conn, $sql);
  $num = $result->num_rows;
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if ($num == 1) {
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['loged_name'] = $username;
    $_SESSION['role'] = $row['role'];
    //  print_r($_SESSION['role']);
    echo '<script>';
    echo 'alert("Đăng nhập thành công !");';
    echo 'window.open("welcome.php","_self");';
    echo '</script>';
    // header('location:welcome.php');
  } else {
    echo '<script>';
    echo 'alert("Thất bại ! Kiểm tra lại thông tin đăng nhập.");';
    echo 'window.open("index.php","_self");';
    echo '</script>';
  }
}

// $conn->close();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Login</title>
  <link href="styleLogin.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <h1 style="background-color:  #0D1323; text-align: center; color: white; padding-bottom:20px; padding-top:20px; ">QUẢN LÝ ĐÀO TẠO SINH VIÊN</h1>
  <h2>Login</h2>
  <form action="" class="form" method="post">
    <div class="form-row">
      <label for="">Username:</label>
      <input type="text" class="form-input" name="username">
    </div>
    <div class="form-row">
      <label for="">Password:</label>
      <input type="password" class="form-input" name="password">
    </div>
    <input type="submit" name="login" value="Login" />
    <a href="#">Sign up</a>
  </form>

</body>

</html>