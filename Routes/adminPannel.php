<?php
session_start();
if ($_SESSION['userdata']['Role'] !== 'admin') {
  header('location: ../Routes/loginPage.html');
  exit;
}

include('../api/connect.php');

$userdata = $_SESSION['userdata'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SecureVote - Online Voting Platform</title>
  <link rel="stylesheet" href="../css/Home.css" />
</head>

<body>
  <div class="container">
    <header>
      <figure>
        <img src="../img/use.png" alt="" />
      </figure>
      <h2 id='title'>SecureVote - Online Voting Platform</h2>
      <div class="welcome">
        <h3>Welcome, <span id='user'>
            <?php echo $userdata['Full_Name']; ?>
          </span></h3>
        <a href="../api/logout.php" id="logout">LogOut</a>
      </div>
    </header>
    <nav>
      <ul>
        <li><a href="" class="btn active">DashBoard</a></li>
        <li class="manage">
          <p>Manage</p>
        </li>
        <li><a href="./dashBoard/position.php" class="btn">Position</a></li>
        <li><a href="./dashBoard/candidate.php" class="btn">Candidate</a></li>
        <li><a href="./dashBoard/voter.php" class="btn">Voters</a></li>
        <li>
          <a href="./dashBoard/pendingVoter.php" class="btn">PendingVoters</a>
        </li>
      </ul>
      <div class="main">
        <div class="container">
          <div class="currentElections">
            <div class="candidates"></div>
          </div>

        </div>
      </div>
    </nav>
  </div>

  <script src="script.js"></script>
</body>

</html>