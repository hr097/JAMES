$(document).ready(function(){

    $("#reader_selection").on('change',function () {

        var classroomid = $(this).val();
        var csrfToken = $("#csrfToken").val();

        setInterval(
        function ()
        {
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

         },5000); 

    });

});