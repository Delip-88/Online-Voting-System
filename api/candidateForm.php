<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cName = $_POST['name'];
    $img = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $des = $_POST['description'];

    if (!empty($img)) {
        move_uploaded_file($tmp_name, "../uploads/$img");

        $insert = mysqli_query($connect, "INSERT INTO candidate(Full_Name, Image, Description) VALUES('$cName', '$img', '$des')");

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
