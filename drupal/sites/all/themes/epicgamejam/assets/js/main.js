'use strict';

(function($) {

  var date  = new Date(1435939200); // Sun Apr 12 13:00:00 2015 GMT+1
  var now   = new Date();
  var diff  = date.getTime() - now.getTime()/1000;
  var clock = $('#countdown').FlipClock(diff,{
    clockFace: 'DailyCounter',
    countdown: true
  });

})(jQuery);

