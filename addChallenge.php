<?php
session_start();
include('connect.php');
$idU = $_SESSION['user_id'];
if (isset($_POST['uploadclick'])) {
    $name = $_POST['name'];
    $hint = $_POST['hint'];
    if (!empty($_FILES["fileUp"]["name"])) {

        if ($_FILES['fileUp']['error'] < 0) {

            echo '<script>';
            echo 'alert("File Upload Bị Lỗi");';
            echo 'window.open("welcome.php","_self");';
            echo '</script>';
        } else {
            // Upload file
            $filename = $_FILES['fileUp']['name'];
            $path = 'FileChallenge/' . $filename;
            $fileType = pathinfo($path, PATHINFO_EXTENSION);
            $allowTypes = array('txt');
            $size = $_FILES['fileUp']['size'];
            // echo $size;

            if (in_array($fileType, $allowTypes)) {
                if ($_FILES['fileUp']['size'] > 2000000) {
                    // $text = "Sorry, your file is too large.";
                    echo '<script>';
                    echo 'alert("Sorry, your file is too large.");';
                    echo 'window.open("welcome.php","_self");';
                    echo '</script>';
                } else {

                    if (move_uploaded_file($_FILES['fileUp']['tmp_name'], $path) == true) {
                        $sql = "INSERT INTO challenges(date_create, name_challenge, hint, id_teacher) VALUES(now(), '$name', '$hint',$idU)";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            echo '<script>';
                            echo 'alert("Upload thành coong!");';
                            echo 'window.open("welcome.php","_self");';
                            echo '</script>';
                        } else {
                            // $text =  "lỗi truy vấn";
                            echo '<script>';
                            echo 'alert("lỗi truy vấn");';
                            echo 'window.open("welcome.php","_self");';
                            echo '</script>';
                        }
                    } else {
                        echo '<script>';
                        echo 'alert("Upload thất bại");';
                        echo 'window.open("welcome.php","_self");';
                        echo '</script>';
                    }
                }
            } else {
                // $text = "lỗi định dạng file";
                echo '<script>';
                echo 'alert("lỗi định dạng file");';
                echo 'window.open("welcome.php","_self");';
                echo '</script>';
            }
        }
    } else {
        $text = 'Bạn chưa chọn file upload';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Add</title>
    <link href="styleLogin.css" rel="stylesheet" type="text/css" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

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
        <div class="content">
            <div class="left">
                <div class="container">
                    <h3>Danh mục</h3>
                    <div class="tab">
                        <button class="tabLink" onclick="openTab(event, 'TrangChu')">Trang chủ</button>
                        <button class="tabLink" onclick="openTab(event, 'SV')">Sinh viên</button>
                        <button class="tabLink" onclick="openTab(event, 'GV')">Giáo viên</button>
                        <button class="tabLink" onclick="openTab(event, 'BaiTap')">Bài tập</button>
                        <button class="tabLink" onclick="openTab(event, 'ThuThach')">Thử thách</button>
                        <button class="tabLink" onclick="openTab(event, 'Profile')">Trang cá nhân</button>
                    </div>
                </div>
            </div>
            <div class="right" style="flex-grow: 5;text-align:center;">
                <h2>Tạo challenge</h2>

                <form method="post" action="" enctype="multipart/form-data" style="width:500px;margin:0 auto;">
                    <div class="form-group row">
                        <label>Tên challenge: </label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group row">
                        <label>Hint: </label>
                        <input type="text" class="form-control" name="hint">
                    </div>
                    <div class="form-group row">
                        <input type="file" name="fileUp">
                    </div>
                    <div class="form-group row">
                        <input type="submit" name="uploadclick" value="Upload" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>