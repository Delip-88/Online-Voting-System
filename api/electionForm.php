<?php
include('connect.php');

$position = $_POST['title'];
$sDate = $_POST['startDate'];
$eDate= $_POST['endDate'];

$insert = mysqli_query($connect, "INSERT INTO election(Title,StartDate,EndDate) VALUES('$position','$sDate','$eDate') ");

if ($insert) {
    header("Location: ../Routes/dashBoard/position.php");
    exit; // Ensure script execution stops after the redirect
} else {
    echo "
    <script>
    alert('Insertion Failed');
    </script>";
    header("Location: ../Routes/dashBoard/position.php");
    exit; // Ensure script execution stops after the redirect
}
?>
