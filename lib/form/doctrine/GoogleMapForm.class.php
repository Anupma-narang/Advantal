<?php

/**
 * GoogleMap form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GoogleMapForm extends BaseGoogleMapForm {

    public function configure() {
        $this->setWidgetSchema(new sfWidgetFormGmap(array(), array(
            'map.address' => $this->getObject()->getAddress(),
            'map.lat' => $this->getObject()->getLat(),
            'map.lng' => $this->getObject()->getLng(),
            'map.zoom' => $this->getObject()->getZoom()
        )));
        $this->widgetSchema['empresa_id'] = new sfWidgetFormInput();
        $this->validatorSchema['address'] = new sfValidatorPass();
    }

}
