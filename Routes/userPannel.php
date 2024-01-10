<?php
$timeout = 24 * 60 * 60; //24 hours in seconds
session_set_cookie_params($timeout);
session_start();
if ($_SESSION['userdata']['Role'] !== 'user') {
  header('location: ../Routes/loginPage.html');
}
$userdata = $_SESSION['userdata'];
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
      <h3>Welcome, <span id="user">
          <?php echo $userdata['Full_Name']; ?>
        </span></h3>
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
        <p>Name : <span class="Name">
            <?php echo $userdata['Full_Name'] ?>
          </span></p>
        <p>Number : <span class="Number">
            <?php echo $userdata['Number'] ?>
          </span></p>
        <p>Address : <span class="Address">
            <?php echo $userdata['Address'] ?>
          </span></p>
        <p>status : <span class="Status">
            <?php echo $userdata['Role'] ?>
          </span></p>
      </div>

    </div>
    <div class="elections">
      <h3>Current Elections</h3>
      <hr>
      <div class="main">
        <div class="items">
          <?php
          include("../api/connect.php");

          // Fetch election titles
          $queryElection = "SELECT Title, Status FROM election";
          $resultElection = mysqli_query($connect, $queryElection);

          while ($rowElection = mysqli_fetch_assoc($resultElection)) {
            // Display election title
            if ($rowElection['Status'] === 'Ongoing') {
              echo "<h2>Title : <span class='title'>{$rowElection['Title']} </span> </h2>";
              $electionTitle = $rowElection['Title'];

              // Fetching election title
              $queryCandidates = "SELECT * FROM candidate WHERE Position = ?";
              $stmtCandidates = mysqli_prepare($connect, $queryCandidates);
              mysqli_stmt_bind_param($stmtCandidates, 's', $electionTitle);
              mysqli_stmt_execute($stmtCandidates);
              $resultCandidates = mysqli_stmt_get_result($stmtCandidates);

              // Check if there are candidates before displaying the container
              if (mysqli_num_rows($resultCandidates) > 0) {
                echo "<div class='cardContainer'>";
                // candidate information fetching and displaying
                while ($rowCandidate = mysqli_fetch_assoc($resultCandidates)) {
                  echo "<div class='eCard'>";
                  echo "<div class='user-image'>";
                  echo "<img src='../uploads/{$rowCandidate['Image']}' alt='Candidate Image'>";
                  echo "</div>";
                  echo "<strong>Full Name: {$rowCandidate['Full_Name']}</strong>";
                  echo "<small>Description: {$rowCandidate['Description']}</small>";
                  echo "<form method='post'>
                            <input type='hidden' name='candidate' value='1'>
                            <button type='submit' class='voteBtn'> Vote </button>
                            ";
                  echo "</div>"; // Close the candidate card here
                }
                echo "</div>"; // Close the cardContainer only if there are candidates
              }

              mysqli_stmt_close($stmtCandidates);
            }
          }

          // Close the database connection if necessary
          mysqli_close($connect);
          ?>


        </div>

      </div>
    </div>
  </div>
</body>

</html>