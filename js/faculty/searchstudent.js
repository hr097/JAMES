
$(document).ready(function () {
      //Card flip
    var card = document.querySelector(".flip-card");
    card.addEventListener("click", function () {
      card.classList.toggle("is-flipped");
    });
});