<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cName = $_POST['name'];
    $position = $_POST['pos'];
    $img = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $des = $_POST['description'];

    if (!empty($img)) {
        move_uploaded_file($tmp_name, "../uploads/$img");

        $insert = mysqli_query($connect, "INSERT INTO candidate(Full_Name, Position, Image,Description) VALUES('$cName','$position', '$img', '$des')");

        if ($insert) {
            echo "
            <script>
            window.location.href='../Routes/dashBoard/candidate.php'
            </script>";
        } else {
            echo "Some error occurred";
        }
    } else {
        echo "Please select an image.";
    }
}
?>
