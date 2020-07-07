// import external dependencies
import 'jquery';
import 'slick-carousel';

/* Slick carousels */

jQuery('.all-clients__row, .our-awards__row').slick({
  slidesToShow: 6,
  arrows: false,
  autoplay: false,
  swipeToSlide: true,
  responsive: [
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
  ],
});

jQuery('.homepage-industries .service-tiles .row').slick({
  arrows: false,
  infinite: false,
  autoplay: false,
  autoplaySpeed: 10000,
  speed: 500,
  swipeToSlide: true,
  slidesToShow: 4.5,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 1.25,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
  ],
});

/* Target a helper class to start a Slick slideshow on hover */
jQuery('.slick--play-on-hover').mouseover(function() {
  jQuery(this).find('.slick-slider').slick('play')
});
jQuery('.slick--play-on-hover').mouseout(function() {
  jQuery(this).find('.slick-slider').slick('pause')
});

let status = jQuery('.case-studies__pageinfo');
let caseStudiesElement = jQuery('.case-studies__slider');

caseStudiesElement.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide) {

  /** Just calling these because of ESLint's no-unused-vars warning */
  event;
  nextSlide;

  //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
  var i = (currentSlide ? currentSlide : 0) + 1;
  status.text(i + ' OF ' + slick.slideCount);
});

caseStudiesElement.slick({
  dots: false,
  infinite: true,
  fade: true,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  prevArrow: jQuery('.case-studies--prev-slide'),
  nextArrow: jQuery('.case-studies--next-slide'),
});

jQuery('.testimonials__slider').slick({
  dots: false,
  infinite: true,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow text-primary" aria-label="Previous" role="button" style="display: block;"><i class="fal fa-chevron-left fa-3x text-lighttext"></i></button>',
  nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow text-primary" aria-label="Next" role="button" style="display: block;"><i class="fal fa-chevron-right fa-3x text-lighttext"></i></button>',
});

jQuery('.reasons-to-choose-us__slider').slick({
  dots: true,
  arrows: true,
  infinite: true,
  fade: true,
  slidesToShow: 1,
  slidesToScroll: 1,
  appendDots: jQuery('.reasons-to-choose-us__slider__dots'),
  nextArrow: jQuery('.reasons-to-choose-us__slider__arrows__next'),
});

jQuery('.reasons-to-choose-us__slider').on( 'afterChange', function( event, slick, currentSlide ) {
  event;

  jQuery.each(slick.$dots, (i, el) => {
    i;
    jQuery(el).find('li').eq(currentSlide).addClass('slick-active').find('button');
  })
});

/* eslint-disable */

function adjustHeights() {

    if (jQuery('.footer-nav').length > 0) {

        jQuery('.footer-nav').matchHeight({
            byRow: false,
        });

    }

    if (jQuery('.match-height').length > 0) {

        jQuery('.match-height').matchHeight();

    }

    if (jQuery('.match-video-height').length > 0) {

        jQuery('.match-video-height').matchHeight({
            target: '.video-contain video',
            byRow: false,
        });

    }

    window.mh_array = [];

    if (jQuery('.match-height-group').length > 0) {

        jQuery('.match-height-group').each(function (i, obj) {

            var datamh = jQuery(obj).attr('data-mh-group');
            var mhclass = 'mhg-' + datamh;

            jQuery(obj).addClass(mhclass);

            if (jQuery.inArray(mhclass, window.mh_array) === -1) {
                window.mh_array.push(mhclass);
            }

        });

    }

    if (window.mh_array.length > 0) {

        jQuery(window.mh_array).each(function(i, obj) {

            jQuery('.' + obj).matchHeight({
                byRow: false,
            });

        });

    }

}

jQuery( document ).ready(function() {

    adjustHeights();

});



jQuery( document ).ready(function() {

    if (jQuery('#newsBack').length > 0) {
        if (document.referrer.indexOf(window.location.hostname) >= 0) {
            jQuery('#newsBack').html('Back');
        }
        jQuery('#newsBack').on('click', function() {
            if (document.referrer.indexOf(window.location.hostname) >= 0) {
                history.go(-1);
            } else {
                window.location.href = '/news/';
            }
        });
    }

    if (jQuery('#eventsBack').length > 0) {
        if (document.referrer.indexOf(window.location.hostname) >= 0) {
            jQuery('#eventsBack').html('Back');
        }
        jQuery('#eventsBack').on('click', function() {
            if (document.referrer.indexOf(window.location.hostname) >= 0) {
                history.go(-1);
            } else {
                window.location.href = '/events/';
            }
        });
    }

    if (jQuery('#blogBack').length > 0) {
        if (document.referrer.indexOf(window.location.hostname) >= 0) {
            jQuery('#blogBack').html('Back');
        }
        jQuery('#blogBack').on('click', function() {
            if (document.referrer.indexOf(window.location.hostname) >= 0) {
                history.go(-1);
            } else {
                window.location.href = '/blog/';
            }
        });
    }

});


/* eslint-enable */



// Import everything from autoload
import './autoload/**/*'


/*
 @fortawesome:registry=https://npm.fontawesome.com/
 //npm.fontawesome.com/:_authToken=B74D6DC9-9C22-4628-B46E-EC845B78658C

 in a file called .npmrc in root of this theme

 npm install --save @fortawesome/fontawesome-svg-core
 npm install --save @fortawesome/free-brands-svg-icons
 npm install --save @fortawesome/pro-regular-svg-icons
 npm install --save @fortawesome/pro-solid-svg-icons
*/

// import then needed Font Awesome functionality

import { config, library, dom } from '@fortawesome/fontawesome-svg-core';
import { faCheck, faTimes, faBars } from '@fortawesome/pro-regular-svg-icons';
import { faChevronDown, faChevronLeft, faChevronRight, faSearch, faLongArrowDown } from '@fortawesome/pro-light-svg-icons';

// import the icons
//import { faEdit, faEye } from '@fortawesome/pro-solid-svg-icons';
import { faFacebookSquare, faLinkedinIn, faTwitter, faInstagram } from '@fortawesome/free-brands-svg-icons';

//import { faPlusCircle } from "@fortawesome/pro-solid-svg-icons";
//import { faUser, faBars, faSignIn } from "@fortawesome/pro-solid-svg-icons";
//import { faShoppingBasket, faInfoCircle } from '@fortawesome/pro-regular-svg-icons';

// add pseudo elements
config.searchPseudoElements = true;

// add the imported icons to the library
library.add( faCheck, faTimes, faChevronLeft, faChevronRight, faChevronDown, faLongArrowDown, faSearch, faBars, faFacebookSquare, faLinkedinIn, faTwitter, faInstagram  );


// tell FontAwesome to watch the DOM and add the SVGs when it detects icon markup

dom.watch();


// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
