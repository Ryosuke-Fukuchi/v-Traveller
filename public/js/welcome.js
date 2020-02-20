$(function(){
  'use strict';

  var path = ['/welcomes/collage/IMG_3714.JPG', '/welcomes/collage/IMG_3717.JPG','/welcomes/collage/IMG_3718.JPG'];
  $("#collage").bgSwitcher({
       images: path,
       interval: 5000,
       loop: true,
       shuffle: false,
       effect: "fade",
       duration: 800,
       easing: "linear"
  });

  var path2 = ['/welcomes/images/IMG_0361.JPG', '/welcomes/images/IMG_2284.jpg','/welcomes/images/IMG_2421.jpg', '/welcomes/images/IMG_factory.JPG'];
  $("#images").bgSwitcher({
       images: path2,
       interval: 4500,
       loop: true,
       shuffle: false,
       effect: "fade",
       duration: 800,
       easing: "linear"
  });


});
