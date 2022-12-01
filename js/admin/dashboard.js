
function getData(year)
{
    let csrfToken = $("#csrfToken").val();
    year = (year=="")?0:year;

    $.post(
        "api/getclassroomlist.php",
        {
          _yr: year,
          _ct: csrfToken
        },
        function (data, status) {

          if(status == "success")
          {
           $("#classroomslist").html(data);    
          }
    
      },"text"); // must write as text string will come

}

$(document).ready(function(){

  //getData($("#year_selection").val());

  $("#searchclassroom").click(function(){
    getData($("#year_selection").val());
  });
 
});
