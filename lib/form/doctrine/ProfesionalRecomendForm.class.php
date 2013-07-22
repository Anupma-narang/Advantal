<?php

/**
 * ProfesionalRegister form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Alpesh
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalRecomendForm extends BaseProfesionalForm {

    public function configure() {
        unset($this["created_at"], $this["updated_at"], $this["first_name"], $this["last_name_one"], $this["last_name_two"], $this["numero"], $this["profesional_estado_id"], $this["profesional_tipo_uno_id"], $this["profesional_tipo_dos_id"], $this["user_id"]
        );

        $asProfesional = $this->getObject()->getData();

        $oUnoProfesional = Doctrine::getTable('ProfesionalTipoUno')->find($asProfesional['profesional_tipo_uno_id']);
        $oDosProfesional = Doctrine::getTable('ProfesionalTipoDos')->find($asProfesional['profesional_tipo_dos_id']);
        $oTresProfesional = Doctrine::getTable('ProfesionalTipoTres')->find($asProfesional['profesional_tipo_tres_id']);
        $oRtypeProfesional = Doctrine::getTable('RoadType')->find($asProfesional['road_type_id']);
        $oStateProfesional = Doctrine::getTable('States')->find($asProfesional['states_id']);
        $oCityProfesional = Doctrine::getTable('City')->find($asProfesional['city_id']);
        $oTresName = ($asProfesional['profesional_tipo_tres_id']) ? $oTresProfesional->getName() : '';
        $this->disableCSRFProtection();
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->widgetSchema["user_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());
        $this->widgetSchema["profesional_letter_estado_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("profesional_letter_estado_id", 1);


        $this->setWidgets(array(
            'first_name' => new sfWidgetFormInputText(array(), array('value' => (!$this->getObject()->isNew() ? $asProfesional['first_name'] : ''), 'disabled' => "disabled")),
            'last_name_one' => new sfWidgetFormInputText(array(), array('value' => (!$this->getObject()->isNew() ? $asProfesional['last_name_one'] : ''), 'disabled' => "disabled")),
            'last_name_two' => new sfWidgetFormInputText(array(), array('value' => (!$this->getObject()->isNew() ? $asProfesional['last_name_two'] : ''), 'disabled' => "disabled")),
            'address' => new sfWidgetFormInputText(array(), array('value' => (!$this->getObject()->isNew() ? $asProfesional['address'] : ''), 'disabled' => "disabled")),
            'numero' => new sfWidgetFormInputText(array(), array('value' => (!$this->getObject()->isNew() ? $asProfesional['numero'] : ''), 'disabled' => "disabled")),
            'piso' => new sfWidgetFormInputText(array(), array('value' => (!$this->getObject()->isNew() ? $asProfesional['piso'] : ''), 'disabled' => "disabled")),
            'puerta' => new sfWidgetFormInputText(array(), array('value' => (!$this->getObject()->isNew() ? $asProfesional['puerta'] : ''), 'disabled' => "disabled")),
            'telefono' => new sfWidgetFormInputText(array(), array('value' => (!$this->getObject()->isNew() ? $asProfesional['telefono'] : ''), 'disabled' => "disabled")),
            'email' => new sfWidgetFormInputText(array(), array('value' => (!$this->getObject()->isNew() ? $asProfesional['email'] : ''), 'disabled' => "disabled")),
            'profesional_tipo_uno_id' => new sfWidgetFormInputText(array(), array('value' => $oUnoProfesional->getName(), 'disabled' => "disabled")),
            'profesional_tipo_dos_id' => new sfWidgetFormInputText(array(), array('value' => $oDosProfesional->getName(), 'disabled' => "disabled")),
            'profesional_tipo_tres_id' => new sfWidgetFormInputText(array(), array('value' => $oTresName, 'disabled' => "disabled")),
            'road_type_id' => new sfWidgetFormInputText(array(), array('value' => (($oRtypeProfesional) ? $oRtypeProfesional->getName() : ""), 'disabled' => "disabled")),
            'states_id' => new sfWidgetFormInputText(array(), array('value' => $oStateProfesional->getName(), 'disabled' => "disabled")),
            'city_id' => new sfWidgetFormInputText(array(), array('value' => $oCityProfesional->getName(), 'disabled' => "disabled")),
        ));

        $this->setValidators(array(
            'first_name' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'last_name_one' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'last_name_two' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'address' => new sfValidatorString(array('max_length' => 70, 'required' => false)),
            'numero' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
            'piso' => new sfValidatorString(array('max_length' => 3, 'required' => false)),
            'puerta' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
            'telefono' => new sfValidatorString(array('max_length' => 9, 'required' => false)),
            'email' => new sfValidatorString(array('max_length' => 70, 'required' => false)),
            'profesional_tipo_uno_id' => new sfValidatorString(array('required' => false)),
            'profesional_tipo_dos_id' => new sfValidatorString(array('required' => false)),
            'profesional_tipo_tres_id' => new sfValidatorString(array('required' => false)),
            'road_type_id' => new sfValidatorString(array('required' => false)),
            'states_id' => new sfValidatorString(array('required' => false)),
            'city_id' => new sfValidatorString(array('required' => false)),
        ));

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'size' => 38));
        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true), array('required' => __('Necesitas incluir un título.')));

        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 490), 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        $this->validatorSchema['incidencia'] = new mySfValidatorString(array('max_rep_length' => 12300), array('max_rep_length' => htmlentities('Has superado el espacio permitido para tu recomendaci�n.')));
        $this->validatorSchema["incidencia"]->setMessage("required", __('Necesitas incluir tu recomendación.'));

        $this->widgetSchema["borrador"] = new sfWidgetFormInputCheckbox(array("label" => __('Deseo continuar más tarde y guardar esta carta en borrador.'), "value_attribute_value" => "borrador"));
        $this->validatorSchema["borrador"] = new sfValidatorPass();

        $this->widgetSchema->setLabels(array(
            'first_name' => __('Nombre'),
            'last_name_one' => __('Apellido 1'),
            'last_name_two' => __('Apellido 2'),
            'address' => __('Dirección'),
            'email' => __('Correo electrónico'),
            'numero' => __('Nº'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'name' => __('Título*'),
            'incidencia' => __('TU RECOMENDACIÓN*'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'telefono' => __('Teléfono'),
            'profesional_tipo_uno_id' => __('Sector <br> profesional'),
            'profesional_tipo_dos_id' => __('Subsector <br> profesional'),
            'profesional_tipo_tres_id' => __('Actividad <br> profesional')
        ));

        if (!$this->getObject()->isNew()) {
            $letter_id = sfContext::getInstance()->getRequest()->getParameter('letter_id');

            $snId = $this->getObject()->getId();

            $profesional_letter = Doctrine::getTable('ProfesionalLetter')->findOneByProfesionalIdAndId($snId, $letter_id);

            if ($profesional_letter) {
                $this->setDefault("incidencia", $profesional_letter->getDescription());
                $this->setDefault("name", $profesional_letter->getName());
            }
        }


//           $this->getValidator("incidencia")->setOption("required", false);
//             $this->getValidator('incidencia')->setOption('required', false);

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);
        $this->widgetSchema->setNameFormat('profesional[%s]');

        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array('callback' => array($this, 'preValidate'))));
    }

    public function preValidate($validator, $values) {
        $request = sfContext::getInstance()->getRequest();
        $ma_values = $request->getParameter('profesional');
        if (isset($ma_values["borrador"]) && $ma_values["borrador"] != '') {
            $this->getValidator("incidencia")->setOption("required", false);
        }
    }

}