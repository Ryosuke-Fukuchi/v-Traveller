jQuery(function(){

  $(".toggle").click(function(){
    $("#more").animate( { width: 'toggle' }, 'slow' );
      });

  $("#right").click(function(){
    $("#open").addClass("none");
    $("#close").removeClass("none");
  });
  $("#left").click(function(){
    $("#close").addClass("none");
    $("#open").removeClass("none");
  });









});
