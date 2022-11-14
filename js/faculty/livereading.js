
function getLatestData()
{
    let classroomid = $("#reader_selection").val();
    let csrfToken = $("#csrfToken").val();

    $.post(
    "api/liverfidreading.php",
    {
        _cid: classroomid,
        _ct: csrfToken
    },
    function (data, status) {
        if(status == "success")
        {           
            if($("#rfidcarddata").html()!=data)
            {
                $("#rfidcarddata").prepend(data);
            }
        }
    },"text"); // must write as text string will come
}

$(document).ready(function(){

    $("#reader_selection").on('change',function () {
        setInterval(
        function ()
        {   
         getLatestData();
        },1000); 

    });

});

