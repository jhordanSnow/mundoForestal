$(function () {
  // Slideshow 4
  $("#slider4").responsiveSlides({
    auto: true,
    pager: true,
    nav: false,
    speed: 900,
    namespace: "callbacks",
    before: function () {
      $('.events').append("<li>before event fired.</li>");
    },
    after: function () {
      $('.events').append("<li>after event fired.</li>");
    }
  });

});

jQuery(document).ready(function ($) {
  $(".scroll").click(function (event) {
    event.preventDefault();
    $('html,body').animate({
      scrollTop: $(this.hash).offset().top
    }, 1000);
  });
});

$(document).ready(function () {
  /*
    var defaults = {
    containerID: 'toTop', // fading element id
    containerHoverID: 'toTopHover', // fading element hover id
    scrollSpeed: 1200,
    easingType: 'linear'
    };
  */
  $().UItoTop({
    easingType: 'easeOutQuart'
  });
});

$(document).ready(function () {
    $('.navbar a.dropdown-toggle').on('click', function (e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');

        console.log(45, $parent.closest('.nav'));
        if (!$parent.parent().hasClass('nav')) {
            if ($parent.closest('.nav').hasClass('navbar-right')) {
                console.log('aaa');
                $el.next().css({"top": $el[0].offsetTop, "right": $parent.outerWidth() - 4});
            } else {
                console.log('bbb');
                $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
            }
        }

        $('.nav li.open').not($(this).parents("li")).removeClass("open");

        return false;
    });
});

$(document).ready(function (){
  $("#a-logout").click(function (){
    $("#btn-logout").click();
  })
})
