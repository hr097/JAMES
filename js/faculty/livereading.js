$(document).ready(function(){

    $("#reader_selection").on('change',function () {
        setInterval(
        function ()
        {   
            var classroomid = $(this).val();
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
                }
            },"text"); // must write as text string will come

         },1000); 

    });

});