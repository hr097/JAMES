
$(document).ready(function(){

  $("#Stud_spid").on('input',function () {

    let csrfToken = $("#csrfToken").val();
    let spid = $("#Stud_spid").val();
    let classroomid = $("#classroomid").val();

    $.post(
      "api/findstudent.php",
      {
        _spid: spid,
        _cid: classroomid,
        _ct: csrfToken
      },
      function (data, status) {
        if(status == "success")
        {
         $("#searchstudent").html(data);
        }
      },"text"); // must write as text string will come
  });

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
      $("#sem_selection").append("<option value=''>Not Selected</option>");

        let txt = $(this).val();

        max_sem=txt.substr(0,txt.search('_'));

        course_name = txt.substr(txt.search('_')+1);
        
        for(let itr = 1; itr <= max_sem; itr++)
        {
            $("#sem_selection").append(`<option value='${itr}'>${itr}</option>`);
        }

    });

});