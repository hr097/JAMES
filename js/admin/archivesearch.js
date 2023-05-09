$(document).ready(function(){
    
  $("#search").on('click', function(){
      let spid = $('#studspid').val();
      let csrfToken = $("#csrfToken").val();
      if(spid != "" && spid.match(/^[0-9]{10}$/))
      {
          $('#order-listing').DataTable().destroy();
          $.post('api/findstudattdata.php',{_spid:spid,_ct:csrfToken},
          function(data,status)
          {
              if(status == "success")
              {
                  $('#searchstudprof').html(data);
              }
              $('#order-listing').DataTable({
                  "aLengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                  ],
                  "iDisplayLength": 10,
                  "language": {
                    search: ""
                  }
                });
                $('#order-listing').each(function() {
                  var datatable = $(this);
                  // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                  var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                  search_input.attr('placeholder', 'Search');
                  search_input.removeClass('form-control-sm');
                  // LENGTH - Inline-Form control
                  var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                  length_sel.removeClass('form-control-sm');
                });
          },"text");
      }
      else
      {
          $('#searchstudprof').html(`<p style='font-size:1.5em;margin:auto;margin-top:100px;'>Sorry, No Student Found with that SPID!</p>`);
      }
   });
  
});