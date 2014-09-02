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

      // Google Analytics Events

      // Book section header link click
      $('.book-section-header a').click(function (event) {
        ga('send', 'event', 'book section header', 'click', event.target.href);
      });

      // Book section book cover image click
      $('.book-section-scroll article .entry-image a').click(function (event) {
        ga('send', 'event', 'book section entry image', 'click', event.target.href);
      });

      // Book section book title click
      $('.book-section-scroll article header .entry-title a').click(function (event) {
        ga('send', 'event', 'book section header entry title', 'click', event.target.href);
      });

      // Book section book meta click
      $('.book-section-scroll article header .meta a').click(function (event) {
        ga('send', 'event', 'book section entry meta', 'click', event.target.href);
      });

      // Book section scroll
      $('.book-section-scroll').one("scroll", function () {
        ga('send', 'event', 'book section scroll', 'scroll', $(this).parent().siblings().first().children("a").first().html());
      });

      // Single book meta click
      $('.single-lsb_book article a[rel="tag"]').click(function (event) {
        ga('send', 'event', 'single book meta', 'click', event.target.href);
      });

      // Pagination clicks on book archive pages
      $('.tax-lsb_tax_list .pagination a').click(function (event) {
        ga('send', 'event', 'book archive pagination', 'click', event.target.href);
      });
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page

      // Hide scroll arrows when not needed
      var toggleScrollButtons = function($bookSectionScroll) {

        var scrollLeftPos = $bookSectionScroll.scrollLeft(),
            scrollWidth = $bookSectionScroll.get(0).scrollWidth,
            width = $bookSectionScroll.width();

        if(scrollLeftPos > 0) {
          $bookSectionScroll.siblings('.book-section-left-scroll').show();
        } else {
          $bookSectionScroll.siblings('.book-section-left-scroll').hide();
        }

        if(scrollWidth - scrollLeftPos > width) {
          $bookSectionScroll.siblings('.book-section-right-scroll').show();
        } else {
          $bookSectionScroll.siblings('.book-section-right-scroll').hide();
        }

      };

      $('.book-section-scroll').each(function() {
        toggleScrollButtons($(this));
      });

      $('.book-section-scroll').scroll(function() {
        toggleScrollButtons($(this));
      });

      // Respond to left scroll button click
      $('.book-section .book-section-left-scroll').click(function () {
        $(this).siblings('.book-section-scroll').animate({
          scrollLeft: "-=500px"
        }, 500);
      });

      // Respond to right scroll button click
      $('.book-section .book-section-right-scroll').click(function () {
        $(this).siblings('.book-section-scroll').animate({
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
