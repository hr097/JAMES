
$(document).ready(function(){

 curyear = new Date().getFullYear();

 let cur_year_html = "";

 for(let i=0;i<10;i++) 
 {
     cur_year_html += `<option value="${curyear}">${curyear}</option>`;
     curyear--;
 }

 $("#curyear").append(cur_year_html);
 
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
        var value = $(this).val();
        $("#classroomlist div").filter(function() {
              $(this).toggle($(this).text().indexOf(value) > -1)
        });
    }
);

$("#div_selection").change(
    function()
    {
        var value = $(this).val();
        $("#classroomlist div").filter(function() {
              $(this).toggle($(this).text().indexOf(value) > -1)
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

        var value = course_name;

        $("#classroomlist div").filter(function() {
                $(this).toggle($(this).text().indexOf(value) > -1)
        });
            
        for(let itr = 1; itr <= max_sem; itr++)
        {
            $("#sem_selection").append(`<option value='${itr}'>${itr}</option>`);
        }

});

});