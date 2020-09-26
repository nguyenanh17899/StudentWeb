<?php
session_start();
// include('index.php');
// include('permission.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Welcome</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
      <div class="right" style="flex-grow: 5;">
        <div class="container">
          <div id="TrangChu" class="tabcontent">
            <h3>London</h3>
            <p>London is the capital city of England.</p>
          </div>

          <div id="SV" class="tabcontent">
            <h3 style="text-align: center; margin-bottom: 30px;">Danh sách sinh vien</h3>
            <?php
            session_start();
            include('connect.php');
            $sql = "SELECT * FROM users WHERE chucvu='Sinh viên'";
            $result = mysqli_query($conn, $sql) or die("Loi truy van");
            $style = "";
            if ($_SESSION['role'] == 1) {
              // $style = "visibility: hidden;";
              echo "<a href='adduser.php' style='background-color: #808080; padding: 5px 15px;color: white; margin-bottom:20px;'>Thêm</a>";
            }
            ?>
            <table style="width:100%">
              <tr>
                <th>Tên đăng nhập</th>
                <th>Họ và tên</th>
                <th>email</th>
                <th>SDT</th>
                <th></th>
                <!-- <th></th> -->
              </tr>
              <?php
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['fullname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phonenum'] . "</td>";
                echo "<td>";

                echo "<a href='info.php?id=" . $row['id'] . "' >Chi tiết</a>";
                if ($_SESSION['role'] == 1) {
                  echo "<a href='edituser.php?id=" . $row['id'] . "'>|Sửa</a>|<a href='delete.php?id=" . $row['id'] . " '>Xóa</a>";
                }
                echo "</td>";
                echo "</tr>";
              }

              ?>
            </table>
          </div>

          <div id="GV" class="tabcontent">
            <h3 style="text-align: center; margin-bottom: 30px;">Danh sách giáo viên</h3>
            <?php
            session_start();
            include('connect.php');
            $sql = "SELECT * FROM users WHERE chucvu='Giáo Viên'";
            $result = mysqli_query($conn, $sql) or die("Loi truy van");

            ?>
            <!-- <a href='adduser.php' style='background-color: #808080; padding: 5px 15px;color: white; margin-bottom:20px; visibility: hidden;'>Thêm</a> -->
            <table style="width:100%">
              <tr>
                <th>Tên đăng nhập</th>
                <th>Họ và tên</th>
                <th>email</th>
                <th>SDT</th>
                <!-- <th></th> -->
              </tr>
              <?php
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['fullname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phonenum'] . "</td>";
                // echo "<td><a href=''>Sửa</a>|<a href=''>Xóa</a></td>";
                echo "</tr>";
              }

              ?>
            </table>
          </div>
          <div class="modal fade" id="addExModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Thêm bài tập</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="upload.php" enctype="multipart/form-data">
                    <input type="file" name="fileUp" />
                    <input type="submit" name="uploadclick" value="Upload" />
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
              </div>
            </div>
          </div>
          <div id="BaiTap" class="tabcontent">

            <h3>Danh sách bài tập hiện tại</h3>
            <?php
            session_start();
            include('connect.php');
            $sql = "SELECT * FROM files ";
            $result = mysqli_query($conn, $sql) or die("Loi truy van");
            $style = "";
            $listFile = scandir('FileUpload');

            if ($_SESSION['role'] == 1) {
              // $style = "visibility: hidden;";
              echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExModal">Thêm bài tập</button>';
            }
            ?>
            <table style="width:100%;">
              <tr>
                <td style="width: 35px;">STT</td>
                <td>Ngày đăng</td>
                <td>Tên bài tập</td>
                <td></td>
              </tr>
              <?php
              $i = 1;
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
                echo "<td>" . $row['upload_datetime'] . "</td>";
                echo "<td>" . $row['fileupname'] . "</td>";
                echo "<td>";


                // echo "<a href='' >Xem</a>";
                if ($_SESSION['role'] == 1) {
                  echo "<a href='showlistsub.php?id=".$row['id']."'>Xem</a>";

                } else {
                  // echo "<a href='download.php?id=".$row['id']."'>Tải xuống</a>|<a href=''>Bài làm</a>";
                  for ($a = 2; $a < count($listFile); $a++) {
                    if ($listFile[$a] == $row['fileupname']) {
              ?>
                      <a download="FileUpload/<?php echo $listFile[$a] ?>" href="FileUpload/<?php echo $listFile[$a] ?>">Tải xuống|</a>
              <?php
                      echo "<a href='solution.php?id=".$row['id']."'>bài làm</a>";
                    break;
                    }
                  }
                }
                echo "</td>";
                echo "</tr>";
              }

              ?>
            </table>
          </div>
          <div id="ThuThach" class="tabcontent">

            <h2>Danh sách challenge</h2>
            <?php
              session_start();
              include('connect.php');
              $sql = "SELECT * FROM challenges ";
              $result = mysqli_query($conn, $sql) or die("Loi truy van");
              if($_SESSION['role'] == 1){
                echo "<a href = 'addChallenge.php'>Thêm mới</a>";
              }
            ?>
            <table style="width:100%;">
              <tr>
                <td style="width:35px;">STT</td>
                <td>Tên thử thách</td>
                <td>Ngày tạo</td>
                <td>Submit</td>
              </tr>
              <?php
              $i =1;
              while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
                echo "<td>" . $row['name_challenge'] . "</td>";
                echo "<td>" . $row['date_create'] . "</td>";
                echo "<td>";
                if ($_SESSION['role'] == 1) {
                  echo "<a href=''>Xem</a>";

                }
                else {
                  echo "<a href='submitchallenge.php?id=".$row['id']."'>Submit</a>";

                }
              }
              ?>
            </table>
          </div>
          <div id="Profile" class="tabcontent profile">
            <h3>Thông tin cá nhân</h3>
            <?php
            session_start();
            include("connect.php");
            $uname = $_SESSION['loged_name'];
            $sql = "SELECT * FROM users WHERE username = '$uname' ";
            $result = mysqli_query($conn, $sql) or die("Loi truy van");
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            ?>
            <form action="" class="form" method="post">
              <div class="form-row">
                <label for="">Tên đăng nhập:</label>
                <input disabled type="text" class="form-input" name="username" value="<?php echo $row['username']; ?> ">
              </div>
              <div class="form-row">
                <label for="">Họ và tên:</label>
                <input disabled type="text" class="form-input" name="fullname" value="<?php echo $row['fullname']; ?> ">
              </div>
              <div class="form-row">
                <label for="">email:</label>
                <input type="text" class="form-input" name="email" value="<?php echo $row['email']; ?> ">
              </div>
              <div class="form-row">
                <label for="">SDT:</label>
                <input type="text" class="form-input" name="phonenum" value="<?php echo $row['phonenum']; ?> ">
              </div>
              <a href="editInfor.php?id=<?php echo $row['id'] ?>">Sửa thông tin</a>
              <!-- <a href="changepass.php?id=<?php echo $row['id'] ?>">Đổi mật khẩu</a> -->
              <!-- <input type="submit" name="editPass" value="Đổi mật khẩu" /> -->

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function openTab(evt, tabName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < tablinks.length; i++) {
        // tablinks[i].className = tablinks[i].className.replace(" active", "");
        if (tablinks[i].classList.contains("active")) {
          tablinks[i].classList.remove("active");
        }
      }
      document.getElementById(tabName).style.display = "block";
      // evt.currentTarget.className += " active";
      evt.currentTarget.classList.add("active");
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>