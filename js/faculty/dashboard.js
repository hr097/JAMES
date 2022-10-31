//! THIS IS REMAINING [`PAGE

var course_name = "";

$(document).ready(function(){


    const h = new Date().getHours(); 

    curyear = new Date().getFullYear();

    let cur_year_html = "<option value=''>Not Selected</option>";

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

    $(".classroom").click(function(){
        window.location.href = `classroom.php?course=${encodeURIComponent($(this).attr('id'))}
        &year=${encodeURIComponent($($(this).find("p")[0]).attr("id"))}
        &subject=${encodeURIComponent( $($(this).find("p")[1]).attr("id"))}    
        &semester=${encodeURIComponent( $($(this).find("p")[2]).attr("id"))} 
        &division=${encodeURIComponent( $($(this).find("p")[3]).attr("id"))}    
        `;
    });

    $("#curyear").change(
        function(){
            var value = $(this).val();
            $("#classroomlist div").filter(function() {
                  $(this).toggle($(this).text().indexOf(value) > -1)
            });
    });

    $("#sem_selection").change(
        function()
        {
            var value = "Semester :  "+$(this).val();
            $("#classroomlist div").filter(function() {
                  $(this).toggle($(this).text().indexOf(value) > -1);     
            });
        }
    );

    $("#div_selection").change(
        function()
        {
            var value = "Division :  "+$(this).val();
            $("#classroomlist div").filter(function() {
                  $(this).toggle($(this).text().indexOf(value) > -1);
            });
        }
    );

    $("#course_selection").change(
        function(){

           $("#sem_selection").empty();
           $("#sem_selection").append("<option value=''>Not Selected</option>");

            let txt = $(this).val();

            max_sem=txt.substr(0,txt.search('_'));

            course_name = txt.substr(txt.search('_')+1);

            var value = course_name+"-"+$("#curyear").val();

            $("#classroomlist div").filter(function() {
                  $(this).toggle($(this).text().indexOf(value) > -1)
            });
            
            for(let itr = 1; itr <= max_sem; itr++)
            {
                $("#sem_selection").append(`<option value='${itr}'>${itr}</option>`);
            }

    });

});





