$(document).ready(function(){

    $("#reader_selection").on('change',function () {
        setInterval(
        function ()
        {   
            var classroomid = $("#reader_selection").val();
            var csrfToken = $("#csrfToken").val();

            $.post(
            "api/liverfidreading.php",
            {
                _cid: classroomid,
                _ct: csrfToken
            },
            function (data, status) {
                if(status == "success")
                {
                $("#rfidcarddata").html(data);

                    //Card flip
                    var card = document.querySelector(".flip-card");
                    card.addEventListener("click", function () {
                        card.classList.toggle("is-flipped");
                    });
                }
            },"text"); // must write as text string will come

         },1000); 

    });



});