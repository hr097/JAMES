
var data_bckp = "";
var req_num=1;

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
                    $("#rfidcarddata").html("<tr><td  colspan='5' style='font-size:1.2em;text-align:center;'>No Data Available</td></tr>");
                }
                else if(data!=data_bckp)
                {   
                    if(req_num==1)
                    {
                      $("#rfidcarddata").empty();
                      req_num++;
                    }
                    $("#rfidcarddata").prepend(data);
                    data_bckp=data;
                }
        }
    },"text"); // must write as text string will come
}

$(document).ready(function(){

    $("#reader_selection").on('change',function () {

      $(".rs").hide();
      $("#btnreaderchange").html("<button type='button' id='changereader' class='btn btn-primary'>Change Reader</button>");
      
      $("#changereader").click(function () {
        window.location.reload();
      })

      setInterval(function (){
        getLatestData();
      },1000);

    });


});

