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
    window.location.href = "studentregistration.php";
}

document.getElementById("no-button").onclick = function() { // no-> same page
  modal.style.display = "none";
}

/* END::MODAL */

$(document).ready(function(){


   $("#course_selection").onchange(function () {
    $("#sem_selection").empty();
    $("#sem_selection").append("<option value=''>Not Selected</option>");

    let txt = $(this).val();

    max_sem=txt.substr(0,txt.search('_'));

    course_name = txt.substr(txt.search('_')+1);
    
    for(let itr = 1; itr <= max_sem; itr++)
    {
        $("#sem_selection").append(`<option value='${itr}'>${itr}</option>`);
    }

   });
    
    
    $("#searchstudentbtn").on('click',function () {

        let csrfToken = $("#csrfToken").val();
        let spid = $("#Stud_spid").val();
     
    $.post(
        "api/findglobalstudent.php",
        {
          _spid: spid,
          _ct: csrfToken
        },
        function (data, status) {
          if(status == "success")
          {
           $("#searchstudent").html(data);

           $(".updatebtn").on('click',function () {
            window.location.href = `studentregistration.php?spid=${$(this).attr('id')}`;
           });
        
          $(".deletstudbtn").on('click',function () {
                  
                    $.post(
                    "api/deleteglobalstudent.php",
                    {
                    _em: $(this).attr('id'),
                    _ct: csrfToken
                    },
                    function (data, status) {

                        if(data==1)
                        {
                           window.location.reload(true);
                        }
                        else 
                        {
                          $("#modalmsg").text("Student couldn't be deleted! Try again later.");
                          $("#modal").css("display","flex");
                        }

                    });

          });

          }

      },"text"); // must write as text string will come
  });



    
});