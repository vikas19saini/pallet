
$(window).scroll(function(){
   if ($(this).scrollTop() > 100){
      $('header').addClass("header-fixed");
   }
   else{
      $('header').removeClass("header-fixed");
     }
});


$(document).ready(function() {
   $(".menu_icon").click(function () {
        $(".navigation").toggleClass('active');
   });
});

$(window).scroll(function(){
   if ($(this).scrollTop() > 0){
      $(".navigation").removeClass("active");
   }
});

/* footer mobile */
$(document).ready(function() {
  $('.accordion').find('.accordion-toggle').click(function() {
    $(this).next().slideToggle('600');
    $(".accordion-content").not($(this).next()).slideUp('600');

  });
  $('.accordion-toggle').on('click', function() {
    $(this).toggleClass('active').siblings().removeClass('active');
  });
});


$(document).ready(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

});



