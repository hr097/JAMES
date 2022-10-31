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
    window.location.href = "../dashboard.php";
  }
};

document.getElementById("yes-button").onclick = function () {
  // yes-> redirect
  window.location.href = "./dashboard.php";
};

/* END::MODAL */


$(document).ready(function(){
     
    let curdate = new Date();

    $("#curryear").attr("value",curdate.getFullYear()+"-"+ (curdate.getMonth()+1) );

    $("#course_selection").change(
        function(){

          $("#sem_selection").empty();
          $("#sub_selection").empty();
          $("#sub_selection").append(`<option value=''>Not Selected</option>`);
          $("#sem_selection").append("<option value=''>Not Selected</option>");

            let txt = $(this).val();

            max_sem=txt.substr(0,txt.search('_'));

            course_name = txt.substr(txt.search('_')+1);
            
            for(let itr = 1; itr <= max_sem; itr++)
            {
                $("#sem_selection").append(`<option value='${itr}'>${itr}</option>`);
            }

            $("#sem_selection").change(
                
                function()
                {    

                    let csrfTokenVal = $("#csrfToken").val();
                    
                    $.post("api/getsubjects.php",
                    {
                    _cn:course_name,
                    _ct:csrfTokenVal,
                    _sm: $(this).val()
                    },
                    function(data){
                        $("#sub_selection").empty();
                        $("#sub_selection").append(data);
                    },"text"); // must specify text

                }
                
            );
        });

        $("#createclass").click(
            function()
            {   
                let csrfTokenVal = $("#csrfToken").val();

                txts = $("#course_selection").val();

                cn = txts.substr(txts.search('_')+1);
                sub = $("#sub_selection").val();
                dv = $("#div_selection").val();
                cd = new Date();
                cy = cd.getFullYear();

                if(cn!=""&&sub!=""&&dv!=""&&cy!="")
                {

                    $.post("api/createclassroom.php",
                    {
                    _cn:cn,
                    _sb:sub,
                    _dv:dv,
                    _cy:cy,
                    _ct:csrfTokenVal,
                    },
                    function(data){
                        
                    $("#modal").css("display", "block");

                    if(data==1)
                    {
                        $("#modalmsg").text("Classroom successfully created.");
                        $("#yes-button").text("Okay");
                        //! redirection remains to modify page where students and faculty will be added
                    }
                    else if(data==0)
                    {
                        $("#modalmsg").text("Classroom already exists. Kindly Confirm with JPD AMS ADMIN.");
                        $("#yes-button").text("Okay");
                    }
                    else
                    {
                        $("#modalmsg").text("Some Unknown Error Occured!");
                        $("#yes-button").text("Okay");
                    }
                    }); // must specify text

                }
            }
        );

});