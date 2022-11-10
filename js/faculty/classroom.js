
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

    $(".sendnotice").click(
        function()
        {
            let email = $(this).attr("id");
            let classroomid = $("#classroomid").val();
            let csrfTokenVal = $("#csrfToken").val();

            $.post(
                "api/sendnotice.php",
                {
                  _cid: classroomid,
                  _eid: email,
                  _ct: csrfTokenVal
                },
                function (data, status) {
                  
                  if(status == "success")
                  {
                    response = parseInt(data);
  
                    $("#modal").css("display","block");
                    $("#yes-button").text("Okay");
  
                    if(response === 0)
                    {
                      $("#modalmsg").text("Sorry,Notice couldn't be sent!");
                    }
                    else if (response === 1)
                    {
                      $("#modalmsg").text("Notice has been sent successfully.");
                    }
                    else
                    {
                        $("#modalmsg").text(
                            "Try again later! Some unknown error occured."
                        );
                    }

                  }
                  else
                  { 
                    $("#modal").css("display", "block");
                    $("#modalmsg").text(
                      "Try again later! Some unknown error occured."
                    );
                    $("#yes-button").text("Okay");
                  }
        });

    });
    

$("#modifyclass").click(function(){
    const classroomid = $("#classroomid").val();
    window.location.href = `managestudents.php?classroomid=${classroomid}`;
});

$("#addfaculty").click(function(){
    const classroomid = $("#classroomid").val();
    window.location.href = `managefaculty.php?classroomid=${classroomid}`;
});

$("#deleteclass").click(function(){
    $("#modalmsg").html("Deletion of this classroom includes deletetion of relevant data of students,faculty and attendances!<br><br><span style='color:red;text-align:center;'>NOTE: This operation cannot be undone.</span><br><br>Do you confirm it?");
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