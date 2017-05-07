$(function(){
    var $toggle = $('.hamburger');
    var $hide_sticky = $('.close_sticky');
    var $show_sticky = $('.show_sticky');
    var $nav = $('.main_nav');
    var $header = $('header')
    var header_height = $header.height();
    $toggle.on('click', function(){
        if ($nav.hasClass('open')) {
            $nav.removeClass('open');
        } else {
            $nav.addClass('open');
        }
    });
    if ($(window).width() > 991) {
      $(window).on('scroll', function() {
        var cur_pos = $(window).scrollTop();
        if (cur_pos >= header_height) {
          $header.addClass('sticky');
          $('body').addClass('sticky');
        } else {
          $header.removeClass('sticky');
          $('body').removeClass('sticky');
        }
      });  
    } else {
      $('nav').on('touchstart', function(e) {
        if (e.target.nodeName !== 'INPUT' && e.target.nodeName !== 'A') {
          e.preventDefault();
        }
      });
      $(window).on('scroll', function() {
        var cur_pos = $(window).scrollTop();
        if (cur_pos >= 50) {
          $('.hamburger').addClass('shrink');
        } else {
          $('.hamburger').removeClass('shrink');
        }
      });
      
    }
    $hide_sticky.on('click', function() {
      $show_sticky.css('display', 'block');
      $('.sticky').each(function(){
        $(this).removeClass('sticky');
      });
      $(window).off('scroll');
      $(window).on('scroll', function() {
        var cur_pos = $(window).scrollTop();
        if (cur_pos >= header_height) {
          $show_sticky.css('display', 'block');
        } else {
          $show_sticky.css('display', 'none');
        }
      });
    });
    $show_sticky.on('click', function() {
      $show_sticky.css('display', 'none');
      $header.addClass('sticky');
          $('body').addClass('sticky');
          $(window).off('scroll');
      $(window).on('scroll', function() {
        var cur_pos = $(window).scrollTop();
        if (cur_pos >= header_height) {
          $header.addClass('sticky');
          $('body').addClass('sticky');
        } else {
          $header.removeClass('sticky');
          $('body').removeClass('sticky');
        }
      });  
    });
});