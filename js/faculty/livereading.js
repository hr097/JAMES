// $(document).ready(function(){

//     $("#reader_selection").on('change',function () {

        //let classroomid = $(this).val();
        let classroomid=2;


        if(typeof(EventSource) !== "undefined") {
            var source = new EventSource(`api/liverfidreading.php?cid=${classroomid}`);

            source.addEventListener("message", function(e) {
                console.log(e.data)
                $("#rfidcarddata").html(e.data);
              })

          } else {
            alert("Sorry, your browser does not support server-sent events...");
          }
             
    
//     });

// });