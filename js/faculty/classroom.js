
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

document.getElementById("yes-button").onclick = function () {
  // yes-> redirect to deletion api request

  let csrfTokenVal = $("#csrfToken").val();
    $.post("api/deleteclassroom.php",
    {
    _cid:$("#classroomid").val(),
    _ct:csrfTokenVal,
    },
    function(data){

        if(data==1)
        {
            window.location.href = "./dashboard.php";
        }
        else
        {   
            $("#modalmsg").text("Classroom couldn't be deleted! Try again later.");
            $("#modal").css("display","block");
        } 
    }); 

};

document.getElementById("no-button").onclick = function() { // no-> same page
    modal.style.display = "none";
}

/* END::MODAL */

$(document).ready(function(){

$("#modifyclass").click(function(){
    const classroomid = $("#classroomid").val();
    window.location.href = `editclassroom.php?classroomid=${classroomid}`;
});

$("#addfaculty").click(function(){
    const classroomid = $("#classroomid").val();
    window.location.href = `addfaculty.php?classroomid=${classroomid}`;
});

$("#deleteclass").click(function(){
    $("#modalmsg").text("Deletion of this classroom includes deletetion of relevant data of students,faculty and attendances!<br><br><span style='color:red;'>NOTE: This operation cannot be reversed.</span><br><br>Do you confirm it?");
    $("#modal").css("display", "block");
});

$("#classmode").click(function(){

    let csrfTokenVal = $("#csrfToken").val();
    $.post("api/changeclassmode.php",
    {
    _cid:$("#classroomid").val(),
    _ct:csrfTokenVal,
    },
    function(data){

        if(data==1)
        {
            window.location.href = "./archivedclassrooms.php";
        }
        else
        {
            window.location.href = "./dashboard.php";
        } 
    }); 
})

});