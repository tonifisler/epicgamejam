'use strict';

(function($) {
  $(document).ready(function() {
    $('#countdown').countDown({
      separator_days: ':',
      always_show_days: true
    });

    $('.webform-component--epic-locations > input[type=radio]').each(function() {
      $(this).remove();
    });

    $('[data-toggle=tooltip]').tooltip();
  });
})(jQuery);

