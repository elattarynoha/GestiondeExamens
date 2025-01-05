(function($) {

    $(".toggle-password").click(function() {

        $(this).toggleClass("zmdi-eye zmdi-eye-off");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });

<<<<<<< HEAD
})(jQuery);
=======
})(jQuery);
>>>>>>> 2259d28f53ded7e13d9eabab5893df3a74018cd5
