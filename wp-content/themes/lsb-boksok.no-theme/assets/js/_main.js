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
        ga('send', 'event', 'BookSectionHeader', 'click', event.target.href);
      });

      // Book section book cover image click
      $('.book-section-scroll article .entry-image a').click(function (event) {
        ga('send', 'event', 'BookSectionBookImage', 'click', event.target.href);
      });

      // Book section book title click
      $('.book-section-scroll article header .entry-title a').click(function (event) {
        ga('send', 'event', 'BookSectionBookTitle', 'click', event.target.href);
      });

      // Book section book meta click
      $('.book-section-scroll article header .meta a').click(function (event) {
        ga('send', 'event', 'BookSectionBookMeta', 'click', event.target.href);
      });

      // Book section scroll
      $('.book-section-scroll').one("scroll", function () {
        ga('send', 'event', 'BookSection', 'scroll', $(this).parent().siblings().first().children("a").first().html());
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

      // Book navigation top level clicks
      $('.book-navigation-navbar-toplevel a').click(function (event) {
        ga('send', 'event', 'BookNavigation', 'click', event.target.innerText);
      });

      // Book navigation sub level clicks
      $('.book-navigation-navbar-sublevel a').click(function (event) {
        ga('send', 'event', 'BookNavigation', 'click', event.target.innerText);
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
