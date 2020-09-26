<?php
session_start();
include('connect.php');
$id_bt = $_GET['id'];
$sql = "select * from files where id = $id_bt";
$res = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($res, MYSQLI_ASSOC);
$listFile = scandir('FileUpload');
$listFileSub = scandir('FileSolutionUpload');
$idU = $_SESSION['user_id'];
// echo $listFileSub;

$sql2 = "select * from student_solutions where id_user_sub = $idU and id_file = $id_bt";
$res2 = mysqli_query($conn, $sql2);
$r2 = mysqli_fetch_array($res2,MYSQLI_ASSOC);

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
                <h2>Nộp bài tập</h2>
                <p>Đề bài : <?php for ($a = 2; $a < count($listFile); $a++) {
                                if ($listFile[$a] == $r['fileupname']) {
                            ?>
                            <a download="FileUpload/<?php echo $listFile[$a]; ?>" href="FileUpload/<?php echo $listFile[$a]; ?>"><?php echo $listFile[$a]; ?></a>
                    <?php
                                    break;
                                }
                            } ?>
                </p>
                <p>Đã nộp : <?php for ($a = 2; $a < count($listFileSub); $a++) {
                                if ($listFileSub[$a] == $r2['file_sub_name']) {
                            ?>
                            <a download="FileSolutionUpload/<?php echo $listFileSub[$a]; ?>" href="FileSolutionUpload/<?php echo $listFileSub[$a]; ?>"><?php echo $listFileSub[$a]; ?></a>
                    <?php
                                    break;
                                }
                            } ?>
                </p>

                <form method="post" action="" enctype="multipart/form-data">
                    <input type="file" name="fileUp" /></br></br>
                    <input type="submit" name="uploadclick" value="Upload" />
                </form>
                <?php
                // session_start();
                include('connect.php');
                if (isset($_POST['uploadclick'])) {
                    // Nếu người dùng có chọn file để upload
                    if (!empty($_FILES["fileUp"]["name"])) {

                        if ($_FILES['fileUp']['error'] < 0) {

                            echo '<script>';
                            echo 'alert("File Upload Bị Lỗi");';
                            echo 'location.reload();';
                            echo '</script>';
                        } else {
                            // Upload file
                            $filename = $_FILES['fileUp']['name'];
                            $path = 'FileSolutionUpload/' . $filename;
                            $fileType = pathinfo($path, PATHINFO_EXTENSION);
                            $allowTypes = array('doc', 'docx', 'pdf');
                            $size = $_FILES['fileUp']['size'];
                            // echo $size;

                            if (in_array($fileType, $allowTypes)) {
                                if ($_FILES['fileUp']['size'] > 2000000) {
                                    // $text = "Sorry, your file is too large.";
                                    echo '<script>';
                                    echo 'alert("Sorry, your file is too large.");';
                                    echo 'location.reload();';
                                    echo '</script>';
                                } else {

                                    // $idFile = $r['id'];
                                    if (move_uploaded_file($_FILES['fileUp']['tmp_name'], $path) == true) {
                                        $s = "INSERT INTO student_solutions(id_user_sub, id_file, file_sub_name, sub_datetime) VALUES($idU,$id_bt, '$filename', now())";
                                        $result = mysqli_query($conn, $s);

                                        if ($result) {
                                            echo '<script>';
                                            echo 'alert("Upload thành coong!");';
                                            echo 'window.open("welcome.php","_self");';
                                            echo '</script>';
                                        } else {
                                            // $text =  "lỗi truy vấn";
                                            echo '<script>';
                                            echo 'alert("lỗi truy vấn");';
                                            // echo 'window.open("welcome.php","_self");';
                                            echo '</script>';
                                        }
                                    } else {
                                        echo '<script>';
                                        echo 'alert("Upload thất bại");';
                                        // echo 'window.open("welcome.php","_self");';
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
                } ?>
            </div>
        </div>
</body>

</html>