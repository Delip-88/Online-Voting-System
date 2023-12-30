<?php
  session_start();
  if($_SESSION['userdata']['Role']!=='user'){
    header('location: ../Routes/loginPage.html');
  }
  $userdata=$_SESSION['userdata'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="../css/userPannel.css" />
  </head>
  <body>

    <header>
        <figure>
          <img src="../img/use.png" alt="" />
        </figure>
        <h1 id="title">SecureVote - Online Voting Platform</h1>
        <div class="welcome">
          <h3>Welcome, <span id="user"><?php echo $userdata['Full_Name']; ?></span></h3>
          <a href="../api/logout.php" id="logout">LogOut</a>
        </div>
      </header>
      <div class="container">
      <div class="card">
            <div class="img">
              <img src="../uploads/<?php echo $userdata['Image'] ?>" alt="">
            </div>
            <hr>
            <div class="info">
            <p>Name : <span class="Name"><?php echo $userdata['Full_Name'] ?></span></p>
            <p>Number : <span class="Number"><?php echo $userdata['Number'] ?></span></p>
            <p>Address : <span class="Address"><?php echo $userdata['Address'] ?></span></p>
            <p>status : <span class="Status"><?php echo $userdata['Role'] ?></span></p>
            </div>

      </div>
    </div>
  </body>
</html>
