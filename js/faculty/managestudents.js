
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
        "api/findstudent.php",
        {
          _studls: students_list,
          _cid: classroomid,
          _ct: csrfToken
        },
        function (data, status) {
          if(status == "success")
          {
           alert(data);
          }
        });

     }

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

   // Delete Table Row
  //  function DeleteRow(o) {
  //   var td = event.target.parentNode;
  //   var tr = td.parentNode; // the row to be removed
  //   tr.parentNode.removeChild(tr);
  // }

  // document.getElementById('add_stud_tbl').style.display = "none";
  // Search Student
  // function Search() {
  //   var input, filter, table, tr, td, i, txtValue;
  //   input = document.getElementById("Stud_spid");
  //   filter = input.value.toUpperCase();
  //   table = document.getElementById("order-listing1");
  //   tr = table.getElementsByTagName("tr");
  //   for (i = 0; i < tr.length; i++) {
  //     td = tr[i].getElementsByTagName("td")[0];
  //     if (td) {
  //       txtValue = td.textContent || td.innerText;
  //       if (txtValue.toUpperCase().indexOf(filter) > -1) {
  //         tr[i].style.display = "";
  //       } else {
  //         tr[i].style.display = "none";
  //       }
  //     }
  //   }
  // }
   
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