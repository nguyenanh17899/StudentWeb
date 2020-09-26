<?php
session_start();
include('connect.php');
if (isset($_POST['uploadclick'])) {
    // Nếu người dùng có chọn file để upload
    if (!empty($_FILES["fileUp"]["name"])) {
    
        if ($_FILES['fileUp']['error'] < 0) {
            
            echo '<script>';
            echo 'alert("File Upload Bị Lỗi");';
            echo 'window.open("welcome.php","_self");';
            echo '</script>';
        } else {
            // Upload file
            $filename = $_FILES['fileUp']['name'];
            $path = 'FileUpload/' . $filename;
            $fileType = pathinfo($path, PATHINFO_EXTENSION);
            $allowTypes = array('doc', 'docx', 'pdf');
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
                    
                    $idU = $_SESSION['user_id'];
                    if (move_uploaded_file($_FILES['fileUp']['tmp_name'], $path) == true) {
                        $sql = "INSERT INTO files(fileupname,upload_datetime, id_teacher) VALUES('$filename', now(), $idU)";
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
                    }
                    else{
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
