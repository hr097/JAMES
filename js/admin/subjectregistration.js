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
    window.location.href = "subjectregistration.php";
}

document.getElementById("no-button").onclick = function() { // no-> same page
  modal.style.display = "none";
}

/* END::MODAL */

$(document).ready(function(){

    $("#course_selection").change(function () {
      
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

    $("#searchsubject").on('click',function () {

        let csrfToken = $("#csrfToken").val();
        let sc = $("#subject_code").val();

        if(sc == "")
        {
            sc=0;
        }
     
    $.post(
        "api/findsubject.php",
        {
          _sc: sc,
          _ct: csrfToken
        },
        function (data, status) {
          if(status == "success")
          {
           $("#subjectstable").html(data);

            $(".updatebtn").click(function(){
            window.location.href = `subjectregistration.php?subject_id=${$(this).attr('id')}&opt=updt`;
            });
            
            $(".deletstudbtn").click(function(){
                window.location.href = `subjectregistration.php?subject_id=${$(this).attr('id')}&opt=dlt`;
            });

        }

      },"text"); // must write as text string will come
  });


    
});