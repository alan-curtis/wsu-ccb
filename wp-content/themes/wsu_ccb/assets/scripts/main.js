jQuery(document).ready(function ($) {
  //$('#wprmenu_bar').off('click');

  var logo_html = $("<div />").append($("#wprmenu_bar .menu_title").clone()).html();
  $('#wprmenu_bar').prepend(logo_html);

  var back_button = "<div class='back-button-wrapper'><div class='back-button-container'><button class='back-button'>Back</button><div class='close-button-wrapper'></div></div>";
  //var close_button = "<div class='close-button-wrapper'><button class='close-button'>close</button></div>";
  // $('#wprmenu_bar').after(back_button);

  setTimeout(function (){
    $('.cbp-spmenu > ul > li.menu-item-has-children > .sub-menu').before(back_button);
  }, 500);
  //$('#mg-wprm-wrap').prepend(close_button);

  var search_button = "<button class='search-button'></button>";
  $('#wprmenu_bar .hamburger').before(search_button);

  $('#wprmenu_bar .search-button').click(function () {
    $('.wpr-search-form input').focus();
  });

  $("#wprmenu_menu_ul li.menu-item-has-children:not('.quicklinks_menu') .wprmenu_icon").click(function () {
    $(this).parent().addClass("current-item-active").children("ul.sub-menu").show();
    $('body').addClass('active-back-button');
  });

  // $('#wprmenu_bar').click(function () {
  //   $('#wprmenu_menu_ul li.menu-item-has-children').removeClass("current-item-active");
  // });

  /** Back Button **/
  $(".cbp-spmenu").on('click', '.back-button-wrapper .back-button', function (e) {
    e.preventDefault();
    var menuList = $("#wprmenu_menu_ul li.menu-item-has-children");
    menuList.removeClass("current-item-active");
    $('body').removeClass("active-back-button");
    menuList.children("ul.sub-menu").hide();
    menuList.children(".wprmenu_icon").removeClass("wprmenu_par_opened");
  });

  // /** Close Button **/
  // $('.close-button-wrapper .close-button').click(function () {
  //     if ($('.wprm-wrapper #wprmenu_bar').hasClass('active')) {
  //         $('.wprm-wrapper #wprmenu_bar').removeClass('active');
  //     }
  //     if ($('.wprm-wrapper #wprmenu_bar .hamburger').hasClass('is-active')) {
  //         $('.wprm-wrapper #wprmenu_bar .hamburger').removeClass('is-active');
  //     }
  //     if ($('.wprm-wrapper .cbp-spmenu').hasClass('cbp-spmenu-open')) {
  //         $('.wprm-wrapper .cbp-spmenu').removeClass('cbp-spmenu-open');
  //     }
  //     $('body').removeClass('active-back-button');
  //     $('html').removeClass('wprmenu-body-fixed');

  //     $('.cbp-spmenu .wprmenu_icon').attr('tabindex', '0');
  //     $('.cbp-spmenu li, .cbp-spmenu li a').removeAttr('tabindex');

  //     $('#wprmenu_bar .menu_title a').removeAttr('tabindex');
  //     $('#wprmenu_bar .search-button').removeAttr('tabindex');

  //     $("#wprmenu_menu_ul li").each(function (index) {
  //         if ($(this).hasClass('current-item-active')) {
  //             $(this).children('.sub-menu').css('display', 'none');
  //             $(this).removeClass('current-item-active');
  //             $(this).children('.wprmenu_icon').removeClass('wprmenu_par_opened');
  //         }
  //     });

  //     $('#wprmenu_bar .hamburger').focus();
  // });


  /*** Sidebar menu ***/
  // $(".sidebar-dynamic-menu ul li").each(function() {
  //     if($(this).hasClass('current-menu-parent')) {
  //         $('body').addClass("js-current-menu-parent");
  //     }
  // });

  /** Blogs filter **/
  // $('.news-list ul.listing li').on('click',function(){
  //     $('#news-center-page form .search').trigger('click');
  // });

  // if($('.sidebar .custom-menu-block').length) {
  //     $('body').addClass('custom-menu-block');
  // }

  /** Accessibility **/
  $('#wprmenu_bar .hamburger').attr({role: "button", tabindex: "0"});
  $('#wprmenu_bar .hamburger').keypress(function (e) {
    var key = e.which;
    if (key == 13) {
      $(this).trigger('click');
      if ($(this).parent().hasClass('active')) {
        $('#wprmenu_bar .menu_title a').attr('tabindex', '-1');
        $('#wprmenu_bar .search-button').attr('tabindex', '-1');
      }
    }
  });
  $('.cbp-spmenu .wprmenu_icon').attr('tabindex', '0');
  $('.cbp-spmenu .wprmenu_icon').keypress(function (e) {
    var key = e.which;
    if (key == 13) {
      $(this).trigger('click');
    }
  });

  $('.cbp-spmenu > ul > li > .wprmenu_icon').keypress(function (e) {
    var key = e.which;
    if (key == 13) {
      if ($(this).parent().hasClass('current-item-active')) {
        $(this).parent().parent().find('> li:not(.current-item-active)').attr('tabindex', '-1');
        $(this).parent().parent().find('> li:not(.current-item-active) a').attr('tabindex', '-1');
        $(this).parent().parent().find('> li:not(.current-item-active) span').attr('tabindex', '-1');
      }
    }
  });


  // Run video commands.
  var VideoEvents = {
    // POST commands to YouTube or Vimeo API
    postMessageToPlayer: function (player, command) {
      if (player == null || command == null) {
        return;
      }
      player.contentWindow.postMessage(JSON.stringify(command), "*");
    }
  }
  if (typeof define === 'function' && define.VideoEvents) {
    define(VideoEvents);
  } else {
    window.VideoEvents = VideoEvents;
  }

  // Document ready function.


  // persons-carousel
  // var personsCarousel = $('.persons-carousel');
  // if (personsCarousel.length) {
  //   personsCarousel.owlCarousel({
  //     loop: true,
  //     margin: 10,
  //     nav: true,
  //     dots: false,
  //     responsive: {
  //       0: {
  //         items: 1
  //       },
  //       600: {
  //         items: 1
  //       }
  //     }
  //   });
  // }
  // Homepage slider
  //Hero video play pause
  $(".hero-video #player").hide();
  $(".hero-video #playButton").click(function () {
    //console.log('play');
    $(this).addClass("d-none");
    $(".type-video #pauseButton").removeClass("d-none");
    //$(".hero-video .carousel-caption").css("bottom", "5px");
    $(".type-video .preview").hide();
    $(".type-video #player").show();
    $(".type-video #player").trigger("pause");
  });

  $(".type-video #pauseButton").click(function () {
    // alert('pause');
    $(this).addClass("d-none");
    $(".type-video #playButton").removeClass("d-none");
    $(".type-video .preview").hide();
    $(".type-video #player").show();
    $(".type-video  #player").trigger("play");
    //$(".type-video .carousel-caption").css("bottom", "0px");
  });
  $(".hero-video").css("display", "block");

  //slider pause.
  //$("#hero-carousel #player").hide();
  $(".hero--section #playControl").click(function () {
    //console.log('play');
    $(this).addClass("d-none");
    $(".hero--section #pauseControl").removeClass("d-none");
    $(".hero--section .preview").hide();
    $(".hero--section .owl-item").show();
    $("#hero-carousel").trigger('stop.owl.autoplay');
  });

  $(".hero--section #pauseControl").click(function () {
    // alert('pause');
    $(this).addClass("d-none");
    $(".hero--section #playControl").removeClass("d-none");
    $(".hero--section .preview").hide();
    $(".hero--section .owl-item").show();
    $("#hero-carousel").trigger('play.owl.autoplay', [7000]);

  });

  var $owl = $('.hero--section');

  $owl.on('initialized.owl.carousel resized.owl.carousel', function (e) {
    $(e.target).toggleClass('hide-nav', e.item.count <= e.page.size);
  });


  // accessibility
  // add instructions to keyboard users that are only visible when the carousel is focused
  $('.hero--section .owl-stage-outer').append('');

  // listen for keyboard input
  $(document).on('keydown', function (e) {

    var $focusedElement = $(document.activeElement),
        singleOwl = $(".owl-item").data('owlCarousel'),
        type = e.which == 39 ? 'next' : null,
        type = e.which == 37 ? 'prev' : type,
        type = e.which == 13 ? 'enter' : type;

    // if the carousel is focused, use left and right arrow keys to navigate
    if ($focusedElement.attr('class') === 'hero--section') {

      if (type == 'next') {
        singleOwl.next();
      } else if (type == 'prev') {
        singleOwl.prev();
      }

      // if the prev and next buttons are focused, catch "Enter" and navigate in the right direction
    } else if (type == 'enter') {
      if ($focusedElement.hasClass('owl-next')) {
        singleOwl.next();
      } else if ($focusedElement.hasClass('owl-prev')) {
        singleOwl.prev();
      }
    }
  });


  if (jQuery("#hero-carousel").length) {
    var owl_carousel = jQuery("#hero-carousel").owlCarousel({
      autoplay: false,
      autoplayTimeout: 7000,
      loop: false,
      margin: 0,
      nav: true,
      navText: ['<span aria-label="previous" class="customPrevBtn"></span>', '<span aria-label="next" class="customNextBtn"></span>'],
      dots: true,
      lazyLoad: true,
      video: true,
      singleItem: true,
      items: 1,
      smartSpeed: 1000,
      autoHeight: hero_carousel_height_auto,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      },
      onTranslate: function (event) {

        var currentSlide, player, command;

        currentSlide = jQuery('.owl-item.active');

        player = currentSlide.find(".videoWrapper iframe").get(0);

        command = {
          "event": "command",
          "func": "pauseVideo"
        };

        if (player != undefined) {
          player.contentWindow.postMessage(JSON.stringify(command), "*");

        }

      },
      onInitialized: function (event) {
        jQuery('#hero-carousel').find('.owl-item').attr('aria-selected', 'false').find('*').attr('tabindex', '-1');
        jQuery('#hero-carousel').find('.owl-item.active').attr('aria-selected', 'true').find('*').removeAttr('tabindex'); // let screen readers know an item is active

        // apply meta info to next and previous buttons and make them focusable
        jQuery('#hero-carousel').find('.owl-prev').attr('role', 'button').attr('title', 'Previous');
        jQuery('#hero-carousel').find('.owl-next').attr('role', 'button').attr('title', 'Next');
        jQuery('#hero-carousel, .owl-prev, .owl-next').attr('tabindex', '0');

        // add instructions to keyboard users that are only visible when the carousel is focused
        // jQuery('#hero-carousel').find('.owl-stage-outer').append('<p class="alert alert-success show-on-focus">Use left and right arrow keys to navigate.</p>');

        // listen for keyboard input
        jQuery(document).on('keydown', function (e) {

          var $focusedElement = jQuery(document.activeElement),
              singleOwl = jQuery("#hero-carousel").data('owlCarousel'),
              type = e.keyCode == 39 ? 'next' : null,
              type = e.keyCode == 37 ? 'prev' : type,
              type = e.keyCode == 13 ? 'enter' : type;

          // if the carousel is focused, use left and right arrow keys to navigate
          if ($focusedElement.attr('id') === 'hero-carousel') {

            if (type == 'next') {
              singleOwl.next();
            } else if (type == 'prev') {
              singleOwl.prev();
            }

            // if the prev and next buttons are focused, catch "Enter" and navigate in the right direction
          } else if (type == 'enter') {
            if ($focusedElement.hasClass('owl-next')) {
              singleOwl.next();
            } else if ($focusedElement.hasClass('owl-prev')) {
              singleOwl.prev();
            }
          }
        });
      },
      onChange: function () {
        jQuery('#hero-carousel').find('.owl-item').attr('aria-selected', 'false').find('*').attr('tabindex', '-1');
        jQuery('#hero-carousel').find('.owl-item.active').attr('aria-selected', 'true').find('*').removeAttr('tabindex');
        ;
      },

    });
  }
  $('.featured-media .play-btn').click(function (e) {
    e.preventDefault();
    var iconId = jQuery(this).attr('data-id');
    var videoType = jQuery(this).attr('type');
    //alert(videoType);
    if (videoType == 'youtubeplayicon') {
      $('iframe[data-id="' + iconId + '"]')[0].src += "?autoplay=1&modestbranding=1&playsinline=1?controls=0?rel=0&showinfo=0&iv_load_policy=3";
    }
    if (videoType == 'vimeoplayicon') {
      $('iframe[data-id="' + iconId + '"]')[0].src += "&autoplay=1";
    }

    //var clickedEle =$('iframe[data-id="'+ iconId +'"] .ytp-large-play-button').click();
    //console.log(clickedEle);

    // $('.ytp-large-play-button').click();

    $(this).hide();
    $('.featured-media .thumb_' + iconId + '').hide();
    $('.featured-media iframe[data-id="' + iconId + '"]').show();
    $('.wrapiframe[data-id="' + iconId + '"]').addClass('iframepadding');

  });

  // Sidebar Accordion Toggle
  var $_sidebar_acc = $('.sidebar-cta-accordion');

  $_sidebar_acc.find(".widget-title .title").on("click", function () {
    $(this).toggleClass("active");
    $(this).parent().next().slideToggle("slow").children("ul.menu").toggleClass("active");
  });

  $_sidebar_acc.find(".menu-item-has-children").children("a").on("click", function (e) {
    e.preventDefault();
    $(this).toggleClass("active").next().slideToggle("slow");
  });

  // Footer Mobile JS
  var $_footer_menu_item = $(".footer__menus .widget_nav_menu").find('.menu-item-has-children > a');
  $_footer_menu_item.on("click", function (e) {
    e.preventDefault();
    $(this).toggleClass("active").next().slideToggle("slow");
  });

});
jQuery(document).ready(function ($) {
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 114,
    itemMargin: 6,
    asNavFor: '#slider'
  });
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel",
    start: function (slider) {
      $('body').removeClass('loading');
    }
  });

  // Swiper
  var swiper = new Swiper(".thumbSwiper", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 5,
    freeMode: true,
    watchSlidesProgress: true,
    slideToClickedSlide: true,
  });

  var swiper2 = new Swiper(".mainSwiper", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 1,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: swiper,
    },
  });

});
//Modal window for Video btn
jQuery(document).ready(function ($) {
  var $videoSrc;
  $('.video-btn').click(function () {
    $videoSrc = $(this).data("src");
  });
  console.log($videoSrc);

  $('#Modal').on('shown.bs.modal', function (e) {
    $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
  })
  $('#Modal').on('hide.bs.modal', function (e) {
    // a poor man's stop video
    $("#video").attr('src', $videoSrc);
  })
});
