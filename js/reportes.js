(function($) {

    var tiempo=10;
  
    
  
    "use strict"; // Start of use strict
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    // Toggle the side navigation
    $("#sidebarToggle").on('click', function(e) {
      e.preventDefault();
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
    });
  
    
    
  
    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
      if ($(window).width() > 768) {
        var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
      }
    });
  
    // Scroll to top button appear
    $(document).on('scroll', function() {
      var scrollDistance = $(this).scrollTop();
      if (scrollDistance > 100) {
        $('.scroll-to-top').fadeIn();
      } else {
        $('.scroll-to-top').fadeOut();
      }
    });
  
    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(event) {
      var $anchor = $(this);
      $('html, body').stop().animate({
        scrollTop: ($($anchor.attr('href')).offset().top)
      }, 1000, 'easeInOutExpo');
      event.preventDefault();
    });
  

  
function inicia_tiempo() {
    //cada 10 segundos se refresca la pantalla de servicios para ver si hay cambios
    console.log(tiempo);
    if (tiempo == 0) {
      ver_servicios();
      tiempo=10;
      inicia_tiempo();
    } 
    else {
      tiempo -= 1;
        setTimeout(inicia_tiempo, 1000);
    }
}  
  inicia_tiempo();
  
  
  })(jQuery); // End of use strict
  