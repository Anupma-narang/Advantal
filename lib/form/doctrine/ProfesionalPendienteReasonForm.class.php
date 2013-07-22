<?php

sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));

class ProfesionalPendienteReasonForm extends BaseProfesionalForm {

    public function configure() {
        unset($this['slug'], $this['created_at'], $this['updated_at'], $this['fecha_activacion'], $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_observacion'], $this['fecha_cerrado'], $this['fecha_rechazado'], $this['fecha_nulo'], $this['revision_last_state_id'], $this["destacado"], $this["fecha_destacado"], $this['dividendo'], $this['user_id']
                , $this['road_type_id']
                , $this['address']
                , $this['numero']
                , $this['piso']
                , $this['puerta']
                , $this['last_name_one']
                , $this['last_name_two']
                , $this['first_name']
                , $this['profesional_tipo_dos_id']
                , $this['profesional_tipo_tres_id']
                , $this['profesional_estado_id']
                , $this['profesional_tipo_uno_id']
                , $this['states_id']
                , $this['city_id']
                , $this['telefono']
                , $this['email']
        );

        $this->embedRelation('profesionalGoogleMap', 'ProfesionalGoogleMapForm');

        if ($this->getObject()->isNew()) {
            $this->widgetSchema->setPositions(array('profesionalGoogleMap', 'active_reason'));
        }
        $this->widgetSchema['active_reason'] = new sfWidgetFormTextareaCKEditor(array('height' => 200, 'width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 490), 'err_id' => 'Error_max_length_incidencia', 'max_length' => 3000));
        // $this->validatorSchema['active_reason'] = new mySfValidatorString(array('max_rep_length' => 8300), array('max_rep_length' => 'Has superado el espacio permitido para los Indicadores de excelencia.'));
        $this->validatorSchema['active_reason']->setOption('required', true);
        $this->validatorSchema["active_reason"]->setMessage("required", 'Para publicar un profesional en el Directorio necesitas antes incluir los Indicadores de excelencia.');


//        $this->validatorSchema['profesionalGoogleMap']['address']->setOption('required', true);
        $this->validatorSchema['profesionalGoogleMap']['address']->setMessage('required', 'Para publicar un profesional necesitas asociarle una ubicación.');

        $this->widgetSchema->setLabels(array('active_reason' => "<strong>" . __('Indicadores de excelencia') . "</strong>", 'profesionalGoogleMap' => "<strong>" . 'Ubicación Googlemap' . "</strong>")); //'active_reason' => __('Dirección')

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkLista')))
        );

        $this->widgetSchema->setNameFormat('profesional_active[%s]');
    }

    protected function doSave($con = null) {
        parent::doSave($con);
        $this->getObject()->save();

        //as embed form don't call doSave method, I put the doSave code here for the google maps widget :(
        $gMapForm = $this->getEmbeddedForm('profesionalGoogleMap');
        $gMapForm->getObject()->setProfesional($this->getObject());

        //start add code for google map add/edit
        $gformValues = $this->getTaintedValues();
        $gMapForm->getObject()->setAddress($gformValues['profesionalGoogleMap']['address']);
        $gMapForm->getObject()->setLng($gformValues['profesionalGoogleMap']['lng']);
        $gMapForm->getObject()->setLat($gformValues['profesionalGoogleMap']['lat']);
        //end add code for google map add/edit

        $gMapForm->getObject()->save();
    }

    public function checkLista(sfValidatorCallback $validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);
        $required = array();

        //si está en una lista... googleMap required...
        if ($values['profesionalGoogleMap']['address'] == '' && $values['profesionalGoogleMap']['lng'] == '40.4166909') {
            $errorSchema->addError(new sfValidatorError($validator, 'Para publicar un profesional en el Directorio necesitas asociarle una ubicación.'), 'profesionalGoogleMap');
        } elseif ($values['profesionalGoogleMap']['address'] != '' && $values['profesionalGoogleMap']['lng'] == '40.4166909') {
            $errorSchema->addError(new sfValidatorError($validator, 'Para publicar un profesional en el Directorio necesitas asociarle una ubicación.'), 'profesionalGoogleMap');
        }

        if (count($errorSchema)) {
            throw $errorSchema;
        }

        return $values;
    }

}
