<?php
session_start();
if ($_SESSION['userdata']['Role'] !== 'admin') {
  header('location: ../loginPage.html');
  exit;
}

include("../../api/connect.php");
$userdata = $_SESSION['userdata'];

// Fetch user data from the database
$query = "SELECT * FROM election";
$result = mysqli_query($connect, $query);

// Check if the query was successful
if (!$result) {
  die("Query failed: " . mysqli_error($connect));
}
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
        <h3>Welcome, <span id='user'>
            <?php echo $userdata['Full_Name']; ?>
          </span></h3>
        <a href="../../api/logout.php" id="logout">LogOut</a>
      </div>
    </header>
    <nav>
      <ul>
        <li><a href="../adminPannel.php" class="btn">DashBoard</a></li>
        <li class="manage">
          <p>Manage</p>
        </li>
        <li><a href="position.php" class="btn active">Position/Election</a></li>
        <li><a href="candidate.php" class="btn">Candidate</a></li>
        <li><a href="voter.php" class="btn">Voters</a></li>
        <li><a href="pendingVoter.php" class="btn">PendingVoters</a></li>
      </ul>
      <div class="main">
        <h3>Elections</h3>
        <hr>
        <button class="more btn_more ">Create Election</button>
        <div class="elections">

          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='eCard'> ";
            echo "<h2>Election Title : {$row['Title']} </h2>";
            echo "<p class='stDate'>Starting Date: {$row['StartDate']} </p>";
            echo "<p class='endDate'>Ending Date: {$row['EndDate']} </p>";
            echo "<p class='status'></p>";
            echo "
            <form action='../../api/process_action.php' method='post'>
            <input type='hidden' name='user_id' value='{$row['Id']}'>
            <input type='hidden' name='originating_page' value='election'>
            <button type='submit' name='reject' class='reject delete'>Delete</button>
            </form>
            ";
            echo "</div>";
          }
          ?>

        </div>


        <div class="addMore pop_box" id="modal">
          <h2>Create Election</h2>
          <hr>
          <form action="../../api/electionForm.php" method="post" class="pos" id="adC">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
            <br>
            <label for="startDate">Starting Date & Time : </label>
            <input type="datetime-local" name="startDate" id="startDate">
            <br>
            <label for="endDate">Closing Date & Time : </label>
            <input type="datetime-local" name="endDate" id="endDate">
            <br>

            <div class="btns">
              <button type="submit" id="btnC">Create Election</button>
              <button type="reset" class="cancel btn_cancel">cancel</button>
            </div>
          </form>
        </div>
      </div>

    </nav>
  </div>

  <script src="script.js"></script>
</body>

</html>