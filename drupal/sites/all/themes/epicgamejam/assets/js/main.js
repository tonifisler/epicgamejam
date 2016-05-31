'use strict';

(function($) {

  $('#countdown').countDown({
    separator_days: ':',
    always_show_days: true
  });

  $('.webform-component--epic-locations > input[type=radio]').each(function() {
    $(this).remove();
  });

})(jQuery);

