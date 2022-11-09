/* START::MODAL */

var modal = document.getElementById("modal");
var span = document.getElementsByClassName("close")[0]; //close modal

span.onclick = function () {
  //close modal
  modal.style.display = "none";
};
window.onclick = function (event) {
  //close modal anywhere click
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

var fid = "0";

document.getElementById("yes-button").onclick = function () {
  // yes-> redirect to deletion api request

    let csrfTokenVal = $("#csrfToken").val();

    $.post("api/removefaculty.php",
    {
    _cid:$("#classroomid").val(),
    _fid: fid,
    _ct:csrfTokenVal,
    },
    function(data){

        if(data==1)
        {
           window.location.reload(true);
        }
        else 
        {
          $("#modalmsg").text("Faculty access couldn't be removed! Try again later.");
          $("#modal").css("display","block");
        }
    }); 

};

document.getElementById("no-button").onclick = function() { // no-> same page
    modal.style.display = "none";
}

/* END::MODAL */


var fid = "0";

$(document).ready(function(){


    $(".removefaculty").click(function ()
    {

      fid = $(this).attr("id");
      $("#modalmsg").html("Are you sure you want to remove access for selected faculty?<br><br>Do you confirm it?");
      $("#yes-button").text("Delete");
      $("#modal").css("display", "block");

    });

});