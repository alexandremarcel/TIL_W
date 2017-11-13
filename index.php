<!DOCTYPE html>
<html>
  <head>
    <title>Tacos In Lyon</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      function initMap() {
        var misterTacosLatlng = {lat: 45.770159, lng: 4.865939};
        var hamametLatlng = {lat: 45.7712109, lng: 4.8669937};
        var planeteSandwichLatlng = {lat: 45.768106, lng: 4.830532};
        var pozePizzaLatlng = {lat: 45.738052, lng: 4.864697};
        var ainElFouaraLatlng = {lat: 45.772611, lng: 4.874139};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: misterTacosLatlng 
        });

        var misterTacos = new google.maps.Marker({
          position: misterTacosLatlng,
          map: map,
          title: 'Mister Tacos'
        });

        misterTacos.addListener('click', function() {
          window.location.replace("./tacos/pagetacos.php?idPageTacos=1");
        });

        var hamamet = new google.maps.Marker({
          position: hamametLatlng,
          map: map,
          title: 'Hamamet'
        });

        hamamet.addListener('click', function() {
          window.location.replace("./tacos/pagetacos.php?idPageTacos=2");
        });
		
		var planeteSandwich = new google.maps.Marker({
          position: planeteSandwichLatlng,
          map: map,
          title: 'Planète Sandwich'
        });

        planeteSandwich.addListener('click', function() {
          window.location.replace("./tacos/pagetacos.php?idPageTacos=3");
        });
		
		var pozePizza = new google.maps.Marker({
          position: pozePizzaLatlng,
          map: map,
          title: 'Poze Pizza'
        });

        pozePizza.addListener('click', function() {
          window.location.replace("./tacos/pagetacos.php?idPageTacos=4");
        });
		
		var ainElFouara = new google.maps.Marker({
          position: ainElFouaraLatlng,
          map: map,
          title: 'Ain El Fouara'
        });

        ainElFouara.addListener('click', function() {
          window.location.replace("./tacos/pagetacos.php?idPageTacos=5");
        });

        map.addListener('center_changed', function() {
          // 3 seconds after the center of the map has changed, pan back to the
          // marker.
          window.setTimeout(function() {
            map.panTo(marker.getPosition());
          }, 3000);
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-pJ2EoeWOOE6VODmB1mv3ivRyVp5LKaY&callback=initMap">
    </script>
  </body>
</html>