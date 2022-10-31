
$(document).ready(function(){

$("#modifyclass").click(function(){
    const classroomid = $("#classroomid").val();
    window.location.href = `editclassroom.php?classroomid=${classroomid}`;
});

$("#classmode").click(function(){

    let csrfTokenVal = $("#csrfToken").val();
    $.post("api/changeclassmode.php",
    {
    _cid:$("#classroomid").val(),
    _ct:csrfTokenVal,
    },
    function(data){

        if(data==1)
        {
            window.location.href = "./archivedclassrooms.php";
        }
        else
        {
            window.location.href = "./dashboard.php";
        } 
    }); 
})

});