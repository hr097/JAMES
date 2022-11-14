
var data_bckp="";
var req_num=1;

function getLatestData()
{
    let classroomid = $("#reader_selection").val();
    let csrfToken = $("#csrfToken").val();
    
    if(req_num==1)
    {
        $("#rfidcarddata").html(null);
    }

    $.post(
    "api/liverfidreading.php",
    {
        _cid: classroomid,
        _ct: csrfToken
    },
    function (data, status) {
        if(status == "success")
        {         
            if(req_num==1)  
            {
                $("#rfidcarddata").prepend(data);
                data_bckp = data;
                req_num=2;
            }
            else
            {   console.log(data_bckp);
                console.log(data);

                if(data_bckp!=data)
                {
                    $("#rfidcarddata").prepend(data);
                    data_bckp=data;
                }
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

