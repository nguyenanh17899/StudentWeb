<?php
    $servername = "localhost:3306";
    $username = "nguyenanh";
    $password = "nguyenanh1789";
    $dbname = "db_student";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // $sql = "SELECT id, fullname FROM users";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    // // output data of each row
    // while($row = $result->fetch_assoc()) {
    //     echo "id: " . $row["id"]. " - Name: " . $row["fullname"]. "<br>";
    // }
    // } else {
    // echo "0 results";
    // }
    // $conn->close();
?>

      

