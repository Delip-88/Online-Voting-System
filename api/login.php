<?php
    session_start();

    include("connect.php");

    $userRole=$_POST['role'];
    $email=$_POST['email'];
    $password=$_POST['password'];


    //checking role

    if ($userRole==='admin') {
        $table='admins';
    }else if($userRole==='user'){
        $table='validuser';
    }else{
        echo "How?";
    }
    //Authenticate by querying from database

    $sql="SELECT * FROM $table WHERE Email='$email' AND Password='$password'";
    $result=$connect->query($sql);

    if ($result->num_rows>0) {

        $userInfo=mysqli_fetch_array($result);
        $_SESSION['userdata']=$userInfo;

        if ($userRole==='admin') {

            
            header('Location: ../Routes/adminPannel.php');
            exit;
        }else if($userRole==='user'){
            header('Location: ../Routes/userPannel.php');
        }
    }else{
        echo "
        <script>
        alert('Invalid Credintials');
        window.history.back();
        </script>
        ";
    }
?>


