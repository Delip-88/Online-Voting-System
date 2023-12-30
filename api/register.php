<?php
include("connect.php");

$name = $_POST['name'];
$number = $_POST['number'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$email = $_POST['email'];
$address = $_POST['address'];
$image = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];
$role = $_POST['role'];

if (strlen($number) !== 10 || !ctype_digit($number)) {
    echo "
        <script>
        alert('Error: Number must be exactly 10 digits.');
        window.history.back();
        </script>
    ";
    exit;
}
if ($password == $cpassword) {
    move_uploaded_file($tmp_name, "../uploads/$image");
    
    $insert = mysqli_query($connect, "INSERT INTO pendingusers(Full_Name, Number, Password, Email, Address, Image, Role, Status, Votes) VALUES('$name','$number','$password','$email','$address','$image','$role','pending',0)");

    if ($insert) {
        echo "
        <script>
        alert('Insertion successful');
        window.location.href='../Routes/loginPage.html';
        </script>" ;
    } else {
        echo "Some error occurred";
    }
} else {
    echo "
    <script>
        alert('Confirm Password doesn\\'t Match Password');
        window.location.href='../Routes/Register.html';
    </script>
    ";
}
?>
