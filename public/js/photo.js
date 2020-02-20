$(function(){

  var selected = 0;
  var images = $("#image-box > li");
  var dotlist = $("#dot > li");

  $("#next").on("click",function(){
    selected += 1;
    images.removeClass("show").eq(selected).addClass("show");
    if(selected === images.length - 1){
      $("#next").css({'display': 'none'});
    }
    if(selected > 0){
      $("#previous").css({'display': 'block'});
    }

      dotlist.eq(selected).find(".black").addClass("active");
      dotlist.eq(selected).find(".white").removeClass("active");
      dotlist.eq(selected - 1).find(".white").addClass("active");
      dotlist.eq(selected - 1).find(".black").removeClass("active");
  });
  $("#previous").on("click",function(){
    selected -= 1;
    images.removeClass("show").eq(selected).addClass("show");
    if(selected === 0){
      $("#previous").css({'display': 'none'});
    }
    if(selected < images.length - 1){
      $("#next").css({'display': 'block'});
    }

    dotlist.eq(selected).find(".black").addClass("active");
    dotlist.eq(selected).find(".white").removeClass("active");
    dotlist.eq(selected + 1).find(".white").addClass("active");
    dotlist.eq(selected + 1).find(".black").removeClass("active");
  });


  $("#album").on("click",function(){
    $("#add").css({'display': 'block'});
  });








});
