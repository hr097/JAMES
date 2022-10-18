$(document).ready(function(){
    
    const h = new Date().getHours(); 
    if(h<11)
    {
        $("#daymode").text("Good Morning,");
    }
    else if(h<17)
    {
        $("#daymode").text("Good Afternoon,");
    }
    else
    {
        $("#daymode").text("Good Evening,");
    }

    $(".subjects").click(function(){
        window.location.href = `subjectattendance.php?subject=${encodeURIComponent($(this).attr('id'))}&faculty=${encodeURIComponent(
            $($(this).find("p")[2]).attr("id") 
        )}`;
    });

    // api calling for new notifications

});





