
$(function () {
  'use strict';


    // scrollToTop
    $(window).on("scroll", function(){
      if($(this).scrollTop() > 1000 ) {
        if($('.scrollToTop').is(':hidden')){
          $('.scrollToTop').fadeIn(500);
        }
      } else {
        $('.scrollToTop').fadeOut(100);
      }
    });

    // Click On scrollToTop
    $('.scrollToTop').click(function(e){
      e.preventDefault();
      $('html, body').animate({
        scrollTop: 0
      }, 1000);
    });

    // Show Input Search

    $('.icon-search').click(function () {
      $('.popup-header').css('display','inline');
    });
    $(document).on("click",'.popup-close',function(){
      $(".popup-header").css('display','none');
    })
  


});
