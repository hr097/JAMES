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
        window.location.href = `subjectattendance.php?subject=${$(this).attr('id')}`;
    });

    // api calling for new notifications

});





