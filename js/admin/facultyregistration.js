/* START::MODAL */

var modal = document.getElementById("modal");
var span = document.getElementsByClassName("close")[0]; //close modal

span.onclick = function() {  //close modal
  modal.style.display = "none";
}

var fac_dlt_flag = false;
var fac_email = "";

window.onclick = function(event) {//close modal anywhere click
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

document.getElementById("yes-button").onclick = function() { // yes-> redirect

    if(fac_dlt_flag==true)
    {

        let csrfToken = $("#csrfToken").val();
        let fac_email = $("#facemail").val();

        $.post(
            "api/deletefaculty.php",
            {
            _em: fac_email,
            _ct: csrfToken
            },
            function (data, status) {
                
                fac_dlt_flag=false;
                if(data==1)
                {
                   window.location.reload(true);
                }
                else 
                {
                  $("#modalmsg").text("Faculty couldn't be deleted! Try again later.");
                  $("#modal").css("display","flex");
                }

            });
    }
    else
    {
    window.location.href = "facultyregistration.php";
    }
}

document.getElementById("no-button").onclick = function() { // no-> same page
  modal.style.display = "none";
}

/* END::MODAL */

$(document).ready(function(){


    $("#searchfacultybtn").on('click',function () {

        let csrfToken = $("#csrfToken").val();
        let email = $("#facsearchemail").val();
     
    $.post(
        "api/findfaculty.php",
        {
          _em: email,
          _ct: csrfToken
        },
        function (data, status) {
          if(status == "success")
          {
           $("#searchfaculty").html(data);

           $(".updatebtn").on('click',function () {
            window.location.href = `facultyregistration.php?email=${$(this).attr('id')}`;
           });
        
           $(".deletstudbtn").on('click',function () {
                fac_dlt_flag=true;

                fac_email =  $(this).attr('id');
                $("#modalmsg").html("Deletion of Faculty account includes deletetion of relevant data of classrooms,students and attendances!<br><br><span style='color:red;text-align:center;'>NOTE: This operation cannot be undone.</span><br><br>Do you confirm it?");
                $("#modal").css("display","flex");
          });

          }

      },"text"); // must write as text string will come
  });
});