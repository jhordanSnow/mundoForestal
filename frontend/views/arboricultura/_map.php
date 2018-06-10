<div id="map" style="min-height: 500px;"></div>

<script>
var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 9.955295197063872, lng: -84.10939548338763},
    zoom: 8
  });

<?php
foreach ($Plant->mapinformations as $map) {
  ?>
  var polygonCustom = new google.maps.Polygon({
      paths: [<?= $map->Polygon ?>],
      fillColor: '#006d32',
      fillOpacity: 0.5,
      strokeWeight: 1,
    });
    polygonCustom.setMap(map);
  <?php
}
?>
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8-P_bjNBgNPzVrTKHnFpEyB_yexBOrnk&callback=initMap"></script>
