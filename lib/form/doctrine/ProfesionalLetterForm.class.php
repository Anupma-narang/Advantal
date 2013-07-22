<?php

/**
 * ProfesionalLetter form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalLetterForm extends BaseProfesionalLetterForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        unset(
                $this["created_at"], $this["updated_at"], $this['profesional_id'], $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_destacado'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_rechazado'], $this['fecha_cerrado'], $this['fecha_nulo'], $this['revision_last_state_id'], $this['states_id'], $this['city_id'], $this['user_id'], $this['profesional_activa_desa_id'], $this['fecha_observacion'], $this['is_first']
        );

        $asProfessionalData = sfContext::getInstance()->getRequest()->getParameter('profesional_letter');
        $this->type = isset($asProfessionalData['profesional_letter_type_id']) ? $asProfessionalData['profesional_letter_type_id'] : 1;

        $this->setDefault("profesional_letter_type_id", $this->type);
        $this->embedRelation('Profesional', 'ProfesionalAdminForm');


        /* $profesional_id = sfContext::getInstance()->getRequest()->getParameter('profesional_id');

          $this->widgetSchema["profesional_id"] = new sfWidgetFormInputHidden(array('default' => $profesional_id));
          $this->validatorSchema['profesional_id'] = new sfValidatorString(array('required' => false));


          if($profesional_id)
          $profesional = Doctrine::getTable('Profesional')->find($profesional_id);
          else
          $profesional = new Profesional();

          $this->embedForm('Profesional',new ProfesionalAdminForm($profesional)); */


        /* $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
          $this->validatorSchema['incidencia'] = new sfValidatorString(array('max_length' => 20000),array('max_length' => 'Has superado el espacio permitido para la descripci�n de la incidencia.'));
          $this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido una descripci�n de la incidencia.');
         */

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        $this->validatorSchema['name']->setMessage("required", htmlentities('No has incluido el título de tu carta.'));

        $this->widgetSchema['profesional_letter_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterEstado'), 'table_method' => 'getEstedioLetterName', 'add_empty' => true, 'label' => 'Estado'));
        $this->setValidators['profesional_letter_estado_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalLetterEstado'), 'column' => 'id'));

        if ($this->isNew())
            $this->setDefault("profesional_letter_estado_id", 1);

        $this->widgetSchema['description'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 490), 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 8300));
        $this->validatorSchema['description'] = new mySfValidatorString(array('max_rep_length' => 8300), array('max_rep_length' => 'Has superado el espacio permitido para tu recomendación.'));
        $this->validatorSchema["description"]->setMessage("required", htmlentities('No has incluido tu recomendación.'));
        $this->widgetSchema["profesional_apro_despro_id"] = new sfWidgetFormInputHidden(array(), array('value' => 1));

        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 490), 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 12300));
        $this->validatorSchema['plan_accion'] = new mySfValidatorString(array('max_rep_length' => 12300, 'required' => ($this->type == 1) ? true : false), array('max_rep_length' => 'Has superado el espacio permitido para la Plan de acción.'));
        $this->validatorSchema["plan_accion"]->setMessage("required", htmlentities('No has incluido tu Plan de acción.'));


        $this->widgetSchema->setLabels(array(
            'name' => __('Título'),
            'incidencia' => __('Tu desaprobación'),
            'plan_accion' => __('Plan de acción'),
            'first_name' => __('Nombre'),
            'last_name_one' => __('Apellido 1'),
            'last_name_two' => __('Apellido 2'),
            'address' => __('Dirección'),
            'email' => __('Correoelectrónico'),
            'numero' => __('Nº'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'telefono' => __('Teléfono'),
            'profesional_tipo_uno_id' => __('Sector profesional'),
            'profesional_tipo_dos_id' => __('Subsector profesional'),
            'profesional_tipo_tres_id' => __('Actividad profesional'),
            'description' => htmlentities('Recomendación'),
            'profesional_letter_type_id' => 'Tipo de carta'
        ));


        $this->widgetSchema->setPositions(array('name', 'profesional_letter_type_id', 'description', 'plan_accion', 'id', 'profesional_letter_estado_id', 'profesional_apro_despro_id', 'Profesional'));

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'checkProvincia'))));
    }

    public function checkProvincia($validator, $values) {
        if ($values['states_id'] == 1) {
            $this->validatorSchema['city_id']->setOption('required', false);
            $this->validatorSchema['road_type_id']->setOption('required', false);
            $this->validatorSchema['address']->setOption('required', false);
            $this->validatorSchema['numero']->setOption('required', false);
        }

        return $values;
    }

    protected function doSave($con = null) {

        //start add code for google map add/edit

        $asProfessionalData = sfContext::getInstance()->getRequest()->getParameter('profesional_letter');

        $this->getObject()->setUserId($asProfessionalData['Profesional']['user_id']);
        $this->getObject()->setStatesId($asProfessionalData['Profesional']['states_id']);
        $this->getObject()->setCityId($asProfessionalData['Profesional']['city_id']);

        parent::doSave($con);

        $asProfessionalData = sfContext::getInstance()->getRequest()->getParameter('profesional_letter');
        $oProfesionalGMap = Doctrine::getTable('ProfesionalGoogleMap')->findOneByProfesionalId($this->getObject()->getProfesionalId());


        // if exist then update from object
        if ($oProfesionalGMap)
            $oProfesionalGoogleMap = $oProfesionalGMap;
        else
            $oProfesionalGoogleMap = new ProfesionalGoogleMap();

        $oProfesionalGoogleMap->setAddress($asProfessionalData['Profesional']['profesionalGoogleMap']['address']);
        $oProfesionalGoogleMap->setLng($asProfessionalData['Profesional']['profesionalGoogleMap']['lng']);
        $oProfesionalGoogleMap->setLat($asProfessionalData['Profesional']['profesionalGoogleMap']['lat']);
        $oProfesionalGoogleMap->setZoom($asProfessionalData['Profesional']['profesionalGoogleMap']['zoom']);
        $oProfesionalGoogleMap->setProfesionalId($this->getObject()->getProfesionalId());
        $oProfesionalGoogleMap->save();

        //end add code for google map add/edit
    }

}
