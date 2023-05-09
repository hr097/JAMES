$(document).ready(function() {
    
    createDataset();
});
function createDataset()
{
    
    $('#transfered_stud_data').DataTable({
        "aLengthMenu": [
          [5, 10, 15, -1],
          [5, 10, 15, "All"]
        ],
        "oLanguage": {
            "sEmptyTable": "No Data Found!"
        },
        "iDisplayLength": 10,
        "language": {
          search: ""
        }
      });
      $('#transfered_stud_data').each(function() {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.removeClass('form-control-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
      });
}
let displayStudent = () =>{
    let course = $("#course_selection").val();
    let semester = $("#sem_selection").val();
    let csrfToken = $("#csrfToken").val();
    if(course != "" && semester != "")
    {
        
        $.post('api/findtransfereddata.php',{_course:course,_semester:semester,_ct:csrfToken},function(data,status){
            if(status == "success")
            {
                $('#transfered_stud_data').DataTable().destroy();
                $('#transferstudent').html(data);
                createDataset()
            }
        },'text');
    }
}

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
$("#sem_selection").change(function () {
    displayStudent();    
});