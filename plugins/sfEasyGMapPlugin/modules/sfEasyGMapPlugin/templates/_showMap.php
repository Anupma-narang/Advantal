<?php use_helper('GMap'); ?>

<?php include_map($gMap); ?>

<?php include_map_javascript($gMap); ?>

<?php if ($sf_user->isAdmin()) : ?>

  <div id="map-search">
    <div id="map_search_title">
      Pots moure el mapa i el marcador on vulguis per guardar la situació
      actual del mapa, el zoom i la posició del marcador.
    </div>

    <div id="map_search_form">
    <?php include_search_location_form() ?>
  </div>

  <div style="clear: both;"></div>
</div>
<input id="save" type="button" value="Grabar situació actual" />
<script type="text/javascript">
  $('#save').click(function(){
    $.post("<?php echo url_for('sfEasyGMapPlugin/updateMap') ?>",{
      bounds: "'"+ map.getCenter()+"'" ,
      "zoom" : map.getZoom(),
      "anunciant_id" : "<?php echo $anunciant_id ?>",
      'marker_bounds' : "'"+ marker.getPosition()+"'",
      'map_type_id'   : map.getMapTypeId()
    }, function(data) {
      alert('saved');
    });
  })
</script>

<?php //si ORO ?>
<?php elseif ($pes == 1) : ?>
      <div id="map-directions">
          <label for="from"><?php echo __('Com arribar des de:') ?></label>
          <input id="from" name="from" value="<?php url_for('sfEasyGMapPlugin/updateDirections') ?>" />

          <input type="button" id="submit_direction" name="submit" value="Calcular" />
        <div id="directionsPanel"></div>
        <script type="text/javascript">
          $('#submit_direction').click(function() {

              var directionsService = new google.maps.DirectionsService();
              var directionsDisplay = new google.maps.DirectionsRenderer();
                directionsDisplay.setPanel(document.getElementById("directionsPanel"));

              var start = $('#from').val();
              var end = marker.getPosition();
                var request = {
                    origin:start,
                    destination:end,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
              };
               directionsService.route(request, function(result, status) {
                  if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(result);
                    directionsDisplay.setMap(map);
                  }
               })




        });
        </script>


      </div>
<?php endif ?>
