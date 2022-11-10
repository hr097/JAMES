
/* START::MODAL 1*/

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


var notice_flag = false;

document.getElementById("yes-button").onclick = function () {
  // yes-> redirect to deletion api request

  if(notice_flag==true)
  {
    modal.style.display = "none";
    notice_flag=false;
  }
  else
  {
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
  }

};

document.getElementById("no-button").onclick = function() { // no-> same page
    modal.style.display = "none";
}

/* END::MODAL 1 */

$(document).ready(function(){

    $("#submitattendance").click(
        function(){
    
        let i=0;
        const stud_len = $(".student").length;
        const students_list = [];
    
         for(i=0;i<stud_len;i++)
         {
            if($($($(".student").find("input")[i])).is(':checked')==true)
            {
              students_list.push($($(".student").find("input")[i]).attr("id"));
            }
         }
        
         if(students_list.length!=0)
         {
            
          alert(students_list);//! remove

          let csrfToken = $("#csrfToken").val();
          let classroomid = $("#classroomid").val();
    
          $.post(
            "api/submitattendance.php",
            {
              _studls: students_list,
              _cid: classroomid,
              _ct: csrfToken
            },
            function (data, status) {
    
              if(status == "success")
              {
                if(data==1)
                {
                    $("#modalmsg").text("Student attendance submitted successfully.");
                    $("#modal").css("display","block");
                }
                else
                {
                  $("#modalmsg").text("Student attendance couldn't be submitted! Try again later.");
                  $("#modal").css("display","block");
                }
              }
            });
    
         }
    
    });

    $(".student").click(
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

});

function toggleSelect(selectAll)
{
  let checkboxes = document.getElementsByName('select_stud');
  for(i=0;i<checkboxes.length;i++)
    checkboxes[i].checked = selectAll.checked;
}