<?php

class sfEasyGMapPluginComponents extends sfComponents {

  /**
   * @param $anunciant_id 
   */
  public function executeShowMap($request) {
    // Initialize the google map
    $gMap = new GMap();
    $gm = Doctrine_Core::getTable('google_map')->findOneBy('anunciant_id', $this->anunciant_id, Doctrine_Core::HYDRATE_ARRAY);
    $gMap->setZoom($gm['zoom']);
    $gMap->setCenter($gm['lat'], $gm['lng']);
    $gMap->setOption('mapTypeId', "google.maps.MapTypeId.".strtoupper(isset($gm['map_type_id']) ? $gm['map_type_id'] : 'roadmap'));
    $gMap->setWidth(270);
    $gMap->setHeight(200);

    // Create marker
    $marker = new GMapMarker($gm['marker_lat'], $gm['marker_lng'], array('title' => '"Hello World !"', 'draggable' => $this->getUser()->isAuthenticated() ? "true" : "false"), 'marker');

    // Add marker on the map
    $gMap->addMarker($marker);
    $this->gMap = $gMap;

    //directions
  }

}
