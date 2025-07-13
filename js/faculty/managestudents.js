
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

var spid = "0";

document.getElementById("yes-button").onclick = function () {
  // yes-> redirect to deletion api request

    let csrfTokenVal = $("#csrfToken").val();

    $.post("api/removestudent.php",
    {
    _cid:$("#classroomid").val(),
    _spid: spid,
    _ct:csrfTokenVal,
    },
    function(data){

        if(data==1)
        {
           window.location.reload(true);
        }
        else if(data==-1)
        {
            $("#modalmsg").text("Student attendance record couldn't be deleted! Try again later.");
            $("#yes-button").text("Okay");
            $("#modal").css("display", "flex");
        }
        else
        {   
            $("#modalmsg").text("Student couldn't be deleted! Try again later.");
            $("#yes-button").text("Okay");
            $("#modal").css("display", "flex");
        } 
    }); 

};

document.getElementById("no-button").onclick = function() { // no-> same page
    modal.style.display = "none";
}

/* END::MODAL */



$(document).ready(function(){


  $("#addstudents").click(
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

      let csrfToken = $("#csrfToken").val();
      let classroomid = $("#classroomid").val();

      $.post(
        "api/addstudents.php",
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
              window.location.reload(true);
            }
            else
            {
              $("#modalmsg").text("Student couldn't be added! Try again later.");
              $("#yes-button").text("Okay");
              $("#modal").css("display", "flex");
            }
          }
        });

     }

    });

    $(".removestudent").click(function ()
    {

      spid = $(this).attr("id");
      $("#modalmsg").html("<span style='color:red;text-align:center;'> NOTE: Deletion of this student  includes deletetion of relevant data of attendances!</span><br><br> You can readmit student with new attendance data.<br><br>Do you confirm it?");
      $("#yes-button").text("Delete");
      $("#modal").css("display","flex");

    });

  
  $("#Stud_spid").on('input',function () {

    let csrfToken = $("#csrfToken").val();
    let spid = $("#Stud_spid").val();
    let classroomid = $("#classroomid").val();
    let cur_sem = $("#sem_selection").val();
    let course =  $("#course_selection").val();
    let div = $("#div_selection").val();
    course= course.substr(course.search('_')+1);

    $.post(
      "api/findstudent.php",
      {
        _spid: spid,
        _cid: classroomid,
        _cs:course,
        _dv:div,
        _sm:cur_sem,
        _md:1,
        _ct: csrfToken
      },
      function (data, status) {
        if(status == "success")
        {
         $("#searchstudent").html(data);

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

      }

      },"text"); // must write as text string will come
  });


  $("#fetchall").click(
    function()
    {
      let cur_sem = $("#sem_selection").val();
      let course =  $("#course_selection").val();
      course= course.substr(course.search('_')+1);
      let csrfToken = $("#csrfToken").val();
      let spid = $("#Stud_spid").val();
      let classroomid = $("#classroomid").val();
      let div = $("#div_selection").val();

      $.post(
        "api/findstudent.php",
        {
          _spid: spid,
          _cid: classroomid,
          _cs:course,
          _dv:div,
          _sm:cur_sem,
          _md: 2,
          _ct: csrfToken
        },
        function (data, status) {
          if(status == "success")
          {
           $("#searchstudent").html(data);

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

          }
        },"text"); // must write as text string will come
    }
  );

  $("#course_selection").change(
    function(){

      $("#sem_selection").empty();
      $("#sem_selection").append("<option value='-'>Not Selected</option>");

        let txt = $(this).val();

        max_sem=txt.substr(0,txt.search('_'));

        course_name = txt.substr(txt.search('_')+1);
        
        for(let itr = 1; itr <= max_sem; itr++)
        {
            $("#sem_selection").append(`<option value='${itr}'>${itr}</option>`);
        }

    });

});

function toggleSelect(selectAll)
{
  let checkboxes = document.getElementsByName('select_stud');
  for(i=0;i<checkboxes.length;i++)
    checkboxes[i].checked = selectAll.checked;
}