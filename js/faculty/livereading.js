
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
          console.log(data);
          console.log(data_bckp); 
          
                if(data==0)
                {
                    $("#rfidcarddata").empty();
                    $("#rfidcarddata").html("<tr><td  colspan='5' style='font-size:1.2em;text-align:center;'>No Data Available</td></tr>");
                }
                else if(data!=data_bckp)
                {   
                    let check = $("#rfidcarddata").html();
                    let condition = (check=="<tr><td  colspan='5' style='font-size:1.2em;text-align:center;'>No Data Available</td></tr>");

                    console.log(condition);

                    if(condition)
                    {
                      $("#rfidcarddata").empty();
                    }
                    $("#rfidcarddata").prepend(data);
                    data_bckp=data;
                }
        }
    },"text"); // must write as text string will come
}

$(document).ready(function(){

    $("#reader_selection").on('change',function () {
        
      setInterval(function (){
        getLatestData();
      },5000);

    });

});

