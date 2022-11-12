
/* START::MODAL 1*/

var modal = document.getElementById("modal");
var span = document.getElementsByClassName("close")[0]; //close modal
var submit_flag = false;
var fetch_att_flag = false;
var fetch_att_flag2 = false;

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

    if(students_list1.length<1)
    {
      students_list1.push(" ");
    }

    
    if(students_list2.length<1)
    {
      students_list2.push(" ");
    }

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
          if(data==11|data==1)
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
else if(fetch_att_flag==true)
{
  fetch_att_flag=false;
  modal.style.display = "none";
}
else if(fetch_att_flag2==true)
{

  fetch_att_flag2=false;
}
else
{
  window.location.reload();
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

    $("#TakeattButton").click(
      function(){
      fetch_att_flag= true; 
      let reader = $("#reader_selection").val();
      let curdate = $("#currdate").val();
      let time1 = $("#fromtime").val();
      let time2 = $("#totime").val();
      let csrfToken = $("#csrfToken").val();
      
      if(reader=="0")
      {
        $("#modalmsg").html("Please select a classroom number!"); 
        $("#modal").css("display", "block");
      }
      else if(curdate=="")
      {
        $("#modalmsg").html("Please select a valid date!"); 
        $("#modal").css("display", "block");
      }
      else if(time1=="")
      {
        $("#modalmsg").html("Please select a valid \" FROM \" time!"); 
        $("#modal").css("display", "block");
      }
      else if(time2=="")
      {
        $("#modalmsg").html("Please select a valid \" TO \" time!"); 
        $("#modal").css("display", "block");
      }
      else
      {
        fetch_att_flag2=true;
        $.post(
          "api/fetchattendance.php",
          {
            _r_no:reader,
            _dt:curdate ,
            _toti:time1,
            _froti: time2,
            _ct: csrfToken
          },
          function (data, status) {
    
            if(status == "success")
            {   
              student_list = JSON.parse(data);

              if(student_list.response==-1)
              {
                $("#modalmsg").text("Something went wrong! Try again later.");
                $("#modal").css("display","block");
              }
              else if(student_list.response==0)
              {
                $("#modalmsg").text("No latest attendance found in classroom!");
                $("#modal").css("display","block");
              }
              else
              {   
                 let st_ls_len = student_list.response.length;

                 for(let i=0;i<st_ls_len;i++)
                 {
                   $(`#${student_list.response[i]}`).attr("checked",true);
                   $(`#${student_list.response[i]}`).siblings()[0].innerHTML = "1";
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

            }
          },"text");//MUST specify it
    
      }
      
      

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