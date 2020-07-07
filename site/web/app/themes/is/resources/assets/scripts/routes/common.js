export default {
  init() {
    // JavaScript to be fired on all pages

      /*// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
      let vh = window.innerHeight * 0.01;
      // Then we set the value in the --vh custom property to the root of the document
      document.documentElement.style.setProperty('--vh', `${vh}px`);*/





  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired

      /*jQuery('.career-collapse').on('show.bs.collapse', function () {
          var id = jQuery(this).attr('id');
          jQuery('[aria-controls="'+id+'"]').find('svg').removeClass('fa-plus').addClass('fa-times');
      });*/

      /*jQuery('.career-collapse').on('hide.bs.collapse', function () {
          var id = jQuery(this).attr('id');
          jQuery('[aria-controls="'+id+'"]').find('svg').removeClass('fa-times').addClass('fa-plus');
      });*/


      /*jQuery('body').on('click', '.team-open', function() {

          // the id of the club that has been clicked
          var teamId = jQuery(this).attr('data-team');

          // find the div that is open (if any)
          var openTeamId = jQuery('.team-bio.open').attr('data-team');

          // the div that is to be acted on
          var div = jQuery('.team' + teamId);

          if (teamId === openTeamId) {

              // just close the div and we're done
              div.fadeOut(300, function() {
                  div.removeClass('open').removeAttr('style');
              });

              // remove the margin that should be applied
              div.parent().css('margin-bottom', '1rem');

          } else {

              // close any other divs

              if (openTeamId !== '') {

                  // just close the div and we're done
                  jQuery('.team'+openTeamId).fadeOut(300, function() {
                      jQuery('.team'+openTeamId).removeClass('open').removeAttr('style');
                  });

                  // remove the margin that should be applied
                  jQuery('.team'+openTeamId).parent().css('margin-bottom', '1rem');

              }

              // open the block that has been clicked
              div.addClass('open', function() {
                  setTimeout(function(){
                      div.fadeIn(300);
                  }, 400);
              });

              //measure the div that's just opened
              var divHeight = div.height();

              // add on 30 for the padding
              divHeight = divHeight + 50;

              // add that height to the bottom of the original row
              div.parent().css('margin-bottom',divHeight + 'px');

          }

      });*/

      /*var resizeTimer;

      jQuery(window).on('resize', function() {

          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(function() {

              checkOpenTeamDivs();

          }, 250);

      });*/

      /*function checkOpenTeamDivs()
      {

          var teamDiv = jQuery('.team-bio.open');

          var divHeight = teamDiv.height();

          // add on 30 for the padding
          divHeight = divHeight + 50;

          teamDiv.parent().css('margin-bottom',divHeight + 'px');

      }*/


      jQuery('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('.nav-link').on('click', function(event) {
          if (
              (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, ''))
              &&
              (location.hostname === this.hostname)
          ) {

              // Figure out element to scroll to

              var target = jQuery(this.hash);

              target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');

              // Does a scroll target exist?

              if (target.length) {

                  // Only prevent default if animation is actually gonna happen
                  event.preventDefault();

                  var scrolloffset = target.offset().top - 105;

                  if (scrolloffset < 250) {
                      scrolloffset = 0;
                  }
                  jQuery('html, body').animate({
                      scrollTop: scrolloffset,
                  }, 500, function() {
                      // Callback after animation
                      // Must change focus!
                      var $target = jQuery(target);

                      $target.focus();

                      if ($target.is(':focus')) { // Checking if the target was focused
                          return false;
                      } else {
                          $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                          $target.focus(); // Set focus again
                      }
                  });
              }
          }
      });

      jQuery(function () {
          jQuery(window).scroll(function () {
              var distanceY = jQuery(this).scrollTop(),
                  shrinkOn  = 120,
                  body    = jQuery('body');

              if (distanceY > shrinkOn) {
                  body.addClass('scrolled');
              } else {
                  if (body.hasClass('scrolled')) {
                      body.removeClass('scrolled');
                  }
              }
          });
      });

      jQuery('body').on('show.bs.collapse', '.collapse', function() {
         jQuery('.hamburger').addClass('is-active').addClass('transitioning');
         jQuery('.header').addClass('transitioning');
      });

      jQuery('body').on('hide.bs.collapse', '.collapse', function() {
         jQuery('.hamburger').removeClass('is-active').addClass('transitioning');
         jQuery('.header').addClass('transitioning');
      });

      jQuery('body').on('shown.bs.collapse', '.collapse', function() {
         jQuery('.hamburger').removeClass('transitioning');
         jQuery('.header').removeClass('transitioning');
      });

      jQuery('body').on('hidden.bs.collapse', '.collapse', function() {
         jQuery('.hamburger').removeClass('transitioning');
         jQuery('.header').removeClass('transitioning');
      });



      jQuery('.slider-mobile').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          fade: false,
          prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="far fa-chevron-left"></i></button>',
          nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="far fa-chevron-right"></i></button>',
      });

      jQuery('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: false,
          asNavFor: '.slider-nav',
      });

      jQuery('.slider-nav').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          dots: false,
          centerMode: true,
          focusOnSelect: true,
          centerPadding : '30px',
          prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="far fa-chevron-left"></i></button>',
          nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="far fa-chevron-right"></i></button>',
      });


      jQuery('#SortBy button').on('click', function() {

          if (jQuery(this).hasClass('active')) {
              jQuery('#SortBy button').removeClass('active');
              jQuery('#inputSortBy').val('');
          } else {
              jQuery('#SortBy button').removeClass('active');
              jQuery(this).addClass('active');
              jQuery('#inputSortBy').val(jQuery(this).data('value'));
          }

      });

      jQuery( document ).ready(function() {

          if (jQuery('#inputSortBy').val() != '') {
              jQuery('[data-value="'+jQuery('#inputSortBy').val()+'"]').addClass('active');
          }

      });

      jQuery('.update-link').on('click', function() {
          jQuery('#FilterSubmit').click();
      });


      function disableFields()
      {
          jQuery('#inputPriceMin').val('').attr('disabled', true);
          jQuery('#inputPriceMax').val('').attr('disabled', true);
          jQuery('#inputBedroomsMin').val('').attr('disabled', true);
          jQuery('#inputBedroomsMax').val('').attr('disabled', true);

      }

      function enableFields()
      {
          jQuery('#inputPriceMin').attr('disabled', false);
          jQuery('#inputPriceMax').attr('disabled', false);
          jQuery('#inputBedroomsMin').attr('disabled', false);
          jQuery('#inputBedroomsMax').attr('disabled', false);

      }

      jQuery('#inputScheme').on('change', function() {

          if (jQuery(this).val() == jQuery('#OriginalScheme').val()) {
              jQuery('.home-filter .text-danger').hide();
              enableFields();
          } else {
              jQuery('.home-filter .text-danger').show();
              disableFields();
          }

      });

      jQuery(document).ready(function() {
          jQuery('select.form-control').prettyDropdown({
              width: '100%',
              height: '38px',
              selectedMarker: '<i class="far fa-check"></i>',
          });
          jQuery('select.news-dropdown').prettyDropdown({
              width: '100%',
              height: '48px',
              selectedMarker: '<i class="far fa-check"></i>',
          });
      });



      /*jQuery('.project-option').on('change', function() {

          var sector_option = jQuery('#project-option-sector').val();
          var service_option = jQuery('#project-option-service').val();
          var redirect_url = window.location.href.split('?')[0];

          if ( (sector_option !== '') || (service_option !== '') ) {

              var url = '?';

              if (sector_option !== '') {

                  url = url + 'sector=' + sector_option + '&';

              }

              if (service_option !== '') {

                  url = url + 'service=' + service_option;

              }

              redirect_url = redirect_url + url;

          }

          window.location.href = redirect_url;

      });*/



      /*jQuery('.post-option').on('change', function() {

          var sector_option = jQuery('#post-option-sector').val();
          var service_option = jQuery('#post-option-service').val();
          var year_option = jQuery('#post-option-year').val();
          var redirect_url = window.location.href.split('?')[0];

          if ( (sector_option !== '') || (service_option !== '') || (year_option !== '') ) {

              var url = '?';

              if (sector_option !== '') {

                  url = url + 'sector=' + sector_option + '&';

              }

              if (service_option !== '') {

                  url = url + 'service=' + service_option;

              }

              if (year_option !== '') {

                  url = url + 'article-year=' + year_option;

              }

              redirect_url = redirect_url + url;

          }

          window.location.href = redirect_url;

      });*/


  },
};
