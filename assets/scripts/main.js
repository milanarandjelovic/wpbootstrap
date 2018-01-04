var $ = require('jquery');
require('bootstrap-sass');

// Plugins
require('./plugins/jquery.hoverex.min');
require('./plugins/jquery.isotope.min');

(function ($) {
  "use strict";
  var $container = $('.portfolio');
  var $items = $items;
  var portfolioLayout = 'fitRows';

  if ($container.hasClass('portfolio-centered')) {
    portfolioLayout = 'masonry';
  }

  $container.isotope({
    filter: '*',
    animationEngine: 'best-available',
    layoutMode: portfolioLayout,
    animationOptions: {
      duration: 750,
      easing: 'linear',
      queue: false,
    },
    masonry: {},
  }, refreshWaypoints());

  function refreshWaypoints() {
    setTimeout(function () {
    }, 1000);
  }

  $('nav.portfolio-filter ul a').on('click', function () {
    var selector = $(this).attr('data-filter');
    selector = selector === '*' ? '*' : '.' + selector;

    $container.isotope({ filter: selector }, refreshWaypoints());
    $('nav.portfolio-filter ul a').removeClass('active');
    $('nav.portfolio-filter ul li').removeClass('active');
    $(this).addClass('active');
    $(this).parent().addClass('active');

    return false;
  });

  function getColumnNumber() {
    var winWidth = $(window).width(),
      columnNumber = 1;

    if (winWidth > 1200) {
      columnNumber = 5;
    } else if (winWidth > 950) {
      columnNumber = 4;
    } else if (winWidth > 600) {
      columnNumber = 3;
    } else if (winWidth > 400) {
      columnNumber = 2;
    } else if (winWidth > 250) {
      columnNumber = 1;
    }

    return columnNumber;
  }

  function setColumns() {
    var winWidth = $(window).width(),
      columnNumber = getColumnNumber(),
      itemWidth = Math.floor(winWidth / columnNumber);

    $items.each(function () {
      $(this).css({
        width: itemWidth + 'px',
      });
    });
  }

  function setPortfolio() {
    setColumns();
    $container.isotope('reLayout');
  }

  $container.imagesLoaded(function () {
    setPortfolio();
  });

  $(window).on('resize', function () {
    setPortfolio();
  });
})(jQuery);
