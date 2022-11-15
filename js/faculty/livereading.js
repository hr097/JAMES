
var data_bckp = "";

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
                console.log(data_bckp);

                if(data==0)
                {
                    $("#rfidcarddata").empty();
                }
                else
                {   
                    $("#rfidcarddata").prepend(data);
                }
        }
    },"text"); // must write as text string will come
}

$(document).ready(function(){

    $("#reader_selection").on('change',function () {
        
      setInterval(function (){
        getLatestData();
      },1500);

    });

});

