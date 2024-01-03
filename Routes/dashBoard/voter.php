<?php
session_start();
if ($_SESSION['userdata']['Role'] !== 'admin') {
  header('location: ../loginPage.html');
  exit;
}

$userdata = $_SESSION['userdata'];

// Fetch user data from the database
include('../../api/connect.php');
$query = "SELECT * FROM validuser";
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
        <li><a href="position.php" class="btn">Position</a></li>
        <li><a href="candidate.php" class="btn">Candidate</a></li>
        <li><a href="voter.php" class="btn active">Voters</a></li>
        <li><a href="pendingVoter.php" class="btn">PendingVoters</a></li>
      </ul>
      <div class="main">
        <h3>User List</h3>
        <hr>
        <div class="table-container">

          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Full Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['Id']}</td>";
                echo "<td><img class='user-image' src='../../uploads/{$row['Image']}' alt='User Image'></td>";
                echo "<td>{$row['Full_Name']}</td>";
                echo "<td>{$row['Number']}</td>";
                echo "<td>{$row['Email']}</td>";
                echo "<td>{$row['Address']}</td>";
                echo "<td>{$row['Role']}</td>";
                echo "<td>
        <form action='../../api/process_action.php' method='post'>
            <input type='hidden' name='user_id' value='{$row['Id']}'>
            <input type='hidden' name='originating_page' value='voter'>
            <button type='submit' name='reject' class='reject'>Delete</button>
        </form>
      </td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </nav>
  </div>

  <script src="script.js"></script>
</body>

</html>