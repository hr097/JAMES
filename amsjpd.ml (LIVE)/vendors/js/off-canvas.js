(function($) {
  'use strict';
  $(function() {
    $('[data-toggle="minimize"]').on("click", function() {
      $('.sidebar-offcanvas').toggleClass('active')
    });
  });
})(jQuery);