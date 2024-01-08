<?php
include("connect.php");

// Get the data from the registration form
$name = $_POST['name'];
$number = $_POST['number'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$email = $_POST['email'];
$address = $_POST['address'];
$image = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];
$role = $_POST['role'];

$emailToCheck = $email;

// Query to check if the email already exists in either table
$query = "SELECT COUNT(*) as count FROM pendingusers WHERE email = ? 
          UNION 
          SELECT COUNT(*) as count FROM validuser WHERE email = ?";

$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, 'ss', $emailToCheck, $emailToCheck);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Sum the counts from both tables
$totalCount = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $totalCount += $row['count'];
}

// Check the total count
if ($totalCount > 0) {
    // Email already exists in either table, prevent registration
    echo "
    <script>
    alert('Email already registered. Please use a different email.');
    window.history.back();
    </script>
";

} else {

    // Continue with the registration process
    if (strlen($password) < 8) {
        echo "
        <script>
        alert('Atleast 8 digit password required');
        window.history.back();
        </script>
    ";
        exit;

    }
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
            </script>";
        } else {
            echo "Some error occurred";
        }
    } else {
        echo "
        <script>
            alert('Confirm Password doesn't Match Password');
            window.history.back();

        </script>
        ";
    }
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($connect);

?>