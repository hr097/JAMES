$(document).ready(function() {
    
   
});
$("#course_selection").change(function () {
   
    $("#sem_selection").empty();
    $("#sem_selection").append("<option value=''>Not Selected</option>");

    let max_sem= $('#course_selection > option:selected').data('count');
    for(let itr = 1; itr <= max_sem; itr++)
    {
        $("#sem_selection").append(`<option value='${itr}'>${itr}</option>`);
    }
    displayStudent();

});