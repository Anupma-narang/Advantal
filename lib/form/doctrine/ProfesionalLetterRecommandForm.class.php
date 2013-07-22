<?php

/**
 * ProfesionalLetter form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalLetterRecommandForm extends BaseProfesionalLetterForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        unset(
                $this["created_at"], $this["updated_at"], $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_destacado'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_rechazado'], $this['fecha_cerrado'], $this['fecha_nulo'], $this['revision_last_state_id'], $this['states_id'], $this['city_id'], $this['profesional_activa_desa_id'], $this['fecha_observacion'], $this['id'], $this['plan_accion'], $this['is_first']
        );

        /*   $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));
          $this->setValidators['user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));
          $this->validatorSchema["user_id"]->setMessage("required", 'Necesitas seleccionar un Usuario.'); */

        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array(), array('id' => 'profesional_ProfesionalLetter_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->setDefault('user_name', $this->getObject()->getUser()->getUsername());
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));

        $this->widgetSchema['profesional_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['profesional_id'] = new sfValidatorString(array('required' => false));

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'style' => 'width: 491px;'));
        $this->validatorSchema['name']->setMessage("required", 'No has incluido el título de tu carta.');

        $this->widgetSchema['profesional_letter_type_id'] = new sfWidgetFormInputHidden(array(), array('value' => 1));
        $this->validatorSchema['profesional_letter_type_id'] = new sfValidatorString(array('required' => false));

        $this->widgetSchema['profesional_letter_type_list'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterType'), 'add_empty' => false), array('disabled' => 'disabled'));
        $this->setValidators['profesional_letter_type_list'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterType')), array('required' => false));

        //$this->widgetSchema['profesional_letter_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterEstado'), 'table_method' => 'getEstedioLetterName','add_empty' => true,'label'=>'Estado'));
        //$this->setValidators['profesional_letter_estado_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalLetterEstado'), 'column' => 'id'));

        $this->widgetSchema["profesional_letter_estado_id"] = new sfWidgetFormInputHidden();
        $this->validatorSchema['profesional_letter_estado_id'] = new sfValidatorString(array('required' => false));

        if ($this->getObject()->isNew())
            $this->setDefault("profesional_letter_estado_id", 1);
        $this->widgetSchema['description'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        $this->validatorSchema['description'] = new mySfValidatorString(array(), array('max_length' => 'Has superado el espacio permitido para tu recomendación.'));
        $this->validatorSchema["description"]->setMessage("required", 'No has incluido tu recomendación.');
        $this->widgetSchema["profesional_apro_despro_id"] = new sfWidgetFormInputHidden(array(), array('value' => 1));

        $this->widgetSchema->setLabels(array(
            'name' => __('Título'),
            'incidencia' => __('Tu desaprobaci�n'),
            'plan_accion' => __('Plan de acci�n'),
            'first_name' => __('Nombre'),
            'user_name' => __('Usuario'),
            'last_name_one' => __('Apellido 1'),
            'last_name_two' => __('Apellido 2'),
            'address' => __('Direcci�n'),
            'email' => __('Correo electr�nico'),
            'numero' => __('N�'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'road_type_id' => __('Tipo de v�a'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'telefono' => __('Tel�fono'),
            'profesional_tipo_uno_id' => __('Sector profesional'),
            'profesional_tipo_dos_id' => __('Subsector profesional'),
            'profesional_tipo_tres_id' => __('Actividad profesional'),
            'description' => "<strong>" . __("RECOMENDACIÓN") . "</strong>",
            'profesional_letter_type_list' => 'Tipo de carta',
            'user_id' => 'Usuario'
        ));

        $this->widgetSchema->setPositions(
                array(
                    'profesional_id', 'profesional_letter_type_list', 'name', 'user_id', 'user_name', 'profesional_letter_type_id', 'description', 'profesional_letter_estado_id', 'profesional_apro_despro_id'
                )
        );

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'checkProvincia'))));
    }

    public function checkProvincia($validator, $values) {
        if ($this->getObject()->getStatesId() == 1) {
            $this->validatorSchema['city_id'] = new sfValidatorString(array('required' => false));
            $this->validatorSchema['road_type_id'] = new sfValidatorString(array('required' => false));
            $this->validatorSchema['address'] = new sfValidatorString(array('required' => false));
            $this->validatorSchema['numero'] = new sfValidatorString(array('required' => false));
        }

        return $values;
    }

}
