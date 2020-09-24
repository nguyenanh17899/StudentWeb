<?php
session_start();
include('connect.php');
if (isset($_POST['uploadclick'])) {
    // Nếu người dùng có chọn file để upload
    $text = "";
    if (!empty($_FILES["fileUp"]["name"])) {
    
        if ($_FILES['fileUp']['error'] < 0) {
            $text = 'File Upload Bị Lỗi';
        } else {
            // Upload file
            $filename = $_FILES['fileUp']['name'];
            $path = 'FileUpload/' . $filename;
            $fileType = pathinfo($path, PATHINFO_EXTENSION);
            $allowTypes = array('doc', 'docx', 'pdf');
            $size = $_FILES['fileUp']['size'];
            echo $size;

            if (in_array($fileType, $allowTypes)) {
                if ($_FILES['fileUp']['size'] > 2000000) {
                    $text = "Sorry, your file is too large.";
                    // $uploadOk = 0;
                } else {
                    
                    $idU = $_SESSION['user_id'];
                    if (move_uploaded_file($_FILES['fileUp']['tmp_name'], $path) == true) {
                        $sql = "INSERT INTO files(file_path,upload_datetime, id_teacher) VALUES('$path', now(), $idU)";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            echo '<script>alert("File Uploaded")</script>';
                            header('location:welcome.php');
                        } else {
                            $text = "lỗi truy vấn";
                        }
                    }
                    else{
                        $text = "lỗi upload";
                    }
                }
            } else {
                $text = "lỗi định dạng file";
            }

            // for($a = 0; $a < count($_FILES["fileUp"]["name"]); $a++){
            //     $filename = $_FILES['file']['name'][$a];
            //     $path = 'FileUpload/'.$filename;
            //     $sql = "insert into files(file_path,upload_datetime) values($path, now())";
            //     mysqli_query($conn, $sql);
            //     move_uploaded_file($_FILES['fileUp']['tmp_name'][$a], $path);
            //     echo 'File Uploaded';

            // }

        }
    } else {
        $text = 'Bạn chưa chọn file upload';
    }
}
// echo $text;
?>

