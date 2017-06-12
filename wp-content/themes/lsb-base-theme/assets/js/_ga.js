(function ($) {

  function debounce(func, wait, immediate) {
    var timeout;
    return function () {
      var context = this, args = arguments;
      var later = function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  };

  if (typeof (ga) !== typeof (Function)) {
    return;
  }

  // Track Voice play
  $('.lsb_voice__play').each(function () {
    $(this).bind('click', function (e) {
      ga('send', 'event', 'Voice', 'play');
    });
  });

  $('.lsb_voice__stop').each(function () {
    $(this).bind('click', function (e) {
      ga('send', 'event', 'Voice', 'stop');
    });
  });

  $('.lsb_voice__settings').each(function () {
    $(this).bind('click', function (e) {
      ga('send', 'event', 'Voice', 'settings');
    });
  });

  $('.lsb_voice__help').each(function () {
    $(this).bind('click', function (e) {
      ga('send', 'event', 'Voice', 'help');
    });
  });

  // Track section scroll events
  var scroll = debounce(function () {
    ga('send', 'event', 'Scroll', 'scroll');
  }, 250, true);

  $('.lsb_section__scroll').click(function (e) {
    ga('send', 'event', 'Scroll', 'click');
  });

  $('.lsb_section__body').scroll(scroll);

})(jQuery);