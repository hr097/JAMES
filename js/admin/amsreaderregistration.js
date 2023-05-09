/* START::MODAL */

var modal = document.getElementById("modal");
var span = document.getElementsByClassName("close")[0]; //close modal

span.onclick = function() {  //close modal
  modal.style.display = "none";
}
window.onclick = function(event) {//close modal anywhere click
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

document.getElementById("yes-button").onclick = function() { // yes-> redirect
    window.location.href = "amsreaderregistration.php";
}

document.getElementById("no-button").onclick = function() { // no-> same page
  modal.style.display = "none";
}

/* END::MODAL */

$(document).ready(function(){

    $(".deletereader").click(function(){

        let reader_id = $(this).attr("id");
        let csrfTokenVal = $("#csrfToken").val();

        $.post("api/deleteamsreader.php",
        {
        _rid:reader_id,
        _ct:csrfTokenVal,
        },
        function(data){
    
            if(data==1)
            {
               window.location.reload(true);
            }
            else 
            {
              $("#modalmsg").text("Reader couldn't be deleted! Try again later.");
              $("#modal").css("display","flex");
            }
        }); 
    });

});