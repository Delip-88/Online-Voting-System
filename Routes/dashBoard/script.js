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
