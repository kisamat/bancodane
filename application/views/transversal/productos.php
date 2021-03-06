<html>    
  <head> 
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/general/gmap/gmap3.js') ?>"></script>
    <style>
      body{
        text-align:center;
      }
      .gmap3{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        width: 800px;
        height: 500px;
      }
    </style>
    
    <script type="text/javascript">
        
      $(function(){
      
        $('#test1').gmap3({
          map:{
            options:{
              center:[46.578498,2.457275],
              zoom: 3
            }
          },
          marker:{
            values:[ 
              {latLng:[48.8620722, 2.352047], data:"Paris !"},
              {address:"Colombia", data:"<img src='<?= base_url('assets/banderas/Colombia.png') ?>'><br><b>Nombre: Jorge Perez <br> Email: jperez@prueba.com</b>"},
              {address:"66000 Perpignan, France", data:"Perpignan ! <br> GO USAP !", options:{icon: "http://maps.google.com/mapfiles/marker_green.png"}}
            ],
            options:{
              draggable: false
            },
            events:{
              mouseover: function(marker, event, context){
                var map = $(this).gmap3("get"),
                  infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.open(map, marker);
                  infowindow.setContent(context.data);
                } else {
                  $(this).gmap3({
                    infowindow:{
                      anchor:marker, 
                      options:{content: context.data}
                    }
                  });
                }
              },
              mouseout: function(){
                var infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.close();
                }
              }
            }
          }
        });
      });
    </script>
  <body>
    <div id="test1" class="gmap3"></div>
    when mouse is over a marker, an unique infowindow appear (it is create at the first time, and then is recycled) 
  </body>
</html>