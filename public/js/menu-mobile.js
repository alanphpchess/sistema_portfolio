    $('.btn-mobile').click(function(){
      $(this).toggleClass("click");
      $('.sidebar').toggleClass("show");
    });
      $('.first-btn').click(function(){
        $('navigation ul .first-show').toggleClass("show");
        $('navigation ul .first').toggleClass("rotate");
      });
      $('.second-btn').click(function(){
        $('navigation ul .second-show').toggleClass("show1");
        $('navigation ul .second').toggleClass("rotate");
      });
      $('.third-btn').click(function(){
        $('navigation ul .third-show').toggleClass("show3");
        $('navigation ul .third').toggleClass("rotate");
      });
      $('.fourth-btn').click(function(){
        $('navigation ul .fourth-show').toggleClass("show4");
        $('navigation ul .fourth').toggleClass("rotate");
      });
      $('.fifth-btn').click(function(){
        $('navigation ul .fifth-show').toggleClass("show5");
        $('navigation ul .fifth').toggleClass("rotate");
      });
      $('.sixth-btn').click(function(){
        $('navigation ul .sixth-show').toggleClass("show6");
        $('navigation ul .sixth').toggleClass("rotate");
      });
      $('.seventh-btn').click(function(){
        $('navigation ul .seventh-show').toggleClass("show7");
        $('navigation ul .seventh').toggleClass("rotate");
      });
      $('.eighth-btn').click(function(){
        $('navigation ul .eighth-show').toggleClass("show8");
        $('navigation ul .eighth').toggleClass("rotate");
      });

      $('navigation ul li').click(function(){
        $(this).addClass("active").siblings().removeClass("active");
      });