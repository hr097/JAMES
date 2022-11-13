$(document).ready(function(){

    $("#reader_selection").on('change',function () {

        let classroomid = $(this).val();

        if(typeof(EventSource) !== "undefined") {
            var source = new EventSource(`api/liverfidreading.php?cid=${classroomid}`);

            source.onmessage = function(event) {
                $("#rfidcarddata").html(event.data);;
              };

          } else {
            alert("Sorry, your browser does not support server-sent events...");
          }
             
    
    });

});