var data_copy="";

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

                if(data==`<tr><td  colspan='5' style='font-size:1.2em;text-align:center;'>No Latest Data Available</td></tr>`)
                {   
                    console.log(data);
                    if($("#rfidcarddata").html()!=data)
                    {
                        $("#rfidcarddata").empty();
                        $("#rfidcarddata").html(data);
                    }
                }
                else
                {   
                    if(data_copy=="")
                    {
                        $("#rfidcarddata").prepend(data);
                        data_copy=data;
                    }
                    else if(data_copy!=data)
                    {
                        $("#rfidcarddata").prepend(data);
                        data_copy=data;
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

