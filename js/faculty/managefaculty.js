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

    $("#addfaculty").click(
        function(){
    
        let i=0;
        const fac_len = $(".faculty").length;
        const faculty_list = [];
    
         for(i=0;i<fac_len;i++)
         {
            if($($($(".faculty").find("input")[i])).is(':checked')==true)
            {
              faculty_list.push($($(".faculty").find("input")[i]).attr("id"));
            }
         }
        
         if(faculty_list.length!=0)
         {
    
          let csrfToken = $("#csrfToken").val();
          let classroomid = $("#classroomid").val();
    
          $.post(
            "api/addfacultyaccess.php",
            {
              _facls: faculty_list,
              _cid: classroomid,
              _ct: csrfToken
            },
            function (data, status) {
    
              if(status == "success")
              {
                if(data==1)
                {
                  window.location.reload(true);
                }
                else
                {
                  $("#modalmsg").text("Faculty couldn't be added! Try again later.");
                  $("#yes-button").text("Okay");
                  $("#modal").css("display","block");
                }
              }
            });
    
         }
    
    });

    $(".removefaculty").click(function ()
    {

      fid = $(this).attr("id");
      $("#modalmsg").html("Are you sure you want to remove access of selected faculty from this classroom?<br><br>Do you confirm it?");
      $("#yes-button").text("Delete");
      $("#modal").css("display", "flex");

    });

    $("#Fac_fid").on('input',function () {

        let csrfToken = $("#csrfToken").val();
        let fid = $("#Fac_fid").val();
        let classroomid = $("#classroomid").val();
    
        $.post(
          "api/findfaculty.php",
          {
            _fid: fid,
            _cid: classroomid,
            _ct: csrfToken
          },
          function (data, status) {
            if(status == "success")
            {
             $("#searchfaculty").html(data);
    
             $(".faculty").click(
              function()
              { 
                if($($($(this).find("input")[0])).is(':checked')==true)
                {
                  $($(this).find("input")[0]).removeAttr("checked");
                }
                else
                {
                  $($(this).find("input")[0]).attr("checked","true");
                }
               
              }
            );
    
          }
    
          },"text"); // must write as text string will come
      });
    
});

function toggleSelect(selectAll)
{
  let checkboxes = document.getElementsByName('select_stud');
  for(i=0;i<checkboxes.length;i++)
    checkboxes[i].checked = selectAll.checked;
}