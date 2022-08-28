/* START:modal code */

var modal = document.getElementById("modal");
var forgetPasswordBtn = document.getElementById("forgotpassword");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

//  open the modal 
forgetPasswordBtn.onclick = function() {
  modal.style.display = "block";
}

// click on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// click anywhere outside of the modal close modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Redirect when button with id "yes-button" is clicked

document.getElementById("yes-button").onclick = function() {
  window.location.href = "forgotpassword.php";
}

// Close modal when button with id "no-button" is clicked
document.getElementById("no-button").onclick = function() {
  modal.style.display = "none";
}

/* END: modal code */