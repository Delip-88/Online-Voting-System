<?php
include("connect.php");


if (isset($_POST['accept'])) {
    // Handle accept action
    $user_id = $_POST['user_id'];

    // Fetch user data
    $query = "SELECT * FROM pendingusers WHERE Id = $user_id";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        // Insert the row into the 'validUser' table
        $insert_query = "INSERT INTO validUser (Full_Name, Number, Password, Email, Address,Image, Role) VALUES (
            '{$user_data['Full_Name']}',
            '{$user_data['Number']}',
            '{$user_data['Password']}',
            '{$user_data['Email']}',
            '{$user_data['Address']}',
            '{$user_data['Image']}',
            '{$user_data['Role']}'
        )";

        mysqli_query($connect, $insert_query);

        // Delete the row from the 'pendingusers' table
        $delete_query = "DELETE FROM pendingusers WHERE Id = $user_id";
        mysqli_query($connect, $delete_query);
    }

    header("Location: ../Routes/dashBoard/pendingVoter.php"); // Redirect to the same page after action
    exit;
}else if (isset($_POST['reject'])) {
    // Handle reject action
    $user_id = $_POST['user_id'];
    $originating_page = $_POST['originating_page'];

    if ($originating_page === 'pendingVoter') {
        deleteImageAndRow($connect, $user_id, 'pendingusers', "../../uploads/", "../Routes/dashBoard/pendingVoter.php");
    } elseif ($originating_page === 'voter') {
        deleteImageAndRow($connect, $user_id, 'validuser ', "../../uploads/", "../Routes/dashBoard/voter.php");
    }elseif($originating_page === 'candidate'){
        deleteImageAndRow($connect,$user_id, 'candidate', "../../uploads/", "../Routes/dashBoard/candidate.php");
    } 
    else {
        // Default redirect if originating_page is not recognized
        header("Location: ../Routes/loginPage.php");
        exit;
    }
}

function deleteImageAndRow($connect, $user_id, $table, $imagePathPrefix, $redirectPage) {
    // Fetch the image name from the database
    $image_query = "SELECT Image FROM $table WHERE Id = $user_id";
    $image_result = mysqli_query($connect, $image_query);

    if ($image_result && $image_row = mysqli_fetch_assoc($image_result)) {
        $image_filename = $image_row['Image'];

        // Delete the image file from the server
        $image_path = $imagePathPrefix . $image_filename;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // Delete the row from the specified table
    $delete_query = "DELETE FROM $table WHERE Id = $user_id";
    mysqli_query($connect, $delete_query);

    // Redirect to the specified page
    header("Location: $redirectPage");
    exit;
}


?>
