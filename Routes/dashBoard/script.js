function previewImage(input) {
  var fileInput = input.files[0];

  if (fileInput) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var imagePreview = document.getElementById("imagePreview");
      imagePreview.innerHTML =
        '<img src="' +
        e.target.result +
        '" alt="Image Preview" style="width:100%; height:100%; border-radius:10px; object-fit:cover;" >';
    };

    reader.readAsDataURL(fileInput);
  }
}
const btnShow = document.querySelector(".btn_more");
const btnHide = document.querySelector(".btn_cancel");
const popUpBox = document.querySelector(".pop_box");
function openModal() {
  popUpBox.classList.toggle("visible");
}
function closeModal() {
  popUpBox.classList.remove("visible");
}

btnShow.addEventListener("click", openModal);
btnHide.addEventListener("click", closeModal);

//Function to update status based on time

function updateStatus() {
  // Date Calculations/Operations

  const stats = document.querySelectorAll(".status");
  const openedDate = document.querySelectorAll(".stDate");
  const closingDate = document.querySelectorAll(".endDate");
  const currentDateTIme = new Date();

  stats.forEach((e, index) => {
    const openedDateTimeObj = new Date(openedDate[index].textContent);
    const closignDateTimeObj = new Date(closingDate[index].textContent);

    if (currentDateTIme < openedDateTimeObj) {
      e.textContent = "Status : Inactive";
      e.parentNode.classList.add("inactive");
    } else if (
      currentDateTIme >= openedDateTimeObj &&
      currentDateTIme <= closignDateTimeObj
    ) {
      e.textContent = "Status : Ongoing";
      e.parentNode.classList.add("running");
    } else {
      e.textContent = "Status : Closed";
      e.parentNode.classList.add("closed");
    }
  });
}

// Initial check when the page loads
window.addEventListener("load", updateStatus);
