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
      $('.book-shelf .page-section-header a').click(function (event) {
        ga('send', 'event', 'BookShelfHeader', 'click', event.target.href);
      });

      // Book section book cover image click
      $('.book-shelf-scroll article .entry-image a').click(function (event) {
        ga('send', 'event', 'BookShelfBookImage', 'click', event.target.href);
      });

      // Book section book title click
      $('.book-shelf-scroll article header .entry-title a').click(function (event) {
        ga('send', 'event', 'BookShelfBookTitle', 'click', event.target.href);
      });

      // Book section book meta click
      $('.book-shelf-scroll article header .meta a').click(function (event) {
        ga('send', 'event', 'BookShelfBookMeta', 'click', event.target.href);
      });

      // Book section scroll
      $('.book-shelf-scroll').one("scroll", function () {
        ga('send', 'event', 'BookShelf', 'scroll', $(this).parent().siblings().first().children("a").first().html());
      });

      // Single book meta click
      $('.single-lsb_book article a[rel="tag"]').click(function (event) {
        ga('send', 'event', 'SingleBookMeta', 'click', event.target.href);
      });

      // Pagination clicks on book archive pages
      $('.tax-lsb_tax_list .pagination a').click(function (event) {
        ga('send', 'event', 'BookArchivePagination', 'click', event.target.href);
      });

      // Pagination clicks on book search results pages
      $('.search-results .pagination a').click(function (event) {
        ga('send', 'event', 'BookSearchResultsPagination', 'click', event.target.href);
      });

      // Facet interaction
      $(document).on('facetwp-loaded', function() {
        if (FWP.loaded) {
          ga('send', 'pageview', window.location.pathname + window.location.hash);
        }
      });
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },

  // Books
  single_lsb_book: {

    init: function() {
      // JavaScript to be fired on the home page

      $('.library-status select').change(function() {
        var selectedCounty = $(this).val();
        $('.library-status .county').addClass('hidden');
        $('.library-status .county').removeClass('show');

        if( selectedCounty ) {
          $('.library-status .county.' + selectedCounty).removeClass('hidden');
          $('.library-status .county.' + selectedCounty).addClass('show');
        }
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
