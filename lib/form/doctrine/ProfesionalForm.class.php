<?php

/**
 * Profesional form.
 *
 * @package    symfony
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalForm extends BaseProfesionalForm {

    public function configure() {
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


        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
        if ($this->getObject()->isNew()) {
            unset($this['slug'], $this['created_at'], $this['updated_at'], $this['fecha_activacion'], $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_observacion'], $this['fecha_cerrado'], $this['fecha_rechazado'], $this['fecha_nulo'], $this['revision_last_state_id'], $this["destacado"], $this["fecha_destacado"], $this['dividendo'], $this['active_reason']);
        }
        if (!$this->getObject()->isNew()) {
            unset($this['slug'], $this['created_at'], $this['updated_at'], $this['fecha_activacion'], $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_observacion'], $this['fecha_cerrado'], $this['fecha_rechazado'], $this['fecha_nulo'], $this['revision_last_state_id'], $this["destacado"], $this["fecha_destacado"], $this['dividendo'], $this['active_reason']);
        }

        //$this->widgetSchema["id"] = new sfWidgetFormInputHidden();
        //$this->validatorSchema['id'] = new sfValidatorString(array('required' => false));

        $this->embedRelation('profesionalGoogleMap', 'ProfesionalGoogleMapForm');
        //$this->embedRelation('alertas', 'AlertasForm');

        $this->widgetSchema['address'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@profesional_autocomplete_direccion'),
                ), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        $this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_c'));
        $this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));

        $this->widgetSchema['first_name'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@profesional_autocomplete_name')
                ), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        $this->widgetSchema['last_name_one'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['last_name_two'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        /* $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));
          $this->setValidators['user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));
          $this->validatorSchema["user_id"]->setMessage("required", 'Necesitas seleccionar un Usuario.'); */

        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'profesional_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);




        //$this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());

        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'RoadType',
            'order_by' => array('orden', 'asc'),
            'add_empty' => __('Selecciona vía')));

        $this->widgetSchema['profesional_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => $this->getRelatedModelName('ProfesionalTipoUno'),
            'order_by' => array('orden', 'asc'),
            'add_empty' => 'Selecciona sector profesional',
        ));

        $this->widgetSchema['profesional_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProfesionalTipoDos',
            'depends' => 'ProfesionalTipoUno',
            'ajax' => true,
            'add_empty' => 'Selecciona subsector profesional'));

        $this->widgetSchema['profesional_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProfesionalTipoTres',
            'depends' => 'ProfesionalTipoDos',
            'ajax' => true,
            'add_empty' => 'Selecciona actividad profesional'));

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'label' => 'Provincia',
            'model' => 'States',
            'add_empty' => 'Selecciona provincia',
            'order_by' => array('orden', 'asc')
        ));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'label' => 'Localidad',
            'model' => 'City',
            'depends' => 'States',
            'add_empty' => 'Selecciona localidad',
            'ajax' => true,
        ));

        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 490), 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300, 'height' => 200));
        $this->validatorSchema['incidencia'] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido tu recomendación.'));
        //$this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido tu recomendación.');

        $this->widgetSchema['profesional_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalEstado'), 'table_method' => 'getEstedioName', 'add_empty' => 'Selecciona estado', 'label' => 'Estado'));
        $this->setValidators['profesional_estado_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalEstado'), 'column' => 'id'));
        $this->validatorSchema["profesional_estado_id"]->setMessage("required", 'Necesitas seleccionar un estado.');

        if (!$this->isNew()) {
            $this->widgetSchema['active_reason'] = new sfWidgetFormTextareaCKEditor(array('height' => 200, 'width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 490), 'err_id' => 'Error_max_length_active_reason', 'max_length' => 3000));
            $this->validatorSchema['active_reason'] = new sfValidatorString(array('required' => true), array('required' => 'Para publicar un profesional en el Directorio necesitas antes incluir los Indicadores de excelencia.'));
            $this->widgetSchema->setLabels(array('active_reason' => __('Indicadores de excelencia')));
        }


        if ($this->isNew())
            $this->setDefault("profesional_estado_id", 1);

        if (!$this->getObject()->isNew()) {
            $snId = $this->getObject()->getId();

            $profesional_letter = Doctrine::getTable('ProfesionalLetter')->findOneByProfesionalId($snId);

            if ($profesional_letter)
                $this->setDefault("incidencia", $profesional_letter->getDescription());
        }

        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');

        //$this->widgetSchema['valida'] = new sfWidgetFormChoice(array('choices' => $choices));
        // pila de validators...
        $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => false, 'trim' => true), array('invalid' => 'Ese correo electrónico no es válido.'));

        //$this->validatorSchema['valida'] = new sfValidatorChoice(array('choices' => array_keys($choices)));


        $this->setValidator('first_name', new sfValidatorAnd(array(
            new sfValidatorString(array('required' => true, 'min_length' => 2, 'max_length' => 70), array('required' => __('No has incluido el nombre del profesional.'), 'invalid' => __('Ese nombre no es válido.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')), array('invalid' => __('Ese nombre no es válido.')))
                ), array(), array('required' => __('No has incluido el nombre del profesional.'), 'invalid' => __('Ese nombre no es válido.'))));



        $this->validatorSchema['last_name_one'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'No has incluido el primer apellido del profesional.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('No has incluido el primer apellido del profesional.'), 'invalid' => __('Ese apellido no es válido.')));

        $this->validatorSchema['last_name_two'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'No has incluido el segundo apellido del profesional.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('No has incluido el segundo apellido del profesional.'), 'invalid' => __('Ese apellido no es válido.')));


        $this->validatorSchema['road_type_id']->setOption('required', true);
        $this->validatorSchema['road_type_id']->setMessage('required', 'No has seleccionado un tipo de vía.');


        $this->validatorSchema['address'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'required' => false), array('invalid' => __('Esa dirección no es válida.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => true), array('required' => __('No has incluido la dirección del profesional.'),
            'invalid' => __('Esa dirección no es válida.')
                )
        );

        $this->validatorSchema['numero'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => true)),
            new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_numero', 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => true), array('required' => htmlentities('No has incluido un número en la dirección del profesional.'), 'invalid' => __('Ese Nº no es válido.'))
        );

        $caracteres_no_validos_piso_puerta = $caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]);
        $this->validatorSchema['piso'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Ese Piso no es válido.'))
        );

        $this->validatorSchema['puerta'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array(
                'caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
        );

        $this->widgetSchema['telefono'] = new sfWidgetFormInputText(array(), array('maxlength' => 9, 'style' => 'width:65px;'));
        $this->validatorSchema['telefono'] = new sfValidatorString(array('required' => false, 'min_length' => 9, 'max_length' => 9, 'trim' => true), array('required' => __('Ese teléfono no es válido.')));
        $this->validatorSchema['telefono'] = new sfValidatorRegex(array('pattern' => '/^([1]-)?[0-9]{9}$/i', 'required' => false), array('invalid' => __('Ese teléfono no es válido.')));
        $this->validatorSchema['numero']->setOption('required', true);
        $this->validatorSchema['numero']->setMessage('required', 'No has incluido un Nº.');

        $this->validatorSchema['states_id']->setOption('required', true);
        $this->validatorSchema['states_id']->setMessage('required', 'No has seleccionado la provincia donde ejerce el profesional.');

        $this->validatorSchema['city_id']->setOption('required', true);
        $this->validatorSchema['city_id']->setMessage('required', 'No has seleccionado la localidad donde ejerce el profesional.');

        $this->validatorSchema['profesional_tipo_uno_id']->setOption('required', true);
        $this->validatorSchema['profesional_tipo_uno_id']->setMessage('required', 'No has seleccionado el sector del profesional.');

        $this->validatorSchema['profesional_tipo_dos_id']->setOption('required', true);
        $this->validatorSchema['profesional_tipo_dos_id']->setMessage('required', 'No has seleccionado el subsector del profesional.');
        $this->validatorSchema['profesional_tipo_tres_id']->setOption('required', false);
        $this->validatorSchema['profesional_tipo_tres_id']->setMessage('required', 'No has seleccionado la actividad del profesional.');

        $this->validatorSchema['profesionalGoogleMap']['address']->setMessage('required', 'Para publicar un profesional necesitas asociarle una ubicación.');
        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_2_c'));
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false));
        //post validator


        $this->widgetSchema->setLabels(array(
            'last_name_one' => 'Apellido 1',
            'last_name_two' => 'Apellido 2',
            'first_name' => 'Nombre',
            'user_name' => 'Usuario',
            'road_type_id' => 'Tipo de vía',
            'direccion' => 'Dirección',
            'numero' => 'Nº',
            'profesional_tipo_uno_id' => 'Sector',
            'profesional_tipo_dos_id' => 'Subsector',
            'profesional_tipo_tres_id' => 'Actividad',
            'states_id' => 'Provincia',
            'telefono' => 'Teléfono',
            'email' => 'Correo electrónico',
            'user_id' => 'Usuario',
            'address' => 'Dirección',
            'profesionalGoogleMap' => 'Ubicación Googlemap',
            'incidencia' => __('RECOMENDACIÓN'), //Tu recomendación
        ));

        if (!$this->getObject()->isNew()) {
            $this->widgetSchema->setPositions(array('last_name_one', 'last_name_two', 'first_name', 'profesional_estado_id', 'user_id', 'user_name', 'road_type_id', 'address', 'numero', 'piso', 'puerta',
                'states_id', 'city_id', 'telefono', 'email',
                'profesional_tipo_uno_id', 'profesional_tipo_dos_id', 'profesional_tipo_tres_id', 'id', 'profesionalGoogleMap', 'incidencia', 'active_reason', 'featured', 'featured_order'
            ));
        }

        if ($this->getObject()->isNew()) {
            $this->widgetSchema->setPositions(array('last_name_one', 'last_name_two', 'first_name', 'profesional_estado_id', 'user_id', 'user_name', 'road_type_id', 'address', 'numero', 'piso', 'puerta',
                'states_id', 'city_id', 'telefono', 'email',
                'profesional_tipo_uno_id', 'profesional_tipo_dos_id', 'profesional_tipo_tres_id', 'id', 'profesionalGoogleMap', 'incidencia', 'featured', 'featured_order'
            ));
        }


        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'featuredCallback'))));
        $this->mergePreValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkProvincia')))
        );

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkLista')))
        );

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkActividad')))
        );

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkDestacados')))
        );

        /* $this->mergePostValidator(
          new sfValidatorCallback(array('callback' => array($this, 'checkUniqueSlug')))
          ); */

        $this->mergePostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Profesional', 'primary_key' => 'id', 'column' => array('first_name', 'last_name_one', 'last_name_two', 'road_type_id', 'address', 'numero', 'city_id', 'states_id')), array('invalid' => 'Ya existe un profesional con esas características. Por favor revísalo.'))
        );
    }

    public function checkProvincia($validator, $values) {
        if ($values['states_id'] == 1) {
            $this->validatorSchema['city_id']->setOption('required', false);
            $this->validatorSchema['road_type_id']->setOption('required', false);
            $this->validatorSchema['address']->setOption('required', false);
            $this->validatorSchema['numero']->setOption('required', false);
            $this->validatorSchema['profesionalGoogleMap']['address']->setOption('required', false);
        }

        return $values;
    }

    /**
     * Postvalidator que chequea si la empresa está validada y entonces obliga a tener un concurso asociado.
     *
     * @param $validator
     * @param $values
     * @return mixed
     * @throws sfValidatorErrorSchema
     */
    public function checkValida($validator, $values) {
        return $values;
        /** Al final esta validación no se hace pero la dejo porqué no tengo claro que no vuelva a ser necesario. */
        if ($values['valida'] == 1) {
            if (empty($values['concurso_id'])) {
                $error = new sfValidatorError($validator, 'Si la empresa está validada, este campo es requerido.');
                throw new sfValidatorErrorSchema($validator, array('concurso_id' => $error));
            }
        }

        return $values;
    }

    /**
     * Valida en caso que haya actividad que se escoja una.
     *
     * @param $validator
     * @param $values
     */
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

            if (count($errorSchema)) {
                throw $errorSchema;
            }
        }
        $this->validatorSchema['profesional_tipo_tres_id']->setOption('required', true);

        $subsector_id = $values['profesional_tipo_dos_id'];
        if (ProfesionalTipoDosTable::hasActividad($subsector_id)) {
            $error = new sfValidatorError($validator, 'Has de seleccionar una actividad');
            throw new sfValidatorErrorSchema($validator, array('profesional_tipo_tres_id' => $error));
        }
        return $values;
    }

    public function checkLista(sfValidatorCallback $validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);
        $required = array();

        //si está en una lista... googleMap required...
        if ($values['states_id'] != 1) {

            //si está en una lista... googleMap required...
            if ($values['profesionalGoogleMap']['address'] == '' && $values['profesionalGoogleMap']['lng'] == '40.4166909') {
                $errorSchema->addError(new sfValidatorError($validator, 'Para publicar un profesional en el Directorio necesitas asociarle una ubicación.'), 'profesionalGoogleMap');
            } elseif ($values['profesionalGoogleMap']['address'] != '' && $values['profesionalGoogleMap']['lng'] == '40.4166909') {
                $errorSchema->addError(new sfValidatorError($validator, 'Para publicar un profesional en el Directorio necesitas asociarle una ubicación.'), 'profesionalGoogleMap');
            }
        }

        if (count($errorSchema)) {
            throw $errorSchema;
        }

        return $values;
    }

    public function checkDestacados($validator, $values) {
        $newValues = $this->getTaintedValues();

        $defaultValues = $this->getDefaults();
        $profesional = $this->getObject();
        if ($newValues['city_id'] != $defaultValues['city_id']) {
            //check if destacado...
            if ($profesional->isDestacadaPorLocalidad() || $profesional->isDestacadaPorSectorLocalidad()) {
                $invalid = new sfValidatorError($validator, 'Para editar la localidad de este profesional, necesitas antes quitarlo como destacado.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }

        if ($newValues['states_id'] != $defaultValues['states_id']) {
            if ($profesional->isDestacadaPorProvincia() || $profesional->isDestacadaPorSectorProvincia()) {
                $invalid = new sfValidatorError($validator, 'Para editar la provincia de este profesional, necesitas antes quitarlo como destacado.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }
        $defaultValues['profesional_tipo_tres_id'] = (isset($defaultValues['profesional_tipo_tres_id'])) ? $defaultValues['profesional_tipo_tres_id'] : NULL;
        $newValues['profesional_tipo_tres_id'] = (isset($newValues['profesional_tipo_tres_id'])) ? $newValues['profesional_tipo_tres_id'] : NULL;
        if (($newValues['profesional_tipo_dos_id'] != $defaultValues['profesional_tipo_dos_id']) || ($newValues['profesional_tipo_tres_id'] != $defaultValues['profesional_tipo_tres_id'])) {
            if ($profesional->isDestacadaPorSector() || $profesional->isDestacadaPorSectorProvincia() || $profesional->isDestacadaPorSectorLocalidad()) {
                $invalid = new sfValidatorError($validator, 'Para editar el subsector o la actividad de este profesional, necesitas antes quitarlo como destacado.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }
        return $values;
    }

    public function checkUniqueSlug($validator, $values) {
        $city_name = '';
        $direction = '';
        $profesional = $this->getObject();
        $states = $profesional->getCheckStates($values['states_id']);
        $city = $profesional->getCheckCity($values['city_id']);
        if ($values['city_id']) {
            if ($city->getIsCapital() == '1') {
                $city_name = $states;
            } else {
                $city_name = $city->getName();
            }
        }
        $tipo = $profesional->getCheckTipo($values['road_type_id']);
        if (($states != 'Toda España' && $values['address']) || ($states == 'Toda España' && $values['address'])) {
            $direction = '-' . $values['address'];
        }
        $slug = $values['first_name'] . '-' . $values['last_name_one'] . '-' . $values['last_name_two'] . (($values['road_type_id'] != '') ? '-' . $tipo : '') . $direction . (($values['numero'] != '') ? '-' . $values['numero'] : '') . '-' . $city_name;
        $slug_replace = str_replace(' ', '-', $slug);
        $slug_string = iconv('UTF-8', 'ASCII//TRANSLIT', strtolower($slug_replace));
        $slug_chk = $profesional->getUniqueSlug($slug_string);
        //echo $slug_chk; exit;
        if ($this->getObject()->isNew()) {
            if ($slug_chk != 0) {
                throw new sfValidatorError($validator, 'Ya existe un profesional con esas características. Por favor revísalo.');
            }
        } else {
            if ($slug_chk > 0 && $slug_chk != 1) {
                throw new sfValidatorError($validator, 'Ya existe un profesional con esas características. Por favor revísalo.');
            }
        }
        return $values;
    }

    protected function doSave($con = null) {

        if ($this->getObject()->isNew()) {
            parent::doSave($con);
            $this->getObject()->setProfesionalEstadoId(1);
            $this->getObject()->save();
        } else {
            //start add for save
            parent::doSave($con);
            //end add for save
            // $this->getObject()->setProfesionalEstadoId(2);
            $this->getObject()->save();
        }

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

    /**
     *
     * @param type $validator
     * @param type $values
     * @return type
     */
    public function featuredCallback($validator, $values) {
        if (!empty($values['featured'])) {
            //get featured limit
            $featured_limit = Doctrine::getTable('Profesional')->getFeatreudLimit();

            //if featured limit is more then 10 then show error message
            if ($featured_limit[0]['profesional_limit'] >= 11) {
                $invalid = new sfValidatorError($validator, 'No puedes destacar más de 11 profesionales del Directorio en la Home.');
                throw new sfValidatorErrorSchema($validator, array('featured' => $invalid));
            }
        }
        return $values;
    }

}
