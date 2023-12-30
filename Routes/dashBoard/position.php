<?php
  session_start();
  if ($_SESSION['userdata']['Role'] !== 'admin') {
    header('location: ../loginPage.html');
    exit;
}

  $userdata=$_SESSION['userdata'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SecureVote - Online Voting Platform</title>
    <link rel="stylesheet" href="../../css/Home.css" />
  </head>
  <body>
    <div class="container">
      <header>
        <figure>
        <img src="../../img/use.png" alt="" />
        </figure>
        <h2>SecureVote - Online Voting Platform</h2>
        <div class="welcome">
          <h3>Welcome, <span><?php echo $userdata['Full_Name']; ?></span></h3>
          <a href="../../api/logout.php" id="logout">LogOut</a>
        </div>
      </header>
      <nav>
        <ul>
          <li><a href="../adminPannel.php" class="btn">DashBoard</a></li>
          <li class="manage"><p>Manage</p></li>
          <li><a href="position.php" class="btn active">Position/Election</a></li>
          <li><a href="candidate.php" class="btn">Candidate</a></li>
          <li><a href="voter.php" class="btn">Voters</a></li>
          <li><a href="pendingVoter.php" class="btn">PendingVoters</a></li>
        </ul>
        <div class="main">
              <h2>Elections</h2>
              <button class="more btn_more ">Create Election</button>
              <div class="addMore pop_box" id="modal">
  <h2>Create Election</h2>
  <hr>
  <form action="electionForm.php" method="post">
    <label for="description">Description</label>
    <input type="text" name="description" id="description" required>
    <br>
    <label for="num">Number Of Candidates</label>
    <input type="number" name="num" id="num" required>
    <br>
    <div class="btns">
      <button type="submit" id="btnC">Create Election</button>
      <button class="cancel btn_cancel">cancel</button>
    </div>
  </form>
</div>
        </div>
        
      </nav>
    </div>

    <script src="script.js"></script>
  </body>
</html>
