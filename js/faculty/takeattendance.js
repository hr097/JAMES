
/* START::MODAL 1*/

var modal = document.getElementById("modal");
var span = document.getElementsByClassName("close")[0]; //close modal
var submit_flag = false;

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

if(submit_flag)
{
  let i=0;
  const stud_len = $(".student").length;
  const students_list1 = [];
  const students_list2 = [];

   for(i=0;i<stud_len;i++)
   {
      if($($($(".student").find("input")[i])).is(':checked')==true)
      {
        students_list1.push($($(".student").find("input")[i]).attr("id"));
      }
      else
      {
        students_list2.push($($(".student").find("input")[i]).attr("id"));
      }
   }
  
   if(students_list1.length>1||students_list2.length>1)
   {
    
    let csrfToken = $("#csrfToken").val();
    let classroomid = $("#classroomid").val();
    let fid = $("#fid").val();

    $.post(
      "api/submitattendance.php",
      {
        _prstudls: students_list1,
        _abstudls: students_list2,
        _fid:fid,
        _cid: classroomid,
        _ct: csrfToken
      },
      function (data, status) {

        if(status == "success")
        {
          if(data==11)
          {
              $("#modalmsg").text("Student attendance submitted successfully.");
              $("#modal").css("display","block");
              submit_flag=false;
          }
          else
          {
             $("#modalmsg").text("Student attendance couldn't be submitted! Try again later.");
             $("#modal").css("display","block");
             submit_flag=false;
          }
        }
      });

   }
}
else
{
  modal.style.display = "none";
}

};

document.getElementById("no-button").onclick = function() { // no-> same page
    modal.style.display = "none";
}

/* END::MODAL 1 */

$(document).ready(function(){

    $("#submitattendance").click(
        function(){
        submit_flag= true;  
        $("#modalmsg").html("Are you sure about this? Attendance cannot be modified once submitted.<br><br>Do you confirm it?"); 
        $("#modal").css("display", "block");

    });

    $(".student").click(
        function()
        {
          $("#order-listing").DataTable().destroy();
          
          if($($($(this).find("input")[0])).is(':checked')==true)
          {
            $($(this).find("input")[0]).removeAttr("checked");
            $($(this).find("input")[0]).siblings()[0].innerHTML = "0";
            $('#order-listing').DataTable({
              "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
              ],
              "order":[],
              "iDisplayLength": 10,
              "language": {
                search: ""
              }
            });

            //$($(this).find("input")[0]).siblings()[0].text();

          }
          else 
          {
            $($(this).find("input")[0]).attr("checked","true");
            $($(this).find("input")[0]).siblings()[0].innerHTML = "1";
            $('#order-listing').DataTable({
              "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
              ],
              "order":[],
              "iDisplayLength": 10,
              "language": {
                search: ""
              }
            });

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