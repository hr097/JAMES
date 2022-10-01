

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
        alert($(this).attr("id"));
    });

});





