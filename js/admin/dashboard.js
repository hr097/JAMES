$(document).ready(function(){

    $("#search").on('click', function(){
        let spid = $('#studspid').val();
        let csrfToken = $("#csrfToken").val();
        if(spid != "" && spid.match(/^[0-9]{10}$/))
        {
            $.post('api/findstudattdata.php',{_spid:spid,_ct:csrfToken},
            function(data,status)
            {
                if(status == "success")
                $('#studattdata').html(data);
            },"text");
        }
     });
    
});