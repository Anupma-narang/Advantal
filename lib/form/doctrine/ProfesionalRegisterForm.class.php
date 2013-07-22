<?php

/**
 * ProfesionalRegister form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Alpesh
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalRegisterForm extends BaseProfesionalForm {

    public function configure() {
        $this->disableCSRFProtection();
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        unset($this["created_at"], $this["updated_at"], $this["destacado"], $this["fecha_destacado"]);

        $this->widgetSchema["user_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());
        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'RoadType',
            'order_by' => array('orden', 'asc'),
            'add_empty' => __('Selecciona vía')), array('class' => 'select_pequeño')
        );

        $caracteres_no_validos_direccion = array(
            '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶', '{', '}', ';', ':', '_', '"',
            '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
            'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
            'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
            'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '·', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
            '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
            '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
            '*', '[', ']', '>', '<', '¬', '·', '¿', '³', '¨', '•');

        $caracteres_no_validos_nombre = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶',
            '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
            'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
            'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
            'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
            '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
            '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
            '*', '[', ']', '{', '}', ';', ':', '_', 'ª', 'º', '"', '>', '<', '¬', '·', '¿');

        /* $this->validatorSchema['address'] = new sfValidatorAnd(array(
          new sfValidatorString(array('max_length' => 70, 'required' => true), array('invalid' => __('Esa dirección no es válida.'))),
          new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
          ),
          array('required' => true),
          array('required' => __('No has incluido una dirección.'), 'invalid' => __('Esa dirección no es válida.'))
          ); */

        $this->widgetSchema['address'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        $this->validatorSchema['address'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'required' => true), array('invalid' => __('Esa dirección no es válida.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => true), array('required' => 'Necesitas incluir la dirección del profesional.', 'invalid' => __('Esa dirección no es válida.'))
        );


        //$this->validatorSchema['address'] = new sfValidatorString(array('max_length' => 70, 'required' => true, 'trim' => true),array('required' => htmlentities('No has incluido la dirección del profesional.')));

        $caracteres_no_validos_numero = $caracteres_no_validos_direccion;
        unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]); // para número sí permitimos la barra
        $this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->validatorSchema['numero'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => true)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => true), array('required' => 'Necesitas incluir un Nº.', 'invalid' => __('Ese Nº no es válido.'))
        );
        $caracteres_no_validos_piso_puerta = $caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_c'));
        $this->validatorSchema['piso'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Ese Piso no es válido.'))
        );
        $this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->validatorSchema['puerta'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
        );

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'States',
            'add_empty' => 'Selecciona provincia',
            'order_by' => array('orden', 'asc')
        ));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'City',
            'depends' => 'States',
            'add_empty' => __('Selecciona localidad'),
            'ajax' => true));

        $this->widgetSchema['profesional_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProfesionalTipoUno',
            'order_by' => array('orden', 'asc'),
            'add_empty' => __('Selecciona sector')));

        $this->widgetSchema['profesional_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProfesionalTipoDos',
            'depends' => 'ProfesionalTipoUno',
            'add_empty' => __('Selecciona subsector')));

        $this->widgetSchema['profesional_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProfesionalTipoTres',
            'depends' => 'ProfesionalTipoDos',
            'add_empty' => __('Selecciona actividad')));

        $this->setDefault('profesional_tipo_uno_id', '');
        $this->widgetSchema["profesional_estado_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("profesional_estado_id", 1);
        $this->validatorSchema['profesional_tipo_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProfesionalTipoUno'), array('required' => 'Necesitas seleccionar un sector profesional.'));
        $this->validatorSchema['profesional_tipo_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProfesionalTipoDos'), array('required' => 'Necesitas seleccionar un subsector profesional.'));
        $this->validatorSchema['profesional_tipo_tres_id']->setOption('required', false);
        $this->validatorSchema['profesional_tipo_tres_id']->setMessage('required', 'Necesitas seleccionar una actividad profesional.');

        $this->validatorSchema['road_type_id']->setOption("required", true);
        $this->validatorSchema['road_type_id']->setMessage('required', __('Necesitas seleccionar el tipo de vía.'));
        $this->validatorSchema["states_id"]->setOption("required", true);
        $this->validatorSchema['states_id']->setMessage('required', __('Necesitas seleccionar una provincia.'));
        $this->validatorSchema["city_id"]->setOption("required", true);
        $this->validatorSchema["city_id"]->setMessage("required", __('Necesitas seleccionar una localidad.'));

        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 490), 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        $this->validatorSchema['incidencia'] = new mySfValidatorString(array('max_rep_length' => 12300), array('max_rep_length' => 'Has superado el espacio permitido para tu recomendación.'));
        $this->validatorSchema["incidencia"]->setMessage("required", 'Necesitas incluir tu recomendación.');

        if (!$this->getObject()->isNew()) {
            $snId = $this->getObject()->getId();

            $profesional_letter = Doctrine::getTable('ProfesionalLetter')->findOneByProfesionalId($snId);

            if ($profesional_letter)
                $this->setDefault("incidencia", $profesional_letter->getDescription());
        }


        $this->widgetSchema['first_name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70));
        $this->widgetSchema['last_name_one'] = new sfWidgetFormInputText(array(), array('maxlength' => 70));
        $this->widgetSchema['last_name_two'] = new sfWidgetFormInputText(array(), array('maxlength' => 70));
        $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('maxlength' => 70));

        $this->validatorSchema['first_name'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('Necesitas incluir el nombre del profesional.'), 'invalid' => __('Ese nombre no es válido.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('Necesitas incluir el nombre del profesional.'), 'invalid' => __('Ese nombre no es válido.')));

        $this->validatorSchema['last_name_one'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'Necesitas incluir el primer apellido del profesional.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('Necesitas incluir el primer apellido del profesional.'), 'invalid' => __('Ese apellido no es válido.')));

        $this->validatorSchema['last_name_two'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'Necesitas incluir el segundo apellido del profesional.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('Necesitas incluir el segundo apellido del profesional.'), 'invalid' => __('Ese apellido no es válido.')));

//         $this->validatorSchema['last_name_one']->setMessage("required", 'No has incluido el primer apellido del profesional.');
//         $this->validatorSchema['last_name_two']->setMessage("required", 'No has incluido el segundo apellido del profesional.');

        $this->validatorSchema["email"]->setOption("required", false);
        //$this->validatorSchema['email']->setMessage("required", __('cap_email_address_required'));
//         $this->widgetSchema['telefono'] = new sfWidgetFormInputText(array(), array('maxlength' => 9));
//         $this->validatorSchema['telefono'] = new sfValidatorAnd(array(
//                         new sfValidatorString(array('required' => false,'min_length' => 9, 'max_length' => 9, 'trim' => true),array('required' => htmlentities(__('Ese teléfono no es válido.')))),
//                         new sfValidatorRegex(array('pattern' => '/^([1]-)?[0-9]{9}$/i'),array('invalid' => htmlentities(__('Ese teléfono no es válido.')))),), array());

        $this->widgetSchema['telefono'] = new sfWidgetFormInputText(array(), array('maxlength' => 9));
        $this->validatorSchema['telefono'] = new sfValidatorString(array('required' => false, 'min_length' => 9, 'max_length' => 9, 'trim' => true), array('required' => __('Necesitas introducir 9 números sin espacios.')));
        $this->validatorSchema['telefono'] = new sfValidatorRegex(array('pattern' => '/^([1]-)?[0-9]{9}$/i', 'required' => false), array('invalid' => __('Necesitas introducir 9 números sin espacios.')));

        $this->widgetSchema['destacado'] = new sfWidgetFormInputText(array(), array('maxlength' => 10));
        //$this->validatorSchema['destacado']->setMessage("required", false);

        $this->widgetSchema["borrador"] = new sfWidgetFormInputCheckbox(array("label" => __('Deseo continuar más tarde y guardar este profesional en borrador.'), "value_attribute_value" => "borrador"));
        $this->validatorSchema["borrador"] = new sfValidatorPass();

        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsEmail'))),
        )));
        $this->mergePreValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkProvincia')))
        );
        $this->mergePreValidator(
                new sfValidatorCallback(array('callback' => array($this, 'preValidate')))
        );
        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkActividad')))
        );
        // $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));
        //    $this->validatorSchema->setPreValidator(new sfValidatorCallback(array('callback' => array($this, 'checkProvincia'))));

        $this->widgetSchema->setLabels(array(
            'first_name' => __('Nombre*'),
            'last_name_one' => __('Apellido 1*'),
            'last_name_two' => __('Apellido 2*'),
            'address' => __('Dirección*'),
            'email' => __('Correo electrónico'),
            'numero' => __('Nº*'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'name' => __('Título de la incidencia*'),
            'incidencia' => __('TU RECOMENDACIÓN*'), //Tu recomendación
            'road_type_id' => __('Tipo de vía*'),
            'states_id' => __('Provincia*'),
            'city_id' => __('Localidad*'),
            'telefono' => __('Teléfono'),
            'profesional_tipo_uno_id' => __('Sector<br> profesional*'),
            'profesional_tipo_dos_id' => __('Subsector<br> profesional*'),
            'profesional_tipo_tres_id' => __('Actividad<br> profesional*')
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);
        $this->widgetSchema->setNameFormat('profesional[%s]');
    }

    public function preValidate($validator, $values) {
        $request = sfContext::getInstance()->getRequest();
        $ma_values = $request->getParameter('profesional');
        if (isset($values['states_id'])) {
            if (($values['states_id'] == 16) || ($values['states_id'] == 35) || ($values['states_id'] == 1)) {
                $this->getValidator('city_id')->setOption('required', false);
            }
        }


        if (isset($ma_values["borrador"]) && $ma_values["borrador"] != '') {
            $this->getValidator("incidencia")->setOption("required", false);
        } else {
            if ((isset($values['profesional_tipo_dos_id'])) && ($values['profesional_tipo_dos_id'] != '')) {
                if ($empresa_sector_3 = Doctrine::getTable('ProfesionalTipoTres')->findBy('profesional_tipo_dos_id', $values['profesional_tipo_dos_id']))
                    if (count($empresa_sector_3) == 0)
                        $this->getValidator('profesional_tipo_tres_id')->setOption('required', false);
            }
        }
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

    public function checkActividad($validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);
        if (!empty($values['profesional_tipo_tres_id'])) {
            return $values;
        }
        if (empty($values['profesional_tipo_dos_id'])) {
            $this->validatorSchema['profesional_tipo_tres_id']->setOption('required', true);
            try {
                $this->validatorSchema['profesional_tipo_tres_id']->clean($values['profesional_tipo_tres_id']);
            } catch (sfValidatorErrorSchema $e) {
                $errorSchema->addErrors($e);
            } catch (sfValidatorError $e) {
                $errorSchema->addError($e, 'profesional_tipo_tres_id');
            }
        }
        if (count($errorSchema)) {
            throw $errorSchema;
        }

        if (ProfesionalTipoDosTable::hasActividad($values['profesional_tipo_dos_id'])) {
            $this->validatorSchema['profesional_tipo_tres_id']->setOption('required', true);
            try {
                $this->validatorSchema['profesional_tipo_tres_id']->clean($values['profesional_tipo_tres_id']);
            } catch (sfValidatorErrorSchema $e) {
                $errorSchema->addErrors($e);
            } catch (sfValidatorError $e) {
                $errorSchema->addError($e, 'profesional_tipo_tres_id');
            }
        }

        if (count($errorSchema)) {
            throw $errorSchema;
        }
        return $values;
    }

    public function extraValidatorsEmail($validator, $values) {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $email_validated = false;
        if (strlen($values['email']) > 32) {
            $email_validated = true;
            $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
            throw new sfValidatorErrorSchema($validator, array('email' => $error));
        } elseif (!preg_match(sfValidatorEmail::REGEX_EMAIL, $values['email']) && !empty($values['email'])) {
            $email_validated = true;
            $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
            throw new sfValidatorErrorSchema($validator, array('email' => $error));
        } else {
            $num_usuarios_mismo_nombre = Doctrine::getTable('sfGuardUserProfile')->createQuery()
                    ->where('email=?', $values['email'])
                    ->count();
            if ($num_usuarios_mismo_nombre > 0) {
                $email_validated = true;
                $error = new sfValidatorError($validator, __('Ese correo electrónico lo está usando ya otro colaborador.'));
                throw new sfValidatorErrorSchema($validator, array('email' => $error));
            }
        }
        return $values;
    }

    /* public function doBind(array $values) {
      if (isset($values["borrador"])) {
      $values["profesional_estado_id"] = 9;

      } else {
      $values["profesional_estado_id"] = 1;
      }

      return parent::doBind($values);
      } */
}

