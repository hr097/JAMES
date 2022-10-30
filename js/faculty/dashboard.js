//! THIS IS REMAINING [`PAGE


$(document).ready(function(){


    
    const h = new Date().getHours(); 

    curyear = new Date().getFullYear();

    let cur_year_html = "";

    for(let i=0;i<10;i++) 
    {
        cur_year_html += `<option value="${curyear}">${curyear}</option>`;
        curyear--;
    }

    $("#curyear").append(cur_year_html);

    if(h<11)
    {
        $("#daymode").text("Good Morning,");
    }
    else if(h<17)
    {
        $("#daymode").text("Good Afternoon,");
    }
    else
    {
        $("#daymode").text("Good Evening,");
    }

    // $(".subjects").click(function(){
    //     window.location.href = `subjectattendance.php?subject=${encodeURIComponent($(this).attr('id'))}&faculty=${encodeURIComponent(
    //         $($(this).find("p")[2]).attr("id") 
    //     )}`;
    // });


    $("#course_selection").change(
        function(){

            var value = $(this).val().toLowerCase();
            $("#classroomlist div").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

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





