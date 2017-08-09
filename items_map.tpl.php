<div class="items">

    <script type="text/javascript">


function addmarkers(map){


    /*var marker = {latitude:'37.750492', longitude:'-122.191074'};//"Sunshine"
    photoData.push(marker);*/

    //map.openInfoWindow(new GPoint(-122.191074, 37.750492),
    //                              document.createTextNode("Sunshine Biscuit Factory"));

    /* var image = 'images/beachflag.png';
      var myLatLng = new google.maps.LatLng(-33.890542, 151.274856);
      var beachMarker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          icon: image
      });*/

    var photoData=new Array();


<?php for($i=0;$i<$perpage;$i++){ ?>
<?php if(!empty($childs[$i]->field_location)&&$loc=$childs[$i]->field_location[LANGUAGE_NONE][0]['value']): ?>
<?php $loc=explode(',',$loc); ?>
<?php if(is_numeric($loc[0])): ?>

    var marker<?php echo($i); ?>={
      latitude:<?php echo($loc[0]); ?>,
      longitude:<?php echo($loc[1]); ?>,
      title:'<h3>'+<?php echo("'".$childs[$i]->title."'");?>+'</h3>',
    };

    photoData.push(marker<?php echo($i); ?>);

<?php endif; ?>
<?php endif; ?>
<?php } ?>



    var data={photos:photoData};
    var markers=[];
    //  Create a new viewpoint bound
    var bounds=new google.maps.LatLngBounds();

    for (var i=0; i<data.photos.length; i++) {
        var dataPhoto=data.photos[i];
        var latLng=new google.maps.LatLng(dataPhoto.latitude,
                                            dataPhoto.longitude);
        var marker=new google.maps.Marker({
            position: latLng,
            title: dataPhoto.title,
        });
        google.maps.event.addListener(marker,'click',(function(marker,i){
          return function(){
            infowindow.setContent(marker.title);
            infowindow.open(map, marker);
          }
        })(marker, i));

        markers.push(marker);

        //  And increase the bounds to take this point
        bounds.extend(latLng);
    }


    var infowindow=new google.maps.InfoWindow({
      //content:dataPhoto.content
    });

    var mcOptions={gridSize:30, maxZoom:8};
    var markerCluster=new MarkerClusterer(map,markers,mcOptions);

    //  Fit these bounds to the map
    map.setCenter(bounds.getCenter());
    map.fitBounds(bounds);

}


function initialize(){
    var mapOptions={
        center: new google.maps.LatLng(-34.397, 150.644),
        zoom: 2
    };
    var map=new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
    addmarkers(map);
}


function loadScript(){
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCuOz5c7yJAfUekRso9IbMWONoFzE-Oyww&' +
                 'callback=initialize';
    document.body.appendChild(script);
}


window.onload = loadScript;


    </script>


        <div id="map-canvas"></div>


    <!--ol-->
<?php //for($i=0;$i<$perpage;$i++){ ?>
<?php //if(!empty($childs[$i]->field_location)&&$loc=$childs[$i]->field_location[LANGUAGE_NONE][0]['value']): ?>

<?php //echo('<li><a href="/node/'.$childs[$i]->nid.'">'.$childs[$i]->title.'</a>: '.$loc.'</li>'); ?>

<?php #$image_size, $by_context, ?>

<?php //endif; ?>
<?php //} ?>
    <!--/ol-->



</div>