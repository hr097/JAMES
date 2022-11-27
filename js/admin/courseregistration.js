$(document).ready(function(){

$(".updatecourse").click(function(){
    window.location.href = `courseregistration.php?course_id=${$(this).attr('id')}&opt=updt`;
});

$(".deletecourse").click(function(){
    window.location.href = `courseregistration.php?course_id=${$(this).attr('id')}&opt=dlt`;
});
    
});