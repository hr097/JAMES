
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
            $("#rfidcarddata").prepend(data);
        }
    },"text"); // must write as text string will come
}

$(document).ready(function(){

    $("#reader_selection").on('change',function () {
        setInterval(
        function ()
        {   

    // let classroomid = $("#reader_selection").val();
    // let csrfToken = $("#csrfToken").val();
    // let cur_time = "2022-11-14 12:24:52";
            
    // $.post(
    //     "api/amsapilength.php",
    //     {
    //         _cid: classroomid,
    //         _ct: csrfToken,
    //         _tm: cur_time
    //     },
    //     function (data, status) {
    //         if(status == "success")
    //         {   
    //             let stud_len = $(".student").length;
    //             console.log(stud_len); 

    //             var old_len=0;

    //             if(stud_len==0)
    //             {
                    getLatestData();
        //         } 
        //         else if(stud_len==data)
        //         {

        //         }
        //     }
        // },"text"); // must write as text string will come

        },1000); 

    });

});

                    // //Card flip
                    // var card = document.querySelector(".flip-card");
                    // card.addEventListener("click", function () {
                    //     card.classList.toggle("is-flipped");
                    // });