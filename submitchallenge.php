<?php
session_start();
include('connect.php');
$idU = $_SESSION['user_id'];
$idC = $_GET['id'];
$sql = "select * from challenges where id=$idC";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
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
                <p>Challenge: <?php echo $row['name_challenge'] ?></p>
                <p>Hint: <?php echo $row['hint'] ?></p>

                <form method="post" action="" enctype="multipart/form-data" style="width:500px;margin:0 auto;">
                    <div class="form-group row">
                        <label>Đáp án </label>
                        <input name="answers" type="text" class="form-control">
                    </div>
                    <div class="form-group row">
                        <input type="submit" name="subclick" value="Submit" />
                    </div>

                </form>
                <?php
                if (isset($_POST['subclick'])) {
                    $answers = $_POST['answers'];
                    $files = scandir('FileChallenge');
                    for ($a = 2; $a < count($files); $a++) {
                        $filename = explode(".", $files[$a]);
                        if ($filename[0] == $answers) {
                            
                            $myfile = fopen('FileChallenge/'.$filename[0].'.txt', "r") or die("Unable to open file!");
                            // Output one line until end-of-file
                            while (!feof($myfile)) {
                                echo fgets($myfile) . "<br>";
                            }
                            fclose($myfile);
                            // $sqlSub = "insert into "

                        } else {
                            echo "<script>";
                            echo "alert('Không chính xác, vui lòng thử lại');";
                            echo "window.open('submitchallenge.php?id=" . $idC . "', '_self');";
                            echo "</script>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>