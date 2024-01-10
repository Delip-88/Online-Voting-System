// Function to update election status dynamically
function updateElectionStatus() {
  // logic to determine the current status (e.g., closed, ongoing, inactive)
  const stats = document.querySelectorAll(".status");
  const openedDate = document.querySelectorAll(".stDate");
  const closingDate = document.querySelectorAll(".endDate");
  const currentDateTIme = new Date();

  stats.forEach((e, index) => {
    const openedDateTimeObj = new Date(openedDate[index].textContent);
    const closingDateTimeObj = new Date(closingDate[index].textContent);
    let newStatus;
    if (currentDateTIme < openedDateTimeObj) {
      newStatus = "Inactive";
      e.textContent = newStatus;
      e.parentNode.parentNode.classList.add("inactive");
    } else if (
      currentDateTIme >= openedDateTimeObj &&
      currentDateTIme <= closingDateTimeObj
    ) {
      newStatus = "Ongoing";
      e.textContent = newStatus;
      e.parentNode.parentNode.classList.add("Ongoing");
    } else {
      newStatus = "Closed";
      e.textContent = newStatus;
      e.parentNode.parentNode.classList.add("closed");
    }

    // Update the text content of an HTML element with the new election status
    $("#status").text(newStatus);

    // Make an AJAX request to update the database
    $.ajax({
      type: "POST", // HTTP method for the request
      url: "../../api/updateElectionStatus.php", // Server-side script to handle the request
      data: {
        electionTitle: "<?php echo $electionTitle; ?>", // Data to be sent to the server
        newStatus: newStatus,
      },
      success: function (response) {
        console.log("Database updated successfully");
      },
      error: function (error) {
        console.error("Error updating database: " + error);
      },
    });
  });
}

// Call the function when the document is ready or whenever needed
$(document).ready(function () {
  updateElectionStatus();
});
