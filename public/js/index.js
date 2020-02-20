jQuery(function(){
  'use strict';

  $(".image-box").hover(
    function() {
      $(this).find(".hover").show();
    },
    function() {
      $(this).find(".hover").hide();
    }
  );

    if(typeof $("#category").data("index") != "undefined"){
      var $elementReference = document.getElementById( "category" );
      var index = $("#category").data("index");
      $elementReference.options[index].selected = true;
    }

    if(typeof $("#prefecture").data("index") != "undefined"){
      var $elementReference = document.getElementById( "prefecture" );
      var index = $("#prefecture").data("index");
      $elementReference.options[index].selected = true;
    }



});
