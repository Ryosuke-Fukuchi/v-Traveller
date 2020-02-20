jQuery(function(){

   var $e = $('#map-container').outerWidth();
   var user_id = $('#map').data('id');

   var hokkaido = ["#dcdcfc", "#7f7eda", "#b3b2ee"];
   var tohoku = ["#c4d7ff", "#759ef4", "#98b9ff"];
   var kanto = ["#d1f4ff", "#55c7ed", "#a5ddf0"];
   var chubu = ["#c5fad1", "#65db80", "#99f0ad"];
   var kinki = ["#fff6bf", "#ffe966", "#fff19c"];
   var chugoku = ["#ffe9bd", "#ffcc66", "#ffe0a3"];
   var shikoku = ["#ffd0ba", "#fb9466", "#ffbb9c"];
   var kyushu = ["#ffd6d6", "#ff9191", "#ffbdbd"];
   var okinawa = ["#f2cffa", "#e790fc", "#edbef7"];
   var pre = $("#map").data("pre");

   var areas = [];
   for(i=1; i<48; i++){
     if(i == 1){
       areas.push({code : i, name: "", color: hokkaido[pre[i - 1]], hoverColor: hokkaido[2], prefectures: [i]});
     }else if(i<8){
       areas.push({code : i, name: "", color: tohoku[pre[i - 1]], hoverColor: tohoku[2], prefectures: [i]});
     }else if(i<15){
       areas.push({code : i, name: "", color: kanto[pre[i - 1]], hoverColor: kanto[2], prefectures: [i]});
     }else if(i<24){
       areas.push({code : i, name: "", color: chubu[pre[i - 1]], hoverColor: chubu[2], prefectures: [i]});
     }else if(i<31){
       areas.push({code : i, name: "", color: kinki[pre[i - 1]], hoverColor: kinki[2], prefectures: [i]});
     }else if(i<36){
       areas.push({code : i, name: "", color: chugoku[pre[i - 1]], hoverColor: chugoku[2], prefectures: [i]});
     }else if(i<40){
       areas.push({code : i, name: "", color: shikoku[pre[i - 1]], hoverColor: shikoku[2], prefectures: [i]});
     }else if(i<47){
       areas.push({code : i, name: "", color: kyushu[pre[i - 1]], hoverColor: kyushu[2], prefectures: [i]});
     }else if(i == 47){
       areas.push({code : i, name: "", color: okinawa[pre[i - 1]], hoverColor: okinawa[2], prefectures: [i]});
     }
   }

   var photos = $("#text").data("photos");
   $("#map").japanMap({
       areas: areas,
       backgroundColor : "#fff",
       borderLineColor: "#000",
       borderLineWidth : 0.7,
       lineWidth: 0,
       fontSize : 10,
       fontColor : "#000000",
       showsPrefectureName: false,
       prefectureNameType: "short",
       movesIslands : true,
       width: $e,
       onSelect : function(data){
           window.location.href = "/profile/" + user_id + "/" + data.code;
       },
       onHover:function(data){
         if(photos[data.code - 1] == 0){
           $("#text").html(data.name + '-' + 'まだ行ったことないよ');
         }else{
           $("#text").html(data.name + '-' + photos[data.code - 1] + '枚の写真');
         }
           $("#text").css("background", "#beff69");
       }

   });


   var japan_late = $("#circle").data("percent");
   $("#circle").circliful({
      animationStep: 5,
      foregroundBorderWidth: 5,
      backgroundBorderWidth: 15,
      percent: japan_late,
      decimals: 1
      });

      var hokkaido_late = $("#myChart").data("hokkaido");
      var tohoku_late = $("#myChart").data("tohoku");
      var kanto_late = $("#myChart").data("kanto");
      var chubu_late = $("#myChart").data("chubu");
      var kinki_late = $("#myChart").data("kinki");
      var chugoku_late = $("#myChart").data("chugoku");
      var shikoku_late = $("#myChart").data("shikoku");
      var kyushu_late = $("#myChart").data("kyushu");
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'radar',
        data: {
          labels: ["北海道", "東北", "関東", "中部", "近畿", "中国", "四国", "九州"],
          datasets: [{
            backgroundColor: "rgba(153,255,51,0.4)",
            borderColor: "rgba(153,255,51,1)",
            data: [hokkaido_late, tohoku_late, kanto_late, chubu_late, kinki_late, chugoku_late, shikoku_late, kyushu_late]
          }]
       },
       options: {
              legend: { position: 'bottom', display: false },
              animation: {duration: 3000},
              title: {display: false, fontSize:28, fontColor:'#228B22', text: '地方別制覇率'},
              scale: {
                display: true,
                pointLabels: {fontSize: 15},
                ticks: {display: false, stepSize: 20, fontSize: 8, min: 0, max: 100, beginAtZero: true}
          }
        }
      });


      $("#tab1").click(moveToFirst);
      $("#tab2").click(moveToSecond);
      $("#tab3").click(moveToThird);
      $("#tab4").click(moveToFour);

      function moveToFirst() {
          $("#slide").attr('class', 'move-to-first');
          $(".tab").attr('class', 'tab');
          $("#tab1").attr('class', 'tab selected');
      }

      function moveToSecond() {
          $("#slide").attr('class', 'move-to-second');
          $(".tab").attr('class', 'tab');
          $("#tab2").attr('class', 'tab selected');
      }

      function moveToThird() {
           $("#slide").attr('class', 'move-to-third');
          $(".tab").attr('class', 'tab');
          $("#tab3").attr('class', 'tab selected');
      }

      function moveToFour() {
           $("#slide").attr('class', 'move-to-four');
          $(".tab").attr('class', 'tab');
          $("#tab4").attr('class', 'tab selected');
      }


      




  });
