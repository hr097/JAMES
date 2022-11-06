
$(document).ready(function(){
   // Delete Table Row
   function DeleteRow(o) {
    var td = event.target.parentNode;
    var tr = td.parentNode; // the row to be removed
    tr.parentNode.removeChild(tr);
  }

  // document.getElementById('add_stud_tbl').style.display = "none";
  // Search Student
  function Search() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("Stud_spid");
    filter = input.value.toUpperCase();
    table = document.getElementById("order-listing1");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
});