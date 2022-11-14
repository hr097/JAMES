
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
                if(data==0)
                {
                    $("#rfidcarddata").empty();
                    $("#rfidcarddata").html("<tr><td  colspan='5' style='font-size:1.2em;text-align:center;'>No Latest Data Available</td></tr>");
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
        // setInterval(
        // function ()
        // {   
        //  getLatestData();
        // },1000); 

        if(typeof(EventSource) !== "undefined") {
            var source = new EventSource("api/amsapilength.php");

            source.onmessage = function(event) {
              $("#rfidcarddata").html(event.data);
            };

          } else {
            alert("Sorry, your browser does not support server-sent events...");
          }

    });

});

