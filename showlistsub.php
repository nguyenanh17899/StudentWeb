<?php
session_start();
include('connect.php');
$idU = $_SESSION['id'];
$id_bt = $_GET['id'];
//get list sub of id_bt
$sql1 = "SELECT files.fileupname as nameBT, users.fullname as nameSV, student_solutions.sub_datetime , student_solutions.file_sub_name as nameSub from student_solutions, users, files where student_solutions.id_file = $id_bt and id_user_sub = users.id and student_solutions.id_file = files.id";
$res1 = mysqli_query($conn, $sql1);

$listFileSub = scandir('FileSolutionUpload');
$listFile = scandir('FileUpload');

//get nameBT
$sql = "select files.fileupname from  files where id = $id_bt";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Show list submit excersizes</title>
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
                <p>Bài tập
                    <?php 
                        for ($a = 2; $a < count($listFile); $a++) {
                        if ($listFile[$a] == $row['fileupname']) {
                    ?>
                            <a download="FileUpload/<?php echo $listFile[$a]; ?>" href="FileUpload/<?php echo $listFile[$a]; ?>"><?php echo $listFile[$a]; ?></a>
                    <?php
                            break;
                        }
                    } ?>
                </p>
                <table style="width:100%;">
                    <tr>
                        <td style="width: 35px;">STT</td>
                        <td>Sinh viên</td>
                        <td>Ngày nộp</td>
                        <td>Bài làm</td>
                    </tr>
                    <?php
                    $i = 1;
                    while ($row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . $row1['nameSV'] . "</td>";
                        echo "<td>" . $row1['sub_datetime'] . "</td>";
                        echo "<td>";
                        for ($a = 2; $a < count($listFileSub); $a++) {
                            if ($listFileSub[$a] == $row1['nameSub']) {
                    ?>
                                <a download="FileSolutionUpload/<?php echo $listFileSub[$a] ?>" href="FileSolutionUpload/<?php echo $listFileSub[$a] ?>"><?php echo $listFileSub[$a] ?></a>
                    <?php
                                //   echo "<a href='solution.php?id=".$row['id']."'>bài làm</a>";
                                break;
                            }
                        }
                        echo '</td>';
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
</body>

</html>