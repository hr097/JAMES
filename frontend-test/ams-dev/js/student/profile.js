 //Card flip
 
 var card = document.querySelector('.flip-card');
    card.addEventListener('click', function () {
        card.classList.toggle('is-flipped');
});

//Email-edit
$('.email_edit_icon').click(function(){
    $('.email_edit_para').replaceWith('<input type="text" id="email_edit" class="email_edit info-data value="">'+$(this).html());

 });

 $('#edit_icon').click(function(){
    $('#edit_icon').replaceWith('<button type="button" class="btn btn-primary float-right edit_btn">Update</button>');
 });
