$(function(){
  'use strict';

    var menulist = $("#tab-menu > li");
    var contentlist = $("#tab_content > li");
    var postlist = contentlist.find(".post-box > div");
    var num = contentlist.find(".post-box").length;
        for(var i = 0; i < num; ++i){
              var sec = 0.8 + i * 0.2;
              $(".post").eq(i).css({
              'position': 'absolute',
              'top': '0',
              'transition-duration': sec + 's',
            });
          }
    var post_height = contentlist.find(".post-box > div").outerHeight();
    contentlist.find(".post-box").css({'height': post_height});
    var ul_height = $(".show").outerHeight() + 250;
    $("#tab_content").css({'height': ul_height});

    menulist.on("click",function(){
        var selected = menulist.index($(this));
        var selected_postlist = contentlist.eq(selected).find(".post-box > div");
        var length = selected_postlist.length;
        contentlist.removeClass("show").eq(selected).addClass("show");
        if(selected == 1){
          $("#comments").fadeIn(1000);
        }else{
          $("#comments").fadeOut(300);
        }
        ul_height = $(".show").outerHeight() + 250;
        $("#tab_content").css({'height': ul_height});
        postlist.removeClass("post");
        postlist.css({'position': 'absolute', 'top': '300px', 'transition-duration': '0.8s'});
        selected_postlist.addClass("post");
        for(var i = 0; i < length; ++i){
              var sec = 0.8 + i * 0.2;
              $(".post").eq(i).css({
              'position': 'absolute',
              'top': '0',
              'transition-duration': sec + 's',
            });
          }
    });

    $(".image-box").hover(
      function() {

          $(this).find(".hover").show();

      },
      function() {

          $(this).find(".hover").hide();

      }
   );


   $("#addComment").on("click",function(){
     $(".comment").show();
     $("#addComment").hide();
   });



});
