/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page

      // Toggle list description visibility
      $('.book-list .book-list-header button').click(function () {
        $(this).closest('.book-list-header').find('.book-list-description')
          .toggleClass('sr-only');
      });

      // Hide scroll arrows when not needed
      var toggleScrollButtons = function($bookListScroll) {

        var scrollLeftPos = $bookListScroll.scrollLeft(),
            scrollWidth = $bookListScroll.get(0).scrollWidth,
            width = $bookListScroll.width();

        if(scrollLeftPos > 0) {
          $bookListScroll.siblings('.book-list-left-scroll').show();
        } else {
          $bookListScroll.siblings('.book-list-left-scroll').hide();
        }

        if(scrollWidth - scrollLeftPos > width) {
          $bookListScroll.siblings('.book-list-right-scroll').show();
        } else {
          $bookListScroll.siblings('.book-list-right-scroll').hide();
        }

      };

      $('.book-list-scroll').each(function() {
        toggleScrollButtons($(this));
      });

      $('.book-list-scroll').scroll(function() {
        toggleScrollButtons($(this));
      });

      // Respond to left scroll button click
      $('.book-list .book-list-left-scroll').click(function () {
        $(this).siblings('.book-list-scroll').animate({
          scrollLeft: "-=500px"
        }, 500);
      });

      // Respond to right scroll button click
      $('.book-list .book-list-right-scroll').click(function () {
        $(this).siblings('.book-list-scroll').animate({
          scrollLeft: "+=500px"
        }, 500);
      });
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
