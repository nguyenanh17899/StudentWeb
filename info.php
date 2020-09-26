<?php
session_start();
include('connect.php');
$id = $_GET['id'];
$idU = $_SESSION['user_id'];
$logedname = $_SESSION['loged_name'];
$sql = "select * from users where id='$id'";
$res = mysqli_query($conn, $sql) or die("Loi truy van");
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
// print_r($row);
$messagelist = "";
//get mess idU send id
$sqlGetMess = "SELECT  * from  messages where  messages.id_user_rcv = $id and messages.id_user_send = $idU union select * from messages where  messages.id_user_rcv = $idU and messages.id_user_send = $id order by time_send";
$resGetMess = mysqli_query($conn, $sqlGetMess);
//get mess id send idU
// $sqlGetMess2 = "select  tb1.fullname as namercv, tb2.fullname as namesend, messages.mess from users as tb1, users as tb2, messages where messages.id_user_rcv = tb1.id and messages.id_user_send = tb2.id and messages.id_user_rcv = $idU and messages.id_user_send = $id";
// $resGetMess2 = mysqli_query($conn, $sqlGetMess2);
while ($rowGet = mysqli_fetch_array($resGetMess, MYSQLI_ASSOC)) {
    if ($rowGet['id_user_rcv'] == $id) {
        $messagelist .= "<form action='' method='POST'>";
        $messagelist .= "<span>" . $logedname . ":" . $rowGet['time_send'] . "</span><br>";
        $messagelist .= "<input type='text' name='message' value='" . $rowGet['mess'] . "' >";
        $messagelist .= "<input type='hidden' name='idsend' value='" . $rowGet['id'] . "' />";
        $messagelist .= "<input type='submit' name='edit' value='Edit'>";
        $messagelist .= "<input type='submit' name='delete' value='Delete'>";
        $messagelist .= "</form>";
    } elseif ($rowGet['id_user_rcv'] == $idU) {
        $messagelist .= "<form action='' method='POST'>";
        $messagelist .= "<span>" . $row['username'] . "</span><br>";
        $messagelist .= "<input type='text' name='message' value='" . $rowGet['mess'] . "' disabled>";
        $messagelist .= "</form>";
    }
}

if (isset($_POST['send'])) {
    $mess = $_POST['message'];
    $sqlChat = "INSERT into messages(id_user_rcv, id_user_send, mess, time_send) values($id, $idU,'$mess', now())";
    $resChat = mysqli_query($conn, $sqlChat);
    if ($resChat) {
        header("location: info.php?id=$id");
        // echo "<script>";
        // echo "alert('OK');";
        // echo "window.open('welcome.php', '_self');";
        // echo "</script>";
    } else {
        echo "<script>";
        echo "alert('failed');";
        echo "</script>";
    }
}
if(isset($_POST["edit"])){
    $id_send = $_POST['idsend'];
    $mess = $_POST["message"];
    $sqlChat = "UPDATE messages SET mess='$mess' WHERE id='$id_send'";
    if($result = mysqli_query($conn, $sqlChat)){
        header("location: info.php?id=$id");
    }else {
        echo "<script>";
        echo "alert('failed');";
        echo "</script>";
    }
}
if(isset($_POST["delete"])){
    $id_send = $_POST['idsend'];
    $mess = $_POST["message"];
    $sqlChat = "DELETE from messages WHERE id='$id_send'";
    if($result = mysqli_query($conn, $sqlChat)){
        header("location: info.php?id=$id");
    }else {
        echo "<script>";
        echo "alert('failed');";
        echo "</script>";
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Information</title>
    <link href="styleLogin.css" rel="stylesheet" type="text/css" />
    <link href="styleChat.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <h1 style="background-color:  #0D1323; text-align: center; color: white; padding-bottom:20px; padding-top:20px; ">QUẢN LÝ ĐÀO TẠO SINH VIÊN</h1>
    <h2>Thông tin người dùng</h2>
    <div class="container" style="margin:0 auto; display:flex;">
        <div style="flex-basis: 50%;">
            <form action="editfunction.php" class="form" method="post">
                <input hidden type="text" class="form-input" name="id" value="<?php echo $row['id']; ?> ">
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
                    <input disabled type="text" class="form-input" name="email" value="<?php echo $row['email']; ?> ">
                </div>
                <div class="form-row">
                    <label for="">SDT:</label>
                    <input disabled type="text" class="form-input" name="sdt" value="<?php echo $row['phonenum']; ?> ">
                </div>


                <a style="margin-top:20px; text-decoration: none; background-color: black; color: white;padding: 5px 15px;" href="welcome.php">Trang chủ </a>

            </form>
        </div>
        <div class="right" style="border: 1px solid black; padding:5px 15px; width:500px; height:500px;">
            <!-- <div class="container">
                <p>Hello. How are you today?</p>
                <span class="time-right">11:00</span>
            </div>

            <div class="container darker">
                <p>Hey! I'm fine. Thanks for asking!</p>
                <span class="time-left">11:01</span>
            </div> -->
            <div>
                <div class="row" style="height:400px;overflow: scroll;">
                    <?php
                    echo $messagelist;
                    ?>
                </div>
                <form action="" method="POST">

                    <label for="">Lời nhắn</label>
                    <input style="width:250px; height: 70px;" type="text" name="message" />
                    <input type="submit" value="Gửi" name="send" />
                </form>
            </div>

        </div>

    </div>
</body>

</html>